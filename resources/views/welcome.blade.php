<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>FoundIt - Temukan Kembali Barangmu</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">

    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f8f9fa;
        }
        .navbar {
            background-color: white;
            box-shadow: 0 2px 10px rgba(0,0,0,0.05);
        }
        .hero-section {
            padding: 100px 0;
            background: linear-gradient(135deg, #fff 0%, #fff2f0 100%);
        }
        .btn-foundit {
            background-color: #679cbc;
            color: white;
            border-radius: 50px;
            padding: 10px 25px;
            font-weight: 600;
            border: none;
            transition: 0.3s;
        }
        .btn-foundit:hover {
            background-color: #495388;
            color: white;
            transform: translateY(-2px);
        }
        .btn-joinfoundit {
            background-color: #495388;
            color: white;
            border-radius: 50px;
            padding: 10px 25px;
            font-weight: 600;
            border: none;
            transition: 0.3s;
        }
        .btn-joinfoundit:hover {
            background-color: #2a3363;
            color: white;
            transform: translateY(-2px);
        }
        .btn-outline-foundit {
            border: 2px solid #1b1b18;
            color: #1b1b18;
            border-radius: 50px;
            padding: 10px 25px;
            font-weight: 600;
            transition: 0.3s;
        }
        .btn-outline-foundit:hover {
            background-color: #495388;
            color: white;
        }
        .feature-card {
            border: none;
            border-radius: 20px;
            transition: 0.3s;
            background: white;
            box-shadow: 0 5px 15px rgba(0,0,0,0.05);
        }
        .feature-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
        }
        .icon-box {
            width: 60px;
            height: 60px;
            background-color: #fff2f0;
            color: #750909;
            border-radius: 15px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 24px;
            margin-bottom: 20px;
        }
    </style>
</head>
<body>

    <nav class="navbar navbar-expand-lg sticky-top">
        <div class="container">
            <a class="navbar-brand fw-bold fs-3" href="#" style="color: #750909;">FoundIt.</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto align-items-center">
                    @if (Route::has('login'))
                            <li class="nav-item">
                                <a class="nav-link fw-semibold" href="{{ route('login') }}">Log in</a>
                            </li>
                            @if (Route::has('register'))
                                <li class="nav-item ms-lg-3">
                                    <a class="btn btn-joinfoundit" href="{{ route('register') }}">Join Now</a>
                                </li>
                            @endif
                    @endif
                </ul>
            </div>
        </div>
    </nav>

    <header class="hero-section">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6 text-center text-lg-start">
                    <span class="badge rounded-pill px-3 py-2 mb-3" style="background-color: #fff2f0; color: #750909">
                        📍 SOLUSI BARANG HILANG NO. 1 di UPI Purwakarta
                    </span>
                    <h1 class="display-3 fw-bold mb-4">Barang Hilang? <br> <span style="color: #750909;">FoundIt</span> Solusinya.</h1>
                    <p class="lead text-secondary mb-5">Platform komunitas untuk membantu mengembalikan barang temuan kepada pemilik aslinya. Cepat, aman, dan terpercaya.</p>
                    <div class="d-grid d-md-flex gap-3 justify-content-center justify-content-lg-start">
                        <a href="{{ route('register') }}" class="btn btn-foundit px-5 py-3 fs-5">Laporkan Penemuan</a>
                        <a href="{{ route('register') }}" class="btn btn-outline-foundit px-5 py-3 fs-5">Cari Barang Hilang</a>
                    </div>
                </div>
                <div class="col-lg-6 d-none d-lg-block">
                    <img src="{{ asset('assets/logo-foundit.png') }}" class="img-fluid" alt="FoundIt Illustration">
                </div>
            </div>
        </div>
    </header>

    <section id="fitur" class="py-5 bg-white">
        <div class="container py-5">
            <div class="text-center mb-5">
                <h2 class="fw-bold">Mengapa FoundIt?</h2>
                <p class="text-secondary">Kami menyediakan fitur terbaik untuk mempermudah pencarian.</p>
            </div>
            <div class="row g-4">
                <div class="col-md-4">
                    <div class="card feature-card h-100 p-4">
                        <div class="icon-box">
                            <i class="bi bi-search"></i>
                        </div>
                        <h4 class="fw-bold">Smart Search</h4>
                        <p class="text-secondary">Cari barangmu dengan keyword atau filter kategori yang memudahkan pencarian.</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card feature-card h-100 p-4">
                        <div class="icon-box" style="background-color: #e7f3ff; color: #007bff;">
                            <i class="bi bi-chat-dots"></i>
                        </div>
                        <h4 class="fw-bold">Instant Chat</h4>
                        <p class="text-secondary">Hubungi penemu secara langsung melalui fitur chat aman di dalam aplikasi.</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card feature-card h-100 p-4">
                        <div class="icon-box" style="background-color: #e9f7ef; color: #198754;">
                            <i class="bi bi-trophy"></i>
                        </div>
                        <h4 class="fw-bold">Milestone Badge</h4>
                        <p class="text-secondary">Dapatkan apresiasi dan tingkatkan kepercayaan user dengan badge kejujuran.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <footer class="py-5 border-top bg-light">
        <div class="container text-center">
            <p class="text-secondary mb-0">&copy; 2026 FoundIt - The Founder. All rights reserved.</p>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>