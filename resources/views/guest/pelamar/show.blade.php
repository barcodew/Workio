@extends('layouts.dashboard_pelamar')

@php
    use Illuminate\Support\Facades\Storage;
    use Illuminate\Support\Str;

    $u = $pelamar->user;

    // avatar
    $placeholder = asset('images/cmnt1.jpg');
    $fotoRaw = $u->avatar_path ?? null;

    if ($fotoRaw && Str::startsWith($fotoRaw, ['http://', 'https://'])) {
        $avatar = $fotoRaw;
    } elseif ($fotoRaw && Storage::disk('public')->exists($fotoRaw)) {
        $avatar = asset('storage/' . $fotoRaw);
    } elseif ($fotoRaw && file_exists(public_path($fotoRaw))) {
        $avatar = asset($fotoRaw);
    } else {
        $avatar = $placeholder;
    }

    // umur
    $umur = $pelamar->tanggal_lahir
        ? $pelamar->tanggal_lahir->age . ' tahun'
        : null;

    // progress profil
    $progress = $pelamar->profile_progress ?? 0;

    // list pendidikan & kerja
    $pendidikanList = $pelamar->pendidikan
        ? (is_array($pelamar->pendidikan) ? $pelamar->pendidikan : [$pelamar->pendidikan])
        : [];

    $workList = $pelamar->riwayat_pekerjaan
        ? (is_array($pelamar->riwayat_pekerjaan) ? $pelamar->riwayat_pekerjaan : [$pelamar->riwayat_pekerjaan])
        : [];
@endphp

@section('content')
    {{-- BREADCRUMB --}}
    <div class="page_title_section">
        <div class="page_header">
            <div class="container">
                <div class="row">
                    <div class="col-lg-9 col-md-9 col-12 col-sm-8">
                        <h1>Profil Pelamar</h1>
                        <p class="small-muted">
                            Detail lengkap informasi pelamar dan riwayat lamaran.
                        </p>
                    </div>
                    <div class="col-lg-3 col-md-3 col-12 col-sm-4">
                        <div class="sub_title_section">
                            <ul class="sub_title">
                                <li><a href="{{ url('/dashboard') }}">Dashboard</a>&nbsp;/&nbsp;</li>
                                <li><a href="{{ route('perusahaan.lowongan.index') }}">Lowongan</a>&nbsp;/&nbsp;</li>
                                <li>{{ $u->name }}</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- BODY --}}
    <div class="candidate_dashboard_wrapper jb_cover" style="padding-top:24px;">
        <div class="container">
            <div class="row">
                {{-- SIDEBAR KIRI: kartu pelamar --}}
                <div class="col-lg-4 col-md-5 mb-3">
                    <div class="emp_dashboard_sidebar jb_cover jb-card candidate-card">
                        <div class="candidate-card-header">
                            <span class="badge-soft badge-soft-light">Profil Pelamar</span>
                        </div>

                        <div class="text-center candidate-card-body">
                            <div class="candidate-avatar-wrap">
                                <img src="{{ $avatar }}" alt="Foto pelamar" class="candidate-avatar"
                                     onerror="this.onerror=null;this.src='{{ $placeholder }}';">
                            </div>

                            <div class="mt-3">
                                <h4 class="mb-1 candidate-name">{{ $u->name }}</h4>
                                @if ($umur)
                                    <div class="small-muted">
                                        Lahir: {{ optional($pelamar->tanggal_lahir)->format('d M Y') }}
                                        ({{ $umur }})
                                    </div>
                                @endif
                            </div>
                        </div>

                        <hr class="my-3">

                        <div class="candidate-card-body">
                            <ul class="list-unstyled candidate-info small-muted mb-2">
                                @if (!empty($pelamar->alamat))
                                    <li>
                                        <i class="flaticon-location-pointer"></i>
                                        {{ $pelamar->alamat }}
                                    </li>
                                @endif
                                @if (!empty($u->email))
                                    <li>
                                        <i class="fas fa-envelope"></i>
                                        <a href="mailto:{{ $u->email }}">{{ $u->email }}</a>
                                    </li>
                                @endif
                                @if (!empty($pelamar->telepon))
                                    <li>
                                        <i class="fas fa-phone"></i>
                                        {{ $pelamar->telepon }}
                                    </li>
                                @endif
                            </ul>

                            <div class="mt-3">
                                <div class="d-flex justify-content-between align-items-center mb-1">
                                    <span class="small-muted">Kelengkapan Profil</span>
                                    <span class="small-muted">{{ $progress }}%</span>
                                </div>
                                <div class="progress jb_cover" style="height:8px;border-radius:999px;">
                                    <div class="progress-bar"
                                         role="progressbar"
                                         style="width: {{ $progress }}%; background: linear-gradient(135deg,#7c3aed,#ec4899); border-radius:999px;">
                                    </div>
                                </div>
                            </div>

                            @if ($pelamar->cv_path)
                                <div class="mt-3">
                                    <span class="small-muted d-block mb-1">Curriculum Vitae</span>
                                    <a href="{{ Storage::disk('public')->url($pelamar->cv_path) }}"
                                       target="_blank"
                                       class="btn btn-outline-secondary btn-sm w-100">
                                        Lihat / Unduh CV
                                    </a>
                                </div>
                            @endif

                            @php
                                $skills = $pelamar->normalized_skills ?? [];
                            @endphp
                            @if (count($skills))
                                <div class="mt-3">
                                    <span class="small-muted d-block mb-1">Keterampilan</span>
                                    <div class="skill-chips">
                                        @foreach ($skills as $skill)
                                            <span class="chip">{{ strtoupper($skill) }}</span>
                                        @endforeach
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>

                {{-- KONTEN KANAN --}}
                <div class="col-lg-8 col-md-7">
                    {{-- TENTANG PELAMAR --}}
                    <div class="jb-card p-3 mb-3 candidate-about-card">
                        <h5 class="section-title mb-2">Tentang Pelamar</h5>
                        <p class="small-muted mb-3">
                            Informasi data pribadi, pendidikan, dan pengalaman kerja pelamar.
                        </p>

                        <div class="row">
                            <div class="col-md-6">
                                <ul class="list-unstyled small-muted info-list">
                                    <li>
                                        <span class="label">Nama Lengkap</span>
                                        <span class="value">{{ $u->name }}</span>
                                    </li>
                                    @if ($umur)
                                        <li>
                                            <span class="label">Tanggal Lahir</span>
                                            <span class="value">
                                                {{ optional($pelamar->tanggal_lahir)->format('d M Y') }}
                                                ({{ $umur }})
                                            </span>
                                        </li>
                                    @endif
                                    @if (!empty($pelamar->telepon))
                                        <li>
                                            <span class="label">Telepon</span>
                                            <span class="value">{{ $pelamar->telepon }}</span>
                                        </li>
                                    @endif
                                    @if (!empty($u->email))
                                        <li>
                                            <span class="label">Email</span>
                                            <span class="value">{{ $u->email }}</span>
                                        </li>
                                    @endif
                                </ul>
                            </div>
                            <div class="col-md-6">
                                <ul class="list-unstyled small-muted info-list">
                                    @if (!empty($pelamar->alamat))
                                        <li>
                                            <span class="label">Alamat</span>
                                            <span class="value">{{ $pelamar->alamat }}</span>
                                        </li>
                                    @endif
                                </ul>
                            </div>
                        </div>
                    </div>

                    {{-- RIWAYAT PENDIDIKAN & PEKERJAAN --}}
                    <div class="jb-card p-3 mb-3 candidate-about-card">
                        <div class="row">
                            <div class="col-md-6">
                                <h5 class="section-title mb-2">Riwayat Pendidikan</h5>
                                @if (count($pendidikanList))
                                    <ul class="list-unstyled small-muted mb-0">
                                        @foreach ($pendidikanList as $pItem)
                                            <li>• {{ $pItem }}</li>
                                        @endforeach
                                    </ul>
                                @else
                                    <p class="small-muted mb-0">Belum ada riwayat pendidikan yang diisi.</p>
                                @endif
                            </div>
                            <div class="col-md-6">
                                <h5 class="section-title mb-2">Riwayat Pekerjaan</h5>
                                @if (count($workList))
                                    <ul class="list-unstyled small-muted mb-0">
                                        @foreach ($workList as $w)
                                            <li>• {{ $w }}</li>
                                        @endforeach
                                    </ul>
                                @else
                                    <p class="small-muted mb-0">Belum ada riwayat pekerjaan yang diisi.</p>
                                @endif
                            </div>
                        </div>
                    </div>

                    {{-- RIWAYAT LAMARAN --}}
                    <div class="jb-card p-3 candidate-about-card">
                        <div class="d-flex justify-content-between align-items-center mb-2">
                            <h5 class="section-title mb-0">Riwayat Lamaran</h5>
                            <span class="badge-soft badge-soft-primary">
                                {{ $lamarans->count() }} lamaran
                            </span>
                        </div>

                        @if ($lamarans->isEmpty())
                            <p class="small-muted mb-0">Belum ada lamaran yang dibuat pelamar ini.</p>
                        @else
                            <div class="table-responsive">
                                <table class="table table-sm mb-0 align-middle">
                                    <thead>
                                        <tr>
                                            <th>Lowongan</th>
                                            <th>Perusahaan</th>
                                            <th>Lokasi</th>
                                            <th>Tanggal Lamar</th>
                                            <th class="text-center">Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($lamarans as $lamaran)
                                            @php
                                                $job = $lamaran->lowongan;
                                                $comp = $job?->perusahaan;
                                                $statusKey = strtolower($lamaran->status ?? '');
                                            @endphp
                                            <tr>
                                                <td>
                                                    @if ($job)
                                                        <a href="{{ route('jobs.show', $job) }}">{{ $job->judul }}</a>
                                                    @else
                                                        <span class="text-muted">Lowongan dihapus</span>
                                                    @endif
                                                </td>
                                                <td>{{ $comp->nama_perusahaan ?? '-' }}</td>
                                                <td>{{ $job->lokasi ?? '-' }}</td>
                                                <td>{{ optional($lamaran->tanggal_lamar)->format('d M Y') }}</td>
                                                <td class="text-center">
                                                    <span class="status-chip status-{{ $statusKey }}">
                                                        {{ ucfirst($lamaran->status) }}
                                                    </span>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('styles')
    <style>
        .small-muted {
            font-size: 12px;
            color: #6b7280;
        }

        /* ===== CARD KIRI (PELAMAR) ===== */
        .candidate-card {
            border-radius: 20px;
            box-shadow: 0 16px 40px rgba(15, 23, 42, 0.08);
            overflow: hidden;
            border: none;
            padding: 0;
        }
        .candidate-card-header {
            padding: 12px 18px;
            background: linear-gradient(135deg, #7c3aed, #ec4899);
            color: #fff;
        }
        .candidate-card-header .badge-soft-light {
            background: rgba(255, 255, 255, 0.2);
            border-radius: 999px;
            padding: 4px 10px;
            font-size: 11px;
        }
        .candidate-card-body {
            padding: 18px;
        }

        .candidate-avatar-wrap {
            display: inline-flex;
            padding: 4px;
            border-radius: 26px;
            background: linear-gradient(135deg, #7c3aed, #ec4899);
        }

        /* FOTO DIPERKECIL */
        .candidate-avatar {
            width: 190px;
            height: 230px;
            border-radius: 18px;
            object-fit: cover;
            background: #f3f4f6;
        }

        .candidate-name {
            font-size: 18px;
            font-weight: 600;
        }

        .candidate-info li {
            margin-bottom: 6px;
        }
        .candidate-info i {
            width: 14px;
            margin-right: 6px;
        }

        .skill-chips {
            display: flex;
            flex-wrap: wrap;
            gap: 6px;
        }
        .chip {
            display: inline-flex;
            align-items: center;
            padding: 3px 8px;
            border-radius: 999px;
            font-size: 11px;
            background: #eef2ff;
            color: #4c1d95;
        }

        /* ===== CARD KANAN ===== */
        .candidate-about-card {
            border-radius: 18px;
            border: none;
            box-shadow: 0 10px 30px rgba(15, 23, 42, 0.06);
        }
        .section-title {
            font-size: 15px;
            font-weight: 600;
        }
        .info-list li {
            margin-bottom: 8px;
        }
        .info-list .label {
            display: block;
            font-size: 11px;
            text-transform: uppercase;
            color: #9ca3af;
            letter-spacing: .04em;
        }
        .info-list .value {
            font-size: 13px;
            color: #111827;
        }

        .badge-soft-primary {
            background: #eef2ff;
            color: #4338ca;
            border-radius: 999px;
            padding: 4px 10px;
            font-size: 11px;
        }

        /* ===== BADGE STATUS RIWAYAT LAMARAN ===== */
        .status-chip {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            padding: 3px 12px;
            border-radius: 999px;
            font-size: 11px;
            font-weight: 500;
            letter-spacing: .02em;
            text-transform: capitalize;
            border: 1px solid transparent;
        }
        /* dikirim / diproses -> biru */
        .status-dikirim,
        .status-diproses {
            background: #eff6ff;
            color: #1d4ed8;
            border-color: #bfdbfe;
        }
        /* diterima -> hijau */
        .status-diterima {
            background: #ecfdf3;
            color: #15803d;
            border-color: #bbf7d0;
        }
        /* ditolak -> merah */
        .status-ditolak {
            background: #fef2f2;
            color: #b91c1c;
            border-color: #fecaca;
        }

        @media (max-width: 767.98px) {
            .candidate-avatar {
                width: 160px;
                height: 200px;
            }
        }
    </style>
@endpush
