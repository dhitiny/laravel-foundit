<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail {{ $item->nama_barang }} - FoundIt</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <style>
        body { font-family: 'Poppins', sans-serif; background-color: #f4f7f9; color: #333; }
        .navbar-foundit { background-color: #f7f1e6; padding: 15px 0; }
        .navbar-brand { font-weight: 800; font-size: 1.5rem; }
        .nav-link { color: #001f3f !important; font-weight: 500; }
        .nav-link:hover { color: #8b0000 !important; }

        /* Pembungkus Utama Card */
        .card-detail { border: none; border-radius: 24px; overflow: hidden; box-shadow: 0 10px 30px rgba(0,0,0,0.05); background: white; }
        
        /* Sisi Kiri (Gambar) */
        .img-detail-container { position: relative; background-color: #f8f9fa; display: flex; align-items: center; justify-content: center; height: 100%; min-height: 450px; }
        .img-detail { width: 100%; height: 100%; max-height: 500px; object-fit: contain; padding: 20px; }
        
        /* Badge Jenis Barang */
        .badge-jenis { position: absolute; top: 20px; left: 20px; font-size: 11px; font-weight: 800; letter-spacing: 1px; text-transform: uppercase; padding: 8px 16px; border-radius: 12px; box-shadow: 0 4px 12px rgba(0,0,0,0.1); border: none; z-index: 10; }
        .badge-hilang { background-color: #8b0000; color: white; }
        .badge-temuan { background-color: #041942; color: white; }

        /* Logika Warna Tema Konten */
        @if($item->jenis_barang == 'hilang')
            .accent-border { border-left: 4px solid #8b0000 !important; background-color: #fdf2f2; }
            .accent-icon { color: #8b0000 !important; }
            .btn-accent { background-color: #8b0000; color: white; border: none; }
            .btn-accent:hover { background-color: #660000; color: white; }
            .alert-accent { background-color: #fdf2f2; border: 1px solid rgba(139, 0, 0, 0.15); color: #660000; }
        @else
            .accent-border { border-left: 4px solid #041942 !important; background-color: #f0f4f8; }
            .accent-icon { color: #041942 !important; }
            .btn-accent { background-color: #041942; color: white; border: none; }
            .btn-accent:hover { background-color: #0b255c; color: white; }
            .alert-accent { background-color: #f0f4f8; border: 1px solid rgba(4, 25, 66, 0.15); color: #041942; }
        @endif

        /* Tombol Aksi */
        .btn-accent { border-radius: 16px; padding: 14px; font-weight: 700; text-transform: uppercase; letter-spacing: 1px; font-size: 13px; transition: 0.3s; width: 100%; text-decoration: none; }
        .info-box { background-color: #f8f9fa; border: 1px solid #f1f3f5; border-radius: 16px; padding: 12px 16px; }
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
                            <img src="https://ui-avatars.com/api/?name={{ auth()->user()->username }}&background=041942&color=fff" class="rounded-circle" width="35" height="35">
                        @endif
                        <span class="color: #001f3f fw-semibold">{{ auth()->user()->username }}</span>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end shadow-sm border-0 py-2 mt-2">
                        <li>
                            <a href="{{ $item->jenis_barang == 'hilang' ? route('auth.statushilanguser') : route('auth.statustemuanuser') }}" class="btn btn-outline-primary btn-sm rounded-pill px-3 fw-semibold shadow-sm mx-3 my-1 d-block text-center">
                                Selengkapnya <i class="bi bi-arrow-right-short ms-1"></i>
                            </a>
                        </li>
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
        
        <div class="mb-4">
            <a href="{{ route('homepage') }}" class="text-secondary text-decoration-none fw-medium d-inline-flex align-items-center gap-2 small">
                <i class="bi bi-arrow-left"></i> Kembali
            </a>
        </div>

        <div class="card card-detail">
            <div class="row g-0 align-items-stretch">
                
                <div class="col-md-6">
                    <div class="img-detail-container">
                        @if($item->foto_barang)
                            <img src="{{ asset('storage/' . $item->foto_barang) }}" class="img-detail">
                        @else
                            <div class="text-center text-muted p-5">
                                <i class="bi bi-image d-block mb-2" style="font-size: 5rem; color: #ced4da;"></i>
                                <span class="fst-italic small fw-medium">Foto Tidak Tersedia</span>
                            </div>
                        @endif

                        <span class="badge-jenis {{ $item->jenis_barang == 'hilang' ? 'badge-hilang' : 'badge-temuan' }}">
                            BARANG {{ $item->jenis_barang }}
                        </span>
                    </div>
                </div>

                <div class="col-md-6 bg-white d-flex flex-column justify-content-between p-4 p-lg-5">
                    <div>
                        <h1 class="fw-bold text-dark lh-sm mb-1" style="font-size: 2rem;">
                            {{ $item->nama_barang }}
                        </h1>
                        <p class="text-muted fw-semibold mb-4" style="font-size: 11px; letter-spacing: 1px;">
                            ID: #FND-{{ $item->id_item }}
                        </p>

                        <div class="mb-4">
                            <label class="text-muted fw-bold uppercase mb-2 d-block" style="font-size: 10px; letter-spacing: 2px; text-transform: uppercase;">Deskripsi</label>
                            <div class="accent-border p-3 rounded-end-4">
                                <p class="text-secondary m-0 fst-italic small lh-base">
                                    "{!! $item->deskripsi ?? 'Tidak ada deskripsi tambahan untuk barang ini.' !!}"
                                </p>
                            </div>
                        </div>

                        <div class="row g-3 mb-5">
                            <div class="col-6">
                                <div class="info-box">
                                    <label class="text-muted fw-bold uppercase mb-1 d-block" style="font-size: 9px; letter-spacing: 1px; text-transform: uppercase;">Lokasi</label>
                                    <span class="d-flex align-items-center gap-2 small fw-bold text-dark">
                                        <i class="bi bi-geo-alt-fill accent-icon"></i> {{ $item->lokasi }}
                                    </span>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="info-box">
                                    <label class="text-muted fw-bold uppercase mb-1 d-block" style="font-size: 9px; letter-spacing: 1px; text-transform: uppercase;">Dilaporkan</label>
                                    <span class="d-flex align-items-center gap-2 small fw-bold text-dark">
                                        <i class="bi bi-calendar3 accent-icon"></i> 
                                        {{ date('d M Y', strtotime($item->tanggal_kejadian)) }}
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="mt-auto">
                        @if($item->jenis_barang == 'hilang')
                            {{-- Jika barang berstatus Hilang, arahkan ke form pengembalian --}}
                            <a href="{{ route('klaim.create', $item->id_item) }}?jenis=pengembalian" class="btn btn-accent shadow-sm d-flex align-items-center justify-content-center gap-2 mb-3">
                                <i class="bi bi-arrow-left-right fs-6"></i> 
                                Saya Menemukan Barang Ini
                            </a>
                        @else
                            {{-- Jika barang berstatus Temuan, arahkan ke form klaim hak milik --}}
                            <a href="{{ route('klaim.create', $item->id_item) }}?jenis=klaim" class="btn btn-accent shadow-sm d-flex align-items-center justify-content-center gap-2 mb-3">
                                <i class="bi bi-check-circle-fill fs-6"></i> 
                                Klaim Barang Saya
                            </a>
                        @endif

                        <div class="alert-accent rounded-4 p-3 d-flex align-items-start gap-2">
                            <i class="bi bi-exclamation-triangle-fill fs-5 flex-shrink-0 mt-0.5"></i>
                            <p class="m-0" style="font-size: 11px; line-height: 1.5; font-weight: 500;">
                                <strong class="fw-bold">Penting:</strong> Harap siapkan bukti foto kepemilikan atau informasi detail bawaan barang untuk keperluan verifikasi saat proses klaim/pengambilan berlangsung.
                            </p>
                        </div>
                    </div>

                </div>

            </div>
        </div>

        <div class="mt-5 text-center">
            <p class="text-muted fw-medium uppercase mb-0" style="font-size: 10px; letter-spacing: 2px;">
                &copy; 2026 FoundIt - The Founder
            </p>
        </div>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>