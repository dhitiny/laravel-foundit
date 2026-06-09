<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hasil Pencarian - FoundIt</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">

    <style>
        body { font-family: 'Poppins', sans-serif; background-color: #fdfbf7; color: #333; }
        
        /* NAVBAR FOUNDIT SINKRON (Warna #fdfbf7) */
        .navbar-foundit { background-color: #fdfbf7; padding: 15px 0; }
        .navbar-brand { font-weight: 800; font-size: 1.5rem; }
        
        .search-header { 
            background: linear-gradient(135deg, #041942 0%, #8b0000 100%); 
            color: white; padding: 50px 0; margin-bottom: 40px; 
        }

        .search-container-box {
            background: white; border-radius: 50px; padding: 8px;
            display: flex; align-items: center; box-shadow: 0 10px 30px rgba(0,0,0,0.2);
            max-width: 600px; margin: 0 auto;
        }

        .search-input-field { border: none; padding: 10px 25px; width: 100%; outline: none; border-radius: 50px; color: #333; }
        
        /* Desain Card List */
        .card-result { border: none; border-radius: 20px; transition: 0.3s; background: white; box-shadow: 0 5px 15px rgba(0,0,0,0.05); overflow: hidden; }
        .card-result:hover { transform: translateY(-2px); box-shadow: 0 8px 20px rgba(0,0,0,0.08); }
        
        /* Pembungkus Gambar Biar Simetris */
        .img-search-container { width: 90px; height: 90px; background-color: #f8f9fa; display: flex; align-items: center; justify-content: center; border-radius: 14px; overflow: hidden; flex-shrink: 0; }
        .img-search { width: 100%; height: 100%; object-fit: cover; }
        
        /* Style Custom Nav Tabs Switch */
        .nav-pills-custom { max-width: 500px; margin: 0 auto 40px; background: white; padding: 8px; border-radius: 50px; box-shadow: 0 4px 15px rgba(0,0,0,0.04); }
        .nav-pills-custom .nav-link { border-radius: 50px; font-weight: 700; font-size: 13px; text-transform: uppercase; letter-spacing: 1px; padding: 12px 20px; color: #555 !important; transition: 0.3s; }
        .nav-pills-custom .nav-link:hover { background-color: #f8f9fa; }
        
        /* Warna aktif masing-masing Tab Switch */
        .nav-pills-custom .nav-link#hilang-tab.active { background-color: #8b0000 !important; color: white !important; }
        .nav-pills-custom .nav-link#temuan-tab.active { background-color: #041942 !important; color: white !important; }
    </style>
</head>
<body>

    <nav class="navbar navbar-expand-lg navbar-foundit sticky-top shadow-sm">
        <div class="container">
            <a class="navbar-brand d-flex align-items-center gap-2 text-decoration-none" href="/homepage" style="color: #750909;">
                <img src="{{ asset('images/logo-foundit.png') }}" alt="Logo FoundIt" height="32">
                <span>Found<span style="color: #212c6b;">It</span></span>
            </a>
            <a href="/homepage" class="btn btn-sm btn-secondary rounded-pill px-3 fw-semibold">
                <i class="bi bi-arrow-left"></i> Kembali ke Beranda
            </a>
        </div>
    </nav>

    <div class="search-header">
        <div class="container text-center">
            <h2 class="fw-bold mb-4">Hasil Pencarian</h2>
            <form action="{{ route('search.results') }}" method="GET">
                <div class="search-container-box">
                    <input type="text" name="query" class="search-input-field" placeholder="Cari barang lagi..." value="{{ $query }}">
                    <button type="submit" class="btn btn-danger rounded-pill px-4 py-2 me-1 fw-bold shadow-sm" style="background-color: #8b0000; border: none;">Cari</button>
                </div>
            </form>
            <p class="mt-3 opacity-75 fw-medium">Menampilkan hasil untuk: "<strong>{{ $query }}</strong>"</p>
        </div>
    </div>

    <div class="container mb-5" style="max-width: 800px;">
        
        <ul class="nav nav-pills nav-justified nav-pills-custom" id="searchTab" role="tablist">
            <li class="nav-item" role="presentation">
                <button class="nav-link active" id="hilang-tab" data-bs-toggle="tab" data-bs-target="#hilang-pane" type="button" role="tab" aria-controls="hilang-pane" aria-selected="true">
                    <i class="bi bi-exclamation-circle me-1"></i> Barang Hilang ({{ $barangHilang->count() }})
                </button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="temuan-tab" data-bs-toggle="tab" data-bs-target="#temuan-pane" type="button" role="tab" aria-controls="temuan-pane" aria-selected="false">
                    <i class="bi bi-check-circle me-1"></i> Barang Temuan ({{ $barangTemuan->count() }})
                </button>
            </li>
        </ul>

        <div class="tab-content" id="searchTabContent">
            
            <div class="tab-pane fade show active" id="hilang-pane" role="tabpanel" aria-labelledby="hilang-tab" tabindex="0">
                @forelse($barangHilang as $item)
                <div class="card card-result p-3 mb-3">
                    <div class="d-flex align-items-center gap-3">
                        <div class="img-search-container">
                            @if($item->foto_barang)
                                <img src="{{ asset('storage/'.$item->foto_barang) }}" class="img-search">
                            @else
                                <i class="bi bi-image text-muted fs-3"></i>
                            @endif
                        </div>
                        <div class="flex-grow-1">
                            <h6 class="fw-bold text-dark mb-1 text-capitalize">{{ $item->nama_barang }}</h6>
                            <p class="text-muted small mb-2"><i class="bi bi-geo-alt-fill text-danger me-1"></i> {{ $item->lokasi }}</p>
                            <a href="{{ route('barang.detail', $item->id_item) }}" class="btn btn-sm btn-outline-danger rounded-pill px-3 fw-semibold">Detail</a>
                        </div>
                    </div>
                </div>
                @empty
                <div class="text-center py-5 bg-white rounded-4 shadow-sm border text-muted">
                    <i class="bi bi-search d-block mb-2 fs-2 text-secondary"></i>
                    <span class="fst-italic">Barang hilang tidak ditemukan.</span>
                </div>
                @endforelse
            </div>

            <div class="tab-pane fade" id="temuan-pane" role="tabpanel" aria-labelledby="temuan-tab" tabindex="0">
                @forelse($barangTemuan as $item)
                <div class="card card-result p-3 mb-3">
                    <div class="d-flex align-items-center gap-3">
                        <div class="img-search-container">
                            @if($item->foto_barang)
                                <img src="{{ asset('storage/'.$item->foto_barang) }}" class="img-search">
                            @else
                                <i class="bi bi-image text-muted fs-3"></i>
                            @endif
                        </div>
                        <div class="flex-grow-1">
                            <h6 class="fw-bold text-dark mb-1 text-capitalize">{{ $item->nama_barang }}</h6>
                            <p class="text-muted small mb-2"><i class="bi bi-geo-alt-fill text-primary me-1"></i> {{ $item->lokasi }}</p>
                            <a href="{{ route('barang.detail', $item->id_item) }}" class="btn btn-sm btn-outline-primary rounded-pill px-3 fw-semibold" style="color: #041942; border-color: #041942;">Detail</a>
                        </div>
                    </div>
                </div>
                @empty
                <div class="text-center py-5 bg-white rounded-4 shadow-sm border text-muted">
                    <i class="bi bi-search d-block mb-2 fs-2 text-secondary"></i>
                    <span class="fst-italic">Barang temuan tidak ditemukan.</span>
                </div>
                @endforelse
            </div>

        </div>
    </div>

    <footer class="py-4 text-center bg-white border-top">
        <p class="text-muted small mb-0">&copy; 2026 FoundIt - The Founder</p>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>