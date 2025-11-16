@extends('layouts.app')
@section('title', 'Lowongan Saya')

@section('content')
    <h4 class="mb-3">Lowongan Saya</h4>

    <div class="d-flex gap-2 mb-3">
        <a href="{{ route('jobs.create') }}" class="btn btn-primary">Buat Lowongan</a>
    </div>

    <div class="table-responsive">
        <table class="table align-middle">
            <thead>
                <tr>
                    <th>Judul</th>
                    <th>Status</th>
                    <th>Deadline</th>
                    <th>Dibuat</th>
                </tr>
            </thead>
            <tbody>
                @forelse($lowongans as $l)
                    <tr>
                        <td class="fw-semibold">{{ $l->judul }}</td>
                        <td>
                            <span
                                class="badge bg-{{ $l->status === 'published' ? 'success' : ($l->status === 'pending' ? 'warning text-dark' : ($l->status === 'draft' ? 'secondary' : 'dark')) }}">
                                {{ $l->status }}
                            </span>
                        </td>
                        <td>{{ $l->deadline ? \Illuminate\Support\Carbon::parse($l->deadline)->format('d M Y') : '—' }}</td>
                        <td>{{ $l->created_at->format('d M Y') }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="text-center text-muted">Belum ada lowongan.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    {{ $lowongans->links() }}
@endsection
