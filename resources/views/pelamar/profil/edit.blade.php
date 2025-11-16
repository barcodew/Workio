{{-- resources/views/pelamar/profil/edit.blade.php --}}
@extends('layouts.dashboard_pelamar')
@section('title', 'Profil Pelamar')

@push('styles')
    {{-- <style>
        /* contoh kecil, boleh dihapus/ubah sesuai selera */
        .jb-card {
            background: #ffffff;
            border-radius: 8px;
            padding: 16px;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.05);
        }
        .small-muted {
            font-size: 0.85rem;
            color: #6c757d;
        }
        .badge-soft {
            background: rgba(0, 123, 255, 0.08);
            color: #007bff;
            border-radius: 999px;
            padding: 2px 8px;
            font-size: 0.75rem;
        }
        .progress-slim {
            width: 100%;
            background: #e9ecef;
            border-radius: 999px;
            height: 6px;
            overflow: hidden;
        }
        .progress-slim span {
            display: block;
            height: 100%;
            background: linear-gradient(90deg, #007bff, #00c9a7);
        }
        .feedlist li a.link_active {
            font-weight: 600;
            color: #007bff;
        }
        .cv-frame {
            width: 100%;
            height: 420px;
            border: 1px solid #dee2e6;
            border-radius: 6px;
            background: #f8f9fa;
        }
        .site-button.disabled {
            pointer-events: none;
            opacity: 0.6;
        }
    </style> --}}
@endpush

@section('content')
    {{-- Header breadcrumb --}}
    <div class="page_title_section">
        <div class="page_header">
            <div class="container">
                <div class="row">
                    <div class="col-lg-9 col-md-8 col-12 col-sm-7">
                        <h1>Profil Pelamar</h1>
                    </div>
                    <div class="col-lg-3 col-md-4 col-12 col-sm-5">
                        <div class="sub_title_section">
                            <ul class="sub_title">
                                <li><a href="{{ route('pelamar.dashboard') }}">Dasbor</a>&nbsp;/&nbsp;</li>
                                <li>Profil Pelamar</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Body --}}
    <div class="candidate_dashboard_wrapper jb_cover" style="padding-top:24px;">
        <div class="container">
            @if (session('ok'))
                <div class="alert alert-success">{{ session('ok') }}</div>
            @endif

            <div class="row">
                {{-- Sidebar profil ringkas --}}
                <div class="col-lg-4 col-md-5 mb-3">
                    <div class="emp_dashboard_sidebar jb_cover jb-card p-3">
                        @php
                            $avatar = asset('images/job1.jpg');
                            if (optional(auth()->user())->avatar_path) {
                                $avatar = asset('storage/' . auth()->user()->avatar_path);
                            }

                            $filled = 0;
                            $total = 3;
                            if (optional($pelamar)->telepon) {
                                $filled++;
                            }
                            if (optional($pelamar)->alamat) {
                                $filled++;
                            }
                            if (optional($pelamar)->cv_path) {
                                $filled++;
                            }
                            $progress = intval(($filled / $total) * 100);
                        @endphp

                        <div class="text-center">
                            <img src="{{ $avatar }}" alt="profile" class="img-fluid"
                                 style="width:110px;height:110px;border-radius:50%;object-fit:cover"
                                 id="avatarPreview">
                            <div class="mt-2">
                                <h4 class="mb-0">{{ auth()->user()->name }}</h4>
                                <div class="small-muted">{{ '@' . Str::slug(auth()->user()->name, '-') }}</div>
                            </div>
                        </div>

                        <div class="mt-3">
                            <div class="d-flex justify-content-between align-items-center mb-1">
                                <span class="small-muted">Kelengkapan Profil</span>
                                <span class="badge-soft">{{ $progress }}%</span>
                            </div>
                            <div class="progress-slim"><span style="width: {{ $progress }}%"></span></div>
                        </div>

                        <hr>
                        <ul class="feedlist" style="list-style:none;padding-left:0;margin:0;">
                            <li class="mb-2">
                                <a href="{{ route('pelamar.dashboard') }}">
                                    <i class="fas fa-tachometer-alt"></i> Dashboard
                                </a>
                            </li>
                            <li class="mb-2">
                                <a href="{{ route('jobs.index') }}">
                                    <i class="fas fa-search"></i> Cari Lowongan
                                </a>
                            </li>
                            <li class="mb-2">
                                <a href="{{ route('pelamar.profil.edit') }}" class="link_active">
                                    <i class="fas fa-user-edit"></i> Edit Profil
                                </a>
                            </li>
                            <li class="mt-2">
                                <a href="{{ route('logout') }}"
                                   onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                                    <i class="fas fa-power-off"></i> Keluar
                                </a>
                            </li>
                        </ul>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                    </div>
                </div>

                {{-- Form utama --}}
                <div class="col-lg-8 col-md-7">
                    <div class="jb-card p-3">
                        <h5 class="section-title">Perbarui Profil</h5>
                        <p class="small-muted mb-3">Lengkapi data di bawah agar peluang diterima semakin besar.</p>

                        <form action="{{ route('pelamar.profil.update') }}" method="POST"
                              enctype="multipart/form-data" class="row">
                            @csrf
                            @method('PUT')

                            {{-- FOTO PROFIL --}}
                            <div class="col-12 mb-3">
                                <label class="small-muted mb-1 d-block">Foto Profil (JPG/PNG, maks 1MB)</label>

                                <div class="d-flex align-items-center flex-wrap">
                                    {{-- Tombol pilih file --}}
                                    <label for="avatarInput" class="site-button outline mb-0">
                                        <i class="fas fa-camera"></i> Ganti Foto
                                    </label>

                                    <span id="avatarFileName" class="small-muted ml-2 mt-1 mt-sm-0">
                                        @if (optional(auth()->user())->avatar_path)
                                            {{ basename(auth()->user()->avatar_path) }}
                                        @else
                                            Belum ada file dipilih
                                        @endif
                                    </span>
                                </div>

                                {{-- Input file disembunyikan --}}
                                <input type="file" name="avatar" id="avatarInput" accept="image/*" class="d-none">

                                @error('avatar')
                                    <div class="text-danger small mt-1">{{ $message }}</div>
                                @enderror
                            </div>

                            {{-- Tanggal lahir + Telepon --}}
                            <div class="col-md-6">
                                @php
                                    // Parsing aman supaya selalu "Y-m-d"
                                    $tgl = $pelamar->tanggal_lahir ?? null;
                                    try {
                                        $tgl = $tgl ? \Illuminate\Support\Carbon::parse($tgl)->format('Y-m-d') : null;
                                    } catch (\Exception $e) {
                                        $tgl = null;
                                    }
                                @endphp
                                <div class="form-group icon_form comments_form">
                                    <input type="date" name="tanggal_lahir"
                                           class="form-control @error('tanggal_lahir') is-invalid @enderror"
                                           value="{{ old('tanggal_lahir', $tgl) }}">
                                </div>
                                @error('tanggal_lahir')
                                    <div class="text-danger small">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6">
                                <div class="form-group icon_form comments_form">
                                    <input name="telepon"
                                           class="form-control @error('telepon') is-invalid @enderror"
                                           placeholder="Telepon"
                                           value="{{ old('telepon', optional($pelamar)->telepon) }}">
                                    <i class="fas fa-phone"></i>
                                </div>
                                @error('telepon')
                                    <div class="text-danger small">{{ $message }}</div>
                                @enderror
                            </div>

                            {{-- Alamat --}}
                            <div class="col-12">
                                <div class="form-group icon_form comments_form">
                                    <input name="alamat"
                                           class="form-control @error('alamat') is-invalid @enderror"
                                           placeholder="Alamat lengkap"
                                           value="{{ old('alamat', optional($pelamar)->alamat) }}">
                                    <i class="fas fa-map-marker-alt"></i>
                                </div>
                                @error('alamat')
                                    <div class="text-danger small">{{ $message }}</div>
                                @enderror
                            </div>

                            {{-- Pendidikan & Keterampilan --}}
                            <div class="col-md-6">
                                <label class="small-muted mb-1 d-block">Pendidikan</label>
                                <div class="form-group icon_form comments_form">
                                    <textarea name="pendidikan" rows="5"
                                              class="form-control @error('pendidikan') is-invalid @enderror"
                                              placeholder="Contoh: S1 Teknik Informatika - Universitas X (2019)">{{ old('pendidikan', optional($pelamar)->pendidikan) }}</textarea>
                                    <i class="fas fa-graduation-cap"></i>
                                </div>
                                @error('pendidikan')
                                    <div class="text-danger small">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6">
                                <label class="small-muted mb-1 d-block">Keterampilan</label>
                                <div class="form-group icon_form comments_form">
                                    <textarea name="keterampilan" rows="5"
                                              class="form-control @error('keterampilan') is-invalid @enderror"
                                              placeholder="Contoh: Laravel, React, SQL, REST API">{{ old('keterampilan', optional($pelamar)->keterampilan) }}</textarea>
                                    <i class="fas fa-tools"></i>
                                </div>
                                @error('keterampilan')
                                    <div class="text-danger small">{{ $message }}</div>
                                @enderror
                            </div>

                            {{-- === CV Upload + Preview === --}}
                            @php
                                $cvUrl = optional($pelamar)->cv_path ? asset('storage/' . $pelamar->cv_path) : null;
                                $cvExt = $cvUrl ? strtolower(pathinfo($cvUrl, PATHINFO_EXTENSION)) : null;
                                $cvViewUrl = $cvUrl
                                    ? ($cvExt === 'pdf'
                                        ? $cvUrl
                                        : 'https://view.officeapps.live.com/op/view.aspx?src=' . urlencode($cvUrl))
                                    : null;
                            @endphp

                            <div class="col-12">
                                <label class="small-muted mb-2 d-block">CV (PDF/DOC/DOCX, maks 2MB)</label>

                                {{-- Tombol aksi (label sebagai trigger file picker) --}}
                                <div class="action-row mb-2">
                                    <label for="cvInput" class="site-button outline mb-0">
                                        <i class="fas fa-upload"></i> Ganti CV
                                    </label>

                                    <a id="btnViewFull" href="{{ $cvViewUrl ?: '#' }}"
                                       target="{{ $cvViewUrl ? '_blank' : '_self' }}"
                                       class="site-button {{ $cvViewUrl ? '' : 'disabled' }}"
                                       @unless ($cvViewUrl) aria-disabled="true" @endunless>
                                        <i class="fas fa-external-link-alt"></i> Lihat CV Lengkap
                                    </a>
                                </div>

                                {{-- Input file disembunyikan total --}}
                                <input type="file" name="cv" id="cvInput" accept=".pdf,.doc,.docx">

                                {{-- PREVIEW --}}
                                <div id="cv-preview">
                                    @if ($cvUrl)
                                        @if ($cvExt === 'pdf')
                                            <iframe id="cvFrame" class="cv-frame"
                                                    src="{{ $cvUrl }}#toolbar=1&navpanes=0&scrollbar=1"
                                                    title="CV Preview" loading="lazy"></iframe>
                                        @elseif (in_array($cvExt, ['doc', 'docx']))
                                            <iframe id="cvFrame" class="cv-frame"
                                                    src="https://view.officeapps.live.com/op/embed.aspx?src={{ urlencode($cvUrl) }}"
                                                    title="CV Preview" loading="lazy"></iframe>
                                            <div class="small-muted mt-2">
                                                Jika viewer tidak tampil, klik
                                                <a href="{{ $cvViewUrl }}" target="_blank">Lihat CV Lengkap</a>.
                                            </div>
                                        @else
                                            <div class="alert alert-info mb-0">
                                                Format pratinjau belum didukung. Gunakan
                                                <strong>Lihat CV Lengkap</strong>.
                                            </div>
                                            <iframe id="cvFrame" class="cv-frame" style="display:none"
                                                    title="CV Preview"></iframe>
                                        @endif
                                    @else
                                        <div class="alert alert-light border mb-0">
                                            Belum ada CV. Klik <strong>Ganti CV</strong> untuk mengunggah.
                                        </div>
                                        <iframe id="cvFrame" class="cv-frame" style="display:none"
                                                title="CV Preview"></iframe>
                                    @endif
                                </div>

                                @error('cv')
                                    <div class="text-danger small mt-2">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-12 d-flex mt-3">
                                <button class="site-button mr-2" type="submit">
                                    <i class="fas fa-save"></i> Simpan Perubahan
                                </button>
                                <a href="{{ route('pelamar.dashboard') }}" class="site-button outline">
                                    <i class="fas fa-arrow-left"></i> Kembali
                                </a>
                            </div>
                        </form>
                    </div>
                </div> {{-- /col kanan --}}
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // ====== CV PREVIEW ======
            const input = document.getElementById('cvInput');
            const frame = document.getElementById('cvFrame');
            const preview = document.getElementById('cv-preview');
            const btnView = document.getElementById('btnViewFull');

            input && input.addEventListener('change', function() {
                const file = this.files && this.files[0] ? this.files[0] : null;
                if (!file) return;

                // bersihkan info lama
                preview.querySelectorAll('.alert-info').forEach(el => el.remove());

                const ext = file.name.split('.').pop().toLowerCase();
                if (ext === 'pdf') {
                    const url = URL.createObjectURL(file);
                    if (frame) {
                        frame.src = url + '#toolbar=1&navpanes=0&scrollbar=1';
                        frame.style.display = 'block';
                    }
                    if (btnView) {
                        btnView.href = url;
                        btnView.target = '_blank';
                        btnView.classList.remove('disabled');
                        btnView.removeAttribute('aria-disabled');
                    }
                } else {
                    if (frame) {
                        frame.style.display = 'none';
                    }
                    preview.insertAdjacentHTML('afterbegin',
                        '<div class="alert alert-info mb-2">Pratinjau langsung hanya untuk PDF. ' +
                        'Simpan perubahan, lalu gunakan <b>Lihat CV Lengkap</b> untuk membuka via Office Viewer.</div>'
                    );
                    if (btnView) {
                        btnView.href = '#';
                        btnView.removeAttribute('target');
                        btnView.classList.add('disabled');
                        btnView.setAttribute('aria-disabled', 'true');
                    }
                }
            });

            // ====== AVATAR PREVIEW ======
            const avatarInput = document.getElementById('avatarInput');
            const avatarPreview = document.getElementById('avatarPreview');
            const avatarFileName = document.getElementById('avatarFileName');

            if (avatarInput) {
                avatarInput.addEventListener('change', function() {
                    const file = this.files && this.files[0] ? this.files[0] : null;
                    if (!file) return;

                    // Cek ukuran maks 1MB
                    const maxSize = 1 * 1024 * 1024; // 1MB
                    if (file.size > maxSize) {
                        alert('Ukuran foto maksimal 1MB.');
                        this.value = '';
                        if (avatarFileName) avatarFileName.textContent = 'Belum ada file dipilih';
                        return;
                    }

                    if (avatarFileName) {
                        avatarFileName.textContent = file.name;
                    }

                    if (avatarPreview) {
                        const url = URL.createObjectURL(file);
                        avatarPreview.src = url;
                    }
                });
            }
        });
    </script>
@endpush
