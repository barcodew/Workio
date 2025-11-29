{{-- resources/views/pelamar/lamaran/index.blade.php --}}
@extends('layouts.dashboard_pelamar')
@section('title', 'Riwayat Lamaran')

@section('content')
    {{-- TITLE / BREADCRUMB --}}
    <div class="page_title_section">
        <div class="page_header">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-xl-9 col-lg-7 col-md-7 col-12">
                        <h1>Riwayat Lamaran</h1>
                        <div class="small" style="opacity:.9">
                            Semua lamaran yang pernah kamu kirim melalui WORKIO.
                        </div>
                    </div>
                    <div class="col-xl-3 col-lg-5 col-md-5 col-12">
                        <div class="sub_title_section">
                            <ul class="sub_title">
                                <li><a href="{{ url('/dashboard') }}">Home</a>&nbsp;/&nbsp;</li>
                                <li><a href="{{ route('pelamar.dashboard') }}">Dasbor Pelamar</a>&nbsp;/&nbsp;</li>
                                <li>Riwayat Lamaran</li>
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

            {{-- CARD UTAMA --}}
            <div class="riwayat-card jb_cover">

                {{-- HEADER CARD + TOOLBAR --}}
                <div class="riwayat-header">
                    <div>
                        <h4 class="mb-1">Daftar Lamaran Kamu</h4>
                        <p class="text-muted mb-0" style="font-size:13px;">
                            {{ $items->total() }} lamaran ditemukan.
                        </p>
                    </div>

                    <form class="toolbar" method="get">
                        <div class="inputs">
                            <input type="text"
                                   name="q"
                                   class="form-control"
                                   placeholder="Cari judul lowongan..."
                                   value="{{ request('q') }}">

                            <select name="status" class="form-select">
                                <option value="">Semua status</option>
                                @foreach (['dikirim','diproses','diterima','ditolak'] as $st)
                                    <option value="{{ $st }}" @selected(request('status') === $st)>
                                        {{ ucfirst($st) }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="actions">
                            <button class="btn btn-outline-purple btn-xs" type="submit">
                                <i class="fas fa-filter me-1"></i> Terapkan
                            </button>
                            <a href="{{ route('pelamar.lamaran.index') }}" class="btn btn-light btn-xs">
                                Reset
                            </a>
                        </div>
                    </form>
                </div>

                {{-- TABEL RIWAYAT --}}
                <div class="table-wrap">
                    <div class="table-responsive">
                        <table class="table align-middle pretty-table mb-0 riwayat-table">
                            <thead>
                            <tr>
                                <th>Lowongan</th>
                                <th>Perusahaan</th>
                                <th>Lokasi</th>
                                <th>Tanggal Lamar</th>
                                <th>Status</th>
                            </tr>
                            </thead>
                            <tbody>
                            @forelse($items as $a)
                                @php
                                    $job   = $a->lowongan;
                                    $comp  = $job?->perusahaan;
                                    $st    = strtolower($a->status);
                                    $map   = [
                                        'dikirim'  => ['secondary', 'fas fa-paper-plane', 'Lamaran telah dikirim'],
                                        'diproses' => ['warning',   'fas fa-spinner fa-spin', 'Lamaran sedang ditinjau'],
                                        'diterima' => ['success',   'fas fa-check', 'Selamat! Lamaran diterima'],
                                        'ditolak'  => ['danger',    'fas fa-times', 'Lamaran tidak lolos'],
                                    ];
                                    [$color, $icon, $labelHelp] = $map[$st] ?? ['secondary', 'fas fa-info-circle', 'Status tidak diketahui'];
                                @endphp
                                <tr>
                                    <td class="fw-semibold" data-label="Lowongan">
                                        @if($job)
                                            <a href="{{ route('jobs.show', $job) }}" class="job-link">
                                                {{ $job->judul }}
                                            </a>
                                        @else
                                            {{ $a->lowongan?->judul ?? '-' }}
                                        @endif
                                    </td>
                                    <td data-label="Perusahaan">
                                        {{ $comp->nama_perusahaan ?? '-' }}
                                    </td>
                                    <td data-label="Lokasi">
                                        {{ $job->lokasi ?? '—' }}
                                    </td>
                                    <td data-label="Tanggal Lamar">
                                        {{ optional($a->tanggal_lamar ?: $a->created_at)->format('d M Y H:i') }}
                                        <div class="muted small">
                                            {{ optional($a->tanggal_lamar ?: $a->created_at)->diffForHumans() }}
                                        </div>
                                    </td>
                                    <td data-label="Status">
                                        <span class="badge-status badge-soft-{{ $color }}"
                                              title="{{ $labelHelp }}">
                                            <i class="{{ $icon }}"></i>
                                            {{ ucfirst($st) }}
                                        </span>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="text-center text-muted p-4">
                                        Kamu belum pernah mengirim lamaran.
                                    </td>
                                </tr>
                            @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>

                {{-- PAGINATION --}}
                @if($items->hasPages())
                    <div class="riwayat-pagination">
                        <div class="text-muted small mb-2 mb-md-0">
                            @php
                                $first = $items->firstItem();
                                $last  = $items->lastItem();
                                $total = $items->total();
                            @endphp
                            Menampilkan
                            {{ $first }}–{{ $last }}
                            dari {{ $total }} lamaran.
                        </div>
                        <div>
                            {{ $items->links('pagination::bootstrap-4') }}
                        </div>
                    </div>
                @endif

            </div> {{-- /riwayat-card --}}
        </div>
    </div>
@endsection

@push('styles')
    <style>
        /* CARD UTAMA */
        .riwayat-card{
            border-radius:20px;
            background:#ffffff;
            box-shadow:0 18px 45px rgba(15,23,42,.09);
            padding:18px 22px 20px;
        }
        .riwayat-header{
            display:flex;
            flex-wrap:wrap;
            justify-content:space-between;
            gap:14px;
            margin-bottom:12px;
        }

        /* TOOLBAR */
        .riwayat-card .toolbar{
            display:flex;
            flex-wrap:wrap;
            gap:10px;
            align-items:center;
        }
        .riwayat-card .toolbar .inputs{
            display:flex;
            flex-wrap:wrap;
            gap:8px;
        }
        .riwayat-card .toolbar .actions{
            display:flex;
            gap:8px;
        }
        .riwayat-card .toolbar input.form-control{
            min-width:220px;
            border-radius:999px;
            font-size:13px;
        }
        .riwayat-card .toolbar .form-select{
            min-width:160px;
            border-radius:999px;
            font-size:13px;
        }

        /* TABEL DESKTOP */
        .riwayat-table thead th{
            font-size:13px;
            text-transform:uppercase;
            color:#9ca3af;
            border-bottom-color:#e5e7eb;
            letter-spacing:.04em;
        }
        .riwayat-table tbody td{
            font-size:13px;
            vertical-align:middle;
        }
        .riwayat-table tbody tr:hover{
            background:#f9fafb;
        }
        .job-link{
            color:#4c1d95;
        }
        .job-link:hover{
            color:#7c3aed;
        }

        /* BADGE STATUS */
        .badge-status{
            display:inline-flex;
            align-items:center;
            gap:6px;
            padding:4px 11px;
            border-radius:999px;
            font-size:11px;
            font-weight:500;
        }
        .badge-status i{
            font-size:12px;
        }
        .badge-soft-secondary{
            background:#f3f4f6;
            color:#4b5563;
        }
        .badge-soft-warning{
            background:#fffbeb;
            color:#92400e;
        }
        .badge-soft-success{
            background:#ecfdf3;
            color:#166534;
        }
        .badge-soft-danger{
            background:#fef2f2;
            color:#b91c1c;
        }

        /* PAGINATION WRAPPER */
        .riwayat-pagination{
            margin-top:16px;
            display:flex;
            flex-wrap:wrap;
            justify-content:space-between;
            align-items:center;
            gap:10px;
        }

        /* ========== RESPONSIVE (MOBILE) ========== */
        @media (max-width: 767.98px){
            .riwayat-card{
                padding:14px 14px 18px;
            }

            /* toolbar full width stacking */
            .riwayat-card .toolbar{
                flex-direction:column;
                align-items:stretch;
            }
            .riwayat-card .toolbar .inputs{
                width:100%;
                flex-direction:column;
            }
            .riwayat-card .toolbar input.form-control,
            .riwayat-card .toolbar .form-select{
                width:100%;
                min-width:0;
            }
            .riwayat-card .toolbar .actions{
                width:100%;
            }
            .riwayat-card .toolbar .actions .btn{
                flex:1;
                text-align:center;
            }

            /* tabel jadi card per baris */
            .riwayat-table thead{
                display:none;
            }
            .riwayat-table,
            .riwayat-table tbody,
            .riwayat-table tr,
            .riwayat-table td{
                display:block;
                width:100%;
            }
            .riwayat-table tbody tr{
                margin-bottom:14px;
                border-radius:14px;
                border:1px solid #e5e7eb;
                padding:10px 12px;
                background:#ffffff;
                box-shadow:0 6px 18px rgba(15,23,42,.04);
            }
            .riwayat-table tbody td{
                border-bottom:none !important;
                padding:4px 0;
            }
            .riwayat-table tbody td::before{
                content: attr(data-label);
                display:block;
                font-size:11px;
                text-transform:uppercase;
                color:#9ca3af;
                letter-spacing:.05em;
                margin-bottom:1px;
            }
            .riwayat-table tbody td[data-label="Aksi"]{
                margin-top:6px;
            }
            .riwayat-table tbody td[data-label="Aksi"] .btn{
                width:100%;
                text-align:center;
            }

            .riwayat-pagination{
                flex-direction:column;
                align-items:flex-start;
            }
        }
    </style>
@endpush
