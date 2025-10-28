@extends('layouts.app')

@section('content')
<div class="container-fluid py-4">
    <div class="row mb-4">
        <div class="col-md-8">
            <h2 style="color: #0066cc;">
                <i class="fas fa-file-alt"></i> Detail Riwayat Peminjaman
            </h2>
        </div>
        <div class="col-md-4 text-end">
            <a href="{{ route('history.index') }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left"></i> Kembali
            </a>
        </div>
    </div>

    <div class="card shadow-sm">
        <div class="card-body">
            <div class="row mb-4">
                <div class="col-md-6">
                    <h5 style="color: #0066cc;">Informasi Peminjam</h5>
                    <p><strong>Nama:</strong> {{ $borrower->user->name }}</p>
                    <p><strong>Telepon:</strong> {{ $borrower->user->phone }}</p>
                    <p><strong>Kelas:</strong> {{ $borrower->class_name }}</p>
                </div>
                <div class="col-md-6">
                    <h5 style="color: #0066cc;">Informasi Ruangan</h5>
                    <p><strong>Ruangan:</strong> {{ $borrower->room->name }}</p>
                    <p><strong>Kapasitas:</strong> {{ $borrower->room->capacity }} orang</p>
                    <p><strong>Lokasi:</strong> {{ $borrower->room->location }}</p>
                </div>
            </div>

            <hr>

            <div class="row mb-4">
                <div class="col-md-6">
                    <h5 style="color: #0066cc;">Jadwal Peminjaman</h5>
                    <p><strong>Tanggal Peminjaman:</strong> {{ \Carbon\Carbon::parse($borrower->borrow_date)->format('d/m/Y H:i') }}</p>
                    <p><strong>Tanggal Pengembalian:</strong> {{ \Carbon\Carbon::parse($borrower->return_date)->format('d/m/Y H:i') }}</p>
                </div>
                <div class="col-md-6">
                    <h5 style="color: #0066cc;">Status</h5>
                    <p>
                        <strong>Status Peminjaman:</strong>
                        @if($borrower->status === 'approved')
                        <span class="badge bg-success">Disetujui</span>
                        @elseif($borrower->status === 'rejected')
                        <span class="badge bg-danger">Ditolak</span>
                        @else
                        <span class="badge bg-warning">{{ ucfirst($borrower->status) }}</span>
                        @endif
                    </p>
                </div>
            </div>

            <hr>

            <div class="mb-4">
                <h5 style="color: #0066cc;">Keperluan</h5>
                <p>{{ $borrower->purpose }}</p>
            </div>

            @if($borrower->notes)
            <div class="mb-4">
                <h5 style="color: #0066cc;">Catatan</h5>
                <p>{{ $borrower->notes }}</p>
            </div>
            @endif
        </div>
    </div>
</div>
@endsection
