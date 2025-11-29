<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Lowongan Baru – {{ config('app.name') }}</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        body {
            margin: 0;
            padding: 0;
            background: #f4f4f7;
            font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Helvetica, Arial, sans-serif;
        }

        a {
            color: #6f42c1;
            text-decoration: none;
        }

        .wrapper {
            width: 100%;
            padding: 24px 0;
            background: #f4f4f7;
        }

        .card {
            max-width: 640px;
            margin: 0 auto;
            background: #fff;
            border-radius: 18px;
            box-shadow: 0 18px 40px rgba(15, 23, 42, .08);
            overflow: hidden;
        }

        .header {
            padding: 18px 32px 14px;
            border-bottom: 1px solid #f0f0f5;
            background: radial-gradient(circle at top left, #eff6ff 0, #ffffff 45%);
        }

        .brand {
            font-size: 18px;
            font-weight: 700;
            color: #1e3a8a;
            letter-spacing: .02em;
        }

        .badge {
            background: #dbeafe;
            color: #1d4ed8;
            font-size: 11px;
            padding: 4px 10px;
            border-radius: 999px;
        }

        .body {
            padding: 26px 32px 30px;
        }

        .title {
            font-size: 19px;
            font-weight: 600;
            color: #111827;
            margin: 0 0 6px;
        }

        .muted {
            font-size: 14px;
            color: #6b7280;
            line-height: 1.6;
        }

        .pill {
            display: inline-block;
            font-size: 11px;
            padding: 4px 10px;
            border-radius: 999px;
            background: #f3f4ff;
            color: #4f46e5;
            margin-right: 4px;
            margin-top: 4px;
        }

        .btn {
            display: inline-block;
            padding: 10px 24px;
            border-radius: 999px;
            background: linear-gradient(135deg, #2563eb, #38bdf8);
            color: #fff !important;
            font-size: 14px;
            font-weight: 600;
            box-shadow: 0 12px 24px rgba(37, 99, 235, .25);
        }

        .btn-wrap {
            text-align: center;
            margin: 22px 0 16px;
        }

        .footer-inner {
            margin-top: 10px;
            padding-top: 16px;
            border-top: 1px dashed #e5e7eb;
            font-size: 12px;
            color: #9ca3af;
        }

        .footer {
            text-align: center;
            font-size: 11px;
            color: #9ca3af;
            margin-top: 12px;
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
                            <div style="font-size:12px;color:#64748b;">
                                Ada lowongan baru yang mungkin cocok buat kamu
                            </div>
                        </td>
                        <td align="right">
                            <span class="badge">Lowongan baru</span>
                        </td>
                    </tr>
                </table>
            </div>

            <div class="body">
                <p class="title">Hai, {{ $user->name ?? $user->email }} 👋</p>
                <p class="muted">
                    Kami baru saja menambahkan lowongan baru yang mungkin menarik untukmu:
                </p>

                <p class="muted" style="margin-top:10px;">
                    <strong>{{ $lowongan->judul }}</strong><br>
                    {{ $lowongan->perusahaan->nama_perusahaan ?? 'Perusahaan' }}<br>
                    <span style="font-size:13px;color:#6b7280;">
                        {{ $lowongan->lokasi ?? 'Lokasi tidak tersedia' }}
                    </span>
                </p>

                <p>
                    @if ($lowongan->tipe_pekerjaan)
                        <span class="pill">{{ $lowongan->tipe_pekerjaan }}</span>
                    @endif
                    @if ($lowongan->deadline)
                        <span class="pill">Deadline:
                            {{ \Illuminate\Support\Carbon::parse($lowongan->deadline)->translatedFormat('d M Y') }}</span>
                    @endif
                </p>

                <div class="btn-wrap">
                    <a href="{{ $url }}" class="btn">Lihat Detail Lowongan</a>
                </div>

                <div class="footer-inner">
                    <p class="muted" style="margin:0 0 6px;">
                        Tidak tertarik dengan lowongan ini? Abaikan saja email ini.
                    </p>
                    <p style="margin-top:10px;">
                        Salam,<br><strong>{{ config('app.name') }}</strong> Team
                    </p>
                </div>
            </div>
        </div>

        <div class="footer">
            Kamu menerima email ini karena terdaftar sebagai pelamar di {{ config('app.name') }}.
        </div>
    </div>
</body>

</html>
