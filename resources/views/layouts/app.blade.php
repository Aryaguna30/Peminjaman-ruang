<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Ruang Nekat') - SMKN 1 Katapang</title>
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <!-- Custom CSS -->
    <style>
        :root {
            --primary-blue: #0066cc;
            --light-blue: #e6f2ff;
            --dark-blue: #004499;
            --white: #ffffff;
            --gray-light: #f8f9fa;
            --gray-dark: #6c757d;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: var(--gray-light);
            color: #333;
        }

        /* Navbar */
        .navbar {
            background: linear-gradient(135deg, var(--primary-blue) 0%, var(--dark-blue) 100%);
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .navbar-brand {
            font-weight: 700;
            font-size: 1.5rem;
            color: var(--white) !important;
        }

        .navbar-brand i {
            margin-right: 8px;
        }

        .nav-link {
            color: rgba(255, 255, 255, 0.8) !important;
            transition: color 0.3s ease;
        }

        .nav-link:hover {
            color: var(--white) !important;
        }

        /* Sidebar */
        .sidebar {
            background: var(--white);
            border-right: 1px solid #e0e0e0;
            min-height: calc(100vh - 56px);
            padding: 20px 0;
        }

        .sidebar .nav-link {
            color: #333 !important;
            padding: 12px 20px;
            border-left: 3px solid transparent;
            transition: all 0.3s ease;
        }

        .sidebar .nav-link:hover {
            background-color: var(--light-blue);
            border-left-color: var(--primary-blue);
            color: var(--primary-blue) !important;
        }

        .sidebar .nav-link.active {
            background-color: var(--light-blue);
            border-left-color: var(--primary-blue);
            color: var(--primary-blue) !important;
            font-weight: 600;
        }

        .sidebar .nav-link i {
            margin-right: 10px;
            width: 20px;
        }

        /* Main Content */
        .main-content {
            padding: 30px;
        }

        /* Card */
        .card {
            border: none;
            border-radius: 8px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .card:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.12);
        }

        .card-header {
            background: linear-gradient(135deg, var(--primary-blue) 0%, var(--dark-blue) 100%);
            color: var(--white);
            border: none;
            border-radius: 8px 8px 0 0;
            font-weight: 600;
        }

        /* Buttons */
        .btn-primary {
            background-color: var(--primary-blue);
            border-color: var(--primary-blue);
            transition: all 0.3s ease;
        }

        .btn-primary:hover {
            background-color: var(--dark-blue);
            border-color: var(--dark-blue);
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(0, 102, 204, 0.3);
        }

        .btn-sm {
            padding: 6px 12px;
            font-size: 0.875rem;
        }

        /* Table */
        .table {
            background-color: var(--white);
        }

        .table thead th {
            background-color: var(--light-blue);
            color: var(--primary-blue);
            font-weight: 600;
            border: none;
            padding: 15px;
        }

        .table tbody td {
            padding: 12px 15px;
            vertical-align: middle;
            border-color: #e0e0e0;
        }

        .table tbody tr:hover {
            background-color: var(--gray-light);
        }

        /* Alert */
        .alert {
            border: none;
            border-radius: 8px;
        }

        .alert-success {
            background-color: #d4edda;
            color: #155724;
        }

        .alert-danger {
            background-color: #f8d7da;
            color: #721c24;
        }

        .alert-warning {
            background-color: #fff3cd;
            color: #856404;
        }

        /* Form */
        .form-control, .form-select {
            border: 1px solid #ddd;
            border-radius: 6px;
            padding: 10px 12px;
            transition: border-color 0.3s ease;
        }

        .form-control:focus, .form-select:focus {
            border-color: var(--primary-blue);
            box-shadow: 0 0 0 0.2rem rgba(0, 102, 204, 0.25);
        }

        .form-label {
            font-weight: 600;
            color: #333;
            margin-bottom: 8px;
        }

        /* Badge */
        .badge {
            padding: 6px 12px;
            border-radius: 20px;
            font-weight: 500;
        }

        .badge-pending {
            background-color: #ffc107;
            color: #000;
        }

        .badge-approved {
            background-color: #28a745;
            color: #fff;
        }

        .badge-rejected {
            background-color: #dc3545;
            color: #fff;
        }

        .badge-completed {
            background-color: #17a2b8;
            color: #fff;
        }

        /* Stats Card */
        .stat-card {
            background: linear-gradient(135deg, var(--primary-blue) 0%, var(--dark-blue) 100%);
            color: var(--white);
            border-radius: 8px;
            padding: 20px;
            text-align: center;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
        }

        .stat-card h3 {
            font-size: 2rem;
            font-weight: 700;
            margin: 10px 0;
        }

        .stat-card p {
            font-size: 0.9rem;
            opacity: 0.9;
        }

        /* Footer */
        footer {
            background-color: var(--primary-blue);
            color: var(--white);
            text-align: center;
            padding: 20px;
            margin-top: 40px;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .sidebar {
                display: none;
            }

            .main-content {
                padding: 15px;
            }

            .stat-card h3 {
                font-size: 1.5rem;
            }
        }
    </style>

    @yield('extra-css')
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="/dashboard">
                <i class="fas fa-door-open"></i> Ruang Nekat
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-bs-toggle="dropdown">
                            <i class="fas fa-user-circle"></i> {{ Auth::user()->name }}
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown">
                            <li><a class="dropdown-item" href="/dashboard"><i class="fas fa-home"></i> Dashboard</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li>
                                <form action="{{ route('logout') }}" method="POST" style="display: inline;">
                                    @csrf
                                    <button type="submit" class="dropdown-item" style="border: none; background: none; cursor: pointer;">
                                        <i class="fas fa-sign-out-alt"></i> Logout
                                    </button>
                                </form>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container-fluid">
        <div class="row">
            <!-- Sidebar -->
            <div class="col-md-3 col-lg-2 sidebar">
                <nav class="nav flex-column">
                    <a class="nav-link {{ request()->is('dashboard') ? 'active' : '' }}" href="/dashboard">
                        <i class="fas fa-chart-line"></i> Dashboard
                    </a>

                    @if(Auth::user()->isAdmin())
                        <a class="nav-link {{ request()->is('users*') ? 'active' : '' }}" href="/users">
                            <i class="fas fa-users"></i> Kelola User
                        </a>
                    @endif

                    <a class="nav-link {{ request()->is('rooms*') ? 'active' : '' }}" href="/rooms">
                        <i class="fas fa-door-open"></i> Ruangan
                    </a>

                    <a class="nav-link {{ request()->is('borrowers*') ? 'active' : '' }}" href="/borrowers">
                        <i class="fas fa-handshake"></i> Peminjam
                    </a>

                    @if(Auth::user()->isAdmin() || Auth::user()->isToolman())
                        <a class="nav-link {{ request()->is('schedules*') ? 'active' : '' }}" href="/schedules">
                            <i class="fas fa-calendar-alt"></i> Jadwal
                        </a>
                    @endif

                    <hr>

                    <p style="padding: 12px 20px; font-size: 0.85rem; color: var(--gray-dark); margin: 0;">
                        <strong>Laporan</strong>
                    </p>

                    <a class="nav-link" href="{{ route('reports.borrowers-pdf') }}" target="_blank">
                        <i class="fas fa-file-pdf"></i> Peminjam (PDF)
                    </a>

                    <a class="nav-link" href="{{ route('reports.borrowers-excel') }}" target="_blank">
                        <i class="fas fa-file-excel"></i> Peminjam (Excel)
                    </a>

                    @if(Auth::user()->isAdmin() || Auth::user()->isToolman())
                        <a class="nav-link" href="{{ route('reports.schedules-pdf') }}" target="_blank">
                            <i class="fas fa-file-pdf"></i> Jadwal (PDF)
                        </a>

                        <a class="nav-link" href="{{ route('reports.schedules-excel') }}" target="_blank">
                            <i class="fas fa-file-excel"></i> Jadwal (Excel)
                        </a>
                    @endif
                </nav>
            </div>

            <!-- Main Content -->
            <div class="col-md-9 col-lg-10 main-content">
                @if($errors->any())
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <strong>Terjadi Kesalahan!</strong>
                        <ul class="mb-0">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif

                @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <i class="fas fa-check-circle"></i> {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif

                @if(session('error'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <i class="fas fa-exclamation-circle"></i> {{ session('error') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif

                @yield('content')
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer>
        <p>&copy; 2025 Ruang Nekat - SMKN 1 Katapang. Semua hak dilindungi.</p>
    </footer>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    @yield('extra-js')
</body>
</html>