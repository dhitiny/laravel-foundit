{{-- resources/views/auth/statustemuanuser.blade.php --}}
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Riwayat Postingan Temuan Saya - FoundIt</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        body { background-color: #f8f9fa; font-family: 'Segoe UI', sans-serif; }
        .img-preview { 
            width: 70px; height: 70px; object-fit: cover; 
            border-radius: 12px; background-color: #f0f0f0; border: 1px solid #ddd;
        }
        .card { border: none; border-radius: 15px; }
        .table thead { background-color: #ffffff; color: #555; border-bottom: 2px solid #f1f1f1; }
        .status-badge { 
            padding: 8px 15px; 
            border-radius: 50px; 
            font-size: 11px; 
            font-weight: 700; 
            text-transform: uppercase; 
            letter-spacing: 0.8px;
            display: inline-block;
            min-width: 110px;
        }
        .stat-card { border-radius: 15px; border: none; transition: 0.3s; }
        .stat-card:hover { transform: translateY(-5px); }
        .text-kecil { font-size: 12px; }
        .table-hover tbody tr:hover { background-color: #fcfcfc; }
    </style>
</head>
<body>

<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-12">
            
            <div class="d-flex justify-content-between align-items-center mb-4">
                <div>
                    <h3 class="fw-bold text-dark mb-1">Riwayat Postingan Temuan Saya</h3>
                    <p class="text-muted small">Kelola dan pantau laporan barang temuan Anda</p>
                </div>
                <a href="{{ route('landing') }}" class="btn btn-outline-primary btn-sm px-4 shadow-sm border-2 fw-bold">
                    <i class="fas fa-home me-1"></i> Beranda
                </a>
            </div>

            <div class="row mb-4 g-3">
                <div class="col-md-3">
                    <div class="card stat-card shadow-sm p-3 border-start border-primary border-4">
                        <small class="text-muted d-block text-uppercase fw-bold" style="font-size: 10px;">Total Temuan</small>
                        <h3 class="fw-bold mb-0 text-primary">{{ $semua_barang->count() }}</h3>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card stat-card shadow-sm p-3 border-start border-success border-4">
                        <small class="text-muted d-block text-uppercase fw-bold" style="font-size: 10px;">Sudah Dikembalikan</small>
                        <h3 class="fw-bold mb-0 text-success">
                            {{ $semua_barang->where('status', 'Selesai')->count() }}
                        </h3>
                    </div>
                </div>
            </div>

            <div class="card shadow-sm overflow-hidden">
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0 text-center">
                        <thead>
                            <tr>
                                <th class="ps-4">Foto</th>
                                <th class="text-start">Informasi Barang</th>
                                <th>Lokasi Temuan</th>
                                <th>Waktu Temuan</th>
                                <th>Status Laporan</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($semua_barang as $item)
                            <tr>
                                <td class="ps-4">
                                    @if($item->foto_barang)
                                        <img src="{{ asset('storage/' . $item->foto_barang) }}" class="img-preview shadow-sm" alt="Foto">
                                    @else
                                        <div class="img-preview d-flex align-items-center justify-content-center small text-muted mx-auto">
                                            <i class="fas fa-camera fa-lg"></i>
                                        </div>
                                    @endif
                                </td>

                                <td class="text-start">
                                    <div class="fw-bold text-dark">{{ $item->nama_barang }}</div>
                                    <div class="badge bg-light text-muted border fw-normal" style="font-size: 10px;">
                                        ID Kat: {{ $item->id_kategori }}
                                    </div>
                                </td>

                                <td>
                                    <div class="text-dark fw-medium"><i class="fas fa-map-marker-alt text-primary me-1"></i> {{ $item->lokasi_temuan }}</div>
                                </td>

                                <td>
                                    <div class="text-muted text-kecil"><i class="fas fa-calendar-alt me-1"></i> {{ \Carbon\Carbon::parse($item->tanggal_temuan)->format('d M Y') }}</div>
                                </td>

                                <td>
                                    @if($item->status == 'Approved')
                                        <span class="badge bg-success status-badge text-white">
                                            <i class="fas fa-check-circle me-1"></i> Approved
                                        </span>
                                    @elseif($item->status == 'Rejected')
                                        <span class="badge bg-danger status-badge text-white">
                                            <i class="fas fa-times-circle me-1"></i> Rejected
                                        </span>
                                    @elseif($item->status == 'Selesai')
                                        <span class="badge bg-primary status-badge text-white">
                                            <i class="fas fa-check-double me-1"></i> Selesai
                                        </span>
                                    @else
                                        <span class="badge bg-warning status-badge text-dark">
                                            <i class="fas fa-clock fa-spin me-1"></i> Pending
                                        </span>
                                    @endif
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="5" class="text-center py-5">
                                    <img src="https://illustrations.popsy.co/gray/box-opened.svg" style="width: 150px;" class="mb-3 opacity-50">
                                    <p class="text-muted mb-0">Belum ada riwayat postingan temuan.</p>
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="mt-5 text-center">
                <p class="text-muted small">FoundIt System &copy; 2026 | Dibuat dengan <i class="fas fa-heart text-danger"></i></p>
            </div>

        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>