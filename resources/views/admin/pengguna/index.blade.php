{{-- resources/views/admin/pengguna/index.blade.php --}}
@extends('layouts.dashboard_admin')
@section('title','Kelola Pengguna')

@push('styles')
<style>
  /* Sembunyikan pagination otomatis yg bisa nempel persis setelah table-wrap (jaga-jaga) */
  .boxed .table-wrap > nav[role="navigation"]{display:none!important;}

  /* Perapihan sel role */
  .role-cell{display:flex;align-items:center;gap:.5rem 1rem;flex-wrap:wrap}
  .role-inline{min-width:150px}

  /* Util tombol kecil */
  .btn-xs{padding:.38rem .6rem;font-size:.82rem;border-radius:.6rem}

  /* Pager bar styling */
  .pager-bar{display:flex;justify-content:space-between;align-items:center;gap:1rem;flex-wrap:wrap}
  .pager-bar .muted{color:#6b7280}

  /* Pill badge role */
  .pill{display:inline-flex;align-items:center;gap:.35rem;padding:.22rem .55rem;border-radius:999px;font-weight:600;font-size:.78rem;border:1px solid transparent}
  .pill--admin{background:#dbeafe;border-color:#93c5fd;color:#1e3a8a}
  .pill--perusahaan{background:#fef3c7;border-color:#fcd34d;color:#854d0e}
  .pill--pelamar{background:#e5e7eb;border-color:#d1d5db;color:#374151}
</style>
@endpush

@section('content')
  {{-- HEADER / BREADCRUMB --}}
  <div class="page_title_section">
    <div class="page_header">
      <div class="container">
        <div class="row">
          <div class="col-lg-9 col-md-8 col-12"><h1>Kelola Pengguna</h1></div>
          <div class="col-lg-3 col-md-4 col-12">
            <div class="sub_title_section">
              <ul class="sub_title">
                <li><a href="{{ url('/dashboard') }}">Home</a>&nbsp;/&nbsp;</li>
                <li>Kelola Pengguna</li>
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
          <input class="form-control" name="q" placeholder="Cari nama/email..." value="{{ request('q') }}">
          <select class="form-select" name="role">
            @php $r = request('role'); @endphp
            <option value="">Semua role</option>
            @foreach (['pelamar','perusahaan','admin'] as $role)
              <option value="{{ $role }}" @selected($r===$role)>{{ ucfirst($role) }}</option>
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
        <div class="card-hd">Daftar Pengguna</div>

        <div class="table-wrap">
          <div class="table-responsive">
            <table class="table align-middle pretty-table mb-0">
              <thead>
                <tr>
                  <th>Nama</th>
                  <th>Email</th>
                  <th>Role</th>
                  <th>Dibuat</th>
                  <th class="text-end">Aksi</th>
                </tr>
              </thead>
              <tbody>
                @forelse($users as $u)
                  @php
                    $pill = match($u->role){
                      'admin' => 'pill--admin',
                      'perusahaan' => 'pill--perusahaan',
                      default => 'pill--pelamar',
                    };
                  @endphp
                  <tr>
                    <td class="fw-semibold">{{ \Illuminate\Support\Str::limit($u->name, 48) }}</td>
                    <td class="text-muted">{{ \Illuminate\Support\Str::limit($u->email, 58) }}</td>

                    {{-- Role (badge + inline quick change) --}}
                    <td>
                      <div class="role-cell">
                        <span class="pill {{ $pill }}">{{ ucfirst($u->role ?? '-') }}</span>
                        <form action="{{ route('admin.pengguna.role', $u) }}" method="POST" class="d-flex align-items-center gap-2">
                          @csrf @method('PATCH')
                          <select name="role" class="form-select form-select-sm role-inline">
                            @foreach (['pelamar','perusahaan','admin'] as $role)
                              <option value="{{ $role }}" @selected($u->role===$role)>{{ ucfirst($role) }}</option>
                            @endforeach
                          </select>
                          <button class="btn btn-outline-primary btn-xs">Simpan</button>
                        </form>
                      </div>
                    </td>

                    <td>{{ $u->created_at?->format('d M Y') ?? '—' }}</td>

                    <td class="text-end">
                      <div class="dropdown">
                        <button class="btn btn-outline-secondary btn-xs dropdown-toggle" type="button"
                                data-bs-toggle="dropdown" aria-expanded="false">
                          <i class="fas fa-ellipsis-h"></i>
                        </button>
                        <div class="dropdown-menu dropdown-menu-sm dropdown-menu-end">
                          {{-- Reset password --}}
                          <form action="{{ route('admin.pengguna.reset', $u) }}" method="POST">
                            @csrf @method('PATCH')
                            <button class="dropdown-item">
                              <i class="fas fa-key"></i> Reset Password
                            </button>
                          </form>
                          <div class="dropdown-divider"></div>
                          {{-- Hapus --}}
                          <form action="{{ route('admin.pengguna.destroy', $u) }}" method="POST"
                                onsubmit="return confirm('Hapus pengguna ini?')">
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

      {{-- Pagination (10 / halaman) – HANYA SATU di bawah --}}
      <div class="pager-bar mt-3">
        <div class="muted">
          @php
            $from = $users->firstItem();
            $to   = $users->lastItem();
            $tot  = $users->total();
          @endphp
          Menampilkan <strong>{{ $from }}</strong>–<strong>{{ $to }}</strong> dari <strong>{{ $tot }}</strong> pengguna
        </div>
        <div>
          {{-- withQueryString agar filter tetap terbawa saat ganti halaman --}}
          {{ $users->withQueryString()->onEachSide(1)->links('pagination::bootstrap-5') }}
        </div>
      </div>
    </div>
  </div>
@endsection

@push('scripts')
<script>
  // Fallback jika Bootstrap JS tidak termuat, dropdown tetap bisa diklik
  (function(){
    if (typeof bootstrap === 'undefined') {
      document.querySelectorAll('[data-bs-toggle="dropdown"]').forEach(btn => {
        btn.addEventListener('click', function(e){
          e.preventDefault(); e.stopPropagation();
          const menu = this.nextElementSibling; if(!menu) return;
          document.querySelectorAll('.dropdown-menu.show').forEach(m => { if(m!==menu) m.classList.remove('show'); });
          menu.classList.toggle('show');
          const close = (ev)=>{ if(!menu.contains(ev.target) && ev.target!==btn){ menu.classList.remove('show'); document.removeEventListener('click', close);} };
          setTimeout(()=>document.addEventListener('click', close),0);
        });
      });
    }
  })();
</script>
@endpush
