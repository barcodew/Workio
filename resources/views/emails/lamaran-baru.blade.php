<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Lamaran Baru – {{ config('app.name') }}</title>
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
            background: radial-gradient(circle at top left, #f9f5ff 0, #ffffff 45%);
        }

        .brand {
            font-size: 18px;
            font-weight: 700;
            color: #48256b;
            letter-spacing: .02em;
        }

        .badge {
            background: #eff6ff;
            color: #2563eb;
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

        /* BLOK STATUS / INFO DI TENGAH */
        .status-block {
            text-align: center;
            margin: 20px 0 12px;
        }

        .status-headline {
            font-size: 17px;
            font-weight: 600;
            color: #111827;
            margin-bottom: 6px;
        }

        .label-pill {
            display: inline-block;
            font-size: 13px;
            padding: 6px 20px;
            border-radius: 999px;
            text-transform: uppercase;
            letter-spacing: .12em;
            background: #eff6ff;
            color: #2563eb;
        }

        .status-subtext {
            font-size: 13px;
            color: #6b7280;
            margin-top: 6px;
            text-align: center;
        }

        .btn {
            display: inline-block;
            padding: 10px 24px;
            border-radius: 999px;
            background: linear-gradient(135deg, #6f42c1, #c084fc);
            color: #fff !important;
            font-size: 14px;
            font-weight: 600;
            box-shadow: 0 12px 24px rgba(111, 66, 193, .35);
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

        .small-link {
            font-size: 12px;
            word-break: break-all;
        }

        .info-list {
            font-size: 13px;
            color: #4b5563;
            margin: 18px 0 6px;
            padding-left: 18px;
        }

        .info-list li {
            margin-bottom: 2px;
        }
    </style>
</head>

<body>
    @php
        $pelamarName = $pelamar->name ?? 'Pelamar';
        $pelamarEmail = $pelamar->email ?? '-';
        $pelamarPhone = optional($pelamar->pelamar)->telepon;
    @endphp

    <div class="wrapper">
        <div class="card">
            <div class="header">
                <table width="100%" cellpadding="0" cellspacing="0" role="presentation">
                    <tr>
                        <td align="left">
                            <div class="brand">{{ config('app.name') }}</div>
                            <div style="font-size:12px;color:#8a8a9e;">
                                Kamu mendapatkan lamaran baru
                            </div>
                        </td>
                        <td align="right">
                            <span class="badge">
                                LAMARAN BARU
                            </span>
                        </td>
                    </tr>
                </table>
            </div>

            <div class="body">
                <p class="title">Hai, {{ $user->name ?? $user->email }} 👋</p>

                <p class="muted">
                    Ada lamaran baru yang masuk untuk posisi
                    <strong>{{ $lowongan->judul }}</strong> di perusahaan
                    <strong>{{ $lowongan->perusahaan->nama_perusahaan ?? 'Perusahaan' }}</strong>.
                </p>

                {{-- BLOK INFO DI TENGAH --}}
                <div class="status-block">
                    <div class="status-headline">
                        Kandidat: {{ $pelamarName }}
                    </div>
                    <span class="label-pill">
                        Lamaran Baru
                    </span>
                    <p class="status-subtext">
                        Segera tinjau CV dan data pelamar untuk menentukan langkah seleksi berikutnya.
                    </p>
                </div>

                <ul class="info-list">
                    <li><strong>Posisi:</strong> {{ $lowongan->judul }}</li>
                    <li><strong>Email pelamar:</strong> {{ $pelamarEmail }}</li>
                    @if ($pelamarPhone)
                        <li><strong>Telepon pelamar:</strong> {{ $pelamarPhone }}</li>
                    @endif
                    <li><strong>Tanggal lamaran:</strong> {{ $lamaran->created_at?->format('d M Y H:i') }}</li>
                </ul>

                <p class="muted">
                    Kamu dapat melihat detail lengkap lamaran, mengunduh CV, dan mengubah status seleksi melalui
                    dashboard
                    perusahaan.
                </p>

                <div class="btn-wrap">
                    <a href="{{ $url }}" class="btn">Buka di Dashboard</a>
                </div>

                <div class="footer-inner">
                    <p class="muted" style="margin:0 0 6px;">
                        Jika tombol di atas tidak berfungsi, salin dan tempel link berikut di browser kamu:
                    </p>
                    <p class="small-link">
                        <a href="{{ $url }}">{{ $url }}</a>
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
