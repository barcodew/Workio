@php
    use Illuminate\Support\Facades\Route;

    $formAction = Route::has('login.post')
        ? route('login.post')
        : (Route::has('login')
            ? route('login')
            : url('/login'));

    // email yang disimpan di cookie ketika remember me aktif
    $rememberedEmail = request()->cookie('remember_email');
@endphp
<!DOCTYPE html>
<html lang="zxx">

<head>
    <meta charset="utf-8" />
    <title>Login</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <meta name="description" content="Workio, Lowongan Pekerjaan, Info loker" />
    <meta name="keywords" content="Workio, Lowongan Pekerjaan, Info loker" />
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

    {{-- Hilangkan input/dropdown bawaan swal (kita cuma pakai buat notifikasi) --}}
    <style>
        .swal2-input,
        .swal2-file,
        .swal2-textarea,
        .swal2-select,
        .swal2-radio,
        .swal2-checkbox {
            display: none !important;
        }

        #passwordIcon {
            cursor: pointer;
        }
    </style>
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

                            <img src="{{ asset('images/logo.png') }}" alt="logo">
                            <div class="jp_regis_center_tag_wrapper jb_register_red_or">
                                <h1>Workio</h1>
                            </div>
                        </div>

                        <!-- FORM LOGIN -->
                        <div class="login_form_wrapper">
                            <h2>login</h2>

                            <form method="POST" action="{{ $formAction }}" novalidate>
                                @csrf

                                {{-- EMAIL --}}
                                <div class="form-group icon_form comments_form">
                                    <input type="email"
                                        class="form-control require @error('email') is-invalid @enderror" name="email"
                                        value="{{ old('email', $rememberedEmail) }}" placeholder="Email Address*"
                                        required autocomplete="email" />
                                    <i class="fas fa-envelope"></i>
                                    @error('email')
                                        <div class="invalid-feedback d-block">{{ $message }}</div>
                                    @enderror
                                </div>

                                {{-- PASSWORD + ICON LOCK/EYE --}}
                                <div class="form-group icon_form comments_form">
                                    <input type="password" id="passwordInput"
                                        class="form-control require @error('password') is-invalid @enderror"
                                        name="password" placeholder="Password *" required
                                        autocomplete="current-password" />
                                    <i class="fas fa-lock" id="passwordIcon"></i>
                                    @error('password')
                                        <div class="invalid-feedback d-block">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="login_remember_box">
                                    <label class="control control--checkbox">
                                        Remember me
                                        <input type="checkbox" name="remember" value="1"
                                            {{ old('remember') || $rememberedEmail ? 'checked' : '' }} />
                                        <span class="control__indicator"></span>
                                    </label>
                                </div>

                                <div class="header_btn search_btn login_btn jb_cover">
                                    <button type="submit" class="site-button radius-xl">Login</button>
                                </div>
                            </form>

                            <div class="dont_have_account jb_cover">
                                <p>Don’t have an account ?
                                    @if (Route::has('register.show'))
                                        <a href="{{ route('register.show') }}">Sign up</a>
                                    @else
                                        <a href="{{ url('/register') }}">Sign up</a>
                                    @endif
                                </p>
                            </div>
                            <div class="dont_have_account jb_cover">
                                <p>Forgot password ?
                                    <a href="{{ url('/forgot-password') }}">Reset</a>
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
                            <h2>Ayo kerja!</h2>
                            <p>Dapatkan pekerjaan impianmu bersama Workio!</p>
                        </div>
                        <div class="jb_newslwtteter_button">
                            <div class="header_btn search_btn news_btn jb_cover">
                                <a href="/register">Daftar</a>
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

    {{-- Toggle show/hide password --}}
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const input = document.getElementById('passwordInput');
            const icon = document.getElementById('passwordIcon');

            if (!input || !icon) return;

            function updateIcon() {
                const hasValue = input.value.length > 0;

                if (!hasValue) {
                    // kosong → gembok, tidak bisa diklik
                    icon.classList.remove('fa-eye', 'fa-eye-slash');
                    icon.classList.add('fa-lock');
                    icon.style.cursor = 'default';
                    return;
                }

                // ada isi → mata / mata coret
                icon.classList.remove('fa-lock');
                icon.style.cursor = 'pointer';

                if (input.type === 'password') {
                    icon.classList.add('fa-eye');
                    icon.classList.remove('fa-eye-slash');
                } else {
                    icon.classList.add('fa-eye-slash');
                    icon.classList.remove('fa-eye');
                }
            }

            icon.addEventListener('click', function() {
                if (!input.value.length) return; // kalau kosong, jangan toggle

                input.type = input.type === 'password' ? 'text' : 'password';
                updateIcon();
            });

            input.addEventListener('input', updateIcon);

            // initial
            updateIcon();
        });
    </script>

    {{-- SweetAlert flash messages --}}
    @if (session('ok') || session('status'))
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                Swal.fire({
                    icon: 'success',
                    title: 'Berhasil',
                    text: @json(session('ok') ?? session('status')),
                    confirmButtonColor: '#6366f1'
                });
            });
        </script>
    @endif

    @if ($errors->any())
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const errors = {!! json_encode($errors->all()) !!};
                Swal.fire({
                    icon: 'error',
                    title: 'Login gagal',
                    html: '<ul style="text-align:left;margin:0;padding-left:18px;">' +
                        errors.map(e => `<li>${e}</li>`).join('') +
                        '</ul>',
                    confirmButtonColor: '#ef4444'
                });
            });
        </script>
    @endif
</body>

</html>
