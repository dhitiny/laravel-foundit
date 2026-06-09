<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $jenisForm === 'pengembalian' ? 'Formulir Pengembalian Barang' : 'Formulir Klaim Barang' }} - FoundIt</title>
    
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
        .highlight-header { background: linear-gradient(135deg, #001f3f 0%, #8b0000 100%); padding: 40px 0 80px; color: white; }
        .card-form { background: white; border-radius: 25px; padding: 30px; margin-top: -40px; box-shadow: 0 10px 30px rgba(0,0,0,0.05); position: relative; z-index: 10; }
        .form-label { font-weight: 600; color: #001f3f; }
        .btn-submit { background-color: #8b0000; color: white; font-weight: 600; border-radius: 10px; padding: 10px 25px; border: none; transition: 0.2s; }
        .btn-submit:hover { background-color: #6a0000; color: white; }
        .form-control[readonly] { background-color: #f1f3f4; color: #5f6368; cursor: not-allowed; }
        .badge-jenis { font-size: 12px; padding: 5px 12px; border-radius: 20px; font-weight: 600; }
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

    <div class="highlight-header">
        <div class="container text-center text-md-start py-2">
            @if($jenisForm === 'pengembalian')
                <h3 class="fw-bold m-0"><i class="bi bi-arrow-left-right me-2"></i> Formulir Pengembalian Barang</h3>
                <p class="text-white-50 small m-0 mt-1">Isi formulir ini untuk memverifikasi kecocokan barang dengan pemilik asli laporan kehilangan.</p>
            @else
                <h3 class="fw-bold m-0"><i class="bi bi-shield-check me-2"></i> Formulir Klaim Kepemilikan Barang</h3>
                <p class="text-white-50 small m-0 mt-1">Buktikan kepemilikan Anda dengan mengisi detail ciri khusus barang secara valid.</p>
            @endif
        </div>
    </div>

    <div class="container mb-5">
        <div class="row justify-content-center">
            <div class="col-12 col-md-8 col-lg-7">
                
                <div class="card card-form border">
                    <form action="{{ route('klaim.store', $item->id_item) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        
                        <input type="hidden" name="jenis_form" value="{{ $jenisForm }}">

                        <div class="mb-4">
                            <label class="form-label d-flex justify-content-between align-items-center">
                                <span>Barang Yang Ingin {{ $jenisForm === 'pengembalian' ? 'Saya Kembalikan' : 'Saya Klaim' }}</span>
                                @if($item->jenis_barang === 'hilang')
                                    <span class="badge-jenis bg-danger text-white">Laporan Kehilangan</span>
                                @else
                                   <span class="badge-jenis text-white" style="background-color: #001f3f;">Laporan Temuan</span>
                                @endif
                            </label>
                            <input type="text" value="{{ $item->nama_barang }}" class="form-control" readonly>
                        </div>

                        <div class="mb-4">
                            <label class="form-label">
                                {{ $jenisForm === 'pengembalian' ? 'Nama Pengembali / Penemu (Akun Anda)' : 'Nama Pengklaim / Pemilik (Akun Anda)' }}
                            </label>
                            <input type="text" name="nama_pengklaim" value="{{ old('nama_pengklaim', auth()->user()->username) }}" class="form-control @error('nama_pengklaim') is-invalid @enderror" required>
                            @error('nama_pengklaim')
                                <p class="text-danger small mt-1 mb-0"><i class="bi bi-exclamation-triangle-fill me-1"></i>{{ $message }}</p>
                            @enderror
                        </div>

                        @if($jenisForm === 'pengembalian')
                            <div class="mb-4">
                                <label for="ciri_khusus" class="form-label">Kronologi Penemuan & Kesesuaian Ciri Barang</label>
                                <textarea name="ciri_khusus" id="ciri_khusus" rows="4" 
                                          placeholder="Jelaskan kronologi singkat bagaimana/di mana Anda menemukan barang ini, serta konfirmasi ciri-ciri khusus barang yang Anda temukan agar cocok dengan pemilik laporan..." 
                                          class="form-control @error('ciri_khusus') is-invalid @enderror" required>{{ old('ciri_khusus') }}</textarea>
                                @error('ciri_khusus')
                                    <p class="text-danger small mt-1 mb-0"><i class="bi bi-exclamation-triangle-fill me-1"></i>{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="mb-5">
                                <label for="bukti_foto" class="form-label">Foto Barang Yang Anda Temukan Saat Ini (Wajib)</label>
                                <input type="file" name="bukti_foto" id="bukti_foto" class="form-control @error('bukti_foto') is-invalid @enderror" required>
                                <div class="form-text text-muted" style="font-size: 11px;">Unggah foto kondisi terkini barang yang Anda temukan sebagai bukti fisik awal untuk pemilik.</div>
                                @error('bukti_foto')
                                    <p class="text-danger small mt-1 mb-0"><i class="bi bi-exclamation-triangle-fill me-1"></i>{{ $message }}</p>
                                @enderror
                            </div>
                        @else
                            <div class="mb-4">
                                <label for="ciri_khusus" class="form-label">Sebutkan Ciri Khusus Rahasia Barang</label>
                                <textarea name="ciri_khusus" id="ciri_khusus" rows="4" 
                                          placeholder="Sebutkan ciri spesifik yang sengaja tidak ditulis oleh penemu di deskripsi umum (contoh: ada goresan rahasia, gantungan kunci tertentu, isi saldo dompet, wallpaper hp, dll)..." 
                                          class="form-control @error('ciri_khusus') is-invalid @enderror" required>{{ old('ciri_khusus') }}</textarea>
                                @error('ciri_khusus')
                                    <p class="text-danger small mt-1 mb-0"><i class="bi bi-exclamation-triangle-fill me-1"></i>{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="mb-5">
                                <label for="bukti_foto" class="form-label">Foto Bukti Pendukung Kepemilikan (Opsional: Nota/Dus/Foto Lama)</label>
                                <input type="file" name="bukti_foto" id="bukti_foto" class="form-control @error('bukti_foto') is-invalid @enderror">
                                <div class="form-text text-muted" style="font-size: 11px;">Unggah bukti berupa struk pembelian, kotak kemasan, atau foto lama bersama barang tersebut untuk mempercepat validasi.</div>
                                @error('bukti_foto')
                                    <p class="text-danger small mt-1 mb-0"><i class="bi bi-exclamation-triangle-fill me-1"></i>{{ $message }}</p>
                                @enderror
                            </div>
                        @endif

                        <div class="d-flex align-items-center justify-content-end border-top pt-4 gap-3">
                            <a href="{{ route('barang.detail', $item->id_item) }}" class="btn btn-link text-secondary text-decoration-none small fw-medium">
                                Batal
                            </a>
                            <button type="submit" class="btn btn-submit shadow-sm">
                                {{ $jenisForm === 'pengembalian' ? 'Kirim Formulir Pengembalian' : 'Kirim Formulir Klaim' }}
                            </button>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        @if(session('error'))
            Swal.fire({
                icon: 'error',
                title: 'Gagal Proses',
                text: "{{ session('error') }}",
                confirmButtonColor: '#8b0000'
            });
        @endif
    </script>
</body>
</html>