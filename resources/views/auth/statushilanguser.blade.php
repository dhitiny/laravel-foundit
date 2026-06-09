<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Riwayat Barang Hilang Saya - FoundIt</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">

    <style>
        body { font-family: 'Poppins', sans-serif; background-color: #f4f7f9; color: #333; }
        .navbar-foundit { background-color: #f7f1e6; padding: 15px 0; }
        .navbar-brand { font-weight: 800; font-size: 1.5rem; }
        .nav-link { color: #001f3f !important; font-weight: 500; }
        .nav-link:hover { color: #8b0000 !important; }
        
        .card-custom { border: none; border-radius: 15px; box-shadow: 0 4px 20px rgba(0,0,0,0.05); background: white; }
        .stat-card { border: none; border-radius: 12px; box-shadow: 0 2px 10px rgba(0,0,0,0.02); background: white; }
        
        .table th { background-color: #f8f9fa; color: #555; font-size: 0.75rem; font-weight: 600; text-transform: uppercase; letter-spacing: 0.5px; }
        .table td { vertical-align: middle; font-size: 0.85rem; }
        
        .badge-status { font-size: 0.75rem; font-weight: 600; padding: 6px 12px; border-radius: 50px; }
        .btn-action-delete { border: none; background: transparent; color: #dc3545; padding: 6px 10px; border-radius: 50px; transition: 0.2s; cursor: pointer; }
        .btn-action-delete:hover { background-color: #fff5f5; color: #a71d2a; }
        
        .form-control:focus, .form-select:focus { border-color: #8b0000; box-shadow: 0 0 0 0.25rem rgba(139, 0, 0, 0.15); }
        .btn-search { background-color: #041942; color: white; fw-semibold; }
        .btn-search:hover { background-color: #0b255c; color: white; }
    </style>
</head>
<body>

    <nav class="navbar navbar-expand-lg navbar-foundit sticky-top">
        <div class="container">
            <a class="navbar-brand d-flex align-items-center gap-2" href="/homepage" style="color: #750909;">
                <img src="{{ asset('images/logo-foundit.png') }}" alt="Logo FoundIt" height="32" class="d-inline-block align-text-top">
                <span>Found<span style="color: #212c6b;">It</span></span>
            </a>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0 ms-lg-4">
                    <li class="nav-item"><a class="nav-link" href="/homepage">Beranda</a></li>
                    <li class="nav-item"><a class="nav-link" href="/homepage#laporBarang">Lapor Barang</a></li>
                    <li class="nav-item"><a class="nav-link" href="/homepage#smartMatching">Smart Matching</a></li>
                    <li class="nav-item"><a class="nav-link" href="/badgeInfo">Badge</a></li>
                </ul>
                <div class="dropdown">
                    <a class="nav-link dropdown-toggle d-flex align-items-center gap-2" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        @if(auth()->user()->foto_profil)
                            <img src="{{ asset('storage/' . auth()->user()->foto_profil) }}" class="rounded-circle" width="35" height="35" style="object-fit: cover;">
                        @else
                            <img src="https://ui-avatars.com/api/?name={{ auth()->user()->username }}&background=8b0000&color=fff" class="rounded-circle" width="35" height="35">
                        @endif
                        <span class="text-white fw-semibold">{{ auth()->user()->username }}</span>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end shadow-sm border-0 py-2 mt-2">
                        <li><a href="{{ route('auth.statushilanguser') }}" class="btn btn-outline-danger btn-sm rounded-pill px-3 fw-semibold shadow-sm">
    Selengkapnya <i class="bi bi-arrow-right-short ms-1"></i>
</a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li>
                            <form method="POST" action="{{ route('logout') }}" class="m-0">
                                @csrf
                                <button type="submit" class="dropdown-item text-danger fw-semibold"><i class="bi bi-box-arrow-right me-2"></i>Keluar</button>
                            </form>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </nav>

    <div class="container my-5">
        
        <div class="d-flex align-items-center justify-content-between mb-4">
            <h3 class="fw-bold m-0"><i class="bi bi-card-list text-danger me-2"></i> Riwayat Barang Hilang Saya</h3>
            <a href="{{ route('profile.myprofile') }}" class="btn btn-outline-secondary rounded-pill px-4 fw-semibold btn-sm">
                <i class="bi bi-arrow-left me-1"></i> Ke Profil
            </a>
        </div>

        <div class="row g-3 mb-4">
            <div class="col-6 col-md-3">
                <div class="stat-card p-3 d-flex align-items-center border">
                    <div class="p-3 rounded-3 bg-primary bg-opacity-10 text-primary me-3 fs-4"><i class="bi bi-box-seam"></i></div>
                    <div>
                        <p class="text-muted text-uppercase fw-bold m-0" style="font-size: 10px;">Total</p>
                        <h4 class="fw-bold text-dark m-0">{{ $semua_barang->count() }}</h4>
                    </div>
                </div>
            </div>
            <div class="col-6 col-md-3">
                <div class="stat-card p-3 d-flex align-items-center border">
                    <div class="p-3 rounded-3 bg-success bg-opacity-10 text-success me-3 fs-4"><i class="bi bi-patch-check"></i></div>
                    <div>
                        <p class="text-muted text-uppercase fw-bold m-0" style="font-size: 10px;">Approved</p>
                        <h4 class="fw-bold text-dark m-0">
                            {{ $semua_barang->filter(fn($item) => strtolower(trim($item->status)) === 'approved')->count() }}
                        </h4>
                    </div>
                </div>
            </div>
            <div class="col-6 col-md-3">
                <div class="stat-card p-3 d-flex align-items-center border">
                    <div class="p-3 rounded-3 bg-info bg-opacity-10 text-info me-3 fs-4"><i class="bi bi-check2-all"></i></div>
                    <div>
                        <p class="text-muted text-uppercase fw-bold m-0" style="font-size: 10px;">Selesai</p>
                        <h4 class="fw-bold text-dark m-0">
                            {{ $semua_barang->filter(fn($item) => strtolower(trim($item->status)) === 'selesai')->count() }}
                        </h4>
                    </div>
                </div>
            </div>
            <div class="col-6 col-md-3">
                <div class="stat-card p-3 d-flex align-items-center border">
                    <div class="p-3 rounded-3 bg-danger bg-opacity-10 text-danger me-3 fs-4"><i class="bi bi-x-circle"></i></div>
                    <div>
                        <p class="text-muted text-uppercase fw-bold m-0" style="font-size: 10px;">Dibatalkan</p>
                        <h4 class="fw-bold text-dark m-0">
                            {{ $semua_barang->filter(fn($item) => in_array(strtolower(trim($item->status)), ['rejected', 'dibatalkan', 'tolak']))->count() }}
                        </h4>
                    </div>
                </div>
            </div>
        </div>

        <div class="card card-custom p-4 mb-4 border">
            <h6 class="fw-bold mb-3 text-secondary"><i class="bi bi-search me-2"></i>Cari & Filter Laporan</h6>
            <form method="GET" action="{{ url()->current() }}">
                <div class="row g-3">
                    <div class="col-md-4">
                        <label class="form-label small fw-semibold text-muted">Nama Barang</label>
                        <input type="text" name="search" class="form-control form-control-sm text-xs" placeholder="Contoh: Dompet, Kunci, HP..." value="{{ request('search') }}">
                    </div>
                    <div class="col-md-3">
                        <label class="form-label small fw-semibold text-muted">Kategori</label>
                        <select name="kategori" class="form-select form-select-sm text-xs">
                            <option value="">-- Semua Kategori --</option>
                            <option value="Elektronik" {{ request('kategori') == 'Elektronik' ? 'selected' : '' }}>Elektronik</option>
                            <option value="Dokumen" {{ request('kategori') == 'Dokumen' ? 'selected' : '' }}>Dokumen / Kartu</option>
                            <option value="Pakaian" {{ request('kategori') == 'Pakaian' ? 'selected' : '' }}>Pakaian</option>
                            <option value="Aksesoris" {{ request('kategori') == 'Aksesoris' ? 'selected' : '' }}>Aksesoris</option>
                            <option value="Lainnya" {{ request('kategori') == 'Lainnya' ? 'selected' : '' }}>Lainnya</option>
                        </select>
                    </div>
                    <div class="col-md-3">
                        <label class="form-label small fw-semibold text-muted">Tempat Hilang (Lokasi)</label>
                        <input type="text" name="lokasi" class="form-control form-control-sm text-xs" placeholder="Contoh: Parkiran, Kantin..." value="{{ request('lokasi') }}">
                    </div>
                    <div class="col-md-2 d-flex align-items-end gap-2">
                        <button type="submit" class="btn btn-search btn-sm w-100 rounded-2 fw-semibold py-2">
                            Filter
                        </button>
                        @if(request()->filled('search') || request()->filled('kategori') || request()->filled('lokasi'))
                            <a href="{{ url()->current() }}" class="btn btn-outline-secondary btn-sm rounded-2 py-2" title="Reset Filter">
                                <i class="bi bi-arrow-counterclockwise"></i>
                            </a>
                        @endif
                    </div>
                </div>
            </form>
        </div>

        <div class="card card-custom overflow-hidden border">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead>
                        <tr>
                            <th class="px-4 py-3 text-center">Foto</th>
                            <th class="px-4 py-3">Nama & Kategori</th>
                            <th class="px-4 py-3">Deskripsi</th>
                            <th class="px-4 py-3">Lokasi & Waktu</th>
                            <th class="px-4 py-3 text-center">Status</th>
                            <th class="px-4 py-3 text-center">Tindakan</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($semua_barang as $item)
                            @php
                                $stRaw = strtolower(trim($item->status ?? 'pending'));
                                $stColor = match($stRaw) {
                                    'approved' => 'bg-success bg-opacity-10 text-success border border-success border-opacity-20',
                                    'rejected', 'tolak' => 'bg-danger bg-opacity-10 text-danger border border-danger border-opacity-20',
                                    'selesai' => 'bg-primary bg-opacity-10 text-primary border border-primary border-opacity-20',
                                    default => 'bg-warning bg-opacity-10 text-warning border border-warning border-opacity-20',
                                };
                            @endphp
                            <tr>
                                <td class="px-4 py-3 text-center">
                                    @if($item->foto_barang)
                                        <img src="{{ asset('storage/' . $item->foto_barang) }}" class="rounded-3 border object-cover shadow-sm" style="width: 55px; height: 55px;">
                                    @else
                                        <div class="d-inline-flex align-items-center justify-content-center rounded-3 border border-dashed bg-light text-muted fw-bold" style="width: 55px; height: 55px; font-size: 10px;">No Pic</div>
                                    @endif
                                </td>
                                <td class="px-4 py-3">
                                    <div class="fw-bold text-dark mb-0" style="font-size: 0.95rem;">{{ $item->nama_barang }}</div>
                                    <span class="text-muted text-uppercase font-bold" style="font-size: 10px;">{{ $item->kategori }}</span>
                                </td>
                                <td class="px-4 py-3 text-muted">
                                    <div class="text-truncate" style="max-width: 180px;">{{ $item->deskripsi ?? '-' }}</div>
                                </td>
                                <td class="px-4 py-3">
                                    <div class="fw-semibold text-secondary"><i class="bi bi-geo-alt-fill text-danger me-1"></i>{{ $item->lokasi }}</div>
                                    <div class="text-muted small italic mt-0.5" style="font-size: 0.75rem;">{{ $item->tanggal_kejadian }}</div>
                                </td>
                                <td class="px-4 py-3 text-center">
                                    <span class="badge-status {{ $stColor }}">
                                        {{ strtoupper($item->status ?? 'PENDING') }}
                                    </span>
                                </td>
                                <td class="px-4 py-3 text-center">
                                    <div class="d-flex align-items-center justify-content-center gap-2">
                                        
                                        @if($stRaw === 'approved')
                                            <form action="{{ route('user.postingan.hilang.selesai', $item->id_item) }}" method="POST" class="form-btn-selesai">
                                                @csrf
                                                <button type="button" class="btn btn-primary btn-sm rounded-pill px-3 fw-bold shadow-sm btn-selesai-trigger">
                                                    Selesai
                                                </button>
                                            </form>
                                        @elseif($stRaw === 'selesai')
                                            <span class="text-muted small italic fw-semibold px-2">Laporan Selesai</span>
                                        @else
                                            <button type="button" disabled class="btn btn-secondary btn-sm rounded-pill px-3 fw-bold disabled opacity-50">
                                                Selesai
                                            </button>
                                        @endif

                                        <form action="{{ route('user.postingan.hilang.destroy', $item->id_item) }}" method="POST" class="form-btn-delete">
                                            @csrf
                                            @method('DELETE')
                                            <button type="button" class="btn-foundit-delete btn-action-delete" title="Hapus Laporan">
                                                <i class="bi bi-trash3-fill fs-6"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center py-5 text-muted italic">
                                    <i class="bi bi-folder-x fs-2 d-block text-secondary mb-2"></i> Belum ada data laporan barang hilang yang cocok.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            
            // 1. Notifikasi Sukses Bawaan Session Setelah Redirect
            @if(session('success'))
                Swal.fire({
                    icon: 'success',
                    title: 'Berhasil!',
                    text: "{{ session('success') }}",
                    confirmButtonColor: '#041942'
                });
            @endif

            // 2. Konfirmasi Interaktif Tombol "Selesai"
            const selesaiButtons = document.querySelectorAll('.btn-selesai-trigger');
            selesaiButtons.forEach(button => {
                button.addEventListener('click', function () {
                    const form = this.closest('.form-btn-selesai');
                    Swal.fire({
                        title: 'Apakah Kamu Yakin?',
                        text: "Laporan akan ditandai selesai dan barang dinyatakan telah ditemukan kembali!",
                        icon: 'question',
                        showCancelButton: true,
                        confirmButtonColor: '#212c6b',
                        cancelButtonColor: '#6e7881',
                        confirmButtonText: 'Ya, Sudah Ketemu!',
                        cancelButtonText: 'Batal'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            form.submit(); // Kirim data form rute selesai ke backend
                        }
                    });
                });
            });

            // 3. Konfirmasi Interaktif Tombol Trash "Hapus"
            const deleteButtons = document.querySelectorAll('.btn-foundit-delete');
            deleteButtons.forEach(button => {
                button.addEventListener('click', function () {
                    const form = this.closest('.form-btn-delete');
                    Swal.fire({
                        title: 'Yakin Ingin Menghapus?',
                        text: "Data laporan kehilangan ini akan dihapus permanen dari sistem FoundIt!",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#dc3545',
                        cancelButtonColor: '#6e7881',
                        confirmButtonText: 'Ya, Hapus Saja!',
                        cancelButtonText: 'Batal'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            form.submit(); // Kirim data form rute delete ke backend
                        }
                    });
                });
            });

        });
    </script>
</body>
</html>