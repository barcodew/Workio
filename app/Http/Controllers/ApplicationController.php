<?php

namespace App\Http\Controllers;

use App\Models\Lamaran;
use App\Models\Lowongan;
use App\Notifications\LamaranStatusUpdated;
use App\Notifications\NewLamaranSubmitted;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\QueryException;

class ApplicationController extends Controller {
    /**
    * Simpan lamaran baru oleh pelamar.
    */

    public function store( Request $r, Lowongan $lowongan ) {
        $user = Auth::user();
        abort_if ( !$user || !$user->isPelamar(), 403 );

        $pelamar = $user->pelamar;

        // ===  ===  ===  ===  ===  ===  ===  ===  ===  =
        // CEK KELENGKAPAN PROFIL
        // ===  ===  ===  ===  ===  ===  ===  ===  ===  =
        $missing = [];

        if ( !$pelamar ) {
            $missing[] = 'data pelamar';
        } else {
            if ( !$pelamar->tanggal_lahir )        $missing[] = 'tanggal lahir';
            if ( !$pelamar->telepon )              $missing[] = 'telepon';
            if ( !$pelamar->alamat )               $missing[] = 'alamat';
            if ( empty( $pelamar->pendidikan ) )     $missing[] = 'riwayat pendidikan';
            if ( empty( $pelamar->keterampilan ) )   $missing[] = 'keterampilan';
            if ( empty( $pelamar->riwayat_pekerjaan ) ) $missing[] = 'riwayat pekerjaan';
        }

        // validasi file opsional
        $data = $r->validate( [
            'file_cv'       => 'nullable|file|mimes:pdf,doc,docx|max:2048',
            'surat_lamaran' => 'nullable|file|mimes:pdf,doc,docx|max:2048',
        ] );

        // ===  ===  ===  ===  ===  ===  ===  ===  ===  =
        // AMBIL / CEK CV
        // ===  ===  ===  ===  ===  ===  ===  ===  ===  =
        if ( $r->file( 'file_cv' ) ) {
            // upload CV baru
            $cvPath = $r->file( 'file_cv' )->store( 'cv', 'public' );
        } else {
            // pakai CV dari profil
            $cvPath = $pelamar?->cv_path;
        }

        // kalau tetap kosong → dianggap belum punya CV
        if ( !$cvPath ) {
            $missing[] = 'CV';
        }

        // kalau masih ada kekurangan → blokir lamaran
        if ( !empty( $missing ) ) {
            return back()
            ->withInput()
            ->with(
                'err',
                'Profil kamu belum lengkap: ' .
                implode( ', ', $missing ) .
                '. Lengkapi profil dan upload CV sebelum melamar.'
            );
        }

        // simpan surat lamaran ( opsional )
        $surPath = $r->file( 'surat_lamaran' )
        ? $r->file( 'surat_lamaran' )->store( 'surat', 'public' )
        : null;

        // ===  ===  ===  ===  ===  ===  ===  ===  ===  =
        // CEGAH MELAMAR 2x
        // ===  ===  ===  ===  ===  ===  ===  ===  ===  =
        $exists = Lamaran::where( 'lowongan_id', $lowongan->id )
        ->where( 'user_id', $user->id )
        ->exists();

        if ( $exists ) {
            return back()->with( 'err', 'Kamu sudah melamar lowongan ini.' );
        }

        // ===  ===  ===  ===  ===  ===  ===  ===  ===  =
        // SIMPAN LAMARAN
        // ===  ===  ===  ===  ===  ===  ===  ===  ===  =
        try {
            $lamaran = Lamaran::create( [
                'lowongan_id'   => $lowongan->id,
                'user_id'       => $user->id,
                'tanggal_lamar' => now(),
                'status'        => 'dikirim',
                'file_cv'       => $cvPath,
                'surat_lamaran' => $surPath,
            ] );
        } catch ( QueryException $e ) {
            // fallback kalau ada unique constraint, dsb.
            return back()->with( 'err', 'Kamu sudah melamar lowongan ini.' );
        }

        // ===  ===  ===  ===  ===  ===  ===  ===  ===  =
        // NOTIFIKASI KE PERUSAHAAN
        // ===  ===  ===  ===  ===  ===  ===  ===  ===  =
        // asumsi: relasi Lowongan -> perusahaan -> user
        if ( $lowongan->perusahaan && $lowongan->perusahaan->user ) {
            $lowongan->perusahaan->user->notify(
                new NewLamaranSubmitted( $lamaran )
            );
        }

        return back()->with( 'ok', 'Lamaran terkirim. Semoga berhasil!' );
    }

    /**
    * Perusahaan mengubah status lamaran ( diproses / diterima / ditolak ).
    */

    public function review( Request $r, Lamaran $lamaran ) {
        abort_if ( !auth()->user() || !auth()->user()->isPerusahaan(), 403 );

        $data = $r->validate( [
            'status' => 'required|in:diproses,diterima,ditolak',
        ] );

        $lamaran->update( $data );

        // kirim notifikasi ke pelamar
        if ( $lamaran->user ) {
            $lamaran->user->notify(
                new LamaranStatusUpdated( $lamaran )
            );
        }

        return back()->with( 'ok', 'Status lamaran diperbarui.' );
    }

    public function indexMyApplications(Request $request)
{
    $user = Auth::user();
    abort_if(!$user || !$user->isPelamar(), 403);

    // query lamaran milik user
    $query = Lamaran::with(['lowongan.perusahaan'])
        ->where('user_id', $user->id);

    // filter status optional
    if ($status = $request->get('status')) {
        $query->where('status', $status);
    }

    // filter judul lowongan optional
    if ($q = $request->get('q')) {
        $query->whereHas('lowongan', function ($qq) use ($q) {
            $qq->where('judul', 'like', '%' . $q . '%');
        });
    }

    $items = $query->orderByDesc('created_at')
        ->paginate(5)
        ->withQueryString();

    return view('pelamar.lamaran.index', [
        'items' => $items,
        'user'  => $user,
    ]);
}

 public function show(Lamaran $lamaran)
    {
        $user = Auth::user();

        // hanya pelamar & hanya boleh lihat lamaran miliknya
        abort_if(!$user || !$user->isPelamar(), 403);
        abort_if($lamaran->user_id !== $user->id, 403);

        $lamaran->load(['lowongan.perusahaan']);

        $lowongan   = $lamaran->lowongan;
        $perusahaan = $lowongan?->perusahaan;

        $isOpen = false;

        if ($lowongan) {
            $deadline = $lowongan->deadline
                ? Carbon::parse($lowongan->deadline)
                : null;

            $isOpen = $lowongan->status === 'published'
                && (!$deadline || $deadline->isFuture());
        }

        return view('pelamar.lamaran.show', [
            'lamaran'    => $lamaran,
            'lowongan'   => $lowongan,
            'perusahaan' => $perusahaan,
            'isOpen'     => $isOpen,
        ]);
    }

}
