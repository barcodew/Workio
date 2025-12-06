<!DOCTYPE html>
<html lang="zxx">

<head>
    <meta charset="utf-8" />
    <title> @yield('title')</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <link rel="stylesheet" href="{{ asset('css/animate.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/fonts.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/flaticon.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/font-awesome.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/style.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/responsive.css') }}" />
    <link rel="shortcut icon" type="image/png" href="{{ asset('images/favicon.png') }}" />
    <style>
        html,
        body {
            height: 100%;
        }

        body {
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        .footer {
            margin-top: auto;
        }


        .login_wrapper .site-button,
        .header_btn .site-button {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            min-height: 48px;
            line-height: 1.2;
            padding: 0 18px;
            text-align: center;
            font-weight: 600;
        }
    </style>


</head>

<body>

    {{-- header + breadcrumb pakai template kamu --}}
    <div class="page_title_section">
        <div class="page_header">
            <div class="container">
                <div class="row">
                    <div class="col-lg-9 col-md-8 col-12 col-sm-7">
                        <h1>Sign up</h1>
                    </div>
                    <div class="col-lg-3 col-md-4 col-12 col-sm-5">
                        <div class="sub_title_section">
                            <ul class="sub_title">
                                <li><a href="{{ url('/') }}">Home</a>&nbsp;/&nbsp;</li>
                                <li>Sign up</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    @yield('content')

    <div class="footer jb_cover">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="copyright_left">&copy; {{ date('Y') }} | Workio</div>
                </div>
            </div>
        </div>
    </div>

    <script src="{{ asset('js/jquery-3.3.1.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap.min.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    @if (session('swal'))
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                Swal.fire(@json(session('swal')));
            });
        </script>
    @endif

    @stack('scripts')

</body>

</html>
