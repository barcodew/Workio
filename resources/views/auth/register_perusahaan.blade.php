@extends('layouts.registerpage')

@section('content')

    <div class="login_wrapper jb_cover">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="login_top_box jb_cover">
                        <div class="login_banner_wrapper">
                            <img src="{{ asset('images/logo.png') }}" alt="logo">
                            <div class="jp_regis_center_tag_wrapper jb_register_red_or">
                                <h1>Workio</h1>
                            </div>
                        </div>

                        <div class="login_form_wrapper signup_wrapper">
                            <h2>sign up</h2>

                            @if ($errors->any())
                                <div class="alert alert-danger mb-3">
                                    <ul class="mb-0 ps-3">
                                        @foreach ($errors->all() as $e)
                                            <li>{{ $e }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif

                            <form method="POST" action="{{ route('register.post') }}">
                                @csrf
                                <input type="hidden" name="role" value="perusahaan">

                                <div class="form-group icon_form comments_form">
                                    <input type="text" class="form-control @error('name') is-invalid @enderror"
                                        name="name" value="{{ old('name') }}" placeholder="PIC / Admin Name *"
                                        required>
                                    <i class="fas fa-user"></i>
                                    @error('name')
                                        <small class="text-danger d-block mt-1">{{ $message }}</small>
                                    @enderror
                                </div>

                                <div class="form-group icon_form comments_form">
                                    <input type="text"
                                        class="form-control @error('nama_perusahaan') is-invalid @enderror"
                                        name="nama_perusahaan" value="{{ old('nama_perusahaan') }}"
                                        placeholder="Nama Perusahaan *" required>
                                    <i class="fas fa-building"></i>
                                    @error('nama_perusahaan')
                                        <small class="text-danger d-block mt-1">{{ $message }}</small>
                                    @enderror
                                </div>

                                <div class="form-group icon_form comments_form">
                                    <input type="email" class="form-control @error('email') is-invalid @enderror"
                                        name="email" value="{{ old('email') }}" placeholder="Email Perusahaan *"
                                        required>
                                    <i class="fas fa-envelope"></i>
                                    @error('email')
                                        <small class="text-danger d-block mt-1">{{ $message }}</small>
                                    @enderror
                                </div>

                                <div class="form-group icon_form comments_form">
                                    <input type="password" class="form-control @error('password') is-invalid @enderror"
                                        name="password" placeholder="Password *" required>
                                    <i class="fas fa-lock"></i>
                                    @error('password')
                                        <small class="text-danger d-block mt-1">{{ $message }}</small>
                                    @enderror
                                </div>

                                <div class="form-group icon_form comments_form">
                                    <input type="password" class="form-control" name="password_confirmation"
                                        placeholder="Confirm Password *" required>
                                    <i class="fas fa-lock"></i>
                                </div>

                                <div class="header_btn search_btn login_btn jb_cover">
                                    <button type="submit" class="site-button radius-xl">Sign up</button>
                                </div>
                            </form>

                            <div class="dont_have_account jb_cover">
                                <p>Sudah punya akun? <a href="{{ route('login') }}">Login</a></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
