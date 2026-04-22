<x-guest-layout>
    <form method="POST" action="{{ route('register') }}">
        @csrf

        <div class="mb-3">
            <label class="form-label">Name</label>
            <input type="text" name="username" class="form-control" value="{{ old('name') }}" required autofocus>
            @error('name') <small class="text-danger">{{ $message }}</small> @enderror
        </div>


        <div class="mb-3">
            <label class="form-label">Email Adress</label>
            <input type="email" name="email" class="form-control" value="{{ old('email') }}" required>
            @error('email') <small class="text-danger">{{ $message }}</small> @enderror
        </div>

        <div class="mb-3">
            <label class="form-label">Password</label>
            <div class="input-group">
                <input type="password" name="password" id="password" class="form-control" oninput="checkStrength()" required>
                <button class="btn btn-outline-secondary show-password" type="button">
                    <i id="password-lock" class="fas fa-lock"></i>
                </button>
            </div>
            
            <div class="progress mt-2" style="height: 10px;">
                <div id="strength-bar" class="progress-bar" role="progressbar" style="width: 0%"></div>
            </div>
            <small id="password-text" class="text-muted">Masukkan password</small>
        </div>

        <div class="mb-3">
            <label class="form-label">Confirm Password</label>
            <div class="input-group">
                <input type="password" name="password_confirmation" id="password_confirmation" class="form-control" required>
                <button class="btn btn-outline-secondary show-password_confirmation" type="button">
                    <i id="password_confirmation-lock" class="fas fa-lock"></i>
                </button>
            </div>
        </div>

        <div class="d-grid gap-2">
            <button type="submit" class="btn btn-primary">Register</button>
        </div>

        <div class="text-center mt-3">
            <small>Already have an account? <a href="{{ route('login') }}">Login here</a></small>
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
    $('.show-password_confirmation').on('click', function() {
        const confirmField = $('#password_confirmation');
        const confirmIcon = $('#password_confirmation-lock');

        if (confirmField.attr('type') == 'password') {
            confirmField.attr('type', 'text');
            confirmIcon.attr('class', 'fas fa-unlock');
        } else {
            confirmField.attr('type', 'password');
            confirmIcon.attr('class', 'fas fa-lock');
        }
    });

    function checkStrength() {
    let password = document.getElementById('password').value;
    let strengthBar = document.getElementById('strength-bar');
    let strengthText = document.getElementById('password-text');
    let strength = 0;

    if (password.length === 0) {
        updateBar(0, '', 'Inputing Password');
        return;
    }

    if (password.length >= 16) strength++;
    if (password.match(/[a-z]/) && password.match(/[A-Z]/)) strength++; 
    if (password.match(/[0-9]/)) strength++;
    if (password.match(/[^a-zA-Z0-9]/)) strength++; 

    switch (strength) {
        case 0:
            updateBar(0, '', 'Tulis password...');
            break;
        case 1:
            updateBar(25, 'bg-danger', 'Password Too weak');
            break;
        case 2:
            updateBar(50, 'bg-warning', 'Password Still Weak');
            break;
        case 3:
            updateBar(75, 'bg-info', 'Password Strong');
            break;
        case 4:
            updateBar(100, 'bg-success', 'password Very Strong');
            break;
    }

    function updateBar(width, colorClass, text) {
        strengthBar.style.width = width + '%';
        strengthBar.className = 'progress-bar ' + colorClass;
        strengthText.innerHTML = text;
    }
}
</script>
</x-guest-layout>