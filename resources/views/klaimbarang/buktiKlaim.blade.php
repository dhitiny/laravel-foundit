<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verifikasi Bukti Klaim Barang - FoundIt</title>
    
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">

    <style>
        body { font-family: 'Poppins', sans-serif; background-color: #f7f1e6; color: #333; }
        .navbar-foundit { background-color: #f7f1e6; padding: 15px 0; }
        .navbar-brand { font-weight: 800; font-size: 1.5rem; }
        .navbar-foundit .nav-link { color: #001f3f !important; font-weight: 600; }
        .navbar-foundit .nav-link:hover, .navbar-foundit .nav-link.active { color: #8b0000 !important; }
        .highlight-header { background: linear-gradient(135deg, #001f3f 0%, #8b0000 100%); padding: 50px 0 90px; color: white; }
        .card-form { background: white; border-radius: 25px; padding: 35px; margin-top: -50px; box-shadow: 0 10px 30px rgba(0,0,0,0.05); position: relative; z-index: 10; border: none; }
        .form-label { font-weight: 600; color: #001f3f; }
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
                        <span class="color: #001f3f fw-semibold">{{ auth()->user()->username }}</span>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end shadow-sm border-0 py-2 mt-2">
                        <li><a href="{{ route('profile.myprofile') }}" class="dropdown-item fw-semibold text-primary"><i class="bi bi-person-fill me-2"></i>Profile</a></li>
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

    <div class="highlight-header text-center">
        <div class="container">
            <h2 class="fw-bold mb-2"><i class="bi bi-shield-check text-warning me-2"></i> Verifikasi Bukti Kepemilikan</h2>
            <p class="opacity-75 mb-0 text-white">Tinjau deskripsi alasan dan lampiran bukti foto pengaju dengan teliti sebelum menyetujui transaksi.</p>
        </div>
    </div>

    <div class="container mb-5">
        <div class="row justify-content-center">
            <div class="col-lg-9">
                <div class="card card-form">
                    
                    <div class="row g-4 mb-4">
                        <div class="col-md-4">
                            <span class="text-muted small d-block mb-1">Nama Pengaju Klaim:</span>
                            <div class="p-3 bg-light rounded-3 fw-bold text-dark d-flex align-items-center gap-2">
                                <i class="bi bi-person-circle text-secondary fs-5"></i>
                                {{ $klaim->user->username ?? 'User' }}
                            </div>
                        </div>
                        <div class="col-md-4">
                            <span class="text-muted small d-block mb-1">No. WhatsApp Pengaju:</span>
                            <div class="p-3 bg-light rounded-3 fw-bold text-dark d-flex align-items-center gap-2">
                                <i class="bi bi-whatsapp text-success fs-5"></i>
                                {{ $klaim->user->whatsapp ?? 'Tidak Ada' }}
                            </div>
                        </div>
                        <div class="col-md-4">
                            <span class="text-muted small d-block mb-1">Barang yang Dimaksud:</span>
                            <div class="p-3 bg-light rounded-3 fw-bold text-dark d-flex align-items-center gap-2">
                                <i class="bi bi-box-seam-fill text-secondary fs-5"></i>
                                "{{ $klaim->barang->nama_barang ?? 'Barang' }}"
                            </div>
                        </div>
                    </div>

                    <hr class="opacity-25 my-4">

                    <div class="mb-4">
                        <label class="form-label mb-2"><i class="bi bi-text-left text-danger me-1"></i> Deskripsi Ciri Khusus & Alasan:</label>
                        <div class="p-3 bg-light rounded-3 border-start border-danger border-4 text-dark shadow-sm" style="font-style: italic; line-height: 1.6;">
                            "{{ $klaim->ciri_khusus }}"
                        </div>
                    </div>

                    <div class="mb-4">
                        <label class="form-label mb-2"><i class="bi bi-image text-danger me-1"></i> Foto Bukti Pendukung:</label>
                        @if($klaim->bukti_foto)
                            <div class="text-center p-3 bg-light rounded-3 border">
                                <img src="{{ asset('storage/' . $klaim->bukti_foto) }}" alt="Bukti Foto Klaim" class="img-fluid rounded-3 shadow-sm" style="max-height: 400px; object-fit: contain;">
                            </div>
                        @else
                            <div class="alert alert-warning border-0 rounded-3 text-center py-4 shadow-sm m-0" role="alert">
                                <i class="bi bi-exclamation-triangle-fill fs-3 text-warning d-block mb-2"></i>
                                <span class="fw-medium small d-block">Pengaju tidak menyertakan berkas foto bukti pendukung kepemilikan.</span>
                            </div>
                        @endif
                    </div>

                    <hr class="opacity-25 my-4">

                    <div class="d-flex justify-content-between align-items-center mt-4">
                        <a href="{{ route('profile.myprofile') }}" class="btn btn-outline-secondary rounded-3 px-4 fw-medium">
                            <i class="bi bi-arrow-left"></i> Kembali
                        </a>
                        
                        <div class="d-flex gap-2">
                            <button type="button" class="btn btn-danger rounded-3 px-4 fw-semibold" onclick="konfirmasiTolak()">
                                <i class="bi bi-x-circle me-1"></i> Tolak Klaim
                            </button>

                            <form action="{{ route('klaim.setuju', $klaim->id) }}" method="POST" class="m-0">
                                @csrf
                                <button type="submit" class="btn btn-success rounded-3 px-4 fw-semibold shadow-sm">
                                    <i class="bi bi-check-circle me-1"></i> Terima Klaim
                                </button>
                            </form>
                        </div>
                    </div>

                    <form id="form-tolak" action="{{ route('klaim.tolak', $klaim->id) }}" method="POST" style="display: none;">
                        @csrf
                    </form>

                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
    function konfirmasiTolak() {
        Swal.fire({
            title: 'Tolak Klaim Barang?',
            text: 'Apakah Anda yakin bukti ini tidak cocok dan ingin menolak klaim ini?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#dc3545',
            cancelButtonColor: '#6c757d',
            confirmButtonText: 'Ya, Tolak!',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById('form-tolak').submit();
            }
        });
    }
    </script>
</body>
</html>