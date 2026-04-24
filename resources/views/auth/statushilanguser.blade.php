{{-- resources/views/auth/statushilanguser.blade.php --}}
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Riwayat Postingan Hilang Saya - FoundIt</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        body { background-color: #f8f9fa; font-family: 'Segoe UI', sans-serif; }
        .img-preview { width: 65px; height: 65px; object-fit: cover; border-radius: 12px; border: 1px solid #ddd; }
        .card { border: none; border-radius: 15px; }
        .table thead { background-color: #ffffff; color: #555; border-bottom: 2px solid #f1f1f1; }
        .status-badge { 
            padding: 8px 15px; border-radius: 50px; font-size: 10px; font-weight: 700; 
            text-transform: uppercase; display: inline-block; min-width: 90px; 
        }
        .stat-card { border-radius: 15px; border: none; transition: 0.3s; box-shadow: 0 4px 6px rgba(0,0,0,0.05); }
        .btn-delete { 
            color: #e74c3c; background: #ffebeb; border: none; width: 35px; height: 35px; 
            border-radius: 10px; transition: 0.3s; display: flex; align-items: center; justify-content: center; margin: 0 auto;
        }
        .btn-delete:hover { background: #e74c3c; color: white; transform: scale(1.1); }
    </style>
</head>
<body>

<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-12">
            
            @if(session('success'))
                <div class="alert alert-success border-0 shadow-sm mb-4">
                    <i class="fas fa-check-circle me-2"></i> {{ session('success') }}
                </div>
            @endif

            <div class="d-flex justify-content-between align-items-center mb-4">
                <div>
                    <h3 class="fw-bold text-dark mb-1">Riwayat Postingan Barang Hilang Saya</h3>
                    <p class="text-muted small">Daftar barang hilang yang Anda laporkan ke sistem</p>
                </div>
                <a href="{{ route('landing') }}" class="btn btn-outline-danger btn-sm px-4 fw-bold shadow-sm">
                    <i class="fas fa-home me-1"></i> Beranda
                </a>
            </div>

            <div class="row mb-4 g-3">
                <div class="col-md-4">
                    <div class="card stat-card p-3 border-start border-danger border-4">
                        <small class="text-muted d-block text-uppercase fw-bold" style="font-size: 10px;">Total Laporan</small>
                        <h3 class="fw-bold mb-0 text-danger">{{ $semua_barang->count() }}</h3>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card stat-card p-3 border-start border-success border-4">
                        <small class="text-muted d-block text-uppercase fw-bold" style="font-size: 10px;">Sudah Ditemukan</small>
                        <h3 class="fw-bold mb-0 text-success">{{ $semua_barang->where('status', 'Selesai')->count() }}</h3>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card stat-card p-3 border-start border-secondary border-4">
                        <small class="text-muted d-block text-uppercase fw-bold" style="font-size: 10px;">Laporan Dibatalkan</small>
                        <h3 class="fw-bold mb-0 text-secondary">{{ $semua_barang->whereIn('status', ['Dibatalkan', 'dibatalkan'])->count() }}</h3>
                    </div>
                </div>
            </div>

            <div class="card shadow-sm overflow-hidden">
                <div class="table-responsive">
                    <table class="table align-middle mb-0 text-center">
                        <thead>
                            <tr class="text-muted">
                                <th class="ps-4">Foto</th>
                                <th class="text-start">Informasi Barang</th>
                                <th>Lokasi Hilang</th>
                                <th>Status Laporan</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($semua_barang as $item)
                            <tr class="border-top">
                                <td class="ps-4">
                                    @if($item->foto_barang)
                                        <img src="{{ asset('storage/' . $item->foto_barang) }}" class="img-preview" alt="Foto">
                                    @else
                                        <div class="img-preview d-flex align-items-center justify-content-center bg-light mx-auto"><i class="fas fa-camera text-muted"></i></div>
                                    @endif
                                </td>
                                <td class="text-start">
                                    <div class="fw-bold text-dark">{{ $item->nama_barang }}</div>
                                    <div class="text-muted small">ID Kat: {{ $item->id_kategori }}</div>
                                </td>
                                <td>
                                    <div class="text-muted small"><i class="fas fa-map-marker-alt text-danger me-1"></i> {{ $item->lokasi_temuan }}</div>
                                </td>
                                <td>
    @php
        $status = strtolower($item->status);
    @endphp

    @if($status == 'selesai')
        <span class="badge bg-primary status-badge text-white">Selesai</span>
    @elseif($status == 'dibatalkan')
        <span class="badge bg-secondary status-badge text-white">Dibatalkan</span>
    @elseif($status == 'approved')
        <span class="badge bg-success status-badge text-white">Approved</span>
    @elseif($status == 'rejected')
        <span class="badge bg-danger status-badge text-white">Rejected</span>
    @else
        {{-- Di sini kita paksa: apapun isinya (termasuk 'temuan'), tampilnya 'PENDING' --}}
        <span class="badge bg-warning status-badge text-dark">PENDING</span>
    @endif
</td>
                                <td>
                                    {{-- Cek status biar tombol muncul: Jika bukan Selesai dan bukan Dibatalkan --}}
                                    @if(strtolower($item->status) != 'selesai' && strtolower($item->status) != 'dibatalkan')
                                        <form action="{{ route('barang.destroy', $item->id_item) }}" method="POST" onsubmit="return confirm('Batalkan laporan ini?')">
                                            @csrf
                                            @method('DELETE')
                                            <div class="d-flex flex-column align-items-center">
                                                <button type="submit" class="btn-delete mb-1">
                                                    <i class="fas fa-trash-alt"></i>
                                                </button>
                                                <span class="text-danger fw-bold" style="font-size: 9px;">BATALKAN</span>
                                            </div>
                                        </form>
                                    @else
                                        <span class="text-muted small">-</span>
                                    @endif
                                </td>
                            </tr>
                            @empty
                            <tr><td colspan="5" class="py-5 text-muted">Belum ada laporan.</td></tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>