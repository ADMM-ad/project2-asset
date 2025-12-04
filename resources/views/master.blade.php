<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title', 'Management Asset')</title>
    
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- FontAwesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <!-- Custom CSS untuk navbar rounded dan layout -->
    <style>
        :root {
            --navbar-height: 60px; /* DIKECILKAN dari 70px */
            --bg-color: #f9fafb;
            --content-bg: #ffffff;
            --text-color: #374151;
            --text-light: #6b7280;
            --primary-color: #06b6d4;
            --primary-hover: #0891b2;
            --primary-light: #ecfeff;
            --border-color: #e5e7eb;
            --shadow-sm: 0 1px 3px rgba(0, 0, 0, 0.05);
            --shadow-md: 0 4px 6px -1px rgba(0, 0, 0, 0.07);
            --shadow-lg: 0 10px 15px -3px rgba(0, 0, 0, 0.08);
            --radius-lg: 16px;
            --radius-md: 12px;
            --radius-sm: 8px;
        }
        
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            padding-top: calc(var(--navbar-height) + 10px);
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', 'Roboto', sans-serif;
            background-color: var(--bg-color);
            color: var(--text-color);
            min-height: 100vh;
        }
        
        /* NAVBAR OVAL/MEMANJANG & MENGAMBANG - LEBIH KECIL */
        .navbar-custom {
            background-color: var(--content-bg);
            box-shadow: var(--shadow-lg);
            height: var(--navbar-height); /* 60px */
            backdrop-filter: blur(10px);
            background-color: rgba(255, 255, 255, 0.98);
            
            /* OVAL/MEMANJANG - DIKECILKAN */
            border-radius: 40px; /* DIKECILKAN dari 50px */
            margin: 10px auto 0 auto;
            width: 88%; /* DIKECILKAN dari 90% */
            max-width: 1150px; /* DIKECILKAN dari 1200px */
            
            /* Posisi fixed dan floating */
            position: fixed;
            top: 0;
            left: 50%;
            transform: translateX(-50%);
            z-index: 1030;
        }
        
        .navbar-container {
            max-width: 1150px; /* DIKECILKAN dari 1200px */
            margin: 0 auto;
            width: 100%;
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 1.75rem; /* DIKECILKAN dari 2rem */
            height: 100%;
        }
        
        /* BRAND LEBIH KECIL */
        .navbar-brand-custom {
            font-weight: 700;
            font-size: 1.3rem; /* DIKECILKAN dari 1.5rem */
            color: var(--primary-color) !important;
            text-decoration: none;
            display: flex;
            align-items: center;
            gap: 8px; /* DIKECILKAN dari 10px */
        }
        
        .navbar-brand-custom i {
            font-size: 1.5rem; /* DIKECILKAN dari 1.8rem */
        }
        
        /* Navbar toggler (hamburger) LEBIH KECIL */
        .navbar-toggler-custom {
            border: none;
            background: transparent;
            padding: 6px; /* DIKECILKAN dari 8px */
            font-size: 1.3rem; /* DIKECILKAN dari 1.5rem */
            color: var(--text-color);
            cursor: pointer;
        }
        
        .navbar-toggler-custom:focus {
            outline: none;
        }
        
        /* Navbar menu items - DIKECILKAN */
        .navbar-nav-custom {
            display: flex;
            align-items: center;
            gap: 1.25rem; /* DIKECILKAN dari 1.5rem */
            list-style: none;
            margin: 0;
            padding: 0;
        }
        
        .nav-link-custom {
            font-weight: 500;
            color: var(--text-color) !important;
            transition: all 0.2s ease;
            padding: 0.4rem 0; /* DIKECILKAN dari 0.5rem */
            position: relative;
            text-decoration: none;
            display: flex;
            align-items: center;
            gap: 5px; /* DIKECILKAN dari 6px */
            font-size: 0.95rem; /* DIKECILKAN */
        }
        
        .nav-link-custom:hover {
            color: var(--primary-color) !important;
        }
        
        .nav-link-custom::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            width: 0;
            height: 2px;
            background-color: var(--primary-color);
            transition: width 0.3s ease;
        }
        
        .nav-link-custom:hover::after {
            width: 100%;
        }
        
        /* Logout button - DIKECILKAN */
        .btn-logout-custom {
            background-color: var(--primary-color);
            color: white !important;
            border-radius: var(--radius-md);
            padding: 0.4rem 1.25rem !important; /* DIKECILKAN dari 0.5rem 1.5rem */
            border: none;
            font-weight: 500;
            transition: transform 0.2s ease, box-shadow 0.2s ease;
            display: flex;
            align-items: center;
            gap: 5px; /* DIKECILKAN dari 6px */
            text-decoration: none;
            font-size: 0.95rem; /* DIKECILKAN */
        }
        
        .btn-logout-custom:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(6, 182, 212, 0.2);
        }
        
        /* Content area styling - TETAP SAMA */
        .content-wrapper {
            max-width: 1200px;
            margin: 1rem auto;
            width: 100%;
        }
        
        .content-container {
            background-color: var(--content-bg);
            border-radius: var(--radius-lg);
            box-shadow: var(--shadow-lg);
            min-height: 60vh;
        }
        
        
        
        .text-nowrap { white-space: nowrap !important; }

/* Teks panjang → titik-titik + tooltip saat hover */
td span[title] {
    display: block;
    max-width: 100%;
    overflow: hidden;
    text-overflow: ellipsis;
    white-space: nowrap;
}


        /* Mobile Responsive Styles - DIPERBAIKI */
        @media (max-width: 991.98px) {
            .navbar-container {
                padding: 0 1.5rem;
            }
            
            .navbar-custom {
                padding: 0;
                width: 92%; /* DIKECILKAN dari 95% */
                border-radius: 35px; /* DIKECILKAN dari 40px */
            }
            
            .navbar-nav-custom {
                flex-direction: column;
                align-items: flex-start;
                gap: 0;
                width: 100%;
                padding: 0.75rem 0; /* DIKECILKAN dari 1rem */
            }
            
            .nav-link-custom {
                padding: 0.6rem 0; /* DIKECILKAN dari 0.75rem */
                width: 100%;
                font-size: 0.9rem; /* DIKECILKAN */
            }
            
            .nav-link-custom i {
                font-size: 1rem; /* DIKECILKAN */
            }
            
            .nav-link-custom::after {
                display: none;
            }
            
            .btn-logout-custom {
                width: 100%;
                justify-content: center;
                margin-top: 0.5rem;
                padding: 0.6rem 1.25rem !important; /* DIKECILKAN dari 0.75rem 1.5rem */
                font-size: 0.9rem; /* DIKECILKAN */
            }
            
            /* DROPDOWN HAMBURGER - DIBUAT OVAL SEPERTI NAVBAR */
            #navbarNav {
                position: absolute;
                top: 100%;
                left: 0;
                right: 0;
                background-color: var(--content-bg);
                box-shadow: var(--shadow-lg);
                border-radius: 0 0 35px 35px; /* OVAL SEPERTI NAVBAR - 35px */
                z-index: 1000;
                max-height: 0;
                overflow: hidden;
                transition: max-height 0.4s cubic-bezier(0.4, 0, 0.2, 1);
                margin-top: 5px; /* Sedikit jarak dari navbar */
            }
            
            #navbarNav.show {
                max-height: 350px; /* DIKECILKAN dari 400px */
                padding: 0 1.5rem;
            }
            
            #navbarNav .navbar-nav-custom {
                transform: translateY(-10px);
                opacity: 0;
                transition: transform 0.3s ease, opacity 0.3s ease;
            }
            
            #navbarNav.show .navbar-nav-custom {
                transform: translateY(0);
                opacity: 1;
            }
            
            .content-wrapper {
                padding: 0 0.5rem;
            }
        }
        
        @media (max-width: 767.98px) {
            .navbar-brand-custom span {
                font-size: 1.2rem; /* DIKECILKAN dari 1.3rem */
            }
            
            .navbar-custom {
                height: 55px; /* DIKECILKAN dari 65px */
                width: 90%; /* DIKECILKAN dari 92% */
                border-radius: 30px; /* DIKECILKAN dari 35px */
            }
            
            body {
                padding-top: calc(55px + 10px); /* DIKECILKAN */
            }
            
            .navbar-container {
                padding: 0 1.25rem;
            }
            
            /* DROPDOWN OVAL SESUAI */
            #navbarNav {
                border-radius: 0 0 30px 30px; /* DIKECILKAN sesuai navbar */
            }
        }
        
        @media (max-width: 575.98px) {
            .navbar-brand-custom span {
                font-size: 1.1rem; /* DIKECILKAN dari 1.2rem */
            }
            
            .navbar-brand-custom i {
                font-size: 1.3rem; /* DIKECILKAN dari 1.5rem */
            }
            
            .navbar-custom {
                width: 92%; /* DIKECILKAN dari 94% */
                border-radius: 25px; /* DIKECILKAN dari 30px */
            }
            
            .navbar-container {
                padding: 0 1rem;
            }
            
            .navbar-toggler-custom {
                font-size: 1.2rem; /* DIKECILKAN */
                padding: 5px; /* DIKECILKAN */
            }
            
            /* DROPDOWN OVAL SESUAI */
            #navbarNav {
                border-radius: 0 0 25px 25px; /* DIKECILKAN sesuai navbar */
            }
        }
        
        @media (max-width: 380px) {
            .navbar-custom {
                width: 94%; /* DIKECILKAN dari 96% */
                border-radius: 20px; /* DIKECILKAN dari 25px */
                height: 52px; /* LEBIH KECIL */
            }
            
            .navbar-container {
                padding: 0 0.75rem;
            }
            
            .navbar-brand-custom {
                font-size: 1rem; /* LEBIH KECIL */
                gap: 6px; /* LEBIH KECIL */
            }
            
            .navbar-brand-custom i {
                font-size: 1.2rem; /* LEBIH KECIL */
            }
            
            body {
                padding-top: calc(52px + 10px);
            }
            
            /* DROPDOWN OVAL SESUAI */
            #navbarNav {
                border-radius: 0 0 20px 20px; /* DIKECILKAN sesuai navbar */
            }
        }
        
        /* Tambahan untuk HP sangat kecil */
        @media (max-width: 320px) {
            .navbar-custom {
                width: 96%; /* HAMPIR FULL */
                border-radius: 18px; /* LEBIH KECIL */
                height: 50px; /* LEBIH KECIL */
            }
            
            .navbar-brand-custom span {
                font-size: 0.95rem; /* LEBIH KECIL */
            }
            
            #navbarNav {
                border-radius: 0 0 18px 18px; /* SESUAI */
            }
        }
    </style>
    
    @stack('styles')
</head>
<body>
    <!-- Fixed Navbar OVAL/MEMANJANG YANG LEBIH KECIL -->
    <nav class="navbar navbar-custom fixed-top">
        <div class="navbar-container">
            <!-- Nama/Brand di sebelah kiri -->
            <a class="navbar-brand-custom" href="#">
                <i class="fas fa-box-open"></i>
               
            </a>
            
            <!-- Toggle button untuk mobile dengan FontAwesome -->
            <button class="navbar-toggler-custom d-lg-none" type="button" id="navbarToggler">
                <i class="fas fa-bars fa-lg"></i>
            </button>
            
            <!-- Menu di sebelah kanan -->
            <div class="navbar-collapse d-lg-flex justify-content-lg-end" id="navbarNav">
                <ul class="navbar-nav-custom">
                    <!-- 3 Menu -->
                    <li class="nav-item">
    <a class="nav-link-custom {{ request()->is('assets') || request()->is('assets/*') ? 'active' : '' }}" 
       href="{{ route('assets.index') }}">
        <i class="fas fa-box-open"></i>
        <span>Asset</span>
    </a>
</li>
                   <li class="nav-item">
    <a class="nav-link-custom {{ request()->routeIs('profile.*') ? 'active' : '' }}" 
       href="{{ route('profile.index') }}">
        <i class="fas fa-user"></i>
        <span>Profil</span>
    </a>
</li>
                    
                    <!-- Button Logout -->
                    <li class="nav-item">
    <form action="{{ route('logout') }}" method="POST" class="d-inline">
        @csrf
        <button type="submit" class="btn-logout-custom">
            <i class="fas fa-sign-out-alt"></i>
            <span>Logout</span>
        </button>
    </form>
</li>
                </ul>
            </div>
        </div>
    </nav>
    
    <!-- Content Section -->
    <main class="content-wrapper">
        <div class="content-container">
            @yield('content')
        </div>
    </main>
    
   
    
    <!-- Bootstrap 5 JS Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    
    <!-- Custom JavaScript untuk navbar responsif -->
    <script>
        // Toggle menu mobile
        document.addEventListener('DOMContentLoaded', function() {
            const navbarToggler = document.getElementById('navbarToggler');
            const navbarNav = document.getElementById('navbarNav');
            
            if (navbarToggler) {
                navbarToggler.addEventListener('click', function() {
                    navbarNav.classList.toggle('show');
                    
                    // Ganti ikon hamburger menjadi X ketika menu terbuka
                    const icon = this.querySelector('i');
                    if (navbarNav.classList.contains('show')) {
                        icon.classList.remove('fa-bars');
                        icon.classList.add('fa-times');
                    } else {
                        icon.classList.remove('fa-times');
                        icon.classList.add('fa-bars');
                    }
                });
            }
            
            // Tutup menu mobile ketika klik di luar
            document.addEventListener('click', function(event) {
                const isClickInsideNavbar = event.target.closest('.navbar-container');
                const isNavbarToggler = event.target.closest('#navbarToggler');
                
                if (!isClickInsideNavbar && !isNavbarToggler && navbarNav.classList.contains('show')) {
                    navbarNav.classList.remove('show');
                    const icon = navbarToggler.querySelector('i');
                    icon.classList.remove('fa-times');
                    icon.classList.add('fa-bars');
                }
            });
            
            // Efek scroll pada navbar
            window.addEventListener('scroll', function() {
                const navbar = document.querySelector('.navbar-custom');
                if (window.scrollY > 10) {
                    navbar.style.boxShadow = '0 8px 25px rgba(0, 0, 0, 0.12)';
                    navbar.style.backgroundColor = 'rgba(255, 255, 255, 0.98)';
                } else {
                    navbar.style.boxShadow = 'var(--shadow-lg)';
                    navbar.style.backgroundColor = 'rgba(255, 255, 255, 0.98)';
                }
            });
            
            // Tutup menu mobile saat klik link
            const navLinks = document.querySelectorAll('.nav-link-custom');
            navLinks.forEach(link => {
                link.addEventListener('click', function() {
                    if (window.innerWidth < 992) {
                        navbarNav.classList.remove('show');
                        const icon = navbarToggler.querySelector('i');
                        icon.classList.remove('fa-times');
                        icon.classList.add('fa-bars');
                    }
                });
            });
            
            // Tambahkan smooth animation untuk penutupan menu
            const originalRemoveShow = navbarNav.classList.remove;
            navbarNav.classList.remove = function(...args) {
                if (args.includes('show')) {
                    // Tambahkan animasi sebelum menghapus class
                    navbarNav.style.transition = 'max-height 0.3s cubic-bezier(0.4, 0, 0.2, 1)';
                    // Trigger reflow
                    void navbarNav.offsetWidth;
                    
                    // Jalankan fungsi remove asli
                    originalRemoveShow.call(this, ...args);
                } else {
                    originalRemoveShow.call(this, ...args);
                }
            };
        });
    </script>
    
    @stack('scripts')
</body>
</html>