<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin Panel - Greenvision')</title>
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet font-sans">
    <!-- Font Awesome -->
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
        .tp-btn {
            background-color: #00a859;
            color: #ffffff;
            font-weight: 700;
            font-size: 0.875rem;
            padding: 10px 20px;
            border-radius: 6px;
            transition: all 0.3s ease;
            display: inline-flex;
            align-items: center;
            justify-content: center;
        }
        .tp-btn:hover {
            background-color: #008e4b;
            transform: translateY(-1px);
        }
        .sidebar-link-active {
            background-color: #e1f0e8;
            color: #005024;
            font-weight: 700;
            border-right: 4px solid #00a859;
        }
    </style>
    @yield('styles')
</head>
<body class="bg-theme-bgLight text-theme-textDark font-sans min-h-screen flex">

    <!-- Sidebar (Desktop) -->
    <aside id="sidebar" class="w-64 bg-white border-r border-theme-borderLight flex-shrink-0 flex flex-col justify-between fixed inset-y-0 left-0 z-40 transform -translate-x-full md:translate-x-0 transition-transform duration-300 ease-in-out">
        <div>
            <!-- Sidebar Header / Logo -->
            <div class="h-20 flex items-center px-6 border-b border-theme-borderLight">
                <a href="{{ route('home') }}" class="flex items-center space-x-2">
                    <span class="text-2xl">🍃</span>
                    <span class="text-xl font-extrabold text-theme-blue tracking-tight">Greenvision<span class="text-theme-green">.</span></span>
                </a>
            </div>

            <!-- Sidebar Navigation Links -->
            <nav class="mt-6 px-4 space-y-1">
                <div class="text-[10px] font-bold text-theme-textMuted uppercase tracking-wider px-3 mb-2">Menu Use Case Admin</div>
                
                <a href="{{ route('admin.dashboard') }}" class="flex items-center space-x-3 px-4 py-3 rounded-lg text-sm font-semibold transition-colors {{ Route::is('admin.dashboard') ? 'sidebar-link-active' : 'text-theme-textMuted hover:bg-theme-bgLight hover:text-theme-blue' }}">
                    <span class="text-lg">📊</span>
                    <span>Kelola Data Admin</span>
                </a>

                <a href="{{ route('admin.users.index') }}" class="flex items-center space-x-3 px-4 py-3 rounded-lg text-sm font-semibold transition-colors {{ Request::is('admin/users*') ? 'sidebar-link-active' : 'text-theme-textMuted hover:bg-theme-bgLight hover:text-theme-blue' }}">
                    <span class="text-lg">👥</span>
                    <span>Kelola Data Pengguna</span>
                </a>

                <a href="{{ route('admin.detections.index') }}" class="flex items-center space-x-3 px-4 py-3 rounded-lg text-sm font-semibold transition-colors {{ Request::is('admin/detections*') ? 'sidebar-link-active' : 'text-theme-textMuted hover:bg-theme-bgLight hover:text-theme-blue' }}">
                    <span class="text-lg">📸</span>
                    <span>Kelola Data Deteksi</span>
                </a>
            </nav>
        </div>

        <!-- Sidebar Footer / User Info -->
        <div class="p-4 border-t border-theme-borderLight bg-gray-50/50">
            <div class="flex items-center space-x-3 mb-4">
                <div class="w-10 h-10 rounded-full bg-theme-blue/10 flex items-center justify-center text-lg font-bold border border-theme-blue/20">
                    👤
                </div>
                <div class="overflow-hidden">
                    <h4 class="text-sm font-bold text-theme-blue truncate">{{ auth()->user()->name }}</h4>
                    <span class="text-[10px] font-bold text-red-650 bg-red-50 border border-red-200/50 px-1.5 py-0.5 rounded">ADMINISTRATOR</span>
                </div>
            </div>
            <div class="grid grid-cols-2 gap-2">
                <a href="{{ route('home') }}" class="text-center bg-gray-100 hover:bg-gray-200 text-theme-textDark py-2 rounded text-xs font-bold transition-colors">
                    🌐 Web
                </a>
                <form action="{{ route('logout') }}" method="POST" class="inline">
                    @csrf
                    <button type="submit" class="w-full text-center bg-rose-50 hover:bg-rose-100 text-rose-700 py-2 rounded text-xs font-bold transition-colors">
                        🚪 Keluar
                    </button>
                </form>
            </div>
        </div>
    </aside>

    <!-- Overlay for mobile sidebar -->
    <div id="sidebarOverlay" class="fixed inset-0 bg-black/40 z-30 hidden md:hidden"></div>

    <!-- Main Content Area -->
    <div class="flex-grow flex flex-col md:pl-64 min-h-screen">
        
        <!-- Top Navigation -->
        <header class="h-20 bg-white border-b border-theme-borderLight flex items-center justify-between px-6 sticky top-0 z-20">
            <div class="flex items-center space-x-4">
                <!-- Hamburger button for mobile -->
                <button id="sidebarToggle" class="md:hidden p-2 hover:bg-theme-bgLight rounded-lg text-theme-textDark">
                    <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                    </svg>
                </button>
                <div class="hidden sm:block">
                    <h2 class="text-sm font-semibold text-theme-textMuted">Selamat datang kembali, <span class="text-theme-blue font-bold">{{ auth()->user()->name }}</span></h2>
                </div>
            </div>

            <div class="flex items-center space-x-4">
                <a href="{{ route('home') }}" class="text-xs font-bold text-theme-green hover:underline">
                    Lihat Web Utama →
                </a>
            </div>
        </header>

        <!-- Main Inner Content -->
        <main class="flex-grow p-6">
            @if(session('success'))
                <div class="mb-6">
                    <div class="bg-emerald-50 border border-emerald-200 text-emerald-800 px-4 py-3 rounded-lg flex items-center justify-between shadow-sm">
                        <span class="text-sm font-semibold">{{ session('success') }}</span>
                        <button onclick="this.parentElement.remove()" class="text-emerald-800 hover:text-emerald-950 font-bold">&times;</button>
                    </div>
                </div>
            @endif

            @yield('content')
        </main>

        <!-- Footer -->
        <footer class="bg-white py-4 border-t border-theme-borderLight text-center text-xs text-theme-textMuted">
            &copy; {{ date('Y') }} Greenvision Admin Panel. Hak Cipta Dilindungi.
        </footer>
    </div>

    <!-- Toggle script for mobile sidebar -->
    <script>
        const sidebar = document.getElementById('sidebar');
        const sidebarToggle = document.getElementById('sidebarToggle');
        const sidebarOverlay = document.getElementById('sidebarOverlay');

        function toggleSidebar() {
            sidebar.classList.toggle('-translate-x-full');
            sidebarOverlay.classList.toggle('hidden');
        }

        sidebarToggle.addEventListener('click', toggleSidebar);
        sidebarOverlay.addEventListener('click', toggleSidebar);
    </script>
    @yield('scripts')
</body>
</html>
