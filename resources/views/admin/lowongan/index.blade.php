@extends('layouts.dashboard_admin')
@section('title', 'Kelola Lowongan')

@push('styles')
<style>

</style>
@endpush

@section('content')
  {{-- HEADER --}}
  <div class="page_title_section">
    <div class="page_header">
      <div class="container">
        <div class="row">
          <div class="col-lg-9 col-md-8 col-12">
            <h1>Kelola Lowongan</h1>
          </div>
          <div class="col-lg-3 col-md-4 col-12">
            <div class="sub_title_section">
              <ul class="sub_title">
                <li><a href="{{ url('/dashboard') }}">Home</a>&nbsp;/&nbsp;</li>
                <li>Kelola Lowongan</li>
              </ul>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  {{-- BODY --}}
  <div class="job_filter_listing_wrapper jb_cover job-section">
    <div class="container">

      {{-- Toolbar filter --}}
      <form class="toolbar mb-3" method="get">
        <div class="inputs">
          <input class="form-control" name="q" placeholder="Cari judul/deskripsi..." value="{{ request('q') }}">
          <select class="form-select" name="status">
            @php $s = request('status'); @endphp
            <option value="">Semua status</option>
            @foreach (['draft','pending','published','closed'] as $st)
              <option value="{{ $st }}" @selected($s===$st)>{{ ucfirst($st) }}</option>
            @endforeach
          </select>
        </div>
        <div class="actions">
          <button class="btn btn-outline-purple btn-xs">
            <i class="fas fa-filter me-1"></i> Terapkan
          </button>
        </div>
      </form>

      {{-- Alerts --}}
      @if (session('ok'))  <div class="alert alert-success">{{ session('ok') }}</div> @endif
      @if (session('err')) <div class="alert alert-danger">{{ session('err') }}</div> @endif

      <div class="boxed">
        <div class="card-hd">Daftar Lowongan</div>

        <div class="table-wrap">
          <div class="table-responsive">
            <table class="table align-middle pretty-table mb-0">
              <thead>
                <tr>
                  <th>Judul</th>
                  <th>Perusahaan</th>
                  <th>Status</th>
                  <th>Deadline</th>
                  <th class="text-end">Aksi</th>
                </tr>
              </thead>
              <tbody>
                @forelse($lowongans as $l)
                  @php
                    $pill = match($l->status){
                      'published' => 'pill--pub',
                      'pending'   => 'pill--pen',
                      'closed'    => 'pill--cls',
                      default     => 'pill--drf',
                    };
                  @endphp
                  <tr>
                    <td class="fw-semibold">{{ \Illuminate\Support\Str::limit($l->judul, 60) }}</td>
                    <td class="text-muted">{{ \Illuminate\Support\Str::limit($l->perusahaan->nama_perusahaan ?? '-', 40) }}</td>
                    <td><span class="pill {{ $pill }}">{{ ucfirst($l->status) }}</span></td>
                    <td>{{ $l->deadline ? \Illuminate\Support\Carbon::parse($l->deadline)->format('d M Y') : '—' }}</td>
                    <td class="text-end">
                      <div class="dropdown">
                        <button class="btn btn-outline-secondary btn-xs dropdown-toggle" type="button"
                                data-bs-toggle="dropdown" aria-expanded="false">
                          <i class="fas fa-ellipsis-h">Aksi</i>
                        </button>
                        <div class="dropdown-menu dropdown-menu-sm dropdown-menu-end">
                          {{-- Publish --}}
                          <form action="{{ route('admin.lowongan.status', $l) }}" method="POST">
                            @csrf @method('PATCH')
                            <input type="hidden" name="status" value="published">
                            <button class="dropdown-item" @disabled($l->status==='published')}>
                              <i class="fas fa-bullhorn"></i> Publish
                            </button>
                          </form>
                          {{-- Pending --}}
                          <form action="{{ route('admin.lowongan.status', $l) }}" method="POST">
                            @csrf @method('PATCH')
                            <input type="hidden" name="status" value="pending">
                            <button class="dropdown-item" @disabled($l->status==='pending')}>
                              <i class="fas fa-hourglass-half"></i> Jadikan Pending
                            </button>
                          </form>
                          {{-- Close --}}
                          <form action="{{ route('admin.lowongan.status', $l) }}" method="POST">
                            @csrf @method('PATCH')
                            <input type="hidden" name="status" value="closed">
                            <button class="dropdown-item" @disabled($l->status==='closed')}>
                              <i class="fas fa-lock"></i> Tutup (Close)
                            </button>
                          </form>
                          <div class="dropdown-divider"></div>
                          {{-- Hapus --}}
                          <form action="{{ route('admin.lowongan.destroy', $l) }}" method="POST"
                                onsubmit="return confirm('Hapus lowongan ini?')">
                            @csrf @method('DELETE')
                            <button class="dropdown-item text-danger">
                              <i class="fas fa-trash-alt"></i> Hapus
                            </button>
                          </form>
                        </div>
                      </div>
                    </td>
                  </tr>
                @empty
                  <tr>
                    <td colspan="5" class="text-center text-muted p-4">Tidak ada data.</td>
                  </tr>
                @endforelse
              </tbody>
            </table>
          </div>
        </div>
      </div>

      <div class="mt-3">
        {{ $lowongans->links() }}
      </div>
    </div>
  </div>
@endsection

@push('scripts')

@endpush
