@extends('master')
@section('title', 'Edit Profil')
@section('content')
<div class="container-fluid py-4">
    <div class="card-header bg-white border-0">
        <h5 class="mb-0" style="color: #06b6d4 !important;">
            <i class="fas fa-edit me-2"></i> Edit profile
        </h5>
    </div>
    <div class="card-body p-4">
        <form action="{{ route('profile.update') }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-4">
                <label class="form-label fw-semibold">Nama Lengkap</label>
                <input type="text" name="name" class="form-control @error('name') is-invalid @enderror"
                       value="{{ old('name', Auth::user()->name) }}" required>
                @error('name') <div class="text-danger small mt-1">{{ $message }}</div> @enderror
            </div>

            <div class="mb-4">
                <label class="form-label fw-semibold">Username</label>
                <input type="text" name="username" class="form-control @error('username') is-invalid @enderror"
                       value="{{ old('username', Auth::user()->username) }}" required>
                @error('username') <div class="text-danger small mt-1">{{ $message }}</div> @enderror
            </div>

            <!-- Password Baru dengan Icon Mata -->
            <div class="mb-4">
                <label class="form-label fw-semibold">Password Baru 
                    <small class="text-muted">(kosongkan jika tidak ingin ganti)</small>
                </label>
                <div class="input-group">
                    <input type="password" 
                           name="password" 
                           id="password"
                           class="form-control @error('password') is-invalid @enderror"
                           placeholder="Minimal 6 karakter">
                    <span class="input-group-text bg-transparent cursor-pointer" id="togglePassword">
                        <i class="fas fa-eye" id="eyeIcon1"></i>
                    </span>
                </div>
                @error('password') <div class="text-danger small mt-1">{{ $message }}</div> @enderror
            </div>

            <!-- Konfirmasi Password dengan Icon Mata -->
            <div class="mb-4">
                <label class="form-label fw-semibold">Konfirmasi Password</label>
                <div class="input-group">
                    <input type="password" 
                           name="password_confirmation" 
                           id="password_confirmation"
                           class="form-control">
                    <span class="input-group-text bg-transparent cursor-pointer" id="toggleConfirmPassword">
                        <i class="fas fa-eye" id="eyeIcon2"></i>
                    </span>
                </div>
            </div>

            <div class="text-end">
                <a href="{{ route('profile.index') }}" class="btn btn-secondary me-2">
                    <i class="fas fa-reply"></i> Kembali
                </a>
                <button type="submit" class="btn btn-success">
                    <i class="fas fa-save"></i> Simpan Perubahan
                </button>
            </div>
        </form>
    </div>
</div>

<!-- Style untuk icon mata (agar rapi) -->
<style>
    #togglePassword, #toggleConfirmPassword {
        cursor: pointer;
        user-select: none;
        border: 1px solid #ced4da;
    }
    #togglePassword:hover, #toggleConfirmPassword:hover {
        background-color: #e9ecef !important;
    }
</style>

<!-- Script Toggle Password -->
<script>
    // Toggle Password Baru
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
@endsection