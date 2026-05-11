<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Homepage - FoundIt</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;600;800&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">

    <style>
        body { 
            font-family: 'Poppins', sans-serif; 
            background-color: #f4f7f9; 
            color: #333;
        }
        .navbar-foundit {
            background-color: #041942;
            padding: 15px 0;
        }
        .navbar-brand { font-weight: 800; font-size: 1.5rem; color: white !important; }
        .nav-link { color: rgba(255,255,255,0.8) !important; font-weight: 500; }
        .nav-link:hover { color: white !important; }
        .profile-dropdown {
            background: white;
            border-radius: 12px;
            border: none;
            box-shadow: 0 10px 20px rgba(0,0,0,0.1);
        }

        /* Header n search */
        .hero-banner {
            background: linear-gradient(135deg, #001f3f 0%, #8b0000 100%);
            padding: 60px 0 120px;
            color: white;
            text-align: center;
        }

        .search-wrapper {
            max-width: 700px;
            margin: -35px auto 0;
            position: relative;
            z-index: 10;
        }
        .search-bar {
            background: white;
            border-radius: 50px;
            padding: 10px 25px;
            box-shadow: 0 15px 30px rgba(0,0,0,0.1);
            display: flex;
            align-items: center;
            border: 2px solid transparent;
            transition: 0.3s;
        }
        .search-bar:focus-within { border-color: #8b0000; }
        .search-input {
            border: none;
            width: 100%;
            padding: 10px;
            outline: none;
            font-size: 0.95rem;
        }
        .btn-search {
            background-color: #8b0000;
            color: white;
            border-radius: 50px;
            padding: 8px 25px;
            border: none;
            font-weight: 600;
        }

        /* card action lapor barang */
        .action-card {
            background: white;
            border-radius: 25px;
            padding: 30px;
            margin-top: 50px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.05);
        }
        .btn-report { border-radius: 12px; padding: 12px; font-weight: 600; transition: 0.3s; border: none; }
        .btn-lost { background-color: #8b0000; color: white; }
        .btn-found { background-color: #001f3f; color: white; }
        .item-card { border: none; border-radius: 18px; transition: 0.3s; background: white; box-shadow: 0 4px 12px rgba(0,0,0,0.05); overflow: hidden; }
        .item-card:hover { transform: translateY(-5px); }
        .img-wrapper { height: 150px; overflow: hidden; position: relative; }
        .img-wrapper img { width: 100%; height: 100%; object-fit: cover; }
    </style>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-foundit sticky-top">
        <div class="container">
            <a class="navbar-brand" href="#">FoundIt</a>
            <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <i class="bi bi-list text-white fs-2"></i>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0 ms-lg-4">
                    <li class="nav-item"><a class="nav-link active" href="/homepage">Beranda</a></li>
                    <li class="nav-item"><a class="nav-link" href="#laporBarang">Lapor Barang</a></li>
                    <li class="nav-item"><a class="nav-link" href="#smartMatching">Smart Matching</a></li>
                </ul>
                <div class="dropdown">
                    <a class="nav-link dropdown-toggle d-flex align-items-center gap-2" href="#" role="button" data-bs-toggle="dropdown">
                        <img src="https://ui-avatars.com/api/?name={{ auth()->user()->username }}&background=8b0000&color=fff" class="rounded-circle" width="35">
                        <span class="text-white d-none d-lg-inline">{{ auth()->user()->username}}</span>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end profile-dropdown p-2 mt-2">
                        <li><a class="dropdown-item rounded-3 py-2" href="/profile"><i class="bi bi-person me-2"></i> Profil Saya</a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="dropdown-item rounded-3 py-2 text-danger"><i class="bi bi-box-arrow-right me-2"></i> Keluar</button>
                            </form>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </nav>
    <div class="hero-banner">
        <div class="container">
            <h1 class="display-5 fw-bold">Selamat Datang, {{ auth()->user()->username }}! 🔎</h1>
            <p class="fs-5 opacity-75">Sudahkah kamu mengecek barangmu hari ini?</p>
        </div>
    </div>
    <div class="container" id="laporBarang">
        <div class="search-wrapper">
            <form action="{{ route('search.results') }}" method="GET" class="search-bar shadow">
                <i class="bi bi-search text-muted ms-2"></i>
                <input type="text" name="query" class="search-input" placeholder="Cari barang (contoh: Kunci motor, KTM, Helm)...">
                <button type="submit" class="btn-search">Cari</button>
            </form>
        </div>
    </div>
    <div class="laporBarang">
        <div class="container">
            <div class="action-card mb-5">
                <div class="row text-center align-items-center">
                    <div class="col-md-5">
                        <h4 class="fw-bold mb-3">Kehilangan Barang?</h4>
                        <p class="text-muted mb-4">Buat laporan kehilangan agar sistem bisa mencocokkan dengan temuan orang lain.</p>
                        <a href="/PostBarangHilang/create" class="btn btn-report-lost w-100">Lapor Barang Hilang</a>
                    </div>
                    <div class="col-md-2">
                        <div class="vr d-none d-md-block mx-auto" style="height: 100px;"></div>
                        <hr class="d-md-none">
                    </div>
                    <div class="col-md-5">
                        <h4 class="fw-bold mb-3">Menemukan Barang?</h4>
                        <p class="text-muted mb-4">Bantu orang lain mendapatkan kembali barangnya dengan mengunggah temuanmu.</p>
                        <a href="/PostBarangTemuan/create" class="btn btn-report-found w-100">Lapor Barang Temuan</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="smartMatching" id="smartMatching">
    <div class="container"> <div class="mb-5">
            <div class="d-flex justify-content-between align-items-end mb-4">
                <h3 class="section-title mb-0">Smart Matching: Barang Hilang</h3>
                <a href="/searchpage" class="text-danger fw-bold text-decoration-none small">Lihat Semua →</a>
            </div>
            <div class="row g-4">
                @forelse($barangHilang as $item)
                <div class="col-md-3">
                    <div class="card item-card h-100 shadow-sm border-0">
                        <span class="badge bg-danger badge-status text-white">LOST</span>
                        <img src="{{ $item->image ? asset('storage/'.$item->image) : 'https://via.placeholder.com/300x200?text=No+Image' }}" class="img-container" alt="">
                        <div class="card-body">
                            <h6 class="fw-bold mb-1 text-truncate">{{ $item->item_name }}</h6>
                            <p class="text-muted small mb-3"><i class="bi bi-geo-alt"></i> {{ $item->location }}</p>
                            <a href="{{ url('/PostBarangHilang/'.$item->id) }}" class="btn btn-sm btn-outline-danger w-100 rounded-pill">
                                Cek Detail
                            </a>
                        </div>
                    </div>
                </div>
                @empty
                    <p class="text-muted ps-3">Belum ada laporan barang hilang terbaru.</p>
                @endforelse
            </div>
        </div>

        <div class="mb-5">
            <div class="d-flex justify-content-between align-items-end mb-4">
                <h3 class="section-title mb-0" style="border-left-color: #001f3f;">Smart Matching: Barang Temuan</h3>
                <a href="/status-temuan" class="text-navy fw-bold text-decoration-none small" style="color: #001f3f;">Lihat Semua →</a>
            </div>
            <div class="row g-4">
                @forelse($barangTemuan as $item)
                <div class="col-md-3">
                    <div class="card item-card h-100 shadow-sm border-0">
                        <span class="badge bg-primary badge-status text-white">FOUND</span>
                        <img src="{{ $item->image ? asset('storage/'.$item->image) : 'https://via.placeholder.com/300x200?text=No+Image' }}" class="img-container" alt="">
                        <div class="card-body">
                            <h6 class="fw-bold mb-1 text-truncate">{{ $item->item_name }}</h6>
                            <p class="text-muted small mb-3"><i class="bi bi-geo-alt"></i> {{ $item->location }}</p>
                            <a href="{{ url('/PostBarangTemuan/'.$item->id) }}" class="btn btn-sm btn-outline-primary w-100 rounded-pill">
                                Cek Detail
                            </a>
                        </div>
                    </div>
                </div>
                @empty
                    <p class="text-muted ps-3">Belum ada laporan barang temuan terbaru.</p>
                @endforelse
            </div>
        </div>

    </div> </div> <footer class="py-4 text-center mt-5 bg-white border-top">
    <p class="text-muted small mb-0">&copy; 2026 FoundIt - The Founder</p>
</footer>
</html>