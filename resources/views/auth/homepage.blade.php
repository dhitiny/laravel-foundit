<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Homepage - FoundIt</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">

    <style>
        body { font-family: 'Poppins', sans-serif; background-color: #f4f7f9; color: #333; }
        .navbar-foundit { background-color: #041942; padding: 15px 0; }
        .navbar-brand { font-weight: 800; font-size: 1.5rem; color: white !important; }
        .nav-link { color: rgba(255,255,255,0.8) !important; font-weight: 500; }
        .nav-link:hover { color: white !important; }
        .hero-banner { background: linear-gradient(135deg, #001f3f 0%, #8b0000 100%); padding: 60px 0 120px; color: white; text-align: center; }
        .search-wrapper { max-width: 700px; margin: -35px auto 0; position: relative; z-index: 10; }
        .search-bar { background: white; border-radius: 50px; padding: 10px 25px; box-shadow: 0 15px 30px rgba(0,0,0,0.1); display: flex; align-items: center; }
        .search-input { border: none; width: 100%; padding: 10px; outline: none; }
        .btn-search { background-color: #8b0000; color: white; border-radius: 50px; padding: 8px 25px; border: none; font-weight: 600; }
        .action-card { background: white; border-radius: 25px; padding: 30px; margin-top: 50px; box-shadow: 0 10px 30px rgba(0,0,0,0.05); }
        .item-card { border: none; border-radius: 18px; transition: 0.3s; background: white; box-shadow: 0 4px 12px rgba(0,0,0,0.05); overflow: hidden; }
        .img-container { height: 180px; width: 100%; object-fit: cover; }
        .btn-report-lost { background-color: #8b0000; color: white; font-weight: 600; border-radius: 10px; padding: 10px; text-decoration: none; display: block; }
        .btn-report-found { background-color: #001f3f; color: white; font-weight: 600; border-radius: 10px; padding: 10px; text-decoration: none; display: block; }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-foundit sticky-top">
        <div class="container">
            <a class="navbar-brand" href="#">Found<span class="text-danger">It</span></a>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0 ms-lg-4">
                    <li class="nav-item"><a class="nav-link active" href="/homepage">Beranda</a></li>
                    <li class="nav-item"><a class="nav-link active" href="#laporBarang">Lapor Barang</a></li>
                    <li class="nav-item"><a class="nav-link active" href="#smartMatching">Smart Matching</a></li>
                </ul>
                <div class="dropdown">
                    <a class="nav-link dropdown-toggle d-flex align-items-center gap-2" href="#" role="button" data-bs-toggle="dropdown">
                        <img src="https://ui-avatars.com/api/?name={{ auth()->user()->username }}&background=8b0000&color=fff" class="rounded-circle" width="35">
                        <span class="text-white">{{ auth()->user()->username }}</span>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end">
                        <li><a class="dropdown-item" href="/profile">Profil</a></li>
                        <li>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="dropdown-item text-danger">Keluar</button>
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
            <form action="{{ route('search.results') }}" method="GET" class="search-bar">
                <i class="bi bi-search text-muted ms-2"></i>
                <input type="text" name="query" class="search-input" placeholder="Cari barang (contoh: Kunci motor, KTM, Helm)...">
                <button type="submit" class="btn-search">Cari</button>
            </form>
        </div>

        <div class="action-card mb-5">
            <div class="row text-center">
                <div class="col-md-5">
                    <h4 class="fw-bold">Kehilangan Barang?</h4>
                    <p class="text-muted">Buat laporan kehilangan barangmu sekarang.</p>
                    <a href="/PostBarangHilang/create" class="btn-report-lost">Lapor Barang Hilang</a>
                </div>
                <div class="col-md-2 d-none d-md-block"><div class="vr h-100 mx-auto"></div></div>
                <div class="col-md-5">
                    <h4 class="fw-bold">Menemukan Barang?</h4>
                    <p class="text-muted">Bantu orang lain mendapatkan kembali barangnya.</p>
                    <a href="/PostBarangTemuan/create" class="btn-report-found">Lapor Barang Temuan</a>
                </div>
            </div>
        </div>
    </div>
    <div class="container py-5" id="smartMatching">
    <h3 class="mb-4 fw-bold text-danger">Barang Hilang</h3>
        <div class="row g-4 mb-5">
            @forelse($barangHilang as $item)
                <div class="col-sm-6 col-md-4 col-lg-3">
                    <div class="card item-card h-100 shadow-sm border-0 rounded-4 overflow-hidden">
                        <img src="{{ $item->foto_barang ? asset('storage/'.$item->foto_barang) : 'https://via.placeholder.com/300x200?text=No+Image' }}" 
                            class="card-img-top" style="height: 200px; object-fit: cover;">
                        <div class="card-body d-flex flex-column">
                            <h6 class="fw-bold mb-2">{{ $item->nama_barang }}</h6>
                            <p class="text-muted small mb-3">
                                <i class="bi bi-geo-alt-fill text-danger"></i> {{ $item->lokasi }}
                            </p>
                            <div class="mt-auto">
                                <a href="{{ route('barang.detail', $item->id_item) }}" class="btn btn-sm btn-outline-danger w-100 rounded-pill">Detail</a>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12">
                    <p class="text-muted italic text-center py-4 bg-light rounded-3">Belum ada laporan barang hilang.</p>
                </div>
            @endforelse
        </div>

        <hr class="my-5 border-2 opacity-10">

        <h3 class="mb-4 fw-bold style="color: #000080;">Barang Temuan</h3>
        <div class="row g-4 mb-5">
            @forelse($barangTemuan as $item)
                <div class="col-sm-6 col-md-4 col-lg-3">
                    <div class="card item-card h-100 shadow-sm border-0 rounded-4 overflow-hidden">
                        <img src="{{ $item->foto_barang ? asset('storage/'.$item->foto_barang) : 'https://via.placeholder.com/300x200?text=No+Image' }}" 
                            class="card-img-top" style="height: 200px; object-fit: cover;">
                        <div class="card-body d-flex flex-column">
                            <h6 class="fw-bold mb-2">{{ $item->nama_barang }}</h6>
                            <p class="text-muted small mb-3">
                                <i class="bi bi-geo-alt-fill text-primary"></i> {{ $item->lokasi }}
                            </p>
                            <div class="mt-auto">
                                <a href="{{ route('barang.detail', $item->id_item) }}" class="btn btn-sm btn-outline-primary w-100 rounded-pill">Detail</a>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12">
                    <p class="text-muted italic text-center py-4 bg-light rounded-3">Belum ada laporan barang temuan.</p>
                </div>
            @endforelse
        </div>
    </div>

    <footer class="py-4 text-center mt-5 bg-white border-top">
        <p class="text-muted small mb-0">&copy; 2026 FoundIt - The Founder</p>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>