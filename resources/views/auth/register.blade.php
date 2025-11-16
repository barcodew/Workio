<!DOCTYPE html>
<html lang="zxx">

<head>
    <meta charset="utf-8" />
    <title>sign up</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <meta name="description" content="JB desks,job portal,job" />
    <meta name="keywords" content="JB desks,job portal,job" />
    <meta name="author" content="" />
    <meta name="MobileOptimized" content="320" />

    <!-- Template style -->
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
    <!-- favicon -->
    <link rel="shortcut icon" type="image/png" href="{{ asset('images/favicon.png') }}" />
</head>

<body>
    <!-- preloader Start -->
    <div class="jb_preloader">
        <div class="spinner_wrap">
            <div class="spinner"></div>
        </div>
    </div>
    <div class="cursor"></div>
    <a href="javascript:" id="return-to-top"><i class="fas fa-angle-double-up"></i></a>

    <!-- cp navi wrapper Start -->
    <nav class="cd-dropdown d-block d-sm-block d-md-block d-lg-none d-xl-none">
        <h2>
            <a href="{{ url('/') }}">
                <span><img src="{{ asset('images/logo.png') }}" alt="img"></span>
            </a>
        </h2>
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
                    <li><a href="{{ url('/') }}">home I</a></li>
                    <li><a href="{{ url('/') }}">home II</a></li>
                    <li><a href="{{ url('/') }}">home III</a></li>
                </ul>
            </li>
            <li class="has-children">
                <a href="#">jobs</a>
                <ul class="cd-secondary-dropdown icon_menu is-hidden">
                    <li class="go-back"><a href="#0">Menu</a></li>
                    <li><a href="#">job listing grid</a></li>
                    <li><a href="#">job listing list</a></li>
                    <li><a href="#">job single</a></li>
                </ul>
            </li>
            <li class="has-children">
                <a href="#">pages</a>
                <ul class="cd-secondary-dropdown icon_menu is-hidden">
                    <li class="go-back"><a href="#0">Menu</a></li>
                    <li><a href="#">about us</a></li>
                    <li><a href="#">companies</a></li>
                    <li><a href="#">company single</a></li>
                    <li><a href="#">error page</a></li>
                    <li><a href="{{ route('login') }}">login</a></li>
                    <li><a href="#">pricing table</a></li>
                    <li><a href="{{ route('register') }}">sign up</a></li>
                </ul>
            </li>
            <li><a href="#">contact us</a></li>
            <li><a href="{{ route('login') }}">login</a></li>
        </ul>
    </nav>

    <div class="cp_navi_main_wrapper jb_cover">
        <div class="container-fluid">
            <div class="cp_logo_wrapper">
                <a href="{{ url('/') }}">
                    <img src="{{ asset('images/logo.png') }}" alt="logo">
                </a>
            </div>

            <header class="mobail_menu d-block d-sm-block d-md-block d-lg-none d-xl-none">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="cd-dropdown-wrapper">
                                <a class="house_toggle" href="#0">
                                    <!-- svg menu icon -->
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 31.177 31.177"
                                        width="25" height="25">
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

            <div class="menu_btn_box header_btn jb_cover">
                <ul>
                    <li><a href="{{ route('register') }}"><i class="flaticon-man-user"></i> sign up</a></li>
                    <li><a href="{{ route('login') }}"><i class="flaticon-login"></i> login</a></li>
                </ul>
            </div>

            <div class="jb_navigation_wrapper">
                <div class="mainmenu d-xl-block d-lg-block d-md-none d-sm-none d-none">
                    <ul class="main_nav_ul">
                        <li class="has-mega gc_main_navigation"><a href="#" class="gc_main_navigation">home</a>
                        </li>
                        <li class="has-mega gc_main_navigation"><a href="#" class="gc_main_navigation">jobs</a>
                        </li>
                        <li class="has-mega gc_main_navigation kv_sub_menu"><a href="#"
                                class="gc_main_navigation">candidates</a></li>
                        <li class="has-mega gc_main_navigation"><a href="#"
                                class="gc_main_navigation active_class">pages</a></li>
                        <li class="has-mega gc_main_navigation"><a href="#"
                                class="gc_main_navigation">dashboard</a></li>
                        <li class="has-mega gc_main_navigation"><a href="#" class="gc_main_navigation">blog</a>
                        </li>
                        <li><a href="#" class="gc_main_navigation">contact</a></li>
                    </ul>
                </div>

                <div class="jb_search_btn_wrapper d-none d-sm-none d-md-none d-lg-block d-xl-block">
                    <div class="extra-nav">
                        <div class="extra-cell">
                            <button id="quik-search-btn" type="button" class="site-button radius-xl">
                                <i class="fas fa-search"></i>
                            </button>
                        </div>
                    </div>
                    <div class="dez-quik-search bg-primary-dark">
                        <form action="#">
                            <input name="search" type="text" class="form-control"
                                placeholder="Type to search...">
                            <span id="quik-search-remove"><i class="fas fa-times"></i></span>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- top header wrapper start -->
    <div class="page_title_section">
        <div class="page_header">
            <div class="container">
                <div class="row">
                    <div class="col-lg-9 col-md-8 col-12 col-sm-7">
                        <h1>sign up</h1>
                    </div>
                    <div class="col-lg-3 col-md-4 col-12 col-sm-5">
                        <div class="sub_title_section">
                            <ul class="sub_title">
                                <li><a href="{{ url('/') }}"> Home </a>&nbsp; / &nbsp; </li>
                                <li>sign up</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- sign up wrapper start -->
    <div class="login_wrapper jb_cover">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12">
                    <div class="login_top_box jb_cover">
                        <div class="login_banner_wrapper">
                            <img src="{{ asset('images/logo.png') }}" alt="logo">

                            <div class="header_btn search_btn facebook_wrap jb_cover">
                                <a href="#">login with facebook <i class="fab fa-facebook-f"></i></a>
                            </div>
                            <div class="header_btn search_btn google_wrap jb_cover">
                                <a href="#">login with pinterest <i class="fab fa-pinterest-p"></i></a>
                            </div>

                            <div class="jp_regis_center_tag_wrapper jb_register_red_or">
                                <h1>OR</h1>
                            </div>
                        </div>

                        <div class="login_form_wrapper signup_wrapper">
                            <h2>sign up</h2>

                            {{-- Alert daftar error global --}}
                            @if ($errors->any())
                                <div class="alert alert-danger" style="margin-bottom:18px;">
                                    <ul style="margin:0;padding-left:18px;">
                                        @foreach ($errors->all() as $e)
                                            <li>{{ $e }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif

                            <form method="POST" action="{{ route('register.post') }}">
                                @csrf

                                <div class="form-group icon_form comments_form">
                                    <input type="text" class="form-control @error('name') is-invalid @enderror"
                                        name="name" value="{{ old('name') }}" placeholder="Full Name *"
                                        required>
                                    <i class="fas fa-user"></i>
                                    @error('name')
                                        <small class="text-danger d-block mt-1">{{ $message }}</small>
                                    @enderror
                                </div>

                                <div class="form-group icon_form comments_form">
                                    <input type="email" class="form-control @error('email') is-invalid @enderror"
                                        name="email" value="{{ old('email') }}" placeholder="Email Address *"
                                        required>
                                    <i class="fas fa-envelope"></i>
                                    @error('email')
                                        <small class="text-danger d-block mt-1">{{ $message }}</small>
                                    @enderror
                                </div>

                                <div class="form-group icon_form comments_form">
                                    <input type="password"
                                        class="form-control @error('password') is-invalid @enderror" name="password"
                                        placeholder="Password *" required>
                                    <i class="fas fa-lock"></i>
                                    @error('password')
                                        <small class="text-danger d-block mt-1">{{ $message }}</small>
                                    @enderror
                                </div>

                                <div class="form-group icon_form comments_form">
                                    <input type="password" class="form-control" name="password_confirmation"
                                        placeholder="Confirm Password *" required>
                                    <i class="fas fa-lock"></i>
                                </div>

                                <div class="form-group icon_form comments_form">
                                    <select name="role"
                                        class="form-control nice-select @error('role') is-invalid @enderror" required>
                                        <option value="" disabled {{ old('role') ? '' : 'selected' }}>Pilih Role
                                            *</option>
                                        <option value="pelamar" {{ old('role') === 'pelamar' ? 'selected' : '' }}>
                                            Pelamar</option>
                                        <option value="perusahaan"
                                            {{ old('role') === 'perusahaan' ? 'selected' : '' }}>Perusahaan</option>
                                        {{-- <option value="admin" {{ old('role') === 'admin' ? 'selected' : '' }}>Admin</option> --}}
                                    </select>
                                    <i class="fas fa-users"></i>
                                    @error('role')
                                        <small class="text-danger d-block mt-1">{{ $message }}</small>
                                    @enderror
                                </div>

                                <div class="login_remember_box">
                                    <label class="control control--checkbox">Remember me
                                        <input type="checkbox" name="remember"
                                            {{ old('remember') ? 'checked' : '' }}>
                                        <span class="control__indicator"></span>
                                    </label>
                                    <a href="{{ route('home') }}" class="forget_password">Forgot
                                        Password</a>
                                </div>

                                <div class="header_btn search_btn login_btn jb_cover">
                                    <button type="submit" class="btn"
                                        style="border:none;background:transparent;">sign up</button>
                                </div>
                            </form>

                            <div class="dont_have_account jb_cover">
                                <p>Sudah punya akun? <a href="{{ route('login') }}">login</a></p>
                            </div>
                        </div> <!-- /.login_form_wrapper -->
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- sign up wrapper end -->

    <!-- news app wrapper start-->
    <div class="news_letter_wrapper jb_cover">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12">
                    <div class="job_newsletter_wrapper jb_cover">
                        <div class="jb_newslwtteter_left">
                            <h2>Looking For A Job</h2>
                            <p>Your next level Product development company assets Your next level Product</p>
                        </div>
                        <div class="jb_newslwtteter_button">
                            <div class="header_btn search_btn news_btn jb_cover">
                                <a href="#">submit</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- footer Wrapper Start -->
    <div class="footer jb_cover">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-sm-6 col-12">
                    <div class="footerNav jb_cover">
                        <a href="{{ url('/') }}"><img src="{{ asset('images/logo2.png') }}"
                                alt="img"></a>
                        <ul class="footer_first_contact">
                            <li><i class="flaticon-location-pointer"></i>
                                <p>123 City Avenue, Floor 10,<br> Malbourne, Australia.</p>
                            </li>
                            <li><i class="flaticon-telephone"></i>
                                <p>1 -234 -456 -7890<br>1 -234 -456 -7890</p>
                            </li>
                            <li><i class="flaticon-envelope"></i>
                                <a href="mailto:info@Jbdesks.com">info@Jbdesks.com</a><br>
                                <a href="mailto:support@Jbdesks.com">support@Jbdesks.com</a>
                            </li>
                        </ul>
                        <ul class="icon_list_news jb_cover">
                            <li><a href="#"><i class="fab fa-facebook-f"></i></a></li>
                            <li><a href="#"><i class="fab fa-twitter"></i></a></li>
                            <li><a href="#"><i class="fab fa-linkedin-in"></i></a></li>
                            <li><a href="#"><i class="fab fa-google-plus-g"></i></a></li>
                        </ul>
                    </div>
                </div>

                <div class="col-lg-3 col-sm-6 col-12">
                    <div class="footerNav jb_cover footer_border_displ">
                        <h5>features</h5>
                        <ul class="nav-widget">
                            <li><a href="#"><i class="fa fa-square"></i>Job Management & Billing</a></li>
                            <li><a href="#"><i class="fa fa-square"></i>Time & Materials Tracking</a></li>
                            <li><a href="#"><i class="fa fa-square"></i>Standards Compliance</a></li>
                            <li><a href="#"><i class="fa fa-square"></i>Real Time GPS Tracking</a></li>
                            <li><a href="#"><i class="fa fa-square"></i>Client Portal</a></li>
                            <li><a href="#"><i class="fa fa-square"></i>Powerful Workflow</a></li>
                        </ul>
                    </div>
                </div>

                <div class="col-lg-3 col-sm-6 col-12">
                    <div class="footerNav jb_cover footer_border_displ">
                        <h5>browse</h5>
                        <ul class="nav-widget">
                            <li><a href="#"><i class="fa fa-square"></i>Freelancers by Category</a></li>
                            <li><a href="#"><i class="fa fa-square"></i>Freelancers in USA</a></li>
                            <li><a href="#"><i class="fa fa-square"></i>Freelancers in UK</a></li>
                            <li><a href="#"><i class="fa fa-square"></i>Freelancers in Canada</a></li>
                            <li><a href="#"><i class="fa fa-square"></i>Freelancers in India</a></li>
                            <li><a href="#"><i class="fa fa-square"></i>Find jobs</a></li>
                        </ul>
                    </div>
                </div>

                <div class="col-lg-3 col-sm-6 col-12">
                    <div class="footerNav jb_cover footer_border_displ">
                        <h5>app & integration</h5>
                        <ul class="nav-widget">
                            <li><a href="#"><img src="{{ asset('images/ft1.png') }}" alt="img">Xero</a>
                            </li>
                            <li><a href="#"><img src="{{ asset('images/ft2.png') }}" alt="img">Reckon</a>
                            </li>
                            <li><a href="#"><img src="{{ asset('images/ft3.png') }}"
                                        alt="img">Flexidocs</a></li>
                            <li><a href="#"><img src="{{ asset('images/ft4.png') }}" alt="img">Microsoft
                                    Exchange</a></li>
                            <li><a href="#"><img src="{{ asset('images/ft5.png') }}"
                                        alt="img">Mailchimp</a></li>
                            <li><a href="#"><img src="{{ asset('images/ft6.png') }}" alt="img">MYOB</a>
                            </li>
                        </ul>
                    </div>
                </div>

                <div class="copyright_left">
                    <i class="fa fa-copyright"></i> {{ date('Y') }}
                    <a href="#">JB desks.</a> All Rights Reserved.
                </div>
                <div class="clearfix"></div>
            </div>
        </div>

        <div class="waveWrapper waveAnimation">
            <div class="waveWrapperInner bgTop gradient-color">
                <div class="wave waveTop"></div>
            </div>
            <div class="waveWrapperInner bgMiddle">
                <div class="wave waveMiddle"></div>
            </div>
            <div class="waveWrapperInner bgBottom">
                <div class="wave waveBottom"></div>
            </div>
        </div>
    </div>
    <!-- footer Wrapper End -->

    <!-- chat box Wrapper start -->
    <div id="chat-circle" class="btn btn-raised">
        <i class="fas fa-comment-alt"></i>
    </div>
    <div class="chat-box">
        <div class="chat-box-header">
            ChatBot
            <span class="chat-box-toggle"><i class="fas fa-times"></i></span>
        </div>
        <div class="chat-box-body">
            <div class="chat-box-overlay"></div>
            <div class="chat-logs"></div>
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

    <!-- custom js files -->
    <script src="{{ asset('js/jquery-3.3.1.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('js/modernizr.js') }}"></script>
    <script src="{{ asset('js/jquery.menu-aim.js') }}"></script>
    <script src="{{ asset('js/plugin.js') }}"></script>
    <script src="{{ asset('js/owl.carousel.js') }}"></script>
    <script src="{{ asset('js/jquery.countTo.js') }}"></script>
    <script src="{{ asset('js/jquery-ui.js') }}"></script>
    <script src="{{ asset('js/dropify.min.js') }}"></script>
    <script src="{{ asset('js/jquery.magnific-popup.js') }}"></script>
    <script src="{{ asset('js/jquery.inview.min.js') }}"></script>
    <script src="{{ asset('js/jquery.nice-select.min.js') }}"></script>
    <script src="{{ asset('js/imagesloaded.pkgd.min.js') }}"></script>
    <script src="{{ asset('js/isotope.pkgd.min.js') }}"></script>
    <script src="{{ asset('js/custom.js') }}"></script>
</body>

</html>
