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
        body { font-family: 'Poppins', sans-serif; background-color: #f7f1e6; color: #333; }
        .navbar-foundit { background-color: #f7f1e6; padding: 15px 0; }
        .navbar-brand { font-weight: 800; font-size: 1.5rem; }
        .nav-link { color: #001f3f !important; font-weight: 600; }
        .nav-link:hover { color: #8b0000 !important; }
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
            <a class="navbar-brand d-flex align-items-center gap-2" href="/homepage" style="color: #750909;">
                <img src="{{ asset('images/logo-foundit.png') }}" alt="Logo FoundIt" height="32" class="d-inline-block align-text-top">
                <span>Found<span style="color: #212c6b;">It</span></span>
            </a>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0 ms-lg-4">
                    <li class="nav-item"><a class="nav-link active" href="/homepage">Beranda</a></li>
                    <li class="nav-item"><a class="nav-link" href="#laporBarang">Lapor Barang</a></li>
                    <li class="nav-item"><a class="nav-link" href="#smartMatching">Smart Matching</a></li>
                    <li class="nav-item"><a class="nav-link" href="/badgeInfo">Badge</a></li>
                </ul>
                <div class="dropdown">
                    <a class="nav-link dropdown-toggle d-flex align-items-center gap-2" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        @if(auth()->user()->foto_profil)
                            <img src="{{ asset('storage/' . auth()->user()->foto_profil) }}" class="rounded-circle" width="35" height="35" style="object-fit: cover;">
                        @else
                            <img src="https://ui-avatars.com/api/?name={{ auth()->user()->username }}&background=8b0000&color=fff" class="rounded-circle" width="35" height="35">
                        @endif
                        <span style="color: #001f3f" class="fw-semibold">{{ auth()->user()->username }}</span>
                    </a>
                    
                    <ul class="dropdown-menu dropdown-menu-end shadow-sm border-0 py-2 mt-2">
                        <li>
                            <a href="{{ route('profile.myprofile') }}" class="dropdown-item fw-semibold text-primary">
                                <i class="bi bi-person-fill me-2"></i>Profile
                            </a>
                        </li>
                        <li><hr class="dropdown-divider"></li>
                        <li>
                            <form method="POST" action="{{ route('logout') }}" class="m-0">
                                @csrf
                                <button type="submit" class="dropdown-item text-danger fw-semibold border-0 bg-transparent w-100 text-start">
                                    <i class="bi bi-box-arrow-right me-2"></i>Keluar
                                </button>
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
        
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h3 class="fw-bold text-danger m-0">Barang Hilang</h3>
            <a href="/barang-hilang" class="btn btn-sm btn-outline-danger rounded-pill px-3 fw-semibold">
                Lihat Semua <i class="bi bi-arrow-right ms-1"></i>
            </a>
        </div>

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
                                <a href="{{ route('barang.detail', $item->id_item) }}" class="btn btn-sm btn-outline-danger w-100 rounded-pill fw-semibold">Detail</a>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12">
                    <p class="text-muted fst-italic text-center py-4 bg-light rounded-3">Belum ada laporan barang hilang.</p>
                </div>
            @endforelse
        </div>

        <hr class="my-5 border-2 opacity-10">

        <div class="d-flex justify-content-between align-items-center mb-4">
            <h3 class="fw-bold m-0" style="color: #000080;">Barang Temuan</h3>
            <a href="/barang-temuan" class="btn btn-sm btn-outline-primary rounded-pill px-3 fw-semibold" style="color: #000080; border-color: #000080;">
                Lihat Semua <i class="bi bi-arrow-right ms-1"></i>
            </a>
        </div>

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
                                <a href="{{ route('barang.detail', $item->id_item) }}" class="btn btn-sm btn-outline-primary w-100 rounded-pill fw-semibold" style="color: #000080; border-color: #000080;">Detail</a>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12">
                    <p class="text-muted fst-italic text-center py-4 bg-light rounded-3">Belum ada laporan barang temuan.</p>
                </div>
            @endforelse
        </div>
    </div>

    <section id="smartMatching" class="py-5 bg-light border-top border-bottom">
    <div class="container">
            
            <div class="d-flex align-items-center justify-content-between mb-4">
                <div>
                    <h3 class="fw-bold text-dark m-0">
                        <i class="bi bi-cpu-fill text-primary me-2"></i>Smart Matching AI
                    </h3>
                    <p class="text-muted small m-0">Rekomendasi barang temuan yang mirip dengan laporan kehilangan kamu.</p>
                </div>
                <span class="badge bg-primary bg-opacity-10 text-primary border border-primary border-opacity-25 rounded-pill px-3 py-2 fw-semibold">
                    Automated Match
                </span>
            </div>

            @auth
                @if($rekomendasiTemuan->isNotEmpty())
                    <div class="row g-4">
                        @foreach($rekomendasiTemuan as $temuan)
                            <div class="col-sm-6 col-md-4 col-lg-3">
                                <div class="card h-100 border-0 shadow-sm rounded-4 overflow-hidden position-relative bg-white transition-hover">
                                    
                                    <span class="position-absolute top-0 start-0 m-3 badge bg-dark bg-opacity-75 text-uppercase fw-bold" style="font-size: 10px; z-index: 2;">
                                        {{ $temuan->kategori }}
                                    </span>

                                    <div class="position-relative bg-light d-flex align-items-center justify-content-center" style="height: 180px;">
                                        @if($temuan->foto_barang)
                                            <img src="{{ asset('storage/' . $temuan->foto_barang) }}" class="w-100 h-100" style="object-fit: cover;">
                                        @else
                                            <div class="text-center text-muted">
                                                <i class="bi bi-image fs-1 d-block opacity-50"></i>
                                                <span style="font-size: 11px;">Tidak ada foto</span>
                                            </div>
                                        @endif
                                    </div>

                                    <div class="card-body p-3 d-flex flex-column justify-content-between">
                                        <div>
                                            <h6 class="fw-bold text-dark text-truncate mb-1">{{ $temuan->nama_barang }}</h6>
                                            <p class="text-muted small text-truncate-2 mb-3" style="font-size: 0.8rem; height: 38px; display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden; white-space: normal;">
                                                {{ $temuan->deskripsi ?? 'Tidak ada deskripsi ciri fisik.' }}
                                            </p>
                                        </div>

                                        <div class="border-top pt-2">
                                            <div class="d-flex align-items-center text-secondary small mb-1">
                                                <i class="bi bi-geo-alt-fill text-success me-1"></i>
                                                <span class="text-truncate">{{ $temuan->lokasi }}</span>
                                            </div>
                                            <div class="text-muted italic mb-3" style="font-size: 0.7rem;">
                                                <i class="bi bi-calendar3 me-1"></i>{{ \Carbon\Carbon::parse($temuan->tanggal_kejadian)->diffForHumans() }}
                                            </div>
                                            
                                            <a href="/barang/detail/{{ $temuan->id_item }}" class="btn btn-primary btn-sm w-100 rounded-pill fw-semibold shadow-sm">
                                                Lihat Detail <i class="bi bi-arrow-right-short ms-1"></i>
                                            </a>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <div class="text-center py-5 px-3 bg-white border rounded-4 shadow-sm">
                        <div class="p-3 bg-secondary bg-opacity-10 text-secondary rounded-circle d-inline-block mb-3">
                            <i class="bi bi-search-heart fs-1"></i>
                        </div>
                        <h5 class="fw-bold text-dark">Belum Ada Kecocokan</h5>
                        <p class="text-muted small mx-auto" style="max-width: 450px;">
                            Sistem Smart Matching belum menemukan barang temuan yang mirip dengan properti barang hilangmu saat ini, atau kamu belum membuat laporan kehilangan.
                        </p>
                        <a href="#laporBarang" class="btn btn-sm btn-outline-danger rounded-pill px-4 fw-semibold mt-2">
                            Buat Laporan Sekarang
                        </a>
                    </div>
                @endif
            @else
                <div class="text-center py-5 px-3 bg-white border rounded-4 shadow-sm">
                    <div class="p-3 bg-warning bg-opacity-10 text-warning rounded-circle d-inline-block mb-3">
                        <i class="bi bi-lock-fill fs-2"></i>
                    </div>
                    <h5 class="fw-bold text-dark">Fitur Terkunci</h5>
                    <p class="text-muted small mx-auto" style="max-width: 400px;">
                        Silakan masuk akun terlebih dahulu untuk melihat rekomendasi otomatis pencocokan barang temuan secara *real-time*.
                    </p>
                    <a href="/login" class="btn btn-sm btn-dark rounded-pill px-4 fw-semibold mt-1">
                        Masuk Akun
                    </a>
                </div>
            @endauth

        </div>
    </section>

    <footer class="py-4 text-center mt-5 bg-white border-top">
        <p class="text-muted small mb-0">&copy; 2026 FoundIt - The Founder</p>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>