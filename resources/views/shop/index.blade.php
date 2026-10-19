@extends('layouts.app')

@section('title', 'Katalog Shop — AuraSpace Furniture ✦')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <!-- Breadcrumb -->
    <div class="flex items-center gap-2 text-xs font-semibold text-slate-400 mb-6">
        <a href="{{ route('home') }}" class="hover:text-sky-600">Home</a>
        <span>/</span>
        <span class="text-slate-700">Katalog Produk</span>
        @if($activeCategory)
            <span>/</span>
            <span class="text-pink-600 font-bold">{{ $activeCategory->name }}</span>
        @endif
    </div>

    <!-- Header Title & Filter Summary -->
    <div class="flex flex-col md:flex-row md:items-end justify-between gap-4 mb-8">
        <div>
            <span class="text-xs font-extrabold text-pink-600 tracking-wider uppercase">✦ ALL DROPS</span>
            <h1 class="font-display font-black text-3xl sm:text-4xl text-slate-900 tracking-tight mt-1">
                {{ $activeCategory ? $activeCategory->name : 'Semua Furniture & Dekorasi' }}
            </h1>
            <p class="text-xs sm:text-sm text-slate-500 mt-1">
                Menampilkan {{ $products->total() }} produk furniture & dekorasi pilihan
            </p>
        </div>

        <!-- Sorting Selector -->
        <form id="sortForm" action="{{ route('shop.index') }}" method="GET" class="flex items-center gap-2 self-start md:self-auto">
            @if(request('category')) <input type="hidden" name="category" value="{{ request('category') }}"> @endif
            @if(request('search')) <input type="hidden" name="search" value="{{ request('search') }}"> @endif
            @if(request('min_price')) <input type="hidden" name="min_price" value="{{ request('min_price') }}"> @endif
            @if(request('max_price')) <input type="hidden" name="max_price" value="{{ request('max_price') }}"> @endif

            <label class="text-xs font-bold text-slate-500 shrink-0">Urutkan:</label>
            <select name="sort" onchange="this.form.submit()" class="bg-white/90 border border-slate-200 rounded-full px-4 py-2 text-xs font-semibold text-slate-700 focus:outline-none focus:border-sky-400 shadow-xs">
                <option value="latest" {{ $sort === 'latest' ? 'selected' : '' }}>Terbaru ✦</option>
                <option value="price_low" {{ $sort === 'price_low' ? 'selected' : '' }}>Harga Termurah</option>
                <option value="price_high" {{ $sort === 'price_high' ? 'selected' : '' }}>Harga Tertinggi</option>
                <option value="name_asc" {{ $sort === 'name_asc' ? 'selected' : '' }}>Nama A - Z</option>
            </select>
        </form>
    </div>

    <!-- Category Pill Filter Bar -->
    <div class="flex items-center gap-2 overflow-x-auto pb-4 mb-8 scrollbar-none">
        <a href="{{ route('shop.index', request()->except('category', 'page')) }}" class="shrink-0 px-4 py-2 rounded-full text-xs font-bold transition-all {{ !request('category') ? 'bg-slate-900 text-white shadow-md' : 'bg-white/80 text-slate-600 hover:bg-white border border-slate-200' }}">
            Semua ({{ \App\Models\Product::count() }})
        </a>
        @foreach($categories as $cat)
            <a href="{{ route('shop.index', array_merge(request()->except('page'), ['category' => $cat->slug])) }}" class="shrink-0 px-4 py-2 rounded-full text-xs font-bold transition-all {{ request('category') === $cat->slug ? 'bg-gradient-to-r from-sky-400 to-pink-400 text-white shadow-md' : 'bg-white/80 text-slate-600 hover:bg-white border border-slate-200' }}">
                {{ $cat->name }} ({{ $cat->products_count }})
            </a>
        @endforeach
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-4 gap-8">
        <!-- Sidebar Filter (Desktop) -->
        <div class="lg:col-span-1 space-y-6">
            <div class="y2k-glass rounded-3xl p-6 border border-white/80 shadow-md">
                <h3 class="font-display font-bold text-sm uppercase tracking-wider text-slate-800 mb-4 flex items-center justify-between">
                    <span>Filter Produk</span>
                    @if(request()->anyFilled(['search', 'category', 'min_price', 'max_price']))
                        <a href="{{ route('shop.index') }}" class="text-[10px] text-rose-500 font-bold hover:underline">Reset</a>
                    @endif
                </h3>

                <form action="{{ route('shop.index') }}" method="GET" class="space-y-4">
                    @if(request('category')) <input type="hidden" name="category" value="{{ request('category') }}"> @endif
                    @if(request('sort')) <input type="hidden" name="sort" value="{{ request('sort') }}"> @endif

                    <!-- Search -->
                    <div>
                        <label class="block text-xs font-bold text-slate-600 mb-1">Cari Nama</label>
                        <input type="text" name="search" value="{{ request('search') }}" placeholder="Ketik nama produk..." class="w-full bg-white border border-slate-200 rounded-xl px-3 py-2 text-xs focus:outline-none focus:border-sky-400">
                    </div>

                    <!-- Min Price -->
                    <div>
                        <label class="block text-xs font-bold text-slate-600 mb-1">Harga Minimum (Rp)</label>
                        <input type="number" name="min_price" value="{{ request('min_price') }}" placeholder="Contoh: 100000" class="w-full bg-white border border-slate-200 rounded-xl px-3 py-2 text-xs focus:outline-none focus:border-sky-400">
                    </div>

                    <!-- Max Price -->
                    <div>
                        <label class="block text-xs font-bold text-slate-600 mb-1">Harga Maksimum (Rp)</label>
                        <input type="number" name="max_price" value="{{ request('max_price') }}" placeholder="Contoh: 1000000" class="w-full bg-white border border-slate-200 rounded-xl px-3 py-2 text-xs focus:outline-none focus:border-sky-400">
                    </div>

                    <button type="submit" class="w-full y2k-btn-primary text-xs !py-2.5">
                        Terapkan Filter ✦
                    </button>
                </form>
            </div>
        </div>

        <!-- Products Grid Area -->
        <div class="lg:col-span-3">
            @if($products->count() > 0)
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach($products as $product)
                        <x-product-card :product="$product" />
                    @endforeach
                </div>

                <!-- Pagination -->
                <div class="mt-10">
                    {{ $products->links() }}
                </div>
            @else
                <!-- Empty State -->
                <div class="y2k-glass rounded-3xl p-12 text-center border border-white/80 shadow-md max-w-md mx-auto">
                    <span class="text-4xl mb-3 inline-block">🔍</span>
                    <h3 class="font-display font-bold text-lg text-slate-800">Produk Tidak Ditemukan</h3>
                    <p class="text-xs text-slate-500 mt-2 mb-6 leading-relaxed">
                        Maaf, kami tidak menemukan produk yang cocok dengan pencarian atau filter kamu. Coba kata kunci lain ya!
                    </p>
                    <a href="{{ route('shop.index') }}" class="y2k-btn-primary text-xs !py-2.5 !px-5">
                        Lihat Semua Produk ✦
                    </a>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection
