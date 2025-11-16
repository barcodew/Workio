<!DOCTYPE html>
<html lang="zxx">

<head>
    <meta charset="utf-8" />
    <title>@yield('title', 'Dashboard Pelamar')</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <meta name="description" content="Workio - Candidate Dashboard" />
    <meta name="keywords" content="job portal, candidate dashboard" />
    <meta name="MobileOptimized" content="320" />

    {{-- CSS GLOBAL --}}
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

    {{-- CSS KHUSUS LAYOUT / DASHBOARD --}}
    <style>
        html,
        body {
            height: 100%;
        }

        .page_title_section {
            padding-top: 26px;
            padding-bottom: 26px;
            color: #fff;
            background: linear-gradient(90deg, #a654e2 0%, #5e89d2 60%, #4c9bb2 100%);
        }

        .page_title_section .page_header {
            padding: 0;
        }

        /* Kontainer */
        .candidate_dashboard_wrapper .container {
            max-width: 1180px;
        }

        .candidate_dashboard_wrapper .row>[class^="col-"] {
            margin-bottom: 18px;
        }

        /* Sidebar profil */
        .emp_dashboard_sidebar {
            padding: 16px;
            border-radius: 12px;
            background: #fff;
            border: 1px solid #eef1f5;
        }

        .emp_dashboard_sidebar .avatar-rounded {
            width: 100%;
            height: 220px;
            object-fit: cover;
            border-radius: 10px;
        }

        .candidate_web_profile h4 {
            margin: 12px 0 2px;
        }

        .candidate_web_profile p {
            margin: 0;
            color: #8893a7;
        }

        /* Progress mini */
        .skills-progress {
            position: relative;
            background: #eef1f5;
            height: 8px;
            border-radius: 10px;
            overflow: hidden;
        }

        .skills-progress>span {
            position: absolute;
            left: 0;
            top: 0;
            bottom: 0;
            width: 0;
            background: #7b5cf1;
            transition: width .35s ease;
        }

        .skill-item h6 {
            display: flex;
            justify-content: space-between;
            margin: 8px 0;
            font-size: 12px;
            color: #556072;
        }

        /* Kartu umum */
        .job_listing_left_fullwidth,
        .job_filter_category_sidebar {
            padding: 16px;
            border-radius: 12px;
            background: #fff;
            border: 1px solid #eef1f5;
        }

        .job_filter_sidebar_heading h1 {
            font-size: 16px;
            margin: 0 0 8px;
            text-transform: none;
        }

        /* Grid statistik */
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(4, minmax(0, 1fr));
            gap: 12px;
        }

        .stat-card {
            background: #fff;
            border: 1px solid #eef1f5;
            border-radius: 12px;
            padding: 14px;
        }

        .stat-card .num {
            font-size: 28px;
            font-weight: 700;
            line-height: 1;
        }

        .stat-card .label {
            font-size: 12px;
            color: #8792a2;
        }

        @media (max-width: 991.98px) {
            .stats-grid {
                grid-template-columns: repeat(2, 1fr);
            }
        }

        /* Tabel */
        .table {
            margin-bottom: 0;
        }

        .table th,
        .table td {
            vertical-align: middle;
        }

        /* Btn selalu center */
        .header_btn a,
        .header_btn button,
        .login_btn .site-button,
        .jb_cover .btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            height: 38px;
            padding: 0 16px;
            line-height: 1;
            white-space: nowrap;
        }

        .badge {
            font-size: 11px;
        }

        .badge-status {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: .28rem .6rem;
            border-radius: 999px;
            font-weight: 600;
            font-size: 12px;
            letter-spacing: .2px;
            border: 1px solid transparent;
        }

        .badge-soft-secondary {
            color: #3b82f6;
            background: rgba(59, 130, 246, .12);
            border-color: rgba(59, 130, 246, .22);
        }

        /* dikirim */
        .badge-soft-warning {
            color: #a16207;
            background: rgba(234, 179, 8, .15);
            border-color: rgba(234, 179, 8, .3);
        }

        /* diproses */
        .badge-soft-success {
            color: #15803d;
            background: rgba(34, 197, 94, .14);
            border-color: rgba(34, 197, 94, .28);
        }

        /* diterima */
        .badge-soft-danger {
            color: #b91c1c;
            background: rgba(239, 68, 68, .14);
            border-color: rgba(239, 68, 68, .28);
        }

        /* ditolak */

        .badge-status i {
            font-size: 12px;
            line-height: 0;
        }

        /* supaya isi tetap “kartu putih” */
        .dash-shell,
        .job_filter_category_sidebar,
        .job_listing_left_fullwidth,
        .emp_dashboard_sidebar {
            background: #fff;
            border: 1px solid #e6ebf1;
            border-radius: 14px;
            box-shadow: 0 8px 24px rgba(16, 24, 40, .06);
        }

        /* wrapper dashboard */
        .candidate_dashboard_wrapper {
            padding: 24px 0 40px;
        }

        /* === CARD SIDEBAR (full-bleed header) === */
        .job_filter_category_sidebar.jb_cover {
            padding: 0;
            background: #fff;
            border: 1px solid #e6ebf1;
            border-radius: 16px;
            overflow: hidden;
            box-shadow: 0 8px 24px rgba(16, 24, 40, .06);
        }

        .job_filter_category_sidebar .job_filter_sidebar_heading.jb_cover {
            display: block;
            width: 100%;
            background: linear-gradient(90deg, #8a63f9 0%, #5f7bfa 100%);
            color: #fff;
            padding: 18px 20px;
        }

        .job_filter_category_sidebar .job_filter_sidebar_heading h1 {
            margin: 0;
            font-size: 18px;
            color: #fff;
        }

        .job_filter_category_sidebar .category_jobbox {
            padding: 18px 18px 10px;
        }

        /* tombol bertumpuk atas–bawah, rata kanan */
        .jp_job_post_right_btn_wrapper ul {
            display: flex;
            flex-direction: column;
            align-items: flex-end;
            gap: 10px;
            margin: 0;
            padding: 0;
            list-style: none;
        }

        .jp_job_post_right_btn_wrapper ul li {
            margin: 0 !important;
            padding: 0 !important;
        }

        .jp_job_post_right_btn_wrapper .btn {
            height: 38px;
            padding: 8px 14px;
            border-radius: 10px;
            line-height: 1;
        }

        @media (max-width: 576px) {
            .jp_job_post_right_btn_wrapper ul {
                align-items: stretch;
            }

            .jp_job_post_right_btn_wrapper .btn {
                width: 100%;
            }
        }

        /* Kartu putih seragam */
        .jb-card {
            background: #fff;
            border: 1px solid #e6ebf1;
            border-radius: 16px;
            padding: 18px;
            box-shadow: 0 10px 30px rgba(31, 35, 71, .06);
            margin-bottom: 18px;
            overflow: hidden;
        }

        /* Header gradien FULL kiri–kanan */
        .jb-hd {
            margin: -18px -18px 14px -18px;
            padding: 14px 18px;
            background: linear-gradient(90deg, #8e60f8 0%, #5f7bfa 100%);
            color: #fff;
            border-top-left-radius: 16px;
            border-top-right-radius: 16px
        }

        .jb-hd h1 {
            color: #fff;
            margin: 0;
            font-size: 16px;
            letter-spacing: .2px
        }

        .jb-logo {
            width: 64px;
            height: 64px;
            object-fit: cover;
            border: 1px solid #eef;
            background: #f7f8fc
        }

        .fw-800 {
            font-weight: 800
        }

        .jb-pill {
            height: 32px;
            display: inline-flex;
            align-items: center
        }

        /* List info berikon */
        .jb-info-list .item {
            display: flex;
            gap: 12px;
            align-items: flex-start;
            padding: 10px 0;
            border-bottom: 1px dashed #eef3f9
        }

        .jb-info-list .item:last-child {
            border-bottom: 0
        }

        .jb-info-list .ico {
            width: 36px;
            height: 36px;
            border-radius: 10px;
            background: #f5f6ff;
            color: #7b5cf1;
            display: flex;
            align-items: center;
            justify-content: center
        }

        .jb-info-list .label {
            font-size: 12px;
            color: #8a8f9c;
            text-transform: uppercase;
            letter-spacing: .4px
        }

        .jb-info-list .value {
            font-weight: 600
        }

        /* Tombol ungu konsisten */
        .btn-purple {
            background: linear-gradient(90deg, #8a63f9 0%, #5f7bfa 100%);
            color: #fff;
            border: 0;
            border-radius: 12px;
            height: 42px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 8px 18px rgba(95, 123, 250, .28)
        }

        .btn-purple:hover {
            filter: brightness(.96);
            color: #fff
        }

        .btn-outline-purple {
            border: 1px solid #8a63f9;
            color: #6b54f5
        }

        .btn-outline-purple:hover {
            background: #8a63f9;
            color: #fff
        }

        /* Modal di atas semuanya */
        .modal {
            z-index: 1055
        }

        .modal-backdrop {
            z-index: 1050
        }

        /* ====== Edit profile tambahan ====== */
        .section-title {
            font-weight: 700;
            font-size: 18px;
            margin: 0 0 14px
        }

        .small-muted {
            font-size: 12.5px;
            color: #6b7280
        }

        .form-group.icon_form {
            position: relative;
            margin-bottom: 14px
        }

        .form-group.icon_form i {
            position: absolute;
            right: 14px;
            top: 50%;
            transform: translateY(-50%);
            color: #9ca3af;
            font-size: 14px
        }

        .site-button {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            padding: 10px 18px;
            border-radius: 999px;
            border: 0;
            background: #9b5de5;
            color: #fff;
            font-weight: 600
        }

        .site-button.outline {
            background: transparent;
            color: #9b5de5;
            border: 1px solid #9b5de5
        }

        .site-button.disabled {
            pointer-events: none;
            opacity: .6
        }

        .progress-slim {
            height: 8px;
            border-radius: 999px;
            background: #f3f4f6;
            overflow: hidden
        }

        .progress-slim>span {
            display: block;
            height: 100%;
            background: #10b981
        }

        .cv-frame {
            width: 100%;
            height: 460px;
            border: 1px solid #e6ebf1;
            border-radius: 12px;
            background: #fff;
            box-shadow: 0 4px 14px rgba(16, 24, 40, .04)
        }

        #cvInput {
            display: none !important;
        }

        .action-row>* {
            margin-right: 8px;
            margin-bottom: 8px
        }

        .action-row>*:last-child {
            margin-right: 0
        }
    </style>

    @stack('styles')
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

    {{-- JS GLOBAL --}}
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

    @stack('scripts')
</body>

</html>
