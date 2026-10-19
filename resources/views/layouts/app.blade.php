<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'AuraSpace') — Aesthetic Furniture & Home Decor ✦</title>
    
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&family=Space+Grotesk:wght@500;700&display=swap" rel="stylesheet">
    
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
        }
        .font-display {
            font-family: 'Space Grotesk', sans-serif;
        }
    </style>
    @stack('styles')
</head>
<body class="y2k-gradient-bg min-h-screen flex flex-col text-slate-800 antialiased selection:bg-pink-300 selection:text-slate-900">

    <!-- Top Announcement Bar -->
    <div class="bg-gradient-to-r from-blue-400 via-pink-400 to-purple-400 text-white text-xs md:text-sm py-1.5 px-4 font-semibold text-center tracking-wide flex items-center justify-center gap-2 shadow-sm">
        <span>✦ DISKON SPESIAL: GRATIS ONGKIR MIN. BELANJA RP500.000 ✦ KODE: AURA2000 ♡</span>
    </div>

    <!-- Main Navigation Header -->
    <header class="sticky top-0 z-40 transition-all duration-300 px-3 sm:px-6 lg:px-8 py-3">
        <nav class="max-w-7xl mx-auto y2k-glass rounded-full px-4 sm:px-6 py-2.5 flex items-center justify-between border border-white/80 shadow-lg shadow-sky-100/50">
            <!-- Brand Logo -->
            <a href="{{ route('home') }}" class="flex items-center gap-2 group">
                <div class="w-10 h-10 rounded-full bg-gradient-to-br from-pink-300 via-sky-300 to-indigo-400 p-0.5 shadow-md flex items-center justify-center group-hover:rotate-12 transition-transform">
                    <div class="w-full h-full bg-white rounded-full flex items-center justify-center">
                        <span class="text-xl">✦</span>
                    </div>
                </div>
                <div class="flex flex-col">
                    <span class="font-display font-black text-xl tracking-wider chrome-text uppercase">
                        Aura<span class="text-pink-500">Space</span>
                    </span>
                    <span class="text-[10px] tracking-widest text-slate-400 uppercase -mt-1 font-semibold">Furniture & Decor ✦</span>
                </div>
            </a>

            <!-- Desktop Nav Links -->
            <div class="hidden md:flex items-center gap-1 lg:gap-2">
                <a href="{{ route('home') }}" class="px-4 py-1.5 rounded-full text-sm font-semibold transition-all {{ request()->routeIs('home') ? 'bg-sky-100 text-sky-700 shadow-sm' : 'text-slate-600 hover:text-sky-600 hover:bg-white/60' }}">
                    Home
                </a>
                <a href="{{ route('shop.index') }}" class="px-4 py-1.5 rounded-full text-sm font-semibold transition-all {{ request()->routeIs('shop.*') ? 'bg-sky-100 text-sky-700 shadow-sm' : 'text-slate-600 hover:text-sky-600 hover:bg-white/60' }}">
                    Shop ✦
                </a>
                
                <!-- Category Dropdown -->
                <div class="relative group" id="categoryMenu">
                    <button class="px-4 py-1.5 rounded-full text-sm font-semibold text-slate-600 hover:text-sky-600 hover:bg-white/60 transition-all flex items-center gap-1">
                        Categories
                        <svg class="w-3.5 h-3.5 transition-transform group-hover:rotate-180" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19 9l-7 7-7-7"></path></svg>
                    </button>
                    <div class="absolute top-full left-0 mt-2 w-56 y2k-glass rounded-2xl p-2 shadow-xl border border-white opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-200 z-50">
                        <a href="{{ route('shop.index', ['category' => 'wall-clock']) }}" class="flex items-center gap-2.5 px-3 py-2 rounded-xl text-xs font-semibold text-slate-700 hover:bg-sky-100 hover:text-sky-800 transition-colors">
                            <span class="text-base">⏰</span> Wall Clock
                        </a>
                        <a href="{{ route('shop.index', ['category' => 'lighting']) }}" class="flex items-center gap-2.5 px-3 py-2 rounded-xl text-xs font-semibold text-slate-700 hover:bg-sky-100 hover:text-sky-800 transition-colors">
                            <span class="text-base">💡</span> Lighting & Glow
                        </a>
                        <a href="{{ route('shop.index', ['category' => 'mirror']) }}" class="flex items-center gap-2.5 px-3 py-2 rounded-xl text-xs font-semibold text-slate-700 hover:bg-sky-100 hover:text-sky-800 transition-colors">
                            <span class="text-base">🪞</span> Wave Mirrors
                        </a>
                        <a href="{{ route('shop.index', ['category' => 'furniture']) }}" class="flex items-center gap-2.5 px-3 py-2 rounded-xl text-xs font-semibold text-slate-700 hover:bg-sky-100 hover:text-sky-800 transition-colors">
                            <span class="text-base">🪑</span> Furniture & Tables
                        </a>
                        <a href="{{ route('shop.index', ['category' => 'storage']) }}" class="flex items-center gap-2.5 px-3 py-2 rounded-xl text-xs font-semibold text-slate-700 hover:bg-sky-100 hover:text-sky-800 transition-colors">
                            <span class="text-base">📦</span> Acrylic & Storage
                        </a>
                        <a href="{{ route('shop.index', ['category' => 'decoration']) }}" class="flex items-center gap-2.5 px-3 py-2 rounded-xl text-xs font-semibold text-slate-700 hover:bg-sky-100 hover:text-sky-800 transition-colors">
                            <span class="text-base">✨</span> Decoration & Accents
                        </a>
                    </div>
                </div>

                <a href="{{ route('about') }}" class="px-4 py-1.5 rounded-full text-sm font-semibold transition-all {{ request()->routeIs('about') ? 'bg-sky-100 text-sky-700 shadow-sm' : 'text-slate-600 hover:text-sky-600 hover:bg-white/60' }}">
                    About
                </a>
                <a href="{{ route('contact') }}" class="px-4 py-1.5 rounded-full text-sm font-semibold transition-all {{ request()->routeIs('contact') ? 'bg-sky-100 text-sky-700 shadow-sm' : 'text-slate-600 hover:text-sky-600 hover:bg-white/60' }}">
                    Contact
                </a>
            </div>

            <!-- Right Actions: Search, Cart, Account -->
            <div class="flex items-center gap-2 sm:gap-3">
                <!-- Search Button / Quick Search -->
                <form action="{{ route('shop.index') }}" method="GET" class="hidden sm:flex items-center relative">
                    <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari furniture & dekorasi..." class="bg-white/70 border border-slate-200 focus:border-sky-400 focus:bg-white focus:outline-none rounded-full pl-8 pr-4 py-1.5 text-xs font-medium w-36 lg:w-48 transition-all">
                    <svg class="w-3.5 h-3.5 text-slate-400 absolute left-2.5 pointer-events-none" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                </form>

                <!-- Cart Icon Button -->
                <a href="{{ route('cart.index') }}" class="relative p-2 rounded-full bg-white/80 hover:bg-pink-50 border border-slate-200 hover:border-pink-300 transition-all shadow-sm group" title="Keranjang Belanja">
                    <svg class="w-5 h-5 text-slate-700 group-hover:text-pink-500 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                    </svg>
                    @if(isset($navCartCount) && $navCartCount > 0)
                        <span class="absolute -top-1 -right-1 bg-gradient-to-r from-pink-500 to-rose-400 text-white text-[10px] font-bold w-4 h-4 rounded-full flex items-center justify-center shadow-md animate-pulse">
                            {{ $navCartCount }}
                        </span>
                    @endif
                </a>

                <!-- Auth Buttons / User Profile -->
                @guest
                    <div class="hidden sm:flex items-center gap-2">
                        <a href="{{ route('login') }}" class="text-xs font-bold px-4 py-2 rounded-full text-slate-700 hover:text-sky-600 hover:bg-white/60 transition-all">
                            Login
                        </a>
                        <a href="{{ route('register') }}" class="y2k-btn-pink text-xs !py-1.5 !px-4">
                            Register ♡
                        </a>
                    </div>
                @else
                    <!-- Logged in Customer Menu -->
                    <div class="relative" id="userMenuContainer">
                        <button onclick="toggleUserDropdown()" class="flex items-center gap-1.5 bg-white/90 hover:bg-white border border-slate-200 hover:border-sky-300 rounded-full pl-2 pr-3 py-1 shadow-sm transition-all text-xs font-bold text-slate-800">
                            <span class="w-6 h-6 rounded-full bg-gradient-to-tr from-sky-300 to-pink-300 flex items-center justify-center text-[10px] text-white font-bold">
                                {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                            </span>
                            <span class="max-w-[80px] truncate hidden sm:inline">{{ Auth::user()->name }}</span>
                            <svg class="w-3 h-3 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                        </button>

                        <div id="userDropdownMenu" class="hidden absolute right-0 mt-2 w-48 y2k-glass rounded-2xl p-2 shadow-xl border border-white z-50">
                            @if(Auth::user()->isAdmin())
                                <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-2 px-3 py-2 rounded-xl text-xs font-bold text-purple-700 bg-purple-50 hover:bg-purple-100 transition-colors mb-1">
                                    <span>⚡</span> Admin Dashboard
                                </a>
                            @endif
                            <a href="{{ route('orders.index') }}" class="flex items-center gap-2 px-3 py-2 rounded-xl text-xs font-semibold text-slate-700 hover:bg-sky-100 hover:text-sky-800 transition-colors">
                                <span>🛍️</span> Pesanan Saya
                            </a>
                            <a href="{{ route('profile.index') }}" class="flex items-center gap-2 px-3 py-2 rounded-xl text-xs font-semibold text-slate-700 hover:bg-sky-100 hover:text-sky-800 transition-colors">
                                <span>👤</span> Profil Akun
                            </a>
                            <hr class="my-1 border-slate-200">
                            <form action="{{ route('logout') }}" method="POST">
                                @csrf
                                <button type="submit" class="w-full text-left flex items-center gap-2 px-3 py-2 rounded-xl text-xs font-semibold text-rose-600 hover:bg-rose-50 transition-colors">
                                    <span>🚪</span> Logout
                                </button>
                            </form>
                        </div>
                    </div>
                @endguest

                <!-- Mobile Hamburger Button -->
                <button onclick="toggleMobileMenu()" class="md:hidden p-2 rounded-full bg-white/80 text-slate-700 hover:bg-white shadow-sm" aria-label="Toggle Menu">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path></svg>
                </button>
            </div>
        </nav>

        <!-- Mobile Drawer Navigation -->
        <div id="mobileMenu" class="hidden md:hidden mt-2 max-w-7xl mx-auto y2k-glass rounded-3xl p-5 border border-white shadow-2xl">
            <div class="flex flex-col gap-2">
                <form action="{{ route('shop.index') }}" method="GET" class="flex items-center relative mb-2">
                    <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari furniture & dekorasi..." class="w-full bg-white/80 border border-slate-200 rounded-full pl-9 pr-4 py-2 text-xs font-medium focus:outline-none focus:border-sky-400">
                    <svg class="w-4 h-4 text-slate-400 absolute left-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                </form>
                <a href="{{ route('home') }}" class="px-4 py-2 rounded-xl font-bold text-sm {{ request()->routeIs('home') ? 'bg-sky-100 text-sky-700' : 'text-slate-700 hover:bg-white/50' }}">Home</a>
                <a href="{{ route('shop.index') }}" class="px-4 py-2 rounded-xl font-bold text-sm {{ request()->routeIs('shop.*') ? 'bg-sky-100 text-sky-700' : 'text-slate-700 hover:bg-white/50' }}">Shop ✦</a>
                <a href="{{ route('about') }}" class="px-4 py-2 rounded-xl font-bold text-sm {{ request()->routeIs('about') ? 'bg-sky-100 text-sky-700' : 'text-slate-700 hover:bg-white/50' }}">About</a>
                <a href="{{ route('contact') }}" class="px-4 py-2 rounded-xl font-bold text-sm {{ request()->routeIs('contact') ? 'bg-sky-100 text-sky-700' : 'text-slate-700 hover:bg-white/50' }}">Contact</a>
                
                @guest
                    <div class="pt-3 border-t border-slate-200 flex flex-col gap-2">
                        <a href="{{ route('login') }}" class="text-center py-2 rounded-full border border-slate-300 font-bold text-xs text-slate-700 bg-white/70">Login</a>
                        <a href="{{ route('register') }}" class="y2k-btn-pink text-center text-xs !py-2">Register ♡</a>
                    </div>
                @else
                    <div class="pt-3 border-t border-slate-200 flex flex-col gap-1.5">
                        <span class="px-4 text-xs font-bold text-slate-400">Akun: {{ Auth::user()->name }}</span>
                        @if(Auth::user()->isAdmin())
                            <a href="{{ route('admin.dashboard') }}" class="px-4 py-2 rounded-xl text-xs font-bold text-purple-700 bg-purple-50">⚡ Admin Dashboard</a>
                        @endif
                        <a href="{{ route('orders.index') }}" class="px-4 py-2 rounded-xl text-xs font-semibold text-slate-700 hover:bg-sky-50">🛍️ Pesanan Saya</a>
                        <a href="{{ route('profile.index') }}" class="px-4 py-2 rounded-xl text-xs font-semibold text-slate-700 hover:bg-sky-50">👤 Profil Akun</a>
                        <form action="{{ route('logout') }}" method="POST">
                            @csrf
                            <button type="submit" class="w-full text-left px-4 py-2 rounded-xl text-xs font-bold text-rose-600 hover:bg-rose-50">🚪 Logout</button>
                        </form>
                    </div>
                @endguest
            </div>
        </div>
    </header>

    <!-- Feedback Notification Toasts -->
    <div class="fixed top-20 right-4 z-50 max-w-sm w-full pointer-events-none flex flex-col gap-2">
        @if(session('success'))
            <div class="pointer-events-auto y2k-glass rounded-2xl p-4 border border-emerald-300/80 shadow-xl shadow-emerald-100 flex items-start gap-3 animate-bounce-once">
                <div class="w-8 h-8 rounded-full bg-emerald-100 text-emerald-600 flex items-center justify-center shrink-0 font-bold text-base">✦</div>
                <div class="flex-1">
                    <h4 class="text-xs font-bold text-emerald-900 uppercase tracking-wider">Sukses!</h4>
                    <p class="text-xs font-medium text-emerald-800 mt-0.5">{{ session('success') }}</p>
                </div>
                <button onclick="this.parentElement.remove()" class="text-emerald-500 hover:text-emerald-700 text-sm">✕</button>
            </div>
        @endif

        @if(session('error'))
            <div class="pointer-events-auto y2k-glass rounded-2xl p-4 border border-rose-300/80 shadow-xl shadow-rose-100 flex items-start gap-3">
                <div class="w-8 h-8 rounded-full bg-rose-100 text-rose-600 flex items-center justify-center shrink-0 font-bold text-base">!</div>
                <div class="flex-1">
                    <h4 class="text-xs font-bold text-rose-900 uppercase tracking-wider">Perhatian</h4>
                    <p class="text-xs font-medium text-rose-800 mt-0.5">{{ session('error') }}</p>
                </div>
                <button onclick="this.parentElement.remove()" class="text-rose-500 hover:text-rose-700 text-sm">✕</button>
            </div>
        @endif

        @if(session('warning'))
            <div class="pointer-events-auto y2k-glass rounded-2xl p-4 border border-amber-300/80 shadow-xl shadow-amber-100 flex items-start gap-3">
                <div class="w-8 h-8 rounded-full bg-amber-100 text-amber-600 flex items-center justify-center shrink-0 font-bold text-base">✦</div>
                <div class="flex-1">
                    <h4 class="text-xs font-bold text-amber-900 uppercase tracking-wider">Pemberitahuan</h4>
                    <p class="text-xs font-medium text-amber-800 mt-0.5">{{ session('warning') }}</p>
                </div>
                <button onclick="this.parentElement.remove()" class="text-amber-500 hover:text-amber-700 text-sm">✕</button>
            </div>
        @endif

        @if(session('info'))
            <div class="pointer-events-auto y2k-glass rounded-2xl p-4 border border-sky-300/80 shadow-xl shadow-sky-100 flex items-start gap-3">
                <div class="w-8 h-8 rounded-full bg-sky-100 text-sky-600 flex items-center justify-center shrink-0 font-bold text-base">♡</div>
                <div class="flex-1">
                    <h4 class="text-xs font-bold text-sky-900 uppercase tracking-wider">Info</h4>
                    <p class="text-xs font-medium text-sky-800 mt-0.5">{{ session('info') }}</p>
                </div>
                <button onclick="this.parentElement.remove()" class="text-sky-500 hover:text-sky-700 text-sm">✕</button>
            </div>
        @endif
    </div>

    <!-- Main Content Slot -->
    <main class="flex-1">
        @yield('content')
    </main>

    <!-- Y2K Aesthetic Footer -->
    <footer class="mt-20 border-t border-white/60 bg-white/70 backdrop-blur-md pt-16 pb-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-5 gap-10">
                <!-- Col 1: Brand Info -->
                <div class="lg:col-span-2 space-y-4">
                    <div class="flex items-center gap-2">
                        <div class="w-8 h-8 rounded-full bg-gradient-to-br from-pink-300 via-sky-300 to-indigo-400 flex items-center justify-center text-white text-sm font-bold shadow-sm">✦</div>
                        <span class="font-display font-black text-2xl tracking-wider chrome-text uppercase">Aura<span class="text-pink-500">Space</span></span>
                    </div>
                    <p class="text-slate-500 text-sm leading-relaxed max-w-sm">
                        Toko online furniture & dekorasi rumah estetik dengan sentuhan modern retro. Bikin kamar tidur dan sudut rumahmu lebih aesthetic, playful, and dreamy ✦
                    </p>
                    <div class="flex items-center gap-3 pt-2">
                        <span class="w-9 h-9 rounded-full bg-sky-100 hover:bg-sky-200 text-sky-600 flex items-center justify-center cursor-pointer transition-colors text-sm font-bold shadow-sm">IG</span>
                        <span class="w-9 h-9 rounded-full bg-pink-100 hover:bg-pink-200 text-pink-600 flex items-center justify-center cursor-pointer transition-colors text-sm font-bold shadow-sm">TT</span>
                        <span class="w-9 h-9 rounded-full bg-purple-100 hover:bg-purple-200 text-purple-600 flex items-center justify-center cursor-pointer transition-colors text-sm font-bold shadow-sm">PT</span>
                    </div>
                </div>

                <!-- Col 2: Quick Links -->
                <div>
                    <h3 class="font-display font-bold text-sm tracking-wider uppercase text-slate-800 mb-4 flex items-center gap-1.5">
                        <span class="text-pink-500">✦</span> Navigasi
                    </h3>
                    <ul class="space-y-2.5 text-sm font-medium text-slate-600">
                        <li><a href="{{ route('home') }}" class="hover:text-sky-600 transition-colors">Home</a></li>
                        <li><a href="{{ route('shop.index') }}" class="hover:text-sky-600 transition-colors">Semua Produk</a></li>
                        <li><a href="{{ route('about') }}" class="hover:text-sky-600 transition-colors">Tentang AuraSpace</a></li>
                        <li><a href="{{ route('contact') }}" class="hover:text-sky-600 transition-colors">Hubungi Kami</a></li>
                    </ul>
                </div>

                <!-- Col 3: Kategori Populer -->
                <div>
                    <h3 class="font-display font-bold text-sm tracking-wider uppercase text-slate-800 mb-4 flex items-center gap-1.5">
                        <span class="text-sky-500">✦</span> Kategori
                    </h3>
                    <ul class="space-y-2.5 text-sm font-medium text-slate-600">
                        <li><a href="{{ route('shop.index', ['category' => 'wall-clock']) }}" class="hover:text-sky-600 transition-colors">Wall Clock</a></li>
                        <li><a href="{{ route('shop.index', ['category' => 'lighting']) }}" class="hover:text-sky-600 transition-colors">Lighting & Glow</a></li>
                        <li><a href="{{ route('shop.index', ['category' => 'mirror']) }}" class="hover:text-sky-600 transition-colors">Wave Mirrors</a></li>
                        <li><a href="{{ route('shop.index', ['category' => 'furniture']) }}" class="hover:text-sky-600 transition-colors">Retro Furniture</a></li>
                        <li><a href="{{ route('shop.index', ['category' => 'storage']) }}" class="hover:text-sky-600 transition-colors">Acrylic Storage</a></li>
                    </ul>
                </div>

                <!-- Col 4: Layanan & Jam Operasional -->
                <div>
                    <h3 class="font-display font-bold text-sm tracking-wider uppercase text-slate-800 mb-4 flex items-center gap-1.5">
                        <span class="text-purple-500">✦</span> Bantuan
                    </h3>
                    <ul class="space-y-2.5 text-sm font-medium text-slate-600">
                        <li><span class="text-slate-400">Senin - Sabtu:</span> 09:00 - 20:00</li>
                        <li><span class="text-slate-400">WhatsApp:</span> +62 812-3456-7890</li>
                        <li><span class="text-slate-400">Email:</span> hello@auraspace.com</li>
                        <li class="pt-2"><a href="{{ route('orders.index') }}" class="text-pink-600 font-bold hover:underline">Lacak Pesanan →</a></li>
                    </ul>
                </div>
            </div>

            <div class="mt-12 pt-8 border-t border-slate-200/80 flex flex-col sm:flex-row items-center justify-between text-xs text-slate-500 gap-4">
                <p>© {{ date('Y') }} AuraSpace Studio. All rights reserved. Crafted with love ✦</p>
                <div class="flex items-center gap-6">
                    <span class="hover:text-slate-700 cursor-pointer">Privacy Policy</span>
                    <span class="hover:text-slate-700 cursor-pointer">Terms of Service</span>
                    <span class="hover:text-slate-700 cursor-pointer">Security</span>
                </div>
            </div>
        </div>
    </footer>

    <!-- Vanilla Javascript Interactions -->
    <script>
        function toggleMobileMenu() {
            const menu = document.getElementById('mobileMenu');
            menu.classList.toggle('hidden');
        }

        function toggleUserDropdown() {
            const dropdown = document.getElementById('userDropdownMenu');
            dropdown.classList.toggle('hidden');
        }

        // Close dropdown when clicked outside
        window.addEventListener('click', function(e) {
            const container = document.getElementById('userMenuContainer');
            const dropdown = document.getElementById('userDropdownMenu');
            if (container && dropdown && !container.contains(e.target)) {
                dropdown.classList.add('hidden');
            }
        });
    </script>
    @stack('scripts')
</body>
</html>
