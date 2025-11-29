{{-- resources/views/perusahaan/profil/edit.blade.php --}}
@extends('layouts.dashboard_perusahaan')
@section('title', 'Profil Perusahaan')

@php
    /** @var \App\Models\Perusahaan|null $perusahaan */
    $p      = $perusahaan;
    $logo   = $p?->logo_path   ? asset('storage/' . $p->logo_path)   : asset('images/job1.jpg');
    $banner = $p?->banner_path ? asset('storage/' . $p->banner_path) : null;

    // opsi jumlah karyawan
    $jumlahOptions = ['1-10', '11-50', '51-200', '201-500', '501-1000', '1000+'];
@endphp

@section('content')
    <div class="page_title_section">
        <div class="page_header">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-8">
                        <h1>Profil Perusahaan</h1>
                        <div class="small text-white-50">
                            {{ $p?->nama_perusahaan ?? auth()->user()->name }}
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="sub_title_section text-lg-end">
                            <ul class="sub_title">
                                <li><a href="{{ url('/dashboard') }}">Home</a>&nbsp;/&nbsp;</li>
                                <li>Profil Perusahaan</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="job_filter_listing_wrapper jb_cover">
        <div class="container">
            @if (session('ok'))
                <div class="alert alert-success">{{ session('ok') }}</div>
            @endif
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $e)
                            <li>{{ $e }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="row g-3">
                {{-- Sidebar preview --}}
                <div class="col-lg-4">
                    <div class="jb-card p-3">
                        <img id="logoPreview" src="{{ $logo }}" class="preview-logo" alt="logo">
                        <div class="mt-2 fw-bold">
                            {{ $p?->nama_perusahaan ?? 'Nama Perusahaan' }}
                        </div>
                        <div class="small text-muted">
                            {{ $p?->kota ? $p->kota . ($p->provinsi ? ', ' . $p->provinsi : '') : '' }}
                        </div>
                        @if ($banner)
                            <hr>
                            <img id="bannerPreview" src="{{ $banner }}" class="preview-banner" alt="banner">
                        @endif
                    </div>
                </div>

                {{-- Form --}}
                <div class="col-lg-8">
                    <div class="jb-card">
                        <div class="jb-hd">
                            <h1 class="mb-0">Ubah Profil</h1>
                        </div>
                        <div class="p-3">
                            <form method="POST"
                                  action="{{ route('perusahaan.profil.update') }}"
                                  enctype="multipart/form-data"
                                  class="row g-3">
                                @csrf
                                @method('PUT')

                                <div class="col-md-8">
                                    <label class="form-label">Nama Perusahaan</label>
                                    <input name="nama_perusahaan"
                                           class="form-control @error('nama_perusahaan') is-invalid @enderror"
                                           value="{{ old('nama_perusahaan', $p?->nama_perusahaan) }}"
                                           required>
                                    @error('nama_perusahaan')
                                        <div class="text-danger small">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-md-4">
                                    <label class="form-label">Telepon</label>
                                    <input name="telepon"
                                           class="form-control @error('telepon') is-invalid @enderror"
                                           value="{{ old('telepon', $p?->telepon) }}">
                                    @error('telepon')
                                        <div class="text-danger small">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-md-6">
                                    <label class="form-label">Email Kantor</label>
                                    <input name="email_kantor" type="email"
                                           class="form-control @error('email_kantor') is-invalid @enderror"
                                           value="{{ old('email_kantor', $p?->email_kantor) }}">
                                    @error('email_kantor')
                                        <div class="text-danger small">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-md-6">
                                    <label class="form-label">Website</label>
                                    <input name="website" type="url"
                                           class="form-control @error('website') is-invalid @enderror"
                                           placeholder="https://example.com"
                                           value="{{ old('website', $p?->website) }}">
                                    @error('website')
                                        <div class="text-danger small">{{ $message }}</div>
                                    @enderror
                                </div>

                                {{-- INDUSTRI / BIDANG USAHA + JUMLAH KARYAWAN + TAHUN BERDIRI --}}
                                <div class="col-md-6">
                                    <label class="form-label">Industri / Bidang Usaha</label>
                                    <input name="bidang_usaha"
                                           class="form-control @error('bidang_usaha') is-invalid @enderror"
                                           placeholder="Contoh: Teknologi Informasi"
                                           value="{{ old('bidang_usaha', $p?->bidang_usaha) }}">
                                    @error('bidang_usaha')
                                        <div class="text-danger small">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-md-3">
                                    <label class="form-label">Jumlah Karyawan</label>
                                    <select name="jumlah_karyawan"
                                            class="form-control @error('jumlah_karyawan') is-invalid @enderror">
                                        <option value="">Pilih...</option>
                                        @foreach ($jumlahOptions as $opt)
                                            <option value="{{ $opt }}"
                                                @selected(old('jumlah_karyawan', $p?->jumlah_karyawan) === $opt)>
                                                {{ $opt }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('jumlah_karyawan')
                                        <div class="text-danger small">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-md-3">
                                    <label class="form-label">Tahun Berdiri</label>
                                    <input name="tahun_berdiri"
                                           type="number"
                                           min="1900"
                                           max="{{ date('Y') }}"
                                           class="form-control @error('tahun_berdiri') is-invalid @enderror"
                                           placeholder="2015"
                                           value="{{ old('tahun_berdiri', $p?->tahun_berdiri) }}">
                                    @error('tahun_berdiri')
                                        <div class="text-danger small">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-12">
                                    <label class="form-label">Alamat</label>
                                    <input name="alamat"
                                           class="form-control @error('alamat') is-invalid @enderror"
                                           value="{{ old('alamat', $p?->alamat) }}">
                                    @error('alamat')
                                        <div class="text-danger small">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-md-4">
                                    <label class="form-label">Kota</label>
                                    <input name="kota"
                                           class="form-control @error('kota') is-invalid @enderror"
                                           value="{{ old('kota', $p?->kota) }}">
                                    @error('kota')
                                        <div class="text-danger small">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-md-4">
                                    <label class="form-label">Provinsi</label>
                                    <input name="provinsi"
                                           class="form-control @error('provinsi') is-invalid @enderror"
                                           value="{{ old('provinsi', $p?->provinsi) }}">
                                    @error('provinsi')
                                        <div class="text-danger small">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-md-4">
                                    <label class="form-label">Kode Pos</label>
                                    <input name="kode_pos"
                                           class="form-control @error('kode_pos') is-invalid @enderror"
                                           value="{{ old('kode_pos', $p?->kode_pos) }}">
                                    @error('kode_pos')
                                        <div class="text-danger small">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-12">
                                    <label class="form-label">Deskripsi</label>
                                    <textarea name="deskripsi" rows="5"
                                              class="form-control @error('deskripsi') is-invalid @enderror"
                                              placeholder="Ceritakan tentang perusahaan">{{ old('deskripsi', $p?->deskripsi) }}</textarea>
                                    @error('deskripsi')
                                        <div class="text-danger small">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-md-4">
                                    <label class="form-label">LinkedIn</label>
                                    <input name="linkedin" type="url"
                                           class="form-control @error('linkedin') is-invalid @enderror"
                                           placeholder="https://www.linkedin.com/…"
                                           value="{{ old('linkedin', $p?->linkedin) }}">
                                    @error('linkedin')
                                        <div class="text-danger small">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-md-4">
                                    <label class="form-label">Instagram</label>
                                    <input name="instagram" type="url"
                                           class="form-control @error('instagram') is-invalid @enderror"
                                           placeholder="https://instagram.com/…"
                                           value="{{ old('instagram', $p?->instagram) }}">
                                    @error('instagram')
                                        <div class="text-danger small">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-md-4">
                                    <label class="form-label">Facebook</label>
                                    <input name="facebook" type="url"
                                           class="form-control @error('facebook') is-invalid @enderror"
                                           placeholder="https://facebook.com/…"
                                           value="{{ old('facebook', $p?->facebook) }}">
                                    @error('facebook')
                                        <div class="text-danger small">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-md-6">
                                    <label class="form-label d-block mb-1">Logo (≤ 1MB)</label>
                                    <label for="logoInput" class="btn btn-outline-purple mb-2">Ganti Logo</label>
                                    <input id="logoInput" type="file" name="logo"
                                           accept=".jpg,.jpeg,.png,.webp"
                                           class="d-none">
                                    @error('logo')
                                        <div class="text-danger small">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-md-6">
                                    <label class="form-label d-block mb-1">Banner (≤ 2MB)</label>
                                    <label for="bannerInput" class="btn btn-outline-purple mb-2">Ganti Banner</label>
                                    <input id="bannerInput" type="file" name="banner"
                                           accept=".jpg,.jpeg,.png,.webp"
                                           class="d-none">
                                    @error('banner')
                                        <div class="text-danger small">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-12 d-flex gap-2">
                                    <button class="btn btn-purple" type="submit">Simpan</button>
                                    <a class="btn btn-outline-purple"
                                       href="{{ route('perusahaan.dashboard') }}">Kembali</a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        const logoInput   = document.getElementById('logoInput');
        const bannerInput = document.getElementById('bannerInput');
        const logoPrev    = document.getElementById('logoPreview');
        const bannerPrev  = document.getElementById('bannerPreview');

        logoInput?.addEventListener('change', e => {
            const f = e.target.files?.[0];
            if (!f) return;
            logoPrev.src = URL.createObjectURL(f);
        });

        bannerInput?.addEventListener('change', e => {
            const f = e.target.files?.[0];
            if (!f) return;
            if (bannerPrev) {
                bannerPrev.src = URL.createObjectURL(f);
            } else {
                const img = document.createElement('img');
                img.id = 'bannerPreview';
                img.className = 'preview-banner mt-2';
                img.src = URL.createObjectURL(f);
                document.querySelector('.jb-card .p-3')?.prepend(img);
            }
        });
    </script>
@endpush
