@extends('layouts.dashboard_perusahaan')
@section('title', 'Dasbor Perusahaan')


@section('content')
  {{-- PAGE TITLE / BREADCRUMB --}}
  <div class="page_title_section">
    <div class="page_header">
      <div class="container">
        <div class="row align-items-center">
          <div class="col-lg-8 col-md-7">
            <h1>Dasbor Perusahaan</h1>
            <div class="small" style="opacity:.95">{{ $perusahaan->nama_perusahaan ?? auth()->user()->name }}</div>
          </div>
          <div class="col-lg-4 col-md-5">
            <div class="sub_title_section text-md-end">
              <ul class="sub_title">
                <li><a href="{{ url('/dashboard') }}">Home</a>&nbsp;/&nbsp;</li>
                <li>Dashboard Perusahaan</li>
              </ul>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  {{-- BODY --}}
  <div class="job_filter_listing_wrapper jb_cover">
    <div class="container dash-company"><!-- SCOPING WRAPPER MULAI -->

      {{-- ACTIONS --}}
      <div class="actions-row mb-3">
        <a href="{{ route('perusahaan.profil.edit') }}" class="btn btn-outline-purple">
          <i class="fas fa-building me-1"></i> Lengkapi Profil Perusahaan
        </a>
        <a href="{{ route('perusahaan.lowongan.create') }}" class="btn btn-outline-purple">
          <i class="fas fa-plus me-1"></i> Buat Lowongan
        </a>
        <a href="{{ route('perusahaan.lowongan.index') }}" class="btn btn-outline-purple">
          <i class="fas fa-briefcase me-1"></i> Lowongan Saya
        </a>

        {{-- LOGOUT BUTTON --}}
        <form id="logout-form" action="{{ route('logout') }}" method="POST">
          @csrf
          <button type="submit" class="btn btn-outline-danger">
            <i class="fas fa-power-off me-1"></i> Logout
          </button>
        </form>
      </div>

      {{-- STATS --}}
      <div class="row g-3 mb-3">
        <div class="col-md-3 col-6">
          <div class="stat-card">
            <div class="label">Total Lowongan</div>
            <div class="num">{{ $stat['total_lowongan'] ?? 0 }}</div>
          </div>
        </div>
        <div class="col-md-3 col-6">
          <div class="stat-card">
            <div class="label">Published</div>
            <div class="num">{{ $stat['published'] ?? 0 }}</div>
          </div>
        </div>
        <div class="col-md-3 col-6">
          <div class="stat-card">
            <div class="label">Pending</div>
            <div class="num">{{ $stat['pending'] ?? 0 }}</div>
          </div>
        </div>
        <div class="col-md-3 col-6">
          <div class="stat-card">
            <div class="label">Total Lamaran</div>
            <div class="num">{{ $stat['total_lamaran'] ?? 0 }}</div>
          </div>
        </div>
      </div>

      @php
        $showJobs = 5;  $showApps = 5;
        $jobsLimited = $lowonganSaya->take($showJobs);
        $appsLimited = $lamaranTerbaru->take($showApps);
        $moreJobs = $lowonganSaya->count() > $jobsLimited->count();
        $moreApps = $lamaranTerbaru->count() > $appsLimited->count();
      @endphp

      <div class="row g-3">
        {{-- LOWONGAN TERAKHIR --}}
        <div class="col-lg-6">
          <div class="jb-card">
            <div class="jb-hd d-flex justify-content-between align-items-center">
              <h1 class="mb-0">Lowongan Terakhir</h1>
              <div class="small text-white-50">Terbaru • {{ $lowonganSaya->count() }}</div>
            </div>

            @if($jobsLimited->isEmpty())
              <div class="p-4 text-center text-muted">Belum ada lowongan dibuat.</div>
            @else
              <div class="table-responsive">
                <table class="table align-middle mb-0 pretty-table">
                  <thead>
                    <tr>
                      <th style="width:42%">Judul</th>
                      <th style="width:18%">Status</th>
                      <th style="width:20%">Deadline</th>
                      <th class="text-end" style="width:20%">Aksi</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach($jobsLimited as $l)
                      @php
                        $badgeClass = $l->status === 'published' ? 'mini-badge published'
                                     : ($l->status === 'pending' ? 'mini-badge pending' : 'mini-badge closed');
                      @endphp
                      <tr>
                        <td class="fw-semibold">
                          <a href="{{ route('perusahaan.lowongan.edit', $l) }}" class="link-dark text-decoration-none">
                            {{ \Illuminate\Support\Str::limit($l->judul, 42) }}
                          </a>
                          <div class="small text-muted">
                            {{ \Illuminate\Support\Str::limit($l->lokasi ?? '—', 36) }}
                          </div>
                        </td>
                        <td><span class="{{ $badgeClass }}">{{ ucfirst($l->status) }}</span></td>
                        <td>{{ $l->deadline ? \Illuminate\Support\Carbon::parse($l->deadline)->format('d M Y') : '—' }}</td>
                        <td class="text-end">
                          <a class="btn btn-outline-purple btn-xs"
                             href="{{ route('perusahaan.lamaran.index', ['lowongan' => $l->id]) }}">
                            Kelola
                          </a>
                        </td>
                      </tr>
                    @endforeach
                  </tbody>
                </table>
              </div>

              @if($moreJobs)
                <div class="px-3 py-2 text-end">
                  <a href="{{ route('perusahaan.lowongan.index') }}" class="btn btn-light btn-xs border">
                    Lihat semua lowongan
                  </a>
                </div>
              @endif
            @endif
          </div>
        </div>

        {{-- LAMARAN TERBARU --}}
        <div class="col-lg-6">
          <div class="jb-card">
            <div class="jb-hd d-flex justify-content-between align-items-center">
              <h1 class="mb-0">Lamaran Terbaru</h1>
              <div class="small text-white-50">Masuk • {{ $lamaranTerbaru->count() }}</div>
            </div>

            @if($appsLimited->isEmpty())
              <div class="p-4 text-center text-muted">Belum ada lamaran masuk.</div>
            @else
              <div class="table-responsive">
                <table class="table align-middle mb-0 pretty-table">
                  <thead>
                    <tr>
                      <th style="width:26%">Pelamar</th>
                      <th style="width:34%">Lowongan</th>
                      <th style="width:20%">Status</th>
                      <th class="text-end" style="width:20%">Aksi</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach($appsLimited as $a)
                      @php
                        $st = strtolower($a->status ?? 'unknown');
                        $map = [
                          'dikirim'  => 'mini-badge pending',
                          'diproses' => 'mini-badge pending',
                          'diterima' => 'mini-badge published',
                          'ditolak'  => 'mini-badge closed',
                        ];
                        $stClass = $map[$st] ?? 'mini-badge closed';
                      @endphp
                      <tr>
                        <td class="fw-medium">
                          {{ \Illuminate\Support\Str::limit($a->pelamar->name ?? '-', 26) }}
                          <div class="small text-muted">
                            {{ optional($a->created_at)->diffForHumans() }}
                          </div>
                        </td>
                        <td>
                          {{ \Illuminate\Support\Str::limit($a->lowongan->judul ?? '-', 34) }}
                          <div class="small text-muted">
                            {{ \Illuminate\Support\Str::limit($a->lowongan->perusahaan->nama_perusahaan ?? '-', 34) }}
                          </div>
                        </td>
                        <td><span class="{{ $stClass }}">{{ ucfirst($st) }}</span></td>
                        <td class="text-end">
                          @if ($a->lowongan)
                            <a class="btn btn-outline-purple btn-xs"
                               href="{{ route('perusahaan.lamaran.index', ['lowongan' => $a->lowongan->id]) }}">
                              Kelola
                            </a>
                          @endif
                        </td>
                      </tr>
                    @endforeach
                  </tbody>
                </table>
              </div>

              @if($moreApps)
                <div class="px-3 py-2 text-end">
                  @php $firstJobId = optional($lowonganSaya->first())->id; @endphp
                  @if($firstJobId)
                    <a href="{{ route('perusahaan.lamaran.index', ['lowongan' => $firstJobId]) }}"
                       class="btn btn-light btn-xs border">
                      Lihat semua lamaran
                    </a>
                  @endif
                </div>
              @endif
            @endif
          </div>
        </div>
      </div>

    </div><!-- /.dash-company -->
  </div>
@endsection
