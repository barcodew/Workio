<!DOCTYPE html>
<html lang="zxx">

<head>
    <meta charset="utf-8" />
    <title>Dashboard Perusahaan</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <meta name="description" content="Workio - Candidate Dashboard" />
    <meta name="keywords" content="job portal, candidate dashboard" />
    <meta name="MobileOptimized" content="320" />
    <link rel="stylesheet" href="{{ asset('css/animate.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/fonts.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/flaticon.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/font-awesome.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/magnific-popup.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/dropify.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/nice-select.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/jquery-ui.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/reset.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/style.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/responsive.css') }}" />
    <link rel="shortcut icon" type="image/png" href="{{ asset('images/favicon.png') }}" />

    <style>
        html,
        body {
            height: 100%;
        }


        /* util kecil */
        .actions-row {
            display: flex;
            flex-wrap: wrap;
            gap: .6rem
        }

        .btn-xs {
            padding: .38rem .6rem;
            font-size: .82rem;
            border-radius: .6rem
        }

        /* status pills: lebih kecil & tidak terlalu tebal */
        .badge-pill {
            border-radius: 999px;
            padding: .26rem .56rem;
            font-weight: 500;
            /* <— tidak terlalu tebal */
            font-size: .78rem;
            /* <— sedikit lebih kecil */
            line-height: 1;
            display: inline-flex;
            align-items: center;
            gap: .35rem;
        }

        .badge-pub {
            background: #dcfce7;
            border: 1px solid #86efac;
            color: #065f46
        }

        .badge-pen {
            background: #fef9c3;
            border: 1px solid #fde047;
            color: #854d0e
        }

        .badge-cls {
            background: #e5e7eb;
            border: 1px solid #d1d5db;
            color: #374151
        }

        /* Toolbar sejajar */
        .toolbar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: .8rem;
            flex-wrap: wrap
        }

        .toolbar .inputs {
            display: flex;
            gap: .6rem;
            flex-wrap: wrap
        }

        .toolbar .inputs .form-control {
            min-width: 260px
        }

        .toolbar .inputs .form-select {
            min-width: 180px
        }

        .btn-xs {
            padding: .42rem .64rem;
            font-size: .84rem;
            border-radius: .6rem
        }

        /* Status pills kecil */
        .pill {
            border-radius: 999px;
            padding: .24rem .56rem;
            font-size: .78rem;
            font-weight: 500;
            display: inline-flex;
            gap: .35rem;
            align-items: center;
            line-height: 1
        }

        .pill--pub {
            background: #dcfce7;
            border: 1px solid #86efac;
            color: #065f46
        }

        .pill--pen {
            background: #fef9c3;
            border: 1px solid #fde047;
            color: #854d0e
        }

        .pill--cls {
            background: #e5e7eb;
            border: 1px solid #d1d5db;
            color: #374151
        }

        .pill--drf {
            background: #eef2ff;
            border: 1px solid #c7d2fe;
            color: #3730a3
        }

        /* Kartu + tabel */
        .boxed {
            background: #fff;
            border-radius: 14px;
            box-shadow: 0 8px 24px rgba(16, 24, 40, .06);
            border: 1px solid rgba(16, 24, 40, .06);
            overflow: visible
        }

        .card-hd {
            background: linear-gradient(90deg, #6a5cf6 0%, #7f5bf7 100%);
            color: #fff;
            padding: .9rem 1rem;
            font-weight: 700
        }

        .pretty-table thead th {
            background: #f8fafc;
            border-bottom: 1px solid #e5e7eb;
            color: #475569;
            font-weight: 600
        }

        .pretty-table td {
            vertical-align: middle
        }

        /* Pastikan dropdown tidak terpotong */
        .table-wrap {
            overflow: visible;
            position: relative
        }

        .table-responsive {
            overflow: visible
        }

        .dropdown-menu-sm {
            --bs-dropdown-min-width: 10rem;
            padding: .35rem;
            border-radius: .6rem;
            z-index: 1060
        }

        .dropdown-item {
            font-size: .88rem;
            display: flex;
            gap: .5rem;
            align-items: center
        }

        .dropdown-item i {
            width: 16px;
            text-align: center
        }

        /* Fallback bila Bootstrap JS tidak ada */
        .dropdown-menu.show {
            display: block
        }

        /* Toolbar */
        .toolbar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: .8rem;
            flex-wrap: wrap
        }

        .toolbar .inputs {
            display: flex;
            gap: .6rem;
            flex-wrap: wrap
        }

        .toolbar .inputs .form-control {
            min-width: 260px
        }

        .toolbar .inputs .form-select {
            min-width: 180px
        }

        .btn-xs {
            padding: .42rem .64rem;
            font-size: .84rem;
            border-radius: .6rem
        }

        /* Box & table */
        .boxed {
            background: #fff;
            border-radius: 14px;
            box-shadow: 0 8px 24px rgba(16, 24, 40, .06);
            border: 1px solid rgba(16, 24, 40, .06);
            overflow: visible
        }

        .card-hd {
            background: linear-gradient(90deg, #6a5cf6 0%, #7f5bf7 100%);
            color: #fff;
            padding: .9rem 1rem;
            font-weight: 700;
            border-radius: 14px 14px 0 0
        }

        .pretty-table thead th {
            background: #f8fafc;
            border-bottom: 1px solid #e5e7eb;
            color: #475569;
            font-weight: 600
        }

        .pretty-table td {
            vertical-align: middle
        }

        .table-wrap {
            overflow: visible;
            position: relative
        }

        .table-responsive {
            overflow: visible
        }

        /* Badge role kecil */
        .pill {
            border-radius: 999px;
            padding: .24rem .56rem;
            font-size: .78rem;
            font-weight: 500;
            display: inline-flex;
            gap: .35rem;
            align-items: center;
            line-height: 1
        }

        .pill--pelamar {
            background: #e0f2fe;
            border: 1px solid #93c5fd;
            color: #1e3a8a
        }

        .pill--perusahaan {
            background: #fef9c3;
            border: 1px solid #fde047;
            color: #854d0e
        }

        .pill--admin {
            background: #dcfce7;
            border: 1px solid #86efac;
            color: #065f46
        }

        /* Dropdown */
        .dropdown-menu-sm {
            --bs-dropdown-min-width: 11rem;
            padding: .35rem;
            border-radius: .6rem;
            z-index: 1060
        }

        .dropdown-item {
            font-size: .88rem;
            display: flex;
            gap: .5rem;
            align-items: center
        }

        .dropdown-item i {
            width: 16px;
            text-align: center
        }

        .dropdown-menu.show {
            display: block
        }

        /* fallback */

        /* Inline role editor */
        .role-inline {
            min-width: 160px
        }

        .muted {
            color: #64748b
        }

        /* Pagination bar */
        .pager-bar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: .8rem;
            flex-wrap: wrap
        }

        .role-cell {
            display: flex;
            align-items: center;
            gap: .5rem 1rem;
            flex-wrap: wrap
        }

        .role-inline {
            min-width: 150px
        }

        .btn-xs {
            padding: .38rem .6rem;
            font-size: .82rem;
            border-radius: .6rem
        }

        /* Pager bar */
        .pager-bar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 1rem;
            flex-wrap: wrap
        }

        .pager-bar .muted {
            color: #6b7280
        }

        /* Badge role */
        .pill {
            display: inline-flex;
            align-items: center;
            gap: .35rem;
            padding: .22rem .55rem;
            border-radius: 999px;
            font-weight: 600;
            font-size: .78rem;
            border: 1px solid transparent
        }

        .pill--admin {
            background: #dbeafe;
            border-color: #93c5fd;
            color: #1e3a8a
        }

        .pill--perusahaan {
            background: #fef3c7;
            border-color: #fcd34d;
            color: #854d0e
        }

        .pill--pelamar {
            background: #e5e7eb;
            border-color: #d1d5db;
            color: #374151
        }
        
    </style>
</head>

<body>

    @yield('content')

    <!-- FOOTER MINI -->
    {{-- <div class="footer jb_cover">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="copyright_left">
                        <i class="fa fa-copyright"></i> {{ date('Y') }} <a href="#">Workio</a> — All Rights
                        Reserved.
                    </div>
                </div>
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
    </div> --}}
    <script>
        // Fallback jika Bootstrap JS tidak termuat
        (function() {
            if (typeof bootstrap === 'undefined') {
                document.querySelectorAll('[data-bs-toggle="dropdown"]').forEach(btn => {
                    btn.addEventListener('click', function(e) {
                        e.preventDefault();
                        e.stopPropagation();
                        const menu = this.nextElementSibling;
                        if (!menu) return;
                        // tutup dropdown lain
                        document.querySelectorAll('.dropdown-menu.show').forEach(m => {
                            if (m !== menu) m.classList.remove('show');
                        });
                        menu.classList.toggle('show');

                        const hide = (ev) => {
                            if (!menu.contains(ev.target) && ev.target !== btn) {
                                menu.classList.remove('show');
                                document.removeEventListener('click', hide);
                            }
                        };
                        setTimeout(() => document.addEventListener('click', hide), 0);
                    });
                });
            }
        })();
    </script>


    <!-- JS -->
    <script src="{{ asset('js/jquery-3.3.1.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('js/modernizr.js') }}"></script>
    <script src="{{ asset('js/jquery.menu-aim.js') }}"></script>
    <script src="{{ asset('js/plugin.js') }}"></script>
    <script src="{{ asset('js/jquery.countTo.js') }}"></script>
    <script src="{{ asset('js/dropify.min.js') }}"></script>
    <script src="{{ asset('js/jquery-ui.js') }}"></script>
    <script src="{{ asset('js/jquery.inview.min.js') }}"></script>
    <script src="{{ asset('js/jquery.magnific-popup.js') }}"></script>
    <script src="{{ asset('js/jquery.nice-select.min.js') }}"></script>
    <script src="{{ asset('js/imagesloaded.pkgd.min.js') }}"></script>
    <script src="{{ asset('js/isotope.pkgd.min.js') }}"></script>
    <script src="{{ asset('js/custom.js') }}"></script>
</body>

</html>
