<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Profil - FoundIt</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">

    <style>
        body { font-family: 'Poppins', sans-serif; background-color: #f4f7f9; color: #333; }
        .navbar-foundit { background-color: #fdfbf7; padding: 15px 0; }
        .navbar-brand { font-weight: 800; font-size: 1.5rem; }
        .nav-link { color: #001f3f !important; font-weight: 600; }
        .nav-link:hover { color: #8b0000 !important; }
        
        .card-custom { border: none; border-radius: 20px; box-shadow: 0 4px 20px rgba(0,0,0,0.05); background: white; }
        .form-control:focus { border-color: #8b0000; box-shadow: 0 0 0 0.25rem rgba(139, 0, 0, 0.25); }
        .btn-save { background-color: #8b0000; color: white; border-radius: 50px; font-weight: 600; }
        .btn-save:hover { background-color: #6b0000; color: white; }
    </style>
</head>
<body>

    <nav class="navbar navbar-expand-lg navbar-foundit sticky-top">
        <div class="container">
            <a class="navbar-brand" href="/homepage" style="color: #750909;">Found<span style="color: #212c6b;">It</span></a>
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
                        <span class="text-black">{{ auth()->user()->username }}</span>
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

    <div class="container my-5" style="max-width: 800px;">
        <div class="d-flex align-items-center justify-content-between mb-4">
            <h3 class="fw-bold m-0"><i class="bi bi-gear-fill text-secondary me-2"></i> Pengaturan Profil</h3>
            <a href="{{ route('profile.myprofile') }}" class="btn btn-outline-secondary rounded-pill px-4 btn-sm fw-semibold">
                <i class="bi bi-arrow-left me-1"></i> Kembali
            </a>
        </div>

        <div class="card card-custom p-4 mb-4">
            <h5 class="fw-bold text-dark mb-1">Informasi Profil</h5>
            <p class="text-muted small mb-4">Perbarui informasi nama akun, email, nomor WhatsApp, dan foto profil kamu.</p>

            <form method="POST" action="{{ route('profile.update') }}" enctype="multipart/form-data">
                @csrf
                @method('patch')

                <div class="mb-4 text-center text-sm-start d-sm-flex align-items-center gap-4">
                    <div>
                        @if(auth()->user()->foto_profil)
                            <img src="{{ asset('storage/' . auth()->user()->foto_profil) }}" class="rounded-circle border shadow-sm object-cover mb-3 mb-sm-0" style="width: 100px; height: 100px;">
                        @else
                            <img src="https://ui-avatars.com/api/?name={{ auth()->user()->username }}&background=8b0000&color=fff" class="rounded-circle border shadow-sm mb-3 mb-sm-0" style="width: 100px; height: 100px;">
                        @endif
                    </div>
                    <div class="w-100">
                        <label for="foto_profil" class="form-label fw-semibold small">Ganti Foto Profil</label>
                        <input type="file" name="foto_profil" id="foto_profil" class="form-control form-control-sm @error('foto_profil') is-invalid @enderror">
                        @error('foto_profil') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                </div>

                <div class="mb-3">
                    <label for="username" class="form-label fw-semibold small">Username</label>
                    <input type="text" name="username" id="username" class="form-control @error('username') is-invalid @enderror" value="{{ old('username', auth()->user()->username) }}" required>
                    @error('username') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                <div class="mb-3">
                    <label for="email" class="form-label fw-semibold small">Email</label>
                    <input type="email" name="email" id="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email', auth()->user()->email) }}" required>
                    @error('email') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                <div class="mb-4">
                    <label for="no_wa" class="form-label fw-semibold small">Nomor WhatsApp (Contoh: 08123456789)</label>
                    <input type="text" name="no_wa" id="no_wa" class="form-control @error('no_wa') is-invalid @enderror" value="{{ old('no_wa', auth()->user()->no_wa ?? '') }}" placeholder="Masukkan nomor WhatsApp aktif">
                    @error('no_wa') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                <div class="text-end">
                    <button type="submit" class="btn btn-save px-4 rounded-pill">Simpan Perubahan</button>
                </div>
            </form>
        </div>

        <div class="card card-custom p-4">
            <h5 class="fw-bold text-dark mb-1">Perbarui Password</h5>
            <p class="text-muted small mb-4">Pastikan akun Anda menggunakan kata sandi yang panjang dan acak agar tetap aman.</p>

            <form method="POST" action="{{ route('password.update') }}">
                @csrf
                @method('put')

                <div class="mb-3">
                    <label for="update_password_current_password" class="form-label fw-semibold small">Password Saat Ini</label>
                    <input type="password" name="current_password" id="update_password_current_password" class="form-control @error('current_password', 'updatePassword') is-invalid @enderror" autocomplete="current-password">
                    @error('current_password', 'updatePassword') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                <div class="mb-3">
                    <label for="update_password_password" class="form-label fw-semibold small">Password Baru</label>
                    <input type="password" name="password" id="update_password_password" class="form-control @error('password', 'updatePassword') is-invalid @enderror" autocomplete="new-password">
                    @error('password', 'updatePassword') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                <div class="mb-4">
                    <label for="update_password_password_confirmation" class="form-label fw-semibold small">Konfirmasi Password Baru</label>
                    <input type="password" name="password_confirmation" id="update_password_password_confirmation" class="form-control @error('password_confirmation', 'updatePassword') is-invalid @enderror" autocomplete="new-password">
                    @error('password_confirmation', 'updatePassword') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                <div class="text-end">
                    <button type="submit" class="btn btn-dark px-4 rounded-pill">Perbarui Password</button>
                </div>
            </form>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // 1. Notifikasi Jika Berhasil Simpan Profil / Password
            @if (session('status') === 'profile-updated' || session('status') === 'password-updated')
                Swal.fire({
                    icon: 'success',
                    title: 'Berhasil!',
                    text: 'Perubahan data kamu telah sukses disimpan.',
                    confirmButtonColor: '#8b0000'
                });
            @endif

            // 2. Notifikasi Jika Ada Validasi yang Gagal (Error Input)
            @if ($errors->any() || $errors->updatePassword->any())
                Swal.fire({
                    icon: 'error',
                    title: 'Waduh, Gagal!',
                    text: 'Ada inputan yang salah atau belum lengkap. Silakan cek form kembali.',
                    confirmButtonColor: '#333'
                });
            @endif
        });
    </script>
</body>
</html>