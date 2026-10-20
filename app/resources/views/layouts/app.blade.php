<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Greenvision - Deteksi Penyakit Kentang')</title>
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet font-sans">
    <!-- Font Awesome Pro -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        theme: {
                            blue: '#005024',
                            blueDark: '#003618',
                            green: '#00a859',
                            greenHover: '#008e4b',
                            textDark: '#112211',
                            textMuted: '#506055',
                            bgLight: '#f3faf6',
                            borderLight: '#e1f0e8',
                        }
                    },
                    fontFamily: {
                        sans: ['Plus Jakarta Sans', 'sans-serif'],
                    },
                }
            }
        }
    </script>
    <style>
        /* Greenvision Theme Helper Classes */
        .tp-btn {
            background-color: #00a859;
            color: #ffffff;
            font-weight: 700;
            font-size: 0.95rem;
            padding: 14px 28px;
            border-radius: 6px;
            transition: all 0.3s ease;
            display: inline-flex;
            align-items: center;
            justify-content: center;
        }
        .tp-btn:hover {
            background-color: #008e4b;
            transform: translateY(-2px);
        }
        .tp-btn-blue {
            background-color: #005024;
            color: #ffffff;
        }
        .tp-btn-blue:hover {
            background-color: #003618;
        }
        .tp-border-bottom {
            border-bottom: 1px solid #e1f0e8;
        }
        .tp-section-title-pre {
            font-size: 0.85rem;
            font-weight: 800;
            color: #00a859;
            text-transform: uppercase;
            letter-spacing: 2px;
            display: inline-block;
        }
        .tp-section-title {
            font-size: 2.5rem;
            font-weight: 800;
            color: #005024;
            line-height: 1.2;
        }
    </style>
    @yield('styles')
</head>
<body class="bg-theme-bgLight text-theme-textDark min-h-screen flex flex-col font-sans">

    <!-- Header Area Start -->
    <header class="relative z-50">
        <!-- Header Bottom Area -->
        <nav class="bg-white border-b border-theme-borderLight sticky top-0 backdrop-blur-md bg-white/95">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex items-center justify-between h-20">
                    <!-- Logo -->
                    <div class="flex items-center">
                        <a href="{{ route('home') }}" class="flex items-center space-x-2">
                            <span class="text-3xl text-theme-green">🍃</span>
                            <span class="text-2xl font-extrabold text-theme-blue tracking-tight">Greenvision<span class="text-theme-green">.</span></span>
                        </a>
                    </div>

                    <!-- Navigation Links (Desktop) -->
                    <div class="hidden md:flex items-center space-x-1">
                        <a href="{{ route('home') }}" class="px-1 py-2 rounded-md text-xs transition-colors {{ Route::is('home') ? 'text-theme-green' : 'text-theme-textDark hover:text-theme-green' }}">
                            Home
                        </a>
                        <a href="{{ route('company-profile') }}" class="px-1 py-2 rounded-md text-xs transition-colors {{ Route::is('company-profile') ? 'text-theme-green' : 'text-theme-textDark hover:text-theme-green' }}">
                            Profil Perusahaan
                        </a>
                        @auth
                            <a href="{{ route('about') }}" class="px-1 py-2 rounded-md text-xs transition-colors {{ Route::is('about') ? 'text-theme-green' : 'text-theme-textDark hover:text-theme-green' }}">
                                Cara Kerja Sistem
                            </a>
                            <a href="{{ route('input') }}" class="px-1 py-2 rounded-md text-xs transition-colors {{ Route::is('input') ? 'text-theme-green' : 'text-theme-textDark hover:text-theme-green' }}">
                                Deteksi Penyakit
                            </a>
                            <a href="{{ route('history') }}" class="px-1 py-2 rounded-md text-xs transition-colors {{ Route::is('history') ? 'text-theme-green' : 'text-theme-textDark hover:text-theme-green' }}">
                                Hasil Tanaman
                            </a>
                            @if(auth()->user()->role === 'admin')
                                <a href="{{ route('admin.dashboard') }}" class="px-1 py-2 rounded-md text-xs font-bold text-red-650 hover:text-red-800 transition-colors {{ Request::is('admin*') ? 'text-red-750' : '' }}">
                                    🛡️ Panel Admin
                                </a>
                            @endif
                        @endauth
                    </div>

                    <!-- Auth Buttons (Desktop) -->
                    <div class="hidden md:flex items-center space-x-4">
                        @auth
                            <a href="{{ route('profile') }}" class="flex items-center space-x-2 text-theme-textDark hover:text-theme-green transition-colors group" title="Profil Saya">
                                <span class="w-8 h-8 rounded-full bg-theme-bgLight group-hover:bg-theme-green/10 flex items-center justify-center text-sm border border-theme-borderLight group-hover:border-theme-green/30 transition-all">👤</span>
                                <span class="text-sm font-bold">{{ auth()->user()->name }}</span>
                            </a>
                            <form action="{{ route('logout') }}" method="POST" class="inline">
                                @csrf
                                <button type="submit" class="bg-theme-blue hover:bg-red-650 hover:text-white text-white px-4 py-2 rounded text-xs font-bold transition-colors">
                                    Keluar
                                </button>
                            </form>
                        @else
                            <a href="{{ route('login') }}" class="text-theme-textDark hover:text-theme-green text-sm font-bold transition-colors">
                                Masuk
                            </a>
                            <a href="{{ route('register') }}" class="tp-btn text-sm">
                                Daftar Akun
                            </a>
                        @endauth
                    </div>

                    <!-- Mobile Menu Button -->
                    <div class="md:hidden flex items-center">
                        <button type="button" id="mobileMenuBtn" class="text-theme-textDark hover:text-theme-green focus:outline-none">
                            <svg class="h-7 w-7" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7" />
                            </svg>
                        </button>
                    </div>
                </div>
            </div>

            <!-- Mobile Navigation Menu -->
            <div id="mobileMenu" class="hidden md:hidden bg-white border-b border-theme-borderLight px-4 pt-2 pb-4 space-y-1">
                <a href="{{ route('home') }}" class="block px-3 py-2 rounded-md text-base font-bold {{ Route::is('home') ? 'text-theme-green bg-theme-bgLight' : 'text-theme-textDark hover:bg-theme-bgLight' }}">
                    Home
                </a>
                <a href="{{ route('company-profile') }}" class="block px-3 py-2 rounded-md text-base font-bold {{ Route::is('company-profile') ? 'text-theme-green bg-theme-bgLight' : 'text-theme-textDark hover:bg-theme-bgLight' }}">
                    Profil Perusahaan
                </a>
                @auth
                    <a href="{{ route('about') }}" class="block px-3 py-2 rounded-md text-base font-bold {{ Route::is('about') ? 'text-theme-green bg-theme-bgLight' : 'text-theme-textDark hover:bg-theme-bgLight' }}">
                        Cara Kerja Sistem
                    </a>
                    <a href="{{ route('input') }}" class="block px-3 py-2 rounded-md text-base font-bold {{ Route::is('input') ? 'text-theme-green bg-theme-bgLight' : 'text-theme-textDark hover:bg-theme-bgLight' }}">
                        Deteksi Penyakit
                    </a>
                    <a href="{{ route('history') }}" class="block px-3 py-2 rounded-md text-base font-bold {{ Route::is('history') ? 'text-theme-green bg-theme-bgLight' : 'text-theme-textDark hover:bg-theme-bgLight' }}">
                        Hasil Tanaman
                    </a>
                    @if(auth()->user()->role === 'admin')
                        <a href="{{ route('admin.dashboard') }}" class="block px-3 py-2 rounded-md text-base font-bold text-red-650 hover:bg-red-50/20">
                            🛡️ Panel Admin
                        </a>
                    @endif
                    <a href="{{ route('profile') }}" class="block px-3 py-2 rounded-md text-base font-bold {{ Route::is('profile') ? 'text-theme-green bg-theme-bgLight' : 'text-theme-textDark hover:bg-theme-bgLight' }}">
                        Profil
                    </a>
                    <div class="border-t border-theme-borderLight my-2 pt-2"></div>
                    <form action="{{ route('logout') }}" method="POST" class="block w-full">
                        @csrf
                        <button type="submit" class="w-full text-left block px-3 py-2 rounded-md text-base font-bold text-red-500 hover:bg-red-50/20">
                            Keluar
                        </button>
                    </form>
                @else
                    <div class="border-t border-theme-borderLight my-2 pt-2"></div>
                    <a href="{{ route('login') }}" class="block px-3 py-2 rounded-md text-base font-bold text-theme-textDark hover:bg-theme-bgLight">
                        Masuk
                    </a>
                    <a href="{{ route('register') }}" class="block px-3 py-2 rounded-md text-base font-bold text-theme-green hover:bg-theme-bgLight">
                        Daftar
                    </a>
                @endauth
            </div>
        </nav>
    </header>

    <!-- Main Content Area -->
    <main class="flex-grow">
        @if(session('success'))
            <div class="max-w-4xl mx-auto w-full my-4 px-4">
                <div class="bg-emerald-50 border border-emerald-200 text-emerald-800 px-4 py-3 rounded-lg flex items-center justify-between shadow-sm">
                    <span class="text-sm font-semibold">{{ session('success') }}</span>
                    <button onclick="this.parentElement.remove()" class="text-emerald-800 hover:text-emerald-950 font-bold">&times;</button>
                </div>
            </div>
        @endif

        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="bg-theme-blue text-white/60 py-5 border-t border-theme-borderLight/10">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex flex-col md:flex-row justify-between items-center gap-4">
                <a href="{{ route('home') }}" class="flex items-center space-x-2">
                    <span class="text-3xl text-theme-green">🍃</span>
                    <span class="text-xl font-extrabold text-white tracking-tight">Greenvision<span class="text-theme-green">.</span></span>
                </a>
                <p class="text-sm">
                    &copy; {{ date('Y') }} Greenvision Greenvision. Hak Cipta Dilindungi Undang-Undang.
                </p>
            </div>
        </div>
    </footer>

    <!-- Mobile Menu Toggle Script -->
    <script>
        const mobileMenuBtn = document.getElementById('mobileMenuBtn');
        const mobileMenu = document.getElementById('mobileMenu');
        mobileMenuBtn.addEventListener('click', () => {
            mobileMenu.classList.toggle('hidden');
        });
    </script>
    @yield('scripts')
</body>
</html>
