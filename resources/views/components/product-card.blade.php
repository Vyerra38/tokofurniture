@props(['product'])

<div class="y2k-glass rounded-3xl p-4 flex flex-col justify-between y2k-card-hover group border border-white/80 transition-all duration-300 relative overflow-hidden">
    <!-- Star/Sparkle accent on hover -->
    <div class="absolute -top-6 -right-6 w-16 h-16 bg-gradient-to-br from-pink-300/40 to-sky-300/40 rounded-full blur-xl group-hover:scale-150 transition-transform pointer-events-none"></div>

    <div>
        <!-- Image Container with Badge -->
        <div class="relative aspect-square w-full rounded-2xl bg-gradient-to-tr from-sky-50 via-slate-50 to-pink-50 p-3 flex items-center justify-center overflow-hidden mb-3.5 border border-white/60 shadow-inner">
            <img src="{{ $product->image_url }}" alt="{{ $product->name }}" class="w-full h-full object-contain group-hover:scale-105 transition-transform duration-300">
            
            <!-- Category Badge -->
            <span class="absolute top-2.5 left-2.5 bg-white/90 backdrop-blur-md text-[11px] font-bold text-slate-700 px-2.5 py-1 rounded-full border border-slate-200/60 shadow-xs">
                {{ $product->category->name }}
            </span>

            <!-- Stock status badge -->
            @if($product->stock <= 0)
                <span class="absolute top-2.5 right-2.5 bg-rose-500/90 text-white text-[10px] font-extrabold px-2 py-0.5 rounded-full shadow-sm">
                    Out of Stock
                </span>
            @elseif($product->stock <= 5)
                <span class="absolute top-2.5 right-2.5 bg-amber-500/90 text-white text-[10px] font-extrabold px-2 py-0.5 rounded-full shadow-sm">
                    Sisa {{ $product->stock }}!
                </span>
            @endif
        </div>

        <!-- Product Title -->
        <h3 class="font-bold text-sm text-slate-800 line-clamp-1 group-hover:text-sky-600 transition-colors">
            <a href="{{ route('shop.show', $product->slug) }}">
                {{ $product->name }}
            </a>
        </h3>

        <!-- Product Price -->
        <div class="mt-1 flex items-baseline justify-between">
            <span class="font-display font-extrabold text-base text-slate-900 tracking-tight">
                {{ $product->formatted_price }}
            </span>
            <span class="text-[11px] text-slate-400 font-medium">
                Stok: {{ $product->stock }}
            </span>
        </div>
    </div>

    <!-- Actions -->
    <div class="mt-4 pt-3 border-t border-slate-100 flex items-center gap-2">
        <a href="{{ route('shop.show', $product->slug) }}" class="flex-1 text-center py-2 px-3 rounded-full bg-slate-100 hover:bg-slate-200 text-slate-700 font-bold text-xs transition-colors" title="Lihat Rincian">
            Detail
        </a>

        @if($product->stock > 0)
            <form action="{{ route('cart.add', $product) }}" method="POST" class="shrink-0">
                @csrf
                <button type="submit" class="p-2 rounded-full bg-gradient-to-r from-sky-400 to-blue-500 hover:from-sky-500 hover:to-blue-600 text-white shadow-md shadow-sky-200 hover:shadow-lg transition-all active:scale-95 flex items-center justify-center" title="Tambah ke Keranjang">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 4v16m8-8H4"></path></svg>
                </button>
            </form>
        @else
            <button disabled class="p-2 rounded-full bg-slate-200 text-slate-400 cursor-not-allowed" title="Stok Habis">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
            </button>
        @endif
    </div>
</div>
