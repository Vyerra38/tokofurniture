@extends('layouts.admin')

@section('title', 'Kelola Pesanan #' . $order->order_number)
@section('page-title', 'Rincian Pesanan #' . $order->order_number . ' 🛍️')

@section('content')
<div class="space-y-6 max-w-6xl mx-auto">
    <div class="flex items-center gap-2 text-xs font-semibold text-slate-400">
        <a href="{{ route('admin.orders.index') }}" class="hover:text-sky-600">Manajemen Pesanan</a>
        <span>/</span>
        <span class="text-slate-700">#{{ $order->order_number }}</span>
    </div>

    <!-- Status Change Action Card -->
    <div class="bg-white p-6 rounded-3xl border border-slate-200/80 shadow-xs space-y-4">
        <div class="flex flex-col sm:flex-row sm:items-center justify-between pb-3 border-b border-slate-100 gap-2">
            <div>
                <h3 class="font-display font-bold text-base text-slate-900">Perbarui Status Transaksi ✦</h3>
                <p class="text-xs text-slate-400">Ubah status pesanan dan konfirmasi pembayaran dari customer</p>
            </div>
            <span class="px-3 py-1 rounded-full text-xs font-extrabold border {{ $order->status_badge_class }}">
                Status Saat Ini: {{ $order->status }}
            </span>
        </div>

        <form action="{{ route('admin.orders.status', $order) }}" method="POST" class="grid grid-cols-1 sm:grid-cols-12 gap-4 items-end">
            @csrf
            @method('PUT')

            <!-- Order Status -->
            <div class="sm:col-span-5">
                <label for="status" class="block text-xs font-bold text-slate-700 mb-1">Status Pesanan</label>
                <select id="status" name="status" class="w-full bg-slate-50 border border-slate-200 focus:border-sky-400 rounded-2xl px-4 py-2.5 text-xs font-medium focus:outline-none">
                    @foreach(['Menunggu Pembayaran', 'Diproses', 'Dikemas', 'Dikirim', 'Selesai', 'Dibatalkan'] as $st)
                        <option value="{{ $st }}" {{ $order->status === $st ? 'selected' : '' }}>
                            {{ $st }}
                        </option>
                    @endforeach
                </select>
            </div>

            <!-- Payment Status -->
            <div class="sm:col-span-4">
                <label for="payment_status" class="block text-xs font-bold text-slate-700 mb-1">Status Pembayaran</label>
                <select id="payment_status" name="payment_status" class="w-full bg-slate-50 border border-slate-200 focus:border-sky-400 rounded-2xl px-4 py-2.5 text-xs font-medium focus:outline-none">
                    <option value="unpaid" {{ ($order->payment->payment_status ?? '') === 'unpaid' ? 'selected' : '' }}>Unpaid (Belum Bayar)</option>
                    <option value="pending" {{ ($order->payment->payment_status ?? '') === 'pending' ? 'selected' : '' }}>Pending (Menunggu Konfirmasi)</option>
                    <option value="paid" {{ ($order->payment->payment_status ?? '') === 'paid' ? 'selected' : '' }}>Paid (Lunas)</option>
                    <option value="failed" {{ ($order->payment->payment_status ?? '') === 'failed' ? 'selected' : '' }}>Failed (Gagal / Batal)</option>
                </select>
            </div>

            <!-- Submit -->
            <div class="sm:col-span-3">
                <button type="submit" class="w-full y2k-btn-primary text-xs !py-2.5 font-bold shadow-md">
                    Simpan Perubahan ✦
                </button>
            </div>
        </form>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-12 gap-6 items-start">
        <!-- Ordered Items (8 cols) -->
        <div class="lg:col-span-8 bg-white p-6 rounded-3xl border border-slate-200/80 shadow-xs space-y-4">
            <h3 class="font-display font-bold text-base text-slate-900 flex items-center gap-2">
                <span>📦</span>
                <span>Barang yang Dipesan</span>
            </h3>

            <div class="divide-y divide-slate-100">
                @foreach($order->items as $item)
                    <div class="py-4 first:pt-2 last:pb-0 flex items-center justify-between gap-4">
                        <div class="flex items-center gap-3.5 min-w-0">
                            @if($item->product)
                                <div class="w-12 h-12 rounded-xl bg-slate-50 p-1 shrink-0 border border-slate-200 flex items-center justify-center">
                                    <img src="{{ $item->product->image_url }}" alt="{{ $item->product_name }}" class="w-full h-full object-contain">
                                </div>
                            @else
                                <div class="w-12 h-12 rounded-xl bg-slate-100 flex items-center justify-center text-lg shrink-0">
                                    📦
                                </div>
                            @endif
                            <div class="truncate">
                                <h4 class="font-bold text-xs sm:text-sm text-slate-900 truncate">{{ $item->product_name }}</h4>
                                <p class="text-[11px] text-slate-400">{{ $item->quantity }} pcs × {{ $item->formatted_price }}</p>
                            </div>
                        </div>
                        <span class="font-display font-bold text-xs sm:text-sm text-slate-900 shrink-0">
                            {{ $item->formatted_subtotal }}
                        </span>
                    </div>
                @endforeach
            </div>

            <!-- Breakdown -->
            <div class="pt-4 border-t border-slate-100 space-y-2 text-xs font-semibold text-slate-600">
                <div class="flex items-center justify-between">
                    <span>Subtotal Produk</span>
                    <span class="text-slate-900 font-bold">{{ $order->formatted_subtotal }}</span>
                </div>
                <div class="flex items-center justify-between">
                    <span>Ongkos Kirim</span>
                    <span class="text-slate-900 font-bold">{{ $order->formatted_shipping_cost }}</span>
                </div>
                <hr class="border-slate-100 my-2">
                <div class="flex items-center justify-between text-base">
                    <span class="font-bold text-slate-900">Total Transaksi</span>
                    <span class="font-display font-black text-sky-700">{{ $order->formatted_total }}</span>
                </div>
            </div>
        </div>

        <!-- Customer & Delivery Details (4 cols) -->
        <div class="lg:col-span-4 space-y-6">
            <!-- Shipping Card -->
            <div class="bg-white p-6 rounded-3xl border border-slate-200/80 shadow-xs space-y-3">
                <h3 class="font-display font-bold text-sm text-slate-900 flex items-center gap-2 pb-2 border-b border-slate-100">
                    <span>📍</span>
                    <span>Tujuan Pengiriman</span>
                </h3>

                <div class="text-xs space-y-2 text-slate-700">
                    <div>
                        <span class="text-[10px] text-slate-400 uppercase font-bold block">Penerima</span>
                        <p class="font-bold text-sm text-slate-900">{{ $order->recipient_name }}</p>
                        <p class="text-slate-500 font-mono">{{ $order->phone }}</p>
                    </div>

                    <div>
                        <span class="text-[10px] text-slate-400 uppercase font-bold block">Alamat Lengkap</span>
                        <p class="leading-relaxed">{{ $order->address }}</p>
                        <p class="text-slate-500 font-medium">{{ $order->city }} (Kode Pos: {{ $order->postal_code }})</p>
                    </div>

                    @if($order->notes)
                        <div class="p-2.5 bg-slate-50 rounded-xl border border-slate-100">
                            <span class="text-[10px] text-slate-400 uppercase font-bold block">Catatan Pembeli</span>
                            <p class="italic text-[11px] text-slate-600">{{ $order->notes }}</p>
                        </div>
                    @endif
                </div>
            </div>

            <!-- Customer Account Info -->
            <div class="bg-white p-6 rounded-3xl border border-slate-200/80 shadow-xs space-y-3">
                <h3 class="font-display font-bold text-sm text-slate-900 flex items-center gap-2 pb-2 border-b border-slate-100">
                    <span>👤</span>
                    <span>Akun Pemesan</span>
                </h3>

                <div class="text-xs space-y-1.5 text-slate-700">
                    <p><span class="text-slate-400">Nama:</span> <strong class="text-slate-900">{{ $order->user->name }}</strong></p>
                    <p><span class="text-slate-400">Email:</span> {{ $order->user->email }}</p>
                    <p><span class="text-slate-400">Waktu Order:</span> {{ $order->created_at->format('d/m/Y H:i:s') }}</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
