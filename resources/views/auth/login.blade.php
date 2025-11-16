{{-- resources/views/auth/login.blade.php --}}
@php
    $formAction = \Illuminate\Support\Facades\Route::has('login.post')
        ? route('login.post')
        : (\Illuminate\Support\Facades\Route::has('login')
            ? route('login')
            : url('/login'));
@endphp
<!DOCTYPE html>
<html lang="zxx">

<head>
    <meta charset="utf-8" />
    <title>login</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <meta name="description" content="JB desks,job portal,job" />
    <meta name="keywords" content="JB desks,job portal,job" />
    <meta name="MobileOptimized" content="320" />
    <link rel="stylesheet" href="{{ asset('css/animate.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/fonts.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/flaticon.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/font-awesome.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/owl.carousel.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/owl.theme.default.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/dropify.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/jquery-ui.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/magnific-popup.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/nice-select.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/reset.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/style.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/responsive.css') }}" />
    <link rel="shortcut icon" type="image/png" href="{{ asset('images/favicon.png') }}" />
    {{-- SweetAlert2 --}}
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body>
    <!-- Page title -->
    <div class="page_title_section">
        <div class="page_header">
            <div class="container">
                <div class="row">
                    <div class="col-lg-9 col-md-8 col-12 col-sm-7">
                        <h1>login</h1>
                    </div>
                    <div class="col-lg-3 col-md-4 col-12 col-sm-5">
                        <div class="sub_title_section">
                            <ul class="sub_title">
                                <li><a href="{{ url('/') }}"> Home </a>&nbsp; / &nbsp;</li>
                                <li>login</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- login wrapper start -->
    <div class="login_wrapper jb_cover">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12">
                    <div class="login_top_box jb_cover">
                        <div class="login_banner_wrapper">
                            <img src="{{ asset('images/logo.png') }}" alt="logo" />
                            <div class="header_btn search_btn facebook_wrap jb_cover">
                                <a href="#" onclick="return false;">login with facebook <i
                                        class="fab fa-facebook-f"></i></a>
                            </div>
                            <div class="header_btn search_btn google_wrap jb_cover">
                                <a href="#" onclick="return false;">login with pinterest <i
                                        class="fab fa-pinterest-p"></i></a>
                            </div>
                            <div class="jp_regis_center_tag_wrapper jb_register_red_or">
                                <h1>OR</h1>
                            </div>
                        </div>

                        <!-- FORM LOGIN -->
                        <div class="login_form_wrapper">
                            <h2>login</h2>

                            @if (session('status'))
                                <div class="alert alert-success mb-3">{{ session('status') }}</div>
                            @endif

                            <form method="POST" action="{{ $formAction }}" novalidate>
                                @csrf

                                <div class="form-group icon_form comments_form">
                                    <input type="email"
                                        class="form-control require @error('email') is-invalid @enderror" name="email"
                                        value="{{ old('email') }}" placeholder="Email Address*" required
                                        autocomplete="email" />
                                    <i class="fas fa-envelope"></i>
                                    @error('email')
                                        <div class="invalid-feedback d-block">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group icon_form comments_form">
                                    <input type="password"
                                        class="form-control require @error('password') is-invalid @enderror"
                                        name="password" placeholder="Password *" required
                                        autocomplete="current-password" />
                                    <i class="fas fa-lock"></i>
                                    @error('password')
                                        <div class="invalid-feedback d-block">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="login_remember_box">
                                    <label class="control control--checkbox">
                                        Remember me
                                        <input type="checkbox" name="remember"
                                            {{ old('remember') ? 'checked' : '' }} />
                                        <span class="control__indicator"></span>
                                    </label>
                                    @if (\Illuminate\Support\Facades\Route::has('password.request'))
                                        <a href="{{ route('password.request') }}" class="forget_password"> Forgot
                                            Password </a>
                                    @endif
                                </div>

                                <div class="header_btn search_btn login_btn jb_cover">
                                    <button type="submit" class="site-button radius-xl">Login</button>
                                </div>
                            </form>

                            <div class="dont_have_account jb_cover">
                                <p>Don’t have an account ?
                                    @if (\Illuminate\Support\Facades\Route::has('register.show'))
                                        <a href="{{ route('register.show') }}">Sign up</a>
                                    @else
                                        <a href="{{ url('/register') }}">Sign up</a>
                                    @endif
                                </p>
                            </div>
                        </div>
                        <!-- /FORM LOGIN -->
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- login wrapper end -->

    <!-- newsletter -->
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
                                <a href="#" onclick="return false;">submit</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- footer (pendek) -->
    <div class="footer jb_cover">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="copyright_left">
                        <p>&copy; 2025 | Made With ❤️ By <a href="#">Barcodew</a></p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- JS -->
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

    {{-- SweetAlerts (flash) --}}
    @if (session('success'))
        <script>
            Swal.fire({
                icon: 'success',
                title: 'Berhasil',
                text: @json(session('success'))
            });
        </script>
    @endif

    @if (session('error'))
        <script>
            Swal.fire({
                icon: 'error',
                title: 'Oops',
                text: @json(session('error'))
            });
        </script>
    @endif

    @if ($errors->any())
        <script>
            Swal.fire({
                icon: 'error',
                title: 'Login gagal',
                html: '<ul style="text-align:left;margin:0;padding-left:18px;">' +
                    {!! json_encode($errors->all()) !!}.map(e => `<li>${e}</li>`).join('') +
                    '</ul>'
            });
        </script>
    @endif
</body>

</html>
