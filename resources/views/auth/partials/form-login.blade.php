<form action="{{ route('login') }}" method="POST">
    @csrf

    <!-- Username Field -->
    <div class="mb-3 position-relative">
        <label class="form-label">Username</label>
        <div class="input-group">
            <span class="input-group-text bg-transparent border-end-0" style="color: var(--primary-color);">
                <i class="fas fa-user"></i>
            </span>
            <input type="text"
                   name="username"
                   class="form-control border-start-0 ps-0"
                   placeholder="Masukkan username Anda"
                   value="{{ old('username') }}"
                   required>
        </div>
        @error('username')
            <span class="text-danger small d-block mt-1">
                <i class="fas fa-exclamation-circle me-1"></i>{{ $message }}
            </span>
        @enderror
    </div>

    <!-- Password Field dengan Toggle Icon -->
    <div class="mb-3 position-relative">
        <label class="form-label">Password</label>
        <div class="input-group">
            <span class="input-group-text bg-transparent border-end-0" style="color: var(--primary-color);">
                <i class="fas fa-lock"></i>
            </span>
            <input type="password"
                   name="password"
                   id="password"
                   class="form-control border-start-0 border-end-0 ps-0"
                   placeholder="Masukkan password Anda"
                   required>
            <span class="input-group-text bg-transparent cursor-pointer" id="togglePassword">
                <i class="fas fa-eye" id="eyeIcon"></i>
            </span>
        </div>
        @error('password')
            <span class="text-danger small d-block mt-1">
                <i class="fas fa-exclamation-circle me-1"></i>{{ $message }}
            </span>
        @enderror
    </div>

    <!-- Login Button -->
    <div class="d-flex justify-content-center mt-4">
        <button type="submit" class="btn w-75"
                style="background-color: var(--primary-color);
                       border-color: var(--primary-color);
                       color: white;
                       padding: 0.75rem;
                       border-radius: 8px;
                       font-weight: 600;
                       transition: all 0.3s;">
            <i class="fas fa-sign-in-alt me-2"></i> Login
        </button>
    </div>
</form>

<style>
    .btn:hover {
        background-color: var(--primary-hover) !important;
        border-color: var(--primary-hover) !important;
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(6, 182, 212, 0.3);
    }
    
    .btn:active {
        transform: translateY(0);
    }

    .input-group-text {
        background-color: #f8fafc;
        border-color: #dee2e6;
        transition: all 0.3s;
    }

    /* Style untuk icon mata */
    #togglePassword {
        cursor: pointer;
        user-select: none;
    }

    #togglePassword:hover {
        background-color: #e2e8f0;
    }
</style>

<!-- Script Toggle Password -->
<script>
    const togglePassword = document.getElementById('togglePassword');
    const passwordField = document.getElementById('password');
    const eyeIcon = document.getElementById('eyeIcon');

    togglePassword.addEventListener('click', function () {
        // Toggle tipe input
        const type = passwordField.getAttribute('type') === 'password' ? 'text' : 'password';
        passwordField.setAttribute('type', type);

        // Ganti icon mata
        if (type === 'text') {
            eyeIcon.classList.remove('fa-eye');
            eyeIcon.classList.add('fa-eye-slash');
        } else {
            eyeIcon.classList.remove('fa-eye-slash');
            eyeIcon.classList.add('fa-eye');
        }
    });
</script>