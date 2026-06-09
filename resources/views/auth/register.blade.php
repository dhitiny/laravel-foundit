<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Register - FoundIt</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <style>
        body { font-family: 'Poppins', sans-serif; background-color: #f0f2f5; }
        .card-register { border-radius: 15px; border: none; box-shadow: 0 10px 30px rgba(0,0,0,0.1); }
        .btn-primary { background-color: #5e050e; border: none; }
        .btn-primary:hover { background-color: #4a040b; }
        .text-navy { color: #0a192f; }
    </style>
</head>
<body>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-5">
                <div class="card card-register p-4">
                    <a class="d-block text-center mb-3">
                        <img src="{{ asset('images/logo-foundit.png') }}" class="img-fluid" alt="FoundIt Illustration" style="max-width: 120px;">
                    </a>
                    <div class="text-center mb-4">
                        <h6 class="fw-bold mb-1">Join</h6>
                        <h4 class="fw-bold">
                            <span style="color: #750909;">Found</span><span style="color: #212c6b;">It</span>
                        </h4>
                    </div>
                   
                    <form method="POST" action="{{ route('register') }}">
                        @csrf




                        <div class="mb-3">
                            <label class="form-label fw-bold">Username</label>
                            <input type="text" name="username" class="form-control" value="{{ old('username') }}" required autofocus>
                           
                            @error('username')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>




                        <div class="mb-3">
                            <label class="form-label fw-bold">Email Address</label>
                            <input type="email" name="email" class="form-control" value="{{ old('email') }}" required>
                            @error('email') <small class="text-danger">{{ $message }}</small> @enderror
                        </div>




                        <div class="mb-3">
                            <label class="form-label fw-bold">Password</label>
                            <div class="input-group">
                                <input type="password" name="password" id="password" class="form-control" oninput="checkStrength()" required>
                                <button class="btn btn-outline-secondary show-password" type="button">
                                    <i id="password-lock" class="fas fa-lock"></i>
                                </button>
                            </div>
                            <div class="progress mt-2" style="height: 5px;">
                                <div id="strength-bar" class="progress-bar" role="progressbar" style="width: 0%"></div>
                            </div>
                            <small id="password-text" class="text-muted">Masukkan password</small>
                            @error('password') <br><small class="text-danger">{{ $message }}</small> @enderror
                        </div>




                        <div class="mb-3">
                            <label class="form-label fw-bold">Confirm Password</label>
                            <div class="input-group">
                                <input type="password" name="password_confirmation" id="password_confirmation" class="form-control" required>
                                <button class="btn btn-outline-secondary show-password_confirmation" type="button">
                                    <i id="password_confirmation-lock" class="fas fa-lock"></i>
                                </button>
                            </div>
                        </div>




                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-primary fw-bold py-2">Register</button>
                        </div>




                        <div class="text-center mt-3">
                            <small>Already have an account? <a href="{{ route('login') }}" class="text-danger text-decoration-none">Login here</a></small>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>




    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script>
        @if($errors->any())
            Swal.fire({
                icon: 'error',
                title: 'Pendaftaran Gagal',
                html: `
                    <div class="text-center" style="font-size: 0.95rem; color: #555;">
                        @foreach ($errors->all() as $error)
                            <p class="mb-1"><i class="fas fa-exclamation-circle text-danger me-1"></i> {{ $error }}</p>
                        @endforeach
                    </div>
                `,
                confirmButtonColor: '#5e050e'
            });
        @endif




        // Script Show n Hide Password
        $('.show-password').on('click', function(){
            const field = $('#password');
            const icon = $('#password-lock');
            field.attr('type', field.attr('type') === 'password' ? 'text' : 'password');
            icon.toggleClass('fa-lock fa-unlock');
        });




        $('.show-password_confirmation').on('click', function(){
            const field = $('#password_confirmation');
            const icon = $('#password_confirmation-lock');
            field.attr('type', field.attr('type') === 'password' ? 'text' : 'password');
            icon.toggleClass('fa-lock fa-unlock');
        });




        // Script Strength Bar Password
        function checkStrength() {
            let password = document.getElementById('password').value;
            let strengthBar = document.getElementById('strength-bar');
            let strengthText = document.getElementById('password-text');
            let strength = 0;




            if (password.length >= 8) strength++;
            if (password.match(/[a-z]/) && password.match(/[A-Z]/)) strength++;
            if (password.match(/[0-9]/)) strength++;
            if (password.match(/[^a-zA-Z0-9]/)) strength++;




            if (password.length === 0) {
                updateBar(0, '', 'Masukkan password');
            } else if (strength <= 1) {
                updateBar(25, 'bg-danger', 'Too weak');
            } else if (strength === 2) {
                updateBar(50, 'bg-warning', 'Medium');
            } else if (strength === 3) {
                updateBar(75, 'bg-info', 'Strong');
            } else {
                updateBar(100, 'bg-success', 'Very Strong');
            }




            function updateBar(width, colorClass, text) {
                strengthBar.style.width = width + '%';
                strengthBar.className = 'progress-bar ' + colorClass;
                strengthText.innerHTML = text;
            }
        }
    </script>
</body>
</html>
