@extends('layouts.app')

@section('title', 'Kelola Peminjam')

@section('content')
    <div class="row mb-4">
        <div class="col-md-8">
            <h2 style="color: #0066cc; font-weight: 700;">
                <i class="fas fa-handshake"></i> Kelola Peminjam Ruangan
            </h2>
        </div>
        <div class="col-md-4 text-end">
            <a href="/borrowers/create" class="btn btn-primary">
                <i class="fas fa-plus"></i> Tambah Peminjam
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
                            <th>Nama Peminjam</th>
                            <th>Ruangan</th>
                            <th>Tanggal Peminjaman</th>
                            <th>Durasi</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($borrowers as $borrower)
                            <tr>
                                <td>{{ ($borrowers->currentPage() - 1) * $borrowers->perPage() + $loop->iteration }}</td>
                                <td><strong>{{ $borrower->name }}</strong></td>
                                <td>{{ $borrower->room->name }}</td>
                                <td>{{ \Carbon\Carbon::parse($borrower->borrow_date)->format('d/m/Y') }}</td>
                                <td>
                                    {{ \Carbon\Carbon::parse($borrower->borrow_date . ' ' . $borrower->borrow_time)->diffInHours(\Carbon\Carbon::parse($borrower->return_date . ' ' . $borrower->return_time)) }} jam
                                </td>
                                <td>
                                    @if($borrower->status == 'pending')
                                        <span class="badge badge-pending">Pending</span>
                                    @elseif($borrower->status == 'approved')
                                        <span class="badge badge-approved">Disetujui</span>
                                    @elseif($borrower->status == 'rejected')
                                        <span class="badge badge-rejected">Ditolak</span>
                                    @else
                                        <span class="badge badge-completed">Selesai</span>
                                    @endif
                                </td>
                                <td>
                                    <a href="/borrowers/{{ $borrower->id }}/edit" class="btn btn-sm btn-warning">
                                        <i class="fas fa-edit"></i>
                                    </a>
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
                                    <form action="/borrowers/{{ $borrower->id }}" method="POST" style="display: inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Yakin ingin menghapus?')">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center text-muted">Tidak ada data peminjam</td>
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