{{-- resources/views/perusahaan/lowongan/edit.blade.php --}}
@extends('layouts.dashboard_perusahaan')
@section('title', 'Edit Lowongan')

@section('content')
    {{-- HEADER (breadcrumb template) --}}
    <div class="page_title_section">
        <div class="page_header">
            <div class="container">
                <div class="row">
                    <div class="col-lg-9 col-md-8 col-12">
                        <h1>Edit Lowongan</h1>
                        <div class="small-muted">Perbarui informasi lowongan kerja Anda.</div>
                    </div>
                    <div class="col-lg-3 col-md-4 col-12">
                        <div class="sub_title_section">
                            <ul class="sub_title">
                                <li><a href="{{ url('/dashboard') }}">Home</a>&nbsp;/&nbsp;</li>
                                <li><a href="{{ route('perusahaan.lowongan.index') }}">Kelola Lowongan</a>&nbsp;/&nbsp;</li>
                                <li>Edit Lowongan</li>
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
            @if (session('ok'))
                <div class="alert alert-success">{{ session('ok') }}</div>
            @endif
            @if (session('err'))
                <div class="alert alert-danger">{{ session('err') }}</div>
            @endif

            <div class="jb-card">
                <div class="jb-hd">Ubah Detail Lowongan</div>
                <div class="jb-body">
                    @include('perusahaan.lowongan._form', [
                        'action' => route('perusahaan.lowongan.update', $lowongan),
                        'method' => 'PUT',
                        'model' => $lowongan, // dipakai di _form untuk isi awal + keahlian
                    ])
                </div>
            </div>
        </div>
    </div>
@endsection
