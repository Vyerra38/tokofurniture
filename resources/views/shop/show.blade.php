@extends('layouts.app')

@section('title', $product->name . ' — AuraSpace ✦')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <!-- Breadcrumb -->
    <div class="flex items-center gap-2 text-xs font-semibold text-slate-400 mb-8">
        <a href="{{ route('home') }}" class="hover:text-sky-600">Home</a>
        <span>/</span>
        <a href="{{ route('shop.index') }}" class="hover:text-sky-600">Shop</a>
        <span>/</span>
        <a href="{{ route('shop.index', ['category' => $product->category->slug]) }}" class="hover:text-sky-600">{{ $product->category->name }}</a>
        <span>/</span>
        <span class="text-slate-700 truncate max-w-xs">{{ $product->name }}</span>
    </div>

    <!-- Product Main Detail Card -->
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-10 items-start">
        <!-- Left: Product Image -->
        <div class="lg:col-span-6">
            <div class="y2k-glass rounded-3xl p-6 sm:p-10 border-2 border-white/90 shadow-2xl relative overflow-hidden group">
                <div class="aspect-square w-full rounded-2xl bg-gradient-to-tr from-sky-50 via-slate-50 to-pink-50 p-8 flex items-center justify-center relative">
                    <img src="{{ $product->image_url }}" alt="{{ $product->name }}" class="w-full h-full object-contain group-hover:scale-105 transition-transform duration-500">
                    
                    @if($product->stock <= 0)
                        <div class="absolute inset-0 bg-slate-900/40 backdrop-blur-xs rounded-2xl flex items-center justify-center">
                            <span class="bg-rose-600 text-white font-extrabold text-sm px-4 py-1.5 rounded-full shadow-lg tracking-wider uppercase">
                                Out of Stock
                            </span>
                        </div>
                    @endif
                </div>

                <!-- Sparkle Badges -->
                <div class="mt-4 flex items-center justify-between text-xs text-slate-500 font-semibold">
                    <span class="flex items-center gap-1.5">
                        <span class="text-pink-500 font-bold">✦</span> Authentic Premium Aesthetic
                    </span>
                    <span class="flex items-center gap-1.5">
                        <span class="text-sky-500 font-bold">📦</span> Safe Box & Bubble Protection
                    </span>
                </div>
            </div>
        </div>

        <!-- Right: Info & Purchase Form -->
        <div class="lg:col-span-6 space-y-6">
            <div class="y2k-glass rounded-3xl p-6 sm:p-8 border border-white/80 shadow-xl space-y-5">
                <!-- Category and Stock Badges -->
                <div class="flex items-center justify-between">
                    <a href="{{ route('shop.index', ['category' => $product->category->slug]) }}" class="text-xs font-bold text-sky-700 bg-sky-100 hover:bg-sky-200 px-3 py-1 rounded-full transition-colors">
                        {{ $product->category->name }} ✦
                    </a>

                    @if($product->stock > 0)
                        <span class="inline-flex items-center gap-1.5 text-xs font-bold text-emerald-700 bg-emerald-100 px-3 py-1 rounded-full">
                            <span class="w-2 h-2 rounded-full bg-emerald-500 animate-pulse"></span>
                            In Stock (Tersedia {{ $product->stock }} pcs)
                        </span>
                    @else
                        <span class="inline-flex items-center gap-1.5 text-xs font-bold text-rose-700 bg-rose-100 px-3 py-1 rounded-full">
                            <span class="w-2 h-2 rounded-full bg-rose-500"></span>
                            Stok Habis
                        </span>
                    @endif
                </div>

                <!-- Product Name -->
                <h1 class="font-display font-black text-2xl sm:text-3xl text-slate-900 tracking-tight">
                    {{ $product->name }}
                </h1>

                <!-- Price -->
                <div class="p-4 bg-gradient-to-r from-sky-50 via-pink-50 to-purple-50 rounded-2xl border border-white flex items-baseline gap-3">
                    <span class="font-display font-black text-3xl sm:text-4xl text-slate-900 tracking-tight">
                        {{ $product->formatted_price }}
                    </span>
                    <span class="text-xs text-slate-400 font-medium">Sudah termasuk PPN</span>
                </div>

                <!-- Description -->
                <div>
                    <h3 class="font-display font-bold text-xs uppercase tracking-wider text-slate-500 mb-2">Deskripsi Produk</h3>
                    <p class="text-slate-600 text-sm leading-relaxed whitespace-pre-line font-medium">
                        {{ $product->description }}
                    </p>
                </div>

                <hr class="border-slate-100">

                <!-- Add to Cart / Buy Now Form -->
                @if($product->stock > 0)
                    <form action="{{ route('cart.add', $product) }}" method="POST" class="space-y-4">
                        @csrf
                        
                        <!-- Quantity Control -->
                        <div class="flex items-center gap-4">
                            <label class="text-xs font-bold text-slate-700">Jumlah:</label>
                            <div class="flex items-center border border-slate-200 bg-white rounded-full p-1 shadow-inner">
                                <button type="button" onclick="adjustQty(-1)" class="w-8 h-8 rounded-full bg-slate-100 hover:bg-slate-200 text-slate-700 font-bold flex items-center justify-center transition-colors">
                                    -
                                </button>
                                <input type="number" id="quantityInput" name="quantity" value="1" min="1" max="{{ $product->stock }}" class="w-14 text-center font-bold text-sm text-slate-800 border-none focus:outline-none [appearance:textfield] [&::-webkit-outer-spin-button]:appearance-none [&::-webkit-inner-spin-button]:appearance-none">
                                <button type="button" onclick="adjustQty(1)" class="w-8 h-8 rounded-full bg-slate-100 hover:bg-slate-200 text-slate-700 font-bold flex items-center justify-center transition-colors">
                                    +
                                </button>
                            </div>
                            <span class="text-xs text-slate-400">Maksimal: {{ $product->stock }} pcs</span>
                        </div>

                        <!-- Buttons Row -->
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-3 pt-2">
                            <!-- Tambah ke Keranjang -->
                            <button type="submit" name="buy_now" value="0" class="y2k-btn-primary w-full text-xs sm:text-sm !py-3">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path></svg>
                                <span>Tambah ke Keranjang ✦</span>
                            </button>

                            <!-- Beli Sekarang -->
                            <button type="submit" name="buy_now" value="1" class="y2k-btn-pink w-full text-xs sm:text-sm !py-3">
                                <span>Beli Sekarang ♡</span>
                            </button>
                        </div>
                    </form>
                @else
                    <div class="p-4 bg-slate-100 rounded-2xl text-center space-y-2 border border-slate-200">
                        <p class="text-xs font-bold text-slate-600">Produk ini saat ini sedang tidak tersedia.</p>
                        <button disabled class="w-full py-3 rounded-full bg-slate-300 text-slate-500 font-bold text-xs cursor-not-allowed">
                            Out of Stock
                        </button>
                    </div>
                @endif
            </div>
        </div>
    </div>

    <!-- Related Products Section -->
    @if($relatedProducts->count() > 0)
        <div class="mt-20">
            <div class="flex items-center justify-between mb-8">
                <div>
                    <span class="text-xs font-extrabold text-pink-600 tracking-wider uppercase">✦ RECOMMENDATIONS</span>
                    <h2 class="font-display font-black text-2xl text-slate-900 tracking-tight">
                        Related Products
                    </h2>
                </div>
                <a href="{{ route('shop.index', ['category' => $product->category->slug]) }}" class="text-xs font-bold text-sky-600 hover:underline">
                    Lihat Kategori Ini →
                </a>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                @foreach($relatedProducts as $relProduct)
                    <x-product-card :product="$relProduct" />
                @endforeach
            </div>
        </div>
    @endif
</div>

@push('scripts')
<script>
    function adjustQty(change) {
        const input = document.getElementById('quantityInput');
        if (!input) return;
        let val = parseInt(input.value) || 1;
        const max = parseInt(input.getAttribute('max')) || 100;
        val += change;
        if (val < 1) val = 1;
        if (val > max) val = max;
        input.value = val;
    }
</script>
@endpush
@endsection
