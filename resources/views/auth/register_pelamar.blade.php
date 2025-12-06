@extends('layouts.registerpage')

@section('title', 'Daftar Pelamar')

@section('content')
    <div class="login_wrapper jb_cover">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="login_top_box jb_cover">

                        {{-- Kiri: banner / logo --}}
                        <div class="login_banner_wrapper">
                            <img src="{{ asset('images/logo.png') }}" alt="logo">
                            <div class="jp_regis_center_tag_wrapper jb_register_red_or">
                                <h1>Workio</h1>
                            </div>
                        </div>

                        {{-- Kanan: form register --}}
                        <div class="login_form_wrapper signup_wrapper">
                            <h2>Sign up sebagai Pelamar</h2>

                            {{-- Error global --}}
                            @if ($errors->any())
                                <div class="alert alert-danger mb-3">
                                    <ul class="mb-0 ps-3">
                                        @foreach ($errors->all() as $e)
                                            <li>{{ $e }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif

                            {{-- Form --}}
                            <form method="POST" action="{{ route('register.post') }}" novalidate>
                                @csrf
                                <input type="hidden" name="role" value="pelamar">

                                {{-- Nama lengkap --}}
                                <div class="form-group icon_form comments_form">
                                    <input
                                        type="text"
                                        name="name"
                                        value="{{ old('name') }}"
                                        class="form-control @error('name') is-invalid @enderror"
                                        placeholder="Full Name *"
                                        required
                                        autocomplete="name"
                                    >
                                    <i class="fas fa-user"></i>
                                    @error('name')
                                        <small class="text-danger d-block mt-1">{{ $message }}</small>
                                    @enderror
                                </div>

                                {{-- Email --}}
                                <div class="form-group icon_form comments_form">
                                    <input
                                        type="email"
                                        name="email"
                                        value="{{ old('email') }}"
                                        class="form-control @error('email') is-invalid @enderror"
                                        placeholder="Email Address *"
                                        required
                                        autocomplete="email"
                                    >
                                    <i class="fas fa-envelope"></i>
                                    @error('email')
                                        <small class="text-danger d-block mt-1">{{ $message }}</small>
                                    @enderror
                                </div>

                                {{-- Password --}}
                                <div class="form-group icon_form comments_form">
                                    <input
                                        type="password"
                                        name="password"
                                        class="form-control @error('password') is-invalid @enderror"
                                        placeholder="Password *"
                                        required
                                        autocomplete="new-password"
                                    >
                                    <i class="fas fa-lock"></i>
                                    @error('password')
                                        <small class="text-danger d-block mt-1">{{ $message }}</small>
                                    @enderror
                                </div>

                                {{-- Konfirmasi password --}}
                                <div class="form-group icon_form comments_form">
                                    <input
                                        type="password"
                                        name="password_confirmation"
                                        class="form-control"
                                        placeholder="Confirm Password *"
                                        required
                                        autocomplete="new-password"
                                    >
                                    <i class="fas fa-lock"></i>
                                </div>

                                <div class="header_btn search_btn login_btn jb_cover">
                                    <button type="submit" class="site-button radius-xl">
                                        Sign up
                                    </button>
                                </div>
                            </form>

                            <div class="dont_have_account jb_cover">
                                <p>Sudah punya akun?
                                    <a href="{{ route('login') }}">Login</a>
                                </p>
                            </div>
                        </div> {{-- .login_form_wrapper --}}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
