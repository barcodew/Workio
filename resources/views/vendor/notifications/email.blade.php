{{-- resources/views/vendor/notifications/email.blade.php --}}
@php
    $actionUrl = $actionUrl ?? null;
@endphp

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>{{ $greeting ?? 'Verifikasi Email Anda' }}</title>
    <style>
        body { font-family: Arial, sans-serif; background:#f5f5f5; margin:0; padding:20px; }
        .wrapper { max-width:600px; margin:0 auto; background:#ffffff; border-radius:8px; padding:24px; }
        .btn {
            display:inline-block;
            padding:10px 18px;
            background:#6f42c1;
            color:#ffffff !important;
            text-decoration:none;
            border-radius:4px;
            font-weight:bold;
        }
        .footer { font-size:12px; color:#999; margin-top:24px; }
    </style>
</head>
<body>
<div class="wrapper">
    <h2>{{ $greeting ?? 'Halo!' }}</h2>

    @foreach($introLines as $line)
        <p>{{ $line }}</p>
    @endforeach

    @isset($actionText)
        <p style="text-align:center; margin:24px 0;">
            <a href="{{ $actionUrl }}" class="btn">{{ $actionText }}</a>
        </p>
    @endisset

    @foreach($outroLines as $line)
        <p>{{ $line }}</p>
    @endforeach

    <p>Salam,<br>{{ config('app.name') }}</p>

    @isset($actionText)
        <div class="footer">
            Jika tombol di atas tidak berfungsi, salin dan tempel URL berikut ke browser Anda:<br>
            <a href="{{ $actionUrl }}">{{ $actionUrl }}</a>
        </div>
    @endisset
</div>
</body>
</html>
