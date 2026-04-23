<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FoundIt - Cari Barang</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { background-color: #f8f9fa; }
        .card-barang { transition: transform 0.2s; border: none; box-shadow: 0 4px 6px rgba(0,0,0,0.1); }
        .card-barang:hover { transform: translateY(-5px); }
        .header-section { background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white; padding: 40px 0; margin-bottom: 30px; }
    </style>
</head>
<body>

    <div class="header-section text-center">
        <div class="container">
            <h1 class="display-4 fw-bold">Cari Barang Hilang/Temuan</h1>
            <p class="lead">Platform FoundIt UPI Purwakarta</p>
        </div>
    </div>

    <div class="container">
        <div class="row justify-content-center mb-5">
            <div class="col-md-6">
                <div class="card p-4 shadow-sm">
                    <form action="{{ route('items.index') }}" method="GET">
                        <label class="form-label fw-bold">Filter Kategori</label>
                        <div class="input-group">
                            <select name="category" class="form-select" onchange="this.form.submit()">
                                <option value="">-- Semua Kategori --</option>
                                @foreach($categories as $cat)
                                    <option value="{{ $cat->id_kategori }}" {{ request('category') == $cat->id_kategori ? 'selected' : '' }}>
                                        {{ $cat->nama_kategori }}
                                    </option>
                                @endforeach
                            </select>
                            <button class="btn btn-primary" type="submit">Cari</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="row">
            @forelse($items as $item)
                <div class="col-md-4 mb-4">
                    <div class="card card-barang h-100">
                        <div class="card-body">
                            <div class="d-flex justify-content-between">
                                <h5 class="card-title fw-bold text-primary">{{ $item->nama_barang }}</h5>
                                <span class="badge {{ $item->status == 'Hilang' ? 'bg-danger' : 'bg-success' }}">
                                    {{ $item->status }}
                                </span>
                            </div>
                            <p class="card-text text-muted">{{ Str::limit($item->deskripsi, 100) }}</p>
                        </div>
                        <div class="card-footer bg-white border-0">
                            <small class="text-muted">Lokasi: {{ $item->lokasi_temuan ?? 'Tidak ada data' }}</small>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12 text-center py-5">
                    <div class="alert alert-warning">
                        <h4 class="alert-heading">Maaf!</h4>
                        <p>Barang tidak ditemukan untuk kategori ini.</p>
                    </div>
                </div>
            @endforelse
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>