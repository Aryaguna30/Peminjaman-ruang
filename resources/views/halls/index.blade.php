@extends('layouts.app')

@section('content')
<div class="container-fluid py-4">
    <div class="row mb-4">
        <div class="col-md-8">
            <h2 class="mb-0" style="color: #0066cc;">
                <i class="fas fa-building"></i> Manajemen Aula
            </h2>
        </div>
        <div class="col-md-4 text-end">
            @if(auth()->user()->role === 'sarpras' || auth()->user()->role === 'admin')
            <a href="{{ route('halls.create') }}" class="btn btn-primary">
                <i class="fas fa-plus"></i> Tambah Aula
            </a>
            @endif
        </div>
    </div>

    @if($message = Session::get('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ $message }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
    @endif

    <div class="card shadow-sm">
        <div class="table-responsive">
            <table class="table table-hover mb-0">
                <thead style="background: linear-gradient(135deg, #0066cc 0%, #004499 100%); color: white;">
                    <tr>
                        <th>Nama Aula</th>
                        <th>Kapasitas</th>
                        <th>Lokasi</th>
                        <th>Deskripsi</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($halls as $hall)
                    <tr>
                        <td><strong>{{ $hall->name }}</strong></td>
                        <td>{{ $hall->capacity }} orang</td>
                        <td>{{ $hall->location }}</td>
                        <td>{{ Str::limit($hall->description, 50) }}</td>
                        <td>
                            @if($hall->is_available)
                            <span class="badge bg-success">Tersedia</span>
                            @else
                            <span class="badge bg-danger">Tidak Tersedia</span>
                            @endif
                        </td>
                        <td>
                            @if(auth()->user()->role === 'sarpras' || auth()->user()->role === 'admin')
                            <a href="{{ route('halls.edit', $hall) }}" class="btn btn-sm btn-warning">
                                <i class="fas fa-edit"></i>
                            </a>
                            <form action="{{ route('halls.destroy', $hall) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Yakin ingin menghapus?')">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </form>
                            @endif
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="text-center py-4">Tidak ada data aula</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
