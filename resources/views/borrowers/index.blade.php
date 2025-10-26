@extends('layouts.app')

@section('title', 'Kelola Peminjam')

@section('content')
    <div class="row mb-4">
        <div class="col-md-8">
            <h2 style="color: #0066cc; font-weight: 700;">
                <i class="fas fa-users"></i> Kelola Peminjam Ruangan
            </h2>
        </div>
        <div class="col-md-4 text-end">
            <a href="/borrowers/create" class="btn btn-primary">
                <i class="fas fa-plus"></i> Tambah Peminjam
            </a>
        </div>
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr style="background-color: #0066cc; color: white;">
                            <th>No</th>
                            <th>Nama Peminjam</th>
                            <th>Telepon</th>
                            <th>Kelas</th>
                            <th>Ruangan</th>
                            <th>Keperluan</th>
                            <th>Tanggal Peminjaman</th>
                            <th>Jam</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($borrowers as $borrower)
                            <tr>
                                <td>{{ ($borrowers->currentPage() - 1) * $borrowers->perPage() + $loop->iteration }}</td>
                                <td><strong>{{ $borrower->name }}</strong></td>
                                <td>{{ $borrower->phone ?? '-' }}</td>
                                <td>
                                    @if($borrower->class_name)
                                        <span class="badge bg-info">{{ $borrower->class_name }}</span>
                                    @else
                                        <span class="text-muted">-</span>
                                    @endif
                                </td>
                                <td>{{ $borrower->room->name }}</td>
                                <td>{{ Str::limit($borrower->purpose, 30) }}</td>
                                <td>{{ $borrower->borrow_date->format('d/m/Y') }}</td>
                                <td>{{ $borrower->borrow_time }} - {{ $borrower->return_time }}</td>
                                <td>
                                    @if($borrower->status == 'pending')
                                        <span class="badge bg-warning">Pending</span>
                                    @elseif($borrower->status == 'approved')
                                        <span class="badge bg-success">Disetujui</span>
                                    @elseif($borrower->status == 'rejected')
                                        <span class="badge bg-danger">Ditolak</span>
                                    @else
                                        <span class="badge bg-secondary">Selesai</span>
                                    @endif
                                </td>
                                <td>
                                    @if($borrower->status == 'pending')
                                        <form action="/borrowers/{{ $borrower->id }}/approve" method="POST" style="display: inline;">
                                            @csrf
                                            <button type="submit" class="btn btn-sm btn-success" title="Setujui">
                                                <i class="fas fa-check"></i>
                                            </button>
                                        </form>
                                        <form action="/borrowers/{{ $borrower->id }}/reject" method="POST" style="display: inline;">
                                            @csrf
                                            <button type="submit" class="btn btn-sm btn-danger" title="Tolak">
                                                <i class="fas fa-times"></i>
                                            </button>
                                        </form>
                                    @endif
                                    <a href="/borrowers/{{ $borrower->id }}/edit" class="btn btn-sm btn-warning" title="Edit">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form action="/borrowers/{{ $borrower->id }}" method="POST" style="display: inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Yakin ingin menghapus?')" title="Hapus">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="10" class="text-center text-muted">Tidak ada data peminjam</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            <div class="d-flex justify-content-center mt-4">
                {{ $borrowers->links('pagination::bootstrap-5') }}
            </div>
        </div>
    </div>
@endsection
