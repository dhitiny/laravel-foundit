<x-guest-layout>
    @if (session('status'))
        <div class="alert alert-success mb-3">
            {{ session('status') }}
        </div>
    @endif

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <div class="mb-3">
            <label class="form-label">Name</label>
            <input type="text" name="username" class="form-control" value="{{ old('name') }}" required autofocus>
            @error('name') <small class="text-danger">{{ $message }}</small> @enderror
        </div>

        <div class="mb-3">
            <label class="form-label text-secondary">Email</label>
            <input type="email" id="email" name="email" class="form-control form-control-lg" value="{{ old('email') }}" required autofocus>
            @error('email') <small class="text-danger">{{ $message }}</small> @enderror
        </div>

        <div class="mb-3">
            <label class="form-label text-secondary">Password</label>
            <div class="input-group">
                <input type="password" name="password" id="password" class="form-control form-control-lg" required>
                <button class="btn btn-outline-secondary show-password" type="button">
                    <i id="password-lock" class="fas fa-lock"></i>
                </button>
            </div>
            @error('password') <small class="text-danger">{{ $message }}</small> @enderror
        </div>

        <div class="mb-3 form-check">
            <input type="checkbox" name="remember" class="form-check-input" id="remember_me">
            <label class="form-check-label text-muted" for="remember_me">Remember Me</label>
        </div>

        <div class="d-grid gap-2">
            <button type="submit" class="btn btn-primary btn-lg shadow-sm">Login</button>
        </div>

        <div class="text-center mt-4">
            @if (Route::has('password.request'))
                <a href="{{ route('password.request') }}" class="text-decoration-none d-block mb-2">Forget Password</a>
            @endif
            <span class="text-muted">Don't have an account yet?</span> 
            <a href="{{ route('register') }}" class="text-decoration-none">Register Now</a>
        </div>
    </form>

    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

    <script>
        $('.show-password').on('click', function(){
            const passwordField = $('#password');
            const lockIcon = $('#password-lock');

            if(passwordField.attr('type') == 'password'){
                passwordField.attr('type', 'text');
                lockIcon.attr('class', 'fas fa-unlock');
            } else {
                passwordField.attr('type', 'password');
                lockIcon.attr('class', 'fas fa-lock');
            }
        });
    </script>
</x-guest-layout>