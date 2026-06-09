<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hasil Pencarian - FoundIt</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght=300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">

    <style>
        body { font-family: 'Poppins', sans-serif; background-color: #f4f7f9; color: #333; }
        .navbar-foundit { background-color: #041942; padding: 15px 0; }
        .navbar-brand { font-weight: 800; font-size: 1.5rem; color: #750909 !important; }
        
        .search-header { 
            background: linear-gradient(135deg, #041942 0%, #8b0000 100%); 
            color: white; padding: 50px 0; margin-bottom: 40px; 
        }

        /* PERBAIKAN: Pembungkus Box Pencarian Supaya Tidak Saling Tendang */
        .search-container-box {
            background: white; 
            border-radius: 50px; 
            padding: 6px 12px;
            display: flex; 
            align-items: center; 
            box-shadow: 0 10px 30px rgba(0,0,0,0.2);
            max-width: 750px; 
            margin: 0 auto;
        }

        /* PERBAIKAN: Input text diatur flex-grow agar berbagi tempat dengan dropdown */
        .search-input-field { 
            border: none; 
            padding: 10px 15px; 
            flex-grow: 1; 
            min-width: 100px;
            outline: none; 
            border-radius: 50px; 
            color: #333; 
        }
        
        /* PERBAIKAN: Dropdown Select Kategori */
        .category-select-dropdown {
            border: none !important; 
            outline: none !important; 
            background: transparent !important; 
            color: #555;
            font-weight: 600; 
            font-size: 0.85rem; 
            cursor: pointer; 
            width: 150px; /* Dikunci ukurannya agar tidak gepeng */
            flex-shrink: 0;
            padding-right: 20px;
        }
        .category-select-dropdown:focus { box-shadow: none !important; border-color: transparent !important; }

        /* Desain Card List */
        .card-result { border: none; border-radius: 20px; transition: 0.3s; background: white; box-shadow: 0 5px 15px rgba(0,0,0,0.05); overflow: hidden; }
        .card-result:hover { transform: translateY(-2px); box-shadow: 0 8px 20px rgba(0,0,0,0.08); }
        
        /* Pembungkus Gambar Biar Simetris */
        .img-search-container { width: 90px; height: 90px; background-color: #f8f9fa; display: flex; align-items: center; justify-content: center; border-radius: 14px; overflow: hidden; flex-shrink: 0; }
        .img-search { max-width: 100%; max-height: 100%; object-fit: contain; padding: 5px; }
        
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

    <nav class="navbar navbar-expand-lg navbar-foundit shadow-sm">
        <div class="container">
            <a class="navbar-brand" href="/homepage">Found<span style="color: #212c6b;">It</span></a>
            <div class="dropdown">
                <a class="nav-link dropdown-toggle d-flex align-items-center gap-2" href="#" role="button" data-bs-toggle="dropdown">
                    @if(auth()->user()->foto_profil)
                        <img src="{{ asset('storage/' . auth()->user()->foto_profil) }}" class="rounded-circle" width="35" height="35" style="object-fit: cover;">
                    @else
                        <img src="https://ui-avatars.com/api/?name={{ auth()->user()->username }}&background=041942&color=fff" class="rounded-circle" width="35" height="35">
                    @endif
                    <span class="text-white d-none d-lg-inline fw-semibold">{{ auth()->user()->username }}</span>
                </a>
                <ul class="dropdown-menu dropdown-menu-end p-2 mt-2 border-0 shadow-sm">
                    <li><a class="dropdown-item rounded-3 py-2 fw-semibold" href="/myprofile"><i class="bi bi-person me-2"></i> Profil Saya</a></li>
                    <li><hr class="dropdown-divider"></li>
                    <li>
                        <form method="POST" action="{{ route('logout') }}" class="m-0">
                            @csrf
                            <button type="submit" class="dropdown-item rounded-3 py-2 text-danger fw-semibold"><i class="bi bi-box-arrow-right me-2"></i> Keluar</button>
                        </form>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="search-header">
        <div class="container text-center">
            <h2 class="fw-bold mb-4">Hasil Pencarian</h2>
            
            <form action="{{ route('search.results') }}" method="GET">
                <div class="search-container-box">
                    <i class="bi bi-search text-muted ms-2"></i>
                    
                    <input type="text" name="query" class="search-input-field" placeholder="Cari barang lagi..." value="{{ $query }}">
                    
                    <div class="border-start border-2 px-2 d-flex align-items-center" style="height: 25px;">
                        <select name="kategori" class="form-select category-select-dropdown">
                            <option value="">-- Semua Kategori --</option>
                            <option value="Elektronik" {{ (isset($kategoriDipilih) && $kategoriDipilih == 'Elektronik') ? 'selected' : '' }}>Elektronik</option>
                            <option value="Dokumen" {{ (isset($kategoriDipilih) && $kategoriDipilih == 'Dokumen') ? 'selected' : '' }}>Dokumen</option>
                            <option value="Aksesoris" {{ (isset($kategoriDipilih) && $kategoriDipilih == 'Aksesoris') ? 'selected' : '' }}>Aksesoris</option>
                            <option value="Pakaian" {{ (isset($kategoriDipilih) && $kategoriDipilih == 'Pakaian') ? 'selected' : '' }}>Pakaian</option>
                            <option value="Lainnya" {{ (isset($kategoriDipilih) && $kategoriDipilih == 'Lainnya') ? 'selected' : '' }}>Lainnya</option>
                        </select>
                    </div>

                    <button type="submit" class="btn btn-danger rounded-pill px-4 py-2 ms-2 fw-bold shadow-sm" style="background-color: #8b0000; border: none; flex-shrink: 0;">Cari</button>
                </div>
            </form>

            <p class="mt-3 opacity-75 fw-medium">
                Menampilkan hasil untuk: "<strong>{{ $query ?? 'Semua' }}</strong>"
                @if(!empty($kategoriDipilih)) di kategori "<strong>{{ $kategoriDipilih }}</strong>" @endif
            </p>
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
                            <p class="text-muted small mb-1"><i class="bi bi-geo-alt-fill text-danger me-1"></i> {{ $item->lokasi }}</p>
                            <span class="badge bg-secondary text-capitalize mb-2" style="font-size: 11px;">{{ $item->kategori }}</span>
                            <br>
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
                            <p class="text-muted small mb-1"><i class="bi bi-geo-alt-fill text-primary me-1"></i> {{ $item->lokasi }}</p>
                            <span class="badge bg-secondary text-capitalize mb-2" style="font-size: 11px;">{{ $item->kategori }}</span>
                            <br>
                            <a href="{{ route('barang.detail', $item->id_item) }}" class="btn btn-sm btn-outline-primary rounded-pill px-3 fw-semibold">Detail</a>
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