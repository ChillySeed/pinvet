<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin Panel - PINVET')</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <!-- Custom Admin CSS -->
    <style>
        body {
            background-color: #f4f6f9;
        }
        .navbar-brand {
            font-weight: 600;
            letter-spacing: 0.5px;
        }
        /* Sidebar untuk desktop */
        .sidebar {
            position: fixed;
            top: 56px;
            bottom: 0;
            left: 0;
            z-index: 100;
            padding: 20px 0;
            background: #343a40;
            box-shadow: inset -1px 0 0 rgba(0, 0, 0, 0.1);
            transition: all 0.3s;
            width: 250px;
        }
        .sidebar .nav-link {
            color: #c2c7d0;
            padding: 0.8rem 1.5rem;
            font-size: 0.95rem;
            border-left: 3px solid transparent;
            transition: 0.2s;
        }
        .sidebar .nav-link:hover {
            color: #fff;
            background: rgba(255,255,255,0.1);
            border-left-color: #ffc107;
        }
        .sidebar .nav-link.active {
            color: #fff;
            background: rgba(255,255,255,0.2);
            border-left-color: #ffc107;
            font-weight: 500;
        }
        .sidebar .nav-link i {
            width: 24px;
            font-size: 1.2rem;
            margin-right: 10px;
        }
        /* Konten utama */
        main {
            margin-left: 250px;
            padding-top: 56px;
            min-height: 100vh;
        }
        /* Responsif: di bawah 768px sidebar disembunyikan dan diganti offcanvas */
        @media (max-width: 767.98px) {
            .sidebar {
                display: none;
            }
            main {
                margin-left: 0;
            }
        }
        /* Tombol toggle untuk mobile */
        .navbar-toggler {
            border: none;
            outline: none;
        }
        /* Offcanvas styling */
        .offcanvas-start {
            width: 280px;
            background: #343a40;
            color: #fff;
        }
        .offcanvas-start .offcanvas-header .btn-close {
            filter: invert(1);
        }
        .offcanvas-start .nav-link {
            color: #c2c7d0;
            padding: 0.8rem 1.5rem;
        }
        .offcanvas-start .nav-link:hover {
            color: #fff;
            background: rgba(255,255,255,0.1);
        }
        .offcanvas-start .nav-link.active {
            color: #fff;
            background: rgba(255,255,255,0.2);
            border-left: 3px solid #ffc107;
        }
        /* Card dan konten */
        .content-wrapper {
            padding: 1.5rem;
        }
        .card {
            border: none;
            border-radius: 0.75rem;
            box-shadow: 0 0 15px rgba(0,0,0,0.05);
        }
        .card-header {
            background: transparent;
            border-bottom: 1px solid rgba(0,0,0,0.08);
            font-weight: 600;
            padding: 1rem 1.5rem;
        }
        .table {
            margin-bottom: 0;
        }
        .table th {
            border-top: none;
            font-weight: 600;
            font-size: 0.85rem;
            text-transform: uppercase;
            letter-spacing: 0.3px;
            color: #6c757d;
        }
        .badge {
            padding: 0.5em 0.8em;
            font-weight: 500;
        }
        /* Alert */
        .alert {
            border-radius: 0.75rem;
            border: none;
            box-shadow: 0 2px 10px rgba(0,0,0,0.05);
        }
    </style>
    @stack('styles')
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar navbar-dark bg-dark fixed-top shadow-sm">
        <div class="container-fluid">
            <!-- Tombol hamburger untuk offcanvas (mobile) -->
            <button class="navbar-toggler d-md-none" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasSidebar" aria-controls="offcanvasSidebar">
                <span class="navbar-toggler-icon"></span>
            </button>
            <a class="navbar-brand ms-2" href="{{ route('admin.dashboard') }}">
                <i class="fas fa-boxes me-2"></i>PINVET Admin
            </a>
            <ul class="navbar-nav ms-auto flex-row">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown">
                        {{ Auth::user()->name ?? 'Admin' }}
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end">
                        <li>
                            <form method="POST" action="{{ route('admin.logout') }}">
                                @csrf
                                <button type="submit" class="dropdown-item">
                                    <i class="fas fa-sign-out-alt me-2"></i>Logout
                                </button>
                            </form>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </nav>

    <!-- Sidebar untuk desktop -->
    <div class="sidebar d-none d-md-block">
        <ul class="nav flex-column">
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}" href="{{ route('admin.dashboard') }}">
                    <i class="fas fa-tachometer-alt"></i> Dashboard
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('admin.barang.*') ? 'active' : '' }}" href="{{ route('admin.barang.index') }}">
                    <i class="fas fa-box"></i> Barang
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('admin.kategori.*') ? 'active' : '' }}" href="{{ route('admin.kategori.index') }}">
                    <i class="fas fa-tags"></i> Kategori
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('admin.peminjaman.*') ? 'active' : '' }}" href="{{ route('admin.peminjaman.index') }}">
                    <i class="fas fa-clipboard-list"></i> Peminjaman
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('admin.users.*') ? 'active' : '' }}" href="{{ route('admin.users.index') }}">
                    <i class="fas fa-users"></i> Users
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('admin.pengaturan.*') ? 'active' : '' }}" href="{{ route('admin.pengaturan.index') }}">
                    <i class="fas fa-cog"></i> Pengaturan
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('admin.pembayaran.*') ? 'active' : '' }}" href="{{ route('admin.pembayaran.index') }}">
                    <i class="fas fa-money-bill"></i> Pembayaran
                </a>
            </li>
        </ul>
    </div>

    <!-- Offcanvas Sidebar untuk mobile -->
    <div class="offcanvas offcanvas-start" tabindex="-1" id="offcanvasSidebar" aria-labelledby="offcanvasSidebarLabel">
        <div class="offcanvas-header">
            <h5 class="offcanvas-title text-white" id="offcanvasSidebarLabel">
                <i class="fas fa-boxes me-2"></i>PINVET Admin
            </h5>
            <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body p-0">
            <ul class="nav flex-column">
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}" href="{{ route('admin.dashboard') }}" onclick="document.querySelector('[data-bs-dismiss=offcanvas]').click()">
                        <i class="fas fa-tachometer-alt"></i> Dashboard
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('admin.barang.*') ? 'active' : '' }}" href="{{ route('admin.barang.index') }}" onclick="document.querySelector('[data-bs-dismiss=offcanvas]').click()">
                        <i class="fas fa-box"></i> Barang
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('admin.kategori.*') ? 'active' : '' }}" href="{{ route('admin.kategori.index') }}" onclick="document.querySelector('[data-bs-dismiss=offcanvas]').click()">
                        <i class="fas fa-tags"></i> Kategori
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('admin.peminjaman.*') ? 'active' : '' }}" href="{{ route('admin.peminjaman.index') }}" onclick="document.querySelector('[data-bs-dismiss=offcanvas]').click()">
                        <i class="fas fa-clipboard-list"></i> Peminjaman
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('admin.users.*') ? 'active' : '' }}" href="{{ route('admin.users.index') }}" onclick="document.querySelector('[data-bs-dismiss=offcanvas]').click()">
                        <i class="fas fa-users"></i> Users
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('admin.pengaturan.*') ? 'active' : '' }}" href="{{ route('admin.pengaturan.index') }}" onclick="document.querySelector('[data-bs-dismiss=offcanvas]').click()">
                        <i class="fas fa-cog"></i> Pengaturan
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('admin.pembayaran.*') ? 'active' : '' }}" href="{{ route('admin.pembayaran.index') }}" onclick="document.querySelector('[data-bs-dismiss=offcanvas]').click()">
                        <i class="fas fa-money-bill"></i> Pembayaran
                    </a>
                </li>
            </ul>
        </div>
    </div>

    <!-- Main Content -->
    <main>
        <div class="content-wrapper">
            <!-- Notifikasi -->
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <i class="fas fa-check-circle me-2"></i> {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif
            @if(session('error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <i class="fas fa-exclamation-circle me-2"></i> {{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif
            @yield('content')
        </div>
    </main>

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    @stack('scripts')
</body>
</html>