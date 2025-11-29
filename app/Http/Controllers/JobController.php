<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Lowongan;
use App\Models\Lamaran;
use App\Models\User;

class JobController extends Controller
{
    public function index(Request $r)
    {
        // ===============================
        // AUTO-CLOSE LOWONGAN EXPIRED
        // ===============================
        Lowongan::where('status', 'published')
            ->whereNotNull('deadline')
            ->whereDate('deadline', '<', now()->toDateString())
            ->update(['status' => 'closed']);

        // ==== FILTER DASAR ====
        $filters = $r->only('q', 'lokasi', 'tipe', 'skill');

        $lowongansQuery = Lowongan::with('perusahaan')
            // hanya tampilkan lowongan yang masih aktif untuk pelamar
            ->where('status', 'published')
            ->where(function ($q) {
                $q->whereNull('deadline')
                  ->orWhereDate('deadline', '>=', now()->toDateString());
            })
            ->filter($filters)         // pakai scopeFilter di model
            ->latest();

        $lowongans = $lowongansQuery->paginate(12);

        // ==== INFO PELAMAR (untuk kecocokan skill & validasi apply) ====
        $pelamarHasCv           = false;
        $pelamarProfileComplete = false;
        $pelamarSkills          = [];

        if (auth()->check() && auth()->user()->isPelamar()) {
            $pelamar        = auth()->user()->pelamar;
            $pelamarHasCv   = (bool) ($pelamar && $pelamar->cv_path);

            if ($pelamar) {
                $pelamarSkills = is_array($pelamar->keterampilan)
                    ? $pelamar->keterampilan
                    : (json_decode($pelamar->keterampilan ?? '[]', true) ?: []);

                // profil dianggap "cukup lengkap"
                $pelamarProfileComplete = (bool) (
                    $pelamar->tanggal_lahir &&
                    $pelamar->telepon &&
                    $pelamar->alamat &&
                    !empty($pelamarSkills) &&
                    $pelamarHasCv
                );
            }

            // hitung kecocokan skill per lowongan
            $pelamarSkillsLower = collect($pelamarSkills)
                ->filter()
                ->map(fn ($s) => mb_strtolower(trim($s)))
                ->unique()
                ->values()
                ->all();

            $lowongans->getCollection()->transform(function ($l) use ($pelamarSkillsLower) {
                // Ambil required skill dari lowongan
                $jobSkills = [];

                if (is_array($l->keahlian)) {
                    $jobSkills = $l->keahlian;
                } elseif (is_string($l->keahlian)) {
                    // bisa "Laravel, React, Vue"
                    $jobSkills = array_map('trim', preg_split('/[,;]+/', $l->keahlian));
                }

                $jobSkillsLower = collect($jobSkills)
                    ->filter()
                    ->map(fn ($s) => mb_strtolower(trim($s)))
                    ->unique()
                    ->values()
                    ->all();

                if (empty($jobSkillsLower) || empty($pelamarSkillsLower)) {
                    $l->skill_match = 0;
                } else {
                    $intersect = array_intersect($jobSkillsLower, $pelamarSkillsLower);
                    $l->skill_match = round(count($intersect) / count($jobSkillsLower) * 100);
                }

                return $l;
            });

            // sort: yang skill_match lebih besar ditaruh di depan
            $sorted = $lowongans->getCollection()->sortByDesc('skill_match');
            $lowongans->setCollection($sorted->values());
        }

        return view('jobs.index', [
            'lowongans'              => $lowongans,
            'pelamarHasCv'           => $pelamarHasCv,
            'pelamarProfileComplete' => $pelamarProfileComplete,
        ]);
    }

    public function create()
    {
        abort_if(!auth()->user()->isPerusahaan(), 403);
        return view('jobs.create');
    }

    public function store(Request $r)
    {
        abort_if(!auth()->user()->isPerusahaan(), 403);

        $data = $r->validate([
            'judul'          => 'required|max:200',
            'deskripsi'      => 'required',
            'kualifikasi'    => 'nullable',
            'lokasi'         => 'nullable|max:150',
            'tipe_pekerjaan' => 'nullable|in:Full-time,Part-time,Internship,Contract',
            'deadline'       => 'nullable|date',
            'keahlian'       => 'nullable|string', // mis: "Laravel, React, Vue"
        ]);

        $lowongan = Lowongan::create([
            'perusahaan_id' => auth()->user()->perusahaan->id,
            'judul'         => $data['judul'],
            'deskripsi'     => $data['deskripsi'],
            'kualifikasi'   => $data['kualifikasi'] ?? null,
            'lokasi'        => $data['lokasi'] ?? null,
            'tipe'          => $data['tipe_pekerjaan'] ?? null,
            'deadline'      => $data['deadline'] ?? null,
            'keahlian'      => $data['keahlian'] ?? null,
            'status'        => 'pending',
        ]);

        return redirect()
            ->route('perusahaan.lowongan')
            ->with('ok', 'Lowongan berhasil dibuat.');
    }

    public function mine()
    {
        abort_if(!auth()->user()->isPerusahaan(), 403);

        $perusahaanId = auth()->user()->perusahaan->id;
        $lowongans = Lowongan::where('perusahaan_id', $perusahaanId)
            ->latest()
            ->paginate(6);

        return view('jobs.mine', compact('lowongans'));
    }

    public function show(Lowongan $lowongan)
    {
        $u = auth()->user();

        // ===============================
        // AUTO-CLOSE JIKA SUDAH LEWAT DEADLINE
        // ===============================
        if ($lowongan->deadline && $lowongan->deadline->isPast() && $lowongan->status === 'published') {
            $lowongan->update(['status' => 'closed']);
        }

        $isExpired    = $lowongan->deadline && $lowongan->deadline->isPast();
        $isPrivileged = $u?->isPerusahaan() || $u?->isAdmin();

        // Kalau bukan perusahaan/admin:
        // - hanya boleh lihat lowongan yang status-nya masih published
        // - dan belum lewat deadline
        if (!$isPrivileged) {
            if ($lowongan->status !== 'published' || $isExpired) {
                abort(404);
            }
        }

        $lowongan->load('perusahaan');

        $alreadyApplied = false;
        $myLamaran      = null;

        if ($u && $u->isPelamar()) {
            $myLamaran = Lamaran::where('lowongan_id', $lowongan->id)
                ->where('user_id', $u->id)
                ->latest()
                ->first();

            $alreadyApplied = (bool) $myLamaran;
        }

        return view('jobs.show', compact('lowongan', 'alreadyApplied', 'myLamaran'));
    }
}
