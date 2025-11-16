{{-- resources/views/perusahaan/lamaran/index.blade.php --}}
@extends('layouts.dashboard_perusahaan')
@section('title', 'Pelamar - ' . $lowongan->judul)

@section('content')
  {{-- HEADER (template) --}}
  <div class="page_title_section">
    <div class="page_header">
      <div class="container">
        <div class="row">
          <div class="col-lg-9 col-md-8 col-12">
            <h1>Pelamar</h1>
            <div class="small" style="opacity:.95">
              Untuk: <strong>{{ $lowongan->judul }}</strong>
              @if($lowongan->perusahaan?->nama_perusahaan)
                — {{ $lowongan->perusahaan->nama_perusahaan }}
              @endif
            </div>
          </div>
          <div class="col-lg-3 col-md-4 col-12">
            <div class="sub_title_section">
              <ul class="sub_title">
                <li><a href="{{ url('/dashboard') }}">Home</a>&nbsp;/&nbsp;</li>
                <li>Pelamar</li>
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

      {{-- Toolbar --}}
      <form class="toolbar" method="get">
        <div class="inputs">
          <select name="status" class="form-select" style="min-width:200px">
            <option value="">Semua status</option>
            @foreach (['dikirim','diproses','diterima','ditolak'] as $st)
              <option value="{{ $st }}" @selected(request('status')===$st)>{{ ucfirst($st) }}</option>
            @endforeach
          </select>
        </div>
        <div class="actions">
          <button class="btn btn-outline-purple btn-xs" type="submit">
            <i class="fas fa-filter me-1"></i> Terapkan
          </button>
          <a href="{{ route('perusahaan.lowongan.index') }}" class="btn btn-purple btn-xs">
            <i class="fas fa-list me-1"></i> Kembali ke Lowongan
          </a>
        </div>
      </form>

      @if (session('ok'))  <div class="alert alert-success">{{ session('ok') }}</div> @endif

      <div class="boxed">
        <div class="card-hd">Daftar Pelamar</div>

        <div class="table-wrap">
          <table class="table align-middle pretty-table mb-0">
            <thead>
              <tr>
                <th>Pelamar</th>
                <th>Dikirim</th>
                <th>CV</th>
                <th>Status</th>
                <th class="text-end">Aksi</th>
              </tr>
            </thead>
            <tbody>
              @forelse($items as $a)
                @php
                  $st = strtolower($a->status);
                  $pill = match($st){
                    'dikirim'  => 'pill--sent',
                    'diproses' => 'pill--proc',
                    'diterima' => 'pill--ok',
                    'ditolak'  => 'pill--rej',
                    default    => 'pill--sent'
                  };
                @endphp
                <tr>
                  <td class="fw-semibold">
                    {{ $a->pelamar->name ?? '-' }}
                    <div class="muted">{{ $a->pelamar->email ?? '' }}</div>
                  </td>

                  <td>
                    {{ $a->created_at->format('d M Y H:i') }}
                    <div class="muted">{{ $a->created_at->diffForHumans() }}</div>
                  </td>

                  <td>
                    @if ($a->file_cv)
                      <a href="{{ asset('storage/' . $a->file_cv) }}" target="_blank"
                         class="btn btn-outline-purple btn-xs">CV Lamaran</a>
                    @elseif(optional($a->pelamar->pelamar)->cv_path)
                      <a href="{{ asset('storage/' . optional($a->pelamar->pelamar)->cv_path) }}" target="_blank"
                         class="btn btn-outline-secondary btn-xs">CV Profil</a>
                    @else
                      <span class="muted">—</span>
                    @endif
                  </td>

                  <td>
                    <span class="pill {{ $pill }}">{{ ucfirst($st) }}</span>
                  </td>

                  <td class="text-end">
                    <div class="action-dropdown">
                      <button type="button"
                              class="btn btn-outline-secondary btn-xs action-toggle"
                              data-bs-toggle="dropdown" data-toggle="dropdown" aria-expanded="false">
                        <i class="fas fa-ellipsis-h me-1"></i> Aksi
                      </button>

                      <div class="action-menu dropdown-menu">
                        {{-- Proses --}}
                        <form action="{{ route('perusahaan.lamaran.status', $a) }}" method="POST" class="m-0 p-0">
                          @csrf @method('PATCH')
                          <input type="hidden" name="status" value="diproses">
                          <button type="submit" class="dropdown-item" @disabled($a->status==='diproses')}>
                            <i class="fas fa-spinner"></i> Tandai Diproses
                          </button>
                        </form>

                        {{-- Terima --}}
                        <form action="{{ route('perusahaan.lamaran.status', $a) }}" method="POST" class="m-0 p-0">
                          @csrf @method('PATCH')
                          <input type="hidden" name="status" value="diterima">
                          <button type="submit" class="dropdown-item" @disabled($a->status==='diterima')}>
                            <i class="fas fa-check-circle"></i> Terima
                          </button>
                        </form>

                        {{-- Tolak --}}
                        <form action="{{ route('perusahaan.lamaran.status', $a) }}" method="POST" class="m-0 p-0"
                              onsubmit="return confirm('Tolak pelamar ini?')">
                          @csrf @method('PATCH')
                          <input type="hidden" name="status" value="ditolak">
                          <button type="submit" class="dropdown-item danger" @disabled($a->status==='ditolak')}>
                            <i class="fas fa-times-circle"></i> Tolak
                          </button>
                        </form>
                      </div>
                    </div>
                  </td>
                </tr>
              @empty
                <tr>
                  <td colspan="5" class="text-center text-muted p-4">Belum ada pelamar.</td>
                </tr>
              @endforelse
            </tbody>
          </table>
        </div>
      </div>

      <div class="mt-3">
        {{ $items->links() }}
      </div>
    </div>
  </div>
@endsection

