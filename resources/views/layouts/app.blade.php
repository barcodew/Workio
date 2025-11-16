<!doctype html>
<html lang="id">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>@yield('title', 'WORKIO')</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
</head>

<body class="bg-light">
    <nav class="navbar navbar-expand-lg bg-white border-bottom">
        <div class="container">
            <a class="navbar-brand" href="{{ route('home') }}">WORKIO</a>
            <div class="ms-auto">
                @auth
                    <form action="{{ route('logout') }}" method="POST" class="d-inline">@csrf
                        <button class="btn btn-outline-danger btn-sm">Keluar</button>
                    </form>
                @endauth
                @guest
                    <a class="btn btn-outline-primary btn-sm" href="{{ route('login') }}">Masuk</a>
                @endguest
            </div>
        </div>
    </nav>

    <main class="container py-4">
        @if (session('ok'))
            <div class="alert alert-success">{{ session('ok') }}</div>
        @endif
        @yield('content')
    </main>
</body>

</html>
