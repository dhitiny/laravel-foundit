<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Antrean Postingan Barang - FoundIt</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    <style>
        body { background-color: #f4f7f6; font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; }
        .table-container { background: white; padding: 30px; border-radius: 10px; box-shadow: 0 4px 6px rgba(0,0,0,0.05); }
        .thead-dark { background-color: #212529; color: white; }
        .btn-back { margin-bottom: 20px; }
    </style>
</head>
<body>

<div class="container mt-5">
    <h2 class="fw-bold mb-4">Daftar Antrean Postingan Barang</h2>

    <a href="{{ route('dashboard') }}" class="btn btn-outline-secondary btn-back btn-sm">
        <i class="bi bi-arrow-left"></i> Kembali ke Dashboard
    </a>

    <div class="card mb-4 border-0 shadow-sm">
        <div class="card-body">
            <form action="{{ route('items.index') }}" method="GET" class="row g-3 align-items-center">
                <div class="col-auto">
                    <label class="fw-bold">Filter Kategori:</label>
                </div>
                <div class="col-md-4">
                    <select name="category" class="form-select form-select-sm" onchange="this.form.submit()">
                        <option value="">-- Semua Kategori --</option>
                        @foreach($categories as $cat)
                            <option value="{{ $cat->id_kategori }}" {{ request('category') == $cat->id_kategori ? 'selected' : '' }}>
                                {{ $cat->nama_kategori }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </form>
        </div>
    </div>

    <div class="table-container">
        <div class="table-responsive">
            <table class="table table-hover align-middle">
                <thead class="thead-dark">
                    <tr>
                        <th>Foto</th>
                        <th>Nama Barang</th>
                        <th>Kategori</th>
                        <th>Deskripsi</th>
                        <th>Lokasi</th>
                        <th>Jenis</th>
                        <th>Waktu</th>
                        <th>Status</th>
                        <th class="text-center">Aksi Admin</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($items as $item)
                    <tr>
                        <td>
                            @if($item->foto_barang)
                                <img src="{{ asset('storage/' . $item->foto_barang) }}" width="50" class="rounded">
                            @else
                                <span class="badge bg-light text-dark border">No Image</span>
                            @endif
                        </td>
                        <td class="fw-bold">{{ $item->nama_barang }}</td>
                        <td>{{ $item->id_kategori }}</td>
                        <td>{{ Str::limit($item->deskripsi, 30) }}</td>
                        <td>{{ $item->lokasi_temuan }}</td>
                        <td>{{ $item->status }}</td> <td>{{ $item->tanggal_temuan }}</td>
                        <td>
                            <span class="badge {{ $item->status == 'Hilang' ? 'bg-danger' : 'bg-success' }}">
                                Terverifikasi
                            </span>
                        </td>
                        <td class="text-center">
                            <button class="btn btn-sm btn-info text-white"><i class="bi bi-eye"></i></button>
                            <button class="btn btn-sm btn-danger"><i class="bi bi-trash"></i></button>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="9" class="text-center py-5 text-muted">
                            <i class="bi bi-inbox fs-1 d-block mb-2"></i>
                            Belum ada data postingan masuk.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>