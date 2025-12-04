{{-- resources/views/auth/home.blade.php --}}
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $mode == 'login' ? 'Login' : 'Daftar' }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
    <style>
        :root {
            --primary-color: #06b6d4;
            --primary-hover: #0891b2;
            --border-color: #e5e7eb;
            --shadow-lg: 0 15px 35px rgba(0,0,0,0.1);
        }
        body {
            background: linear-gradient(135deg, #f0f9ff 0%, #e0f2fe 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 1.5rem;
            margin: 0;
        }
        /* CARD UTAMA - DESKTOP: LEBAR, HP: KOMPAK */
        .auth-card {
            width: 100%;
            background: white;
            border-radius: 24px;
            box-shadow: var(--shadow-lg);
            overflow: hidden;
            margin: auto;
        }
        /* DESKTOP STYLE (≥768px) */
        @media (min-width: 768px) {
            .auth-card {
                max-width: 750px; /* DIKECILKAN DARI 900px -> 750px */
                height: 420px; /* DIKECILKAN DARI 480px -> 420px */
            }
           
            .brand-panel {
                background: linear-gradient(135deg, var(--primary-color), var(--primary-hover));
                color: white;
                padding: 2rem 1.75rem; /* DIKECILKAN DARI 2.5rem -> 2rem */
                height: 100%;
                display: flex;
                flex-direction: column;
                justify-content: center;
                align-items: center;
                text-align: center;
            }
           
            .form-panel {
                padding: 2rem 1.75rem; /* DIKECILKAN DARI 2.5rem -> 2rem */
                height: 100%;
                display: flex;
                flex-direction: column;
                justify-content: center;
            }
           
            .form-area {
                flex: 1;
                overflow-y: auto;
                max-height: 240px; /* DIKECILKAN DARI 280px -> 240px */
                padding-right: 10px;
                margin-bottom: 1.5rem;
            }
        }
        /* MOBILE STYLE (<768px) - TIDAK ADA PERUBAHAN */
        @media (max-width: 767.98px) {
            .auth-card {
                max-width: 380px;
                height: auto;
                min-height: auto;
            }
           
            .brand-panel {
                background: linear-gradient(135deg, var(--primary-color), var(--primary-hover));
                color: white;
                padding: 2rem 1.5rem;
                min-height: 180px;
                display: flex;
                flex-direction: column;
                justify-content: center;
                align-items: center;
                text-align: center;
            }
           
            .form-panel {
                padding: 2rem 1.5rem;
                min-height: 400px;
                display: flex;
                flex-direction: column;
            }
           
            .form-area {
                flex: 1;
                overflow-y: auto;
                max-height: 240px;
                padding-right: 8px;
                margin-bottom: 1rem;
            }
           
            /* Pastikan order benar untuk mobile */
            .order-md-1 {
                order: 1 !important;
            }
           
            .order-md-2 {
                order: 2 !important;
            }
        }
        /* ELEMEN UMUM YANG SAMA UNTUK SEMUA UKURAN */
        .brand-icon {
            font-size: 3rem;
            margin-bottom: 1.5rem;
            opacity: 0.9;
        }
        .brand-title {
            font-size: 1.8rem;
            font-weight: 700;
            margin-bottom: 0.75rem;
        }
        .brand-subtitle {
            font-size: 1rem;
            opacity: 0.9;
            margin-bottom: 2rem;
            max-width: 250px;
        }
        /* TOGGLE BUTTON DI BRAND PANEL */
        .brand-toggle {
            background: rgba(255, 255, 255, 0.15);
            border: 1px solid rgba(255, 255, 255, 0.3);
            color: white;
            padding: 0.75rem 1.75rem;
            border-radius: 10px;
            font-size: 0.9rem;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s;
            text-decoration: none;
            display: inline-block;
        }
        .brand-toggle:hover {
            background: rgba(255, 255, 255, 0.25);
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
        }
        /* FORM HEADER */
        .form-header {
            text-align: center;
            margin-bottom: 2rem;
        }
        .form-title {
            color: var(--primary-color);
            font-size: 1.5rem;
            font-weight: 700;
            margin-bottom: 0.5rem;
        }
        .form-subtitle {
            color: #6b7280;
            font-size: 0.95rem;
        }
        /* FORM ELEMENTS */
        .form-group {
            margin-bottom: 1.25rem;
        }
        .form-label {
            font-size: 0.9rem;
            font-weight: 500;
            color: #374151;
            margin-bottom: 0.5rem;
            display: block;
        }
        .form-control {
            padding: 0.75rem 1rem;
            font-size: 0.9rem;
            border: 1px solid #d1d5db;
            border-radius: 10px;
            transition: all 0.2s;
            width: 100%;
        }
        .form-control:focus {
            border-color: var(--primary-color);
            box-shadow: 0 0 0 3px rgba(6, 182, 212, 0.15);
            outline: none;
        }
        /* TOMBOL SUBMIT */
        .submit-btn {
            background: var(--primary-color);
            color: white;
            border: none;
            padding: 0.85rem;
            font-weight: 600;
            border-radius: 10px;
            width: 100%;
            cursor: pointer;
            transition: background 0.3s;
            font-size: 0.95rem;
            margin-top: 0.75rem;
        }
        .submit-btn:hover {
            background: var(--primary-hover);
            transform: translateY(-1px);
            box-shadow: 0 5px 15px rgba(6, 182, 212, 0.2);
        }
        /* LINK TOGGLE DI BAWAH FORM */
        .form-toggle {
            text-align: center;
            margin-top: 1.25rem;
            font-size: 0.9rem;
            color: #6b7280;
        }
        .toggle-link {
            color: var(--primary-color);
            font-weight: 600;
            text-decoration: none;
            margin-left: 0.5rem;
        }
        .toggle-link:hover {
            color: var(--primary-hover);
            text-decoration: underline;
        }
        /* ANIMASI */
        .fade-in {
            animation: fadeIn 0.5s ease-out;
        }
        @keyframes fadeIn {
            from { opacity: 0; transform: translateX(-20px); }
            to { opacity: 1; transform: translateX(0); }
        }
        /* SCROLLBAR - SAMA UNTUK SEMUA */
        .form-area::-webkit-scrollbar {
            width: 5px;
        }
       
        .form-area::-webkit-scrollbar-track {
            background: #f1f5f9;
            border-radius: 5px;
        }
       
        .form-area::-webkit-scrollbar-thumb {
            background: var(--primary-color);
            border-radius: 5px;
        }
        /* HP SANGAT KECIL */
        @media (max-width: 380px) {
            .auth-card {
                max-width: 95%;
            }
           
            .brand-panel, .form-panel {
                padding: 1.5rem 1.25rem;
            }
           
            .brand-icon {
                font-size: 2.5rem;
            }
           
            .brand-title {
                font-size: 1.5rem;
            }
        }
    </style>
</head>
<body>
@if($mode == 'login')
    <!-- LAYOUT LOGIN -->
    <div class="auth-card">
        <div class="row g-0 h-100">
            <!-- KIRI: BRAND PANEL - Desktop: 40%, Mobile: full width -->
            <div class="col-12 col-md-5 brand-panel fade-in">
                <i class="fas fa-box-open brand-icon"></i>
                <h2 class="brand-title">Management Asset</h2>
                <p class="brand-subtitle">Sistem Manajemen Data Asset</p>
                <a href="{{ route('register') }}" class="brand-toggle">
                    Buat Akun Baru
                </a>
            </div>
            <!-- KANAN: FORM PANEL - Desktop: 60%, Mobile: full width -->
            <div class="col-12 col-md-7 form-panel fade-in">
               
               
                <div class="form-area">
                    @include('auth.partials.form-login')
                </div>
               
                <div class="form-toggle">
                    Belum memiliki akun?
                    <a href="{{ route('register') }}" class="toggle-link">Daftar disini</a>
                </div>
            </div>
        </div>
    </div>
@else
    <!-- LAYOUT REGISTER -->
    <div class="auth-card">
        <div class="row g-0 h-100">
            <!-- KIRI: FORM PANEL - Desktop: 60%, Mobile: full width (order 2) -->
            <div class="col-12 col-md-7 order-md-1 form-panel fade-in">
               
                <div class="form-area">
                    @include('auth.partials.form-register')
                </div>
               
                <div class="form-toggle">
                    Sudah memiliki akun?
                    <a href="{{ route('login') }}" class="toggle-link">Login disini</a>
                </div>
            </div>
            <!-- KANAN: BRAND PANEL - Desktop: 40%, Mobile: full width (order 1) -->
            <div class="col-12 col-md-5 order-md-2 brand-panel fade-in">
                <i class="fas fa-box-open brand-icon"></i>
                <h2 class="brand-title">Management Asset</h2>
                <p class="brand-subtitle">Sistem Manajemen Asset</p>
                <a href="{{ route('login') }}" class="brand-toggle">
                    Sudah Punya Akun
                </a>
            </div>
        </div>
    </div>
@endif
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Fokus ke input pertama
        const firstInput = document.querySelector('.form-group:first-child input');
        if (firstInput) {
            firstInput.focus();
        }
       
        // Atur tinggi form area berdasarkan konten dan ukuran layar
        function adjustFormArea() {
            const formArea = document.querySelector('.form-area');
            const formContent = formArea ? formArea.querySelector('form') : null;
           
            if (formArea && formContent) {
                const contentHeight = formContent.scrollHeight;
                let maxHeight;
               
                // Tentukan maxHeight berdasarkan ukuran layar
                if (window.innerWidth >= 768) {
                    maxHeight = 240; // Desktop - DIKECILKAN DARI 280 -> 240
                } else {
                    maxHeight = 240; // Mobile
                }
               
                if (contentHeight > maxHeight) {
                    formArea.style.maxHeight = maxHeight + 'px';
                    formArea.style.overflowY = 'auto';
                } else {
                    formArea.style.maxHeight = 'none';
                    formArea.style.overflowY = 'visible';
                }
            }
        }
       
        adjustFormArea();
        window.addEventListener('resize', adjustFormArea);
       
        // Atur tinggi card untuk desktop
        function adjustCardHeight() {
            const card = document.querySelector('.auth-card');
            if (window.innerWidth >= 768) {
                // Desktop: fixed height - DIKECILKAN DARI 480px -> 420px
                card.style.height = '420px';
            } else {
                // Mobile: auto height
                card.style.height = 'auto';
            }
        }
       
        adjustCardHeight();
        window.addEventListener('resize', adjustCardHeight);
    });
</script>
</body>
</html>