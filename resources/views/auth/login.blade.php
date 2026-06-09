<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login - FoundIt</title>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">

    <style>
        body { font-family: 'Poppins', sans-serif; }
        .card-login { border-radius: 15px; border: none; box-shadow: 0 10px 30px rgba(0,0,0,0.1); }
        .btn-navy { background-color: #0a192f; color: white; border: none; }
        .btn-navy:hover { background-color: #112240; color: white; }
        .text-red { color: #dc3545; }
        .cursor-pointer { cursor: pointer; }
    </style>
</head>
<body>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-4">
                <div class="card card-login p-4 mt-5">
                    <a class="d-block text-center mb-3">
                        <img src="{{ asset('images/logo-foundit.png') }}" class="img-fluid" alt="FoundIt Illustration" style="max-width: 120px;">
                    </a>
                    
                    <div class="text-center mb-4">
                        <h6 class="fw-bold mb-1">Login</h6>
                        <h4 class="fw-bold">
                            <span style="color: #750909;">Found</span><span style="color: #212c6b;">It</span>
                        </h4>
                    </div>

                    <form method="POST" action="{{ route('login') }}">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label fw-bold">Name</label>
                            <input type="text" name="username" class="form-control" value="{{ old('username') }}" required autofocus>
                            @error('username') <small class="text-danger">{{ $message }}</small> @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-bold">Email Address</label>
                            <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}" required>
                            @error('email') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-bold">Password</label>
                            <div class="input-group">
                                <input type="password" name="password" id="password" class="form-control" required>
                                <span class="input-group-text show-password cursor-pointer">
                                    <i id="password-lock" class="fas fa-lock text-secondary"></i>
                                </span>
                            </div>
                        </div>

                        <div class="d-grid gap-2 mt-4">
                            <button type="submit" class="btn btn-navy fw-bold py-2">Log In</button>
                        </div>

                        <div class="text-center mt-3">
                            <small>Don't have an account? <a href="{{ route('register') }}" class="text-red text-decoration-none">Register here</a></small>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        $(document).ready(function() {
            $('.show-password').on('click', function(){
                const field = $('#password');
                const icon = $('#password-lock');
                field.attr('type', field.attr('type') === 'password' ? 'text' : 'password');
                icon.toggleClass('fa-lock fa-unlock');
            });
        });
    </script>

    {{-- Kondisional Notifikasi SweetAlert ditempatkan di luar pembungkus tag script --}}
    @if (session('error'))
        <script>
            Swal.fire({
                icon: 'error',
                title: 'Akses Ditolak!',
                text: "{{ session('error') }}",
                confirmButtonColor: '#750909',
                confirmButtonText: 'Mengerti'
            });
        </script>
    @endif

    @if (session()->has('loginError') || $errors->any())
        <script>
            Swal.fire({
                icon: 'error',
                title: 'Login Gagal!',
                text: "{{ session('loginError') ?: $errors->first() }}",
                confirmButtonColor: '#750909',
                confirmButtonText: 'Coba Lagi'
            });
        </script>
    @endif
</body>
</html>