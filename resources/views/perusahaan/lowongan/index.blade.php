{{-- resources/views/perusahaan/lowongan/index.blade.php --}}
@extends('layouts.dashboard_perusahaan')
@section('title', 'Kelola Lowongan')



@section('content')
    {{-- HEADER (template JB) --}}
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

            {{-- Toolbar --}}
            <form class="toolbar" method="get">
                <div class="inputs">
                    <input name="q" class="form-control" style="min-width:260px" placeholder="Cari judul..."
                        value="{{ request('q') }}">
                    <select name="status" class="form-select" style="min-width:180px">
                        <option value="">Semua status</option>
                        @foreach (['draft', 'pending', 'published', 'closed'] as $st)
                            <option value="{{ $st }}" @selected(request('status') === $st)>{{ ucfirst($st) }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="actions">
                    <button class="btn btn-outline-purple btn-xs" type="submit">
                        <i class="fas fa-filter me-1"></i> Terapkan
                    </button>
                    <a href="{{ route('perusahaan.lowongan.create') }}" class="btn btn-purple btn-xs">
                        <i class="fas fa-plus me-1"></i> Buat Lowongan
                    </a>
                </div>
            </form>

            @if (session('ok'))
                <div class="alert alert-success">{{ session('ok') }}</div>
            @endif
            @if (session('err'))
                <div class="alert alert-danger">{{ session('err') }}</div>
            @endif

            <div class="boxed">
                <div class="card-hd">Daftar Lowongan</div>

                <div class="table-wrap">
                    <table class="table align-middle pretty-table mb-0">
                        <thead>
                            <tr>
                                <th>Judul</th>
                                <th>Status</th>
                                <th>Deadline</th>
                                <th>Pelamar</th>
                                <th>Dibuat</th>
                                <th class="text-end">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($items as $l)
                                @php
                                    $statusClass =
                                        $l->status === 'published'
                                            ? 'pill--pub'
                                            : ($l->status === 'pending'
                                                ? 'pill--pen'
                                                : 'pill--cls');
                                    $tot = $l->lamarans_count ?? $l->lamarans->count();
                                    $dik = $l->l_dikirim_count ?? 0;
                                    $dip = $l->l_diproses_count ?? 0;
                                    $dit = $l->l_diterima_count ?? 0;
                                    $tol = $l->l_ditolak_count ?? 0;
                                @endphp
                                <tr>
                                    <td class="fw-semibold">
                                        {{ $l->judul }}
                                        <div class="muted">{{ $l->perusahaan->nama_perusahaan ?? '' }}</div>
                                    </td>

                                    <td>
                                        <span class="pill {{ $statusClass }}">{{ ucfirst($l->status) }}</span>
                                        @if ($l->status === 'pending')
                                            <div class="muted mt-1">Menunggu publikasi admin</div>
                                        @endif
                                    </td>

                                    <td>{{ $l->deadline ? \Illuminate\Support\Carbon::parse($l->deadline)->format('d M Y') : '—' }}
                                    </td>

                                    <td>
                                        <div class="chips">
                                            <span class="chip chip--total">Total <span
                                                    class="cnt">{{ $tot }}</span></span>
                                            <span class="chip chip--sent">Dikirim <span
                                                    class="cnt">{{ $dik }}</span></span>
                                            <span class="chip chip--proc">Diproses <span
                                                    class="cnt">{{ $dip }}</span></span>
                                            <span class="chip chip--ok">Diterima <span
                                                    class="cnt">{{ $dit }}</span></span>
                                            <span class="chip chip--rej">Ditolak <span
                                                    class="cnt">{{ $tol }}</span></span>
                                        </div>
                                    </td>

                                    <td>{{ $l->created_at->format('d M Y') }}</td>

                                    <td class="text-end">
                                        <div class="action-dropdown">
                                            <button type="button" class="btn btn-outline-secondary btn-xs action-toggle"
                                                data-bs-toggle="dropdown" data-toggle="dropdown" aria-expanded="false">
                                                <i class="fas fa-ellipsis-h me-1"></i> Aksi
                                            </button>

                                            <div class="action-menu dropdown-menu">
                                                <a class="dropdown-item"
                                                    href="{{ route('perusahaan.lamaran.index', $l) }}">
                                                    <i class="fas fa-users"></i> Lihat Pelamar
                                                </a>

                                                <a class="dropdown-item"
                                                    href="{{ route('perusahaan.lowongan.edit', $l) }}">
                                                    <i class="fas fa-pen"></i> Edit
                                                </a>

                                                <form action="{{ route('perusahaan.lowongan.toggle', $l) }}" method="POST"
                                                    class="m-0 p-0">
                                                    @csrf @method('PATCH')
                                                    @php $canToggle = in_array($l->status,['published','closed']); @endphp
                                                    <button type="submit" class="dropdown-item"
                                                        @disabled(!$canToggle)>
                                                        <i
                                                            class="fas {{ $l->status === 'published' ? 'fa-lock' : 'fa-unlock' }}"></i>
                                                        {{ $l->status === 'published' ? 'Tutup' : 'Buka' }}
                                                    </button>
                                                </form>

                                                <form action="{{ route('perusahaan.lowongan.destroy', $l) }}"
                                                    method="POST" class="m-0 p-0"
                                                    onsubmit="return confirm('Hapus lowongan ini?')">
                                                    @csrf @method('DELETE')
                                                    <button type="submit" class="dropdown-item danger">
                                                        <i class="fas fa-trash"></i> Hapus
                                                    </button>
                                                </form>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="text-center text-muted p-4">Belum ada lowongan.</td>
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
