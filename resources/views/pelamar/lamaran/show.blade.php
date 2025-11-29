{{-- resources/views/pelamar/lamaran/show.blade.php --}}
@extends('layouts.dashboard_pelamar')
@section('title', 'Detail Lamaran')

@php
    use Illuminate\Support\Carbon;

    /** @var \App\Models\Lamaran $lamaran */
    $job = $lowongan;
    $comp = $perusahaan;
    $st = strtolower($lamaran->status ?? 'dikirim');

    $map = [
        'dikirim' => ['secondary', 'fas fa-paper-plane', 'Lamaran telah dikirim'],
        'diproses' => ['warning', 'fas fa-spinner fa-spin', 'Lamaran sedang ditinjau'],
        'diterima' => ['success', 'fas fa-check-circle', 'Selamat! Lamaran diterima'],
        'ditolak' => ['danger', 'fas fa-times-circle', 'Lamaran tidak lolos'],
    ];
    [$color, $icon, $labelHelp] = $map[$st] ?? ['secondary', 'fas fa-info-circle', 'Status tidak diketahui'];

    $tglLamar = $lamaran->tanggal_lamar ?: $lamaran->created_at;
    $tglLamarFmt = optional($tglLamar)->format('d M Y H:i');
    $tglLamarDiff = optional($tglLamar)->diffForHumans();

    $deadline = $job?->deadline ? Carbon::parse($job->deadline) : null;
@endphp

@section('content')
    {{-- TITLE / BREADCRUMB --}}
    <div class="page_title_section">
        <div class="page_header">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-xl-9 col-lg-7 col-md-7 col-12">
                        <h1>Detail Lamaran</h1>
                        <div class="small" style="opacity:.9">
                            Informasi lengkap lamaran kamu untuk lowongan ini.
                        </div>
                    </div>
                    <div class="col-xl-3 col-lg-5 col-md-5 col-12">
                        <div class="sub_title_section">
                            <ul class="sub_title">
                                <li><a href="{{ url('/dashboard') }}">Home</a>&nbsp;/&nbsp;</li>
                                <li><a href="{{ route('pelamar.dashboard') }}">Dasbor Pelamar</a>&nbsp;/&nbsp;</li>
                                <li><a href="{{ route('pelamar.lamaran.index') }}">Riwayat Lamaran</a>&nbsp;/&nbsp;</li>
                                <li>Detail Lamaran</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- BODY --}}
    <div class="job_filter_listing_wrapper jb_cover job-section">
        <div class="container">
            <div class="lamaran-detail-card jb_cover">

                {{-- STATUS BAR --}}
                <div class="lamaran-status-bar">
                    <div>
                        <div class="label">Status Lamaran</div>
                        <div>
                            <span class="badge-status badge-soft-{{ $color }}" title="{{ $labelHelp }}">
                                <i class="{{ $icon }}"></i> {{ ucfirst($st) }}
                            </span>
                        </div>
                        <div class="small text-muted mt-1">
                            Dikirim: {{ $tglLamarFmt }} ({{ $tglLamarDiff }})
                        </div>
                    </div>

                    @if ($job)
                        <div class="text-right text-md-right mt-3 mt-md-0">
                            <div class="label">Status Lowongan</div>
                            @if ($isOpen)
                                <span class="lowongan-pill lowongan-pill-open">
                                    Lowongan masih dibuka
                                </span>
                                @if ($deadline)
                                    <div class="small text-muted mt-1">
                                        Batas akhir: {{ $deadline->format('d M Y') }}
                                    </div>
                                @endif
                            @else
                                <span class="lowongan-pill lowongan-pill-closed">
                                    Lowongan sudah ditutup
                                </span>
                                @if ($deadline)
                                    <div class="small text-muted mt-1">
                                        Tutup: {{ $deadline->format('d M Y') }}
                                    </div>
                                @endif
                            @endif
                        </div>
                    @else
                        <div class="text-right text-md-right mt-3 mt-md-0">
                            <span class="lowongan-pill lowongan-pill-closed">
                                Lowongan tidak lagi tersedia
                            </span>
                        </div>
                    @endif
                </div>

                {{-- INFO LOWONGAN --}}
                <div class="lamaran-section">
                    <h4 class="section-title mb-2">Informasi Lowongan</h4>

                    @if ($job)
                        <div class="job-header">
                            <div>
                                <h5 class="mb-1">{{ $job->judul }}</h5>
                                <div class="small text-muted">
                                    {{ $comp->nama_perusahaan ?? 'Perusahaan' }} —
                                    {{ $job->lokasi ?? 'Lokasi tidak diisi' }}
                                </div>
                            </div>
                            @if ($isOpen)
                                <a href="{{ route('jobs.show', $job) }}" class="btn btn-outline-primary btn-xs">
                                    Lihat Halaman Lowongan
                                </a>
                            @endif
                        </div>

                        <div class="row mt-3">
                            <div class="col-md-6">
                                <ul class="list-unstyled small text-muted mb-0">
                                    <li><strong>Tipe Pekerjaan:</strong> {{ $job->tipe_pekerjaan ?? '—' }}</li>
                                    <li><strong>Deadline:</strong>
                                        {{ $deadline ? $deadline->format('d M Y') : '—' }}
                                    </li>
                                </ul>
                            </div>
                            <div class="col-md-6">
                                <ul class="list-unstyled small text-muted mb-0">
                                    <li><strong>Perusahaan:</strong> {{ $comp->nama_perusahaan ?? '—' }}</li>
                                    <li><strong>Alamat:</strong> {{ $comp->alamat ?? '—' }}</li>
                                </ul>
                            </div>
                        </div>

                        <div class="job-desc mt-3">
                            <h6 class="text-muted mb-1">Deskripsi Singkat</h6>
                            <p class="small mb-0">
                                {!! nl2br(e(Str::limit($job->deskripsi ?? 'Perusahaan belum menambahkan deskripsi.', 500))) !!}
                            </p>
                        </div>
                    @else
                        <p class="text-muted mb-0">
                            Data lowongan sudah tidak tersedia di sistem, namun riwayat lamaran kamu tetap tersimpan.
                        </p>
                    @endif
                </div>

                {{-- DOKUMEN & CATATAN --}}
                <div class="lamaran-section">
                    <h4 class="section-title mb-2">Dokumen & Informasi Lamaran</h4>

                    <ul class="list-unstyled small text-muted mb-2">
                        <li>
                            <strong>CV yang digunakan:</strong>
                            @if ($lamaran->file_cv)
                                <a href="{{ asset('storage/' . $lamaran->file_cv) }}" target="_blank">
                                    Lihat CV Lamaran
                                </a>
                            @else
                                —
                            @endif
                        </li>
                        <li>
                            <strong>Surat lamaran:</strong>
                            @if ($lamaran->surat_lamaran)
                                <a href="{{ asset('storage/' . $lamaran->surat_lamaran) }}" target="_blank">
                                    Lihat Surat Lamaran
                                </a>
                            @else
                                —
                            @endif
                        </li>
                    </ul>

                    <p class="small text-muted mb-0">
                        Simpan email dan file asli lamaran kamu untuk arsip pribadi, terutama jika status lamaran
                        sudah diterima atau ada undangan wawancara.
                    </p>
                </div>

                <div class="mt-3">
                    <a href="{{ route('pelamar.lamaran.index') }}" class="btn btn-light btn-xs">
                        &larr; Kembali ke Riwayat Lamaran
                    </a>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('styles')
    <style>
        .lamaran-detail-card {
            border-radius: 20px;
            background: #ffffff;
            box-shadow: 0 18px 45px rgba(15, 23, 42, .09);
            padding: 18px 22px 22px;
        }

        .lamaran-status-bar {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between;
            gap: 14px;
            padding-bottom: 14px;
            border-bottom: 1px dashed #e5e7eb;
            margin-bottom: 16px;
        }

        .lamaran-status-bar .label {
            font-size: 11px;
            text-transform: uppercase;
            color: #9ca3af;
            letter-spacing: .08em;
            margin-bottom: 4px;
        }

        .lowongan-pill {
            display: inline-flex;
            padding: 4px 10px;
            border-radius: 999px;
            font-size: 11px;
            font-weight: 500;
        }

        .lowongan-pill-open {
            background: #ecfdf3;
            color: #166534;
        }

        .lowongan-pill-closed {
            background: #f3f4f6;
            color: #4b5563;
        }

        .lamaran-section {
            margin-top: 12px;
            padding-top: 10px;
        }

        .lamaran-section+.lamaran-section {
            border-top: 1px dashed #e5e7eb;
        }

        .section-title {
            font-size: 15px;
            font-weight: 600;
        }

        .job-header {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between;
            align-items: center;
            gap: 10px;
        }

        .job-desc {
            font-size: 13px;
        }

        @media (max-width: 767.98px) {
            .lamaran-detail-card {
                padding: 14px 14px 18px;
            }

            .lamaran-status-bar {
                flex-direction: column;
                align-items: flex-start;
            }

            .job-header {
                flex-direction: column;
                align-items: flex-start;
            }

            .job-header .btn {
                width: 100%;
                text-align: center;
            }
        }
    </style>
@endpush
