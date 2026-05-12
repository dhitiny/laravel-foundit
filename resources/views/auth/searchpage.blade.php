<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hasil Pencarian - FoundIt</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">

    <style>
        body { font-family: 'Poppins', sans-serif; background-color: #f4f7f9; }
        .navbar-foundit { background-color: #001f3f; padding: 15px 0; }
        .navbar-brand { font-weight: 800; color: white !important; }
        
        .search-header { 
            background: linear-gradient(135deg, #001f3f 0%, #8b0000 100%); 
            color: white; padding: 50px 0; margin-bottom: 40px; 
        }

        .search-container-box {
            background: white; border-radius: 50px; padding: 8px;
            display: flex; align-items: center; box-shadow: 0 10px 30px rgba(0,0,0,0.2);
            max-width: 600px; margin: 0 auto;
        }

        .search-input-field { border: none; padding: 10px 25px; width: 100%; outline: none; border-radius: 50px; }
        .card-result { border: none; border-radius: 20px; transition: 0.3s; background: white; box-shadow: 0 5px 15px rgba(0,0,0,0.05); margin-bottom: 15px; }
        .img-search { width: 80px; height: 80px; object-fit: cover; border-radius: 12px; }
        
        .title-lost { border-left: 5px solid #8b0000; color: #8b0000; padding-left: 15px; font-weight: 700; }
        .title-found { border-left: 5px solid #001f3f; color: #001f3f; padding-left: 15px; font-weight: 700; }
    </style>
</head>
<body>

    <nav class="navbar navbar-expand-lg navbar-foundit shadow-sm">
        <div class="container">
            <a class="navbar-brand" href="/homepage">FoundIt</a>
        </div>
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
    </nav>

    <div class="search-header">
        <div class="container text-center">
            <h2 class="fw-bold mb-4">Hasil Pencarian</h2>
            <form action="{{ route('search.results') }}" method="GET">
                <div class="search-container-box">
                    <input type="text" name="query" class="search-input-field" placeholder="Cari barang lagi..." value="{{ $query }}">
                    <button type="submit" class="btn btn-danger rounded-pill px-4 py-2 me-1 fw-bold">Cari</button>
                </div>
            </form>
            <p class="mt-3 opacity-75">Menampilkan hasil untuk: "<strong>{{ $query }}</strong>"</p>
        </div>
    </div>

    <div class="container mb-5">
        <div class="row g-4">
            
            <div class="col-lg-6">
                <h4 class="title-lost mb-4">Barang Hilang ({{ $barangHilang->count() }})</h4>
                @forelse($barangHilang as $item)
                <div class="card card-result p-3">
                    <div class="d-flex align-items-center gap-3">
                        <img src="{{ $item->image ? asset('storage/'.$item->image) : 'https://via.placeholder.com/150' }}" class="img-search">
                        <div class="flex-grow-1">
                            <h6 class="fw-bold mb-1">{{ $item->item_name }}</h6>
                            <p class="text-muted small mb-2"><i class="bi bi-geo-alt"></i> {{ $item->location }}</p>
                            <a href="{{ url('/PostBarangHilang/'.$item->id) }}" class="btn btn-sm btn-outline-danger rounded-pill px-3">Detail</a>
                        </div>
                    </div>
                </div>
                @empty
                <div class="alert alert-light border shadow-sm text-muted">Barang hilang tidak ditemukan.</div>
                @endforelse
            </div>

            <div class="col-lg-6">
                <h4 class="title-found mb-4">Barang Temuan ({{ $barangTemuan->count() }})</h4>
                @forelse($barangTemuan as $item)
                <div class="card card-result p-3">
                    <div class="d-flex align-items-center gap-3">
                        <img src="{{ $item->image ? asset('storage/'.$item->image) : 'https://via.placeholder.com/150' }}" class="img-search">
                        <div class="flex-grow-1">
                            <h6 class="fw-bold mb-1">{{ $item->item_name }}</h6>
                            <p class="text-muted small mb-2"><i class="bi bi-geo-alt"></i> {{ $item->location }}</p>
                            <a href="{{ url('/PostBarangTemuan/'.$item->id) }}" class="btn btn-sm btn-outline-primary rounded-pill px-3">Detail</a>
                        </div>
                    </div>
                </div>
                @empty
                <div class="alert alert-light border shadow-sm text-muted">Barang temuan tidak ditemukan.</div>
                @endforelse
            </div>

        </div>
    </div>

    <footer class="py-4 text-center mt-5 bg-white border-top">
        <p class="text-muted small mb-0">&copy; 2026 FoundIt - The Founder</p>
    </footer>

</body>
</html>
