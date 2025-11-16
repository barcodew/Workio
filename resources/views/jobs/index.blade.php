@extends('layouts.dashboard_pelamar')

@section('content')
    {{-- PAGE TITLE / BREADCRUMB --}}
    <div class="page_title_section">
        <div class="page_header">
            <div class="container">
                <div class="row">
                    <div class="col-lg-9 col-md-9 col-12 col-sm-8">
                        <h1>Lowongan</h1>
                    </div>
                    <div class="col-lg-3 col-md-3 col-12 col-sm-4">
                        <div class="sub_title_section">
                            <ul class="sub_title">
                                <li><a href="{{ url('/dashboard') }}">Home</a>&nbsp;/&nbsp;</li>
                                <li>Lowongan</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- LISTING + FILTER WRAPPER --}}
    <div class="job_filter_listing_wrapper jb_cover">
        <div class="container">
            <div class="row">
                {{-- SIDEBAR (desktop) --}}
                <div class="col-lg-3 d-none d-lg-block">
                    @php
                        $tipeList = ['Full-time', 'Part-time', 'Internship', 'Contract'];
                        $reqTipe = request('tipe');
                    @endphp

                    <div class="job_filter_category_sidebar jb_cover">
                        <div class="job_filter_sidebar_heading jb_cover">
                            <h1>Tipe Pekerjaan</h1>
                        </div>
                        <div class="category_jobbox jb_cover">
                            @foreach ($tipeList as $t)
                                <p class="job_field mb-2">
                                    <input type="checkbox"
                                           id="t{{ $loop->index }}"
                                           {{ $reqTipe === $t ? 'checked' : '' }}
                                           onclick="window.location='{{ request()->fullUrlWithQuery(['tipe' => $reqTipe === $t ? '' : $t]) }}'">
                                    <label for="t{{ $loop->index }}">{{ $t }}</label>
                                </p>
                            @endforeach
                        </div>
                    </div>

                    <div class="job_filter_category_sidebar jb_cover">
                        <div class="job_filter_sidebar_heading jb_cover">
                            <h1>Cari Lowongan</h1>
                        </div>
                        <div class="category_jobbox jb_cover">
                            <form>
                                <input name="q" class="form-control mb-2" placeholder="Kata kunci"
                                       value="{{ request('q') }}">
                                <input name="lokasi" class="form-control mb-2" placeholder="Lokasi"
                                       value="{{ request('lokasi') }}">
                                <select name="tipe" class="nice-select w-100 mb-2">
                                    <option value="">Semua tipe</option>
                                    @foreach ($tipeList as $t)
                                        <option value="{{ $t }}" @selected(request('tipe') === $t)>{{ $t }}</option>
                                    @endforeach
                                </select>
                                <button class="btn btn-primary w-100">Cari</button>
                            </form>
                        </div>
                    </div>
                </div>

                {{-- CONTENT --}}
                <div class="col-lg-9 col-md-12">
                    <div class="job_listing_left_side jb_cover">
                        {{-- TOP FILTER BAR --}}
                        <div class="filter-area jb_cover">
                            <form class="d-flex flex-wrap align-items-center w-100" style="gap:10px;row-gap:10px">
                                <input name="q" class="form-control" style="max-width:240px" placeholder="Kata kunci"
                                       value="{{ request('q') }}">
                                <input name="lokasi" class="form-control" style="max-width:200px" placeholder="Lokasi"
                                       value="{{ request('lokasi') }}">
                                <select name="tipe" class="nice-select" style="min-width:160px">
                                    <option value="">Semua tipe</option>
                                    @foreach ($tipeList as $t)
                                        <option value="{{ $t }}" @selected(request('tipe') === $t)>{{ $t }}</option>
                                    @endforeach
                                </select>

                                <button class="btn site-button radius-xl ms-auto" type="submit">
                                    <i class="fas fa-search me-1"></i> Cari
                                </button>

                                <div class="list-grid ms-auto">
                                    <ul class="nav nav-tabs">
                                        <li class="nav-item">
                                            <a class="nav-link {{ request('view') === 'grid' ? 'active' : '' }}"
                                               href="{{ request()->fullUrlWithQuery(['view' => 'grid']) }}">
                                                <i class="flaticon-four-grid-layout-design-interface-symbol"></i>
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link {{ request('view') !== 'grid' ? 'active' : '' }}"
                                               href="{{ request()->fullUrlWithQuery(['view' => 'list']) }}">
                                                <i class="flaticon-list"></i>
                                            </a>
                                        </li>
                                    </ul>
                                </div>

                                <div class="showpro">
                                    <p class="m-0">
                                        Menampilkan {{ $lowongans->firstItem() ?? 0 }}–{{ $lowongans->lastItem() ?? 0 }}
                                        dari {{ $lowongans->total() }}
                                    </p>
                                </div>
                            </form>
                        </div>

                        {{-- Helper logo + placeholder --}}
                        @php
                            $placeholder = asset('images/job1.jpg');
                            $resolveLogo = function ($perusahaan) use ($placeholder) {
                                $raw = optional($perusahaan)->logo_url ?? (optional($perusahaan)->logo ?? null);
                                if ($raw && \Illuminate\Support\Str::startsWith($raw, ['http://', 'https://'])) {
                                    return $raw;
                                }
                                if ($raw && \Illuminate\Support\Facades\Storage::disk('public')->exists($raw)) {
                                    return asset('storage/' . $raw);
                                }
                                if ($raw && file_exists(public_path($raw))) {
                                    return asset($raw);
                                }
                                return $placeholder;
                            };
                            $isGrid = request('view') === 'grid';
                        @endphp

                        <div class="tab-content btc_shop_index_content_tabs_main jb_cover">
                            {{-- GRID --}}
                            <div id="grid" class="tab-pane fade {{ $isGrid ? 'show active' : '' }}">
                                <div class="row">
                                    @forelse ($lowongans as $l)
                                        @php
                                            $logo = $resolveLogo($l->perusahaan);
                                            $modalId = 'applyModal-' . $l->id;
                                            $applied =
                                                auth()->check() && auth()->user()->isPelamar()
                                                    ? \App\Models\Lamaran::where('lowongan_id', $l->id)
                                                        ->where('user_id', auth()->id())
                                                        ->exists()
                                                    : false;
                                            $canApply =
                                                auth()->check() &&
                                                auth()->user()->isPelamar() &&
                                                !$applied &&
                                                $l->status === 'published';
                                        @endphp

                                        <div class="col-lg-6 col-md-6">
                                            <div class="job_listing_left_fullwidth job_listing_grid_wrapper jb_cover">
                                                <div class="row">
                                                    <div class="col-12">
                                                        {{-- HEADER CARD: logo + info --}}
                                                        <div class="jp_job_header">
                                                            <div class="jp_job_post_side_img">
                                                                <img src="{{ $logo }}" alt="logo perusahaan"
                                                                     class="company-logo"
                                                                     onerror="this.onerror=null;this.src='{{ $placeholder }}';">
                                                            </div>
                                                            <div class="jp_job_post_right_cont flex-grow-1">
                                                                <h4 class="mb-1">
                                                                    <a href="{{ route('jobs.show', $l) }}">{{ $l->judul }}</a>
                                                                </h4>
                                                                <div class="company-meta">
                                                                    {{ $l->perusahaan->nama_perusahaan ?? '-' }}
                                                                </div>
                                                                <ul>
                                                                    @if ($l->tipe)
                                                                        <li>
                                                                            <i class="flaticon-briefcase"></i>&nbsp;{{ $l->tipe }}
                                                                        </li>
                                                                    @endif
                                                                    <li>
                                                                        <i class="flaticon-location-pointer"></i>&nbsp;{{ $l->lokasi ?? '—' }}
                                                                    </li>
                                                                </ul>
                                                                <p class="mt-2 mb-0">
                                                                    {{ \Illuminate\Support\Str::limit(strip_tags($l->deskripsi), 140) }}
                                                                </p>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="col-12">
                                                        <div class="jp_job_post_right_btn_wrapper jb_cover">
                                                            <ul>
                                                                <li>
                                                                    <a href="{{ route('jobs.show', $l) }}"
                                                                       class="btn btn-light border">Detail</a>
                                                                </li>

                                                                @auth
                                                                    @if (auth()->user()->isPelamar())
                                                                        @if ($canApply)
                                                                            <li>
                                                                                <button type="button"
                                                                                        class="btn site-button radius-xl"
                                                                                        data-bs-toggle="modal"
                                                                                        data-bs-target="#{{ $modalId }}"
                                                                                        data-toggle="modal"
                                                                                        data-target="#{{ $modalId }}">
                                                                                    Lamar
                                                                                </button>
                                                                            </li>
                                                                        @else
                                                                            <li>
                                                                                <span
                                                                                    class="btn btn-outline-secondary disabled">
                                                                                    {{ $applied ? 'Sudah melamar' : 'Tidak dapat melamar' }}
                                                                                </span>
                                                                            </li>
                                                                        @endif
                                                                    @endif
                                                                @else
                                                                    <li>
                                                                        <a href="{{ route('login') }}">Masuk untuk melamar</a>
                                                                    </li>
                                                                @endauth
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        {{-- MODAL APPLY (GRID) --}}
                                        <div class="modal fade apply_job_popup" id="{{ $modalId }}" role="dialog"
                                             aria-hidden="true" tabindex="-1">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <button type="button" class="close" data-dismiss="modal"
                                                            data-bs-dismiss="modal">&times;</button>
                                                    <div class="row">
                                                        <div class="col-12">
                                                            <div class="apply_job jb_cover">
                                                                <h1>Apply For This Job :</h1>
                                                                <div class="search_alert_box jb_cover">
                                                                    <form action="{{ route('lamaran.store', $l) }}"
                                                                          method="POST" enctype="multipart/form-data">
                                                                        @csrf
                                                                        <div class="apply_job_form">
                                                                            <input type="text" name="nama_lengkap"
                                                                                   placeholder="Full Name"
                                                                                   value="{{ old('nama_lengkap', auth()->user()->name ?? '') }}"
                                                                                   required>
                                                                        </div>
                                                                        <div class="apply_job_form">
                                                                            <input type="email" name="email"
                                                                                   placeholder="Enter Your Email"
                                                                                   value="{{ old('email', auth()->user()->email ?? '') }}"
                                                                                   required>
                                                                        </div>
                                                                        <div class="apply_job_form">
                                                                            <textarea class="form-control" name="cover_letter" placeholder="Message">{{ old('cover_letter') }}</textarea>
                                                                        </div>

                                                                        <div class="resume_optional jb_cover">
                                                                            <p>Upload CV (Optional)</p>
                                                                            <div class="width_50">
                                                                                <input type="file" name="file_cv"
                                                                                       id="input-file-now-{{ $l->id }}"
                                                                                       class="dropify"
                                                                                       data-height="90"
                                                                                       data-allowed-file-extensions="pdf doc docx"
                                                                                       data-max-file-size="5M" />
                                                                                <span class="post_photo">Upload CV</span>
                                                                            </div>
                                                                            <p class="word_file">
                                                                                Microsoft Word atau PDF file (5mb)
                                                                            </p>
                                                                        </div>

                                                                        <div
                                                                            class="header_btn search_btn applt_pop_btn jb_cover">
                                                                            <button type="submit"
                                                                                    class="btn site-button radius-xl w-100">
                                                                                Daftar
                                                                            </button>
                                                                        </div>
                                                                    </form>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div> {{-- row --}}
                                                </div>
                                            </div>
                                        </div>
                                    @empty
                                        <div class="col-12">
                                            <p>Tidak ada lowongan.</p>
                                        </div>
                                    @endforelse
                                </div>
                            </div>

                            {{-- LIST --}}
                            <div id="list" class="tab-pane {{ $isGrid ? '' : 'show active' }}">
                                <div class="row">
                                    @foreach ($lowongans as $l)
                                        @php
                                            $logo = $resolveLogo($l->perusahaan);
                                            $modalId = 'applyModal-list-' . $l->id;
                                            $applied =
                                                auth()->check() && auth()->user()->isPelamar()
                                                    ? \App\Models\Lamaran::where('lowongan_id', $l->id)
                                                        ->where('user_id', auth()->id())
                                                        ->exists()
                                                    : false;
                                            $canApply =
                                                auth()->check() &&
                                                auth()->user()->isPelamar() &&
                                                !$applied &&
                                                $l->status === 'published';
                                        @endphp
                                        <div class="col-12">
                                            <div class="job_listing_left_fullwidth jb_cover">
                                                <div class="row">
                                                    <div class="col-lg-9 col-md-9">
                                                        {{-- HEADER CARD LIST --}}
                                                        <div class="jp_job_header">
                                                            <div class="jp_job_post_side_img">
                                                                <img src="{{ $logo }}" alt="logo perusahaan"
                                                                     class="company-logo"
                                                                     onerror="this.onerror=null;this.src='{{ $placeholder }}';">
                                                            </div>
                                                            <div class="jp_job_post_right_cont flex-grow-1">
                                                                <h4 class="mb-1">
                                                                    <a href="{{ route('jobs.show', $l) }}">{{ $l->judul }}</a>
                                                                </h4>
                                                                <div class="company-meta">
                                                                    {{ $l->perusahaan->nama_perusahaan ?? '-' }}
                                                                </div>
                                                                <ul>
                                                                    @if ($l->tipe)
                                                                        <li>
                                                                            <i class="flaticon-briefcase"></i>&nbsp;{{ $l->tipe }}
                                                                        </li>
                                                                    @endif
                                                                    <li>
                                                                        <i class="flaticon-location-pointer"></i>&nbsp;{{ $l->lokasi ?? '—' }}
                                                                    </li>
                                                                </ul>
                                                            </div>
                                                        </div>

                                                        <p class="mt-2 mb-0">
                                                            {{ \Illuminate\Support\Str::limit(strip_tags($l->deskripsi), 180) }}
                                                        </p>
                                                    </div>

                                                    <div class="col-lg-3 col-md-3">
                                                        <div class="jp_job_post_right_btn_wrapper">
                                                            <ul>
                                                                <li>
                                                                    <a href="{{ route('jobs.show', $l) }}"
                                                                       class="btn btn-light border">Detail</a>
                                                                </li>
                                                                <li>
                                                                    @auth
                                                                        @if (auth()->user()->isPelamar())
                                                                            @if ($canApply)
                                                                                <button type="button"
                                                                                        class="btn site-button radius-xl"
                                                                                        data-bs-toggle="modal"
                                                                                        data-bs-target="#{{ $modalId }}"
                                                                                        data-toggle="modal"
                                                                                        data-target="#{{ $modalId }}">
                                                                                    Lamar
                                                                                </button>
                                                                            @else
                                                                                <span
                                                                                    class="btn btn-outline-secondary disabled">
                                                                                    {{ $applied ? 'Sudah melamar' : 'Tidak dapat melamar' }}
                                                                                </span>
                                                                            @endif
                                                                        @else
                                                                            <a href="{{ route('login') }}">Masuk untuk melamar</a>
                                                                        @endif
                                                                    @else
                                                                        <a href="{{ route('login') }}">Masuk untuk melamar</a>
                                                                    @endauth
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        {{-- MODAL LIST --}}
                                        <div class="modal fade apply_job_popup" id="{{ $modalId }}" role="dialog"
                                             aria-hidden="true" tabindex="-1">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <button type="button" class="close" data-dismiss="modal"
                                                            data-bs-dismiss="modal">&times;</button>
                                                    <div class="row">
                                                        <div class="col-12">
                                                            <div class="apply_job jb_cover">
                                                                <h1>Apply For This Job :</h1>
                                                                <div class="search_alert_box jb_cover">
                                                                    <form action="{{ route('lamaran.store', $l) }}"
                                                                          method="POST" enctype="multipart/form-data">
                                                                        @csrf
                                                                        <div class="apply_job_form">
                                                                            <input type="text" name="nama_lengkap"
                                                                                   placeholder="Full Name"
                                                                                   value="{{ old('nama_lengkap', auth()->user()->name ?? '') }}"
                                                                                   required>
                                                                        </div>
                                                                        <div class="apply_job_form">
                                                                            <input type="email" name="email"
                                                                                   placeholder="Enter Your Email"
                                                                                   value="{{ old('email', auth()->user()->email ?? '') }}"
                                                                                   required>
                                                                        </div>
                                                                        <div class="apply_job_form">
                                                                            <textarea class="form-control" name="cover_letter" placeholder="Message">{{ old('cover_letter') }}</textarea>
                                                                        </div>
                                                                        <div class="resume_optional jb_cover">
                                                                            <p>Upload CV (Optional)</p>
                                                                            <div class="width_50">
                                                                                <input type="file" name="file_cv"
                                                                                       id="input-file-now-list-{{ $l->id }}"
                                                                                       class="dropify"
                                                                                       data-height="90"
                                                                                       data-allowed-file-extensions="pdf doc docx"
                                                                                       data-max-file-size="5M" />
                                                                                <span class="post_photo">Upload CV</span>
                                                                            </div>
                                                                            <p class="word_file">
                                                                                Microsoft Word atau PDF file (5mb)
                                                                            </p>
                                                                        </div>
                                                                        <div
                                                                            class="header_btn search_btn applt_pop_btn jb_cover">
                                                                            <button type="submit"
                                                                                    class="btn site-button radius-xl w-100">
                                                                                Daftar
                                                                            </button>
                                                                        </div>
                                                                    </form>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div> {{-- row --}}
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>

                            {{-- PAGINATION --}}
                            <div class="blog_pagination_section jb_cover">
                                {{ $lowongans->withQueryString()->links() }}
                            </div>
                        </div>
                    </div>
                </div>

                {{-- MOBILE SIDEBAR --}}
                <div class="col-lg-3 d-block d-lg-none mt-3">
                    <div class="job_filter_category_sidebar jb_cover">
                        <div class="job_filter_sidebar_heading jb_cover">
                            <h1>quick search</h1>
                        </div>
                        <div class="category_jobbox jb_cover">
                            <form>
                                <input name="q" class="form-control mb-2" placeholder="Kata kunci"
                                       value="{{ request('q') }}">
                                <input name="lokasi" class="form-control mb-2" placeholder="Lokasi"
                                       value="{{ request('lokasi') }}">
                                <select name="tipe" class="nice-select w-100 mb-2">
                                    <option value="">Semua tipe</option>
                                    @foreach ($tipeList as $t)
                                        <option value="{{ $t }}" @selected(request('tipe') === $t)>{{ $t }}</option>
                                    @endforeach
                                </select>
                                <button class="btn site-button w-100">Cari</button>
                            </form>
                        </div>
                    </div>
                </div>

            </div>{{-- row --}}
        </div>{{-- container --}}
    </div>{{-- wrapper --}}
@endsection

@push('styles')
    <style>
        /* Logo perusahaan rapi dan konsisten di semua card */
        .job_listing_left_fullwidth .jp_job_header {
            display: flex;
            align-items: flex-start;
            gap: 14px;
        }

        .job_listing_left_fullwidth .company-logo {
            width: 64px;
            height: 64px;
            border-radius: 14px;
            object-fit: cover;
            flex-shrink: 0;
            background: #f3f4f6;
        }

        @media (max-width: 575.98px) {
            .job_listing_left_fullwidth .company-logo {
                width: 52px;
                height: 52px;
            }
        }

        .job_listing_left_fullwidth .company-meta {
            font-size: 13px;
            color: #6b7280;
            margin-top: 2px;
        }

        .job_listing_left_fullwidth .jp_job_post_right_cont h4 {
            margin-bottom: 4px;
        }

        .job_listing_left_fullwidth .jp_job_post_right_cont ul {
            margin-bottom: 4px;
        }
    </style>
@endpush

@push('scripts')
    <script>
        (function() {
            // nice-select init (pakai plugin dari layout)
            if (typeof $ !== 'undefined' && $('.nice-select').length) {
                $('.nice-select').niceSelect();
            }

            // Modal pindah ke body supaya tidak terpotong
            $(document).on('show.bs.modal', '.apply_job_popup', function() {
                $(this).appendTo('body');
            });

            // Inisialisasi Dropify saat modal muncul
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
        })();
    </script>
@endpush
