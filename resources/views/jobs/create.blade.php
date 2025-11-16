@extends('layouts.app')
@section('title', 'Buat Lowongan')

@section('content')
    <h4 class="mb-3">Buat Lowongan</h4>

    <form action="{{ route('jobs.store') }}" method="POST" class="row g-3">
        @csrf

        <div class="col-12">
            <label class="form-label">Judul</label>
            <input name="judul" class="form-control" value="{{ old('judul') }}" required maxlength="200">
            @error('judul')
                <div class="text-danger small">{{ $message }}</div>
            @enderror
        </div>

        <div class="col-12">
            <label class="form-label">Deskripsi</label>
            <textarea name="deskripsi" class="form-control" rows="6" required>{{ old('deskripsi') }}</textarea>
            @error('deskripsi')
                <div class="text-danger small">{{ $message }}</div>
            @enderror
        </div>

        <div class="col-12">
            <label class="form-label">Kualifikasi (opsional)</label>
            <textarea name="kualifikasi" class="form-control" rows="4">{{ old('kualifikasi') }}</textarea>
            @error('kualifikasi')
                <div class="text-danger small">{{ $message }}</div>
            @enderror
        </div>

        <div class="col-md-6">
            <label class="form-label">Lokasi (opsional)</label>
            <input name="lokasi" class="form-control" value="{{ old('lokasi') }}" maxlength="150">
            @error('lokasi')
                <div class="text-danger small">{{ $message }}</div>
            @enderror
        </div>

        <div class="col-md-3">
            <label class="form-label">Tipe Pekerjaan</label>
            <select name="tipe_pekerjaan" class="form-select">
                <option value="">— Pilih —</option>
                @foreach (['Full-time', 'Part-time', 'Internship', 'Contract'] as $t)
                    <option value="{{ $t }}" @selected(old('tipe_pekerjaan') === $t)>{{ $t }}</option>
                @endforeach
            </select>
            @error('tipe_pekerjaan')
                <div class="text-danger small">{{ $message }}</div>
            @enderror
        </div>

        <div class="col-md-3">
            <label class="form-label">Deadline (opsional)</label>
            <input type="date" name="deadline" class="form-control" value="{{ old('deadline') }}">
            @error('deadline')
                <div class="text-danger small">{{ $message }}</div>
            @enderror
        </div>

        <div class="col-12 d-flex gap-2">
            <a href="{{ route('perusahaan.lowongan') }}" class="btn btn-outline-secondary">Kembali</a>
            <button class="btn btn-primary">Simpan (status: pending)</button>
        </div>

        <p class="text-muted small mt-2">
            Catatan: Lowongan akan berstatus <b>pending</b> dan dipublikasikan oleh admin.
        </p>
    </form>
@endsection
