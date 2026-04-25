<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin FoundIt - Manajemen Postingan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .img-preview { width: 60px; height: 60px; object-fit: cover; border-radius: 8px; background-color: #f0f0f0; border: 1px solid #ddd; }
        .table-hover tbody tr:hover { background-color: #f8f9fa; }
        .badge { padding: 8px 12px; font-size: 0.75rem; }
        .text-small { font-size: 0.85rem; color: #444; }
        .desc-column { max-width: 200px; font-size: 0.8rem; color: #666; }
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

    <div class="card border-0 shadow-sm overflow-hidden">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="table-primary text-dark">
                    <tr>
                        <th class="ps-4">Foto</th>
                        <th>ID</th>
                        <th>Nama Barang</th>
                        <th>Deskripsi</th>
                        <th>Lokasi</th>
                        <th>Waktu</th>
                        <th>Status</th>
                        <th>Status Admin</th>
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
                                <div class="img-preview d-flex align-items-center justify-content-center small text-muted text-center">No Pic</div>
                            @endif
                        </td>

                        <td class="fw-bold text-muted">#{{ $item->id_item }}</td>

                        <td class="fw-bold text-primary">{{ $item->nama_barang }}</td>

                        <td class="desc-column text-truncate">
                            {{ Str::limit($item->deskripsi, 50, '...') ?? 'Tidak ada deskripsi' }}
                        </td>

                        <td class="text-small">{{ $item->lokasi_temuan }}</td>

                        <td class="text-small">{{ $item->tanggal_temuan }}</td>

                        <td class="text-uppercase fw-medium" style="font-size: 0.85rem;">
    {{ $item->status }}
</td>

                        <td>
                            @if($item->status_admin == 'Approved')
                                <span class="badge bg-success text-white">Disetujui</span>
                            @elseif($item->status_admin == 'Rejected')
                                <span class="badge bg-danger text-white">Ditolak</span>
                            @elseif($item->status_admin == 'Selesai')
                                <span class="badge bg-primary text-white">Selesai</span>
                            @else
                                <span class="badge bg-secondary text-white">{{ $item->status_admin ?? 'Pending' }}</span>
                            @endif
                        </td>

                        <td class="text-center pe-4">
                            <div class="btn-group gap-1">
                                <a href="{{ route('admin.postingan.terima', $item->id_item) }}" 
                                   class="btn btn-sm btn-outline-success px-2">Acc</a>
                                
                                <a href="{{ route('admin.postingan.tolak', $item->id_item) }}" 
                                   class="btn btn-sm btn-outline-danger px-2">Tolak</a>
                                
                                <a href="{{ route('admin.postingan.selesai', $item->id_item) }}" 
                                   class="btn btn-sm btn-outline-primary px-2">Selesai</a>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="9" class="text-center py-5 text-muted">Belum ada postingan yang masuk.</td>
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