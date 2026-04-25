<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Status Postingan Hilang - FoundIt</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    
    <style>
        /* Mencegah halaman bisa digeser ke kanan-kiri (Fix Scroll Horizontal) */
        html, body {
            max-width: 100%;
            overflow-x: hidden;
            background-color: #f8f9fa;
        }

        /* Styling Gambar Preview */
        .img-preview { width: 60px; height: 60px; object-fit: cover; border-radius: 8px; border: 1px solid #ddd; }
        
        /* Styling Badge Status Admin */
        .badge { padding: 6px 10px; font-size: 0.75rem; border-radius: 6px; }
        
        /* Teks Status (HILANG/TEMUAN) tanpa warna */
        .status-label { font-size: 0.85rem; font-weight: 600; color: #555; text-transform: uppercase; }
        
        /* Card Statistik (Widget) */
        .card-stats { border: none; border-radius: 12px; transition: transform 0.2s; background: #fff; }
        .card-stats:hover { transform: translateY(-5px); }
        
        /* Kotak Ikon di dalam Widget */
        .icon-box { width: 45px; height: 45px; border-radius: 10px; display: flex; align-items: center; justify-content: center; font-size: 1.4rem; }
        
        /* Merapikan Row agar tidak offset ke samping */
        .row { margin-left: 0; margin-right: 0; }
        
        /* Responsif untuk layar kecil */
        @media (max-width: 768px) {
            .col-md-3 { width: 50%; } /* Jadi 2 kotak per baris di HP */
        }
    </style>
</head>
<body>

<div class="container-fluid py-5 px-4">
    <div class="mb-4 ps-2">
        <h3 class="fw-bold text-dark mb-1">Riwayat Barang Hilang Saya</h3>
        <p class="text-muted">Pantau status laporan barang hilang Anda di sini.</p>
    </div>

    <div class="row g-3 mb-4">
        <div class="col-md-3">
            <div class="card card-stats shadow-sm h-100">
                <div class="card-body d-flex align-items-center">
                    <div class="icon-box bg-primary-subtle text-primary me-3">
                        <i class="bi bi-megaphone"></i>
                    </div>
                    <div>
                        <small class="text-muted d-block" style="font-size: 0.7rem;">Total Laporan</small>
                        <h5 class="fw-bold m-0">{{ $semua_barang->count() }}</h5>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card card-stats shadow-sm h-100">
                <div class="card-body d-flex align-items-center">
                    <div class="icon-box bg-success-subtle text-success me-3">
                        <i class="bi bi-check2-all"></i>
                    </div>
                    <div>
                        <small class="text-muted d-block" style="font-size: 0.7rem;">Sudah Ditemukan</small>
                        <h5 class="fw-bold m-0">{{ $semua_barang->where('status_admin', 'Selesai')->count() }}</h5>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card card-stats shadow-sm h-100">
                <div class="card-body d-flex align-items-center">
                    <div class="icon-box bg-warning-subtle text-warning me-3">
                        <i class="bi bi-clock-history"></i>
                    </div>
                    <div>
                        <small class="text-muted d-block" style="font-size: 0.7rem;">Menunggu Acc</small>
                        <h5 class="fw-bold m-0">{{ $semua_barang->where('status_admin', 'Pending')->count() }}</h5>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card card-stats shadow-sm h-100">
                <div class="card-body d-flex align-items-center">
                    <div class="icon-box bg-danger-subtle text-danger me-3">
                        <i class="bi bi-x-circle"></i>
                    </div>
                    <div>
                        <small class="text-muted d-block" style="font-size: 0.7rem;">Dibatalkan</small>
                        <h5 class="fw-bold m-0">{{ $semua_barang->where('status_admin', 'Rejected')->count() }}</h5>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show border-0 shadow-sm mb-4" role="alert">
            <i class="bi bi-check-circle-fill me-2"></i> {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <div class="card shadow-sm border-0 overflow-hidden">
        <div class="card-header bg-white py-3">
            <h6 class="fw-bold m-0 text-dark"><i class="bi bi-list-stars me-2 text-primary"></i>Daftar Laporan Hilang</h6>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="table-light text-secondary">
                        <tr>
                            <th class="ps-4">Foto</th>
                            <th>ID</th>
                            <th>Nama Barang</th>
                            <th>Deskripsi</th>
                            <th>Lokasi</th>
                            <th>Waktu</th>
                            <th>Jenis</th>
                            <th>Status Admin</th>
                            <th class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($semua_barang as $item)
                        <tr>
                            <td class="ps-4">
                                @if($item->foto_barang)
                                    <img src="{{ asset('storage/' . $item->foto_barang) }}" class="img-preview">
                                @else
                                    <div class="img-preview d-flex align-items-center justify-content-center bg-secondary-subtle text-muted small">No Pic</div>
                                @endif
                            </td>
                            <td class="text-muted small">#{{ $item->id_item }}</td>
                            <td class="fw-bold text-primary">{{ $item->nama_barang }}</td>
                            <td class="small text-muted" style="max-width: 150px; overflow: hidden; text-overflow: ellipsis; white-space: nowrap;">
                                {{ $item->deskripsi ?? '-' }}
                            </td>
                            <td class="small">{{ $item->lokasi_temuan }}</td>
                            <td class="small">{{ $item->tanggal_temuan }}</td>
                            <td class="status-label">{{ $item->status }}</td>
                            <td>
                                @if($item->status_admin == 'Approved')
                                    <span class="badge bg-success text-white">Disetujui</span>
                                @elseif($item->status_admin == 'Rejected')
                                    <span class="badge bg-danger text-white">Ditolak</span>
                                @elseif($item->status_admin == 'Selesai')
                                    <span class="badge bg-primary text-white">Selesai</span>
                                @else
                                    <span class="badge bg-warning text-dark">{{ $item->status_admin ?? 'Pending' }}</span>
                                @endif
                            </td>
                            <td class="text-center">
                                <form action="{{ route('user.postingan.hilang.destroy', $item->id_item) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus laporan ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm text-danger border-0">
                                        <i class="bi bi-trash fs-5"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="9" class="text-center py-5 text-muted">Belum ada laporan barang hilang.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    
    <div class="mt-4">
        <a href="/dashboard" class="btn btn-sm btn-outline-secondary px-4 shadow-sm rounded-pill">
            <i class="bi bi-arrow-left me-1"></i> Kembali ke Dashboard
        </a>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>