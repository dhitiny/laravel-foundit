<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin FoundIt - Manajemen Postingan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .img-preview { 
            width: 60px; 
            height: 60px; 
            object-fit: cover; 
            border-radius: 8px; 
            background-color: #f0f0f0; 
            border: 1px solid #ddd;
        }
        .table-hover tbody tr:hover { background-color: #f8f9fa; }
        .badge { padding: 8px 12px; }
    </style>
</head>
<body class="bg-light">

<div class="container-fluid mt-5 px-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3 class="fw-bold text-dark m-0">Daftar Antrean Postingan Barang</h3>
        <span class="badge bg-dark text-white">{{ count($semua_barang) }} Total Postingan</span>
    </div>
    
    @if(session('success')) 
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div> 
    @endif

    @if(session('error')) 
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div> 
    @endif

    <div class="card border-0 shadow-sm overflow-hidden">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="table-primary text-dark">
                    <tr>
                        <th class="ps-4">Foto</th>
                        <th>Nama Barang</th>
                        <th>Kategori</th>
                        <th>Lokasi</th>
                        <th>Waktu</th>
                        <th>Status</th>
                        <th class="text-center pe-4">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($semua_barang as $item)
                    <tr>
                        <td class="ps-4">
                            @if($item->foto_barang)
                                <img src="{{ asset('storage/' . $item->foto_barang) }}" class="img-preview" alt="Foto">
                            @else
                                <div class="img-preview d-flex align-items-center justify-content-center small text-muted text-center">No Image</div>
                            @endif
                        </td>
                        <td>
                            <div class="fw-bold">{{ $item->nama_barang }}</div>
                            <small class="text-muted">CP: {{ $item->cp ?? '-' }}</small>
                        </td>
                        <td><span class="badge bg-light text-dark border">ID Kat: {{ $item->id_kategori }}</span></td>
                        <td><small>{{ $item->lokasi_temuan }}</small></td>
                        <td><small>{{ \Carbon\Carbon::parse($item->tanggal_temuan)->format('d M Y') }}</small></td>
                        <td>
                            @if($item->status == 'Approved')
                                <span class="badge bg-success text-white">Disetujui</span>
                            @elseif($item->status == 'Rejected')
                                <span class="badge bg-danger text-white">Ditolak</span>
                            @elseif($item->status == 'Selesai')
                                <span class="badge bg-primary text-white">Selesai</span>
                            @else
                                <span class="badge bg-warning text-dark">{{ $item->status }}</span>
                            @endif
                        </td>
                        <td class="text-center pe-4">
                            <div class="btn-group gap-1">
                                <a href="{{ route('admin.postingan.terima', $item->id_item) }}" 
                                   class="btn btn-sm btn-outline-success px-3">Acc</a>
                                
                                <a href="{{ route('admin.postingan.tolak', $item->id_item) }}" 
                                   class="btn btn-sm btn-outline-danger px-3">Tolak</a>
                                
                                <a href="{{ route('admin.postingan.selesai', $item->id_item) }}" 
                                   class="btn btn-sm btn-outline-primary px-3">Selesai</a>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="text-center py-5">
                            <div class="text-muted">
                                <p class="mb-0">Belum ada postingan yang masuk.</p>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <div class="mt-4 mb-5">
        <a href="/dashboard" class="btn btn-outline-secondary btn-sm px-4">Kembali ke Dashboard</a>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>