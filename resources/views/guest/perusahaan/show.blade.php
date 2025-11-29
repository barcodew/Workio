@extends('layouts.dashboard_pelamar')

@php
    use Illuminate\Support\Str;
    use Illuminate\Support\Facades\Storage;

    $p = $perusahaan;

    $placeholder = asset('images/job1.jpg');
    $logoRaw = $p->logo_path ?? null;

    if ($logoRaw && Str::startsWith($logoRaw, ['http://', 'https://'])) {
        $logo = $logoRaw;
    } elseif ($logoRaw && Storage::disk('public')->exists($logoRaw)) {
        $logo = asset('storage/' . $logoRaw);
    } elseif ($logoRaw && file_exists(public_path($logoRaw))) {
        $logo = asset($logoRaw);
    } else {
        $logo = $placeholder;
    }
@endphp

@section('content')
    {{-- BREADCRUMB --}}
    <div class="page_title_section">
        <div class="page_header">
            <div class="container">
                <div class="row">
                    <div class="col-lg-9 col-md-9 col-12 col-sm-8">
                        <h1>Profil Perusahaan</h1>
                    </div>
                    <div class="col-lg-3 col-md-3 col-12 col-sm-4">
                        <div class="sub_title_section">
                            <ul class="sub_title">
                                <li><a href="{{ url('/dashboard') }}">Home</a>&nbsp;/&nbsp;</li>
                                <li><a href="{{ route('jobs.index') }}">Lowongan</a>&nbsp;/&nbsp;</li>
                                <li>{{ $p->nama_perusahaan ?? 'Perusahaan' }}</li>
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
                {{-- SIDEBAR: Kartu perusahaan --}}
                <div class="col-lg-4 col-md-5 mb-3">
                    <div class="emp_dashboard_sidebar jb_cover jb-card company-card">
                        <div class="company-card-header">
                            <span class="badge-soft badge-soft-light">Profil Perusahaan</span>
                        </div>

                        <div class="text-center company-card-body">
                            <div class="company-avatar-wrap">
                                <img src="{{ $logo }}" alt="Logo perusahaan" class="company-avatar"
                                    onerror="this.onerror=null;this.src='{{ $placeholder }}';">
                            </div>

                            <div class="mt-3">
                                <h4 class="mb-1 company-name">
                                    {{ $p->nama_perusahaan ?? 'Nama Perusahaan' }}
                                </h4>
                                <div class="small-muted mb-1">
                                    {{ $p->bidang_usaha ?? 'Industri tidak diisi' }}
                                </div>

                                @if (!empty($p->kota) || !empty($p->alamat))
                                    <div class="small-muted mt-1 d-inline-flex align-items-center gap-1">
                                        <i class="flaticon-location-pointer"></i>
                                        <span>
                                            {{ $p->kota ?? '' }}{{ $p->kota && $p->alamat ? ' · ' : '' }}{{ $p->alamat ?? '' }}
                                        </span>
                                    </div>
                                @endif
                            </div>
                        </div>

                        <hr class="my-3">

                        <ul class="feedlist company-contact-list">
                            @if (!empty($p->website))
                                <li>
                                    <a href="{{ Str::startsWith($p->website, ['http://', 'https://']) ? $p->website : 'https://' . $p->website }}"
                                        target="_blank">
                                        <i class="fas fa-globe"></i>
                                        <span>{{ $p->website }}</span>
                                    </a>
                                </li>
                            @endif

                            @if (!empty($p->email_kantor))
                                <li>
                                    <a href="mailto:{{ $p->email_kantor }}">
                                        <i class="fas fa-envelope"></i>
                                        <span>{{ $p->email_kantor }}</span>
                                    </a>
                                </li>
                            @endif

                            @if (!empty($p->telepon))
                                <li>
                                    <span>
                                        <i class="fas fa-phone"></i>
                                        <span>{{ $p->telepon }}</span>
                                    </span>
                                </li>
                            @endif

                            @if (!empty($p->linkedin))
                                <li>
                                    <a href="{{ $p->linkedin }}" target="_blank">
                                        <i class="fab fa-linkedin"></i>
                                        <span>LinkedIn</span>
                                    </a>
                                </li>
                            @endif

                            @if (!empty($p->instagram))
                                <li>
                                    <a href="{{ $p->instagram }}" target="_blank">
                                        <i class="fab fa-instagram"></i>
                                        <span>Instagram</span>
                                    </a>
                                </li>
                            @endif
                        </ul>

                        <div class="mt-3 d-grid gap-2 company-card-actions">
                            @if (!empty($p->kota))
                                <a href="{{ route('jobs.index', ['lokasi' => $p->kota]) }}"
                                    class="btn btn-outline-secondary btn-sm w-100">
                                    Cari lowongan di kota ini
                                </a>
                            @endif
                        </div>
                    </div>
                </div>

                {{-- KONTEN KANAN --}}
                <div class="col-lg-8 col-md-7">
                    {{-- Tentang perusahaan --}}
                    <div class="jb-card p-3 mb-3 company-about-card">
                        <h5 class="section-title mb-2">Tentang Perusahaan</h5>
                        <p class="small-muted mb-3">
                            Pelajari profil lengkap dan lowongan kerja dari perusahaan ini.
                        </p>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <ul class="list-unstyled mb-0 small-muted info-list">
                                    <li>
                                        <span class="label">Industri</span>
                                        <span class="value">
                                            {{ $p->bidang_usaha ?? 'Tidak diisi' }}
                                        </span>
                                    </li>
                                    <li>
                                        <span class="label">Jumlah Karyawan</span>
                                        <span class="value">
                                            {{ $p->jumlah_karyawan ?? 'Tidak diisi' }}
                                        </span>
                                    </li>
                                    <li>
                                        <span class="label">Tahun Berdiri</span>
                                        <span class="value">
                                            {{ $p->tahun_berdiri ?? 'Tidak diisi' }}
                                        </span>
                                    </li>
                                </ul>
                            </div>
                            <div class="col-md-6">
                                <ul class="list-unstyled mb-0 small-muted info-list">
                                    <li>
                                        <span class="label">Alamat Kantor</span>
                                        <span class="value">
                                            {{ $p->alamat ?? 'Tidak diisi' }}
                                        </span>
                                    </li>
                                    @if (!empty($p->website))
                                        <li>
                                            <span class="label">Website</span>
                                            <span class="value">
                                                <a href="{{ Str::startsWith($p->website, ['http://', 'https://']) ? $p->website : 'https://' . $p->website }}"
                                                    target="_blank">
                                                    {{ $p->website }}
                                                </a>
                                            </span>
                                        </li>
                                    @endif
                                    @if (!empty($p->email_kantor))
                                        <li>
                                            <span class="label">Email Kantor</span>
                                            <span class="value">
                                                <a href="mailto:{{ $p->email_kantor }}">{{ $p->email_kantor }}</a>
                                            </span>
                                        </li>
                                    @endif
                                </ul>
                            </div>
                        </div>

                        <div class="company-desc-block">
                            <h6 class="mb-2 text-muted">Deskripsi</h6>
                            <div class="company-desc">
                                {!! nl2br(e($p->deskripsi ?? 'Perusahaan belum menambahkan deskripsi.')) !!}
                            </div>
                        </div>
                    </div>

                    {{-- Lowongan aktif perusahaan ini --}}
                    <div class="jb-card p-3" id="lowongan-aktif">
                        <div class="d-flex justify-content-between align-items-center mb-2">
                            <h5 class="section-title mb-0">Lowongan Aktif di Perusahaan Ini</h5>
                            @if ($lowongans->total() > 0)
                                <span class="badge-soft badge-soft-primary">
                                    {{ $lowongans->total() }} lowongan
                                </span>
                            @endif
                        </div>

                        @if ($lowongans->count() === 0)
                            <p class="small-muted mb-0">
                                Belum ada lowongan aktif dari perusahaan ini.
                            </p>
                        @else
                            <div class="list-group list-group-company">
                                @foreach ($lowongans as $l)
                                    <a href="{{ route('jobs.show', $l) }}"
                                        class="list-group-item list-group-item-action company-job-item">
                                        <div class="job-main">
                                            <div class="fw-semibold job-title">{{ $l->judul }}</div>
                                            <div class="small text-muted job-meta">
                                                {{ $l->lokasi ?? 'Lokasi tidak diisi' }}
                                                @if ($l->tipe)
                                                    · {{ $l->tipe }}
                                                @endif
                                                @if ($l->deadline)
                                                    · Tutup:
                                                    {{ \Illuminate\Support\Carbon::parse($l->deadline)->translatedFormat('d M Y') }}
                                                @endif
                                            </div>
                                        </div>
                                        <div class="job-right">
                                            <span class="chip chip-outline">
                                                Lihat Detail
                                            </span>
                                        </div>
                                    </a>
                                @endforeach
                            </div>

                            <div class="mt-3">
                                {{ $lowongans->links('pagination::bootstrap-4') }}
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
        /* ====== CARD PERUSAHAAN (SIDEBAR) ====== */

        .company-card {
            border-radius: 20px;
            box-shadow: 0 16px 40px rgba(15, 23, 42, 0.08);
            overflow: hidden;
            border: none;
            padding: 0;
        }

        .company-card-header {
            padding: 12px 18px;
            background: linear-gradient(135deg, #7c3aed, #ec4899);
            color: #fff;
        }

        .company-card-header .badge-soft-light {
            background: rgba(255, 255, 255, 0.2);
            border-radius: 999px;
            padding: 4px 10px;
            font-size: 11px;
        }

        .company-card-body {
            padding: 18px 18px 10px 18px;
        }

        .company-card hr {
            margin: 0 18px;
            border-color: #f3f4f6;
        }

        .company-card-actions {
            padding: 10px 18px 16px 18px;
        }

        .company-avatar-wrap {
            display: inline-flex;
            padding: 4px;
            border-radius: 26px;
            background: linear-gradient(135deg, #7c3aed, #ec4899);
        }

        .company-avatar {
            width: 112px;
            height: 112px;
            border-radius: 22px;
            object-fit: cover;
            background: #f3f4f6;
        }

        .company-name {
            font-size: 18px;
            font-weight: 600;
        }

        .company-contact-list {
            list-style: none;
            padding: 12px 18px 4px 18px !important;
            margin: 0;
        }

        .company-contact-list li {
            margin-bottom: 8px;
        }

        .company-contact-list a,
        .company-contact-list span {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            font-size: 13px;
            color: #4b5563;
            text-decoration: none;
        }

        .company-contact-list a:hover {
            color: #7c3aed;
        }

        .company-contact-list i {
            width: 16px;
            text-align: center;
        }

        .btn-gradient-primary {
            border: none;
            background: linear-gradient(135deg, #7c3aed, #ec4899);
            color: #fff;
            box-shadow: 0 12px 25px rgba(124, 58, 237, 0.35);
        }

        .btn-gradient-primary:hover {
            color: #fff;
            filter: brightness(1.03);
        }

        /* ====== HEADER KANAN ====== */

        .company-header-card {
            border-radius: 18px;
            border: none;
            box-shadow: 0 14px 35px rgba(15, 23, 42, 0.08);
        }

        .company-logo-mini {
            width: 62px;
            height: 62px;
            border-radius: 16px;
            object-fit: cover;
            background: #f3f4f6;
        }

        .company-chips {
            display: flex;
            flex-wrap: wrap;
            gap: 6px;
            justify-content: flex-end;
        }

        .chip {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 4px 10px;
            font-size: 11px;
            border-radius: 999px;
            background: #eef2ff;
            color: #4c1d95;
        }

        .chip i {
            font-size: 12px;
        }

        .chip-outline {
            background: #ffffff;
            border: 1px solid #e5e7eb;
            color: #4b5563;
        }

        .badge-soft-primary {
            background: #eef2ff;
            color: #4338ca;
            border-radius: 999px;
            padding: 4px 10px;
            font-size: 11px;
        }

        /* ====== CARD TENTANG PERUSAHAAN ====== */

        .company-about-card {
            border-radius: 18px;
            border: none;
            box-shadow: 0 10px 30px rgba(15, 23, 42, 0.06);
        }

        .info-list li {
            margin-bottom: 8px;
        }

        .info-list .label {
            display: block;
            font-size: 11px;
            text-transform: uppercase;
            color: #9ca3af;
            letter-spacing: 0.04em;
        }

        .info-list .value {
            font-size: 13px;
            color: #111827;
        }

        .company-desc-block {
            padding: 10px 12px;
            border-radius: 14px;
            background: #f9fafb;
            border: 1px dashed #e5e7eb;
        }

        .company-desc {
            font-size: 14px;
            color: #374151;
            line-height: 1.6;
        }

        /* ====== LIST LOWONGAN DI PERUSAHAAN ====== */

        .list-group-company {
            border-radius: 14px;
            overflow: hidden;
        }

        .company-job-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-left: none;
            border-right: none;
            border-color: #eef2ff;
            padding-top: 10px;
            padding-bottom: 10px;
        }

        .company-job-item:first-child {
            border-top: 1px solid #eef2ff;
        }

        .company-job-item:last-child {
            border-bottom: 1px solid #eef2ff;
        }

        .company-job-item:hover {
            background: #f9fafb;
        }

        .company-job-item .job-title {
            font-size: 14px;
        }

        .company-job-item .job-meta {
            font-size: 12px;
        }

        .company-job-item .job-right {
            margin-left: 12px;
            flex-shrink: 0;
        }

        @media (max-width: 767.98px) {
            .company-job-item {
                flex-direction: column;
                align-items: flex-start;
            }

            .company-job-item .job-right {
                margin-left: 0;
                margin-top: 6px;
            }
        }
    </style>
@endpush
