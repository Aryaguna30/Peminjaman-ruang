@extends('layouts.app')

@section('title', 'Laporan')

@section('content')
    <div class="row mb-4">
        <div class="col-md-12">
            <h2 style="color: #0066cc; font-weight: 700;">
                <i class="fas fa-file-pdf"></i> Laporan & Export
            </h2>
        </div>
    </div>

    <div class="row">
        <!-- Laporan Peminjam -->
        <div class="col-md-6">
            <div class="card">
                <div class="card-header" style="background-color: #0066cc; color: white;">
                    <h5 class="mb-0"><i class="fas fa-handshake"></i> Laporan Peminjam</h5>
                </div>
                <div class="card-body">
                    <p class="text-muted">Export data peminjam ruangan ke format PDF atau Excel</p>
                    <div class="d-flex gap-2">
                        <a href="{{ route('reports.borrowers-pdf') }}" class="btn btn-danger flex-grow-1" target="_blank">
                            <i class="fas fa-file-pdf"></i> Export PDF
                        </a>
                        <a href="{{ route('reports.borrowers-excel') }}" class="btn btn-success flex-grow-1">
                            <i class="fas fa-file-excel"></i> Export Excel
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Laporan Jadwal -->
        <div class="col-md-6">
            <div class="card">
                <div class="card-header" style="background-color: #0066cc; color: white;">
                    <h5 class="mb-0"><i class="fas fa-calendar"></i> Laporan Jadwal</h5>
                </div>
                <div class="card-body">
                    <p class="text-muted">Export data jadwal pembelajaran ke format PDF atau Excel</p>
                    <div class="d-flex gap-2">
                        <a href="{{ route('reports.schedules-pdf') }}" class="btn btn-danger flex-grow-1" target="_blank">
                            <i class="fas fa-file-pdf"></i> Export PDF
                        </a>
                        <a href="{{ route('reports.schedules-excel') }}" class="btn btn-success flex-grow-1">
                            <i class="fas fa-file-excel"></i> Export Excel
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
