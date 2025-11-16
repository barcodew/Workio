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

        /* opsional: beri padding di wrapper agar kartu tidak “nempel” pinggir */
        .candidate_dashboard_wrapper {
            padding: 24px 0 40px;
        }

        /* === CARD SIDEBAR (full-bleed header) === */
        .job_filter_category_sidebar.jb_cover {
            /* hapus padding agar header bisa nempel full */
            padding: 0;
            background: #fff;
            border: 1px solid #e6ebf1;
            border-radius: 16px;
            overflow: hidden;
            /* penting: biar header ikut radius */
            box-shadow: 0 8px 24px rgba(16, 24, 40, .06);
        }

        /* header ungu full kiri-kanan */
        .job_filter_category_sidebar .job_filter_sidebar_heading.jb_cover {
            display: block;
            width: 100%;
            background: linear-gradient(90deg, #8a63f9 0%, #5f7bfa 100%);
            color: #fff;
            /* tinggi lebih tebal */
            padding: 18px 20px;
            /* naikin padding = header makin tinggi */
        }

        /* judul di header */
        .job_filter_category_sidebar .job_filter_sidebar_heading h1 {
            margin: 0;
            font-size: 18px;
            color: #fff;
        }

        /* isi card; kasih padding di sini (bukan di container) */
        .job_filter_category_sidebar .category_jobbox {
            padding: 18px 18px 10px;
        }

        /* tombol bertumpuk atas–bawah, rata kanan */
        .jp_job_post_right_btn_wrapper ul {
            display: flex;
            flex-direction: column;
            /* vertikal */
            align-items: flex-end;
            /* rata kanan */
            gap: 10px;
            /* jarak antar tombol */
            margin: 0;
            padding: 0;
            list-style: none;
        }

        .jp_job_post_right_btn_wrapper ul li {
            margin: 0 !important;
            padding: 0 !important;
        }

        /* ukuran tombol konsisten */
        .jp_job_post_right_btn_wrapper .btn {
            height: 38px;
            padding: 8px 14px;
            border-radius: 10px;
            line-height: 1;
        }

        /* opsional: di layar kecil, tetap enak dibaca */
        @media (max-width: 576px) {
            .jp_job_post_right_btn_wrapper ul {
                align-items: stretch;
                /* tombol full lebar */
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



        /* edit profile */

        /* Kartu & utilitas kecil */
        .jb-card {
            background: #fff;
            border-radius: 14px;
            box-shadow: 0 8px 24px rgba(16, 24, 40, .06);
            border: 1px solid rgba(16, 24, 40, .06)
        }

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

        .badge-soft {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: .28rem .6rem;
            border-radius: 999px;
            font-weight: 600;
            font-size: 12px;
            color: #2563eb;
            background: rgba(37, 99, 235, .12);
            border: 1px solid rgba(37, 99, 235, .22)
        }

        /* Progress */
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

        /* CV preview */
        .cv-frame {
            width: 100%;
            height: 460px;
            border: 1px solid #e6ebf1;
            border-radius: 12px;
            background: #fff;
            box-shadow: 0 4px 14px rgba(16, 24, 40, .04)
        }

        /* Hilangkan input file "Choose file" sepenuhnya; tetap dapat di-trigger via label */
        #cvInput {
            display: none !important;
        }

        /* Baris aksi dengan jarak konsisten (kompatibel BS4) */
        .action-row>* {
            margin-right: 8px;
            margin-bottom: 8px
        }

        .action-row>*:last-child {
            margin-right: 0
        }

        .jb-card {
            background: #fff;
            border-radius: 14px;
            box-shadow: 0 8px 24px rgba(16, 24, 40, .06);
            border: 1px solid rgba(16, 24, 40, .06)
        }

        .jb-hd {
            margin: -18px -18px 14px -18px;
            background: linear-gradient(90deg, #8a63f9, #5f7bfa);
            color: #fff;
            padding: 14px 18px;
            border-top-left-radius: 14px;
            border-top-right-radius: 14px
        }

        .stat-card {
            background: #fff;
            border: 1px solid #eef1f5;
            border-radius: 12px;
            padding: 14px;
            box-shadow: 0 8px 24px rgba(16, 24, 40, .05)
        }

        .stat-card .label {
            font-size: 12px;
            color: #8792a2
        }

        .stat-card .num {
            font-size: 28px;
            font-weight: 700;
            line-height: 1
        }

        .btn-purple {
            background: linear-gradient(90deg, #8a63f9 0%, #5f7bfa 100%);
            color: #fff;
            border: 0;
            box-shadow: 0 8px 18px rgba(95, 123, 250, .28)
        }

        .btn-purple:hover {
            filter: brightness(.96);
            color: #fff
        }

        .btn-outline-purple {
            border: 1px solid #8a63f9;
            color: #6b54f5;
            background: #fff
        }

        .btn-outline-purple:hover {
            background: #8a63f9;
            color: #fff
        }

        .table thead th {
            background: #fafbff;
            border-bottom: 1px solid #eef1f5
        }

        .mini-badge {
            display: inline-block;
            padding: .28rem .55rem;
            border-radius: 999px;
            font-size: 12px;
            font-weight: 600
        }

        .mini-badge.published {
            background: rgba(16, 185, 129, .14);
            color: #065f46;
            border: 1px solid rgba(16, 185, 129, .28)
        }

        .mini-badge.pending {
            background: rgba(234, 179, 8, .15);
            color: #a16207;
            border: 1px solid rgba(234, 179, 8, .30)
        }

        .mini-badge.closed {
            background: #eef2f7;
            color: #6b7280;
            border: 1px solid #e2e8f0
        }

        .page_title_section {
            padding-top: 26px;
            padding-bottom: 26px;
            color: #fff;
            background: linear-gradient(90deg, #a654e2 0%, #5e89d2 60%, #4c9bb2 100%)
        }

        /* === SCOPE: hanya berlaku di dalam .dash-company === */
        .dash-company .jb-card {
            background: #fff;
            border-radius: 14px;
            border: 1px solid #eef1f5;
            box-shadow: 0 8px 24px rgba(16, 24, 40, .06)
        }

        .dash-company .jb-hd {
            padding: 12px 16px;
            background: linear-gradient(90deg, #8a63f9 0%, #5f7bfa 100%);
            color: #fff;
            border-bottom: 1px solid rgba(255, 255, 255, .08)
        }

        .dash-company .stat-card {
            background: #fff;
            border: 1px solid #eef1f5;
            border-radius: 12px;
            padding: 14px;
            box-shadow: 0 6px 22px rgba(16, 24, 40, .05)
        }

        .dash-company .stat-card .label {
            font-size: 12px;
            color: #8792a2
        }

        .dash-company .stat-card .num {
            font-size: 26px;
            font-weight: 800;
            line-height: 1;
            margin-top: 2px
        }

        /* tabel ringkas khusus dashboard */
        .dash-company .pretty-table thead th {
            background: #fafbff;
            border-bottom: 1px solid #eef1f5;
            font-weight: 600;
            font-size: 12.5px;
            color: #59657a
        }

        .dash-company .pretty-table tbody td {
            border-color: #f1f3f7;
            vertical-align: middle
        }

        .dash-company .pretty-table tbody tr:nth-child(odd) {
            background: #fcfdff
        }

        .dash-company .pretty-table td,
        .dash-company .pretty-table th {
            padding: .6rem .75rem
        }

        /* badge mini status */
        .dash-company .mini-badge {
            display: inline-block;
            padding: .26rem .55rem;
            border-radius: 999px;
            font-size: 12px;
            font-weight: 700;
            border: 1px solid transparent;
            letter-spacing: .1px
        }

        .dash-company .mini-badge.published {
            color: #065f46;
            background: rgba(16, 185, 129, .14);
            border-color: rgba(16, 185, 129, .28)
        }

        .dash-company .mini-badge.pending {
            color: #a16207;
            background: rgba(234, 179, 8, .15);
            border-color: rgba(234, 179, 8, .30)
        }

        .dash-company .mini-badge.closed {
            color: #6b7280;
            background: #eef2f7;
            border-color: #e2e8f0
        }

        /* tombol */
        .dash-company .btn-purple {
            background: linear-gradient(90deg, #8a63f9 0%, #5f7bfa 100%);
            color: #fff;
            border: 0
        }

        .dash-company .btn-purple:hover {
            filter: brightness(.96);
            color: #fff
        }

        .dash-company .btn-outline-purple {
            border: 1px solid #8a63f9;
            color: #6b54f5;
            background: #fff
        }

        .dash-company .btn-outline-purple:hover {
            background: #8a63f9;
            color: #fff
        }

        .dash-company .btn-xs {
            padding: 6px 10px;
            border-radius: 10px;
            font-size: 12px;
            line-height: 1
        }

        /* agar header kartu tidak “nempel” kartu lain */
        .dash-company .jb-card+.jb-card {
            margin-top: 1rem
        }

        /* responsive */
        @media (max-width: 991.98px) {
            .dash-company .stat-card {
                padding: 12px
            }
        }

        .jb-card {
            background: #fff;
            border-radius: 14px;
            box-shadow: 0 8px 24px rgba(16, 24, 40, .06);
            border: 1px solid #eef
        }

        .jb-hd {
            margin: -1px -1px 12px -1px;
            border-radius: 12px 12px 0 0;
            background: linear-gradient(90deg, #8a63f9, #5f7bfa);
            padding: 12px 16px;
            color: #fff
        }

        .preview-logo {
            width: 120px;
            height: 120px;
            object-fit: cover;
            border-radius: 12px;
            border: 1px solid #eef
        }

        .preview-banner {
            width: 100%;
            max-height: 180px;
            object-fit: cover;
            border-radius: 12px;
            border: 1px solid #eef
        }

        .btn-outline-purple {
            border: 1px solid #8a63f9;
            color: #6b54f5;
            background: #fff
        }

        .btn-outline-purple:hover {
            background: #8a63f9;
            color: #fff
        }

        /* ====== Section spacing agar header tidak ketimpa ====== */
        .job-section {
            padding: 24px 0 32px;
        }

        /* ====== Toolbar ====== */
        .toolbar {
            display: flex;
            gap: 12px;
            align-items: center;
            flex-wrap: wrap;
            justify-content: space-between;
            margin-bottom: 14px;
        }

        .toolbar .inputs {
            display: flex;
            gap: 10px;
            flex-wrap: wrap;
            align-items: center
        }

        .toolbar .actions {
            display: flex;
            gap: 10px;
            align-items: center
        }

        /* ====== Card / table ====== */
        .boxed {
            background: #fff;
            border-radius: 14px;
            border: 1px solid rgba(16, 24, 40, .06);
            box-shadow: 0 8px 24px rgba(16, 24, 40, .06);
            overflow: hidden;
        }

        .boxed .card-hd {
            padding: 12px 16px;
            background: linear-gradient(90deg, #7b4dff, #6e8bff);
            color: #fff;
            font-weight: 700;
            border-top-left-radius: 14px;
            border-top-right-radius: 14px;
        }

        .pretty-table thead th {
            background: #f7f9fc;
            color: #6b7280;
            font-weight: 600;
            border: 0;
        }

        .pretty-table tbody tr+tr td {
            border-top: 1px solid #eef2f7;
        }

        .muted {
            color: #6b7280;
            font-size: .85rem;
        }

        /* ====== Chips (status pelamar) ====== */
        .chips {
            display: flex;
            flex-wrap: wrap;
            gap: 6px;
        }

        .chip {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 6px 10px;
            border-radius: 999px;
            font-size: .76rem;
            font-weight: 600;
            line-height: 1;
            border: 1px solid transparent;
            white-space: nowrap;
        }

        .chip .cnt {
            font-variant-numeric: tabular-nums;
            padding: .15rem .45rem;
            border-radius: 999px;
            background: rgba(255, 255, 255, .65);
        }

        .chip--total {
            background: #e5e7eb;
            color: #374151;
            border-color: #cfd3da;
        }

        .chip--sent {
            background: #fef3c7;
            color: #92400e;
            border-color: #fde68a;
        }

        .chip--proc {
            background: #dbeafe;
            color: #1e40af;
            border-color: #bfdbfe;
        }

        .chip--ok {
            background: #dcfce7;
            color: #065f46;
            border-color: #bbf7d0;
        }

        .chip--rej {
            background: #fee2e2;
            color: #991b1b;
            border-color: #fecaca;
        }

        /* ====== Job status pill ====== */
        .pill {
            display: inline-flex;
            align-items: center;
            padding: .38rem .7rem;
            border-radius: 999px;
            font-size: .78rem;
            font-weight: 700;
            border: 1px solid transparent
        }

        .pill--pub {
            background: #dcfce7;
            color: #065f46;
            border-color: #bbf7d0
        }

        .pill--pen {
            background: #fef3c7;
            color: #92400e;
            border-color: #fde68a
        }

        .pill--cls {
            background: #e5e7eb;
            color: #111827;
            border-color: #d1d5db
        }

        /* ====== Buttons sizing ====== */
        .btn-xs {
            --bs-btn-padding-y: .25rem;
            --bs-btn-padding-x: .5rem;
            --bs-btn-font-size: .78rem;
            border-radius: 10px;
        }

        .btn-outline-purple {
            color: #6c5ce7;
            border-color: #dcd7ff;
        }

        .btn-outline-purple:hover {
            background: #f2efff;
            color: #5a49e6;
            border-color: #c7c0ff;
        }

        .btn-purple {
            background: #6c5ce7;
            color: #fff;
            border-color: transparent;
        }

        .btn-purple:hover {
            background: #5a49e6;
            color: #fff;
        }

        /* ====== Tabel wrapper anti melebar ====== */
        .table-wrap {
            overflow-x: auto;
            width: 100%;
        }

        /* Kompakkan sel tabel agar rapi */
        .pretty-table> :not(caption)>*>th,
        .pretty-table> :not(caption)>*>td {
            padding: .55rem .8rem;
            /* defaultnya biasanya .75–1rem */
            vertical-align: middle;
        }

        /* Pill status lebih kecil */
        .pretty-table .pill {
            font-size: .72rem;
            padding: .26rem .52rem;
            border-radius: 999px;
            line-height: 1;
        }

        /* Chip ringkasan pelamar: kecil & rapat */
        .pretty-table .chips {
            gap: 6px;
        }

        .pretty-table .chip {
            font-size: .7rem;
            padding: .28rem .46rem;
            border-radius: 999px;
            line-height: 1;
        }

        .pretty-table .chip .cnt {
            padding: .06rem .38rem;
            border-radius: 999px;
        }

        /* Tombol aksi mini */
        .pretty-table .btn-xs {
            --bs-btn-padding-y: .22rem;
            --bs-btn-padding-x: .5rem;
            --bs-btn-font-size: .72rem;
            border-radius: 9px;
            line-height: 1.05;
        }

        /* Pastikan “Hapus” tidak tampak lebih besar */
        .pretty-table .btn-outline-danger.btn-xs {
            --bs-btn-padding-x: .6rem;
        }

        /* Header tabel tetap ramping */
        .pretty-table thead th {
            font-size: .82rem;
        }

        /* Kolom judul: sedikit rapikan spacing baris kedua */
        .pretty-table .muted {
            margin-top: .15rem;
            font-size: .78rem;
        }


        /* ====== Toolbar ====== */
        .job-section .toolbar {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 12px;
            margin-bottom: 16px
        }

        .job-section .toolbar .inputs {
            display: flex;
            gap: 10px;
            flex-wrap: wrap
        }

        .job-section .toolbar .actions {
            display: flex;
            gap: 10px;
            flex-wrap: wrap
        }

        .btn.btn-xs {
            padding: .35rem .6rem;
            font-size: .82rem;
            border-radius: .6rem
        }

        .btn-purple {
            background: linear-gradient(90deg, #7b5cfa, #5b8bff);
            color: #fff;
            border: 0
        }

        .btn-outline-purple {
            border: 1px solid #a38dff;
            color: #6b63ff;
            background: #fff
        }

        .btn-outline-purple:hover {
            background: #f6f6ff
        }

        .btn-outline-danger.btn-xs {
            border-color: #f6b0b5;
            color: #d83a43;
            background: #fff
        }

        .btn-outline-secondary.btn-xs {
            border-color: #ced4da;
            color: #495057;
            background: #fff
        }

        /* ====== Box/card ====== */
        .job-section .boxed {
            border-radius: 14px;
            background: #fff;
            box-shadow: 0 10px 30px rgba(16, 24, 40, .08);
            overflow: visible
        }

        .job-section .card-hd {
            padding: 12px 16px;
            border-radius: 14px 14px 0 0;
            color: #fff;
            background: linear-gradient(90deg, #7c51f8, #5a8aff);
            font-weight: 700
        }

        .job-section .table-wrap {
            overflow: visible
        }

        /* ====== Table ====== */
        .pretty-table>thead th {
            font-weight: 700;
            color: #657085;
            background: #f6f7fb;
            border: 0
        }

        .pretty-table tr td {
            vertical-align: middle
        }

        .muted {
            font-size: .82rem;
            color: #6b7280
        }

        /* ====== Chips Pelamar ====== */
        .chips {
            display: flex;
            flex-wrap: wrap;
            gap: 6px
        }

        .chip {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            font-size: .76rem;
            padding: .22rem .5rem;
            border-radius: 999px;
            border: 1px solid transparent;
            background: #f6f7fb
        }

        .chip .cnt {
            padding: .12rem .45rem;
            border-radius: 999px;
            background: #e9ecf5;
            font-weight: 700
        }

        .chip--total {
            background: #eef2ff;
            border-color: #d6ddff
        }

        .chip--sent {
            background: #fff4d6;
            border-color: #ffe7a4
        }

        .chip--proc {
            background: #e9f2ff;
            border-color: #cfe0ff
        }

        .chip--ok {
            background: #e7fbef;
            border-color: #b8f1cf
        }

        .chip--rej {
            background: #fde7ea;
            border-color: #fac3c9
        }

        /* ====== Status pill ====== */
        .pill {
            display: inline-flex;
            align-items: center;
            padding: .18rem .6rem;
            border: 1px solid transparent;
            border-radius: 999px;
            font-size: .78rem;
            font-weight: 700
        }

        .pill--pub {
            background: #e6fbf2;
            border-color: #a9efd1;
            color: #0f8b5d
        }

        .pill--pen {
            background: #fff3cd;
            border-color: #ffe08f;
            color: #8a6d00
        }

        .pill--cls {
            background: #eceff3;
            border-color: #d7dde6;
            color: #667085
        }

        /* ====== Dropdown aksi (independen dari Bootstrap) ====== */
        .action-dropdown {
            position: relative;
            display: inline-block
        }

        .action-toggle {
            display: inline-flex;
            align-items: center;
            gap: 6px
        }

        .action-menu {
            position: absolute;
            right: 0;
            top: 100%;
            min-width: 170px;
            margin-top: 6px;
            background: #fff;
            border: 1px solid #e6e6ef;
            border-radius: 10px;
            padding: 6px;
            box-shadow: 0 14px 40px rgba(16, 24, 40, .15);
            display: none;
            z-index: 2000
        }

        .action-menu.show {
            display: block
        }

        .action-menu .dropdown-item {
            display: flex;
            align-items: center;
            gap: 8px;
            padding: .45rem .55rem;
            border-radius: 8px;
            font-size: .86rem;
            color: #344054;
            text-decoration: none
        }

        .action-menu .dropdown-item:hover {
            background: #f5f7ff
        }

        .action-menu .danger {
            color: #c62828
        }

        .action-menu .danger:hover {
            background: #ffe9ec
        }

        /* tombol kecil seragam */
        .btn-xs,
        .action-toggle {
            font-size: .84rem
        }

        /* memastikan menu tidak terpotong */
        .job-section .dropdown-menu {
            z-index: 2000
        }

        .job-section .toolbar {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 12px;
            margin-bottom: 16px
        }

        .job-section .toolbar .inputs {
            display: flex;
            gap: 10px;
            flex-wrap: wrap
        }

        .job-section .toolbar .actions {
            display: flex;
            gap: 10px;
            flex-wrap: wrap
        }

        .btn.btn-xs {
            padding: .35rem .6rem;
            font-size: .82rem;
            border-radius: .6rem
        }

        .btn-purple {
            background: linear-gradient(90deg, #7b5cfa, #5b8bff);
            color: #fff;
            border: 0
        }

        .btn-outline-purple {
            border: 1px solid #a38dff;
            color: #6b63ff;
            background: #fff
        }

        .btn-outline-purple:hover {
            background: #f6f6ff
        }

        /* ====== Box/card ====== */
        .job-section .boxed {
            border-radius: 14px;
            background: #fff;
            box-shadow: 0 10px 30px rgba(16, 24, 40, .08);
            overflow: visible
        }

        .job-section .card-hd {
            padding: 12px 16px;
            border-radius: 14px 14px 0 0;
            color: #fff;
            background: linear-gradient(90deg, #7c51f8, #5a8aff);
            font-weight: 700
        }

        .job-section .table-wrap {
            overflow: visible
        }

        /* ====== Table ====== */
        .pretty-table>thead th {
            font-weight: 700;
            color: #657085;
            background: #f6f7fb;
            border: 0
        }

        .pretty-table tr td {
            vertical-align: middle
        }

        .muted {
            font-size: .82rem;
            color: #6b7280
        }

        /* ====== Status pill ====== */
        .pill {
            display: inline-flex;
            align-items: center;
            padding: .18rem .6rem;
            border: 1px solid transparent;
            border-radius: 999px;
            font-size: .78rem;
            font-weight: 700
        }

        .pill--sent {
            background: #fff3cd;
            border-color: #ffe08f;
            color: #8a6d00
        }

        .pill--proc {
            background: #e9f2ff;
            border-color: #cfe0ff;
            color: #1553b8
        }

        .pill--ok {
            background: #e6fbf2;
            border-color: #a9efd1;
            color: #0f8b5d
        }

        .pill--rej {
            background: #fde7ea;
            border-color: #fac3c9;
            color: #b4232d
        }

        /* ====== Dropdown aksi ====== */
        .action-dropdown {
            position: relative;
            display: inline-block
        }

        .action-toggle {
            display: inline-flex;
            align-items: center;
            gap: 6px
        }

        .action-menu {
            position: absolute;
            right: 0;
            top: 100%;
            min-width: 190px;
            margin-top: 6px;
            background: #fff;
            border: 1px solid #e6e6ef;
            border-radius: 10px;
            padding: 6px;
            box-shadow: 0 14px 40px rgba(16, 24, 40, .15);
            display: none;
            z-index: 2000
        }

        .action-menu.show {
            display: block
        }

        .action-menu .dropdown-item {
            display: flex;
            align-items: center;
            gap: 8px;
            padding: .45rem .55rem;
            border-radius: 8px;
            font-size: .86rem;
            color: #344054;
            text-decoration: none;
            background: transparent;
            border: 0;
            width: 100%;
            text-align: left
        }

        .action-menu .dropdown-item:hover {
            background: #f5f7ff
        }

        .action-menu .danger {
            color: #c62828
        }

        .action-menu .danger:hover {
            background: #ffe9ec
        }

        /* Kartu & heading mengikuti template */
        .jb-card {
            background: #fff;
            border-radius: 14px;
            box-shadow: 0 8px 24px rgba(16, 24, 40, .06);
            border: 1px solid rgba(16, 24, 40, .06)
        }

        .jb-hd {
            background: linear-gradient(135deg, #6a64f1, #7b5cff);
            color: #fff;
            border-radius: 12px 12px 0 0;
            padding: .9rem 1.1rem;
            font-weight: 700
        }

        .card-body-pad {
            padding: 1.15rem
        }

        /* Grid 3 kolom bawah */
        .form-row-tight {
            display: grid;
            gap: .75rem;
            grid-template-columns: 1fr .6fr .6fr
        }

        @media (max-width: 991.98px) {
            .form-row-tight {
                grid-template-columns: 1fr
            }
        }

        /* Samakan tinggi input/select/date */
        select.form-select,
        input[type="date"].form-control {
            height: calc(2.5rem + 2px)
        }

        /* Jika tema pakai nice-select */
        .nice-select {
            width: 100% !important;
            min-width: 0
        }

        .nice-select .list {
            max-height: 260px;
            overflow: auto
        }

        /* Tombol bawah kecil & rapi */
        .btn-xs {
            --bs-btn-padding-y: .35rem;
            --bs-btn-padding-x: .8rem;
            --bs-btn-font-size: .875rem;
            border-radius: 10px
        }

        /* --- anti kepotong --- */
        .job_filter_listing_wrapper,
        .job_filter_listing_wrapper .container,
        .jb-card {
            overflow: visible !important;
        }

        /* nice-select: pastikan list berada di atas elemen lain */
        .nice-select {
            width: 100% !important;
            min-width: 0;
            z-index: 1;
        }

        .nice-select .list {
            position: absolute;
            z-index: 2000;
            /* > modal backdrop, > header */
            max-height: 260px;
            overflow: auto;
        }

        /* jika harus buka ke atas */
        .nice-select.open-up .list {
            top: auto;
            bottom: 100%;
            margin-bottom: 6px;
        }

          .actions-row{display:flex;flex-wrap:wrap;gap:.6rem}
  .actions-row .btn{min-height:38px}

  /* util kecil */
  .actions-row{display:flex;flex-wrap:wrap;gap:.6rem}
  .btn-xs{padding:.38rem .6rem;font-size:.82rem;border-radius:.6rem}

  /* status pills: lebih kecil & tidak terlalu tebal */
  .badge-pill{
    border-radius:999px;
    padding:.26rem .56rem;
    font-weight:500;          /* <— tidak terlalu tebal */
    font-size:.78rem;         /* <— sedikit lebih kecil */
    line-height:1;
    display:inline-flex;
    align-items:center;
    gap:.35rem;
  }
  .badge-pub{background:#dcfce7;border:1px solid #86efac;color:#065f46}
  .badge-pen{background:#fef9c3;border:1px solid #fde047;color:#854d0e}
  .badge-cls{background:#e5e7eb;border:1px solid #d1d5db;color:#374151}
  
    /* Toolbar sejajar */
  .toolbar{display:flex;justify-content:space-between;align-items:center;gap:.8rem;flex-wrap:wrap}
  .toolbar .inputs{display:flex;gap:.6rem;flex-wrap:wrap}
  .toolbar .inputs .form-control{min-width:260px}
  .toolbar .inputs .form-select{min-width:180px}
  .btn-xs{padding:.42rem .64rem;font-size:.84rem;border-radius:.6rem}

  /* Status pills kecil */
  .pill{border-radius:999px;padding:.24rem .56rem;font-size:.78rem;font-weight:500;display:inline-flex;gap:.35rem;align-items:center;line-height:1}
  .pill--pub{background:#dcfce7;border:1px solid #86efac;color:#065f46}
  .pill--pen{background:#fef9c3;border:1px solid #fde047;color:#854d0e}
  .pill--cls{background:#e5e7eb;border:1px solid #d1d5db;color:#374151}
  .pill--drf{background:#eef2ff;border:1px solid #c7d2fe;color:#3730a3}

  /* Kartu + tabel */
  .boxed{background:#fff;border-radius:14px;box-shadow:0 8px 24px rgba(16,24,40,.06);border:1px solid rgba(16,24,40,.06);overflow:visible}
  .card-hd{background:linear-gradient(90deg,#6a5cf6 0%,#7f5bf7 100%);color:#fff;padding:.9rem 1rem;font-weight:700}
  .pretty-table thead th{background:#f8fafc;border-bottom:1px solid #e5e7eb;color:#475569;font-weight:600}
  .pretty-table td{vertical-align:middle}

  /* Pastikan dropdown tidak terpotong */
  .table-wrap{overflow:visible; position:relative}
  .table-responsive{overflow:visible}
  .dropdown-menu-sm{--bs-dropdown-min-width:10rem;padding:.35rem;border-radius:.6rem;z-index:1060}
  .dropdown-item{font-size:.88rem;display:flex;gap:.5rem;align-items:center}
  .dropdown-item i{width:16px;text-align:center}

  /* Fallback bila Bootstrap JS tidak ada */
  .dropdown-menu.show{display:block}
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
        (function() {
            // Jika Bootstrap 5 ada, biarkan dia yang handle
            const hasBS = !!(window.bootstrap && window.bootstrap.Dropdown);

            if (hasBS) {
                document.querySelectorAll('[data-bs-toggle="dropdown"],[data-toggle="dropdown"]').forEach(function(el) {
                    try {
                        new bootstrap.Dropdown(el);
                    } catch (e) {}
                });
            } else {
                // Fallback vanilla JS (tanpa dependency)
                const toggles = document.querySelectorAll('.action-dropdown .action-toggle');

                function closeAll(except) {
                    document.querySelectorAll('.action-dropdown .action-menu.show').forEach(function(m) {
                        if (!except || m !== except) m.classList.remove('show');
                    });
                }
                toggles.forEach(function(btn) {
                    btn.addEventListener('click', function(e) {
                        e.preventDefault();
                        const wrap = btn.closest('.action-dropdown');
                        const menu = wrap.querySelector('.action-menu');
                        const isShown = menu.classList.contains('show');
                        closeAll();
                        if (!isShown) menu.classList.add('show');
                    });
                });
                // Klik di luar = tutup
                document.addEventListener('click', function(e) {
                    if (!e.target.closest('.action-dropdown')) closeAll();
                });
                // ESC = tutup
                document.addEventListener('keydown', function(e) {
                    if (e.key === 'Escape') closeAll();
                });
            }
        })();
    </script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Jika plugin nice-select aktif, pastikan update + atur arah buka saat dekat tepi bawah
            if (window.jQuery && jQuery.fn.niceSelect) {
                const $sel = jQuery('select.form-select');
                $sel.niceSelect('update');

                // toggle drop-up bila mepet bawah viewport
                jQuery(document).on('click', '.nice-select', function() {
                    const $ns = jQuery(this);
                    const rect = this.getBoundingClientRect();
                    const spaceBelow = window.innerHeight - rect.bottom;
                    const listH = Math.min(260, $ns.find('.list').prop('scrollHeight'));
                    if (spaceBelow < (listH + 16)) $ns.addClass('open-up');
                    else $ns.removeClass('open-up');
                });
            }
        });
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
