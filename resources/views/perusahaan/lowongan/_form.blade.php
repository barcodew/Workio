{{-- resources/views/perusahaan/lowongan/_form.blade.php --}}
<form action="{{ $action }}" method="POST" class="row g-3">
    @csrf @method($method ?? 'POST')
    @php $m = $model ?? null; @endphp

    <div class="col-12">
        <label class="form-label">Judul</label>
        <input name="judul" class="form-control @error('judul') is-invalid @enderror" required maxlength="200"
            value="{{ old('judul', $m->judul ?? '') }}">
        @error('judul')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="col-12">
        <label class="form-label">Deskripsi</label>
        <textarea name="deskripsi" class="form-control @error('deskripsi') is-invalid @enderror" rows="6" required>{{ old('deskripsi', $m->deskripsi ?? '') }}</textarea>
        <div class="form-text">Gunakan paragraf & poin agar mudah dibaca.</div>
        @error('deskripsi')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="col-12">
        <label class="form-label">Kualifikasi (opsional)</label>
        <textarea name="kualifikasi" class="form-control @error('kualifikasi') is-invalid @enderror" rows="4">{{ old('kualifikasi', $m->kualifikasi ?? '') }}</textarea>
        @error('kualifikasi')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    {{-- Row: Lokasi, Tipe, Deadline --}}
    <div class="col-12">
        <div class="form-row-tight">
            <div>
                <label class="form-label">Lokasi</label>
                <input name="lokasi" class="form-control @error('lokasi') is-invalid @enderror"
                    placeholder="Contoh: Jakarta / Remote" value="{{ old('lokasi', $m->lokasi ?? '') }}">
                @error('lokasi')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div>
                <label class="form-label">Tipe</label>
                <select name="tipe_pekerjaan" class="form-select @error('tipe_pekerjaan') is-invalid @enderror">
                    <option value="">— Pilih —</option>
                    @foreach (['Full-time', 'Part-time', 'Internship', 'Contract'] as $t)
                        <option value="{{ $t }}" @selected(old('tipe_pekerjaan', $m->tipe_pekerjaan ?? '') === $t)>
                            {{ $t }}
                        </option>
                    @endforeach
                </select>
                @error('tipe_pekerjaan')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div>
                <label class="form-label">Deadline</label>
                <input type="date" name="deadline" class="form-control @error('deadline') is-invalid @enderror"
                    value="{{ old('deadline', isset($m->deadline) ? \Illuminate\Support\Carbon::parse($m->deadline)->format('Y-m-d') : '') }}">
                @error('deadline')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
        </div>
    </div>

    <div class="col-12 d-flex gap-2 justify-content-end">
        <a href="{{ route('perusahaan.lowongan.index') }}" class="btn btn-outline-secondary btn-xs">
            <i class="fas fa-arrow-left me-1"></i> Kembali
        </a>
        <button class="btn btn-purple btn-xs">
            <i class="fas fa-save me-1"></i> Simpan
        </button>
    </div>
</form>
