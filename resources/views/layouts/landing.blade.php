<!DOCTYPE html>
<html lang="zxx">

<head>
    <meta charset="utf-8" />
    <title>Workio | @yield('title')</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <meta name="description" content="Workio, info loker bang" />
    <meta name="keywords" content="Workio, info loker bang" />
    <meta name="author" content="" />
    <meta name="MobileOptimized" content="320" />
    <!--Template style -->
    <link rel="stylesheet" type="text/css" href="{{ asset('css/animate.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('css/bootstrap.min.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('css/fonts.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('css/flaticon.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('css/font-awesome.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('css/owl.carousel.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/owl.theme.default.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/dropify.min.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('css/jquery-ui.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/magnific-popup.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('css/nice-select.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('css/reset.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('css/style.css') }}" />

    <link rel="stylesheet" type="text/css" href="{{ asset('css/responsive.css') }}" />
    <!--favicon-->
    <link rel="shortcut icon" type="image/png" href="{{ asset('images/favicon.png') }}" />
    <style>
        .pricing_box_wrapper:hover {
            transform: translateY(-10px);
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.08);
        }

        /* Avatar header */
        .header-avatar-wrapper {
            width: 32px;
            height: 32px;
            border-radius: 50%;
            overflow: hidden;
            border: 2px solid rgba(255, 255, 255, .6);
            display: inline-flex;
            align-items: center;
            justify-content: center;
        }

        .header-avatar-img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .header-avatar-name {
            font-size: 13px;
            font-weight: 500;
        }

        /* Search pill */
        .landing-search-form {
            max-width: 980px;
            margin: 0 auto;
        }

        .landing-search-inner {
            display: flex;
            align-items: stretch;
            background: #ffffff;
            border-radius: 999px;
            border: 1px solid #e5e7eb;
            box-shadow: 0 8px 20px rgba(15, 23, 42, .08);
            overflow: hidden;
        }

        .landing-search-field {
            flex: 1;
            display: flex;
            align-items: center;
            padding: 0 18px;
            min-height: 60px;
        }

        .landing-search-border {
            border-right: 1px solid #e5e7eb;
        }

        .landing-search-input,
        .landing-search-select {
            width: 100%;
            border: none;
            outline: none;
            background: transparent;
            font-size: 14px;
            color: #374151;
        }

        .landing-search-select {
            -webkit-appearance: none;
            -moz-appearance: none;
            appearance: none;
            background-image: url("data:image/svg+xml,%3Csvg width='12' height='8' viewBox='0 0 12 8' fill='none' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M1 1.5L6 6.5L11 1.5' stroke='%239CA3AF' stroke-width='1.5' stroke-linecap='round' stroke-linejoin='round'/%3E%3C/svg%3E");
            background-repeat: no-repeat;
            background-position: right 0px center;
            padding-right: 18px;
        }

        .landing-search-input::placeholder,
        .landing-search-select {
            color: #9ca3af;
        }

        .landing-search-submit {
            width: 72px;
            border: none;
            outline: none;
            cursor: pointer;
            background: linear-gradient(135deg, #a855f7, #6366f1);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 18px;
            color: #ffffff;
        }

        .landing-search-submit i {
            margin-left: 1px;
        }

        .landing-search-submit:hover {
            opacity: 0.9;
        }

        @media (max-width: 767.98px) {
            .landing-search-inner {
                flex-direction: column;
                border-radius: 24px;
            }

            .landing-search-field {
                border-right: none !important;
                border-bottom: 1px solid #e5e7eb;
                min-height: 52px;
            }

            .landing-search-field:last-of-type {
                border-bottom: none;
            }

            .landing-search-submit {
                width: 100%;
                border-radius: 0 0 24px 24px;
                min-height: 50px;
            }
        }

        /* Hilangkan jarak aneh di atas header */
        .cp_navi_main_wrapper.index_2_top_header.index_3_top_header.jb_cover {
            margin-top: 0;
            padding-top: 15px;
            padding-bottom: 15px;
        }

        /* Menu + avatar sejajar rapi */
        .jb_navigation_wrapper .mainmenu .main_nav_ul.menu_2_ul {
            display: flex;
            align-items: center;
            gap: 32px;
            margin: 0;
        }

        .jb_navigation_wrapper .mainmenu .main_nav_ul.menu_2_ul>li {
            display: flex;
            align-items: center;
        }

        .jb_navigation_wrapper .mainmenu .main_nav_ul.menu_2_ul>li>a.gc_main_navigation {
            display: inline-flex;
            align-items: center;
            padding-top: 0;
            padding-bottom: 0;
        }

        /* Style khusus item avatar */
        .header-avatar-item>a.gc_main_navigation {
            display: inline-flex;
            align-items: center;
            gap: 6px;
        }

        /* Buang garis/pseudo-element ungu di bawah avatar */
        .header-avatar-item a.gc_main_navigation::before,
        .header-avatar-item a.gc_main_navigation::after {
            display: none !important;
        }

        /* Avatar kecil dan crop rapi */
        .header-avatar-wrapper {
            width: 28px;
            height: 28px;
            border-radius: 50%;
            overflow: hidden;
            border: 2px solid rgba(255, 255, 255, 0.7);
            display: inline-flex;
            align-items: center;
            justify-content: center;
        }

        .header-avatar-img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .header-avatar-name {
            font-size: 13px;
            font-weight: 500;
            white-space: nowrap;
        }

        /* ... CSS avatar & search kamu yang sebelumnya ... */

        /* ==== PERKECIL JARAK ANTAR SECTION ==== */
        .services_wrapper.control_wrapper {
            padding-top: 60px;
            /* atau sesuaikan selera */
            padding-bottom: 40px;
            /* ini yang biasanya terlalu besar */
        }

        .popular_wrapper {
            margin-top: 0;
            /* buang gap tambahan di atas */
            padding-top: 40px;
            /* cukup sedikit padding */
            padding-bottom: 60px;
        }

        .job-logo-wrapper {
            width: 70px;
            height: 70px;
            border-radius: 16px;
            overflow: hidden;
            display: flex;
            align-items: center;
            justify-content: center;
            background: #ffffff;
            box-shadow: 0 4px 12px rgba(15, 23, 42, 0.08);
        }

        .job-logo-img {
            max-width: 100%;
            max-height: 100%;
            object-fit: contain;
        }
    </style>
</head>

<body>

    <div class="jb_preloader">
        <div class="spinner_wrap">
            <div class="spinner"></div>
        </div>
    </div>
    <div class="cursor cursor2 cursor3"></div>
    <!-- Top Scroll Start --><a href="javascript:" id="return-to-top" class="return_top3"><i
            class="fas fa-angle-double-up"></i></a>
    <!-- Top Scroll End -->
    <!-- cp navi wrapper Start -->
    <nav class="cd-dropdown cd_dropdown_index2 cd_dropdown_index3 d-block d-sm-block d-md-block d-lg-none d-xl-none">
        <h2><a href="index.html"> <span><img src="{{ asset('images/logo5.png') }}" alt="img"></span></a></h2>
        <a href="#0" class="cd-close">Close</a>
        <ul class="cd-dropdown-content">
            <li>
                <form class="cd-search">
                    <input type="search" placeholder="Search...">
                </form>
            </li>
            <li class="has-children">
                <a href="#">home</a>
                <ul class="cd-secondary-dropdown icon_menu is-hidden">
                    <li class="go-back"><a href="#0">Menu</a></li>
                    <li><a href="index.html">home I</a></li>
                    <li><a href="index_II.html">home II</a></li>
                    <li><a href="index_III.html">home III</a></li>
                </ul>
            </li>
            <li class="has-children">
                <a href="#">jobs</a>
                <ul class="cd-secondary-dropdown icon_menu is-hidden">
                    <li class="go-back"><a href="#0">Menu</a></li>
                    <li><a href="job_listing_grid_left_filter.html">job listing grid </a></li>
                    <li><a href="job_listing_list_left_filter.html">job listing list</a></li>
                    <li><a href="job_single.html">job single</a></li>
                </ul>
            </li>
            <!-- .has-children -->
            <li class="has-children">
                <a href="#">pages</a>
                <ul class="cd-secondary-dropdown icon_menu is-hidden">
                    <li class="go-back"><a href="#0">Menu</a></li>
                    <li><a href="about_us.html">about us</a></li>
                    <li><a href="companies.html">companies</a></li>
                    <li><a href="company_single.html">company single</a></li>
                    <li><a href="error_page.html">error page</a></li>
                    <li><a href="login.html">login</a></li>
                    <li><a href="pricing_table.html">pricing table</a></li>
                    <li><a href="sign_up.html">sign up</a></li>
                </ul>
            </li>
            <li class="has-children">
                <a href="#">dashboard</a>
                <ul class="cd-secondary-dropdown is-hidden">
                    <li class="go-back"><a href="#0">Menu</a>
                    </li>
                    <li class="has-children"> <a href="#">candidate</a>
                        <ul class="cd-secondary-dropdown is-hidden">
                            <li class="go-back"><a href="#0">Menu</a>
                            </li>
                            <li>
                                <a
                                    href="https://webstrot.com/html/jbdesk/main_version/dashboard/candidate_applied_job.html">applied
                                    job </a>
                            </li>
                            <li>
                                <a
                                    href="https://webstrot.com/html/jbdesk/main_version/dashboard/candidate_dashboard.html">dashboard</a>
                            </li>
                            <li>
                                <a
                                    href="https://webstrot.com/html/jbdesk/main_version/dashboard/candidate_edit_profile.html">
                                    edit profile</a>
                            </li>
                            <li>
                                <a
                                    href="https://webstrot.com/html/jbdesk/main_version/dashboard/candidate_favourite_job.html">favourite
                                    job</a>
                            </li>
                            <li>
                                <a
                                    href="https://webstrot.com/html/jbdesk/main_version/dashboard/candidate_resume.html">
                                    resume</a>
                            </li>
                            <li>
                                <a href="https://webstrot.com/html/jbdesk/main_version/dashboard/message.html">
                                    message</a>
                            </li>
                            <li>
                                <a href="https://webstrot.com/html/jbdesk/main_version/dashboard/pricing_plans.html">pricing
                                    plans</a>
                            </li>
                        </ul>
                        <!-- .cd-secondary-dropdown -->
                    </li>
                    <!-- .has-children -->
                    <li class="has-children"> <a href="#">company</a>
                        <ul class="cd-secondary-dropdown is-hidden">
                            <li class="go-back"><a href="#0">Menu</a>
                            </li>
                            <li>
                                <a
                                    href="https://webstrot.com/html/jbdesk/main_version/dashboard/comp_applications.html">
                                    applications </a>
                            </li>
                            <li>
                                <a
                                    href="https://webstrot.com/html/jbdesk/main_version/dashboard/comp_company_page.html">company
                                    page</a>
                            </li>
                            <li>
                                <a
                                    href="https://webstrot.com/html/jbdesk/main_version/dashboard/comp_employer_dashboard.html">
                                    dashboard</a>
                            </li>
                            <li>
                                <a
                                    href="https://webstrot.com/html/jbdesk/main_version/dashboard/comp_employer_edit_profile.html">edit
                                    profile</a>
                            </li>
                            <li>
                                <a
                                    href="https://webstrot.com/html/jbdesk/main_version/dashboard/comp_employer_manage_jobs.html">
                                    manage jobs</a>
                            </li>
                            <li>
                                <a
                                    href="https://webstrot.com/html/jbdesk/main_version/dashboard/comp_post_new_job.html">
                                    post new job</a>
                            </li>
                            <li>
                                <a
                                    href="https://webstrot.com/html/jbdesk/main_version/dashboard/message.html">message</a>
                            </li>
                            <li>
                                <a href="https://webstrot.com/html/jbdesk/main_version/dashboard/pricing_plans.html">pricing
                                    plans</a>
                            </li>
                        </ul>
                        <!-- .cd-secondary-dropdown -->
                    </li>
                </ul>
                <!-- .cd-secondary-dropdown -->
            </li>
            <li class="has-children">
                <a href="#">blog</a>
                <ul class="cd-secondary-dropdown icon_menu is-hidden">
                    <li class="go-back"><a href="#0">Menu</a></li>
                    <li><a href="blog_single.html">blog single</a></li>
                    <li><a href="blog_category_right_sidebar.html">blog category</a></li>
                </ul>
            </li>
            <li><a href="contact_us.html">contact us </a></li>
            <li><a href="login.html">login</a></li>
        </ul>
        <!-- .cd-dropdown-content -->
    </nav>


    @yield('content')


    <!-- footer Wrapper Start -->
    <div class="footer index2_footer_wrapper footer_index3 shaa jb_cover">
        <div class="ft_shape bubble-18">
            <img src="images/bubble2.png" class="img-responsive " alt="img">
        </div>

        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-sm-6 col-12">
                    <div class="footerNav jb_cover">
                        {{-- <a href="#"><img src="images/logo5.png" alt="img"></a>  --}}
                        <ul class="footer_first_contact">
                            <li><i class="flaticon-location-pointer"></i>
                                <p>Wonomulyo, Polewali Mandar
                                    <br> Sulawesi Barat, Indonesia.
                                </p>
                            </li>
                        </ul>

                    </div>
                </div>
                <div class="col-lg-3 col-sm-6 col-12">
                    <div class="footerNav jb_cover footer_border_displ">
                        <ul class="footer_first_contact">

                            <li><i class="flaticon-telephone"></i>
                                <p>+62 8123-4567-8901
                                    <br> +62 8123-4567-8901
                                </p>
                            </li>

                        </ul>
                    </div>
                </div>
                <div class="col-lg-3 col-sm-6 col-12">
                    <div class="footerNav jb_cover footer_border_displ">
                        <ul class="footer_first_contact">
                            <li><i class="flaticon-envelope"></i><a href="#">info@workio.com </a>
                                <br>
                                <a href="#">support@workio.com</a>
                            </li>

                        </ul>
                    </div>
                </div>
                <div class="col-lg-3 col-sm-6 col-12">
                    <div class="footerNav jb_cover">
                        <ul class="icon_list_news index2_icon_list jb_cover">
                            <li><a href="#"><i class="fab fa-facebook-f"></i></a></li>
                            <li>
                                <a href="#"><i class="fab fa-twitter"></i>
                                </a>
                            </li>
                            <li><a href="#"><i class="fab fa-linkedin-in"></i></a></li>
                            <li><a href="#"><i class="fab fa-google-plus-g"></i></a></li>

                        </ul>
                    </div>
                </div>
                <div class="copyright_left"><i class="fa fa-copyright"></i> 2025 | Made With ❤️ by <a
                        href="https://github.com/barcodew"> Barcodew. </a>
                </div>

                <div class="clearfix"></div>
            </div>
            <!--/.row-->
        </div>
        <!--/.container-->
        <div class="waveWrapper waveAnimation">
            <div class="waveWrapperInner bgTop gradient-color">
                <div class="wave waveTop wavetop_1 wavetop_3"></div>
            </div>
            <div class="waveWrapperInner bgMiddle">
                <div class="wave waveMiddle"></div>
            </div>
            <div class="waveWrapperInner bgBottom">
                <div class="wave waveBottom wavebottom_1 wavebottom_3"></div>
            </div>
        </div>
        <div class="ft_shape2 bubble-190">
            <img src="images/bubble2.png" class="img-responsive " alt="img">
        </div>
        <div class="ft_shape1 bubble-19">
            <img src="images/bubble2.png" class="img-responsive " alt="img">
        </div>
    </div>

    <!-- footer Wrapper End -->
    <!-- chat box Wrapper start -->
    <div id="chat-circle" class="btn btn-raised circle_index3">
        <i class="fas fa-comment-alt"></i>
    </div>
    <div class="chat-box chat_box_3">
        <div class="chat-box-header">
            ChatBot
            <span class="chat-box-toggle"><i class="fas fa-times"></i></span>
        </div>
        <div class="chat-box-body chat_msg_box22">
            <div class="chat-box-overlay">
            </div>
            <div class="chat-logs">

            </div><!--chat-log -->
        </div>
        <div class="chat-input">
            <form>
                <input type="text" id="chat-input" placeholder="Send a message..." />
                <button type="submit" class="chat-submit" id="chat-submit"><i
                        class="fas fa-paper-plane"></i></button>
            </form>
        </div>
    </div>
    <!-- chat box Wrapper end -->
    <!--custom js files-->
    <script src="{{ asset('js/jquery-3.3.1.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('js/modernizr.js') }}"></script>
    <script src="{{ asset('js/jquery.menu-aim.js') }}"></script>
    <script src="{{ asset('js/plugin.js') }}"></script>
    <script src="{{ asset('js/owl.carousel.js') }}"></script>
    <script src="{{ asset('js/jquery-ui.js') }}"></script>
    <script src="{{ asset('js/jquery.countTo.js') }}"></script>
    <script src="{{ asset('js/jquery.magnific-popup.js') }}"></script>
    <script src="{{ asset('js/dropify.min.js') }}"></script>
    <script src="{{ asset('js/jquery.inview.min.js') }}"></script>
    <script src="{{ asset('js/jquery.nice-select.min.js') }}"></script>
    <script src="{{ asset('js/imagesloaded.pkgd.min.js') }}"></script>
    <script src="{{ asset('js/isotope.pkgd.min.js') }}"></script>
    <script src="{{ asset('js/custom.js') }}"></script>
    <!-- custom js-->
</body>


</html>
