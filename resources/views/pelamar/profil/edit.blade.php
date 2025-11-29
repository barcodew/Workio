{{-- resources/views/pelamar/profil/edit.blade.php --}}
@extends('layouts.dashboard_pelamar')
@section('title', 'Profil Pelamar')

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
            <div class="row">
                {{-- Sidebar profil ringkas --}}
                <div class="col-lg-4 col-md-5 mb-3">
                    <div class="emp_dashboard_sidebar jb_cover jb-card p-3">
                        @php
                            $user = auth()->user();
                            $pelamar = $pelamar ?? $user?->pelamar;

                            $avatar = asset('images/job1.jpg');
                            if ($user && $user->avatar_path) {
                                $avatar = asset('storage/' . ltrim($user->avatar_path, '/'));
                            }

                            $progress = $pelamar?->profile_progress ?? 0;
                        @endphp

                        <div class="text-center">
                            <img src="{{ $avatar }}" alt="profile" class="img-fluid"
                                style="width:110px;height:110px;border-radius:50%;object-fit:cover" id="avatarPreview">
                            <div class="mt-2">
                                <h4 class="mb-0">{{ $user->name }}</h4>
                                <div class="small-muted">{{ '@' . Str::slug($user->name, '-') }}</div>
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

                        <form action="{{ route('pelamar.profil.update') }}" method="POST" enctype="multipart/form-data"
                            class="row">
                            @csrf
                            @method('PUT')

                            {{-- NAMA LENGKAP --}}
                            <div class="col-12">
                                <div class="form-group icon_form comments_form">
                                    <input type="text" name="name"
                                        class="form-control @error('name') is-invalid @enderror" placeholder="Nama lengkap"
                                        value="{{ old('name', $user->name) }}">
                                    <i class="fas fa-user"></i>
                                </div>
                                @error('name')
                                    <div class="text-danger small">{{ $message }}</div>
                                @enderror
                            </div>

                            {{-- FOTO PROFIL --}}
                            <div class="col-12 mb-3">
                                <label class="small-muted mb-1 d-block">Foto Profil (JPG/PNG, maks 1MB)</label>

                                <div class="d-flex align-items-center flex-wrap">
                                    <label for="avatarInput" class="site-button outline mb-0">
                                        <i class="fas fa-camera"></i> Ganti Foto
                                    </label>

                                    <span id="avatarFileName" class="small-muted ml-2 mt-1 mt-sm-0">
                                        @if ($user->avatar_path)
                                            {{ basename($user->avatar_path) }}
                                        @else
                                            Belum ada file dipilih
                                        @endif
                                    </span>
                                </div>

                                <input type="file" name="avatar" id="avatarInput" accept="image/*" class="d-none">

                                @error('avatar')
                                    <div class="text-danger small mt-1">{{ $message }}</div>
                                @enderror
                            </div>

                            {{-- Tanggal lahir + Telepon --}}
                            <div class="col-md-6">
                                @php
                                    $tgl = $pelamar->tanggal_lahir ?? null;
                                    try {
                                        $tgl = $tgl ? \Illuminate\Support\Carbon::parse($tgl)->format('Y-m-d') : null;
                                    } catch (\Exception $e) {
                                        $tgl = null;
                                    }
                                    $hasTanggal = !empty(old('tanggal_lahir', $tgl));
                                @endphp
                                <div class="form-group icon_form comments_form">
                                    <input id="tanggal_lahir" type="{{ $hasTanggal ? 'date' : 'text' }}"
                                        name="tanggal_lahir"
                                        class="form-control @error('tanggal_lahir') is-invalid @enderror"
                                        value="{{ old('tanggal_lahir', $tgl) }}"
                                        placeholder="{{ $hasTanggal ? '' : 'Tanggal lahir (YYYY-MM-DD)' }}"
                                        onfocus="this.type='date';">
                                </div>
                                @error('tanggal_lahir')
                                    <div class="text-danger small">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6">
                                <div class="form-group icon_form comments_form">
                                    <input name="telepon" class="form-control @error('telepon') is-invalid @enderror"
                                        placeholder="Telepon" value="{{ old('telepon', optional($pelamar)->telepon) }}">
                                    <i class="fas fa-phone"></i>
                                </div>
                                @error('telepon')
                                    <div class="text-danger small">{{ $message }}</div>
                                @enderror
                            </div>

                            {{-- Alamat --}}
                            <div class="col-12">
                                <div class="form-group icon_form comments_form">
                                    <input name="alamat" class="form-control @error('alamat') is-invalid @enderror"
                                        placeholder="Alamat lengkap"
                                        value="{{ old('alamat', optional($pelamar)->alamat) }}">
                                    <i class="fas fa-map-marker-alt"></i>
                                </div>
                                @error('alamat')
                                    <div class="text-danger small">{{ $message }}</div>
                                @enderror
                            </div>

                            {{-- ======= RIWAYAT PENDIDIKAN (multi input) ======= --}}
                            @php
                                $pendidikanVal = $pelamar->pendidikan;
                                if (is_string($pendidikanVal) && $pendidikanVal !== '') {
                                    $dec = json_decode($pendidikanVal, true);
                                    $pendidikanVal = is_array($dec) ? $dec : preg_split("/\r\n|\n|\r/", $pendidikanVal);
                                }
                                $pendidikanList = old('pendidikan', is_array($pendidikanVal) ? $pendidikanVal : []);
                                if (!is_array($pendidikanList) || count($pendidikanList) === 0) {
                                    $pendidikanList = [''];
                                }
                            @endphp

                            <div class="col-md-6">
                                <label class="small-muted mb-1 d-block">Riwayat Pendidikan</label>
                                <div id="pendidikan-wrapper">
                                    @foreach ($pendidikanList as $idx => $pend)
                                        <div class="d-flex align-items-center pendidikan-row mb-2">
                                            <div class="form-group icon_form comments_form flex-grow-1 mb-0">
                                                <input type="text" name="pendidikan[]" class="form-control"
                                                    placeholder="2019 - S1 TI, Universitas X"
                                                    value="{{ $pend }}">
                                                <i class="fas fa-graduation-cap"></i>
                                            </div>
                                            <button type="button"
                                                class="btn btn-sm btn-outline-danger ml-2 btn-remove-row">
                                                <i class="fas fa-times"></i>
                                            </button>
                                        </div>
                                    @endforeach
                                </div>
                                <button type="button" id="btnAddPendidikan" class="site-button outline btn-sm mt-1">
                                    <i class="fas fa-plus"></i> Tambah Riwayat
                                </button>
                                @error('pendidikan.*')
                                    <div class="text-danger small">{{ $message }}</div>
                                @enderror
                            </div>

                            {{-- ======= KETERAMPILAN (multi input) ======= --}}
                            @php
                                $skillVal = $pelamar->keterampilan;
                                if (is_string($skillVal) && $skillVal !== '') {
                                    $dec = json_decode($skillVal, true);
                                    $skillVal = is_array($dec) ? $dec : preg_split("/\r\n|\n|\r/", $skillVal);
                                }
                                $skillList = old('keterampilan', is_array($skillVal) ? $skillVal : []);
                                if (!is_array($skillList) || count($skillList) === 0) {
                                    $skillList = [''];
                                }
                            @endphp

                            <div class="col-md-6">
                                <label class="small-muted mb-1 d-block">Keterampilan</label>
                                <div id="keterampilan-wrapper">
                                    @foreach ($skillList as $idx => $skill)
                                        <div class="d-flex align-items-center keterampilan-row mb-2">
                                            <div class="form-group icon_form comments_form flex-grow-1 mb-0">
                                                <input type="text" name="keterampilan[]" class="form-control"
                                                    placeholder="Laravel, React, SQL" value="{{ $skill }}">
                                                <i class="fas fa-tools"></i>
                                            </div>
                                            <button type="button"
                                                class="btn btn-sm btn-outline-danger ml-2 btn-remove-row">
                                                <i class="fas fa-times"></i>
                                            </button>
                                        </div>
                                    @endforeach
                                </div>
                                <button type="button" id="btnAddSkill" class="site-button outline btn-sm mt-1">
                                    <i class="fas fa-plus"></i> Tambah Skill
                                </button>
                                @error('keterampilan.*')
                                    <div class="text-danger small">{{ $message }}</div>
                                @enderror
                            </div>

                            {{-- ======= RIWAYAT PEKERJAAN (multi input) ======= --}}
                            @php
                                $workVal = $pelamar->riwayat_pekerjaan;
                                if (is_string($workVal) && $workVal !== '') {
                                    $dec = json_decode($workVal, true);
                                    $workVal = is_array($dec) ? $dec : preg_split("/\r\n|\n|\r/", $workVal);
                                }
                                $workList = old('riwayat_pekerjaan', is_array($workVal) ? $workVal : []);
                                if (!is_array($workList) || count($workList) === 0) {
                                    $workList = [''];
                                }
                            @endphp

                            <div class="col-12 mt-2">
                                <label class="small-muted mb-1 d-block">Riwayat Pekerjaan</label>
                                <div id="riwayat-wrapper">
                                    @foreach ($workList as $idx => $work)
                                        <div class="d-flex align-items-center riwayat-row mb-2">
                                            <div class="form-group icon_form comments_form flex-grow-1 mb-0">
                                                <input type="text" name="riwayat_pekerjaan[]" class="form-control"
                                                    placeholder="2021 - Web Developer, PT Contoh"
                                                    value="{{ $work }}">
                                                <i class="fas fa-briefcase"></i>
                                            </div>
                                            <button type="button"
                                                class="btn btn-sm btn-outline-danger ml-2 btn-remove-row">
                                                <i class="fas fa-times"></i>
                                            </button>
                                        </div>
                                    @endforeach
                                </div>
                                <button type="button" id="btnAddWork" class="site-button outline btn-sm mt-1">
                                    <i class="fas fa-plus"></i> Tambah Pengalaman
                                </button>
                                @error('riwayat_pekerjaan.*')
                                    <div class="text-danger small">{{ $message }}</div>
                                @enderror
                            </div>

                            {{-- CV Upload + Preview --}}
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

                                <input type="file" name="cv" id="cvInput" accept=".pdf,.doc,.docx">

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
        function initRepeatable(wrapperId, rowClass, addBtnId) {
            const wrapper = document.getElementById(wrapperId);
            const addBtn = document.getElementById(addBtnId);
            if (!wrapper || !addBtn) return;

            wrapper.addEventListener('click', function(e) {
                if (e.target.closest('.btn-remove-row')) {
                    const row = e.target.closest('.' + rowClass);
                    const rows = wrapper.querySelectorAll('.' + rowClass);
                    if (row && rows.length > 1) {
                        row.remove();
                    }
                }
            });

            addBtn.addEventListener('click', function() {
                const firstRow = wrapper.querySelector('.' + rowClass);
                if (!firstRow) return;
                const clone = firstRow.cloneNode(true);
                const input = clone.querySelector('input');
                if (input) input.value = '';
                wrapper.appendChild(clone);
            });
        }

        document.addEventListener('DOMContentLoaded', function() {
            // repeatable pendidikan, skill, riwayat kerja
            initRepeatable('pendidikan-wrapper', 'pendidikan-row', 'btnAddPendidikan');
            initRepeatable('keterampilan-wrapper', 'keterampilan-row', 'btnAddSkill');
            initRepeatable('riwayat-wrapper', 'riwayat-row', 'btnAddWork');

            // CV preview
            const input = document.getElementById('cvInput');
            const frame = document.getElementById('cvFrame');
            const preview = document.getElementById('cv-preview');
            const btnView = document.getElementById('btnViewFull');

            input && input.addEventListener('change', function() {
                const file = this.files && this.files[0] ? this.files[0] : null;
                if (!file) return;

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
                    if (frame) frame.style.display = 'none';
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

            // avatar preview + validasi ukuran pakai SweetAlert
            const avatarInput = document.getElementById('avatarInput');
            const avatarPreview = document.getElementById('avatarPreview');
            const avatarFileName = document.getElementById('avatarFileName');

            if (avatarInput) {
                avatarInput.addEventListener('change', function() {
                    const file = this.files && this.files[0] ? this.files[0] : null;
                    if (!file) return;

                    const maxSize = 1 * 1024 * 1024; // 1MB
                    if (file.size > maxSize) {
                        if (window.Swal) {
                            Swal.fire({
                                icon: 'error',
                                title: 'Ukuran terlalu besar',
                                text: 'Ukuran foto maksimal 1MB.',
                                confirmButtonColor: '#e11d48'
                            });
                        } else {
                            alert('Ukuran foto maksimal 1MB.');
                        }
                        this.value = '';
                        if (avatarFileName) avatarFileName.textContent = 'Belum ada file dipilih';
                        return;
                    }

                    if (avatarFileName) avatarFileName.textContent = file.name;
                    if (avatarPreview) avatarPreview.src = URL.createObjectURL(file);
                });
            }
        });
    </script>
@endpush
