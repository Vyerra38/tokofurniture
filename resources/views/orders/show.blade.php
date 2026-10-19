@extends('layouts.app')

@section('title', 'Rincian Pesanan #' . $order->order_number . ' — AuraSpace ✦')

@section('content')
<div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <!-- Breadcrumb -->
    <div class="flex items-center gap-2 text-xs font-semibold text-slate-400 mb-6">
        <a href="{{ route('home') }}" class="hover:text-sky-600">Home</a>
        <span>/</span>
        <a href="{{ route('orders.index') }}" class="hover:text-sky-600">Pesanan Saya</a>
        <span>/</span>
        <span class="text-slate-700">#{{ $order->order_number }}</span>
    </div>

    <!-- Status Banner Card -->
    <div class="y2k-glass rounded-3xl p-6 sm:p-8 border-2 border-white/90 shadow-xl mb-8 flex flex-col sm:flex-row sm:items-center justify-between gap-4">
        <div>
            <div class="flex items-center gap-2 mb-1">
                <span class="text-xs font-bold text-slate-500 uppercase tracking-wider">Status Pesanan:</span>
                <span class="px-3 py-1 rounded-full text-xs font-extrabold border {{ $order->status_badge_class }}">
                    {{ $order->status }}
                </span>
            </div>
            <h1 class="font-display font-black text-2xl sm:text-3xl text-slate-900 tracking-tight">
                Pesanan #{{ $order->order_number }}
            </h1>
            <p class="text-xs text-slate-500 mt-1">Dipesan pada tanggal {{ $order->created_at->format('d F Y, H:i') }} WIB</p>
        </div>

        @if($order->status === 'Menunggu Pembayaran')
            <form action="{{ route('orders.cancel', $order->order_number) }}" method="POST" onsubmit="return confirm('Apakah kamu yakin ingin membatalkan pesanan ini? Stok produk akan dikembalikan.');">
                @csrf
                <button type="submit" class="px-4 py-2 rounded-full bg-rose-50 hover:bg-rose-100 text-rose-600 border border-rose-200 text-xs font-bold transition-colors">
                    Batalkan Pesanan
                </button>
            </form>
        @endif
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-start">
        <!-- Left: Items & Delivery Info -->
        <div class="lg:col-span-8 space-y-6">
            <!-- Items Card -->
            <div class="y2k-glass rounded-3xl p-6 sm:p-8 border border-white/80 shadow-md space-y-4">
                <h2 class="font-display font-bold text-base text-slate-900 flex items-center gap-2">
                    <span>🛍️</span>
                    <span>Rincian Produk yang Dipesan</span>
                </h2>

                <div class="divide-y divide-slate-100">
                    @foreach($order->items as $item)
                        <div class="py-4 first:pt-2 last:pb-0 flex items-center justify-between gap-4">
                            <div class="flex items-center gap-3.5 min-w-0">
                                @if($item->product)
                                    <div class="w-14 h-14 rounded-xl bg-gradient-to-tr from-sky-50 to-pink-50 p-1.5 shrink-0 border border-white flex items-center justify-center">
                                        <img src="{{ $item->product->image_url }}" alt="{{ $item->product_name }}" class="w-full h-full object-contain">
                                    </div>
                                @else
                                    <div class="w-14 h-14 rounded-xl bg-slate-100 flex items-center justify-center text-xl shrink-0">
                                        📦
                                    </div>
                                @endif
                                <div class="truncate">
                                    <h3 class="font-bold text-xs sm:text-sm text-slate-900 truncate">
                                        {{ $item->product_name }}
                                    </h3>
                                    <p class="text-[11px] text-slate-500 mt-0.5">
                                        {{ $item->quantity }} pcs × {{ $item->formatted_price }}
                                    </p>
                                </div>
                            </div>
                            <span class="font-display font-black text-sm text-slate-900 shrink-0">
                                {{ $item->formatted_subtotal }}
                            </span>
                        </div>
                    @endforeach
                </div>
            </div>

            <!-- Recipient & Delivery Info -->
            <div class="y2k-glass rounded-3xl p-6 sm:p-8 border border-white/80 shadow-md space-y-4">
                <h2 class="font-display font-bold text-base text-slate-900 flex items-center gap-2">
                    <span>📍</span>
                    <span>Tujuan Pengiriman</span>
                </h2>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 text-xs">
                    <div class="p-4 bg-white/70 rounded-2xl border border-white space-y-1">
                        <span class="text-[10px] text-slate-400 font-bold uppercase">Penerima</span>
                        <p class="font-bold text-slate-800 text-sm">{{ $order->recipient_name }}</p>
                        <p class="text-slate-600">{{ $order->phone }}</p>
                    </div>

                    <div class="p-4 bg-white/70 rounded-2xl border border-white space-y-1">
                        <span class="text-[10px] text-slate-400 font-bold uppercase">Kota & Kode Pos</span>
                        <p class="font-bold text-slate-800 text-sm">{{ $order->city }}</p>
                        <p class="text-slate-600">Kode Pos: {{ $order->postal_code }}</p>
                    </div>

                    <div class="sm:col-span-2 p-4 bg-white/70 rounded-2xl border border-white space-y-1">
                        <span class="text-[10px] text-slate-400 font-bold uppercase">Alamat Lengkap</span>
                        <p class="font-medium text-slate-700 leading-relaxed">{{ $order->address }}</p>
                        @if($order->notes)
                            <p class="text-[11px] text-slate-500 italic mt-2"><strong>Catatan:</strong> {{ $order->notes }}</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <!-- Right: Payment & Summary -->
        <div class="lg:col-span-4 space-y-6">
            <!-- Payment Instruction Card -->
            <div class="y2k-glass rounded-3xl p-6 border border-white/80 shadow-md space-y-4">
                <h2 class="font-display font-bold text-sm text-slate-900 flex items-center gap-2">
                    <span>💳</span>
                    <span>Metode Pembayaran</span>
                </h2>

                <div class="p-4 bg-white/80 rounded-2xl border border-white space-y-2">
                    <div class="flex items-center justify-between">
                        <span class="text-xs font-bold text-slate-800">{{ $order->payment->payment_method ?? 'Transfer Bank' }}</span>
                        <span class="text-[11px] font-bold px-2 py-0.5 rounded-full border {{ $order->payment->status_badge_class ?? '' }}">
                            {{ strtoupper($order->payment->payment_status ?? 'unpaid') }}
                        </span>
                    </div>

                    @if($order->payment && $order->payment->payment_method === 'Transfer Bank' && $order->payment->payment_status !== 'paid')
                        <div class="pt-3 border-t border-slate-100 text-[11px] text-slate-600 space-y-2">
                            <p class="font-semibold text-sky-900">✦ Rekening Transfer Resmi:</p>
                            <div class="bg-sky-50 p-3 rounded-xl border border-sky-100 font-mono text-xs text-sky-950">
                                <p class="text-[10px] text-sky-600 font-sans font-bold">BANK BCA</p>
                                <p class="font-bold text-sm">8820 1234 5678</p>
                                <p class="text-[10px] text-slate-500 font-sans">a.n. PT AuraSpace Estetika</p>
                            </div>
                            <p class="text-[10px] text-slate-400 leading-relaxed">
                                Mohon transfer tepat sesuai nominal. Pesanan akan otomatis diproses setelah admin memverifikasi pembayaran.
                            </p>
                        </div>
                    @elseif($order->payment && $order->payment->payment_method === 'COD')
                        <p class="text-[11px] text-slate-500 leading-relaxed pt-2">
                            ✦ Siapkan uang tunai sejumlah nominal total saat kurir tiba di alamat Anda.
                        </p>
                    @endif
                </div>
            </div>

            <!-- Total Breakdown Card -->
            <div class="y2k-glass rounded-3xl p-6 border-2 border-white/90 shadow-xl space-y-4">
                <h2 class="font-display font-black text-sm text-slate-900">
                    Ringkasan Transaksi
                </h2>

                <div class="space-y-2 text-xs font-semibold text-slate-600">
                    <div class="flex items-center justify-between">
                        <span>Subtotal Produk</span>
                        <span class="text-slate-900 font-bold">{{ $order->formatted_subtotal }}</span>
                    </div>
                    <div class="flex items-center justify-between">
                        <span>Ongkos Kirim</span>
                        @if($order->shipping_cost == 0)
                            <span class="text-emerald-600 font-bold uppercase">GRATIS ✦</span>
                        @else
                            <span class="text-slate-900 font-bold">{{ $order->formatted_shipping_cost }}</span>
                        @endif
                    </div>
                </div>

                <hr class="border-slate-100">

                <div class="flex items-baseline justify-between">
                    <span class="font-display font-black text-sm text-slate-900">Total Akhir</span>
                    <span class="font-display font-black text-xl text-sky-700">
                        {{ $order->formatted_total }}
                    </span>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
