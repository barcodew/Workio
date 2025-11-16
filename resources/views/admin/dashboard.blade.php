@extends('layouts.dashboard_perusahaan')
@section('title', 'Dasbor Admin')


@section('content')
  <div class="page_title_section">
    <div class="page_header">
      <div class="container">
        <div class="row align-items-center">
          <div class="col-lg-8 col-md-7">
            <h1>Dasbor Admin</h1>
            <div class="small" style="opacity:.9">Ringkasan sistem & tindakan cepat</div>
          </div>
          <div class="col-lg-4 col-md-5">
            <div class="sub_title_section text-md-end">
              <ul class="sub_title">
                <li><a href="{{ url('/dashboard') }}">Home</a>&nbsp;/&nbsp;</li>
                <li>Dasbor Admin</li>
              </ul>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  {{-- BODY --}}
  <div class="job_filter_listing_wrapper jb_cover">
    <div class="container">
 {{-- ACTION BUTTONS (sejajar dengan stat cards) --}}
      <div class="actions-row mb-3">
        <a href="{{ route('admin.lowongan.index') }}" class="btn btn-outline-purple">
          <i class="fas fa-briefcase me-1"></i> Kelola Lowongan
        </a>
        <a href="{{ route('admin.pengguna.index') }}" class="btn btn-outline-purple">
          <i class="fas fa-users-cog me-1"></i> Kelola Pengguna
        </a>
        {{-- Logout --}}
        <form action="{{ route('logout') }}" method="POST" class="d-inline">
          @csrf
          <button type="submit" class="btn btn-outline-danger">
            <i class="fas fa-sign-out-alt me-1"></i> Logout
          </button>
        </form>
      </div>
      {{-- STAT CARDS --}}
      <div class="row g-3 mb-3 mt-2">
        <div class="col-md-2 col-6"><div class="stat-card"><div class="label">Pengguna</div><div class="num">{{ $stat['pengguna'] }}</div></div></div>
        <div class="col-md-2 col-6"><div class="stat-card"><div class="label">Pelamar</div><div class="num">{{ $stat['pelamar'] }}</div></div></div>
        <div class="col-md-2 col-6"><div class="stat-card"><div class="label">Perusahaan</div><div class="num">{{ $stat['perusahaan'] }}</div></div></div>
        <div class="col-md-2 col-6"><div class="stat-card"><div class="label">Lowongan Aktif</div><div class="num">{{ $stat['low_aktif'] }}</div></div></div>
        <div class="col-md-2 col-6"><div class="stat-card"><div class="label">Lowongan Pending</div><div class="num">{{ $stat['low_pending'] }}</div></div></div>
        <div class="col-md-2 col-6"><div class="stat-card"><div class="label">Total Lamaran</div><div class="num">{{ $stat['total_lamaran'] }}</div></div></div>
      </div>

     

      @php
        $jobsLimited = \Illuminate\Support\Collection::make($lowonganBaru)->take(5);
        $appsLimited = \Illuminate\Support\Collection::make($lamaranBaru)->take(5);
      @endphp

      <div class="row g-3">
        {{-- LOWONGAN TERBARU --}}
        <div class="col-lg-6">
          <div class="jb-card">
            <div class="jb-hd d-flex justify-content-between align-items-center">
              <h1 class="mb-0">Lowongan Terbaru</h1>
              <div class="small text-white-50">{{ $jobsLimited->count() }} entri</div>
            </div>

            <div class="table-responsive">
              <table class="table align-middle pretty-table mb-0">
                <thead>
                  <tr>
                    <th>Judul</th>
                    <th>Perusahaan</th>
                    <th>Status</th>
                  </tr>
                </thead>
                <tbody>
                  @forelse($jobsLimited as $l)
                    @php
                      $cls = $l->status === 'published' ? 'badge-pub'
                           : ($l->status === 'pending' ? 'badge-pen' : 'badge-cls');
                    @endphp
                    <tr>
                      <td class="fw-semibold">{{ \Illuminate\Support\Str::limit($l->judul, 42) }}</td>
                      <td class="text-muted">{{ \Illuminate\Support\Str::limit($l->perusahaan->nama_perusahaan ?? '-', 34) }}</td>
                      <td><span class="badge-pill {{ $cls }}">{{ ucfirst($l->status) }}</span></td>
                    </tr>
                  @empty
                    <tr><td colspan="3" class="text-center text-muted p-4">Belum ada data.</td></tr>
                  @endforelse
                </tbody>
              </table>
            </div>

            <div class="px-3 py-2 text-end">
              <a href="{{ route('admin.lowongan.index') }}" class="btn btn-light btn-xs border">Lihat semua</a>
            </div>
          </div>
        </div>

        {{-- LAMARAN TERBARU --}}
        <div class="col-lg-6">
          <div class="jb-card">
            <div class="jb-hd d-flex justify-content-between align-items-center">
              <h1 class="mb-0">Lamaran Terbaru</h1>
              <div class="small text-white-50">{{ $appsLimited->count() }} entri</div>
            </div>

            <div class="table-responsive">
              <table class="table align-middle pretty-table mb-0">
                <thead>
                  <tr>
                    <th>Lowongan</th>
                    <th>Perusahaan</th>
                    <th>Pelamar</th>
                    <th>Status</th>
                  </tr>
                </thead>
                <tbody>
                  @forelse($appsLimited as $a)
                    @php
                      $st = strtolower($a->status ?? 'unknown');
                      $cls = match ($st) {
                        'dikirim','diproses' => 'badge-pen',
                        'diterima'           => 'badge-pub',
                        'ditolak'            => 'badge-cls',
                        default              => 'badge-cls',
                      };
                    @endphp
                    <tr>
                      <td class="fw-semibold">{{ \Illuminate\Support\Str::limit($a->lowongan->judul ?? '-', 36) }}</td>
                      <td class="text-muted">{{ \Illuminate\Support\Str::limit($a->lowongan->perusahaan->nama_perusahaan ?? '-', 34) }}</td>
                      <td>{{ \Illuminate\Support\Str::limit($a->pelamar->name ?? '-', 28) }}</td>
                      <td><span class="badge-pill {{ $cls }}">{{ ucfirst($st) }}</span></td>
                    </tr>
                  @empty
                    <tr><td colspan="4" class="text-center text-muted p-4">Belum ada data.</td></tr>
                  @endforelse
                </tbody>
              </table>
            </div>

            <div class="px-3 py-2 text-end">
              <a href="{{ route('admin.lowongan.index') }}" class="btn btn-light btn-xs border">Lihat semua</a>
            </div>
          </div>
        </div>
      </div>

    </div>
  </div>
@endsection
