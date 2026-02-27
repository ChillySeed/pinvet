<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'PINVET - Sistem Peminjaman Inventaris')</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css">

    @stack('styles')
</head>
<body>
    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-dark fixed-top" style="background: rgba(0,0,0,0.9); backdrop-filter: blur(10px);">
        <div class="container">
            <a class="navbar-brand" href="{{ route('home') }}">
                <i class="fas fa-boxes me-2"></i>
                <strong class="fs-4">PINVET</strong>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('home') ? 'active' : '' }}" href="{{ route('home') }}#home">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('home') ? 'active' : '' }}" href="{{ route('home') }}#features">Fitur</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('home') ? 'active' : '' }}" href="{{ route('home') }}#how-it-works">Cara Kerja</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('guest.katalog.index') ? 'active' : '' }}" href="{{ route('guest.katalog.index') }}">Katalog</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link position-relative" href="{{ route('cart.index') }}">
                            <i class="fas fa-shopping-cart"></i>
                            <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger" id="cart-count">
                                {{ session('cart') ? array_sum(session('cart')) : 0 }}
                            </span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link btn btn-outline-light ms-2 px-3" href="{{ route('admin.login') }}">
                            <i class="fas fa-sign-in-alt me-1"></i>Login Admin
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <main>
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="bg-dark text-white py-5">
        <div class="container">
            <div class="row">
                <div class="col-md-4 mb-4">
                    <h4 class="mb-4">
                        <i class="fas fa-boxes me-2"></i>PINVET
                    </h4>
                    <p>Sistem Peminjaman Inventaris UKM yang terintegrasi dan modern.</p>
                    <div class="social-links mt-3">
                        <a href="#" class="text-white me-3"><i class="fab fa-facebook fa-2x"></i></a>
                        <a href="#" class="text-white me-3"><i class="fab fa-instagram fa-2x"></i></a>
                        <a href="#" class="text-white"><i class="fab fa-whatsapp fa-2x"></i></a>
                    </div>
                </div>
                <div class="col-md-2 mb-4">
                    <h5 class="mb-4">Menu</h5>
                    <ul class="list-unstyled">
                        <li class="mb-2"><a href="{{ route('home') }}#home" class="text-white text-decoration-none">Home</a></li>
                        <li class="mb-2"><a href="{{ route('home') }}#features" class="text-white text-decoration-none">Fitur</a></li>
                        <li class="mb-2"><a href="{{ route('home') }}#how-it-works" class="text-white text-decoration-none">Cara Kerja</a></li>
                        <li class="mb-2"><a href="{{ route('guest.katalog.index') }}" class="text-white text-decoration-none">Katalog</a></li>
                    </ul>
                </div>
                <div class="col-md-3 mb-4">
                    <h5 class="mb-4">Kontak</h5>
                    <ul class="list-unstyled">
                        <li class="mb-2">
                            <i class="fas fa-map-marker-alt me-2"></i>
                            Gedung Student Center Lt. 3
                        </li>
                        <li class="mb-2">
                            <i class="fas fa-phone me-2"></i>
                            (021) 1234-5678
                        </li>
                        <li class="mb-2">
                            <i class="fas fa-envelope me-2"></i>
                            info@pinvet.id
                        </li>
                        <li>
                            <i class="fas fa-clock me-2"></i>
                            Senin - Jumat: 08:00 - 17:00
                        </li>
                    </ul>
                </div>
                <div class="col-md-3 mb-4">
                    <h5 class="mb-4">Newsletter</h5>
                    <p>Dapatkan info terbaru tentang fitur dan promo.</p>
                    <div class="input-group mb-3">
                        <input type="email" class="form-control" placeholder="Email Anda">
                        <button class="btn btn-primary" type="button">
                            <i class="fas fa-paper-plane"></i>
                        </button>
                    </div>
                </div>
            </div>
            <hr class="my-4">
            <div class="row">
                <div class="col-md-6">
                    <p>&copy; {{ date('Y') }} PINVET. All rights reserved.</p>
                </div>
                <div class="col-md-6 text-end">
                    <p>Made with <i class="fas fa-heart text-danger"></i> for UKM Indonesia</p>
                </div>
            </div>
        </div>
    </footer>

    <!-- Back to Top Button -->
    <button id="backToTop" class="btn btn-primary position-fixed bottom-0 end-0 m-4 rounded-circle shadow" 
            style="width: 60px; height: 60px; display: none;">
        <i class="fas fa-arrow-up"></i>
    </button>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script>
        // Smooth Scrolling
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();
                const target = document.querySelector(this.getAttribute('href'));
                if (target) {
                    target.scrollIntoView({
                        behavior: 'smooth',
                        block: 'start'
                    });
                }
            });
        });

        // Back to Top Button
        const backToTop = document.getElementById('backToTop');
        window.addEventListener('scroll', () => {
            if (window.pageYOffset > 300) {
                backToTop.style.display = 'block';
            } else {
                backToTop.style.display = 'none';
            }
        });
        backToTop.addEventListener('click', () => {
            window.scrollTo({ top: 0, behavior: 'smooth' });
        });

        // Navbar Scroll Effect
        window.addEventListener('scroll', () => {
            const navbar = document.querySelector('.navbar');
            if (window.pageYOffset > 100) {
                navbar.style.background = 'rgba(0,0,0,0.95)';
                navbar.style.boxShadow = '0 4px 20px rgba(0,0,0,0.1)';
            } else {
                navbar.style.background = 'rgba(0,0,0,0.9)';
                navbar.style.boxShadow = 'none';
            }
        });
    </script>

    @stack('scripts')
</body>
</html>