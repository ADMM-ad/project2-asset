<form action="{{ route('register') }}" method="POST">
    @csrf

    <!-- Nama Lengkap -->
    <div class="mb-3 position-relative">
        <label class="form-label">Nama Lengkap</label>
        <div class="input-group">
            <span class="input-group-text bg-transparent border-end-0" style="color: var(--primary-color);">
                <i class="fas fa-user"></i>
            </span>
            <input type="text"
                   name="name"
                   class="form-control border-start-0 ps-0"
                   placeholder="Masukkan nama lengkap Anda"
                   value="{{ old('name') }}"
                   required>
        </div>
        @error('name')
            <span class="text-danger small d-block mt-1">
                <i class="fas fa-exclamation-circle me-1"></i>{{ $message }}
            </span>
        @enderror
    </div>

    <!-- Username -->
    <div class="mb-3 position-relative">
        <label class="form-label">Username</label>
        <div class="input-group">
            <span class="input-group-text bg-transparent border-end-0" style="color: var(--primary-color);">
                <i class="fas fa-id-card"></i>
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

    <!-- Password dengan Toggle -->
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
                <i class="fas fa-eye" id="eyeIcon1"></i>
            </span>
        </div>
        @error('password')
            <span class="text-danger small d-block mt-1">
                <i class="fas fa-exclamation-circle me-1"></i>{{ $message }}
            </span>
        @enderror
    </div>

    <!-- Konfirmasi Password dengan Toggle -->
    <div class="mb-3 position-relative">
        <label class="form-label">Konfirmasi Password</label>
        <div class="input-group">
            <span class="input-group-text bg-transparent border-end-0" style="color: var(--primary-color);">
                <i class="fas fa-lock"></i>
            </span>
            <input type="password"
                   name="password_confirmation"
                   id="password_confirmation"
                   class="form-control border-start-0 border-end-0 ps-0"
                   placeholder="Konfirmasi password Anda"
                   required>
            <span class="input-group-text bg-transparent cursor-pointer" id="toggleConfirmPassword">
                <i class="fas fa-eye" id="eyeIcon2"></i>
            </span>
        </div>
    </div>

    <!-- Tombol Daftar -->
    <div class="d-flex justify-content-center mt-4">
        <button type="submit" class="btn w-75"
                style="background-color: var(--primary-color);
                       border-color: var(--primary-color);
                       color: white;
                       padding: 0.75rem;
                       border-radius: 8px;
                       font-weight: 600;
                       transition: all 0.3s;">
            <i class="fas fa-user-plus me-2"></i> Daftar Sekarang
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
    .btn:active { transform: translateY(0); }

    .input-group-text {
        background-color: #f8fafc;
        border-color: #dee2e6;
        transition: all 0.3s;
    }

    /* Hover effect untuk icon mata */
    [id^="toggle"] {
        cursor: pointer;
        user-select: none;
    }
    [id^="toggle"]:hover {
        background-color: #e2e8f0 !important;
    }
</style>

<!-- Script Toggle Password (kedua field) -->
<script>
    // Toggle Password Utama
    document.getElementById('togglePassword').addEventListener('click', function () {
        const passwordField = document.getElementById('password');
        const eyeIcon = document.getElementById('eyeIcon1');

        if (passwordField.type === 'password') {
            passwordField.type = 'text';
            eyeIcon.classList.replace('fa-eye', 'fa-eye-slash');
        } else {
            passwordField.type = 'password';
            eyeIcon.classList.replace('fa-eye-slash', 'fa-eye');
        }
    });

    // Toggle Konfirmasi Password
    document.getElementById('toggleConfirmPassword').addEventListener('click', function () {
        const confirmField = document.getElementById('password_confirmation');
        const eyeIcon = document.getElementById('eyeIcon2');

        if (confirmField.type === 'password') {
            confirmField.type = 'text';
            eyeIcon.classList.replace('fa-eye', 'fa-eye-slash');
        } else {
            confirmField.type = 'password';
            eyeIcon.classList.replace('fa-eye-slash', 'fa-eye');
        }
    });
</script>