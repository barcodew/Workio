<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Reset Password – {{ config('app.name') }}</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <style>
        body {
            margin: 0;
            padding: 0;
            background-color: #f4f4f7;
            font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Helvetica, Arial, sans-serif;
            color: #333333;
        }

        a {
            color: #6f42c1;
            text-decoration: none;
        }

        .wrapper {
            width: 100%;
            background-color: #f4f4f7;
            padding: 24px 0;
        }

        .card {
            max-width: 640px;
            margin: 0 auto;
            background-color: #ffffff;
            border-radius: 18px;
            box-shadow: 0 18px 40px rgba(15, 23, 42, 0.08);
            overflow: hidden;
        }

        .header {
            padding: 20px 32px 16px;
            border-bottom: 1px solid #f0f0f5;
            background: radial-gradient(circle at top left, #f9f5ff 0, #ffffff 45%);
        }

        .brand {
            font-size: 18px;
            font-weight: 700;
            color: #48256b;
            letter-spacing: .02em;
        }

        .tagline {
            font-size: 12px;
            color: #8a8a9e;
        }

        .badge {
            background: #eff6ff;
            color: #2563eb;
            font-size: 11px;
            padding: 4px 10px;
            border-radius: 999px;
        }

        .body {
            padding: 28px 32px 32px;
        }

        .title {
            font-size: 20px;
            font-weight: 600;
            margin: 0 0 6px;
            color: #111827;
        }

        .muted {
            font-size: 14px;
            line-height: 1.6;
            color: #6b7280;
        }

        .btn-wrap {
            text-align: center;
            margin: 24px 0 18px;
        }

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

        .footer-inner {
            margin-top: 16px;
            padding-top: 16px;
            border-top: 1px dashed #e5e7eb;
            font-size: 12px;
            color: #9ca3af;
        }

        .fallback-link {
            word-break: break-all;
            font-size: 12px;
        }

        .footer {
            text-align: center;
            font-size: 11px;
            color: #9ca3af;
            margin-top: 12px;
        }

        @media (max-width: 600px) {
            .card {
                border-radius: 0;
            }

            .header,
            .body {
                padding-left: 20px;
                padding-right: 20px;
            }
        }
    </style>
</head>

<body>
    <div class="wrapper">
        <div class="card">

            <div class="header">
                <table width="100%" cellpadding="0" cellspacing="0" role="presentation">
                    <tr>
                        <td align="left">
                            <div class="brand">{{ config('app.name') }}</div>
                            <div class="tagline">Permintaan reset password akun kamu</div>
                        </td>
                        <td align="right">
                            <span class="badge">Reset password</span>
                        </td>
                    </tr>
                </table>
            </div>

            <div class="body">
                <p class="title">Halo, {{ $user->name ?? $user->email }} 👋</p>

                <p class="muted">
                    Kami menerima permintaan untuk mengatur ulang password akunmu di
                    <strong>{{ config('app.name') }}</strong>.
                    Jika ini memang kamu, silakan klik tombol di bawah untuk membuat password baru.
                </p>

                <div class="btn-wrap">
                    <a href="{{ $url }}" class="btn-primary">
                        Atur Ulang Password
                    </a>
                </div>

                <p class="muted" style="font-size:13px;margin-top:0;">
                    Tautan ini memiliki batas waktu demi keamanan akunmu. Jika tautan kadaluwarsa, kamu bisa meminta
                    reset
                    password lagi melalui halaman login.
                </p>

                <div class="footer-inner">
                    <p class="muted" style="margin:0 0 6px;">
                        Jika tombol di atas tidak berfungsi, salin dan tempel link berikut di browser kamu:
                    </p>
                    <p class="fallback-link">
                        <a href="{{ $url }}">{{ $url }}</a>
                    </p>

                    <p style="margin-top:10px;">
                        Jika kamu tidak merasa meminta reset password, kamu bisa mengabaikan email ini.
                    </p>

                    <p style="margin-top:10px;">
                        Salam,<br><strong>{{ config('app.name') }}</strong> Team
                    </p>
                </div>
            </div>
        </div>

        <div class="footer">
            Email ini dikirim otomatis. Mohon tidak membalas ke alamat ini.
        </div>
    </div>
</body>

</html>
