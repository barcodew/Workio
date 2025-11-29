<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Verifikasi Email – {{ config('app.name') }}</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <style>
        /* Reset ringan */
        body {
            margin: 0;
            padding: 0;
            background-color: #f4f4f7;
            font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Helvetica, Arial, sans-serif;
            color: #333333;
        }
        a { color: #6f42c1; text-decoration: none; }

        /* Wrapper */
        .email-wrapper {
            width: 100%;
            background-color: #f4f4f7;
            padding: 24px 0;
        }
        .email-content {
            max-width: 640px;
            margin: 0 auto;
            background-color: #ffffff;
            border-radius: 18px;
            box-shadow: 0 18px 40px rgba(15, 23, 42, 0.08);
            overflow: hidden;
        }

        /* Header */
        .email-header {
            padding: 20px 32px 16px;
            border-bottom: 1px solid #f0f0f5;
            background: radial-gradient(circle at top left, #f9f5ff 0, #ffffff 45%);
        }
        .brand-name {
            font-size: 18px;
            font-weight: 700;
            color: #48256b;
            letter-spacing: .02em;
        }
        .brand-tagline {
            font-size: 12px;
            color: #8a8a9e;
        }

        /* Body */
        .email-body {
            padding: 28px 32px 32px;
        }
        .greeting {
            font-size: 20px;
            font-weight: 600;
            margin: 0 0 6px;
            color: #111827;
        }
        .highlight-email {
            color: #6f42c1;
            font-weight: 600;
        }
        .wave {
            font-size: 22px;
        }
        .text-muted {
            font-size: 14px;
            line-height: 1.6;
            color: #6b7280;
        }
        .section-spacer {
            height: 12px;
        }

        /* Button */
        .btn-primary {
            display: inline-block;
            padding: 11px 26px;
            border-radius: 999px;
            font-size: 14px;
            font-weight: 600;
            color: #ffffff !important;
            background: linear-gradient(135deg, #6f42c1, #c084fc);
            box-shadow: 0 12px 24px rgba(111, 66, 193, 0.35);
            text-decoration: none;
        }
        .btn-primary:hover {
            filter: brightness(1.03);
        }
        .btn-wrapper {
            text-align: center;
            margin: 22px 0 18px;
        }

        /* Footer inside card */
        .email-footer-inner {
            margin-top: 10px;
            padding-top: 16px;
            border-top: 1px dashed #e5e7eb;
            font-size: 12px;
            color: #9ca3af;
        }
        .fallback-link {
            word-break: break-all;
            font-size: 12px;
        }

        /* Global footer */
        .email-footer {
            text-align: center;
            font-size: 11px;
            color: #9ca3af;
            margin-top: 12px;
        }

        @media (max-width: 600px) {
            .email-content {
                border-radius: 0;
            }
            .email-header,
            .email-body {
                padding-left: 20px;
                padding-right: 20px;
            }
        }
    </style>
</head>
<body>
<div class="email-wrapper">
    <div class="email-content">

        {{-- HEADER --}}
        <div class="email-header">
            <table width="100%" cellpadding="0" cellspacing="0" role="presentation">
                <tr>
                    <td align="left">
                        <div class="brand-name">{{ config('app.name') }}</div>
                        <div class="brand-tagline">Platform rekrutmen talenta terbaik Anda</div>
                    </td>
                    <td align="right">
                        <span style="background:#f3e8ff;color:#6f42c1;font-size:11px;padding:4px 10px;border-radius:999px;">
                            Verifikasi email
                        </span>
                    </td>
                </tr>
            </table>
        </div>

        {{-- BODY --}}
        <div class="email-body">
            <p class="greeting">
                Halo, <span class="highlight-email">{{ $user->email }}</span> <span class="wave">👋</span>
            </p>
            <p class="text-muted">
                Terima kasih telah mendaftar di <strong>{{ config('app.name') }}</strong>.
                Untuk mengaktifkan akun dan mulai menggunakan semua fitur, silakan verifikasi alamat email kamu terlebih dahulu.
            </p>

            <div class="section-spacer"></div>

            <p class="text-muted">
                Klik tombol di bawah ini untuk menyelesaikan proses verifikasi:
            </p>

            <div class="btn-wrapper">
                <a href="{{ $url }}" class="btn-primary">
                    Verifikasi Email
                </a>
            </div>

            <p class="text-muted" style="font-size:13px;margin-top:0;">
                Tombol ini akan kadaluwarsa setelah beberapa waktu demi keamanan akunmu.
                Jika kamu tidak merasa membuat akun, abaikan saja email ini.
            </p>

            <div class="email-footer-inner">
                <p class="text-muted" style="margin:0 0 6px;font-size:12px;">
                    Jika tombol di atas tidak berfungsi, salin dan tempel link berikut di browser kamu:
                </p>
                <p class="fallback-link">
                    <a href="{{ $url }}">{{ $url }}</a>
                </p>
                <p style="margin-top:10px;">
                    Salam hangat,<br>
                    <strong>{{ config('app.name') }}</strong> Team
                </p>
            </div>
        </div>
    </div>

    <div class="email-footer">
        Email ini dikirim otomatis. Mohon tidak membalas ke alamat ini.
    </div>
</div>
</body>
</html>
