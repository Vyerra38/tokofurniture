<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Admin Panel') — AuraSpace Store Control ✦</title>
    
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&family=Space+Grotesk:wght@600;700&display=swap" rel="stylesheet">
    
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
        .font-display { font-family: 'Space Grotesk', sans-serif; }
    </style>
    @stack('styles')
</head>
<body class="bg-slate-50 text-slate-800 antialiased min-h-screen flex flex-col md:flex-row">

    <!-- Mobile Admin Header -->
    <div class="md:hidden bg-slate-900 text-white p-4 flex items-center justify-between sticky top-0 z-50">
        <div class="flex items-center gap-2">
            <span class="w-8 h-8 rounded-full bg-gradient-to-tr from-sky-400 to-pink-400 flex items-center justify-center font-bold text-xs">⚡</span>
            <span class="font-display font-bold tracking-wider">AuraSpace Admin</span>
        </div>
        <button onclick="document.getElementById('adminSidebar').classList.toggle('hidden')" class="p-2 text-slate-300 hover:text-white">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path></svg>
        </button>
    </div>

    <!-- Admin Sidebar -->
    <aside id="adminSidebar" class="hidden md:flex flex-col w-64 bg-slate-900 text-slate-300 border-r border-slate-800 shrink-0 min-h-screen sticky top-0 p-5 z-40">
        <!-- Logo -->
        <div class="flex items-center gap-2.5 pb-6 border-b border-slate-800">
            <div class="w-10 h-10 rounded-2xl bg-gradient-to-tr from-sky-400 via-pink-400 to-purple-500 p-0.5 shadow-md">
                <div class="w-full h-full bg-slate-900 rounded-2xl flex items-center justify-center">
                    <span class="text-sky-300 font-bold text-base">⚡</span>
                </div>
            </div>
            <div>
                <h1 class="font-display font-bold text-white text-base tracking-wider">AuraSpace</h1>
                <p class="text-[10px] text-pink-400 tracking-widest uppercase font-semibold">Admin Workspace ✦</p>
            </div>
        </div>

        <!-- Navigation Menu -->
        <nav class="flex-1 py-6 space-y-1.5 text-sm font-semibold">
            <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl transition-all {{ request()->routeIs('admin.dashboard') ? 'bg-sky-500/20 text-sky-300 border border-sky-500/30 font-bold' : 'hover:bg-slate-800 text-slate-400 hover:text-white' }}">
                <span class="text-lg">📊</span>
                <span>Dashboard</span>
            </a>

            <a href="{{ route('admin.categories.index') }}" class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl transition-all {{ request()->routeIs('admin.categories.*') ? 'bg-sky-500/20 text-sky-300 border border-sky-500/30 font-bold' : 'hover:bg-slate-800 text-slate-400 hover:text-white' }}">
                <span class="text-lg">🏷️</span>
                <span>Kategori Produk</span>
            </a>

            <a href="{{ route('admin.products.index') }}" class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl transition-all {{ request()->routeIs('admin.products.*') ? 'bg-sky-500/20 text-sky-300 border border-sky-500/30 font-bold' : 'hover:bg-slate-800 text-slate-400 hover:text-white' }}">
                <span class="text-lg">📦</span>
                <span>Katalog Produk</span>
            </a>

            <a href="{{ route('admin.orders.index') }}" class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl transition-all {{ request()->routeIs('admin.orders.*') ? 'bg-sky-500/20 text-sky-300 border border-sky-500/30 font-bold' : 'hover:bg-slate-800 text-slate-400 hover:text-white' }}">
                <span class="text-lg">🛍️</span>
                <span>Manajemen Pesanan</span>
            </a>

            <a href="{{ route('admin.customers.index') }}" class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl transition-all {{ request()->routeIs('admin.customers.*') ? 'bg-sky-500/20 text-sky-300 border border-sky-500/30 font-bold' : 'hover:bg-slate-800 text-slate-400 hover:text-white' }}">
                <span class="text-lg">👥</span>
                <span>Pelanggan</span>
            </a>

            <div class="pt-4 mt-4 border-t border-slate-800">
                <a href="{{ route('home') }}" target="_blank" class="flex items-center justify-between px-3.5 py-2 rounded-xl text-xs font-medium text-slate-400 hover:text-sky-300 hover:bg-slate-800/80 transition-colors">
                    <span class="flex items-center gap-2">
                        <span>🌐</span> Lihat Toko
                    </span>
                    <span class="text-[10px] bg-slate-800 px-1.5 py-0.5 rounded text-slate-400">↗</span>
                </a>
            </div>
        </nav>

        <!-- User Info & Logout -->
        <div class="pt-4 border-t border-slate-800 flex items-center justify-between">
            <div class="flex items-center gap-2.5">
                <div class="w-8 h-8 rounded-full bg-gradient-to-br from-pink-400 to-purple-600 flex items-center justify-center text-white font-bold text-xs">
                    {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                </div>
                <div class="overflow-hidden">
                    <p class="text-xs font-bold text-white truncate">{{ Auth::user()->name }}</p>
                    <p class="text-[10px] text-slate-400 capitalize">Administrator</p>
                </div>
            </div>
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" title="Logout" class="p-2 text-slate-400 hover:text-rose-400 hover:bg-slate-800 rounded-lg transition-colors">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path></svg>
                </button>
            </form>
        </div>
    </aside>

    <!-- Admin Main Body -->
    <div class="flex-1 flex flex-col min-w-0">
        <!-- Topbar Header -->
        <header class="bg-white border-b border-slate-200 px-6 py-4 flex items-center justify-between">
            <div>
                <h2 class="text-lg font-bold text-slate-800">@yield('page-title', 'Dashboard')</h2>
                <p class="text-xs text-slate-500">AuraSpace Admin Control Panel ✦</p>
            </div>
            <div class="flex items-center gap-3">
                <a href="{{ route('home') }}" class="y2k-btn-secondary text-xs !py-1.5 !px-3.5">
                    Lihat Toko ↗
                </a>
            </div>
        </header>

        <!-- Flash Messages -->
        <div class="px-6 pt-4">
            @if(session('success'))
                <div class="bg-emerald-50 border border-emerald-300 text-emerald-800 px-4 py-3 rounded-2xl flex items-center justify-between text-xs font-semibold mb-4 shadow-sm">
                    <div class="flex items-center gap-2">
                        <span class="text-base font-bold text-emerald-600">✦</span>
                        <span>{{ session('success') }}</span>
                    </div>
                    <button onclick="this.parentElement.remove()" class="text-emerald-600 hover:text-emerald-800">✕</button>
                </div>
            @endif

            @if(session('error'))
                <div class="bg-rose-50 border border-rose-300 text-rose-800 px-4 py-3 rounded-2xl flex items-center justify-between text-xs font-semibold mb-4 shadow-sm">
                    <div class="flex items-center gap-2">
                        <span class="text-base font-bold text-rose-600">!</span>
                        <span>{{ session('error') }}</span>
                    </div>
                    <button onclick="this.parentElement.remove()" class="text-rose-600 hover:text-rose-800">✕</button>
                </div>
            @endif

            @if(session('info'))
                <div class="bg-sky-50 border border-sky-300 text-sky-800 px-4 py-3 rounded-2xl flex items-center justify-between text-xs font-semibold mb-4 shadow-sm">
                    <div class="flex items-center gap-2">
                        <span class="text-base font-bold text-sky-600">ℹ</span>
                        <span>{{ session('info') }}</span>
                    </div>
                    <button onclick="this.parentElement.remove()" class="text-sky-600 hover:text-sky-800">✕</button>
                </div>
            @endif
        </div>

        <!-- Admin Content Area -->
        <main class="flex-1 p-6">
            @yield('content')
        </main>
    </div>

    @stack('scripts')
</body>
</html>
