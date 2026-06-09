<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Post Barang Temuan - FoundIt</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">

    <style>
        body { font-family: 'Poppins', sans-serif; background-color: #f7f1e6; color: #333; }
        
        /* NAVBAR FOUNDIT UPDATE (Warna Krem) */
        .navbar-foundit { background-color: #f7f1e6; padding: 15px 0; }
        .navbar-brand { font-weight: 800; font-size: 1.5rem; }
        .nav-link { color: #001f3f !important; font-weight: 600; transition: 0.2s; }
        .nav-link:hover { color: #8b0000 !important; }
        
        /* BANNER HEADER - Biru Solid Tema FoundIt Temuan */
        .header-banner { background-color: #041942; color: white; padding: 40px 0 100px 0; margin-bottom: -60px; }
        
        /* CARD OVERLAP EFFECT */
        .card-custom { border: none; border-radius: 20px; box-shadow: 0 10px 30px rgba(0,0,0,0.08); background: white; }
        .form-control:focus, .form-select:focus { border-color: #041942; box-shadow: 0 0 0 0.25rem rgba(4, 25, 66, 0.15); }
        
        .btn-submit { background-color: #041942; color: white; font-weight: 600; border-radius: 50px; padding: 10px 24px; transition: 0.2s; border: none; }
        .btn-submit:hover { background-color: #0b255c; color: white; }
        .btn-cancel { border-radius: 50px; padding: 10px 24px; font-weight: 600; }
    </style>
</head>
<body>

    <!-- Navbar Sinkron dengan Halaman Profil & Laporan Hilang -->
    <nav class="navbar navbar-expand-lg navbar-foundit sticky-top">
        <div class="container">
            <a class="navbar-brand d-flex align-items-center gap-2 text-decoration-none" href="/homepage" style="color: #750909;">
                <img src="{{ asset('images/logo-foundit.png') }}" alt="Logo FoundIt" height="32" class="d-inline-block align-text-top">
                <span>Found<span style="color: #212c6b;">It</span></span>
            </a>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0 ms-lg-4">
                    <li class="nav-item"><a class="nav-link" href="/homepage">Beranda</a></li>
                    <li class="nav-item"><a class="nav-link" href="/homepage#laporBarang">Lapor Barang</a></li>
                    <li class="nav-item"><a class="nav-link" href="/homepage#smartMatching">Smart Matching</a></li>
                    <li class="nav-item"><a class="nav-link" href="/badgeInfo">Badge</a></li>
                </ul>
                
                <!-- Dropdown Profil User (Nama menjadi warna Navy) -->
                <div class="dropdown">
                    <a class="nav-link dropdown-toggle d-flex align-items-center gap-2" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        @if(auth()->user()->foto_profil)
                            <img src="{{ asset('storage/' . auth()->user()->foto_profil) }}" class="rounded-circle" width="35" height="35" style="object-fit: cover;">
                        @else
                            <img src="https://ui-avatars.com/api/?name={{ auth()->user()->username }}&background=041942&color=fff" class="rounded-circle" width="35" height="35">
                        @endif
                        <span class="fw-semibold" style="color: #001f3f;">{{ auth()->user()->username }}</span>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end shadow-sm border-0 py-2 mt-2">
                        <li>
                            <a href="{{ route('auth.statustemuanuser') }}" class="btn btn-outline-primary btn-sm rounded-pill px-3 fw-semibold shadow-sm mx-3 my-1 d-block text-center">
                                Selengkapnya <i class="bi bi-arrow-right-short ms-1"></i>
                            </a>
                        </li>
                        <li><hr class="dropdown-divider"></li>
                        <li>
                            <form method="POST" action="{{ route('logout') }}" class="m-0">
                                @csrf
                                <button type="submit" class="dropdown-item text-danger fw-semibold"><i class="bi bi-box-arrow-right me-2"></i>Keluar</button>
                            </form>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </nav>

    <!-- Sub-Header Info Laporan -->
    <div class="header-banner">
        <div class="container text-center text-md-start px-4">
            <h1 class="fw-bold"><i class="bi bi-megaphone-fill me-2"></i> Buat Laporan Barang Temuan</h1>
            <p class="text-white-50 m-0">Isi formulir di bawah dengan data sebenar-benarnya untuk membantu proses pencarian pemilik.</p>
        </div>
    </div>

    <!-- Area Konten Form -->
    <div class="container my-5">
        <div class="row justify-content-center">
            <div class="col-md-8">

                <div class="card card-custom p-4 p-md-5 border">
                    <form action="{{ route('PostBarangTemuan.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="mb-4">
                            <label for="item_name" class="form-label small fw-semibold text-secondary">Nama Barang</label>
                            <input type="text" name="item_name" id="item_name" value="{{ old('item_name') }}" placeholder="Misal: Kunci Motor Honda" class="form-control @error('item_name') is-invalid @enderror" required>
                            @error('item_name') 
                                <div class="invalid-feedback">{{ $message }}</div> 
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="location" class="form-label small fw-semibold text-secondary">Lokasi Ditemukan</label>
                            <input type="text" name="location" id="location" value="{{ old('location') }}" placeholder="Contoh: Kantin Lt. 2" class="form-control @error('location') is-invalid @enderror" required>
                            @error('location') 
                                <div class="invalid-feedback">{{ $message }}</div> 
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="found_date" class="form-label small fw-semibold text-secondary">Tanggal & Waktu Ditemukan</label>
                            <input type="datetime-local" name="found_date" id="found_date" value="{{ old('found_date') }}" class="form-control @error('found_date') is-invalid @enderror" required>
                            @error('found_date') 
                                <div class="invalid-feedback">{{ $message }}</div> 
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="kategori" class="form-label small fw-semibold text-secondary">Kategori Barang</label>
                            <select name="kategori" id="kategori" class="form-select @error('kategori') is-invalid @enderror" required>
                                <option value="">-- Pilih Kategori --</option>
                                <option value="Elektronik" {{ old('kategori') == 'Elektronik' ? 'selected' : '' }}>Elektronik</option>
                                <option value="Dokumen" {{ old('kategori') == 'Dokumen' ? 'selected' : '' }}>Dokumen / Kartu</option>
                                <option value="Aksesoris" {{ old('kategori') == 'Aksesoris' ? 'selected' : '' }}>Aksesoris</option>
                                <option value="Pakaian" {{ old('kategori') == 'Pakaian' ? 'selected' : '' }}>Pakaian</option>
                                <option value="Lainnya" {{ old('kategori') == 'Lainnya' ? 'selected' : '' }}>Lainnya</option>
                            </select>
                            @error('kategori') 
                                <div class="invalid-feedback">{{ $message }}</div> 
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="description" class="form-label small fw-semibold text-secondary">Deskripsi Barang</label>
                            <textarea name="description" id="description" rows="4" placeholder="Sebutkan ciri-ciri barang secara detail..." class="form-control @error('description') is-invalid @enderror" required>{{ old('description') }}</textarea>
                            @error('description') 
                                <div class="invalid-feedback">{{ $message }}</div> 
                            @enderror
                        </div>

                        <div class="mb-5">
                            <label for="image" class="form-label small fw-semibold text-secondary">Foto Barang (Opsional)</label>
                            <input type="file" name="image" id="image" class="form-control @error('image') is-invalid @enderror">
                            <div class="form-text italic text-muted" style="font-size: 11px;">*Format: JPG, PNG, JPEG (Max 2MB)</div>
                            @error('image') 
                                <div class="invalid-feedback d-block">{{ $message }}</div> 
                            @enderror
                        </div>

                        <div class="d-flex align-items-center justify-content-end gap-2 border-t pt-4">
                            <a href="{{ route('homepage') }}" class="btn btn-light btn-cancel text-muted">Batal</a>
                            <button type="submit" class="btn btn-submit shadow-sm">
                                <i class="bi bi-send-fill me-1"></i> Posting Sekarang
                            </button>
                        </div>

                    </form>
                </div>

            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>