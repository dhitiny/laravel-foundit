<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Post Barang Hilang - FoundIt</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f7f1e6; /* Tema krem profil */
            color: #333;
        }
        /* NAVBAR FOUNDIT UPDATE */
        .navbar-foundit { 
            background-color: #f7f1e6; 
            padding: 15px 0; 
        }
        .navbar-brand { 
            font-weight: 800; 
            font-size: 1.5rem; 
        }
        .nav-link { 
            color: #001f3f !important; 
            font-weight: 600; 
            transition: 0.2s;
        }
        .nav-link:hover { 
            color: #8b0000 !important; 
        }

        /* HIGHLIGHT SUB-HEADER (Merah Solid Polos Asli) */
        .highlight-header {
            background-color: #8b0000; 
            color: white;
            padding: 40px 0 70px;
            box-shadow: 0 4px 10px rgba(0,0,0,0.08);
        }
        
        /* FORM CARD */
        .card-form {
            border: none;
            border-radius: 20px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.05);
            background: white;
            margin-top: -45px;
        }
        .form-label {
            font-weight: 500;
            color: #495057;
            font-size: 0.9rem;
        }
        .form-control:focus, .form-select:focus {
            border-color: #8b0000;
            box-shadow: 0 0 0 0.25rem rgba(139, 0, 0, 0.15);
        }
        .btn-submit {
            background-color: #8b0000;
            color: white;
            font-weight: 600;
            text-transform: uppercase;
            font-size: 0.75rem;
            letter-spacing: 1px;
            padding: 12px 25px;
            border-radius: 8px;
            transition: 0.2s;
        }
        .btn-submit:hover {
            background-color: #a71d2a;
            color: white;
        }
    </style>
</head>
<body>

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-foundit sticky-top">
        <div class="container">
            <a class="navbar-brand d-flex align-items-center gap-2 text-decoration-none" href="/homepage" style="color: #750909;">
                <img src="{{ asset('images/logo-foundit.png') }}" alt="Logo FoundIt" height="32" class="d-inline-block align-text-top">
                <span>Found<span style="color: #212c6b;">It</span></span>
            </a>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0 ms-lg-4">
                    <li class="nav-item"><a class="nav-link" href="/homepage">Beranda</a></li>
                    <li class="nav-item"><a class="nav-link active" href="/homepage#laporBarang">Lapor Barang</a></li>
                    <li class="nav-item"><a class="nav-link" href="/homepage#smartMatching">Smart Matching</a></li>
                    <li class="nav-item"><a class="nav-link" href="/badgeInfo">Badge</a></li>
                </ul>
                
                <!-- Dropdown Profil User -->
                <div class="dropdown">
                    <a class="nav-link dropdown-toggle d-flex align-items-center gap-2" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        @if(auth()->user()->foto_profil)
                            <img src="{{ asset('storage/' . auth()->user()->foto_profil) }}" class="rounded-circle" width="35" height="35" style="object-fit: cover;">
                        @else
                            <img src="https://ui-avatars.com/api/?name={{ auth()->user()->username }}&background=8b0000&color=fff" class="rounded-circle" width="35" height="35">
                        @endif
                        <span class="fw-semibold" style="color: #001f3f;">{{ auth()->user()->username }}</span>
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

    <!-- Sub-Header Info Laporan -->
    <div class="highlight-header">
        <div class="container text-center text-md-start py-2">
            <h3 class="fw-bold m-0"><i class="bi bi-megaphone-fill me-2"></i> Buat Laporan Barang Hilang</h3>
            <p class="text-white-50 small m-0 mt-1">Isi formulir di bawah dengan data sebenar-benarnya untuk membantu proses pencarian.</p>
        </div>
    </div>

    <!-- Area Konten Form -->
    <div class="container mb-5">
        <div class="row justify-content-center">
            <div class="col-12 col-md-8 col-lg-7">
                
                <div class="card card-form p-4 p-sm-5 border">
                    <form action="{{ route('PostBarangHilang.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="mb-4">
                            <label for="item_name" class="form-label">Nama Barang Hilang</label>
                            <input type="text" name="item_name" id="item_name" value="{{ old('item_name') }}" placeholder="Misal: Dompet Kulit Cokelat" class="form-control" required>
                        </div>

                        <div class="mb-4">
                            <label for="location" class="form-label">Lokasi Terakhir Terlihat</label>
                            <input type="text" name="location" id="location" value="{{ old('location') }}" placeholder="Contoh: Parkiran Motor Belakang" class="form-control" required>
                        </div>

                        <div class="mb-4">
                            <label for="lost_date" class="form-label">Tanggal & Waktu Hilang</label>
                            <input type="datetime-local" name="lost_date" id="lost_date" value="{{ old('lost_date') }}" class="form-control" required>
                        </div>

                        <div class="mb-4">
                            <label for="kategori" class="form-label">Kategori Barang</label>
                            <select name="kategori" id="kategori" class="form-select" required>
                                <option value="">-- Pilih Kategori --</option>
                                <option value="Elektronik" {{ old('kategori') == 'Elektronik' ? 'selected' : '' }}>Elektronik</option>
                                <option value="Dokumen" {{ old('kategori') == 'Dokumen' ? 'selected' : '' }}>Dokumen</option>
                                <option value="Aksesoris" {{ old('kategori') == 'Aksesoris' ? 'selected' : '' }}>Aksesoris</option>
                                <option value="Pakaian" {{ old('kategori') == 'Pakaian' ? 'selected' : '' }}>Pakaian</option>
                                <option value="Lainnya" {{ old('kategori') == 'Lainnya' ? 'selected' : '' }}>Lainnya</option>
                            </select>
                            @error('kategori') 
                                <p class="text-danger small mt-1 mb-0"><i class="bi bi-exclamation-triangle-fill me-1"></i>{{ $message }}</p> 
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="description" class="form-label">Deskripsi Ciri-ciri</label>
                            <textarea name="description" id="description" rows="3" placeholder="Sebutkan ciri unik, isi dompet, atau tanda khusus..." class="form-control" required>{{ old('description') }}</textarea>
                        </div>

                        <div class="mb-5">
                            <label for="image" class="form-label">Foto Barang (Jika Ada)</label>
                            <input type="file" name="image" id="image" class="form-control">
                            <div class="form-text text-muted" style="font-size: 11px;">Format file wajib: JPG, JPEG, atau PNG.</div>
                        </div>

                        <div class="d-flex align-items-center justify-content-end border-top pt-4 gap-3">
                            <a href="{{ route('homepage') }}" class="btn btn-link text-secondary text-decoration-none small fw-medium">
                                Batal
                            </a>
                            <button type="submit" class="btn btn-submit shadow-sm">
                                Laporkan Kehilangan
                            </button>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        document.querySelector('form').addEventListener('submit', function(e) {
            e.preventDefault();
            const form = this;

            // SweetAlert Minimalis & Modern (Tanpa ikon tanda tanya biru yang jadul)
            Swal.fire({
                title: '<span style="font-weight: 700; color: #001f3f; font-size: 1.3rem;">Konfirmasi Laporan</span>',
                html: '<p style="color: #555; font-size: 0.95rem; margin-bottom: 0;">Apakah kamu yakin ingin memposting laporan kehilangan ini?</p>',
                showCancelButton: true,
                confirmButtonColor: '#8b0000', // Merah marun solid matches your theme
                cancelButtonColor: '#eaeaea',  // Abu-abu soft minimalis
                confirmButtonText: 'Ya, Posting!',
                cancelButtonText: 'Batal',
                reverseButtons: true, // Membikin tombol "Batal" di kiri, "Ya" di kanan (standar UI modern)
                background: '#ffffff',
                padding: '2.5rem',
                customClass: {
                    popup: 'border-0 shadow-lg rounded-4',
                    confirmButton: 'px-4 py-2 fw-semibold border-0 text-white',
                    cancelButton: 'px-4 py-2 fw-semibold text-secondary'
                }
            }).then((result) => {
                if (result.isConfirmed) {
                    // Animasi loading transparan halus saat submit data
                    Swal.fire({
                        title: 'Memposting Laporan...',
                        allowOutsideClick: false,
                        showConfirmButton: false,
                        didOpen: () => {
                            Swal.showLoading();
                        }
                    });
                    
                    form.submit();
                }
            });
        });
    </script>
</body>
</html>