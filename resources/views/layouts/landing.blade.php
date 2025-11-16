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
                            <li><i class="flaticon-telephone"></i>
                                <p>+62 8123-4567-8901
                                    <br> +62 8123-4567-8901
                                </p>
                            </li>
                            <li><i class="flaticon-envelope"></i><a href="#">info@workio.com </a>
                                <br>
                                <a href="#">support@workio.com</a>
                            </li>

                        </ul>

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
                <div class="col-lg-3 col-sm-6 col-12">
                    <div class="footerNav jb_cover footer_border_displ">
                        <h5>features</h5>
                        <ul class="nav-widget">
                            <li><a href="#"><i class="fa fa-square"></i>Job Management & Billing
                                </a></li>

                            <li><a href="#"><i class="fa fa-square"></i>Time & Materials Tracking
                                </a></li>

                            <li><a href="#"><i class="fa fa-square"></i>Standards Compliance
                                </a></li>

                            <li><a href="#"><i class="fa fa-square"></i>Real Time GPS Tracking
                                </a></li>

                            <li><a href="#"><i class="fa fa-square"></i>Client Portal
                                </a></li>

                            <li><a href="#"><i class="fa fa-square"></i> Powerful Workflow</a></li>

                        </ul>
                    </div>
                </div>
                <div class="col-lg-3 col-sm-6 col-12">
                    <div class="footerNav jb_cover footer_border_displ">
                        <h5>browse</h5>
                        <ul class="nav-widget">

                            <li><a href="#"><i class="fa fa-square"></i>Freelancers by Category</a></li>

                            <li><a href="#"><i class="fa fa-square"></i> Freelancers in USA </a></li>

                            <li><a href="#"><i class="fa fa-square"></i> Freelancers in UK</a></li>

                            <li><a href="#"><i class="fa fa-square"></i> Freelancers in Canada</a></li>
                            <li><a href="#"><i class="fa fa-square"></i> Freelancers in india</a></li>
                            <li><a href="#"><i class="fa fa-square"></i> find jobs</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-3 col-sm-6 col-12">
                    <div class="footerNav jb_cover footer_border_displ">
                        <h5>app & integration</h5>
                        <ul class="nav-widget">
                            <li>
                                <a href="#"><img src="images/ft1.png" alt="img">Xero
                                </a>
                            </li>

                            <li>
                                <a href="#"><img src="images/ft2.png" alt="img">Reckon
                                </a>
                            </li>

                            <li>
                                <a href="#"><img src="images/ft3.png" alt="img">Flexidocs
                                </a>
                            </li>
                            <li>
                                <a href="#"><img src="images/ft4.png" alt="img">Microsoft Exchange</a>
                            </li>
                            <li>
                                <a href="#"><img src="images/ft5.png" alt="img"> Mailchimp
                                </a>
                            </li>
                            <li>
                                <a href="#"><img src="images/ft6.png" alt="img"> MYOB
                                </a>
                            </li>

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
