@extends('layouts.landing')
@section('title', 'Beranda')

@section('content')
    <div class="cp_navi_main_wrapper index_2_top_header index_3_top_header jb_cover">
        <div class="cp_logo_wrapper index_2_logo index_3_logo">
            <a href="home') }}">
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
                                <!-- ikon hamburger tetap -->
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
                    {{-- <li>
                        <div class="jb_search_btn_wrapper index_2_search d-none d-sm-none d-md-none d-lg-block d-xl-block">
                            <div class="extra-nav">
                                <div class="extra-cell">
                                    <button id="quik-search-btn" type="button" class="site-button radius-xl"
                                        aria-label="Buka pencarian cepat">
                                        <i class="fas fa-search"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="dez-quik-search bg-primary-dark">
                                <form action="jobs.index') }}" method="get">
                                    <input name="q" type="text" class="form-control"
                                        placeholder="Ketik untuk mencari lowongan...">
                                    <span id="quik-search-remove"><i class="fas fa-times"></i></span>
                                </form>
                            </div>
                        </div>
                    </li> --}}

                    <li>
                        <div class="jb_profile_box jb_3_profile_box">
                            <div class="nice-select" tabindex="0">
                                <span class="current"><img src="{{ asset('images/pf.png') }}" alt="Profil"></span>
                                <ul class="list">
                                    <li><a href="profile.show') }}"><i class="fas fa-user-edit"></i>Profil</a>
                                    </li>
                                    <li><a href="calendar.index') }}"><i class="far fa-calendar-alt"></i>Kalender</a></li>
                                    <li><a href="inbox.index') }}"><i class="fas fa-comment"></i>Pesan</a></li>
                                    <li><a href="settings.index') }}"><i class="fas fa-cog"></i>Pengaturan</a>
                                    </li>
                                    <li><a href="help') }}"><i class="fas fa-question-circle"></i>Bantuan</a></li>
                                    <li><a href="lock') }}"><i class="fas fa-lock"></i>Kunci Layar</a></li>
                                    <li><a href="logout') }}"><i class="fas fa-sign-in-alt"></i>Keluar</a></li>
                                </ul>
                            </div>
                        </div>
                    </li>

                    <li class="btn_hover">
                        <a href="/dashboard"> Dashboard</a>
                    </li>
                </ul>
            </div>

            <!-- main menu -->
            <div class="mainmenu green_main_menu blue_main_menu d-xl-block d-lg-block d-md-none d-sm-none d-none">
                <ul class="main_nav_ul menu_2_ul">
                    <li class="has-mega gc_main_navigation">
                        <a href="home') }}" class="gc_main_navigation active_class">Beranda</a>
                        <ul class="navi_2_dropdown">
                            <li class="parent"><a href="home') }}"><i class="fas fa-square"></i>Beranda</a></li>
                        </ul>
                    </li>

                    <li class="has-mega gc_main_navigation">
                        <a href="jobs.index') }}" class="gc_main_navigation">Lowongan</a>
                        <ul class="navi_2_dropdown">
                            <li class="parent"><a href="jobs.index', ['view' => 'grid']) }}"><i
                                        class="fas fa-square"></i>Daftar Lowongan (Grid)</a></li>
                            <li class="parent"><a href="jobs.index', ['view' => 'list']) }}"><i
                                        class="fas fa-square"></i>Daftar Lowongan (List)</a></li>
                        </ul>
                    </li>

                    <li class="has-mega gc_main_navigation kv_sub_menu green_sub_menu blue_sub_menu">
                        <a href="candidates.index') }}" class="gc_main_navigation">Kandidat</a>
                        <ul class="kv_mega_menu">
                            <li class="kv_mega_menu_width">
                                <div class="container">
                                    <div class="jn_menu_partion_div">
                                        <div class="candidate_width">
                                            <div class="jen_tabs_conent_list jb_cover">
                                                <h1>Keterampilan</h1>
                                                <ul>
                                                    <li><a href="#"><i class="fas fa-square"></i>HTML & CSS</a></li>
                                                    <li><a href="#"><i class="fas fa-square"></i>JavaScript</a></li>
                                                    <li><a href="#"><i class="fas fa-square"></i>Desain UI/UX</a>
                                                    </li>
                                                    <li><a href="#"><i class="fas fa-square"></i>WordPress</a></li>
                                                </ul>
                                            </div>
                                        </div>
                                        <div class="candidate_width">
                                            <div class="jen_tabs_conent_list jb_cover">
                                                <h1>Kategori</h1>
                                                <ul>
                                                    <li><a href="#"><i class="fas fa-square"></i>Teknologi
                                                            Informasi</a></li>
                                                    <li><a href="#"><i class="fas fa-square"></i>Desain Grafis</a>
                                                    </li>
                                                    <li><a href="#"><i class="fas fa-square"></i>Pendidikan</a></li>
                                                    <li><a href="#"><i class="fas fa-square"></i>Konstruksi</a></li>
                                                </ul>
                                            </div>
                                        </div>
                                        <div class="candidate_width">
                                            <div class="jen_tabs_conent_list jb_cover">
                                                <h1>Lokasi</h1>
                                                <ul>
                                                    <li><a href="#"><i class="fas fa-square"></i>Jakarta</a></li>
                                                    <li><a href="#"><i class="fas fa-square"></i>Bandung</a></li>
                                                    <li><a href="#"><i class="fas fa-square"></i>Surabaya</a></li>
                                                    <li><a href="#"><i class="fas fa-square"></i>Makassar</a></li>
                                                </ul>
                                            </div>
                                        </div>
                                        <div class="candidate_width">
                                            <div class="jen_tabs_conent_list jb_cover">
                                                <h1>Lowongan Terbuka</h1>
                                                <div class="open_jobs_wrapper">
                                                    <div class="open_jobs_wrapper_1 jb_cover">
                                                        <img src="{{ asset('images/job1.jpg') }}" alt="img">
                                                        <div class="open_job_text">
                                                            <h3><a href="jobs.show', 1) }}">UI/UX Designer</a>
                                                            </h3>
                                                            <p>5 jam lalu</p>
                                                        </div>
                                                    </div>
                                                    <div class="open_jobs_wrapper_1 jb_cover">
                                                        <img src="{{ asset('images/job1.jpg') }}" alt="img">
                                                        <div class="open_job_text">
                                                            <h3><a href="jobs.show', 2) }}">Backend
                                                                    Developer</a></h3>
                                                            <p>12 jam lalu</p>
                                                        </div>
                                                    </div>
                                                    <div class="view_all_job jb_cover"><a href="/lowongan">Lihat
                                                            semua</a></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div><!-- /jn_menu_partion_div -->
                                </div>
                            </li>
                        </ul>
                    </li>

                    <li class="has-mega gc_main_navigation">
                        <a href="#" class="gc_main_navigation">Halaman</a>
                        <ul class="navi_2_dropdown">
                            <li class="parent"><a href="about') }}"><i class="fas fa-square"></i>Tentang
                                    Kami</a></li>
                            <li class="parent"><a href="companies.index') }}"><i class="fas fa-square"></i>Perusahaan</a>
                            </li>
                            <li class="parent"><a href="login') }}"><i class="fas fa-square"></i>Masuk</a>
                            </li>
                            <li class="parent"><a href="pricing') }}"><i class="fas fa-square"></i>Paket
                                    Harga</a></li>
                            <li class="parent"><a href="register') }}"><i class="fas fa-square"></i>Daftar</a>
                            </li>
                        </ul>
                    </li>

                    <li class="has-mega gc_main_navigation">
                        <a href="#" class="gc_main_navigation">Dasbor</a>
                        <ul class="navi_2_dropdown">
                            <li class="parent">
                                <a href="#"><i class="fas fa-square"></i>Kandidat<span><i
                                            class="fas fa-chevron-right"></i></span></a>
                                <ul class="dropdown-menu-right">
                                    <li><a href="candidate.dashboard') }}"><i class="fas fa-square"></i>Dasbor</a></li>
                                    <li><a href="candidate.applications') }}"><i class="fas fa-square"></i>Lamaran
                                            Saya</a></li>
                                    <li><a href="candidate.resume') }}"><i class="fas fa-square"></i>Resume</a>
                                    </li>
                                    <li><a href="messages.index') }}"><i class="fas fa-square"></i>Pesan</a>
                                    </li>
                                    <li><a href="candidate.pricing') }}"><i class="fas fa-square"></i>Paket</a>
                                    </li>
                                </ul>
                            </li>
                            <li class="parent">
                                <a href="#"><i class="fas fa-square"></i>Perusahaan<span><i
                                            class="fas fa-chevron-right"></i></span></a>
                                <ul class="dropdown-menu-right">
                                    <li><a href="employer.dashboard') }}"><i class="fas fa-square"></i>Dasbor</a></li>
                                    <li><a href="employer.jobs.index') }}"><i class="fas fa-square"></i>Kelola
                                            Lowongan</a></li>
                                    <li><a href="employer.jobs.create') }}"><i class="fas fa-square"></i>Pasang
                                            Lowongan</a></li>
                                    <li><a href="employer.applications') }}"><i class="fas fa-square"></i>Lamaran
                                            Masuk</a></li>
                                    <li><a href="messages.index') }}"><i class="fas fa-square"></i>Pesan</a>
                                    </li>
                                    <li><a href="employer.pricing') }}"><i class="fas fa-square"></i>Paket</a>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </li>

                    <li class="has-mega gc_main_navigation">
                        <a href="blog.index') }}" class="gc_main_navigation">Blog</a>
                        <ul class="navi_2_dropdown">
                            <li class="parent"><a href="blog.index') }}"><i class="fas fa-square"></i>Artikel</a></li>
                        </ul>
                    </li>

                    <li><a href="contact') }}" class="gc_main_navigation">Kontak</a></li>
                </ul>
            </div>
        </div>
    </div>

    <!-- HERO / SLIDER -->
    <div class="main_slider_wrapper slider-area jb_cover">
        <div class="mains_slider_shaper"><img src="{{ asset('images/slider_bg.png') }}" class="img-responsive"
                alt=""></div>
        <div class="slider_small2_shape"><img src="{{ asset('images/shape4.png') }}" class="img-responsive"
                alt=""></div>
        <div class="slider_shape_smt bubble-1"><img src="{{ asset('images/bubble.png') }}" class="img-responsive"
                alt=""></div>

        <div id="carousel-example-generic" class="carousel slide" data-ride="carousel" data-interval="false">
            <div class="carousel-inner" role="listbox">
                <div class="carousel-item active">
                    <div class="carousel-captions caption-1">
                        <div class="container">
                            <div class="row">
                                <div class="col-xl-6 col-lg-6 col-md-12">
                                    <div class="content">
                                        <div class="slider_shape_smt1 bubble-2"><img
                                                src="{{ asset('images/bubble.png') }}" class="img-responsive"
                                                alt=""></div>
                                        <h2 data-animation="animated fadeInUp">Temukan <span>Lowongan</span> yang Relevan
                                            untukmu</h2>
                                        <p data-animation="animated fadeInUp">
                                            WORKIO mempertemukan <strong>pelamar</strong> dan <strong>perusahaan</strong>
                                            dalam satu platform web.
                                            Cari, lamar, dan kelola proses rekrutmen secara lebih efisien.
                                        </p>
                                        <div data-animation="animated fadeInUp" class="btn_hover slider_btn">
                                            <a href="/register">Daftar Gratis</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-6 col-lg-6 col-md-12">
                                    <div class="slider_shape_sm3 bubble-3"><img src="{{ asset('images/bubble.png') }}"
                                            class="img-responsive" alt=""></div>
                                    <div class="slider_side_img jb_cover"><img src="{{ asset('images/slider_img.png') }}"
                                            class="img-responsive" alt=""></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- slide lain (teks diseragamkan) -->
                <div class="carousel-item">
                    <div class="carousel-captions caption-2">
                        <div class="container">
                            <div class="row">
                                <div class="col-xl-6 col-lg-6 col-md-12">
                                    <div class="content">
                                        <h2 data-animation="animated fadeInUp">Pasang <span>Lowongan</span> & Kelola
                                            Lamaran</h2>
                                        <p data-animation="animated fadeInUp">Perusahaan dapat memposting lowongan dan
                                            meninjau lamaran masuk secara terstruktur.</p>
                                        <div data-animation="animated fadeInUp" class="btn_hover slider_btn">
                                            <a href="employer.jobs.create') }}">Pasang Lowongan</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-6 col-lg-6 col-md-12">
                                    <div class="slider_side_img jb_cover"><img src="{{ asset('images/slider_img.png') }}"
                                            class="img-responsive" alt=""></div>
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
                <a class="prev" href="#carousel-example-generic" role="button" data-slide="prev"><i
                        class="flaticon-left-arrow"></i></a>
                <a class="next" href="#carousel-example-generic" role="button" data-slide="next"><i
                        class="flaticon-right-arrow"></i></a>
            </div>
        </div>
        <div class="slider_small_shape"><img src="{{ asset('images/shape4.png') }}" class="img-responsive"
                alt=""></div>
    </div>

    <!-- FORM PENCARIAN -->
    <div class="index3_form_wrapper jb_cover">
        <div class="slider_small3_shape">
            <img src="images/shape4.png" class="img-responsive" alt="img">
        </div>
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12">
                    <div class="index3_form_box jb_cover">
                        <div class="select_box select_box3">

                            <select>
                                <option>category</option>
                                <option>real estate</option>
                                <option>electronics</option>
                                <option>marketing</option>
                                <option>education</option>

                            </select>

                        </div>
                        <div class="select_box select_box3">

                            <select>
                                <option>job title</option>
                                <option>teacher</option>
                                <option>marketing</option>
                                <option>doctor</option>
                                <option>graphic</option>

                            </select>

                        </div>
                        <div class="select_box select_box3">

                            <select>
                                <option>location</option>
                                <option>pune</option>
                                <option>banglore</option>
                                <option>indore</option>
                                <option>bhopal</option>

                            </select>

                        </div>
                        <div class="contect_form3 contct_form_new3">

                            <input type="text" name="name" placeholder="Keyword">
                        </div>
                        <div class="index3_form_search">
                            <a href="#"><i class="fas fa-search"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- LOWONGAN TERBAIK -->
    <div class="best_jobs_wrapper index3_best_job_wrapper jb_cover">
        <div class="line_shape"><img src="{{ asset('images/line.png') }}" class="img-responsive" alt=""></div>
        <div class="container">
            <div class="row">
                <div class="col-lg-10 offset-lg-1 col-12">
                    <div class="jb_heading_wraper">
                        <h3>Lowongan Terbaru untuk Kamu</h3>
                        <p>Telusuri peluang kerja sesuai minat, keterampilan, dan lokasi.</p>
                    </div>
                </div>

                <div class="col-12">
                    <div class="latest_job_tabs index2_tab_wrapper index3_tab_wrapper jb_cover">
                        <ul class="nav nav-tabs">
                            <li class="nav-item"><a class="nav-link active" data-toggle="tab"
                                    href="#tab-terbaru">Terbaru</a></li>
                            <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#tab-populer">Populer</a>
                            </li>
                        </ul>
                    </div>
                </div>

                <div class="col-12">
                    <div class="tab-content">

                        <!-- ====================== TAB: TERBARU ====================== -->
                        <div id="tab-terbaru" class="tab-pane active">
                            <div class="row">

                                <!-- Item 1 -->
                                <div class="col-lg-6 col-md-12 col-sm-12">
                                    <div class="job_listing_left_fullwidth job_listing_grid_wrapper jb_cover">
                                        <div class="row align-items-center">
                                            <div class="col-3">
                                                <div class="jp_job_post_side_img">
                                                    <img src="images/lt1.png" alt="job">
                                                </div>
                                            </div>
                                            <div class="col-9">
                                                <div class="jp_job_post_right_cont">
                                                    <h4><a href="#">Frontend Developer</a></h4>
                                                    <ul>
                                                        <li><i class="flaticon-cash"></i> Rp10.000.000 – Rp15.000.000</li>
                                                        <li><i class="flaticon-location-pointer"></i> Jakarta</li>
                                                    </ul>
                                                    <p>Membangun UI responsif menggunakan React dan Tailwind.</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Item 2 -->
                                <div class="col-lg-6 col-md-12 col-sm-12">
                                    <div class="job_listing_left_fullwidth job_listing_grid_wrapper jb_cover">
                                        <div class="row align-items-center">
                                            <div class="col-3">
                                                <div class="jp_job_post_side_img">
                                                    <img src="images/lt2.png" alt="job">
                                                </div>
                                            </div>
                                            <div class="col-9">
                                                <div class="jp_job_post_right_cont">
                                                    <h4><a href="#">Backend Engineer</a></h4>
                                                    <ul>
                                                        <li><i class="flaticon-cash"></i> Rp12.000.000 – Rp18.000.000</li>
                                                        <li><i class="flaticon-location-pointer"></i> Bandung</li>
                                                    </ul>
                                                    <p>Mengembangkan REST API dengan Laravel dan MySQL.</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Item 3 -->
                                <div class="col-lg-6 col-md-12 col-sm-12">
                                    <div class="job_listing_left_fullwidth job_listing_grid_wrapper jb_cover">
                                        <div class="row align-items-center">
                                            <div class="col-3">
                                                <div class="jp_job_post_side_img">
                                                    <img src="images/lt3.png" alt="job">
                                                </div>
                                            </div>
                                            <div class="col-9">
                                                <div class="jp_job_post_right_cont">
                                                    <h4><a href="#">UI/UX Designer</a></h4>
                                                    <ul>
                                                        <li><i class="flaticon-cash"></i> Rp9.000.000 – Rp13.000.000</li>
                                                        <li><i class="flaticon-location-pointer"></i> Surabaya</li>
                                                    </ul>
                                                    <p>Merancang antarmuka produk digital berbasis user research.</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Item 4 -->
                                <div class="col-lg-6 col-md-12 col-sm-12">
                                    <div class="job_listing_left_fullwidth job_listing_grid_wrapper jb_cover">
                                        <div class="row align-items-center">
                                            <div class="col-3">
                                                <div class="jp_job_post_side_img">
                                                    <img src="images/lt4.png" alt="job">
                                                </div>
                                            </div>
                                            <div class="col-9">
                                                <div class="jp_job_post_right_cont">
                                                    <h4><a href="#">Mobile Developer (Flutter)</a></h4>
                                                    <ul>
                                                        <li><i class="flaticon-cash"></i> Rp7.000.000 – Rp10.000.000</li>
                                                        <li><i class="flaticon-location-pointer"></i> Makassar</li>
                                                    </ul>
                                                    <p>Mengembangkan aplikasi Android & iOS menggunakan Flutter.</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div> <!-- /row -->
                        </div>
                        <!-- ====================== END TAB TERBARU ====================== -->


                        <!-- ====================== TAB: POPULER ====================== -->
                        <div id="tab-populer" class="tab-pane fade">
                            <div class="row">

                                <!-- Item 1 -->
                                <div class="col-lg-6 col-md-12 col-sm-12">
                                    <div class="job_listing_left_fullwidth job_listing_grid_wrapper jb_cover">
                                        <div class="row align-items-center">
                                            <div class="col-3">
                                                <div class="jp_job_post_side_img">
                                                    <img src="images/lt5.png" alt="job">
                                                </div>
                                            </div>
                                            <div class="col-9">
                                                <div class="jp_job_post_right_cont">
                                                    <h4><a href="#">Data Analyst</a></h4>
                                                    <ul>
                                                        <li><i class="flaticon-cash"></i> Rp11.000.000 – Rp14.000.000</li>
                                                        <li><i class="flaticon-location-pointer"></i> Yogyakarta</li>
                                                    </ul>
                                                    <p>Menganalisis data dan membuat laporan bisnis untuk klien.</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Item 2 -->
                                <div class="col-lg-6 col-md-12 col-sm-12">
                                    <div class="job_listing_left_fullwidth job_listing_grid_wrapper jb_cover">
                                        <div class="row align-items-center">
                                            <div class="col-3">
                                                <div class="jp_job_post_side_img">
                                                    <img src="images/lt6.png" alt="job">
                                                </div>
                                            </div>
                                            <div class="col-9">
                                                <div class="jp_job_post_right_cont">
                                                    <h4><a href="#">DevOps Engineer</a></h4>
                                                    <ul>
                                                        <li><i class="flaticon-cash"></i> Rp9.000.000 – Rp14.000.000</li>
                                                        <li><i class="flaticon-location-pointer"></i> Jakarta</li>
                                                    </ul>
                                                    <p>Mengelola CI/CD pipeline dan infrastruktur server cloud.</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Item 3 -->
                                <div class="col-lg-6 col-md-12 col-sm-12">
                                    <div class="job_listing_left_fullwidth job_listing_grid_wrapper jb_cover">
                                        <div class="row align-items-center">
                                            <div class="col-3">
                                                <div class="jp_job_post_side_img">
                                                    <img src="images/lt7.png" alt="job">
                                                </div>
                                            </div>
                                            <div class="col-9">
                                                <div class="jp_job_post_right_cont">
                                                    <h4><a href="#">System Administrator</a></h4>
                                                    <ul>
                                                        <li><i class="flaticon-cash"></i> Rp8.000.000 – Rp12.000.000</li>
                                                        <li><i class="flaticon-location-pointer"></i> Bandung</li>
                                                    </ul>
                                                    <p>Memelihara server, jaringan, dan keamanan sistem perusahaan.</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div> <!-- /row -->
                        </div>
                        <!-- ====================== END TAB POPULER ====================== -->

                    </div>

                    <!-- Tombol Lihat Semua -->
                    <div class="btn_hover slider_btn jobs_btn_3 jb_cover" style="text-align:center; margin-top:1.5rem;">
                        <a href="/lowongan">Lihat semua</a>
                    </div>
                </div>

            </div>
        </div>
        <div class="slider_small3_shape"><img src="{{ asset('images/shape4.png') }}" class="img-responsive"
                alt=""></div>
    </div>

    <!-- COUNTER -->
    <div class="counter_wrapper counter_3_wrapper jb_cover">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-md-12">
                    <div class="counter_mockup_design jb_cover"><img src="{{ asset('images/mockup6.png') }}"
                            class="img-responsive" alt=""></div>
                    <div class="counter_jbbb jb_cover"><img src="{{ asset('images/line2.png') }}" class="img-responsive"
                            alt=""></div>
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

    <!-- FITUR UTAMA -->
    <div class="services_wrapper control_wrapper jb_cover">
        <div class="slider_small_shape44"><img src="{{ asset('images/shape4.png') }}" class="img-responsive"
                alt=""></div>
        <div class="counter_jbbb2 jb_cover"><img src="{{ asset('images/line3.png') }}" class="img-responsive"
                alt=""></div>
        <div class="container">
            <div class="row">
                <div class="col-lg-10 offset-lg-1 col-12">
                    <div class="jb_heading_wraper">
                        <h3>Kendalikan Proses Rekrutmen Anda</h3>
                        <p>Registrasi & login, pencarian lowongan, posting lowongan, lamaran online, notifikasi email, dan
                            dasbor admin.</p>
                    </div>
                </div>

                <!-- Contoh 6 fitur sesuai SRS -->
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
        <div class="slider_small3_shape"><img src="{{ asset('images/shape4.png') }}" class="img-responsive"
                alt=""></div>
    </div>

    <!-- PAKET HARGA -->
    {{-- <section class="pricing_table_3 jb_cover" style="background: #f8f7ff; padding: 80px 0;">
        <div class="container">
            <div class="row text-center">
                <div class="col-lg-10 offset-lg-1 col-12">
                    <div class="jb_heading_wraper mb-5">
                        <h3 style="font-weight: 700;">Pilih Paket</h3>
                        <p style="color: #666;">Sesuaikan kebutuhan rekrutmen perusahaan Anda.</p>
                    </div>
                </div>

                <!-- Paket Basic -->
                <div class="col-lg-4 col-md-6 mb-4">
                    <div class="pricing_box_wrapper jb_cover shadow-sm"
                        style="background:#fff; border-radius:12px; padding:40px 25px; transition:.3s;">
                        <h1 style="font-size:1.4rem; font-weight:700; margin-bottom:1rem;">Basic</h1>
                        <div class="main_pdet jb_cover mb-3">
                            <h2 style="font-size:3rem; font-weight:800; line-height:1;">
                                <span style="font-size:1.2rem; vertical-align:top; margin-right:4px;">Rp</span>149.000
                            </h2>
                            <span style="color:#777;">/ 30 Hari</span>
                        </div>
                        <ul class="pricing_list22 list-unstyled mb-4" style="color:#333; line-height:1.8;">
                            <li>5 Posting Lowongan</li>
                            <li>2 Lowongan Sorotan</li>
                            <li>1 Perpanjangan</li>
                            <li>Durasi 30 Hari</li>
                            <li>Notifikasi Email</li>
                        </ul>
                        <a href="#" class="price_btn"
                            style="display:inline-block; padding:10px 25px; border-radius:30px; background:#2563eb; color:#fff; text-decoration:none; font-weight:500;">Pilih
                            Paket</a>
                    </div>
                </div>

                <!-- Paket Pro -->
                <div class="col-lg-4 col-md-6 mb-4">
                    <div class="pricing_box_wrapper jb_cover shadow-sm"
                        style="background:#fff; border-radius:12px; padding:40px 25px; transition:.3s;">
                        <h1 style="font-size:1.4rem; font-weight:700; margin-bottom:1rem;">Pro</h1>
                        <div class="main_pdet jb_cover mb-3">
                            <h2 style="font-size:3rem; font-weight:800; line-height:1;">
                                <span style="font-size:1.2rem; vertical-align:top; margin-right:4px;">Rp</span>299.000
                            </h2>
                            <span style="color:#777;">/ 30 Hari</span>
                        </div>
                        <ul class="pricing_list22 list-unstyled mb-4" style="color:#333; line-height:1.8;">
                            <li>10 Posting Lowongan</li>
                            <li>5 Lowongan Sorotan</li>
                            <li>2 Perpanjangan</li>
                            <li>Durasi 30 Hari</li>
                            <li>Notifikasi Email</li>
                        </ul>
                        <a href="#" class="price_btn"
                            style="display:inline-block; padding:10px 25px; border-radius:30px; background:#2563eb; color:#fff; text-decoration:none; font-weight:500;">Pilih
                            Paket</a>
                    </div>
                </div>

                <!-- Paket Enterprise -->
                <div class="col-lg-4 col-md-6 mb-4">
                    <div class="pricing_box_wrapper jb_cover shadow-sm"
                        style="background:#fff; border-radius:12px; padding:40px 25px; transition:.3s;">
                        <h1 style="font-size:1.4rem; font-weight:700; margin-bottom:1rem;">Enterprise</h1>
                        <div class="main_pdet jb_cover mb-3">
                            <h2 style="font-size:3rem; font-weight:800; line-height:1;">
                                <span style="font-size:1.2rem; vertical-align:top; margin-right:4px;">Rp</span>599.000
                            </h2>
                            <span style="color:#777;">/ 30 Hari</span>
                        </div>
                        <ul class="pricing_list22 list-unstyled mb-4" style="color:#333; line-height:1.8;">
                            <li>Tak Terbatas Posting</li>
                            <li>Lowongan Sorotan Prioritas</li>
                            <li>Perpanjangan Tak Terbatas</li>
                            <li>Durasi 30 Hari</li>
                            <li>Notifikasi Email</li>
                        </ul>
                        <a href="#" class="price_btn"
                            style="display:inline-block; padding:10px 25px; border-radius:30px; background:#2563eb; color:#fff; text-decoration:none; font-weight:500;">Pilih
                            Paket</a>
                    </div>
                </div>
            </div>
        </div>
    </section> --}}


    <!-- AJAKAN DAFTAR -->
    <div class="popular_wrapper jb_cover">
        <div class="slider_small3_shape shapenew"><img src="{{ asset('images/shape4.png') }}" class="img-responsive"
                alt=""></div>
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
                                    <li><a href="/register/perusahaan" class="price_btn regis_btn">Daftar
                                            sebagai Perusahaan</a></li>
                                </ul>
                            </div>
                        </div>

                        <div class="jp_regis_right_side_box_wrapper">
                            <div class="jp_regis_right_side_box">
                                <i class="flaticon-doctor"></i>
                                <h4>Saya Pelamar</h4>
                                <p>Cari lowongan, unggah CV, dan pantau status lamaran Anda.</p>
                                <ul>
                                    <li><a href="/register/pelamar" class="price_btn regis_btn">Daftar
                                            sebagai Pelamar</a></li>
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

    <!-- RESUME TERBARU -->
    <div class="pricing_table_3 recent_resume_wrapper jb_cover">
        <div class="slider_small_shape44"><img src="{{ asset('images/p2.png') }}" class="img-responsive"
                alt=""></div>
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
                                <h3><a href="candidates.show', $resume->id) }}">{{ $resume->name }}</a></h3>
                                <p><i class="far fa-folder-open"></i> {{ $resume->headline }}</p>
                            </div>
                            <div class="jp_recent_resume_btn_wrapper">
                                <ul>
                                    <li><a href="candidates.show', $resume->id) }}">Lihat Profil</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                @endforeach

                <div class="btn_hover slider_btn jobs_btn_3 vb jb_cover">
                    <a href="/lowongan">Lihat semua</a>
                </div>
            </div>
        </div>
        <div class="counter_jbbb2 jb_cover"><img src="{{ asset('images/line3.png') }}" class="img-responsive"
                alt=""></div>
    </div>

    <!-- NEWSLETTER / AJAKAN -->
    <div class="news_letter_wrapper shaa jb_cover">
        <div class="sha1 bubble-180"><img src="{{ asset('images/bubble2.png') }}" class="img-responsive"
                alt=""></div>
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
                                <a href="/register">Gabung Sekarang</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="sha2 bubble-185"><img src="{{ asset('images/bubble2.png') }}" class="img-responsive"
                alt=""></div>
    </div>
@endsection
