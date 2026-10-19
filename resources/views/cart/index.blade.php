@extends('layouts.app')

@section('title', 'Keranjang Belanja — AuraSpace ✦')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <!-- Breadcrumb -->
    <div class="flex items-center gap-2 text-xs font-semibold text-slate-400 mb-6">
        <a href="{{ route('home') }}" class="hover:text-sky-600">Home</a>
        <span>/</span>
        <span class="text-slate-700">Keranjang Belanja</span>
    </div>

    <div class="mb-8">
        <span class="text-xs font-extrabold text-sky-600 tracking-wider uppercase">✦ MY BASKET</span>
        <h1 class="font-display font-black text-3xl sm:text-4xl text-slate-900 tracking-tight mt-1">
            Keranjang Belanja Kamu 🛍️
        </h1>
    </div>

    @if($cart->items->count() > 0)
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-start">
            <!-- Left: Cart Items List -->
            <div class="lg:col-span-8 space-y-4">
                @foreach($cart->items as $item)
                    <div class="y2k-glass rounded-3xl p-4 sm:p-5 border border-white/80 shadow-md flex flex-col sm:flex-row items-center gap-4 sm:gap-6 justify-between">
                        <!-- Product Visual & Info -->
                        <div class="flex items-center gap-4 w-full sm:w-auto">
                            <div class="w-20 h-20 rounded-2xl bg-gradient-to-tr from-sky-50 to-pink-50 p-2 shrink-0 border border-white/80 flex items-center justify-center">
                                <img src="{{ $item->product->image_url }}" alt="{{ $item->product->name }}" class="w-full h-full object-contain">
                            </div>
                            <div class="min-w-0 flex-1">
                                <span class="text-[10px] font-bold text-sky-700 bg-sky-100 px-2 py-0.5 rounded-full">
                                    {{ $item->product->category->name }}
                                </span>
                                <h3 class="font-bold text-sm text-slate-900 mt-1 truncate">
                                    <a href="{{ route('shop.show', $item->product->slug) }}" class="hover:text-sky-600">
                                        {{ $item->product->name }}
                                    </a>
                                </h3>
                                <p class="text-xs font-bold text-slate-700 mt-0.5">
                                    {{ $item->product->formatted_price }}
                                </p>
                                <span class="text-[10px] text-slate-400">
                                    Tersedia {{ $item->product->stock }} pcs
                                </span>
                            </div>
                        </div>

                        <!-- Quantity Control and Subtotal -->
                        <div class="flex items-center justify-between sm:justify-end gap-6 w-full sm:w-auto border-t sm:border-t-0 pt-3 sm:pt-0 border-slate-100">
                            <!-- Qty Form -->
                            <div class="flex items-center gap-1.5">
                                <!-- Decrease -->
                                <form action="{{ route('cart.update', $item) }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <input type="hidden" name="quantity" value="{{ max(1, $item->quantity - 1) }}">
                                    <button type="submit" {{ $item->quantity <= 1 ? 'disabled' : '' }} class="w-7 h-7 rounded-full bg-slate-100 hover:bg-slate-200 disabled:opacity-40 disabled:cursor-not-allowed text-slate-700 font-bold flex items-center justify-center text-xs transition-colors">
                                        -
                                    </button>
                                </form>

                                <span class="w-8 text-center text-xs font-black text-slate-900">
                                    {{ $item->quantity }}
                                </span>

                                <!-- Increase -->
                                <form action="{{ route('cart.update', $item) }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <input type="hidden" name="quantity" value="{{ $item->quantity + 1 }}">
                                    <button type="submit" {{ $item->quantity >= $item->product->stock ? 'disabled' : '' }} class="w-7 h-7 rounded-full bg-slate-100 hover:bg-slate-200 disabled:opacity-40 disabled:cursor-not-allowed text-slate-700 font-bold flex items-center justify-center text-xs transition-colors">
                                        +
                                    </button>
                                </form>
                            </div>

                            <!-- Subtotal -->
                            <div class="text-right min-w-[90px]">
                                <span class="block text-[10px] text-slate-400 uppercase font-semibold">Subtotal</span>
                                <span class="font-display font-black text-sm text-slate-900">
                                    {{ $item->formatted_subtotal }}
                                </span>
                            </div>

                            <!-- Delete Item Button -->
                            <form action="{{ route('cart.remove', $item) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="p-2 text-slate-400 hover:text-rose-500 hover:bg-rose-50 rounded-full transition-colors" title="Hapus Produk">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                </button>
                            </form>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Right: Order Summary Card -->
            <div class="lg:col-span-4">
                <div class="y2k-glass rounded-3xl p-6 sm:p-7 border-2 border-white/90 shadow-xl space-y-5 sticky top-28">
                    <h2 class="font-display font-black text-lg text-slate-900">
                        Ringkasan Belanja ✦
                    </h2>

                    <div class="space-y-3 text-xs font-semibold text-slate-600">
                        <div class="flex items-center justify-between">
                            <span>Total Item</span>
                            <span class="text-slate-900 font-bold">{{ $cart->total_quantity }} barang</span>
                        </div>
                        <div class="flex items-center justify-between">
                            <span>Subtotal Produk</span>
                            <span class="text-slate-900 font-bold">{{ $cart->formatted_total_price }}</span>
                        </div>
                        <div class="flex items-center justify-between">
                            <span>Perkiraan Ongkir</span>
                            @if($cart->total_price >= 500000)
                                <span class="text-emerald-600 font-bold uppercase tracking-wider">GRATIS ✦</span>
                            @else
                                <span class="text-slate-900 font-bold">Rp25.000</span>
                            @endif
                        </div>
                    </div>

                    @if($cart->total_price < 500000)
                        <div class="p-3 bg-pink-50 rounded-2xl border border-pink-100 text-[11px] text-pink-700 font-medium">
                            ✦ Tambah belanjaan <strong>{{ format_rupiah(500000 - $cart->total_price) }}</strong> lagi untuk dapat <strong>Gratis Ongkir</strong>!
                        </div>
                    @endif

                    <hr class="border-slate-100">

                    <div class="flex items-baseline justify-between">
                        <span class="font-display font-black text-base text-slate-900">Estimasi Total</span>
                        <span class="font-display font-black text-xl text-sky-700">
                            {{ format_rupiah($cart->total_price >= 500000 ? $cart->total_price : $cart->total_price + 25000) }}
                        </span>
                    </div>

                    <a href="{{ route('checkout.index') }}" class="w-full y2k-btn-primary text-xs sm:text-sm !py-3.5 shadow-lg shadow-sky-200">
                        Lanjut ke Checkout ✦
                    </a>

                    <div class="text-center pt-1">
                        <a href="{{ route('shop.index') }}" class="text-xs font-bold text-slate-500 hover:text-sky-600">
                            ← Tambah Produk Lainnya
                        </a>
                    </div>
                </div>
            </div>
        </div>
    @else
        <!-- Empty Cart State -->
        <div class="max-w-md mx-auto my-12 text-center y2k-glass rounded-3xl p-8 sm:p-12 border-2 border-white/90 shadow-2xl space-y-4">
            <span class="text-6xl inline-block animate-float-slow">🫧</span>
            <h2 class="font-display font-black text-xl sm:text-2xl text-slate-900 tracking-tight">
                Your cart feels lonely :(
            </h2>
            <p class="text-xs sm:text-sm text-slate-500 font-medium leading-relaxed">
                Let's find something cute for your space ✦ Masukkan furniture atau dekorasi favoritmu untuk mulai makeover kamarmu!
            </p>
            <div class="pt-4">
                <a href="{{ route('shop.index') }}" class="y2k-btn-pink text-xs !py-3 !px-6">
                    Explore Products ✦
                </a>
            </div>
        </div>
    @endif
</div>
@endsection
