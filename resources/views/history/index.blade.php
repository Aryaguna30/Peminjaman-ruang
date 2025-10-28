@extends('layouts.app')

@section('content')
<div class="container-fluid py-4">
    <div class="row mb-4">
        <div class="col-md-12">
            <h2 style="color: #0066cc;">
                <i class="fas fa-history"></i> Riwayat Peminjaman
            </h2>
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
                        <th>Peminjam</th>
                        <th>Ruangan</th>
                        <th>Kelas</th>
                        <th>Tanggal Peminjaman</th>
                        <th>Tanggal Pengembalian</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($history as $item)
                    <tr>
                        <td><strong>{{ $item->user->name }}</strong></td>
                        <td>{{ $item->room->name ?? '-' }}</td>
                        <td>{{ $item->class_name ?? '-' }}</td>
                        <td>{{ \Carbon\Carbon::parse($item->borrow_date)->format('d/m/Y H:i') }}</td>
                        <td>{{ \Carbon\Carbon::parse($item->return_date)->format('d/m/Y H:i') }}</td>
                        <td>
                            @if($item->status === 'approved')
                            <span class="badge bg-success">Disetujui</span>
                            @elseif($item->status === 'rejected')
                            <span class="badge bg-danger">Ditolak</span>
                            @else
                            <span class="badge bg-warning">{{ ucfirst($item->status) }}</span>
                            @endif
                        </td>
                        <td>
                            <a href="{{ route('history.show', $item) }}" class="btn btn-sm btn-info">
                                <i class="fas fa-eye"></i> Detail
                            </a>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="text-center py-4">Tidak ada riwayat peminjaman</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="card-footer">
            {{ $history->links() }}
        </div>
    </div>
</div>
@endsection
