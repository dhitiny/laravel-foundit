<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Profile - FoundIt</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght=300;400;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">

    <style>
        body { font-family: 'Poppins', sans-serif; background-color: #f7f1e6; color: #333; }
        
        /* Gaya Navbar */
        .navbar-foundit { background-color: #f7f1e6; padding: 15px 0; }
        .navbar-brand { font-weight: 800; font-size: 1.5rem; }
        .nav-link { color: #001f3f !important; font-weight: 600; transition: 0.2s; }
        .nav-link:hover { color: #8b0000 !important; }
        
        /* Gaya Komponen Halaman Profil */
        .profile-header { background: linear-gradient(135deg, #001f3f 0%, #8b0000 100%); padding: 50px 0; color: white; border-radius: 0 0 30px 30px; }
        .profile-avatar { width: 120px; height: 120px; object-fit: cover; border: 4px solid white; box-shadow: 0 8px 16px rgba(0,0,0,0.15); }
        .card-custom { border: none; border-radius: 20px; box-shadow: 0 4px 20px rgba(0,0,0,0.05); background: white; }
        
        /* 👑 AREA FIXED UKURAN BADGE BIAR GEDE & RAPI */
        .badge-container-flex {
            display: flex;
            flex-wrap: wrap;
            gap: 15px; /* Jarak antar badge */
            justify-content: center;
            padding: 10px 0;
        }
        .badge-wrapper {
            display: flex;
            flex-direction: column;
            align-items: center;
            width: 90px; /* Memperlebar ruang wadah tiap badge */
        }
        .badge-icon { 
            width: 80px;          /* 👈 SEKARANG GW SET 80px BIAR JELAS DAN GEDE */
            height: 80px;         /* 👈 KALAU MAU LEBIH GEDE LAGI, TINGGAL BERSIHIN JADI 90px ATAU 100px */
            object-fit: contain; 
            transition: transform 0.2s;
        }
        .badge-icon:hover {
            transform: scale(1.1);
        }
        .badge-text {
            font-size: 11px;
            font-weight: 600;
            line-height: 1.2;
            margin-top: 8px;
            color: #333;
            text-align: center;
        }
        
        /* Gaya Tambahan */
        .hero-banner { background: linear-gradient(135deg, #001f3f 0%, #8b0000 100%); padding: 60px 0 120px; color: white; text-align: center; }
        .search-wrapper { max-width: 700px; margin: -35px auto 0; position: relative; z-index: 10; }
        .search-bar { background: white; border-radius: 50px; padding: 10px 25px; box-shadow: 0 15px 30px rgba(0,0,0,0.1); display: flex; align-items: center; }
        .search-input { border: none; width: 100%; padding: 10px; outline: none; }
        .btn-search { background-color: #8b0000; color: white; border-radius: 50px; padding: 8px 25px; border: none; font-weight: 600; }
        .action-card { background: white; border-radius: 25px; padding: 30px; margin-top: 50px; box-shadow: 0 10px 30px rgba(0,0,0,0.05); }
        .item-card { border: none; border-radius: 18px; transition: 0.3s; background: white; box-shadow: 0 4px 12px rgba(0,0,0,0.05); overflow: hidden; }
        .img-container { height: 180px; width: 100%; object-fit: cover; }
        .btn-report-lost { background-color: #8b0000; color: white; font-weight: 600; border-radius: 10px; padding: 10px; text-decoration: none; display: block; }
        .btn-report-found { background-color: #001f3f; color: white; font-weight: 600; border-radius: 10px; padding: 10px; text-decoration: none; display: block; }
    </style>
</head>
<body>

    <nav class="navbar navbar-expand-lg navbar-foundit sticky-top">
        <div class="container">
            <a class="navbar-brand d-flex align-items-center gap-2 text-decoration-none" href="/homepage" style="color: #750909;">
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
                            <img src="https://ui-avatars.com/api/?name={{ auth()->user()->username }}&background=8b0000&color=fff" class="rounded-circle" width="35">
                        @endif
                        <span class="fw-semibold" style="color: #001f3f;">{{ auth()->user()->username }}</span>
                    </a>
                    
                    <ul class="dropdown-menu dropdown-menu-end shadow-sm border-0 py-2 mt-2">
                        <li>
                            <form method="POST" action="{{ route('logout') }}" class="m-0">
                                @csrf
                                <button type="submit" class="dropdown-item text-danger fw-semibold">
                                    <i class="bi bi-box-arrow-right me-2"></i>Keluar
                                </button>
                            </form>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </nav>

    <div class="profile-header text-center">
        <div class="container">
            @if(auth()->user()->foto_profil)
                <img src="{{ asset('storage/' . auth()->user()->foto_profil) }}" class="rounded-circle profile-avatar mb-3">
            @else
                <img src="https://ui-avatars.com/api/?name={{ auth()->user()->username }}&background=8b0000&color=fff" class="rounded-circle profile-avatar mb-3">
            @endif
            <h2 class="fw-bold mb-1">{{ auth()->user()->username }}</h2>
            <p class="opacity-75 mb-0"><i class="bi bi-envelope-fill me-1"></i> {{ auth()->user()->email }}</p>
        </div>
    </div>

    <div class="container my-5">
        <div class="row g-4">
            <div class="col-lg-4">
                <div class="card card-custom p-4 mb-4">
                    <h5 class="fw-bold mb-4">Detail Akun</h5>
                    <div class="mb-3">
                        <label class="text-muted small d-block">Username</label>
                        <span class="fw-semibold">{{ auth()->user()->username }}</span>
                    </div>
                    <div class="mb-4">
                        <label class="text-muted small d-block">Email</label>
                        <span class="fw-semibold">{{ auth()->user()->email }}</span>
                    </div>
                    <div class="d-grid">
                        <a href="{{ route('profile.edit') }}" class="btn btn-primary btn-md rounded-pill fw-semibold" style="background-color: #001f3f; border: none;">
                            <i class="bi bi-pencil-square me-2"></i>Edit Profil
                        </a>
                    </div>
                </div>

                <div class="card card-custom p-4 shadow-sm">
                    <h5 class="fw-bold mb-3">Badge Saya</h5>
                    <div class="badge-container-flex">
                        @forelse($badgesDiterima as $badge)
                            <div class="badge-wrapper">
                                <img src="{{ asset('images/badges/' . $badge->logo_badge) }}" class="badge-icon" title="{{ $badge->nama_badge }}" alt="{{ $badge->nama_badge }}">
                                <div class="badge-text text-truncate w-100">{{ $badge->nama_badge }}</div>
                            </div>
                        @empty
                            <div class="w-100">
                                <p class="text-muted small italic mb-0 text-center py-3">Belum ada badge yang didapatkan.</p>
                            </div>
                        @endforelse
                    </div>
                </div>
            </div>

            <div class="col-lg-8">
                <div class="card card-custom p-4 mb-4 border shadow-sm" style="border-radius: 15px; background: white;">
                    <h5 class="fw-bold m-0 text-dark mb-4">
                        <i class="bi bi-bell me-2 text-warning"></i>Notifikasi Aktivitas
                    </h5>
                    
                    @php 
    $hasNotifications = (isset($klaimMasuk) && $klaimMasuk->count() > 0) || (isset($notifKlaimSaya) && $notifKlaimSaya->count() > 0);
@endphp

<div class="notifications-wrapper">
    @if($hasNotifications)
        
        {{-- ================= KELOMPOK 1: KLAIM MASUK (ORANG LAIN KLAIM BARANG KITA) ================= --}}
        @if(isset($klaimMasuk) && $klaimMasuk->count() > 0)
            @foreach($klaimMasuk as $klaim)
                <div class="alert alert-warning alert-dismissible fade show shadow-sm border-0 mb-3" role="alert" style="border-left: 5px solid #ffc107 !important; background-color: #fff3cd; border-radius: 15px;">
                    <div class="d-flex flex-column flex-md-row align-items-md-center justify-content-between gap-3 p-2">
                        <div class="d-flex align-items-center">
                            <i class="bi bi-exclamation-circle-fill me-3 fs-4 text-warning"></i>
                            <div>
                                <strong class="d-block text-dark" style="font-size: 15px;">Ada Klaim Barang Baru! 🔔</strong>
                                <span class="text-muted" style="font-size: 13px;">
                                    Akun <strong>{{ $klaim->user->username ?? 'User' }}</strong> mengajukan klaim atas barang <strong>"{{ $klaim->barang->nama_barang ?? 'Barang' }}"</strong> yang kamu temukan dengan ciri: <em>"{{ $klaim->ciri_khusus }}"</em>.
                                </span>
                            </div>
                        </div>
                        <div class="d-flex gap-2">
    <a href="{{ route('klaim.bukti', $klaim->id) }}" class="btn btn-primary btn-sm rounded-pill px-3 fw-semibold d-flex align-items-center gap-1">
        <i class="bi bi-eye"></i> Lihat Selengkapnya
    </a>
</div>
                    </div>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endforeach
        @endif

        {{-- ================= KELOMPOK 2: RIWAYAT KLAIM SAYA (STATUS KLAIM YANG KITA AJUKAN) ================= --}}
        @if(isset($notifKlaimSaya) && $notifKlaimSaya->count() > 0)
            @foreach($notifKlaimSaya as $riwayat)
                
                {{-- STATUS DISAPROVE / DISETUJUI --}}
                @if($riwayat->status == 'APPROVED')
                    <div class="alert alert-success alert-dismissible fade show shadow-sm border-0 mb-3" role="alert" style="border-left: 5px solid #198754 !important; background-color: #e2f0d9; border-radius: 15px;">
                        <div class="d-flex align-items-center p-2">
                            <i class="bi bi-check-circle-fill me-3 fs-4 text-success"></i>
                            <div>
                                <strong class="d-block text-dark" style="font-size: 15px;">Klaim Barang Disetujui! 🎉</strong>
                                <span class="text-muted" style="font-size: 13px;">
                                    Hore! Klaim kamu untuk barang <strong>"{{ $riwayat->barang->nama_barang ?? 'Barang' }}"</strong> telah <strong>DISETUJUI</strong> oleh penemu. Silakan hubungi penemu untuk langkah pengambilan.
                                </span>
                            </div>
                        </div>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>

                {{-- STATUS REJECTED / DITOLAK --}}
                @elseif($riwayat->status == 'REJECTED')
                    <div class="alert alert-danger alert-dismissible fade show shadow-sm border-0 mb-3" role="alert" style="border-left: 5px solid #dc3545 !important; background-color: #f8d7da; border-radius: 15px;">
                        <div class="d-flex align-items-center p-2">
                            <i class="bi bi-x-circle-fill me-3 fs-4 text-danger"></i>
                            <div>
                                <strong class="d-block text-dark" style="font-size: 15px;">Klaim Barang Ditolak ❌</strong>
                                <span class="text-muted" style="font-size: 13px;">
                                    Maaf, klaim kamu untuk barang <strong>"{{ $riwayat->barang->nama_barang ?? 'Barang' }}"</strong> telah <strong>DITOLAK</strong> oleh penemu karena bukti atau ciri-ciri yang kamu berikan belum cocok.
                                </span>
                            </div>
                        </div>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>

                {{-- STATUS PENDING / DALAM PROSES --}}
                @elseif($riwayat->status == 'PENDING')
                    <div class="alert alert-info alert-dismissible fade show shadow-sm border-0 mb-3" role="alert" style="border-left: 5px solid #0dcaf0 !important; background-color: #e0f7fa; border-radius: 15px;">
                        <div class="d-flex align-items-center p-2">
                            <i class="bi bi-hourglass-split me-3 fs-4 text-info"></i>
                            <div>
                                <strong class="d-block text-dark" style="font-size: 15px;">Klaim Sedang Diproses ⏳</strong>
                                <span class="text-muted" style="font-size: 13px;">
                                    Kamu telah mengajukan klaim untuk barang <strong>"{{ $riwayat->barang->nama_barang ?? 'Barang' }}"</strong>. Sekarang tinggal menunggu penemu memeriksa bukti dan menyetujuinya.
                                </span>
                            </div>
                        </div>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

            @endforeach
        @endif

    {{-- ================= KONDISI JIKA SAMA SEKALI TIDAK ADA NOTIFIKASI AKTIF ================= --}}
    @else
        <div class="text-center py-4">
            <i class="bi bi-envelope-open text-muted fs-1 mb-2 d-block"></i>
            <p class="text-muted mb-0 small fst-italic">Belum ada aktivitas klaim terbaru saat ini.</p>
        </div>
    @endif
</div>

                <div class="card card-custom p-4 mb-4 border shadow-sm" style="border-radius: 15px; background: white;">
                    <div class="d-flex align-items-center justify-content-between mb-4">
                        <h5 class="fw-bold m-0 text-danger">
                            <i class="bi bi-exclamation-circle-fill me-2"></i>Statistik Laporan Kehilangan
                        </h5>
                        <a href="/status-hilang" class="btn btn-outline-danger btn-sm rounded-pill px-3 fw-semibold shadow-sm">
                            Selengkapnya <i class="bi bi-arrow-right-short ms-1"></i>
                        </a>
                    </div>
                    
                    <div class="row g-2 text-center">
                        <div class="col-6 col-md-3">
                            <div class="p-2.5 rounded-3 border bg-light h-100 d-flex flex-column justify-content-center py-3">
                                <div class="fs-4 fw-bold text-dark mb-1">{{ $barangHilang->count() }}</div>
                                <div class="text-muted uppercase fw-bold tracking-wider" style="font-size: 9px;">Total Laporan</div>
                            </div>
                        </div>
                        <div class="col-6 col-md-3">
                            <div class="p-2.5 rounded-3 border h-100 d-flex flex-column justify-content-center py-3" style="background-color: #fffdf0; border-color: #f6e6be !important;">
                                <div class="fs-4 fw-bold text-warning mb-1">
                                    {{ $barangHilang->filter(fn($b) => in_array(strtolower($b->status), ['pending', '']))->count() }}
                                </div>
                                <div class="text-warning uppercase fw-bold tracking-wider" style="font-size: 9px;">Pending</div>
                            </div>
                        </div>
                        <div class="col-6 col-md-3">
                            <div class="p-2.5 rounded-3 border h-100 d-flex flex-column justify-content-center py-3" style="background-color: #f6fff6; border-color: #d2ecd2 !important;">
                                <div class="fs-4 fw-bold text-success mb-1">
                                    {{ $barangHilang->filter(fn($b) => strtolower($b->status) == 'approved')->count() }}
                                </div>
                                <div class="text-success uppercase fw-bold tracking-wider" style="font-size: 9px;">Approved</div>
                            </div>
                        </div>
                        <div class="col-6 col-md-3">
                            <div class="p-2.5 rounded-3 border h-100 d-flex flex-column justify-content-center py-3" style="background-color: #f0f7ff; border-color: #d0e5ff !important;">
                                <div class="fs-4 fw-bold text-primary mb-1">
                                    {{ $barangHilang->filter(fn($b) => strtolower($b->status) == 'selesai')->count() }}
                                </div>
                                <div class="text-primary uppercase fw-bold tracking-wider" style="font-size: 9px;">Selesai</div>
                            </div>
                        </div>
                    </div>
                    <div class="row mt-2">
                        <div class="col-12">
                            <p class="text-muted m-0 text-start italic" style="font-size: 11px;">
                                * Laporan Ditolak/Dibatalkan: <strong class="text-danger">{{ $barangHilang->filter(fn($b) => in_array(strtolower($b->status), ['rejected', 'tolak', 'dibatalkan']))->count() }}</strong>
                            </p>
                        </div>
                    </div>
                </div>

                <div class="card card-custom p-4 border shadow-sm" style="border-radius: 15px; background: white;">
                    <div class="d-flex align-items-center justify-content-between mb-4">
                        <h5 class="fw-bold m-0 text-primary">
                            <i class="bi bi-check-circle-fill me-2"></i>Statistik Laporan Temuan
                        </h5>
                        <a href="/status-temuan" class="btn btn-outline-primary btn-sm rounded-pill px-3 fw-semibold shadow-sm">
                            Selengkapnya <i class="bi bi-arrow-right-short ms-1"></i>
                        </a>
                    </div>

                    <div class="row g-2 text-center">
                        <div class="col-6 col-md-3">
                            <div class="p-2.5 rounded-3 border bg-light h-100 d-flex flex-column justify-content-center py-3">
                                <div class="fs-4 fw-bold text-dark mb-1">{{ $barangTemuan->count() }}</div>
                                <div class="text-muted uppercase fw-bold tracking-wider" style="font-size: 9px;">Total Laporan</div>
                            </div>
                        </div>
                        <div class="col-6 col-md-3">
                            <div class="p-2.5 rounded-3 border h-100 d-flex flex-column justify-content-center py-3" style="background-color: #fffdf0; border-color: #f6e6be !important;">
                                <div class="fs-4 fw-bold text-warning mb-1">
                                    {{ $barangTemuan->filter(fn($b) => in_array(strtolower($b->status), ['pending', '']))->count() }}
                                </div>
                                <div class="text-warning uppercase fw-bold tracking-wider" style="font-size: 9px;">Pending</div>
                            </div>
                        </div>
                        <div class="col-6 col-md-3">
                            <div class="p-2.5 rounded-3 border h-100 d-flex flex-column justify-content-center py-3" style="background-color: #f6fff6; border-color: #d2ecd2 !important;">
                                <div class="fs-4 fw-bold text-success mb-1">
                                    {{ $barangTemuan->filter(fn($b) => strtolower($b->status) == 'approved')->count() }}
                                </div>
                                <div class="text-success uppercase fw-bold tracking-wider" style="font-size: 9px;">Approved</div>
                            </div>
                        </div>
                        <div class="col-6 col-md-3">
                            <div class="p-2.5 rounded-3 border h-100 d-flex flex-column justify-content-center py-3" style="background-color: #f0f7ff; border-color: #d0e5ff !important;">
                                <div class="fs-4 fw-bold text-primary mb-1">
                                    {{ $barangTemuan->filter(fn($b) => strtolower($b->status) == 'selesai')->count() }}
                                </div>
                                <div class="text-primary uppercase fw-bold tracking-wider" style="font-size: 9px;">Selesai</div>
                            </div>
                        </div>
                    </div>
                    <div class="row mt-2">
                        <div class="col-12">
                            <p class="text-muted m-0 text-start italic" style="font-size: 11px;">
                                * Laporan Ditolak/Dibatalkan: <strong class="text-danger">{{ $barangTemuan->filter(fn($b) => in_array(strtolower($b->status), ['rejected', 'tolak', 'dibatalkan']))->count() }}</strong>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <footer class="py-4 text-center bg-white border-top mt-5">
        <p class="text-muted small mb-0">&copy; 2026 FoundIt - The Founder</p>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
function konfirmasiTolak(id, namaBarang) {
    Swal.fire({
        title: 'Tolak Klaim Barang?',
        text: `Apakah kamu yakin ingin menolak pengajuan klaim untuk barang "${namaBarang}"?`,
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#dc3545',
        cancelButtonColor: '#6c757d',
        confirmButtonText: 'Ya, Tolak!',
        cancelButtonText: 'Batal',
        className: 'rounded-4'
    }).then((result) => {
        if (result.isConfirmed) {
            // Jalankan form hidden submit jika user klik Ya
            document.getElementById(`form-tolak-${id}`).submit();
        }
    });
}
</script>
</body>
</html>