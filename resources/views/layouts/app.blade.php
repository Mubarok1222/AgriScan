<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <title>@yield('title', 'AgriScan')</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700&display=swap" rel="stylesheet" />

    <!-- Vite Styles & Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-[#F8FAF8] text-[#1F2937] font-sans antialiased h-screen w-screen overflow-hidden flex">

    <!-- Mobile Sidebar Backdrop Overlay -->
    <div 
        id="sidebar-backdrop" 
        onclick="toggleMobileSidebar()" 
        class="fixed inset-0 bg-black/40 z-30 hidden md:hidden transition-opacity backdrop-blur-xs"
    ></div>

    <!-- Sidebar Navigation (Desktop: Fixed Left / Mobile: Slide-in Drawer) -->
    <aside 
        id="app-sidebar"
        class="fixed inset-y-0 left-0 z-40 w-64 bg-white border-r border-[#E5ECE5] flex flex-col justify-between p-6 overflow-y-auto select-none transition-transform duration-300 ease-in-out -translate-x-full md:translate-x-0 md:static md:h-screen md:shrink-0"
    >
        <div>
            <!-- Header Brand + Close Button on Mobile -->
            <div class="flex items-center justify-between mb-8">
                <a href="{{ Auth::user()->isAdmin() ? route('admin.penyakit') : route('dashboard') }}" class="flex items-center space-x-3">
                    <div class="h-10 w-10 rounded-xl bg-[#2D7A38] flex items-center justify-center text-white shadow-sm shrink-0">
                        <svg class="h-6 w-6" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M12 22v-7" />
                            <path d="M9 15c0-4 3-7 7-7 0 4-3 7-7 7z" />
                            <path d="M9 15c0-2-1.5-3.5-3.5-3.5-2 0-3.5 1.5-3.5 3.5 0 2 1.5 3.5 3.5 3.5H9" />
                        </svg>
                    </div>
                    <span class="text-xl font-bold tracking-tight text-[#183B1E]">AgriScan</span>
                </a>

                <button 
                    type="button" 
                    onclick="toggleMobileSidebar()" 
                    class="md:hidden p-1.5 rounded-lg text-gray-500 hover:text-gray-800 hover:bg-gray-100"
                    aria-label="Tutup Menu"
                >
                    <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <line x1="18" y1="6" x2="6" y2="18"></line>
                        <line x1="6" y1="6" x2="18" y2="18"></line>
                    </svg>
                </button>
            </div>

            @if(Auth::user()->isPetani())
                <!-- Section Label: Petani -->
                <div class="text-[11px] font-semibold text-[#8B988B] tracking-wider uppercase mb-3 px-3">
                    RUANG PETANI
                </div>

                <!-- Navigation Links for Petani -->
                <nav class="space-y-1">
                    <!-- Beranda / Dashboard -->
                    <a 
                        href="{{ route('dashboard') }}" 
                        class="flex items-center space-x-3 px-3 py-2.5 rounded-xl text-sm font-medium transition {{ request()->routeIs('dashboard') ? 'bg-[#EAF3EA] text-[#2D7A38]' : 'text-[#4B5563] hover:text-[#1F2937] hover:bg-[#F3F6F3]' }}"
                    >
                        <svg class="h-5 w-5 shrink-0" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="m3 9 9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z" />
                            <polyline points="9 22 9 12 15 12 15 22" />
                        </svg>
                        <span>Beranda</span>
                    </a>

                    <!-- Deteksi -->
                    <a 
                        href="{{ route('deteksi') }}" 
                        class="flex items-center space-x-3 px-3 py-2.5 rounded-xl text-sm font-medium transition {{ request()->routeIs('deteksi') || request()->routeIs('hasil') ? 'bg-[#EAF3EA] text-[#2D7A38]' : 'text-[#4B5563] hover:text-[#1F2937] hover:bg-[#F3F6F3]' }}"
                    >
                        <svg class="h-5 w-5 shrink-0" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M3 7V5a2 2 0 0 1 2-2h2" />
                            <path d="M17 3h2a2 2 0 0 1 2 2v2" />
                            <path d="M21 17v2a2 2 0 0 1-2 2h-2" />
                            <path d="M7 21H5a2 2 0 0 1-2-2v-2" />
                        </svg>
                        <span>Deteksi</span>
                    </a>

                    <!-- Riwayat -->
                    <a 
                        href="{{ route('riwayat') }}" 
                        class="flex items-center space-x-3 px-3 py-2.5 rounded-xl text-sm font-medium transition {{ request()->routeIs('riwayat') || request()->routeIs('detail') ? 'bg-[#EAF3EA] text-[#2D7A38]' : 'text-[#4B5563] hover:text-[#1F2937] hover:bg-[#F3F6F3]' }}"
                    >
                        <svg class="h-5 w-5 shrink-0" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <circle cx="12" cy="12" r="10" />
                            <polyline points="12 6 12 12 14 14" />
                            <path d="M3.05 11a9 9 0 0 1 .5-2" />
                        </svg>
                        <span>Riwayat</span>
                    </a>
                </nav>
            @endif

            @if(Auth::user()->isAdmin())
                <!-- Section Label: Admin -->
                <div class="text-[11px] font-semibold text-[#8B988B] tracking-wider uppercase mb-3 px-3">
                    RUANG ADMIN
                </div>

                <nav class="space-y-1">
                    <a 
                        href="{{ route('admin.penyakit') }}" 
                        class="flex items-center space-x-3 px-3 py-2.5 rounded-xl text-sm font-medium transition {{ request()->routeIs('admin.penyakit') ? 'bg-[#EAF3EA] text-[#2D7A38]' : 'text-[#4B5563] hover:text-[#1F2937] hover:bg-[#F3F6F3]' }}"
                    >
                        <svg class="h-5 w-5 shrink-0" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M4 19.5v-15A2.5 2.5 0 0 1 6.5 2H20v20H6.5a2.5 2.5 0 0 1-2.5-2.5Z" />
                            <path d="M6 6h10" />
                            <path d="M6 10h10" />
                        </svg>
                        <span>Kelola Penyakit</span>
                    </a>
                </nav>
            @endif
        </div>

        <!-- Sidebar Footer -->
        <div class="pt-6 border-t border-[#EEF2EE]">
            <p class="text-xs text-[#6B7280] mb-3 px-1 truncate font-medium">
                {{ Auth::user()->nama_lengkap }} &bull; {{ ucfirst(Auth::user()->role) }}
            </p>
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button 
                    type="submit" 
                    class="w-full py-2.5 px-3 rounded-xl border border-[#D0DCD0] bg-white hover:bg-slate-50 text-xs font-medium text-[#374151] flex items-center justify-center space-x-2 transition"
                >
                    <svg class="h-4 w-4 text-[#4B5563]" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4" />
                        <polyline points="16 17 21 12 16 7" />
                        <line x1="21" y1="12" x2="9" y2="12" />
                    </svg>
                    <span>Keluar</span>
                </button>
            </form>
        </div>
    </aside>

    <!-- Main Column Area (Header + Scrollable Content + Footer) -->
    <div class="flex-1 flex flex-col h-screen min-w-0 overflow-hidden relative">
        
        <!-- Header (Fixed Top - Tidak Ikut Ke-scroll) -->
        <header class="h-16 shrink-0 bg-white border-b border-[#E5ECE5] px-4 sm:px-8 flex items-center justify-between z-10 shadow-[0_1px_3px_rgba(0,0,0,0.02)]">
            
            <!-- Left: Mobile Hamburger Toggle + Breadcrumbs -->
            <div class="flex items-center space-x-3">
                <button 
                    type="button" 
                    onclick="toggleMobileSidebar()" 
                    class="md:hidden p-1.5 -ml-1 rounded-xl text-[#4B5563] hover:text-[#1F2937] hover:bg-[#F3F6F3] focus:outline-none"
                    aria-label="Menu Navigasi"
                >
                    <svg class="h-6 w-6" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <line x1="3" y1="12" x2="21" y2="12"></line>
                        <line x1="3" y1="6" x2="21" y2="6"></line>
                        <line x1="3" y1="18" x2="21" y2="18"></line>
                    </svg>
                </button>

                <div class="text-xs sm:text-sm text-[#4B5563] flex items-center space-x-1.5 sm:space-x-2">
                    <span class="font-semibold text-[#2D7A38] md:text-[#4B5563] md:font-normal">AgriScan</span>
                    <span class="text-[#9CA3AF]">/</span>
                    <span class="text-[#1F2937] font-medium">@yield('breadcrumb', 'Beranda')</span>
                </div>
            </div>

            <!-- Profile Dropdown Trigger -->
            <div class="relative">
                <button 
                    type="button" 
                    onclick="toggleUserMenu()" 
                    class="flex items-center space-x-2 text-sm font-medium text-[#1F2937] hover:text-[#2D7A38] focus:outline-none py-1.5 px-2 rounded-lg hover:bg-slate-50 transition"
                >
                    <div class="w-8 h-8 rounded-full bg-[#EAF3EA] text-[#2D7A38] font-bold text-xs flex items-center justify-center shrink-0">
                        {{ strtoupper(substr(Auth::user()->nama_lengkap, 0, 1)) }}
                    </div>
                    <span class="hidden sm:inline">{{ Auth::user()->nama_lengkap }}</span>
                    <svg class="h-4 w-4 text-[#6B7280] hidden sm:inline" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                    </svg>
                </button>

                <!-- Profile Menu Modal / Dropdown -->
                <div 
                    id="user-menu" 
                    class="hidden absolute right-0 mt-2 w-64 bg-white rounded-2xl shadow-xl border border-[#E5ECE5] p-5 z-50"
                >
                    <div class="mb-4">
                        <div class="text-xs text-[#8B988B] font-semibold uppercase tracking-wider mb-2">Akun Terdaftar</div>
                        <h4 class="text-base font-semibold text-[#1F2937] truncate">{{ Auth::user()->nama_lengkap }}</h4>
                        <p class="text-xs text-[#6B7280] truncate">{{ Auth::user()->email }}</p>
                        <span class="inline-block mt-1 text-[11px] px-2 py-0.5 rounded-md bg-[#EAF3EA] text-[#2D7A38] font-medium">
                            {{ ucfirst(Auth::user()->role) }}
                        </span>
                    </div>
                    <div class="pt-3 border-t border-[#EEF2EE]">
                        <form action="{{ route('logout') }}" method="POST">
                            @csrf
                            <button 
                                type="submit" 
                                class="w-full py-2 px-3 rounded-xl border border-[#D0DCD0] bg-white hover:bg-slate-50 text-xs font-medium text-[#374151] flex items-center justify-center space-x-2 transition"
                            >
                                <svg class="h-4 w-4 text-[#4B5563]" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4" />
                                    <polyline points="16 17 21 12 16 7" />
                                    <line x1="21" y1="12" x2="9" y2="12" />
                                </svg>
                                <span>Keluar</span>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </header>

        <!-- Scrollable Content Area (Hanya area ini yang ke-scroll) -->
        <main class="flex-1 overflow-y-auto bg-[#F8FAF8] p-4 sm:p-6 lg:p-8 pb-24 md:pb-8">
            <div class="max-w-7xl w-full mx-auto space-y-6">
                <!-- Flash Messages -->
                @if(session('success'))
                    <div class="rounded-xl bg-[#EAF3EA] border border-[#C2DEC2] p-4 flex items-center space-x-3 text-sm text-[#183B1E]">
                        <svg class="h-5 w-5 text-[#2D7A38] shrink-0" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                        </svg>
                        <span>{{ session('success') }}</span>
                    </div>
                @endif

                @if(session('error'))
                    <div class="rounded-xl bg-[#FEE2E2] border border-[#FCA5A5] p-4 flex items-center space-x-3 text-sm text-[#991B1B]">
                        <svg class="h-5 w-5 text-[#DC2626] shrink-0" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd" />
                        </svg>
                        <span>{{ session('error') }}</span>
                    </div>
                @endif

                @yield('content')
            </div>
        </main>

        <!-- Desktop Footer (Fixed Bottom on md+ screens) -->
        <footer class="hidden md:flex h-12 shrink-0 bg-white border-t border-[#E5ECE5] px-8 items-center justify-between text-xs text-[#6B7280] z-10 shadow-[0_-1px_3px_rgba(0,0,0,0.01)]">
            <div class="flex items-center space-x-2">
                <span class="font-medium text-[#183B1E]">AgriScan</span>
                <span>&bull;</span>
                <span>Sistem Informasi Pemantauan Kesehatan Tanaman Padi</span>
            </div>
            <div>
                &copy; {{ date('Y') }} AgriScan. Hak cipta dilindungi.
            </div>
        </footer>

        @if(Auth::user()->isPetani())
            <!-- Mobile Bottom Navigation Bar (Sangat ramah pengguna HP / Petani di lapangan) -->
            <nav class="md:hidden fixed bottom-0 left-0 right-0 h-16 bg-white border-t border-[#E5ECE5] px-6 flex items-center justify-around z-20 shadow-[0_-4px_12px_rgba(0,0,0,0.05)]">
                <!-- Beranda -->
                <a 
                    href="{{ route('dashboard') }}" 
                    class="flex flex-col items-center justify-center space-y-1 {{ request()->routeIs('dashboard') ? 'text-[#2D7A38]' : 'text-[#6B7280]' }}"
                >
                    <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="m3 9 9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z" />
                        <polyline points="9 22 9 12 15 12 15 22" />
                    </svg>
                    <span class="text-[10px] font-medium">Beranda</span>
                </a>

                <!-- Scan / Deteksi (Tombol Utama di Tengah) -->
                <a 
                    href="{{ route('deteksi') }}" 
                    class="flex flex-col items-center -mt-5"
                >
                    <div class="w-13 h-13 rounded-full bg-[#2D7A38] text-white flex items-center justify-center shadow-lg shadow-green-900/30 ring-4 ring-white active:scale-95 transition">
                        <svg class="h-6 w-6" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M14.5 4h-5L7 7H4a2 2 0 0 0-2 2v9a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V9a2 2 0 0 0-2-2h-3l-2.5-3z" />
                            <circle cx="12" cy="13" r="3" />
                        </svg>
                    </div>
                    <span class="text-[10px] font-semibold text-[#2D7A38] mt-1">Deteksi</span>
                </a>

                <!-- Riwayat -->
                <a 
                    href="{{ route('riwayat') }}" 
                    class="flex flex-col items-center justify-center space-y-1 {{ request()->routeIs('riwayat') || request()->routeIs('detail') ? 'text-[#2D7A38]' : 'text-[#6B7280]' }}"
                >
                    <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <circle cx="12" cy="12" r="10" />
                        <polyline points="12 6 12 12 14 14" />
                        <path d="M3.05 11a9 9 0 0 1 .5-2" />
                    </svg>
                    <span class="text-[10px] font-medium">Riwayat</span>
                </a>
            </nav>
        @endif

    </div>

    <script>
        function toggleMobileSidebar() {
            const sidebar = document.getElementById('app-sidebar');
            const backdrop = document.getElementById('sidebar-backdrop');
            
            sidebar.classList.toggle('-translate-x-full');
            backdrop.classList.toggle('hidden');
        }

        function toggleUserMenu() {
            const menu = document.getElementById('user-menu');
            menu.classList.toggle('hidden');
        }

        window.addEventListener('click', function(e) {
            const menu = document.getElementById('user-menu');
            const button = e.target.closest('button[onclick="toggleUserMenu()"]');
            if (menu && !button && !menu.contains(e.target)) {
                menu.classList.add('hidden');
            }
        });
    </script>
</body>
</html>
