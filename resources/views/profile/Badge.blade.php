<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Daftar Lencana Resmi - FoundIt</title>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">

    <style>
        /* Style Utama */
        body { font-family: 'Poppins', sans-serif; background-color: #f7f1e6; color: #333; }
        .navbar-foundit { background-color: #f7f1e6; padding: 15px 0; }
        .navbar-brand { font-weight: 800; font-size: 1.5rem; }
        .nav-link { color: #001f3f !important; font-weight: 600; }
        .nav-link:hover { color: #8b0000 !important; }
        
        /* Kontainer Utama Berlatar Belakang Putih */
        .main-content-wrapper {
            background-color: #ffffff;
            border-radius: 30px 30px 0 0;
            box-shadow: 0 -10px 30px rgba(0, 0, 0, 0.03);
            padding-top: 50px;
            padding-bottom: 80px;
            min-height: calc(100vh - 82px);
        }

        /* Style Khusus Halaman Katalog Lencana - DIUBAH KE NAVY */
        .katalog-card { 
            transition: 0.3s; 
            border: none; 
            border-radius: 20px; 
            overflow: hidden; 
            background-color: #001f3f !important; /* Warna Navy */
            color: #ffffff; 
        }
        .katalog-card:hover { 
            transform: translateY(-5px); 
            box-shadow: 0 15px 30px rgba(0, 31, 63, 0.25) !important; 
        }
        .katalog-card .text-muted {
            color: #d1d5db !important; /* Mengubah teks deskripsi menjadi abu-ari terang agar terbaca di background navy */
        }
        
        /* Efek Kilau Lingkaran Badge di Dalam Navy Card */
        .badge-img-wrapper { 
            background: radial-gradient(circle, rgba(255,255,255,1) 0%, rgba(240,244,248,0.8) 100%); 
            padding: 20px; 
            border-radius: 50%; 
            width: 120px; 
            height: 120px; 
            display: flex; 
            align-items: center; 
            justify-content: center; 
            margin: 0 auto; 
        }
        .badge-img { max-width: 80px; filter: drop-shadow(0px 6px 8px rgba(0,0,0,0.15)); }
        
        /* Utilitas Tambahan */
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

    <nav class="navbar navbar-foundit sticky-top">
        <div class="container d-flex justify-content-between align-items-center">
            <a class="navbar-brand d-flex align-items-center gap-2 text-decoration-none" href="/homepage" style="color: #750909;">
                <img src="{{ asset('images/logo-foundit.png') }}" alt="Logo FoundIt" height="32" class="d-inline-block align-text-top">
                <span>Found<span style="color: #212c6b;">It</span></span>
            </a>
            <a href="/homepage" class="btn btn-sm btn-outline-dark rounded-pill px-3">
                <i class="bi bi-arrow-left"></i> Kembali ke Beranda
            </a>
        </div>
    </nav>

    <div class="main-content-wrapper">
        <div class="container">
            
            <div class="text-center mb-5">
                <h1 class="fw-bold text-dark mb-2">🏅 Katalog Lencana Resmi</h1>
                <p class="text-muted fs-5">Selesaikan misi, bantu sesama, dan kumpulkan semua lencana eksklusif di FoundIt!</p>
                <hr class="w-25 mx-auto opacity-25">
            </div>

            <div class="row g-4 justify-content-center">
                
                <div class="col-sm-6 col-md-4 col-lg-3">
                    <div class="card katalog-card p-4 text-center shadow-sm h-100">
                        <div class="badge-img-wrapper mb-3 shadow-inner">
                            <img src="{{ asset('images/badges/First Seeker.png') }}" class="img-fluid badge-img" alt="First Seeker">
                        </div>
                        <h5 class="fw-bold text-white mb-2 fs-5">First Seeker</h5>
                        <p class="text-muted small mb-0 lh-base">Diberikan saat kamu pertama kali melakukan pencarian atau klaim barang di platform ini.</p>
                    </div>
                </div>

                <div class="col-sm-6 col-md-4 col-lg-3">
                    <div class="card katalog-card p-4 text-center shadow-sm h-100">
                        <div class="badge-img-wrapper mb-3 shadow-inner">
                            <img src="{{ asset('images/badges/Active Reporter.png') }}" class="img-fluid badge-img" alt="Active Reporter">
                        </div>
                        <h5 class="fw-bold text-white mb-2 fs-5">Active Reporter</h5>
                        <p class="text-muted small mb-0 lh-base">Diberikan kepada pengguna yang aktif melaporkan barang hilang atau temuan di FoundIt.</p>
                    </div>
                </div>

                <div class="col-sm-6 col-md-4 col-lg-3">
                    <div class="card katalog-card p-4 text-center shadow-sm h-100">
                        <div class="badge-img-wrapper mb-3 shadow-inner">
                            <img src="{{ asset('images/badges/Hero Of Foundit.png') }}" class="img-fluid badge-img" alt="Hero of FoundIt">
                        </div>
                        <h5 class="fw-bold text-white mb-2 fs-5">Hero of FoundIt</h5>
                        <p class="text-muted small mb-0 lh-base">Lencana tertinggi untuk pahlawan yang berhasil mengembalikan barang ke pemilik aslinya.</p>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>