@extends('layouts.app')

@section('title', 'Kelola Ruangan')

@section('content')
    <div class="row mb-4">
        <div class="col-md-8">
            <h2 style="color: #0066cc; font-weight: 700;">
                <i class="fas fa-door-open"></i> Kelola Ruangan
            </h2>
        </div>
        <div class="col-md-4 text-end">
            <a href="/rooms/create" class="btn btn-primary">
                <i class="fas fa-plus"></i> Tambah Ruangan
            </a>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Ruangan</th>
                            <th>Kategori</th>
                            <th>Kapasitas</th>
                            <th>Deskripsi</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($rooms as $room)
                            <tr>
                                <td>{{ ($rooms->currentPage() - 1) * $rooms->perPage() + $loop->iteration }}</td>
                                <td><strong>{{ $room->name }}</strong></td>
                                <td>{{ $room->category->name }}</td>
                                <td>{{ $room->capacity }} orang</td>
                                <td>{{ Str::limit($room->description, 50) }}</td>
                                <td>
                                    <a href="/rooms/{{ $room->id }}/edit" class="btn btn-sm btn-warning">
                                        <i class="fas fa-edit"></i> Edit
                                    </a>
                                    <form action="/rooms/{{ $room->id }}" method="POST" style="display: inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Yakin ingin menghapus?')">
                                            <i class="fas fa-trash"></i> Hapus
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center text-muted">Tidak ada data ruangan</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            <div class="d-flex justify-content-center mt-4">
                {{ $rooms->links('pagination::bootstrap-5') }}
            </div>
        </div>
    </div>
@endsection