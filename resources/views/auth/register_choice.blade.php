@extends('layouts.registerpage')

@section('content')
    <div class="login_wrapper jb_cover">
        <div class="container">
            <div class="row justify-content-center g-4">

                <div class="col-md-5">
                    <div class="login_top_box jb_cover text-center p-4">
                        <img src="{{ asset('images/logo.png') }}" alt="logo" class="mb-3" />
                        <h3 class="mb-2">Daftar sebagai Pelamar</h3>
                        <p class="text-muted mb-4">Buat profil, unggah CV, dan lamar pekerjaan.</p>
                        <div class="header_btn search_btn login_btn jb_cover">
                            <a class="site-button radius-xl" href="{{ route('register.pelamar') }}">Sign up Pelamar</a>
                        </div>
                    </div>
                </div>

                <div class="col-md-5">
                    <div class="login_top_box jb_cover text-center p-4">
                        <img src="{{ asset('images/logo.png') }}" alt="logo" class="mb-3" />
                        <h3 class="mb-2">Daftar sebagai Perusahaan</h3>
                        <p class="text-muted mb-4">Posting lowongan & kelola pelamar.</p>
                        <div class="header_btn search_btn login_btn jb_cover">
                            <a class="site-button radius-xl" href="{{ route('register.perusahaan') }}">Sign up
                                Perusahaan</a>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection
