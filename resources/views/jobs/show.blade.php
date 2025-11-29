@extends('layouts.dashboard_pelamar')
@section('title', $lowongan->judul)

@section('content')
    <div class="page-sticky">
        <div class="page-body"><!-- wrapper agar footer nempel bawah -->

            {{-- PAGE TITLE / BREADCRUMB --}}
            <div class="page_title_section">
                <div class="page_header">
                    <div class="container">
                        <div class="row">
                            <div class="col-lg-9 col-md-3 col-12 col-sm-8">
                                <h1>Job Detail</h1>
                            </div>
                            <div class="col-lg-3 col-md-9 col-12 col-sm-4">
                                <div class="sub_title_section">
                                    <ul class="sub_title">
                                        <li><a href="{{ url('/') }}">Home</a>&nbsp;/&nbsp;</li>
                                        <li>Job Detail</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- CONTENT --}}
            <div class="job_filter_listing_wrapper jb_cover">
                <div class="container">
                    {{-- FLASH MESSAGE + VALIDATION ERROR --}}
                    @if (session('ok'))
                        <div class="alert alert-success mb-3">{{ session('ok') }}</div>
                    @endif

                    @if (session('err'))
                        <div class="alert alert-danger mb-3">{{ session('err') }}</div>
                    @endif

                    @if ($errors->any())
                        <div class="alert alert-danger mb-3">
                            @foreach ($errors->all() as $e)
                                <div>{{ $e }}</div>
                            @endforeach
                        </div>
                    @endif

                    @php
                        use Illuminate\Support\Facades\Storage;
                        use Illuminate\Support\Str;

                        $company = $lowongan->perusahaan;

                        // LOGO - pakai kolom logo_path di tabel perusahaans
                        $rawLogo = $company->logo_path ?? null;
                        if ($rawLogo && Str::startsWith($rawLogo, ['http://', 'https://'])) {
                            $logo = $rawLogo;
                        } elseif ($rawLogo && Storage::disk('public')->exists($rawLogo)) {
                            $logo = asset('storage/' . $rawLogo);
                        } elseif ($rawLogo && file_exists(public_path($rawLogo))) {
                            $logo = asset($rawLogo);
                        } else {
                            $logo = asset('images/job1.jpg');
                        }

                        // URL profil perusahaan untuk pelamar
                        $companyProfileUrl = $company ? route('pelamar.perusahaan.show', $company) : '#';

                        // DATA PELAMAR UNTUK ERROR HANDLING
                        $authUser        = auth()->user();
                        $isPelamarLogin  = $authUser && $authUser->isPelamar();
                        $pelamarProfile  = $isPelamarLogin ? $authUser->pelamar : null;

                        $profileComplete =
                            $pelamarProfile &&
                            $pelamarProfile->tanggal_lahir &&
                            $pelamarProfile->telepon &&
                            $pelamarProfile->alamat;

                        $cvAvailable = $pelamarProfile && $pelamarProfile->cv_path;

                        // boleh apply?
                        $canApply =
                            $isPelamarLogin &&
                            !$alreadyApplied &&
                            $lowongan->status === 'published' &&
                            $profileComplete &&
                            $cvAvailable;

                        // alasan jika TIDAK bisa apply
                        $disabledReason = 'Tidak dapat melamar';
                        if ($lowongan->status !== 'published') {
                            $disabledReason = 'Lowongan belum dipublikasikan';
                        } elseif (!$profileComplete) {
                            $disabledReason = 'Lengkapi profil (tgl lahir, telepon, alamat)';
                        } elseif (!$cvAvailable) {
                            $disabledReason = 'Upload CV di profil kamu dulu';
                        }
                    @endphp

                    <div class="row g-3">
                        {{-- LEFT --}}
                        <div class="col-lg-8">
                            {{-- Header card --}}
                            <div class="jb-card">
                                <div class="d-flex align-items-start justify-content-between">
                                    <a href="{{ $companyProfileUrl }}"
                                       class="d-flex align-items-center gap-3 text-decoration-none text-reset">
                                        <img src="{{ $logo }}" alt="logo" class="rounded jb-logo"
                                             onerror="this.onerror=null;this.src='{{ asset('images/job1.jpg') }}';">
                                        <div>
                                            <h3 class="mb-1 fw-800">{{ $lowongan->judul }}</h3>
                                            <div class="text-muted small">
                                                <span class="fw-semibold">
                                                    {{ $company->nama_perusahaan ?? '-' }}
                                                </span>
                                                @if ($lowongan->lokasi)
                                                    &nbsp;•&nbsp;
                                                    <i class="flaticon-location-pointer"></i>
                                                    {{ $lowongan->lokasi }}
                                                @endif
                                            </div>
                                        </div>
                                    </a>
                                </div>

                                @if ($alreadyApplied)
                                    <div class="alert alert-success mt-3 mb-0">
                                        <div class="fw-semibold mb-1">Kamu sudah melamar lowongan ini.</div>
                                        @if ($myLamaran)
                                            Status lamaran:
                                            <span>{{ $myLamaran->status }}</span>
                                            <span class="text-muted ms-2">
                                                pada {{ $myLamaran->created_at->format('d M Y H:i') }}
                                            </span>
                                        @endif
                                    </div>
                                @endif
                            </div>

                            {{-- Deskripsi --}}
                            <div class="jb-card">
                                <div class="jb-hd">
                                    <h1>Deskripsi Pekerjaan</h1>
                                </div>
                                <div class="pt-2">{!! nl2br(e($lowongan->deskripsi)) !!}</div>
                            </div>

                            {{-- Kualifikasi --}}
                            @if ($lowongan->kualifikasi)
                                <div class="jb-card">
                                    <div class="jb-hd">
                                        <h1>Kualifikasi</h1>
                                    </div>
                                    <div class="pt-2">{!! nl2br(e($lowongan->kualifikasi)) !!}</div>
                                </div>
                            @endif
                        </div>

                        {{-- RIGHT --}}
                        <div class="col-lg-4">
                            {{-- Info Lowongan --}}
                            <div class="jb-card">
                                <div class="jb-hd">
                                    <h1>Info Lowongan</h1>
                                </div>

                                <div class="jb-info-list">
                                    <div class="item">
                                        <div class="ico"><i class="far fa-building"></i></div>
                                        <div class="txt">
                                            <div class="label">Perusahaan</div>
                                            <div class="value">
                                                @if ($company)
                                                    <a href="{{ $companyProfileUrl }}"
                                                       class="text-decoration-none text-reset fw-semibold">
                                                        {{ $company->nama_perusahaan ?? '—' }}
                                                    </a>
                                                @else
                                                    —
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    <div class="item">
                                        <div class="ico"><i class="flaticon-location-pointer"></i></div>
                                        <div class="txt">
                                            <div class="label">Lokasi</div>
                                            <div class="value">{{ $lowongan->lokasi ?? '—' }}</div>
                                        </div>
                                    </div>
                                    <div class="item">
                                        <div class="ico"><i class="far fa-building"></i></div>
                                        <div class="txt">
                                            <div class="label">Tipe</div>
                                            <div class="value">{{ $lowongan->tipe_pekerjaan ?? '—' }}</div>
                                        </div>
                                    </div>
                                    <div class="item">
                                        <div class="ico"><i class="far fa-calendar-plus"></i></div>
                                        <div class="txt">
                                            <div class="label">Dibuat</div>
                                            <div class="value">{{ $lowongan->created_at->format('d M Y') }}</div>
                                        </div>
                                    </div>
                                    <div class="item">
                                        <div class="ico"><i class="far fa-calendar-times"></i></div>
                                        <div class="txt">
                                            <div class="label">Deadline</div>
                                            <div class="value">
                                                {{ $lowongan->deadline ? \Illuminate\Support\Carbon::parse($lowongan->deadline)->format('d M Y') : '—' }}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            {{-- Lamar --}}
                            <div class="jb-card">
                                <div class="jb-hd">
                                    <h1>Lamar Pekerjaan</h1>
                                </div>
                                <div class="pt-2">
                                    @auth
                                        @if ($isPelamarLogin)
                                            @if ($alreadyApplied)
                                                <button class="btn btn-success w-100" disabled>
                                                    Sudah Mengirim Lamaran
                                                </button>
                                            @elseif (!$canApply)
                                                {{-- Tidak bisa melamar, tampilkan alasan --}}
                                                <button class="btn btn-outline-secondary w-100" disabled>
                                                    {{ $disabledReason }}
                                                </button>
                                                <ul class="mt-2 small text-muted ps-3">
                                                    <li>Status lowongan:
                                                        <strong>{{ ucfirst($lowongan->status) }}</strong>
                                                    </li>
                                                    <li>Profil lengkap:
                                                        <strong>{{ $profileComplete ? 'Ya' : 'Belum (lengkapi di menu Profil)' }}</strong>
                                                    </li>
                                                    <li>CV di profil:
                                                        <strong>{{ $cvAvailable ? 'Sudah' : 'Belum (upload di menu Profil)' }}</strong>
                                                    </li>
                                                </ul>
                                            @else
                                                {{-- Bisa melamar --}}
                                                <button class="btn btn-purple w-100"
                                                        data-bs-toggle="modal"
                                                        data-bs-target="#applyModal"
                                                        data-toggle="modal"
                                                        data-target="#applyModal">
                                                    Lamar Sekarang
                                                </button>
                                                <div class="small text-muted mt-2">
                                                    CV yang digunakan diambil dari profilmu, kecuali kamu
                                                    meng-upload CV baru di form.
                                                </div>
                                            @endif
                                        @else
                                            <div class="text-muted">Akun kamu bukan Pelamar.</div>
                                        @endif
                                    @else
                                        <a class="btn btn-outline-purple w-100" href="{{ route('login') }}">
                                            Masuk untuk melamar
                                        </a>
                                    @endauth
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div><!-- /page-sticky -->

    {{-- MODAL APPLY --}}
    @auth
        @if ($isPelamarLogin && $canApply)
            <div class="modal fade apply_job_popup" id="applyModal" role="dialog" aria-hidden="true" tabindex="-1">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <button type="button" class="close" data-dismiss="modal" data-bs-dismiss="modal">&times;</button>
                        <div class="row">
                            <div class="col-12">
                                <div class="apply_job jb_cover">
                                    <h1>Apply For This Job :</h1>
                                    <div class="search_alert_box jb_cover">
                                        <form action="{{ route('lamaran.store', $lowongan) }}"
                                              method="POST"
                                              enctype="multipart/form-data">
                                            @csrf
                                            <div class="apply_job_form">
                                                <input type="text" name="nama_lengkap"
                                                       placeholder="Full Name"
                                                       value="{{ old('nama_lengkap', $authUser->name ?? '') }}"
                                                       required>
                                            </div>
                                            <div class="apply_job_form">
                                                <input type="email" name="email"
                                                       placeholder="Enter Your Email"
                                                       value="{{ old('email', $authUser->email ?? '') }}"
                                                       required>
                                            </div>
                                            <div class="apply_job_form">
                                                <textarea class="form-control"
                                                          name="cover_letter"
                                                          placeholder="Message">{{ old('cover_letter') }}</textarea>
                                            </div>

                                            <div class="resume_optional jb_cover">
                                                <p>CV (Optional)</p>
                                                <div class="width_50">
                                                    <input type="file" name="file_cv"
                                                           class="dropify"
                                                           data-height="90"
                                                           data-allowed-file-extensions="pdf doc docx"
                                                           data-max-file-size="5M" />
                                                    <span class="post_photo">
                                                        Upload CV baru (opsional)
                                                    </span>
                                                </div>
                                                <p class="word_file">
                                                    Microsoft Word atau PDF file (maks. 5MB)
                                                </p>
                                            </div>

                                            <div class="header_btn search_btn applt_pop_btn jb_cover">
                                                <button type="submit" class="btn btn-purple w-100">
                                                    Apply Now
                                                </button>
                                            </div>
                                        </form>
                                    </div>
                                    <div class="small text-muted mt-2">
                                        Kalau kamu tidak meng-upload CV,
                                        sistem akan memakai CV dari profilmu.
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    @endauth
@endsection

@push('styles')
    <style>
        .jb-logo {
            width: 64px;
            height: 64px;
            object-fit: cover;
            margin-right: 12px;
        }
    </style>
@endpush

@push('scripts')
    <script>
        (function() {
            // Pindahkan modal ke <body> agar tidak terpotong
            $(document).on('show.bs.modal', '.apply_job_popup', function() {
                $(this).appendTo('body');
            });

            // Inisialisasi Dropify saat modal tampil
            $(document).on('shown.bs.modal', '.apply_job_popup', function() {
                $(this).find('.dropify').dropify({
                    messages: {
                        default: 'Tarik & letakkan berkas atau klik',
                        replace: 'Ganti berkas',
                        remove: 'Hapus',
                        error: 'Format/ukuran tidak didukung'
                    }
                });
            });

            // Fallback klik tombol (BS4/BS5)
            $(document).on('click', '[data-target],[data-bs-target]', function(e) {
                var sel = $(this).attr('data-bs-target') || $(this).attr('data-target');
                if (!sel) return;
                var $m = $(sel);
                if (!$m.length) return;
                try {
                    if ($.fn.modal) {
                        $m.modal('show');
                    } else if (window.bootstrap && bootstrap.Modal) {
                        new bootstrap.Modal($m[0]).show();
                    }
                } catch (_) {}
                e.preventDefault();
            });
        })();
    </script>
@endpush
