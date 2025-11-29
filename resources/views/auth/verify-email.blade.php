{{-- resources/views/auth/verify-email.blade.php --}}
@extends('layouts.dashboard_pelamar')
@section('title','Verifikasi Email')

@section('content')
  <div class="page_title_section">
    <div class="page_header">
      <div class="container">
        <div class="row">
          <div class="col-lg-9 col-md-8 col-12"><h1>Verifikasi Email</h1></div>
          <div class="col-lg-3 col-md-4 col-12">
            <div class="sub_title_section">
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="job_filter_listing_wrapper jb_cover">
    <div class="container">
      <div class="jb-card p-4" style="max-width:760px;margin:0 auto;">
        @if(session('ok')) <div class="alert alert-success mt-3">{{ session('ok') }}</div> @endif
        <h5 class="mb-2">Cek inbox email kamu</h5>
        <p class="text-muted">
          Kami telah mengirimkan tautan verifikasi ke <strong>{{ auth()->user()->email }}</strong>.
          Klik tautannya untuk mengaktifkan akun. Belum menerima email?
        </p>

        <form method="POST" action="{{ route('verification.send') }}" class="d-inline">
          @csrf
          <button class="btn btn-purple btn-sm"><i class="fas fa-paper-plane me-1">  </i>  Kirim Ulang Email</button>
        </form>

        <form method="POST" action="{{ route('logout') }}" class="d-inline ms-2">
          @csrf
          <button class="btn btn-outline-secondary btn-sm"><i class="fas fa-sign-out-alt me-1"></i> Keluar</button>
        </form>

        <hr>
        <div class="small text-muted">
          Sudah verifikasi tapi masih melihat halaman ini? Coba <a href="" onclick="location.reload();return false;">muat ulang</a>.
        </div>
      </div>
    </div>
  </div>
@endsection
