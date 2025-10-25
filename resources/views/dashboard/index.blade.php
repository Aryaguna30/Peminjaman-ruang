@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
    <div class="row mb-4">
        <div class="col-md-12">
            <h2 style="color: #0066cc; font-weight: 700;">
                <i class="fas fa-chart-line"></i> Dashboard
            </h2>
            <p style="color: #666;">Selamat datang, <strong>{{ Auth::user()->name }}</strong>!</p>
        </div>
    </div>

    <!-- Statistics Cards -->
    <div class="row mb-4">
        <div class="col-md-3 mb-3">
            <div class="stat-card">
                <i class="fas fa-door-open" style="font-size: 2rem;"></i>
                <h3>{{ $totalRooms }}</h3>
                <p>Total Ruangan</p>
            </div>
        </div>

        <div class="col-md-3 mb-3">
            <div class="stat-card">
                <i class="fas fa-handshake" style="font-size: 2rem;"></i>
                <h3>{{ $totalBorrowers }}</h3>
                <p>Total Peminjam</p>
            </div>
        </div>

        <div class="col-md-3 mb-3">
            <div class="stat-card">
                <i class="fas fa-clock" style="font-size: 2rem;"></i>
                <h3>{{ $pendingBorrowers }}</h3>
                <p>Peminjaman Pending</p>
            </div>
        </div>

        <div class="col-md-3 mb-3">
            <div class="stat-card">
                <i class="fas fa-users" style="font-size: 2rem;"></i>
                <h3>{{ $totalUsers }}</h3>
                <p>Total User</p>
            </div>
        </div>
    </div>

    <!-- Quick Actions -->
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <i class="fas fa-bolt"></i> Aksi Cepat
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-3 mb-2">
                            <a href="/rooms" class="btn btn-primary w-100">
                                <i class="fas fa-door-open"></i> Kelola Ruangan
                            </a>
                        </div>
                        <div class="col-md-3 mb-2">
                            <a href="/borrowers" class="btn btn-primary w-100">
                                <i class="fas fa-handshake"></i> Kelola Peminjam
                            </a>
                        </div>
                        @if(Auth::user()->isAdmin() || Auth::user()->isToolman())
                            <div class="col-md-3 mb-2">
                                <a href="/schedules" class="btn btn-primary w-100">
                                    <i class="fas fa-calendar-alt"></i> Kelola Jadwal
                                </a>
                            </div>
                        @endif
                        @if(Auth::user()->isAdmin())
                            <div class="col-md-3 mb-2">
                                <a href="/users" class="btn btn-primary w-100">
                                    <i class="fas fa-users"></i> Kelola User
                                </a>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection