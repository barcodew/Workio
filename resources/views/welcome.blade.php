{{-- resources/views/landing.blade.php --}}
@extends('layouts.landing')
@section('title', 'Beranda')

@section('content')
    @php
        use Illuminate\Support\Facades\Storage;
        use Illuminate\Support\Str;

        $user = auth()->user();
        $avatarUrl = null;

        if ($user) {
            // jika user pelamar dan punya foto profil
            if (method_exists($user, 'isPelamar') && $user->isPelamar() && $user->pelamar) {
                $foto = $user->avatar_path ?? null;

                if ($foto) {
                    if (Str::startsWith($foto, ['http://', 'https://'])) {
                        $avatarUrl = $foto;
                    } elseif (Storage::disk('public')->exists($foto)) {
                        $avatarUrl = asset('storage/' . $foto);
                    }
                }
            }
            // jika user perusahaan → pakai logo perusahaan
            elseif (method_exists($user, 'isPerusahaan') && $user->isPerusahaan() && $user->perusahaan) {
                $logo = $user->perusahaan->logo_path ?? null;

                if ($logo) {
                    if (Str::startsWith($logo, ['http://', 'https://'])) {
                        $avatarUrl = $logo;
                    } elseif (Storage::disk('public')->exists($logo)) {
                        $avatarUrl = asset('storage/' . $logo);
                    }
                }
            }
        }

        if (!$avatarUrl) {
            $avatarUrl = asset('images/job1.jpg'); // fallback avatar default
        }
    @endphp

    {{-- TOP NAV --}}
    <div class="cp_navi_main_wrapper index_2_top_header index_3_top_header jb_cover">
        <div class="cp_logo_wrapper index_2_logo index_3_logo">
            <a href="{{ url('/') }}">
                <span class="Logo">WORKIO</span>
            </a>
        </div>

        <!-- mobile menu -->
        <header class="mobail_menu d-block d-sm-block d-md-block d-lg-none d-xl-none">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="cd-dropdown-wrapper">
                            <a class="house_toggle" href="#0" aria-label="Buka menu">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 31.177 31.177" width="25"
                                    height="25">
                                    <g>
                                        <path class="menubar"
                                            d="M30.23,1.775H0.946c-0.489,0-0.887-0.398-0.887-0.888S0.457,0,0.946,0H30.23c0.49,0,0.888,0.398,0.888,0.888S30.72,1.775,30.23,1.775z"
                                            fill="#004165" />
                                        <path class="menubar"
                                            d="M30.23,9.126H12.069c-0.49,0-0.888-0.398-0.888-0.888c0-0.49,0.398-0.888,0.888-0.888H30.23c0.49,0,0.888,0.397,0.888,0.888C31.118,8.729,30.72,9.126,30.23,9.126z"
                                            fill="#004165" />
                                        <path class="menubar"
                                            d="M30.23,16.477H0.946c-0.489,0-0.887-0.398-0.887-0.888c0-0.49,0.398-0.888,0.887-0.888H30.23c0.49,0,0.888,0.397,0.888,0.888C31.118,16.079,30.72,16.477,30.23,16.477z"
                                            fill="#004165" />
                                        <path class="menubar"
                                            d="M30.23,23.826H12.069c-0.49,0-0.888-0.396-0.888-0.887c0-0.49,0.398-0.888,0.888-0.888H30.23c0.49,0,0.888,0.397,0.888,0.888C31.118,23.43,30.72,23.826,30.23,23.826z"
                                            fill="#004165" />
                                        <path class="menubar"
                                            d="M30.23,31.177H0.946c-0.489,0-0.887-0.396-0.887-0.887c0-0.49,0.398-0.888,0.887-0.888H30.23c0.49,0,0.888,0.398,0.888,0.888C31.118,30.78,30.72,31.177,30.23,31.177z"
                                            fill="#004165" />
                                    </g>
                                </svg>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </header>

        <div class="jb_navigation_wrapper index_2_right_menu index_3_right_menu">
            <div class="posting_job">
                <ul>
                    {{-- quick search button kalau mau dihidupkan lagi --}}
                </ul>
            </div>

            <!-- main menu desktop -->
            <div class="mainmenu green_main_menu blue_main_menu d-xl-block d-lg-block d-md-none d-sm-none d-none">
                <ul class="main_nav_ul menu_2_ul">
                    <li class="has-mega gc_main_navigation">
                        <a href="{{ url('/dashboard') }}" class="gc_main_navigation active_class">Beranda</a>
                    </li>

                    <li class="has-mega gc_main_navigation">
                        <a href="{{ route('jobs.index') }}" class="gc_main_navigation">Lowongan</a>
                    </li>

                    {{-- LOGIN / AVATAR --}}
                    @auth
                        <li class="gc_main_navigation header-avatar-item">
                            <a href="{{ url('/dashboard') }}" class="gc_main_navigation d-flex align-items-center"
                                style="gap:6px;">
                                <span class="header-avatar-wrapper">
                                    <img src="{{ $avatarUrl }}" alt="Profil" class="header-avatar-img">
                                </span>
                                <span class="header-avatar-name d-none d-md-inline">
                                    {{ Str::limit($user->name, 16) }}
                                </span>
                            </a>
                        </li>
                    @else
                        <li class="has-mega gc_main_navigation">
                            <a href="{{ route('login') }}" class="gc_main_navigation">Login</a>
                        </li>
                    @endauth

                </ul>
            </div>
        </div>
    </div>

    <!-- HERO / SLIDER -->
    <div class="main_slider_wrapper slider-area jb_cover">
        <div class="mains_slider_shaper">
            <img src="{{ asset('images/slider_bg.png') }}" class="img-responsive" alt="">
        </div>
        <div class="slider_small2_shape">
            <img src="{{ asset('images/shape4.png') }}" class="img-responsive" alt="">
        </div>
        <div class="slider_shape_smt bubble-1">
            <img src="{{ asset('images/bubble.png') }}" class="img-responsive" alt="">
        </div>

        <div id="carousel-example-generic" class="carousel slide" data-ride="carousel" data-interval="false">
            <div class="carousel-inner" role="listbox">
                <div class="carousel-item active">
                    <div class="carousel-captions caption-1">
                        <div class="container">
                            <div class="row">
                                <div class="col-xl-6 col-lg-6 col-md-12">
                                    <div class="content">
                                        <div class="slider_shape_smt1 bubble-2">
                                            <img src="{{ asset('images/bubble.png') }}" class="img-responsive"
                                                alt="">
                                        </div>
                                        <h2 data-animation="animated fadeInUp">
                                            Temukan <span>Lowongan</span> yang Relevan untukmu
                                        </h2>
                                        <p data-animation="animated fadeInUp">
                                            WORKIO mempertemukan <strong>pelamar</strong> dan
                                            <strong>perusahaan</strong> dalam satu platform web.
                                            Cari, lamar, dan kelola proses rekrutmen secara lebih efisien.
                                        </p>
                                        <div data-animation="animated fadeInUp" class="btn_hover slider_btn">
                                            <a href="{{ route('register') }}">Daftar Gratis</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-6 col-lg-6 col-md-12">
                                    <div class="slider_shape_sm3 bubble-3">
                                        <img src="{{ asset('images/bubble.png') }}" class="img-responsive" alt="">
                                    </div>
                                    <div class="slider_side_img jb_cover">
                                        <img src="{{ asset('images/slider_img.png') }}" class="img-responsive"
                                            alt="">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Slide 2 --}}
                <div class="carousel-item">
                    <div class="carousel-captions caption-2">
                        <div class="container">
                            <div class="row">
                                <div class="col-xl-6 col-lg-6 col-md-12">
                                    <div class="content">
                                        <h2 data-animation="animated fadeInUp">
                                            Pasang <span>Lowongan</span> & Kelola Lamaran
                                        </h2>
                                        <p data-animation="animated fadeInUp">
                                            Perusahaan dapat memposting lowongan dan meninjau lamaran masuk secara
                                            terstruktur.
                                        </p>
                                        <div data-animation="animated fadeInUp" class="btn_hover slider_btn">
                                            <a href="{{ url('/register/perusahaan') }}">Pasang Lowongan</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-6 col-lg-6 col-md-12">
                                    <div class="slider_side_img jb_cover">
                                        <img src="{{ asset('images/slider_img.png') }}" class="img-responsive"
                                            alt="">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <ol class="carousel-indicators">
                <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
                <li data-target="#carousel-example-generic" data-slide-to="1"></li>
            </ol>
            <div class="carousel-nevigation">
                <a class="prev" href="#carousel-example-generic" role="button" data-slide="prev">
                    <i class="flaticon-left-arrow"></i>
                </a>
                <a class="next" href="#carousel-example-generic" role="button" data-slide="next">
                    <i class="flaticon-right-arrow"></i>
                </a>
            </div>
        </div>
        <div class="slider_small_shape">
            <img src="{{ asset('images/shape4.png') }}" class="img-responsive" alt="">
        </div>
    </div>

    {{-- FORM PENCARIAN (langsung ke route lowongan) --}}
    <div class="index3_form_wrapper jb_cover">
        <div class="slider_small3_shape">
            <img src="{{ asset('images/shape4.png') }}" class="img-responsive" alt="img">
        </div>
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12">
                    <form action="{{ route('jobs.index') }}" method="GET" class="landing-search-form jb_cover">
                        <div class="landing-search-inner">
                            {{-- Job Title -> q --}}
                            <div class="landing-search-field landing-search-border">
                                <input type="text" name="q" class="landing-search-input"
                                    placeholder="Job Title" value="{{ request('q') }}">
                            </div>

                            {{-- Location --}}
                            <div class="landing-search-field landing-search-border">
                                <input type="text" name="lokasi" class="landing-search-input" placeholder="Location"
                                    value="{{ request('lokasi') }}">
                            </div>

                            {{-- Keyword / Skill --}}
                            <div class="landing-search-field">
                                <input type="text" name="skill" class="landing-search-input"
                                    placeholder="Keyword / Skill" value="{{ request('skill') }}">
                            </div>

                            <button type="submit" class="landing-search-submit" aria-label="Cari lowongan">
                                <i class="fas fa-search"></i>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- LOWONGAN TERBAIK (dummy static) -->
    <!-- LOWONGAN TERBARU -->
    <div class="best_jobs_wrapper index3_best_job_wrapper jb_cover">
        <div class="line_shape">
            <img src="{{ asset('images/line.png') }}" class="img-responsive" alt="">
        </div>
        <div class="container">
            <div class="row">
                <div class="col-lg-10 offset-lg-1 col-12">
                    <div class="jb_heading_wraper">
                        <h3>Lowongan Terbaru untuk Kamu</h3>
                        <p>Telusuri peluang kerja sesuai minat, keterampilan, dan lokasi.</p>
                    </div>
                </div>

                {{-- TAB (hanya Terbaru, Populer dihapus) --}}
                <div class="col-12">
                    <div class="latest_job_tabs index2_tab_wrapper index3_tab_wrapper jb_cover">
                        <ul class="nav nav-tabs">
                            <li class="nav-item">
                                <a class="nav-link active" data-toggle="tab" href="#tab-terbaru">Terbaru</a>
                            </li>
                        </ul>
                    </div>
                </div>

                <div class="col-12">
                    <div class="tab-content">

                        {{-- ================= TAB TERBARU (from DB) ================= --}}
                        <div id="tab-terbaru" class="tab-pane active">
                            <div class="row">
                                @forelse ($latestJobs as $job)
                                    @php
                                        $company = $job->perusahaan;
                                        // kalau ada logo perusahaan pakai itu, kalau tidak pakai placeholder
                                        $logo =
                                            $company && !empty($company->logo_path)
                                                ? asset('storage/' . $company->logo_path)
                                                : asset('images/job1.png');
                                    @endphp

                                    <div class="col-lg-6 col-md-12 col-sm-12">
                                        <div class="job_listing_left_fullwidth job_listing_grid_wrapper jb_cover">
                                            <div class="row align-items-center">

                                                {{-- Logo perusahaan --}}
                                                <div class="col-3">
                                                    <div class="jp_job_post_side_img job-logo-wrapper">
                                                        <img src="{{ $logo }}"
                                                            alt="logo {{ $company->nama ?? 'Perusahaan' }}"
                                                            class="job-logo-img">
                                                    </div>
                                                </div>


                                                {{-- Detail lowongan --}}
                                                <div class="col-9">
                                                    <div class="jp_job_post_right_cont">
                                                        <h4>
                                                            <a href="{{ route('jobs.show', $job->id) }}">
                                                                {{ $job->judul }}
                                                            </a>
                                                        </h4>

                                                        <ul>
                                                            {{-- Nama perusahaan --}}
                                                            <li>
                                                                <i class="flaticon-briefcase"></i>
                                                                {{ $company->nama ?? 'Perusahaan' }}
                                                            </li>

                                                            {{-- Lokasi --}}
                                                            <li>
                                                                <i class="flaticon-location-pointer"></i>
                                                                {{ $job->lokasi ?? '-' }}
                                                            </li>
                                                        </ul>

                                                        {{-- Deskripsi singkat --}}
                                                        <p>
                                                            {{ \Illuminate\Support\Str::limit(strip_tags($job->deskripsi), 120) }}
                                                        </p>

                                                        {{-- Info kecil: tipe & jumlah pelamar --}}
                                                        <small class="text-muted">
                                                            {{ $job->tipe_pekerjaan ?? '-' }}
                                                            • {{ $job->lamarans_count }} pelamar
                                                            @if ($job->deadline)
                                                                • tutup {{ $job->deadline->format('d M Y') }}
                                                            @endif
                                                        </small>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @empty
                                    <div class="col-12">
                                        <p class="text-center text-muted mb-0">
                                            Belum ada lowongan yang aktif.
                                        </p>
                                    </div>
                                @endforelse
                            </div> {{-- /row --}}
                        </div>
                        {{-- ================= END TAB TERBARU ================= --}}

                    </div>

                    {{-- Tombol lihat semua --}}
                    <div class="btn_hover slider_btn jobs_btn_3 jb_cover" style="text-align:center; margin-top:1.5rem;">
                        <a href="{{ route('jobs.index') }}">Lihat semua</a>
                    </div>
                </div>

            </div>
        </div>
        <div class="slider_small3_shape">
            <img src="{{ asset('images/shape4.png') }}" class="img-responsive" alt="">
        </div>
    </div>

    {{-- COUNTER --}}
    <div class="counter_wrapper counter_3_wrapper jb_cover">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-md-12">
                    <div class="counter_mockup_design jb_cover">
                        <img src="{{ asset('images/mockup6.png') }}" class="img-responsive" alt="">
                    </div>
                    <div class="counter_jbbb jb_cover">
                        <img src="{{ asset('images/line2.png') }}" class="img-responsive" alt="">
                    </div>
                </div>
                <div class="col-lg-6 col-md-12">
                    <div class="counter_right_wrapper counter_index3_right jb_cover">
                        <h1>Statistik WORKIO</h1>
                        <div class="counter_width">
                            <div class="counter_cntnt_box">
                                <div class="count-description"><span class="timer">2500</span>
                                    <p class="con2">pelamar aktif</p>
                                </div>
                            </div>
                        </div>
                        <div class="counter_width">
                            <div class="counter_cntnt_box">
                                <div class="count-description"><span class="timer">9425</span>
                                    <p class="con2">lamaran diproses</p>
                                </div>
                            </div>
                        </div>
                        <div class="counter_width">
                            <div class="counter_cntnt_box">
                                <div class="count-description"><span class="timer">9</span><span>+</span>
                                    <p class="con2">rating rata-rata</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- FITUR UTAMA --}}
    <div class="services_wrapper control_wrapper jb_cover">
        <div class="slider_small_shape44">
            <img src="{{ asset('images/shape4.png') }}" class="img-responsive" alt="">
        </div>
        <div class="counter_jbbb2 jb_cover">
            <img src="{{ asset('images/line3.png') }}" class="img-responsive" alt="">
        </div>
        <div class="container">
            <div class="row">
                <div class="col-lg-10 offset-lg-1 col-12">
                    <div class="jb_heading_wraper">
                        <h3>Kendalikan Proses Rekrutmen Anda</h3>
                        <p>Registrasi & login, pencarian lowongan, posting lowongan, lamaran online, notifikasi email, dan
                            dasbor admin.</p>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6 col-sm-12">
                    <div class="services_content jb_cover">
                        <img src="{{ asset('images/c1.png') }}" alt="">
                        <h3><a href="#">Manajemen Lowongan</a></h3>
                        <p>Perusahaan memposting, mengubah, dan menghapus lowongan dengan detail lengkap.</p>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6 col-sm-12">
                    <div class="services_content jb_cover">
                        <img src="{{ asset('images/c5.png') }}" alt="">
                        <h3><a href="#">Pencarian & Filter</a></h3>
                        <p>Pelamar mencari lowongan berdasarkan minat, lokasi, dan keterampilan.</p>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6 col-sm-12">
                    <div class="services_content jb_cover">
                        <img src="{{ asset('images/c3.png') }}" alt="">
                        <h3><a href="#">Lamaran Online</a></h3>
                        <p>Unggah CV & surat lamaran (PDF/DOCX) dan pantau status lamaran.</p>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6 col-sm-12">
                    <div class="services_content jb_cover">
                        <img src="{{ asset('images/c8.png') }}" alt="">
                        <h3><a href="#">Notifikasi Email</a></h3>
                        <p>Info lowongan baru & perubahan status lamaran langsung ke email terdaftar.</p>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6 col-sm-12">
                    <div class="services_content jb_cover">
                        <img src="{{ asset('images/c4.png') }}" alt="">
                        <h3><a href="#">Validasi Admin</a></h3>
                        <p>Admin memverifikasi konten dan menjaga kelancaran sistem.</p>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6 col-sm-12">
                    <div class="services_content jb_cover">
                        <img src="{{ asset('images/c7.png') }}" alt="">
                        <h3><a href="#">Laporan Sistem</a></h3>
                        <p>Statistik pengguna, lowongan aktif, dan aktivitas rekrutmen untuk admin.</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="slider_small3_shape">
            <img src="{{ asset('images/shape4.png') }}" class="img-responsive" alt="">
        </div>
    </div>

    {{-- AJAKAN DAFTAR --}}
    <div class="popular_wrapper jb_cover">
        <div class="slider_small3_shape shaa shapenew">
            <img src="{{ asset('images/shape4.png') }}" class="img-responsive" alt="">
        </div>
        <div class="container">
            <div class="row">
                <div class="col-lg-10 offset-lg-1 col-12">
                    <div class="jb_heading_wraper">
                        <h3>Mulai di WORKIO</h3>
                        <p>Pilih peran Anda dan mulai sekarang.</p>
                    </div>
                </div>

                <div class="col-12">
                    <div class="jp_register_section_main_wrapper jb_cover">
                        <div class="jp_regis_left_side_box_wrapper">
                            <div class="jp_regis_left_side_box">
                                <i class="flaticon-laptop"></i>
                                <h4>Saya Perusahaan</h4>
                                <p>Pasang lowongan, kelola lamaran, dan temukan kandidat terbaik.</p>
                                <ul>
                                    <li><a href="{{ url('/register/perusahaan') }}" class="price_btn regis_btn">
                                            Daftar sebagai Perusahaan</a></li>
                                </ul>
                            </div>
                        </div>

                        <div class="jp_regis_right_side_box_wrapper">
                            <div class="jp_regis_right_side_box">
                                <i class="flaticon-doctor"></i>
                                <h4>Saya Pelamar</h4>
                                <p>Cari lowongan, unggah CV, dan pantau status lamaran Anda.</p>
                                <ul>
                                    <li><a href="{{ url('/register/pelamar') }}" class="price_btn regis_btn">
                                            Daftar sebagai Pelamar</a></li>
                                </ul>
                            </div>
                            <div class="jp_regis_center_tag_wrapper">
                                <p>ATAU</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- RESUME TERBARU --}}
    <div class="pricing_table_3 recent_resume_wrapper jb_cover">
        <div class="slider_small_shape44">
            <img src="{{ asset('images/p2.png') }}" class="img-responsive" alt="">
        </div>
        <div class="container">
            <div class="row">
                <div class="col-lg-10 offset-lg-1 col-12">
                    <div class="jb_heading_wraper">
                        <h3>Resume Terbaru</h3>
                        <p>Profil kandidat yang baru diperbarui.</p>
                    </div>
                </div>

                @foreach ($recentResumes ?? [] as $resume)
                    <div class="col-lg-6 col-md-12 col-sm-12">
                        <div class="jp_recent_resume_box_wrapper jb_cover">
                            <div class="jp_recent_resume_img_wrapper">
                                <img src="{{ $resume->avatar_url ?? asset('images/cmnt1.jpg') }}" alt="resume_img" />
                            </div>
                            <div class="jp_recent_resume_cont_wrapper">
                                <h3>
                                    <a href="{{ route('candidates.show', $resume->id) }}">{{ $resume->name }}</a>
                                </h3>
                                <p><i class="far fa-folder-open"></i> {{ $resume->headline }}</p>
                            </div>
                            <div class="jp_recent_resume_btn_wrapper">
                                <ul>
                                    <li>
                                        <a href="{{ route('candidates.show', $resume->id) }}">Lihat Profil</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                @endforeach

                <div class="btn_hover slider_btn jobs_btn_3 vb jb_cover">
                    <a href="{{ route('jobs.index') }}">Lihat semua</a>
                </div>
            </div>
        </div>
        <div class="counter_jbbb2 jb_cover">
            <img src="{{ asset('images/line3.png') }}" class="img-responsive" alt="">
        </div>
    </div>

    {{-- NEWSLETTER --}}
    <div class="news_letter_wrapper shaa jb_cover">
        <div class="sha1 bubble-180">
            <img src="{{ asset('images/bubble2.png') }}" class="img-responsive" alt="">
        </div>
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="job_newsletter_wrapper jb_cover">
                        <div class="jb_newslwtteter_left">
                            <h2>Butuh Pekerjaan?</h2>
                            <p>Daftar WORKIO dan dapatkan notifikasi lowongan sesuai profil Anda.</p>
                        </div>
                        <div class="jb_newslwtteter_button">
                            <div class="btn_hover slider_btn jobs_btn_3">
                                <a href="{{ route('register') }}">Gabung Sekarang</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="sha2 bubble-185">
            <img src="{{ asset('images/bubble2.png') }}" class="img-responsive" alt="">
        </div>
    </div>
@endsection
