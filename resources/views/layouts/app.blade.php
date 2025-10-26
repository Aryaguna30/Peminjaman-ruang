<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') - Ruang Nekat SMKN 1 Katapang</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root {
            --primary: #0052a3;
            --primary-light: #0066cc;
            --secondary: #ffc107;
            --dark: #1a1a1a;
            --light: #f8f9fa;
            --success: #28a745;
            --danger: #dc3545;
            --warning: #ff9800;
            --info: #17a2b8;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            background-color: var(--light);
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            color: var(--dark);
        }

        /* Navbar Styling */
        .navbar {
            background: linear-gradient(135deg, var(--primary) 0%, var(--primary-light) 100%);
            box-shadow: 0 4px 12px rgba(0, 82, 163, 0.15);
            padding: 12px 0;
            border-bottom: 3px solid var(--secondary);
        }

        .navbar-brand {
            display: flex;
            align-items: center;
            gap: 12px;
            font-weight: 700;
            font-size: 1.3rem;
            color: white !important;
        }

        .navbar-brand img {
            height: 45px;
            width: auto;
        }

        .navbar-brand span {
            display: flex;
            flex-direction: column;
            line-height: 1.2;
        }

        .navbar-brand .brand-main {
            font-size: 1.1rem;
        }

        .navbar-brand .brand-sub {
            font-size: 0.75rem;
            opacity: 0.9;
        }

        .nav-link {
            color: rgba(255, 255, 255, 0.9) !important;
            transition: all 0.3s ease;
            font-weight: 500;
        }

        .nav-link:hover {
            color: var(--secondary) !important;
        }

        .dropdown-menu {
            border: none;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
            border-radius: 8px;
        }

        .dropdown-item:hover {
            background-color: var(--light);
            color: var(--primary);
        }

        /* Improved sidebar styling for better visibility */
        .sidebar {
            background: linear-gradient(180deg, var(--primary) 0%, var(--primary-light) 100%);
            min-height: calc(100vh - 70px);
            box-shadow: 2px 0 8px rgba(0, 0, 0, 0.15);
            padding: 20px 0;
            position: sticky;
            top: 70px;
            border-right: 3px solid var(--secondary);
        }

        .sidebar .nav-link {
            color: rgba(255, 255, 255, 0.9);
            padding: 14px 20px;
            border-left: 4px solid transparent;
            transition: all 0.3s ease;
            font-weight: 500;
            display: flex;
            align-items: center;
            gap: 12px;
            margin: 5px 0;
        }

        .sidebar .nav-link i {
            width: 20px;
            text-align: center;
            color: var(--secondary);
        }

        .sidebar .nav-link:hover {
            background-color: rgba(255, 255, 255, 0.15);
            border-left-color: var(--secondary);
            color: white;
        }

        .sidebar .nav-link.active {
            background: rgba(255, 255, 255, 0.2);
            border-left-color: var(--secondary);
            color: white;
            font-weight: 600;
        }

        /* Main Content */
        .main-content {
            padding: 30px;
            background-color: var(--light);
            min-height: calc(100vh - 70px);
        }

        /* Card Styling */
        .card {
            border: none;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);
            border-radius: 12px;
            transition: all 0.3s ease;
            overflow: hidden;
        }

        .card:hover {
            box-shadow: 0 4px 16px rgba(0, 0, 0, 0.12);
            transform: translateY(-2px);
        }

        .card-header {
            background: linear-gradient(135deg, var(--primary) 0%, var(--primary-light) 100%);
            color: white;
            border: none;
            padding: 16px 20px;
            font-weight: 600;
        }

        .card-body {
            padding: 20px;
        }

        /* Stat Cards */
        .stat-card {
            background: white;
            border-radius: 12px;
            padding: 20px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);
            transition: all 0.3s ease;
        }

        .stat-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.12);
        }

        .stat-card .stat-icon {
            font-size: 40px;
            opacity: 0.15;
            margin-left: 10px;
        }

        .stat-card .stat-value {
            font-size: 2rem;
            font-weight: 700;
            margin: 10px 0;
        }

        .stat-card .stat-label {
            color: #666;
            font-size: 0.9rem;
            font-weight: 500;
        }

        /* Button Styling */
        .btn {
            border-radius: 8px;
            font-weight: 600;
            padding: 10px 16px;
            transition: all 0.3s ease;
            border: none;
        }

        .btn-primary {
            background: linear-gradient(135deg, var(--primary) 0%, var(--primary-light) 100%);
            color: white;
        }

        .btn-primary:hover {
            background: linear-gradient(135deg, #003d7a 0%, var(--primary) 100%);
            color: white;
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(0, 82, 163, 0.3);
        }

        .btn-outline-primary {
            color: var(--primary-light);
            border: 2px solid var(--primary-light);
        }

        .btn-outline-primary:hover {
            background: var(--primary-light);
            color: white;
            border-color: var(--primary-light);
        }

        .btn-success {
            background: var(--success);
        }

        .btn-success:hover {
            background: #218838;
        }

        /* Table Styling */
        .table {
            border-collapse: collapse;
        }

        .table thead {
            background: linear-gradient(135deg, var(--primary) 0%, var(--primary-light) 100%);
            color: white;
        }

        .table thead th {
            border: none;
            padding: 14px;
            font-weight: 600;
            text-transform: uppercase;
            font-size: 0.85rem;
            letter-spacing: 0.5px;
        }

        .table tbody td {
            padding: 12px 14px;
            border-color: #e0e0e0;
            vertical-align: middle;
        }

        .table tbody tr:hover {
            background-color: rgba(0, 102, 204, 0.05);
        }

        /* Badge Styling */
        .badge {
            padding: 6px 12px;
            border-radius: 20px;
            font-weight: 600;
            font-size: 0.8rem;
        }

        .badge-primary {
            background: linear-gradient(135deg, var(--primary) 0%, var(--primary-light) 100%);
        }

        .badge-success {
            background: var(--success);
        }

        .badge-danger {
            background: var(--danger);
        }

        .badge-warning {
            background: var(--warning);
        }

        .badge-info {
            background: var(--info);
        }

        /* Alert Styling */
        .alert {
            border-radius: 8px;
            border: none;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);
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

        /* Form Styling */
        .form-control, .form-select {
            border-radius: 8px;
            border: 1px solid #ddd;
            padding: 10px 14px;
            transition: all 0.3s ease;
        }

        .form-control:focus, .form-select:focus {
            border-color: var(--primary-light);
            box-shadow: 0 0 0 0.2rem rgba(0, 102, 204, 0.25);
        }

        .form-label {
            font-weight: 600;
            color: var(--dark);
            margin-bottom: 8px;
        }

        /* Improved responsive design for mobile */
        @media (max-width: 991px) {
            .sidebar {
                position: fixed;
                left: -280px;
                width: 280px;
                height: 100vh;
                z-index: 1000;
                transition: left 0.3s ease;
                top: 0;
                border-right: 1px solid #e0e0e0;
                overflow-y: auto;
                padding-top: 80px;
            }

            .sidebar.show {
                left: 0;
            }

            .main-content {
                padding: 20px;
            }

            .stat-card {
                margin-bottom: 15px;
            }

            /* Add toggle button for sidebar */
            .sidebar-toggle {
                display: block;
            }
        }

        @media (min-width: 992px) {
            .sidebar-toggle {
                display: none;
            }
        }
    </style>
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark sticky-top">
        <div class="container-fluid">
            <a class="navbar-brand" href="/dashboard">
                <img src="/images/logo.png" alt="Logo SMKN 1 Katapang">
                <span>
                    <span class="brand-main">Ruang Nekat</span>
                    <span class="brand-sub">SMKN 1 Katapang</span>
                </span>
            </a>
            <!-- Add sidebar toggle button for mobile -->
            <button class="btn btn-light sidebar-toggle" id="sidebarToggle" style="display: none; margin-right: 10px;">
                <i class="fas fa-bars"></i>
            </button>
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
                                <form action="/logout" method="POST" style="display: inline;">
                                    @csrf
                                    <button type="submit" class="dropdown-item"><i class="fas fa-sign-out-alt"></i> Logout</button>
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
            <div class="col-lg-2 sidebar" id="sidebar">
                <nav class="nav flex-column">
                    <a class="nav-link {{ request()->is('dashboard') ? 'active' : '' }}" href="/dashboard">
                        <i class="fas fa-chart-line"></i> Dashboard
                    </a>

                    @if(Auth::user()->isAdmin())
                        <a class="nav-link {{ request()->is('users*') ? 'active' : '' }}" href="/users">
                            <i class="fas fa-users"></i> Kelola User
                        </a>
                    @endif

                    @if(Auth::user()->isAdmin() || Auth::user()->isSarpras() || Auth::user()->isToolman())
                        <a class="nav-link {{ request()->is('rooms*') ? 'active' : '' }}" href="/rooms">
                            <i class="fas fa-door-open"></i> Ruangan
                        </a>
                        <a class="nav-link {{ request()->is('borrowers*') ? 'active' : '' }}" href="/borrowers">
                            <i class="fas fa-handshake"></i> Peminjam
                        </a>
                        <a class="nav-link {{ request()->is('schedules*') ? 'active' : '' }}" href="/schedules">
                            <i class="fas fa-calendar"></i> Jadwal
                        </a>
                        <a class="nav-link {{ request()->is('reports*') ? 'active' : '' }}" href="/reports">
                            <i class="fas fa-file-pdf"></i> Laporan
                        </a>
                    @endif
                </nav>
            </div>

            <!-- Main Content -->
            <div class="col-lg-10 main-content">
                @if($errors->any())
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <strong><i class="fas fa-exclamation-circle"></i> Error!</strong>
                        <ul class="mb-0 mt-2">
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
                        <i class="fas fa-times-circle"></i> {{ session('error') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif

                @yield('content')
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Add JavaScript for sidebar toggle on mobile -->
    <script>
        const sidebarToggle = document.getElementById('sidebarToggle');
        const sidebar = document.getElementById('sidebar');

        if (sidebarToggle) {
            sidebarToggle.addEventListener('click', function() {
                sidebar.classList.toggle('show');
            });

            // Close sidebar when clicking on a link
            const sidebarLinks = sidebar.querySelectorAll('.nav-link');
            sidebarLinks.forEach(link => {
                link.addEventListener('click', function() {
                    sidebar.classList.remove('show');
                });
            });
        }

        // Show/hide toggle button based on screen size
        function updateToggleButton() {
            if (window.innerWidth < 992) {
                sidebarToggle.style.display = 'block';
            } else {
                sidebarToggle.style.display = 'none';
                sidebar.classList.remove('show');
            }
        }

        window.addEventListener('resize', updateToggleButton);
        updateToggleButton();
    </script>
</body>
</html>
