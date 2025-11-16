@extends('layouts.dashboard_pelamar')
@section('title', $lowongan->judul)

@section('content')
<div class="page-sticky"><div class="page-body"><!-- wrapper agar footer nempel bawah -->

    {{-- PAGE TITLE / BREADCRUMB --}}
    <div class="page_title_section">
        <div class="page_header">
            <div class="container">
                <div class="row">
                    <div class="col-lg-9 col-md-9 col-12 col-sm-8"><h1>Job Detail</h1></div>
                    <div class="col-lg-3 col-md-3 col-12 col-sm-4">
                        <div class="sub_title_section">
                            <ul class="sub_title">
                                <li><a href="{{ url('/') }}">Home</a>&nbsp;/&nbsp;</li>
                                <li>Job Detail</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- CONTENT --}}
    <div class="job_filter_listing_wrapper jb_cover">
        <div class="container">
            <div class="row g-3">
                {{-- LEFT --}}
                <div class="col-lg-8">
                    {{-- Header card --}}
                    <div class="jb-card">
                        <div class="d-flex align-items-start justify-content-between">
                            <div class="d-flex align-items-center gap-3">
                                @php
                                    $company = $lowongan->perusahaan;
                                    $logo = $company?->logo_url ?? $company?->logo ?? null;
                                    if ($logo && !\Illuminate\Support\Str::startsWith($logo, ['http://', 'https://'])) {
                                        $logo = (\Illuminate\Support\Facades\Storage::disk('public')->exists($logo))
                                            ? asset('storage/' . $logo)
                                            : (file_exists(public_path($logo)) ? asset($logo) : asset('images/job1.jpg'));
                                    }
                                    $logo = $logo ?: asset('images/job1.jpg');
                                @endphp
                                <img src="{{ $logo }}" alt="logo" class="rounded jb-logo">
                                <div>
                                    <h3 class="mb-1 fw-800">{{ $lowongan->judul }}</h3>
                                    <div class="text-muted small">
                                        {{ $company->nama_perusahaan ?? '-' }}
                                        @if ($lowongan->lokasi)
                                            &nbsp;•&nbsp;<i class="flaticon-location-pointer"></i> {{ $lowongan->lokasi }}
                                        @endif
                                    </div>
                                </div>
                            </div>

                            {{-- <span class="badge jb-pill
                                @switch($lowongan->status)
                                    @case('published') bg-success @break
                                    @case('pending') bg-warning text-dark @break
                                    @case('closed') bg-dark @break
                                    @default bg-secondary
                                @endswitch">
                                {{ ucfirst($lowongan->status) }}
                            </span> --}}
                        </div>

                        @if ($alreadyApplied)
                            <div class="alert alert-success mt-3 mb-0">
                                <div class="fw-semibold mb-1">Kamu sudah melamar lowongan ini.</div>
                                @if ($myLamaran)
                                    Status lamaran:
                                    <span class="">{{ $myLamaran->status }}</span>
                                    <span class="text-muted ms-2">pada {{ $myLamaran->created_at->format('d M Y H:i') }}</span>
                                @endif
                            </div>
                        @endif
                    </div>

                    {{-- Deskripsi --}}
                    <div class="jb-card">
                        <div class="jb-hd"><h1>Deskripsi Pekerjaan</h1></div>
                        <div class="pt-2">{!! nl2br(e($lowongan->deskripsi)) !!}</div>
                    </div>

                    {{-- Kualifikasi --}}
                    @if ($lowongan->kualifikasi)
                        <div class="jb-card">
                            <div class="jb-hd"><h1>Kualifikasi</h1></div>
                            <div class="pt-2">{!! nl2br(e($lowongan->kualifikasi)) !!}</div>
                        </div>
                    @endif
                </div>

                {{-- RIGHT --}}
                <div class="col-lg-4">
                    {{-- Info Lowongan --}}
                    <div class="jb-card">
                        <div class="jb-hd"><h1>Info Lowongan</h1></div>

                        <div class="jb-info-list">
                            <div class="item">
                                <div class="ico"><i class="far fa-building"></i></div>
                                <div class="txt">
                                    <div class="label">Perusahaan</div>
                                    <div class="value">{{ $company->nama_perusahaan ?? '—' }}</div>
                                </div>
                            </div>
                            <div class="item">
                                <div class="ico"><i class="flaticon-location-pointer"></i></div>
                                <div class="txt">
                                    <div class="label">Lokasi</div>
                                    <div class="value">{{ $lowongan->lokasi ?? '—' }}</div>
                                </div>
                            </div>
                            <div class="item">
                                <div class="ico"><i class="far fa-building"></i></div>
                                <div class="txt">
                                    <div class="label">Tipe</div>
                                    <div class="value"><span class="">{{ $lowongan->tipe_pekerjaan ?? '—' }}</span></div>
                                </div>
                            </div>
                            <div class="item">
                                <div class="ico"><i class="far fa-calendar-plus"></i></div>
                                <div class="txt">
                                    <div class="label">Dibuat</div>
                                    <div class="value">{{ $lowongan->created_at->format('d M Y') }}</div>
                                </div>
                            </div>
                            <div class="item">
                                <div class="ico"><i class="far fa-calendar-times"></i></div>
                                <div class="txt">
                                    <div class="label">Deadline</div>
                                    <div class="value">{{ $lowongan->deadline ? \Illuminate\Support\Carbon::parse($lowongan->deadline)->format('d M Y') : '—' }}</div>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Lamar --}}
                    <div class="jb-card">
                        <div class="jb-hd"><h1>Lamar Pekerjaan</h1></div>
                        <div class="pt-2">
                            @auth
                                @if (auth()->user()->isPelamar())
                                    @if ($alreadyApplied)
                                        <button class="btn btn-success w-100" disabled>Sudah Mengirim Lamaran</button>
                                    @elseif($lowongan->status !== 'published')
                                        <button class="btn btn-outline-secondary w-100" disabled>Lowongan belum dipublikasikan</button>
                                    @else
                                        <button
                                            class="btn btn-purple w-100"
                                            data-bs-toggle="modal" data-bs-target="#applyModal"
                                            data-toggle="modal"    data-target="#applyModal">
                                            Lamar Sekarang
                                        </button>
                                    @endif
                                @else
                                    <div class="text-muted">Akun kamu bukan Pelamar.</div>
                                @endif
                            @else
                                <a class="btn btn-outline-purple w-100" href="{{ route('login') }}">Masuk untuk melamar</a>
                            @endauth
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div></div><!-- /page-sticky -->
    {{-- MODAL APPLY --}}
    @auth
    @if (auth()->user()->isPelamar() && !$alreadyApplied && $lowongan->status === 'published')
        <div class="modal fade apply_job_popup" id="applyModal" role="dialog" aria-hidden="true" tabindex="-1">
            <div class="modal-dialog">
                <div class="modal-content">
                    <button type="button" class="close" data-dismiss="modal" data-bs-dismiss="modal">&times;</button>
                    <div class="row">
                        <div class="col-12">
                            <div class="apply_job jb_cover">
                                <h1>Apply For This Job :</h1>
                                <div class="search_alert_box jb_cover">
                                    <form action="{{ route('lamaran.store', $lowongan) }}" method="POST" enctype="multipart/form-data">
                                        @csrf
                                        <div class="apply_job_form">
                                            <input type="text" name="nama_lengkap" placeholder="Full Name"
                                                   value="{{ old('nama_lengkap', auth()->user()->name ?? '') }}" required>
                                        </div>
                                        <div class="apply_job_form">
                                            <input type="email" name="email" placeholder="Enter Your Email"
                                                   value="{{ old('email', auth()->user()->email ?? '') }}" required>
                                        </div>
                                        <div class="apply_job_form">
                                            <textarea class="form-control" name="cover_letter" placeholder="Message">{{ old('cover_letter') }}</textarea>
                                        </div>

                                        <div class="resume_optional jb_cover">
                                            <p>Resume (Optional)</p>
                                            <div class="width_50">
                                                <input type="file" name="file_cv" class="dropify" data-height="90"
                                                       data-allowed-file-extensions="pdf doc docx" data-max-file-size="5M" />
                                                <span class="post_photo">upload Resume</span>
                                            </div>
                                            <p class="word_file">Microsoft Word or PDF file only (5mb)</p>
                                        </div>

                                        <div class="header_btn search_btn applt_pop_btn jb_cover">
                                            <button type="submit" class="btn btn-purple w-100">Apply Now</button>
                                        </div>
                                    </form>
                                </div>
                                <div class="small text-muted mt-2">Kosongkan CV bila ingin memakai CV dari profilmu.</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif
    @endauth
@endsection

@push('styles')
<style>
    
</style>
@endpush

@push('scripts')
{{-- IMPORTANT: pastikan ada Bootstrap BUNDLE (dengan Popper). Tambahkan ini walau layout sudah memuat bootstrap.min.js --}}
<script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>

<script>
(function(){
    // Pindahkan modal ke <body> agar tidak ter-clipped
    $(document).on('show.bs.modal', '.apply_job_popup', function(){ $(this).appendTo('body'); });

    // Inisialisasi Dropify saat modal tampil
    $(document).on('shown.bs.modal', '.apply_job_popup', function(){
        $(this).find('.dropify').dropify({
            messages:{default:'Tarik & letakkan berkas atau klik',replace:'Ganti berkas',remove:'Hapus',error:'Format/ukuran tidak didukung'}
        });
    });

    // Fallback pemicu untuk BS4/BS5 (kedua atribut diset di tombol)
    $(document).on('click','[data-target],[data-bs-target]',function(e){
        var sel=$(this).attr('data-bs-target')||$(this).attr('data-target');
        if(!sel) return;
        var $m=$(sel); if(!$m.length) return;
        // Coba API BS4/BS5
        try{
            if ($.fn.modal) { $m.modal('show'); }
            else if (window.bootstrap && bootstrap.Modal) { new bootstrap.Modal($m[0]).show(); }
        }catch(_){}
        e.preventDefault();
    });
})();
</script>
@endpush
