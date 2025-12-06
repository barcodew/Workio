@extends('layouts.dashboard_perusahaan')
@section('title', 'Log Aktivitas')

@section('content')
  {{-- HEADER --}}
  <div class="page_title_section">
    <div class="page_header">
      <div class="container">
        <div class="row align-items-center">
          <div class="col-lg-8 col-md-7">
            <h1>Log Aktivitas</h1>
            <div class="small" style="opacity:.9">
              Riwayat aktivitas pengguna di sistem.
            </div>
          </div>
          <div class="col-lg-4 col-md-5">
            <div class="sub_title_section text-md-end">
              <ul class="sub_title">
                <li><a href="{{ url('/dashboard') }}">Home</a>&nbsp;/&nbsp;</li>
                <li>Log Aktivitas</li>
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

      {{-- FILTER BAR --}}
      <div class="jb-card mb-3">
        <form method="GET" class="row g-2 align-items-end">
          {{-- Filter Lowongan --}}
          <div class="col-md-3">
            <label class="form-label small mb-1">Lowongan</label>
            <select name="lowongan_id" class="form-select form-select-sm">
              <option value="">Semua</option>
              @foreach($lowongans as $l)
                <option value="{{ $l->id }}" @selected(request('lowongan_id') == $l->id)>
                  {{ \Illuminate\Support\Str::limit($l->judul, 45) }}
                </option>
              @endforeach
            </select>
          </div>

          {{-- Filter Perusahaan --}}
          <div class="col-md-3">
            <label class="form-label small mb-1">Perusahaan</label>
            <select name="perusahaan_id" class="form-select form-select-sm">
              <option value="">Semua</option>
              @foreach($perusahaans as $p)
                <option value="{{ $p->id }}" @selected(request('perusahaan_id') == $p->id)>
                  {{ \Illuminate\Support\Str::limit($p->nama_perusahaan, 45) }}
                </option>
              @endforeach
            </select>
          </div>

          {{-- Filter Pelamar --}}
          <div class="col-md-3">
            <label class="form-label small mb-1">Pelamar</label>
            <select name="pelamar_id" class="form-select form-select-sm">
              <option value="">Semua</option>
              @foreach($pelamars as $pl)
                <option value="{{ $pl->id }}" @selected(request('pelamar_id') == $pl->id)>
                  {{ \Illuminate\Support\Str::limit($pl->name, 45) }}
                </option>
              @endforeach
            </select>
          </div>

          {{-- Filter Jenis Aksi --}}
          <div class="col-md-2">
            <label class="form-label small mb-1">Jenis Aksi</label>
            <select name="action" class="form-select form-select-sm">
              <option value="">Semua</option>
              <option value="lowongan_dibuat" @selected(request('action') == 'lowongan_dibuat')>
                Lowongan dibuat
              </option>
              <option value="lamaran_dibuat" @selected(request('action') == 'lamaran_dibuat')>
                Lamaran dibuat
              </option>
              {{-- kalau nanti ada aksi lain, tinggal tambah option di sini --}}
            </select>
          </div>

          <div class="col-md-1 text-md-end">
            <button class="btn btn-purple btn-sm w-100" type="submit">
              <i class="fas fa-filter me-1"></i> Filter
            </button>
          </div>
        </form>
      </div>

      {{-- TABEL AKTIVITAS --}}
      <div class="jb-card">
        <div class="jb-hd d-flex justify-content-between align-items-center">
          <h1 class="mb-0">Aktivitas Terdaftar</h1>
          <div class="small text-white-50">
            {{ $aktivitas->total() }} entri
          </div>
        </div>

        <div class="table-responsive">
          <table class="table align-middle pretty-table mb-0">
            <thead>
              <tr>
                <th style="width: 30%">Deskripsi</th>
                <th>Pelaku</th>
                <th>Lowongan</th>
                <th>Perusahaan</th>
                <th>Pelamar</th>
                <th style="width: 130px;">Waktu</th>
              </tr>
            </thead>
            <tbody>
              @forelse($aktivitas as $log)
                <tr>
                  {{-- Deskripsi + jenis aksi --}}
                  <td>
                    <div class="fw-semibold">
                      {{ $log->description }}
                    </div>
                    <div class="small text-muted">
                      {{ $log->action }}
                    </div>
                  </td>

                  {{-- Pelaku --}}
                  <td>
                    <div class="fw-semibold">
                      {{ $log->user->name ?? '-' }}
                    </div>
                    <div class="small text-muted">
                      {{ $log->role ?? '-' }}
                    </div>
                  </td>

                  {{-- Lowongan --}}
                  <td>
                    {{ $log->lowongan?->judul ?? '-' }}
                  </td>

                  {{-- Perusahaan --}}
                  <td>
                    {{ $log->perusahaan?->nama_perusahaan ?? '-' }}
                  </td>

                  {{-- Pelamar --}}
                  <td>
                    {{ $log->pelamar?->name ?? '-' }}
                  </td>

                  {{-- Waktu --}}
                  <td>
                    <div>{{ $log->created_at?->format('d/m/Y') }}</div>
                    <div class="small text-muted">{{ $log->created_at?->format('H:i') }}</div>
                  </td>
                </tr>
              @empty
                <tr>
                  <td colspan="6" class="text-center text-muted p-4">
                    Belum ada aktivitas yang tercatat.
                  </td>
                </tr>
              @endforelse
            </tbody>
          </table>
        </div>

        <div class="px-3 py-2">
          {{ $aktivitas->links() }}
        </div>
      </div>

    </div>
  </div>
@endsection
