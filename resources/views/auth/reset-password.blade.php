{{-- resources/views/auth/reset-password.blade.php --}}
@extends('layouts.dashboard_pelamar')
@section('title','Reset Password')

@section('content')
    {{-- Styling khusus card auth --}}
    <style>
        .auth-wrapper {
            padding: 40px 0 60px;
            display: flex;
            justify-content: center;
        }

        .auth-card {
            width: 100%;
            max-width: 460px;
            background: #ffffff;
            border-radius: 18px;
            box-shadow: 0 18px 40px rgba(15, 23, 42, 0.08);
            padding: 28px 26px 26px;
        }

        .auth-title {
            font-size: 20px;
            font-weight: 600;
            margin-bottom: 6px;
            color: #111827;
        }

        .auth-subtitle {
            font-size: 14px;
            color: #6b7280;
            line-height: 1.6;
            margin-bottom: 18px;
        }

        .auth-label {
            font-weight: 500;
            font-size: 14px;
            margin-bottom: 6px;
        }

        .auth-footer-link {
            font-size: 14px;
        }
    </style>

    {{-- HEADER / BREADCRUMB --}}
    <div class="page_title_section">
        <div class="page_header">
            <div class="container">
                <div class="row">
                    <div class="col-lg-9 col-md-9 col-12 col-sm-8">
                        <h1>Reset Password</h1>
                    </div>
                    <div class="col-lg-3 col-md-3 col-12 col-sm-4">
                        <div class="sub_title_section">
                            <ul class="sub_title">
                                <li><a href="{{ url('/') }}">Home</a>&nbsp;/&nbsp;</li>
                                <li>Reset Password</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- FORM CARD --}}
    <div class="job_filter_listing_wrapper jb_cover">
        <div class="container">
            <div class="auth-wrapper">
                <div class="auth-card">
                    <div class="text-center mb-3">
                        <h3 class="auth-title">Buat Password Baru</h3>
                        <p class="auth-subtitle">
                            Pilih password yang kuat dan mudah kamu ingat. Setelah disimpan, kamu bisa login
                            menggunakan password baru ini.
                        </p>
                    </div>

                    <form method="POST" action="{{ route('password.update') }}">
                        @csrf

                        <input type="hidden" name="token" value="{{ $token }}">

                        <div class="form-group jb_cover mb-3">
                            <label class="auth-label">Email</label>
                            <input type="email"
                                   name="email"
                                   class="form-control"
                                   value="{{ old('email', $email) }}"
                                   required
                                   readonly>
                            @error('email')
                                <span class="text-danger small d-block mt-1">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group jb_cover mb-3">
                            <label class="auth-label">Password baru</label>
                            <input type="password"
                                   name="password"
                                   class="form-control"
                                   required>
                            @error('password')
                                <span class="text-danger small d-block mt-1">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group jb_cover mb-3">
                            <label class="auth-label">Konfirmasi password baru</label>
                            <input type="password"
                                   name="password_confirmation"
                                   class="form-control"
                                   required>
                        </div>

                        <button type="submit" class="btn jb_btn btn-primary w-100">
                            Simpan Password
                        </button>

                        <div class="mt-3 text-center auth-footer-link">
                            <a href="{{ route('login') }}">← Kembali ke login</a>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
@endsection
