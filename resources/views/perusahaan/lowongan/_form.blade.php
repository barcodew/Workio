{{-- resources/views/perusahaan/lowongan/_form.blade.php --}}
<form action="{{ $action }}" method="POST" class="row g-3">
    @csrf @method($method ?? 'POST')
    @php
        /** @var \App\Models\Lowongan|null $m */
        $m = $model ?? null;

        // isi awal untuk input teks keahlian
        $skillsInitial = '';
        if ($m && is_array($m->keahlian ?? null)) {
            $skillsInitial = implode(', ', $m->keahlian);
        }
    @endphp

    {{-- ALERT ERROR GLOBAL --}}
    @if ($errors->any())
        <div class="col-12">
            <div class="alert alert-danger">
                <strong>Form belum lengkap.</strong>
                <div>Harap isi semua kolom yang bertanda <span class="text-danger">*</span>.</div>
            </div>
        </div>
    @endif

    <div class="col-12">
        <label class="form-label">Judul <span class="text-danger">*</span></label>
        <input name="judul"
               class="form-control @error('judul') is-invalid @enderror"
               required
               maxlength="200"
               value="{{ old('judul', $m->judul ?? '') }}">
        @error('judul')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="col-12">
        <label class="form-label">Deskripsi <span class="text-danger">*</span></label>
        <textarea name="deskripsi"
                  class="form-control @error('deskripsi') is-invalid @enderror"
                  rows="6"
                  required>{{ old('deskripsi', $m->deskripsi ?? '') }}</textarea>
        <div class="form-text">Gunakan paragraf &amp; poin agar mudah dibaca.</div>
        @error('deskripsi')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="col-12">
        <label class="form-label">Kualifikasi <span class="text-danger">*</span></label>
        <textarea name="kualifikasi"
                  class="form-control @error('kualifikasi') is-invalid @enderror"
                  rows="4"
                  required>{{ old('kualifikasi', $m->kualifikasi ?? '') }}</textarea>
        @error('kualifikasi')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    {{-- KEAHLIAN DIBUTUHKAN -> disimpan di kolom `keahlian` --}}
    <div class="col-12">
        <label class="form-label">Keahlian yang dibutuhkan <span class="text-danger">*</span></label>
        <input name="skills_text"
               class="form-control @error('skills_text') is-invalid @enderror"
               placeholder="Contoh: LARAVEL, REACT, TAILWINDCSS"
               required
               value="{{ old('skills_text', $skillsInitial) }}">
        <div class="form-text">
            Pisahkan dengan koma. Contoh:
            <code>LARAVEL, REACT, TAILWINDCSS</code><br>
            Sistem akan menyimpan dalam huruf besar agar mudah dicocokkan dengan keahlian pelamar.
        </div>
        @error('skills_text')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    {{-- Row: Lokasi, Tipe, Deadline --}}
    <div class="col-12">
        <div class="form-row-tight">
            <div>
                <label class="form-label">Lokasi <span class="text-danger">*</span></label>
                <input name="lokasi"
                       class="form-control @error('lokasi') is-invalid @enderror"
                       placeholder="Contoh: Jakarta / Remote"
                       required
                       value="{{ old('lokasi', $m->lokasi ?? '') }}">
                @error('lokasi')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div>
                <label class="form-label">Tipe <span class="text-danger">*</span></label>
                <select name="tipe_pekerjaan"
                        class="form-select @error('tipe_pekerjaan') is-invalid @enderror"
                        required>
                    <option value="">— Pilih —</option>
                    @foreach (['Full-time', 'Part-time', 'Internship', 'Contract'] as $t)
                        <option value="{{ $t }}"
                            @selected(old('tipe_pekerjaan', $m->tipe_pekerjaan ?? '') === $t)>
                            {{ $t }}
                        </option>
                    @endforeach
                </select>
                @error('tipe_pekerjaan')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div>
                <label class="form-label">Deadline <span class="text-danger">*</span></label>
                <input type="date"
                       name="deadline"
                       class="form-control @error('deadline') is-invalid @enderror"
                       required
                       value="{{ old('deadline',
                            isset($m->deadline)
                                ? \Illuminate\Support\Carbon::parse($m->deadline)->format('Y-m-d')
                                : '') }}">
                @error('deadline')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
        </div>
    </div>

    <div class="col-12 d-flex gap-2 justify-content-end">
        <a href="{{ route('perusahaan.lowongan.index') }}"
           class="btn btn-outline-secondary btn-xs">
            <i class="fas fa-arrow-left me-1"></i> Kembali
        </a>
        <button class="btn btn-purple btn-xs">
            <i class="fas fa-save me-1"></i> Simpan
        </button>
    </div>
</form>
