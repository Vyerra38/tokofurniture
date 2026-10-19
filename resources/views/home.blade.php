@extends('layouts.app')

@section('title', 'AuraSpace — Make Your Space ✦ More You')

@section('content')
    <!-- Hero Section -->
    <section class="relative overflow-hidden pt-6 pb-16 lg:pt-12 lg:pb-24">
        <!-- Background Bubble Glows -->
        <div class="absolute top-10 left-1/4 w-96 h-96 bg-pink-300/30 rounded-full blur-3xl pointer-events-none animate-float-slow"></div>
        <div class="absolute bottom-10 right-1/4 w-96 h-96 bg-sky-300/30 rounded-full blur-3xl pointer-events-none"></div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 items-center">
                <!-- Left Hero Text -->
                <div class="lg:col-span-7 space-y-6 text-center lg:text-left">
                    <div class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full y2k-glass border border-white text-xs font-bold text-sky-800 shadow-sm">
                        <span class="text-pink-500 animate-pulse">✦</span>
                        <span>RETROFUTURISTIC & PASTEL LIVING</span>
                    </div>

                    <h1 class="font-display font-black text-4xl sm:text-5xl lg:text-6xl text-slate-900 tracking-tight leading-[1.1]">
                        Make Your Space <br>
                        <span class="chrome-text">✦ More You</span>
                    </h1>

                    <p class="text-base sm:text-lg text-slate-600 max-w-xl mx-auto lg:mx-0 font-medium leading-relaxed">
                        Furniture & decor pilihan untuk bikin kamar dan rumah kamu lebih aesthetic, playful, dan penuh aura estetik impianmu.
                    </p>

                    <div class="flex flex-wrap items-center justify-center lg:justify-start gap-4 pt-2">
                        <a href="{{ route('shop.index') }}" class="y2k-btn-primary text-sm sm:text-base">
                            <span>Shop Now ✦</span>
                        </a>
                        <a href="#categories" class="y2k-btn-secondary text-sm sm:text-base">
                            <span>Explore Collection</span>
                        </a>
                    </div>

                    <!-- Trust Stats Bar -->
                    <div class="pt-6 border-t border-slate-200/60 grid grid-cols-3 gap-4 max-w-md mx-auto lg:mx-0 text-center lg:text-left">
                        <div>
                            <p class="font-display font-black text-xl sm:text-2xl text-slate-800">500+</p>
                            <p class="text-xs text-slate-500 font-medium">Happy Rooms</p>
                        </div>
                        <div>
                            <p class="font-display font-black text-xl sm:text-2xl text-slate-800">100%</p>
                            <p class="text-xs text-slate-500 font-medium">Aesthetic Quality</p>
                        </div>
                        <div>
                            <p class="font-display font-black text-xl sm:text-2xl text-slate-800">4.9 ★</p>
                            <p class="text-xs text-slate-500 font-medium">Customer Love</p>
                        </div>
                    </div>
                </div>

                <!-- Right Hero Visual Composite -->
                <div class="lg:col-span-5 relative">
                    <div class="relative mx-auto max-w-md lg:max-w-none">
                        <!-- Main Card -->
                        <div class="y2k-glass rounded-3xl p-6 border-2 border-white/80 shadow-2xl relative overflow-hidden group">
                            <div class="relative aspect-4/3 rounded-2xl overflow-hidden bg-gradient-to-tr from-sky-100 via-pink-100 to-purple-100 p-6 flex items-center justify-center">
                                <img src="{{ asset('images/products/y2k-wave-mirror.svg') }}" alt="Y2K Wave Mirror" class="w-full h-full object-contain group-hover:scale-110 transition-transform duration-500">
                                
                                <div class="absolute top-3 right-3 bg-white/90 backdrop-blur-md px-3 py-1 rounded-full text-xs font-black text-pink-600 shadow-sm">
                                    HOT DROP ✦
                                </div>
                            </div>
                            <div class="mt-4 flex items-center justify-between">
                                <div>
                                    <h4 class="font-bold text-slate-800 text-base">Wave Mirror Lilac Neon</h4>
                                    <p class="text-xs text-slate-400">Statement Mirror Series</p>
                                </div>
                                <span class="font-display font-black text-lg text-slate-900">Rp349.000</span>
                            </div>
                        </div>

                        <!-- Floating Accent 1 -->
                        <div class="absolute -bottom-6 -left-6 y2k-glass rounded-2xl p-3.5 border border-white shadow-xl flex items-center gap-3 animate-float-slow">
                            <span class="w-10 h-10 rounded-xl bg-pink-100 flex items-center justify-center text-xl">🪞</span>
                            <div>
                                <p class="text-xs font-bold text-slate-800">Mirror Selfie Ready</p>
                                <p class="text-[10px] text-slate-400 font-medium">Wavy pastel vibes ♡</p>
                            </div>
                        </div>

                        <!-- Floating Accent 2 -->
                        <div class="absolute -top-6 -right-6 y2k-glass rounded-2xl p-3 border border-white shadow-xl flex items-center gap-2">
                            <span class="text-amber-400 text-lg">★</span>
                            <span class="text-xs font-extrabold text-slate-800">Bestseller #1</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Categories Section -->
    <section id="categories" class="py-12 relative">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex flex-col sm:flex-row sm:items-end justify-between mb-8 gap-4">
                <div>
                    <div class="inline-flex items-center gap-1.5 text-xs font-extrabold text-pink-600 tracking-wider uppercase mb-1">
                        <span>✦</span> CATEGORIES
                    </div>
                    <h2 class="font-display font-black text-2xl sm:text-3xl text-slate-900 tracking-tight">
                        Temukan Gaya Ruangmu
                    </h2>
                </div>
                <a href="{{ route('shop.index') }}" class="text-xs font-bold text-sky-600 hover:text-sky-700 flex items-center gap-1 group">
                    <span>Lihat Semua Kategori</span>
                    <span class="group-hover:translate-x-1 transition-transform">→</span>
                </a>
            </div>

            <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-6 gap-4">
                @foreach($categories as $cat)
                    <a href="{{ route('shop.index', ['category' => $cat->slug]) }}" class="y2k-glass rounded-3xl p-4 text-center y2k-card-hover group border border-white/80 flex flex-col items-center">
                        <div class="w-14 h-14 rounded-2xl bg-gradient-to-tr from-sky-100 via-pink-100 to-purple-100 flex items-center justify-center text-2xl mb-3 shadow-inner group-hover:scale-110 transition-transform">
                            @switch($cat->slug)
                                @case('wall-clock') ⏰ @break
                                @case('lighting') 💡 @break
                                @case('mirror') 🪞 @break
                                @case('furniture') 🪑 @break
                                @case('storage') 📦 @break
                                @case('decoration') ✨ @break
                                @default ✦
                            @endswitch
                        </div>
                        <h3 class="font-bold text-xs sm:text-sm text-slate-800 group-hover:text-sky-600 transition-colors">
                            {{ $cat->name }}
                        </h3>
                        <span class="text-[10px] text-slate-400 font-medium mt-0.5">
                            {{ $cat->products_count }} Produk
                        </span>
                    </a>
                @endforeach
            </div>
        </div>
    </section>

    <!-- Featured Products Section -->
    <section class="py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex flex-col sm:flex-row sm:items-end justify-between mb-8 gap-4">
                <div>
                    <div class="inline-flex items-center gap-1.5 text-xs font-extrabold text-sky-600 tracking-wider uppercase mb-1">
                        <span>✦</span> CURATED PICKS
                    </div>
                    <h2 class="font-display font-black text-2xl sm:text-3xl text-slate-900 tracking-tight">
                        Featured Products ✦
                    </h2>
                </div>
                <a href="{{ route('shop.index') }}" class="y2k-btn-secondary text-xs !py-2 !px-4">
                    Katalog Lengkap →
                </a>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                @foreach($featuredProducts as $product)
                    <x-product-card :product="$product" />
                @endforeach
            </div>
        </div>
    </section>

    <!-- Promotional Banner Section -->
    <section class="py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="y2k-glass rounded-3xl p-8 sm:p-12 lg:p-16 border-2 border-white relative overflow-hidden shadow-2xl">
                <!-- Gloss Background Decor -->
                <div class="absolute -right-20 -bottom-20 w-80 h-80 rounded-full bg-gradient-to-tr from-pink-300 to-sky-300 opacity-30 blur-2xl pointer-events-none"></div>
                <div class="absolute -left-10 -top-10 w-60 h-60 rounded-full bg-purple-200 opacity-40 blur-2xl pointer-events-none"></div>

                <div class="max-w-2xl relative z-10 space-y-4">
                    <span class="text-xs font-extrabold text-pink-600 tracking-widest uppercase bg-pink-100 px-3 py-1 rounded-full">
                        LIMITED SEASONAL DROP ♡
                    </span>
                    <h2 class="font-display font-black text-3xl sm:text-4xl lg:text-5xl text-slate-900 tracking-tight leading-tight">
                        Your room called... <br>
                        <span class="chrome-text">It wants a makeover ✦</span>
                    </h2>
                    <p class="text-slate-600 text-sm sm:text-base font-medium leading-relaxed">
                        Upgrade sudut mejamu dengan jam bubble chrome, lampu awan pastel dreamy, dan vas akrilik pelangi. Sentuhan kecil yang bikin suasana kamar berubah 180 derajat!
                    </p>
                    <div class="pt-2">
                        <a href="{{ route('shop.index') }}" class="y2k-btn-pink text-sm font-bold">
                            Shop the Look ✦
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- New Arrivals & Best Seller Tabbed/Split Section -->
    <section class="py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-16">
            <!-- New Arrivals -->
            <div>
                <div class="flex items-center justify-between mb-8">
                    <div>
                        <span class="text-xs font-extrabold text-purple-600 tracking-wider uppercase">✦ FRESH DROPS</span>
                        <h2 class="font-display font-black text-2xl sm:text-3xl text-slate-900 tracking-tight">New Arrivals</h2>
                    </div>
                    <a href="{{ route('shop.index', ['sort' => 'latest']) }}" class="text-xs font-bold text-sky-600 hover:underline">Semua Rilis Baru →</a>
                </div>
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                    @foreach($newArrivals as $product)
                        <x-product-card :product="$product" />
                    @endforeach
                </div>
            </div>

            <!-- Best Seller -->
            <div>
                <div class="flex items-center justify-between mb-8">
                    <div>
                        <span class="text-xs font-extrabold text-pink-600 tracking-wider uppercase">✦ MOST LOVED</span>
                        <h2 class="font-display font-black text-2xl sm:text-3xl text-slate-900 tracking-tight">Best Seller Collections</h2>
                    </div>
                    <a href="{{ route('shop.index') }}" class="text-xs font-bold text-sky-600 hover:underline">Lihat Koleksi Populer →</a>
                </div>
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                    @foreach($bestSellers as $product)
                        <x-product-card :product="$product" />
                    @endforeach
                </div>
            </div>
        </div>
    </section>

    <!-- Why Shop With Us Section -->
    <section class="py-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center max-w-xl mx-auto mb-12">
                <span class="text-xs font-extrabold text-sky-600 tracking-widest uppercase">✦ AURA ADVANTAGE</span>
                <h2 class="font-display font-black text-2xl sm:text-3xl text-slate-900 tracking-tight mt-1">
                    Kenapa Belanja di AuraSpace?
                </h2>
                <p class="text-slate-500 text-sm mt-2">Dibuat khusus untuk kamu yang mengutamakan estetika dan kenyamanan.</p>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                <!-- Point 1 -->
                <div class="y2k-glass rounded-3xl p-6 text-center border border-white/80 y2k-card-hover">
                    <div class="w-12 h-12 rounded-2xl bg-sky-100 text-sky-600 flex items-center justify-center text-xl mx-auto mb-4 font-bold shadow-xs">
                        ✦
                    </div>
                    <h3 class="font-display font-bold text-base text-slate-900 mb-2">Produk Aesthetic</h3>
                    <p class="text-xs text-slate-500 leading-relaxed">
                        Desain terkurasi dengan sentuhan futuristik modern dan pastel yang tidak pasaran.
                    </p>
                </div>

                <!-- Point 2 -->
                <div class="y2k-glass rounded-3xl p-6 text-center border border-white/80 y2k-card-hover">
                    <div class="w-12 h-12 rounded-2xl bg-pink-100 text-pink-600 flex items-center justify-center text-xl mx-auto mb-4 font-bold shadow-xs">
                        ♡
                    </div>
                    <h3 class="font-display font-bold text-base text-slate-900 mb-2">Harga Terjangkau</h3>
                    <p class="text-xs text-slate-500 leading-relaxed">
                        Makeover ruangan impian tanpa harus menguras seluruh tabunganmu.
                    </p>
                </div>

                <!-- Point 3 -->
                <div class="y2k-glass rounded-3xl p-6 text-center border border-white/80 y2k-card-hover">
                    <div class="w-12 h-12 rounded-2xl bg-purple-100 text-purple-600 flex items-center justify-center text-xl mx-auto mb-4 font-bold shadow-xs">
                        📦
                    </div>
                    <h3 class="font-display font-bold text-base text-slate-900 mb-2">Packaging Aman</h3>
                    <p class="text-xs text-slate-500 leading-relaxed">
                        Perlindungan bubble wrap berlapis & packing kayu untuk cermin dan lampu.
                    </p>
                </div>

                <!-- Point 4 -->
                <div class="y2k-glass rounded-3xl p-6 text-center border border-white/80 y2k-card-hover">
                    <div class="w-12 h-12 rounded-2xl bg-indigo-100 text-indigo-600 flex items-center justify-center text-xl mx-auto mb-4 font-bold shadow-xs">
                        ✨
                    </div>
                    <h3 class="font-display font-bold text-base text-slate-900 mb-2">Pilihan Lengkap</h3>
                    <p class="text-xs text-slate-500 leading-relaxed">
                        Dari jam dinding chrome hingga meja bubble dan rak akrilik transparan.
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- Newsletter / CTA -->
    <section class="py-12">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="y2k-glass rounded-3xl p-8 sm:p-12 text-center border-2 border-white shadow-xl relative overflow-hidden">
                <span class="text-2xl mb-2 inline-block">💌</span>
                <h2 class="font-display font-black text-2xl sm:text-3xl text-slate-900 tracking-tight">
                    Don't miss the next drop ✦
                </h2>
                <p class="text-slate-600 text-xs sm:text-sm max-w-md mx-auto mt-2 mb-6">
                    Dapatkan info drop koleksi furniture baru, diskon rahasia, dan inspirasi dekor kamar estetik langsung ke inbox kamu.
                </p>
                <form onsubmit="event.preventDefault(); alert('Terima kasih! Kamu sudah bergabung dalam club AuraSpace ♡');" class="flex flex-col sm:flex-row gap-3 max-w-md mx-auto">
                    <input type="email" required placeholder="Masukkan email kamu..." class="flex-1 bg-white border border-slate-200 focus:border-pink-400 focus:outline-none rounded-full px-5 py-2.5 text-xs font-medium shadow-inner">
                    <button type="submit" class="y2k-btn-pink text-xs !py-2.5 !px-6">
                        Subscribe ♡
                    </button>
                </form>
            </div>
        </div>
    </section>
@endsection
