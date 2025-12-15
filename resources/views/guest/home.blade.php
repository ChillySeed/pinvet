<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PINVET - Sistem Peminjaman Inventaris</title>
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css">
    
    <style>
        /* Hero Section */
        .hero-section {
            background: linear-gradient(rgba(0, 0, 0, 0.7), rgba(0, 0, 0, 0.7)), 
                        url('https://images.unsplash.com/photo-1551288049-bebda4e38f71?ixlib=rb-1.2.1&auto=format&fit=crop&w=1950&q=80');
            background-size: cover;
            background-position: center;
            background-attachment: fixed;
            color: white;
            padding: 150px 0 100px;
            position: relative;
            overflow: hidden;
        }

        .hero-section::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: linear-gradient(135deg, rgba(52, 152, 219, 0.3) 0%, rgba(46, 204, 113, 0.3) 100%);
            z-index: 1;
        }

        .hero-content {
            position: relative;
            z-index: 2;
        }

        .btn-start {
            background: linear-gradient(45deg, #3498db, #2ecc71);
            border: none;
            padding: 15px 40px;
            font-size: 1.2rem;
            font-weight: bold;
            border-radius: 50px;
            transition: all 0.3s ease;
            margin-top: 20px;
            box-shadow: 0 5px 15px rgba(52, 152, 219, 0.4);
            position: relative;
            overflow: hidden;
        }

        .btn-start:hover {
            transform: translateY(-3px);
            box-shadow: 0 10px 25px rgba(52, 152, 219, 0.6);
        }

        .btn-start::after {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
            transition: 0.5s;
        }

        .btn-start:hover::after {
            left: 100%;
        }

        /* Floating Elements */
        .floating {
            animation: float 6s ease-in-out infinite;
        }

        @keyframes float {
            0% { transform: translateY(0px); }
            50% { transform: translateY(-20px); }
            100% { transform: translateY(0px); }
        }

        /* Feature Cards */
        .feature-card {
            transition: all 0.3s ease;
            border: none;
            border-radius: 15px;
            overflow: hidden;
            box-shadow: 0 8px 25px rgba(0,0,0,0.1);
            background: white;
            height: 100%;
            border-top: 4px solid #3498db;
        }

        .feature-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 15px 35px rgba(0,0,0,0.15);
        }

        .feature-card .card-icon {
            width: 70px;
            height: 70px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 20px;
            font-size: 1.8rem;
        }

        /* Stats Section */
        .stats-section {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 80px 0;
            position: relative;
            overflow: hidden;
        }

        .stats-section::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320"><path fill="rgba(255,255,255,0.1)" d="M0,96L48,112C96,128,192,160,288,160C384,160,480,128,576,112C672,96,768,96,864,112C960,128,1056,160,1152,160C1248,160,1344,128,1392,112L1440,96L1440,320L1392,320C1344,320,1248,320,1152,320C1056,320,960,320,864,320C768,320,672,320,576,320C480,320,384,320,288,320C192,320,96,320,48,320L0,320Z"></path></svg>');
            background-size: cover;
            background-position: bottom;
            opacity: 0.3;
        }

        .stats-number {
            font-size: 3.5rem;
            font-weight: bold;
            color: #fff;
            text-shadow: 2px 2px 4px rgba(0,0,0,0.3);
        }

        .stats-label {
            font-size: 1.1rem;
            opacity: 0.9;
        }

        /* How It Works */
        .step-card {
            position: relative;
            padding: 30px;
            text-align: center;
            background: white;
            border-radius: 15px;
            box-shadow: 0 5px 20px rgba(0,0,0,0.08);
            transition: all 0.3s ease;
            height: 100%;
        }

        .step-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 30px rgba(0,0,0,0.15);
        }

        .step-number {
            width: 60px;
            height: 60px;
            background: linear-gradient(45deg, #3498db, #2ecc71);
            color: white;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5rem;
            font-weight: bold;
            margin: 0 auto 20px;
            position: relative;
        }

        .step-number::after {
            content: '';
            position: absolute;
            width: 70px;
            height: 70px;
            border: 2px dashed #3498db;
            border-radius: 50%;
            animation: spin 20s linear infinite;
        }

        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }

        /* Testimonials */
        .testimonial-card {
            background: white;
            border-radius: 15px;
            padding: 30px;
            box-shadow: 0 8px 25px rgba(0,0,0,0.1);
            margin: 15px;
            border-left: 5px solid #3498db;
        }

        .testimonial-avatar {
            width: 60px;
            height: 60px;
            border-radius: 50%;
            object-fit: cover;
            border: 3px solid #3498db;
        }

        /* FAQ */
        .faq-item {
            margin-bottom: 10px;
            border-radius: 10px;
            overflow: hidden;
        }

        .faq-question {
            background: #f8f9fa;
            padding: 20px;
            cursor: pointer;
            font-weight: 500;
            display: flex;
            justify-content: space-between;
            align-items: center;
            transition: all 0.3s ease;
        }

        .faq-question:hover {
            background: #e9ecef;
        }

        .faq-answer {
            padding: 0 20px;
            max-height: 0;
            overflow: hidden;
            transition: all 0.3s ease;
        }

        .faq-answer.show {
            padding: 20px;
            max-height: 500px;
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .hero-section {
                padding: 100px 0 60px;
                background-attachment: scroll;
            }
            
            .hero-section h1 {
                font-size: 2.5rem;
            }
            
            .stats-number {
                font-size: 2.5rem;
            }
        }

        /* Wave Divider */
        .wave-divider {
            position: absolute;
            bottom: 0;
            left: 0;
            width: 100%;
            overflow: hidden;
            line-height: 0;
        }

        .wave-divider svg {
            position: relative;
            display: block;
            width: calc(100% + 1.3px);
            height: 100px;
        }

        .wave-divider .shape-fill {
            fill: #FFFFFF;
        }

        /* Custom Scrollbar */
        ::-webkit-scrollbar {
            width: 10px;
        }

        ::-webkit-scrollbar-track {
            background: #f1f1f1;
        }

        ::-webkit-scrollbar-thumb {
            background: linear-gradient(45deg, #3498db, #2ecc71);
            border-radius: 5px;
        }

        ::-webkit-scrollbar-thumb:hover {
            background: linear-gradient(45deg, #2980b9, #27ae60);
        }
    </style>
</head>
<body>
    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-dark fixed-top" style="background: rgba(0,0,0,0.9); backdrop-filter: blur(10px);">
        <div class="container">
            <a class="navbar-brand" href="#">
                <i class="fas fa-boxes me-2"></i>
                <strong class="fs-4">PINVET</strong>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="#home">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#features">Fitur</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#how-it-works">Cara Kerja</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#pricing">Paket</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#testimonials">Testimoni</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#faq">FAQ</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link btn btn-outline-light ms-2" href="{{ route('login') }}">
                            <i class="fas fa-sign-in-alt me-1"></i>Login Admin
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section id="home" class="hero-section">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6 hero-content">
                    <h1 class="display-3 fw-bold mb-4">
                        PINVET
                        <span class="text-warning d-block mt-2">Sistem Peminjaman Inventaris</span>
                    </h1>
                    <p class="lead mb-4">
                        Solusi digital terintegrasi untuk manajemen peminjaman barang inventaris UKM. 
                        Kelola stok, peminjaman, dan pembayaran dalam satu platform.
                    </p>
                    <div class="d-flex flex-wrap gap-3">
                        <a href="#start-peminjaman" class="btn btn-start">
                            <i class="fas fa-play-circle me-2"></i>Start Peminjaman
                        </a>
                        <a href="{{ route('guest.katalog.index') }}" class="btn btn-outline-light btn-lg px-4">
                            <i class="fas fa-boxes me-2"></i>Lihat Katalog
                        </a>
                    </div>
                    
                    <!-- Quick Stats -->
                    <div class="row mt-5 pt-4">
                        <div class="col-4">
                            <div class="text-center">
                                <h3 class="fw-bold text-warning mb-0">500+</h3>
                                <small>Barang Tersedia</small>
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="text-center">
                                <h3 class="fw-bold text-warning mb-0">1K+</h3>
                                <small>Peminjaman</small>
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="text-center">
                                <h3 class="fw-bold text-warning mb-0">50+</h3>
                                <small>Mitra UKM</small>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="floating mt-5 mt-lg-0">
                        <div class="position-relative">
                            <img src="https://images.unsplash.com/photo-1581091226825-a6a2a5aee158?ixlib=rb-1.2.1&auto=format&fit=crop&w=800&q=80" 
                                 alt="Inventory Management" class="img-fluid rounded-3 shadow-lg">
                            <!-- Floating Badges -->
                            <div class="position-absolute top-0 start-0 translate-middle bg-success text-white p-2 rounded-circle shadow">
                                <i class="fas fa-check"></i>
                            </div>
                            <div class="position-absolute top-0 end-0 translate-middle bg-primary text-white p-2 rounded-circle shadow">
                                <i class="fas fa-bolt"></i>
                            </div>
                            <div class="position-absolute bottom-0 start-0 translate-middle bg-warning text-white p-2 rounded-circle shadow">
                                <i class="fas fa-star"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Features Section -->
    <section id="features" class="py-5 bg-light">
        <div class="container py-5">
            <div class="text-center mb-5">
                <h2 class="display-5 fw-bold mb-3">Fitur Unggulan PINVET</h2>
                <p class="lead text-muted">Semua yang Anda butuhkan dalam satu sistem terintegrasi</p>
            </div>
            
            <div class="row g-4">
                <div class="col-md-4">
                    <div class="feature-card">
                        <div class="card-body text-center p-4">
                            <div class="card-icon bg-primary bg-gradient text-white">
                                <i class="fas fa-boxes"></i>
                            </div>
                            <h4 class="card-title mb-3">Katalog Digital</h4>
                            <p class="card-text text-muted">
                                Akses katalog barang lengkap dengan foto, spesifikasi, dan ketersediaan real-time.
                            </p>
                            <a href="{{ route('guest.katalog.index') }}" class="btn btn-outline-primary btn-sm mt-2">
                                <i class="fas fa-eye me-1"></i>Lihat Katalog
                            </a>
                        </div>
                    </div>
                </div>
                
                <div class="col-md-4">
                    <div class="feature-card">
                        <div class="card-body text-center p-4">
                            <div class="card-icon bg-success bg-gradient text-white">
                                <i class="fas fa-handshake"></i>
                            </div>
                            <h4 class="card-title mb-3">Dual Mode</h4>
                            <p class="card-text text-muted">
                                Sistem peminjaman dual mode: Internal untuk anggota dan Eksternal untuk umum.
                            </p>
                            <a href="#start-peminjaman" class="btn btn-outline-success btn-sm mt-2">
                                <i class="fas fa-play me-1"></i>Mulai Sekarang
                            </a>
                        </div>
                    </div>
                </div>
                
                <div class="col-md-4">
                    <div class="feature-card">
                        <div class="card-body text-center p-4">
                            <div class="card-icon bg-warning bg-gradient text-white">
                                <i class="fas fa-file-pdf"></i>
                            </div>
                            <h4 class="card-title mb-3">Surat Otomatis</h4>
                            <p class="card-text text-muted">
                                Generate surat peminjaman otomatis dalam format PDF yang siap cetak.
                            </p>
                            <button class="btn btn-outline-warning btn-sm mt-2" data-bs-toggle="modal" data-bs-target="#suratModal">
                                <i class="fas fa-file-download me-1"></i>Contoh Surat
                            </button>
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="feature-card">
                        <div class="card-body text-center p-4">
                            <div class="card-icon bg-info bg-gradient text-white">
                                <i class="fas fa-qrcode"></i>
                            </div>
                            <h4 class="card-title mb-3">QR Code System</h4>
                            <p class="card-text text-muted">
                                Setiap barang memiliki QR Code untuk tracking dan inventarisasi yang mudah.
                            </p>
                            <button class="btn btn-outline-info btn-sm mt-2" data-bs-toggle="modal" data-bs-target="#qrcodeModal">
                                <i class="fas fa-qrcode me-1"></i>Scan QR
                            </button>
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="feature-card">
                        <div class="card-body text-center p-4">
                            <div class="card-icon bg-danger bg-gradient text-white">
                                <i class="fas fa-chart-line"></i>
                            </div>
                            <h4 class="card-title mb-3">Analytics & Report</h4>
                            <p class="card-text text-muted">
                                Dashboard analitik dan laporan statistik untuk evaluasi dan pengambilan keputusan.
                            </p>
                            <button class="btn btn-outline-danger btn-sm mt-2" data-bs-toggle="modal" data-bs-target="#reportModal">
                                <i class="fas fa-chart-bar me-1"></i>Lihat Report
                            </button>
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="feature-card">
                        <div class="card-body text-center p-4">
                            <div class="card-icon bg-secondary bg-gradient text-white">
                                <i class="fas fa-mobile-alt"></i>
                            </div>
                            <h4 class="card-title mb-3">Mobile Friendly</h4>
                            <p class="card-text text-muted">
                                Akses sistem melalui smartphone, tablet, atau desktop dengan responsif dan cepat.
                            </p>
                            <button class="btn btn-outline-secondary btn-sm mt-2" data-bs-toggle="modal" data-bs-target="#mobileModal">
                                <i class="fas fa-mobile-alt me-1"></i>Mobile View
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- How It Works -->
    <section id="how-it-works" class="py-5 bg-white">
        <div class="container py-5">
            <div class="text-center mb-5">
                <h2 class="display-5 fw-bold mb-3">Cara Kerja Sistem</h2>
                <p class="lead text-muted">4 Langkah mudah untuk meminjam barang</p>
            </div>
            
            <div class="row g-4">
                <div class="col-lg-3 col-md-6">
                    <div class="step-card">
                        <div class="step-number">1</div>
                        <h4>Daftar/Login</h4>
                        <p class="text-muted">Buat akun atau login untuk mengakses sistem peminjaman.</p>
                        <div class="mt-3">
                            <i class="fas fa-user-plus fa-2x text-primary"></i>
                        </div>
                    </div>
                </div>
                
                <div class="col-lg-3 col-md-6">
                    <div class="step-card">
                        <div class="step-number">2</div>
                        <h4>Pilih Barang</h4>
                        <p class="text-muted">Telusuri katalog dan pilih barang yang ingin dipinjam.</p>
                        <div class="mt-3">
                            <i class="fas fa-search fa-2x text-success"></i>
                        </div>
                    </div>
                </div>
                
                <div class="col-lg-3 col-md-6">
                    <div class="step-card">
                        <div class="step-number">3</div>
                        <h4>Isi Formulir</h4>
                        <p class="text-muted">Lengkapi data peminjaman dan upload dokumen pendukung.</p>
                        <div class="mt-3">
                            <i class="fas fa-file-alt fa-2x text-warning"></i>
                        </div>
                    </div>
                </div>
                
                <div class="col-lg-3 col-md-6">
                    <div class="step-card">
                        <div class="step-number">4</div>
                        <h4>Konfirmasi</h4>
                        <p class="text-muted">Tunggu konfirmasi admin dan ambil barang di lokasi.</p>
                        <div class="mt-3">
                            <i class="fas fa-check-circle fa-2x text-danger"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Start Peminjaman Section -->
    <section id="start-peminjaman" class="py-5 stats-section">
        <div class="container py-5">
            <div class="text-center mb-5">
                <h2 class="display-5 fw-bold mb-4">Mulai Peminjaman Sekarang</h2>
                <p class="lead mb-5">Pilih jenis peminjaman yang sesuai dengan kebutuhan Anda</p>
                
                <div class="row justify-content-center">
                    <div class="col-lg-5 col-md-6 mb-4">
                        <div class="card text-dark h-100 border-0 shadow-lg">
                            <div class="card-body text-center p-5">
                                <div class="mb-4">
                                    <div class="bg-primary bg-gradient text-white rounded-circle d-inline-flex align-items-center justify-content-center" 
                                         style="width: 100px; height: 100px;">
                                        <i class="fas fa-users fa-3x"></i>
                                    </div>
                                </div>
                                <h3 class="card-title mb-3">Peminjaman Internal</h3>
                                <p class="card-text mb-4">
                                    Untuk anggota dan pengurus UKM internal. Gratis tanpa biaya dengan proses yang cepat dan mudah.
                                </p>
                                <ul class="list-unstyled text-start mb-4">
                                    <li class="mb-2"><i class="fas fa-check-circle text-success me-2"></i>Gratis tanpa biaya</li>
                                    <li class="mb-2"><i class="fas fa-check-circle text-success me-2"></i>Surat otomatis</li>
                                    <li class="mb-2"><i class="fas fa-check-circle text-success me-2"></i>Proses 1x24 jam</li>
                                    <li class="mb-2"><i class="fas fa-check-circle text-success me-2"></i>Prioritas tinggi</li>
                                </ul>
                                <a href="{{ route('peminjaman.start', 'internal') }}" class="btn btn-primary btn-lg w-100">
                                    <i class="fas fa-play me-2"></i>Start Internal
                                </a>
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-lg-5 col-md-6 mb-4">
                        <div class="card text-dark h-100 border-0 shadow-lg">
                            <div class="card-body text-center p-5">
                                <div class="mb-4">
                                    <div class="bg-success bg-gradient text-white rounded-circle d-inline-flex align-items-center justify-content-center" 
                                         style="width: 100px; height: 100px;">
                                        <i class="fas fa-globe fa-3x"></i>
                                    </div>
                                </div>
                                <h3 class="card-title mb-3">Peminjaman Eksternal</h3>
                                <p class="card-text mb-4">
                                    Untuk organisasi eksternal, perusahaan, atau umum. Dengan sistem sewa dan pembayaran yang fleksibel.
                                </p>
                                <ul class="list-unstyled text-start mb-4">
                                    <li class="mb-2"><i class="fas fa-check-circle text-success me-2"></i>Sistem sewa harian</li>
                                    <li class="mb-2"><i class="fas fa-check-circle text-success me-2"></i>Multiple payment</li>
                                    <li class="mb-2"><i class="fas fa-check-circle text-success me-2"></i>Asuransi barang</li>
                                    <li class="mb-2"><i class="fas fa-check-circle text-success me-2"></i>Support 24/7</li>
                                </ul>
                                <a href="{{ route('peminjaman.start', 'eksternal') }}" class="btn btn-success btn-lg w-100">
                                    <i class="fas fa-play me-2"></i>Start Eksternal
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Testimonials -->
    <section id="testimonials" class="py-5 bg-light">
        <div class="container py-5">
            <div class="text-center mb-5">
                <h2 class="display-5 fw-bold mb-3">Testimoni Pengguna</h2>
                <p class="lead text-muted">Apa kata mereka tentang PINVET</p>
            </div>
            
            <div class="row">
                <div class="col-md-4 mb-4">
                    <div class="testimonial-card">
                        <div class="d-flex align-items-center mb-3">
                            <img src="https://randomuser.me/api/portraits/men/32.jpg" 
                                 alt="User" class="testimonial-avatar me-3">
                            <div>
                                <h5 class="mb-0">Ahmad Rizki</h5>
                                <small class="text-muted">Ketua UKM Basket</small>
                            </div>
                        </div>
                        <p class="mb-0">
                            "Sistem yang sangat membantu! Proses peminjaman bola basket dan peralatan olahraga jadi lebih cepat dan terorganisir."
                        </p>
                        <div class="mt-3">
                            <i class="fas fa-star text-warning"></i>
                            <i class="fas fa-star text-warning"></i>
                            <i class="fas fa-star text-warning"></i>
                            <i class="fas fa-star text-warning"></i>
                            <i class="fas fa-star text-warning"></i>
                        </div>
                    </div>
                </div>
                
                <div class="col-md-4 mb-4">
                    <div class="testimonial-card">
                        <div class="d-flex align-items-center mb-3">
                            <img src="https://randomuser.me/api/portraits/women/44.jpg" 
                                 alt="User" class="testimonial-avatar me-3">
                            <div>
                                <h5 class="mb-0">Siti Nurhaliza</h5>
                                <small class="text-muted">Bendahara UKM Musik</small>
                            </div>
                        </div>
                        <p class="mb-0">
                            "PINVET membuat administrasi peminjaman alat musik jadi lebih mudah. Laporan keuangan juga lebih transparan."
                        </p>
                        <div class="mt-3">
                            <i class="fas fa-star text-warning"></i>
                            <i class="fas fa-star text-warning"></i>
                            <i class="fas fa-star text-warning"></i>
                            <i class="fas fa-star text-warning"></i>
                            <i class="fas fa-star-half-alt text-warning"></i>
                        </div>
                    </div>
                </div>
                
                <div class="col-md-4 mb-4">
                    <div class="testimonial-card">
                        <div class="d-flex align-items-center mb-3">
                            <img src="https://randomuser.me/api/portraits/men/67.jpg" 
                                 alt="User" class="testimonial-avatar me-3">
                            <div>
                                <h5 class="mb-0">Budi Santoso</h5>
                                <small class="text-muted">Event Organizer</small>
                            </div>
                        </div>
                        <p class="mb-0">
                            "Sebagai EO, saya sering pinjam sound system. PINVET memudahkan tracking dan pembayaran. Highly recommended!"
                        </p>
                        <div class="mt-3">
                            <i class="fas fa-star text-warning"></i>
                            <i class="fas fa-star text-warning"></i>
                            <i class="fas fa-star text-warning"></i>
                            <i class="fas fa-star text-warning"></i>
                            <i class="fas fa-star text-warning"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- FAQ Section -->
    <section id="faq" class="py-5 bg-white">
        <div class="container py-5">
            <div class="text-center mb-5">
                <h2 class="display-5 fw-bold mb-3">Frequently Asked Questions</h2>
                <p class="lead text-muted">Pertanyaan yang sering diajukan</p>
            </div>
            
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="accordion" id="faqAccordion">
                        <div class="faq-item">
                            <div class="faq-question" data-bs-toggle="collapse" data-bs-target="#faq1">
                                <span>Bagaimana cara mendaftar sebagai peminjam?</span>
                                <i class="fas fa-chevron-down"></i>
                            </div>
                            <div id="faq1" class="faq-answer collapse show" data-bs-parent="#faqAccordion">
                                Untuk peminjaman internal, Anda harus terdaftar sebagai anggota UKM. Untuk eksternal, cukup isi formulir dengan data lengkap.
                            </div>
                        </div>
                        
                        <div class="faq-item">
                            <div class="faq-question" data-bs-toggle="collapse" data-bs-target="#faq2">
                                <span>Berapa lama proses persetujuan peminjaman?</span>
                                <i class="fas fa-chevron-down"></i>
                            </div>
                            <div id="faq2" class="faq-answer collapse" data-bs-parent="#faqAccordion">
                                Peminjaman internal: 1x24 jam. Peminjaman eksternal: 2-3 hari kerja tergantung kelengkapan dokumen.
                            </div>
                        </div>
                        
                        <div class="faq-item">
                            <div class="faq-question" data-bs-toggle="collapse" data-bs-target="#faq3">
                                <span>Apakah ada denda keterlambatan pengembalian?</span>
                                <i class="fas fa-chevron-down"></i>
                            </div>
                            <div id="faq3" class="faq-answer collapse" data-bs-parent="#faqAccordion">
                                Ya, berlaku denda 10% dari biaya sewa per hari untuk keterlambatan pengembalian.
                            </div>
                        </div>
                        
                        <div class="faq-item">
                            <div class="faq-question" data-bs-toggle="collapse" data-bs-target="#faq4">
                                <span>Bagaimana cara pembayaran untuk peminjaman eksternal?</span>
                                <i class="fas fa-chevron-down"></i>
                            </div>
                            <div id="faq4" class="faq-answer collapse" data-bs-parent="#faqAccordion">
                                Pembayaran bisa dilakukan via transfer bank, QRIS, atau tunai saat pengambilan barang.
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Modals -->
    <!-- Surat Modal -->
    <div class="modal fade" id="suratModal" tabindex="-1">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Contoh Surat Peminjaman</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="border p-4">
                        <div class="text-center mb-4">
                            <h4 class="fw-bold">SURAT PEMINJAMAN BARANG</h4>
                            <p class="text-muted">Nomor: PINVET/001/2024</p>
                        </div>
                        <p>Yang bertanda tangan di bawah ini:</p>
                        <p>Nama: <strong>John Doe</strong></p>
                        <p>Instansi: <strong>UKM Musik Universitas X</strong></p>
                        <p>Dengan ini mengajukan peminjaman barang sebagai berikut:</p>
                        
                        <table class="table table-bordered mt-3">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama Barang</th>
                                    <th>Jumlah</th>
                                    <th>Tanggal Pinjam</th>
                                    <th>Tanggal Kembali</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>1</td>
                                    <td>Sound System Portable</td>
                                    <td>1 Set</td>
                                    <td>15 Jan 2024</td>
                                    <td>17 Jan 2024</td>
                                </tr>
                            </tbody>
                        </table>
                        
                        <p class="mt-4">Demikian surat ini dibuat untuk digunakan sebagaimana mestinya.</p>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-primary">
                        <i class="fas fa-download me-1"></i>Download PDF
                    </button>
                    <button class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                </div>
            </div>
        </div>
    </div>

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
                        <li class="mb-2"><a href="#home" class="text-white text-decoration-none">Home</a></li>
                        <li class="mb-2"><a href="#features" class="text-white text-decoration-none">Fitur</a></li>
                        <li class="mb-2"><a href="#how-it-works" class="text-white text-decoration-none">Cara Kerja</a></li>
                        <li class="mb-2"><a href="#testimonials" class="text-white text-decoration-none">Testimoni</a></li>
                        <li><a href="#faq" class="text-white text-decoration-none">FAQ</a></li>
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
                    <p>&copy; 2024 PINVET. All rights reserved.</p>
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
                    
                    // Update active nav link
                    document.querySelectorAll('.nav-link').forEach(link => {
                        link.classList.remove('active');
                    });
                    this.classList.add('active');
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
            window.scrollTo({
                top: 0,
                behavior: 'smooth'
            });
        });

        // FAQ Toggle
        document.querySelectorAll('.faq-question').forEach(question => {
            question.addEventListener('click', function() {
                const answer = this.nextElementSibling;
                const icon = this.querySelector('i');
                
                if (answer.classList.contains('show')) {
                    answer.classList.remove('show');
                    icon.classList.remove('fa-chevron-up');
                    icon.classList.add('fa-chevron-down');
                } else {
                    document.querySelectorAll('.faq-answer').forEach(item => {
                        item.classList.remove('show');
                    });
                    document.querySelectorAll('.faq-question i').forEach(item => {
                        item.classList.remove('fa-chevron-up');
                        item.classList.add('fa-chevron-down');
                    });
                    
                    answer.classList.add('show');
                    icon.classList.remove('fa-chevron-down');
                    icon.classList.add('fa-chevron-up');
                }
            });
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

        // Counter Animation (Stats)
        function animateCounter(element, target) {
            let current = 0;
            const increment = target / 100;
            const timer = setInterval(() => {
                current += increment;
                if (current >= target) {
                    element.textContent = target + '+';
                    clearInterval(timer);
                } else {
                    element.textContent = Math.floor(current) + '+';
                }
            }, 20);
        }

        // Animate counters when in view
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    const counters = entry.target.querySelectorAll('.stats-number');
                    counters.forEach(counter => {
                        const target = parseInt(counter.textContent);
                        animateCounter(counter, target);
                    });
                }
            });
        }, { threshold: 0.5 });

        // Start animation when page loads
        document.addEventListener('DOMContentLoaded', () => {
            // Simulate stats
            document.querySelectorAll('.stats-number').forEach(counter => {
                const value = counter.textContent.replace('+', '');
                counter.textContent = '0';
                setTimeout(() => {
                    animateCounter(counter, parseInt(value));
                }, 500);
            });

            // Add animation to feature cards on scroll
            const featureCards = document.querySelectorAll('.feature-card');
            featureCards.forEach((card, index) => {
                card.style.animationDelay = `${index * 0.1}s`;
            });

            // Newsletter Form
            const newsletterForm = document.querySelector('.input-group');
            newsletterForm.addEventListener('submit', (e) => {
                e.preventDefault();
                const email = newsletterForm.querySelector('input').value;
                if (email) {
                    alert('Terima kasih! Anda akan menerima newsletter kami.');
                    newsletterForm.querySelector('input').value = '';
                }
            });
        });
    </script>
</body>
</html>