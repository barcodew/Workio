<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Status Lamaran – {{ config('app.name') }}</title>
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
            background: #ecfdf3;
            color: #15803d;
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

        /* BLOK STATUS BESAR DI TENGAH */
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
            background: #f3f4ff;
            color: #4f46e5;
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
    </style>
</head>

<body>
    @php
        $statusKey = strtolower($status);

        // Default
        $statusLabel = strtoupper($statusKey);
        $statusHeadline = 'Status lamaran kamu diperbarui';
        $statusSubtext = 'Pantau terus progres lamaran kamu melalui Workio.';
        $pillBg = '#f3f4ff';
        $pillColor = '#4f46e5';

        if ($statusKey === 'diterima') {
            $statusLabel = 'DITERIMA';
            $statusHeadline = 'Selamat! Lamaranmu diterima 🎉';
            $statusSubtext =
                'Tim rekrutmen akan menghubungi kamu untuk proses selanjutnya. Pastikan nomor dan email kamu aktif ya.';
            $pillBg = '#ecfdf3';
            $pillColor = '#16a34a';
        } elseif ($statusKey === 'diproses') {
            $statusLabel = 'SEDANG DIPROSES';
            $statusHeadline = 'Lamaranmu sedang diproses ✅';
            $statusSubtext =
                'Tim rekrutmen sedang meninjau lamaranmu. Kamu akan mendapat update berikutnya ketika ada keputusan baru.';
            $pillBg = '#eff6ff';
            $pillColor = '#2563eb';
        } elseif ($statusKey === 'ditolak') {
            $statusLabel = 'DITOLAK';
            $statusHeadline = 'Belum rezeki kali ini 🙏';
            $statusSubtext =
                'Jangan berkecil hati. Kamu bisa eksplor lowongan lain yang sesuai dengan pengalaman dan minatmu di Workio.';
            $pillBg = '#fef2f2';
            $pillColor = '#b91c1c';
        }
    @endphp

    <div class="wrapper">
        <div class="card">
            <div class="header">
                <table width="100%" cellpadding="0" cellspacing="0" role="presentation">
                    <tr>
                        <td align="left">
                            <div class="brand">{{ config('app.name') }}</div>
                            <div style="font-size:12px;color:#8a8a9e;">
                                Update status lamaran kamu
                            </div>
                        </td>
                        <td align="right">
                            <span class="badge" style="background: {{ $pillBg }}; color: {{ $pillColor }};">
                                {{ $statusLabel }}
                            </span>
                        </td>
                    </tr>
                </table>
            </div>

            <div class="body">
                <p class="title">Hai, {{ $user->name ?? $user->email }} 👋</p>
                <p class="muted">
                    Status lamaran kamu untuk posisi
                    <strong>{{ $lowongan->judul }}</strong> di
                    <strong>{{ $lowongan->perusahaan->nama_perusahaan ?? 'Perusahaan' }}</strong>
                    telah diperbarui.
                </p>

                {{-- BLOK STATUS BESAR DI TENGAH --}}
                <div class="status-block">
                    <div class="status-headline">{{ $statusHeadline }}</div>
                    <span class="label-pill" style="background: {{ $pillBg }}; color: {{ $pillColor }};">
                        {{ $statusLabel }}
                    </span>
                    <p class="status-subtext">{{ $statusSubtext }}</p>
                </div>

                <p class="muted">
                    Kamu bisa melihat detail lamaran dan riwayat proses seleksi melalui tombol di bawah ini.
                </p>

                <div class="btn-wrap">
                    <a href="{{ $url }}" class="btn">Lihat Detail Lamaran</a>
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
