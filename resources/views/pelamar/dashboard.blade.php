@extends('layouts.dashboard_pelamar')

@php
    /** @var \App\Models\User $user */
    $user = auth()->user();
    $pel = $pelamar ?? ($user?->pelamar ?? null);

    $avatar = asset('images/job1.jpg');
    if ($user && $user->avatar_path) {
        $avatar = asset('storage/' . ltrim($user->avatar_path, '/'));
    }

    // progress dari accessor model Pelamar
    $progress = $pel?->profile_progress ?? 0;

    // Statistik (pastikan controller mengirim $stat)
    $stat = $stat ?? [
        'total_lamaran' => 0,
        'diproses' => 0,
        'diterima' => 0,
        'ditolak' => 0,
    ];

    // Koleksi (controller sebaiknya sudah kirim)
    $lamaranTerakhir = $lamaranTerakhir ?? collect();
    $rekomendasi = $rekomendasi ?? collect();

    // Batas item yang tampil di dashboard
    $maxLamaran = 5;
    $maxRekom = 5;

    $showMoreLamaran = $lamaranTerakhir->count() > $maxLamaran;
    $showMoreRekom = $rekomendasi->count() > $maxRekom;
@endphp

@section('content')
    {{-- TITLE / BREADCRUMB --}}
    <div class="page_title_section">
        <div class="page_header">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-xl-9 col-lg-7 col-md-7 col-12">
                        <h1>Dasbor Pelamar</h1>
                    </div>
                    <div class="col-xl-3 col-lg-5 col-md-5 col-12">
                        <div class="sub_title_section">
                            <ul class="sub_title">
                                <li><a href="{{ url('/dashboard') }}">Home</a>&nbsp;/&nbsp;</li>
                                <li>Dasbor Pelamar</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- DASHBOARD WRAPPER --}}
    <div class="candidate_dashboard_wrapper jb_cover">
        <div class="container">
            <div class="row">
                {{-- SIDEBAR KIRI --}}
                <div class="col-lg-3 col-md-12 mb-4 mb-lg-0">
                    <div class="emp_dashboard_sidebar jb_cover">
                        <img src="{{ $avatar }}" class="img-responsive avatar-rounded" alt="profile" />
                        <div class="emp_web_profile candidate_web_profile jb_cover">
                            <h4>{{ $user->name }}</h4>
                            <p>{{ $user->email }}</p>

                            {{-- PROGRESS PROFIL --}}
                            <div class="skills jb_cover">
                                <div class="skill-item jb_cover">
                                    <h6>
                                        Profil
                                        <span>{{ $progress }}%</span>
                                    </h6>
                                    <div class="skills-progress">
                                        <span style="width: {{ $progress }}%"></span>
                                    </div>
                                </div>
                            </div>

                            <div class="mt-3 d-grid gap-2">
                                <a href="{{ route('pelamar.profil.edit') }}" class="btn btn-outline-primary btn-sm w-100">
                                    Lengkapi Profil
                                </a>
                                <a href="{{ route('jobs.index') }}" class="btn btn-outline-secondary btn-sm w-100">
                                    Cari Lowongan
                                </a>
                            </div>
                        </div>

                        <div class="emp_follow_link jb_cover mt-3">
                            <ul class="feedlist">
                                <li>
                                    <a href="{{ route('pelamar.dashboard') }}" class="link_active">
                                        <i class="fas fa-tachometer-alt"></i> Dashboard
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ route('pelamar.profil.edit') }}">
                                        <i class="fas fa-edit"></i> Edit Profil
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ route('jobs.index') }}">
                                        <i class="fas fa-search"></i> Cari Lowongan
                                    </a>
                                </li>
                            </ul>
                            <ul class="feedlist logout_link jb_cover">
                                <li>
                                    <a href="{{ route('logout') }}"
                                        onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                        <i class="fas fa-power-off"></i> Keluar
                                    </a>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>

                {{-- KONTEN KANAN --}}
                <div class="col-lg-9 col-md-12">
                    <div class="row">

                        {{-- ROW 1: SUMMARY BAR (INFO SINGKAT + KPI) --}}
                        <div class="col-12 mb-4">
                            <div class="job_listing_left_fullwidth jb_cover">
                                <div class="row align-items-center">
                                    {{-- Info user --}}
                                    <div class="col-md-7 col-sm-12">
                                        <div class="d-flex align-items-center summary-user">
                                            <img src="{{ $avatar }}" alt="mini" class="summary-user-avatar">
                                            <div>
                                                <h4 class="mb-1">{{ $user->name }}</h4>
                                                <ul class="list-unstyled mb-0" style="color:#6b7587;">
                                                    <li>
                                                        <i class="fas fa-envelope"></i>&nbsp;
                                                        {{ $user->email }}
                                                    </li>
                                                    <li>
                                                        <i class="flaticon-location-pointer"></i>&nbsp;
                                                        {{ $pel->alamat ?? '—' }}
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>

                                    </div>

                                    {{-- Tombol edit --}}
                                    <div class="col-md-5 col-sm-12 mt-3 mt-md-0 text-md-right">
                                        <div class="jp_job_post_right_btn_wrapper jb_cover">
                                            <div class="header_btn search_btn jb_cover">
                                                <a href="{{ route('pelamar.profil.edit') }}">Lihat / Edit Profil</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                {{-- KPI ROW --}}
                                <div class="stats-grid mt-3">
                                    <div class="stat-card">
                                        <div class="label">Total Lamaran</div>
                                        <div class="num">{{ $stat['total_lamaran'] }}</div>
                                    </div>
                                    <div class="stat-card">
                                        <div class="label">Diproses</div>
                                        <div class="num">{{ $stat['diproses'] }}</div>
                                    </div>
                                    <div class="stat-card">
                                        <div class="label">Diterima</div>
                                        <div class="num">{{ $stat['diterima'] }}</div>
                                    </div>
                                    <div class="stat-card">
                                        <div class="label">Ditolak</div>
                                        <div class="num">{{ $stat['ditolak'] }}</div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- ROW 2: KIRI = INFO, KANAN = LAMARAN --}}
                        <div class="col-lg-5 col-md-12 mb-4">
                            {{-- INFORMASI DASAR --}}
                            <div class="job_filter_category_sidebar jb_cover h-100">
                                <div class="job_filter_sidebar_heading jb_cover">
                                    <h1>Informasi Dasar</h1>
                                </div>
                                <div class="job_overview_header jb_cover">
                                    <div class="jp_listing_overview_list_main_wrapper jb_cover">
                                        <div class="jp_listing_list_icon">
                                            <i class="fas fa-phone"></i>
                                        </div>
                                        <div class="jp_listing_list_icon_cont_wrapper">
                                            <ul>
                                                <li>Telepon:</li>
                                                <li>{{ $pel->telepon ?? '—' }}</li>
                                            </ul>
                                        </div>
                                    </div>

                                    <div class="jp_listing_overview_list_main_wrapper jb_cover">
                                        <div class="jp_listing_list_icon">
                                            <i class="fas fa-envelope"></i>
                                        </div>
                                        <div class="jp_listing_list_icon_cont_wrapper">
                                            <ul>
                                                <li>Email:</li>
                                                <li>
                                                    <a href="mailto:{{ $user->email }}">
                                                        {{ $user->email }}
                                                    </a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>

                                    <div class="jp_listing_overview_list_main_wrapper jb_cover">
                                        <div class="jp_listing_list_icon">
                                            <i class="flaticon-location-pointer"></i>
                                        </div>
                                        <div class="jp_listing_list_icon_cont_wrapper">
                                            <ul>
                                                <li>Alamat:</li>
                                                <li>{{ $pel->alamat ?? '—' }}</li>
                                            </ul>
                                        </div>
                                    </div>

                                    <div class="jp_listing_overview_list_main_wrapper jb_cover">
                                        <div class="jp_listing_list_icon">
                                            <i class="fas fa-file-alt"></i>
                                        </div>
                                        <div class="jp_listing_list_icon_cont_wrapper">
                                            <ul>
                                                <li>CV:</li>
                                                <li>
                                                    @if (!empty($pel?->cv_path))
                                                        <a href="{{ asset('storage/' . $pel->cv_path) }}" target="_blank">
                                                            Lihat CV
                                                        </a>
                                                    @else
                                                        —
                                                    @endif
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- KANAN: LAMARAN TERAKHIR --}}
                        <div class="col-lg-7 col-md-12 mb-4">
                            <div class="job_filter_category_sidebar jb_cover h-100">
                                <div class="job_filter_sidebar_heading jb_cover">
                                    <h1>Lamaran Terakhir</h1>
                                </div>
                                <div class="job_overview_header jb_cover p-0">
                                    <div class="table-responsive">
                                        <table class="table mb-0">
                                            <thead>
                                                <tr>
                                                    <th>Lowongan</th>
                                                    <th>Perusahaan</th>
                                                    <th>Status</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @forelse($lamaranTerakhir->take($maxLamaran) as $a)
                                                    <tr>
                                                        <td>{{ $a->lowongan->judul ?? '-' }}</td>
                                                        <td>{{ $a->lowongan->perusahaan->nama_perusahaan ?? '-' }}</td>
                                                        @php
                                                            $st = strtolower($a->status);
                                                            $map = [
                                                                'dikirim' => ['secondary', 'fas fa-paper-plane'],
                                                                'diproses' => ['warning', 'fas fa-spinner fa-spin'],
                                                                'diterima' => ['success', 'fas fa-check'],
                                                                'ditolak' => ['danger', 'fas fa-times'],
                                                            ];
                                                            [$color, $icon] = $map[$st] ?? [
                                                                'secondary',
                                                                'fas fa-info-circle',
                                                            ];
                                                        @endphp
                                                        <td>
                                                            <span class="badge-status badge-soft-{{ $color }}">
                                                                <i class="{{ $icon }}"></i>
                                                                {{ ucfirst($st) }}
                                                            </span>
                                                        </td>
                                                    </tr>
                                                @empty
                                                    <tr>
                                                        <td colspan="3" class="text-center text-muted p-4">
                                                            Kamu belum melamar pekerjaan.
                                                        </td>
                                                    </tr>
                                                @endforelse

                                                @if ($showMoreLamaran)
                                                    <tr>
                                                        <td colspan="3" class="text-right">
                                                            <a href="{{ route('pelamar.lamaran.index') }}"
                                                                class="btn btn-sm btn-outline-primary">
                                                                Lihat semua lamaran
                                                            </a>
                                                        </td>
                                                    </tr>
                                                @endif

                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- ROW 3: REKOMENDASI FULL WIDTH --}}
                        <div class="col-12">
                            <div class="job_filter_category_sidebar jb_cover">
                                <div class="job_filter_sidebar_heading jb_cover">
                                    <h1>Rekomendasi Terbaru</h1>
                                </div>
                                <div class="job_overview_header jb_cover p-0">
                                    <ul class="list-group list-group-flush">
                                        @forelse($rekomendasi->take($maxRekom) as $l)
                                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                                <div>
                                                    <div class="fw-semibold">{{ $l->judul }}</div>
                                                    <div class="small text-muted">
                                                        {{ $l->perusahaan->nama_perusahaan ?? '-' }} —
                                                        {{ $l->lokasi ?? '—' }}
                                                    </div>
                                                </div>
                                                <a href="{{ route('jobs.index', ['q' => $l->judul]) }}"
                                                    class="btn btn-sm btn-outline-primary">
                                                    Lihat
                                                </a>
                                            </li>
                                        @empty
                                            <li class="list-group-item text-muted">
                                                Belum ada rekomendasi.
                                            </li>
                                        @endforelse

                                        {{-- @if ($showMoreRekom)
                                            <li class="list-group-item text-right">
                                                <a href="{{ route('jobs.index') }}"
                                                   class="btn btn-sm btn-outline-primary">
                                                    Lihat semua rekomendasi
                                                </a>
                                            </li>
                                        @endif --}}
                                    </ul>
                                </div>
                            </div>
                        </div>

                    </div> {{-- /row --}}
                </div>
                {{-- /KONTEN KANAN --}}
            </div>
        </div>
    </div>
@endsection
@push('styles')
    <style>
        .summary-user-avatar{
            width:64px;
            height:64px;
            border-radius:8px;
            object-fit:cover;
            margin-right:14px;  
        }

        @media (max-width: 767.98px){
            .summary-user-avatar{
                width:56px;
                height:56px;
                margin-right:10px;
            }
        }
    </style>
@endpush
