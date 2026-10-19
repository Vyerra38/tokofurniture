@extends('layouts.app')

@section('title', 'Pesanan Saya — AuraSpace ✦')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <!-- Breadcrumb -->
    <div class="flex items-center gap-2 text-xs font-semibold text-slate-400 mb-6">
        <a href="{{ route('home') }}" class="hover:text-sky-600">Home</a>
        <span>/</span>
        <span class="text-slate-700">Pesanan Saya</span>
    </div>

    <div class="mb-8">
        <span class="text-xs font-extrabold text-sky-600 tracking-wider uppercase">✦ ORDER HISTORY</span>
        <h1 class="font-display font-black text-3xl sm:text-4xl text-slate-900 tracking-tight mt-1">
            Riwayat Pesanan Saya 🛍️
        </h1>
        <p class="text-xs sm:text-sm text-slate-500 mt-1">Pantau status pesanan dan rincian transaksi belanjaan kamu</p>
    </div>

    @if($orders->count() > 0)
        <div class="space-y-4">
            @foreach($orders as $order)
                <div class="y2k-glass rounded-3xl p-5 sm:p-6 border border-white/80 shadow-md transition-all hover:shadow-lg space-y-4">
                    <!-- Order Top Row: Number, Date, Status -->
                    <div class="flex flex-wrap items-center justify-between gap-3 pb-4 border-b border-slate-100">
                        <div class="flex items-center gap-3">
                            <span class="w-9 h-9 rounded-xl bg-gradient-to-tr from-sky-100 to-pink-100 flex items-center justify-center text-sm font-bold shadow-xs">
                                📦
                            </span>
                            <div>
                                <h3 class="font-bold text-sm text-slate-900">#{{ $order->order_number }}</h3>
                                <p class="text-[11px] text-slate-400 font-medium">{{ $order->created_at->format('d M Y, H:i') }} WIB</p>
                            </div>
                        </div>

                        <!-- Status Badge -->
                        <div class="flex items-center gap-2">
                            <span class="px-3 py-1 rounded-full text-xs font-extrabold border {{ $order->status_badge_class }}">
                                {{ $order->status }}
                            </span>
                        </div>
                    </div>

                    <!-- Items Preview snippet -->
                    <div class="space-y-2">
                        @foreach($order->items->take(2) as $item)
                            <div class="flex items-center justify-between text-xs">
                                <span class="font-semibold text-slate-700 truncate max-w-md">
                                    {{ $item->product_name }} <span class="text-slate-400">× {{ $item->quantity }}</span>
                                </span>
                                <span class="font-bold text-slate-900">{{ $item->formatted_subtotal }}</span>
                            </div>
                        @endforeach

                        @if($order->items->count() > 2)
                            <p class="text-[11px] text-slate-400 italic font-medium">+ {{ $order->items->count() - 2 }} produk lainnya</p>
                        @endif
                    </div>

                    <!-- Bottom row: Total & Detail Button -->
                    <div class="flex items-center justify-between pt-3 border-t border-slate-100">
                        <div>
                            <span class="text-[10px] text-slate-400 uppercase font-semibold block">Total Pesanan</span>
                            <span class="font-display font-black text-base text-slate-900">{{ $order->formatted_total }}</span>
                        </div>

                        <div class="flex items-center gap-2">
                            <a href="{{ route('orders.show', $order->order_number) }}" class="y2k-btn-secondary text-xs !py-2 !px-4">
                                Rincian Pesanan →
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <div class="mt-8">
            {{ $orders->links() }}
        </div>
    @else
        <!-- Empty Orders State -->
        <div class="max-w-md mx-auto my-12 text-center y2k-glass rounded-3xl p-8 sm:p-12 border-2 border-white/90 shadow-2xl space-y-4">
            <span class="text-6xl inline-block animate-float-slow">✦</span>
            <h2 class="font-display font-black text-xl sm:text-2xl text-slate-900 tracking-tight">
                No orders yet ✦
            </h2>
            <p class="text-xs sm:text-sm text-slate-500 font-medium leading-relaxed">
                Kamu belum pernah membuat pesanan di AuraSpace. Yuk temukan dekorasi aesthetic impianmu sekarang!
            </p>
            <div class="pt-4">
                <a href="{{ route('shop.index') }}" class="y2k-btn-primary text-xs !py-3 !px-6">
                    Start Shopping ✦
                </a>
            </div>
        </div>
    @endif
</div>
@endsection
