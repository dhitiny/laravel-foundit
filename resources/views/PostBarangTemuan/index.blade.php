<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Semua Barang Temuan - FoundIt</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    <style>
        body { font-family: 'Poppins', sans-serif; background-color: #fdfbf7; color: #333; }
        
        /* NAVBAR FOUNDIT UPDATE */
        .navbar-foundit { background-color: #fdfbf7; padding: 15px 0; }
        .navbar-brand { font-weight: 800; font-size: 1.5rem; }
        
        .item-card { border: none; border-radius: 18px; transition: 0.3s; background: white; box-shadow: 0 4px 12px rgba(0,0,0,0.05); overflow: hidden; }
        
        /* Style kustom untuk Tab Switch */
        .nav-pills .nav-link { color: #666; font-weight: 600; border-radius: 50px; padding: 10px 25px; transition: 0.3s; }
        .nav-pills .nav-link.active-hilang.active { background-color: #8b0000 !important; color: white !important; }
        .nav-pills .nav-link.active-temuan.active { background-color: #041942 !important; color: white !important; }
    </style>
</head>
<body>

    <!-- Navbar Minimalis -->
    <nav class="navbar navbar-expand-lg navbar-foundit sticky-top shadow-sm mb-4">
        <div class="container">
            <a class="navbar-brand d-flex align-items-center gap-2 text-decoration-none" href="/homepage" style="color: #750909;">
                <img src="{{ asset('images/logo-foundit.png') }}" alt="Logo FoundIt" height="32">
                <span>Found<span style="color: #212c6b;">It</span></span>
            </a>
            <a href="/homepage" class="btn btn-sm btn-secondary rounded-pill px-3 fw-semibold"><i class="bi bi-arrow-left"></i> Kembali ke Beranda</a>
        </div>
    </nav>

    <div class="container py-4">
        
        <!-- Header & Tab Switcher (Sama Persis dengan Halaman Hilang, tapi Set Active ke Temuan) -->
        <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3 mb-5">
            <h3 class="fw-bold m-0" style="color: #041942;"><i class="bi bi-check-circle-fill"></i> Semua Laporan Barang Temuan</h3>
            
            <ul class="nav nav-pills bg-white p-1 rounded-pill shadow-sm" id="pills-tab" role="tablist">
                <li class="nav-item" role="presentation">
                    <button class="nav-link active-hilang" id="pills-hilang-tab" data-bs-toggle="pill" data-bs-target="#pills-hilang" type="button" role="tab" aria-controls="pills-hilang" aria-selected="false">
                        <i class="bi bi-exclamation-circle-fill me-1"></i> Barang Hilang
                    </button>
                </li>
                <li class="nav-item" role="presentation">
                    <!-- FIXED: data-bs-toggle & data-bs-target sudah dipasang kembali -->
                    <button class="nav-link active active-temuan" id="pills-temuan-tab" data-bs-toggle="pill" data-bs-target="#pills-temuan" type="button" role="tab" aria-controls="pills-temuan" aria-selected="true">
                        <i class="bi bi-check-circle-fill me-1"></i> Barang Temuan
                    </button>
                </li>
            </ul>
        </div>

        <div class="tab-content" id="pills-tabContent">
            
            <!-- Tab Barang Hilang -->
            <div class="tab-pane fade" id="pills-hilang" role="tabpanel" aria-labelledby="pills-hilang-tab">
                <div class="row g-4">
                    @forelse($barangHilang ?? [] as $item)
                        <div class="col-sm-6 col-md-4 col-lg-3">
                            <div class="card item-card h-100 shadow-sm border-0 rounded-4 overflow-hidden">
                                <img src="{{ $item->foto_barang ? asset('storage/'.$item->foto_barang) : 'https://via.placeholder.com/300x200?text=No+Image' }}" class="card-img-top" style="height: 200px; object-fit: cover;">
                                <div class="card-body d-flex flex-column">
                                    <h6 class="fw-bold mb-2">{{ $item->nama_barang }}</h6>
                                    <p class="text-muted small mb-3"><i class="bi bi-geo-alt-fill text-danger"></i> {{ $item->lokasi }}</p>
                                    <div class="mt-auto">
                                        <a href="{{ route('barang.detail', $item->id_item) }}" class="btn btn-sm btn-outline-danger w-100 rounded-pill fw-semibold">Detail</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="col-12 text-center py-5 bg-white rounded-4 shadow-sm">
                            <p class="text-muted fst-italic m-0">Belum ada laporan barang hilang.</p>
                        </div>
                    @endforelse
                </div>
            </div>

            <!-- Tab Barang Temuan (Active Default Terbuka Otomatis) -->
            <div class="tab-pane fade show active" id="pills-temuan" role="tabpanel" aria-labelledby="pills-temuan-tab">
                <div class="row g-4">
                    @forelse($barangTemuan as $item)
                        <div class="col-sm-6 col-md-4 col-lg-3">
                            <div class="card item-card h-100 shadow-sm border-0 rounded-4 overflow-hidden">
                                <img src="{{ $item->foto_barang ? asset('storage/'.$item->foto_barang) : 'https://via.placeholder.com/300x200?text=No+Image' }}" class="card-img-top" style="height: 200px; object-fit: cover;">
                                <div class="card-body d-flex flex-column">
                                    <h6 class="fw-bold mb-2">{{ $item->nama_barang }}</h6>
                                    <p class="text-muted small mb-3"><i class="bi bi-geo-alt-fill text-primary"></i> {{ $item->lokasi }}</p>
                                    <div class="mt-auto">
                                        <a href="{{ route('barang.detail', $item->id_item) }}" class="btn btn-sm btn-outline-primary w-100 rounded-pill fw-semibold" style="color: #041942; border-color: #041942;">Detail</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="col-12 text-center py-5 bg-white rounded-4 shadow-sm">
                            <p class="text-muted fst-italic m-0">Belum ada laporan barang temuan.</p>
                        </div>
                    @endforelse
                </div>
            </div>

        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>