@extends('layouts.admin')

@section('title', 'Admin Dashboard')
@section('page-title', 'Overview Toko 📊')

@section('content')
<div class="space-y-8">
    <!-- Stat Cards Grid -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-6 gap-4">
        <!-- Card 1: Total Produk -->
        <div class="bg-white p-5 rounded-3xl border border-slate-200/80 shadow-xs flex items-center justify-between">
            <div>
                <p class="text-xs text-slate-500 font-semibold uppercase tracking-wider">Total Produk</p>
                <h3 class="font-display font-black text-2xl text-slate-900 mt-1">{{ $totalProducts }}</h3>
                <span class="text-[10px] text-sky-600 font-bold">{{ $totalCategories }} Kategori</span>
            </div>
            <div class="w-12 h-12 rounded-2xl bg-sky-50 text-sky-600 flex items-center justify-center text-xl">
                📦
            </div>
        </div>

        <!-- Card 2: Total Customer -->
        <div class="bg-white p-5 rounded-3xl border border-slate-200/80 shadow-xs flex items-center justify-between">
            <div>
                <p class="text-xs text-slate-500 font-semibold uppercase tracking-wider">Customer</p>
                <h3 class="font-display font-black text-2xl text-slate-900 mt-1">{{ $totalCustomers }}</h3>
                <span class="text-[10px] text-pink-600 font-bold">Terdaftar</span>
            </div>
            <div class="w-12 h-12 rounded-2xl bg-pink-50 text-pink-600 flex items-center justify-center text-xl">
                👥
            </div>
        </div>

        <!-- Card 3: Pesanan Hari Ini -->
        <div class="bg-white p-5 rounded-3xl border border-slate-200/80 shadow-xs flex items-center justify-between">
            <div>
                <p class="text-xs text-slate-500 font-semibold uppercase tracking-wider">Hari Ini</p>
                <h3 class="font-display font-black text-2xl text-slate-900 mt-1">{{ $todayOrdersCount }}</h3>
                <span class="text-[10px] text-purple-600 font-bold">Pesanan Masuk</span>
            </div>
            <div class="w-12 h-12 rounded-2xl bg-purple-50 text-purple-600 flex items-center justify-center text-xl">
                ⚡
            </div>
        </div>

        <!-- Card 4: Total Pesanan -->
        <div class="bg-white p-5 rounded-3xl border border-slate-200/80 shadow-xs flex items-center justify-between">
            <div>
                <p class="text-xs text-slate-500 font-semibold uppercase tracking-wider">Total Order</p>
                <h3 class="font-display font-black text-2xl text-slate-900 mt-1">{{ $totalOrdersCount }}</h3>
                <span class="text-[10px] text-emerald-600 font-bold">Semua Riwayat</span>
            </div>
            <div class="w-12 h-12 rounded-2xl bg-emerald-50 text-emerald-600 flex items-center justify-center text-xl">
                🛍️
            </div>
        </div>

        <!-- Card 5: Pendapatan -->
        <div class="bg-white p-5 rounded-3xl border border-slate-200/80 shadow-xs flex items-center justify-between">
            <div>
                <p class="text-xs text-slate-500 font-semibold uppercase tracking-wider">Pendapatan</p>
                <h3 class="font-display font-black text-base text-slate-900 mt-1 truncate" title="{{ format_rupiah($totalRevenue) }}">
                    {{ format_rupiah($totalRevenue) }}
                </h3>
                <span class="text-[10px] text-indigo-600 font-bold">Total Penjualan</span>
            </div>
            <div class="w-12 h-12 rounded-2xl bg-indigo-50 text-indigo-600 flex items-center justify-center text-xl">
                💰
            </div>
        </div>

        <!-- Card 6: Stok Rendah -->
        <div class="bg-white p-5 rounded-3xl border border-slate-200/80 shadow-xs flex items-center justify-between">
            <div>
                <p class="text-xs text-slate-500 font-semibold uppercase tracking-wider">Stok Menipis</p>
                <h3 class="font-display font-black text-2xl {{ $lowStockProducts->count() > 0 ? 'text-rose-600' : 'text-slate-900' }} mt-1">
                    {{ $lowStockProducts->count() }}
                </h3>
                <span class="text-[10px] text-rose-500 font-bold">Perlu Restock</span>
            </div>
            <div class="w-12 h-12 rounded-2xl bg-rose-50 text-rose-600 flex items-center justify-center text-xl">
                ⚠️
            </div>
        </div>
    </div>

    <!-- Tables Row: Recent Orders & Stock Alert -->
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-8">
        <!-- Recent Orders (8 cols) -->
        <div class="lg:col-span-8 bg-white rounded-3xl p-6 border border-slate-200/80 shadow-xs space-y-4">
            <div class="flex items-center justify-between pb-3 border-b border-slate-100">
                <div>
                    <h3 class="font-display font-bold text-base text-slate-900">Pesanan Terbaru 🛍️</h3>
                    <p class="text-xs text-slate-400">Daftar transaksi yang baru masuk ke sistem</p>
                </div>
                <a href="{{ route('admin.orders.index') }}" class="text-xs font-bold text-sky-600 hover:underline">
                    Lihat Semua →
                </a>
            </div>

            @if($recentOrders->count() > 0)
                <div class="overflow-x-auto">
                    <table class="w-full text-left text-xs">
                        <thead>
                            <tr class="text-slate-400 uppercase tracking-wider border-b border-slate-100">
                                <th class="pb-3 font-bold">No. Order</th>
                                <th class="pb-3 font-bold">Customer</th>
                                <th class="pb-3 font-bold">Total</th>
                                <th class="pb-3 font-bold">Status</th>
                                <th class="pb-3 font-bold text-right">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-100 font-medium text-slate-700">
                            @foreach($recentOrders as $order)
                                <tr class="hover:bg-slate-50/80 transition-colors">
                                    <td class="py-3 font-bold text-slate-900">
                                        #{{ $order->order_number }}
                                        <span class="block text-[10px] font-normal text-slate-400">{{ $order->created_at->diffForHumans() }}</span>
                                    </td>
                                    <td class="py-3">
                                        {{ $order->recipient_name }}
                                        <span class="block text-[10px] text-slate-400">{{ $order->phone }}</span>
                                    </td>
                                    <td class="py-3 font-display font-bold text-slate-900">
                                        {{ $order->formatted_total }}
                                    </td>
                                    <td class="py-3">
                                        <span class="px-2.5 py-0.5 rounded-full text-[10px] font-bold border {{ $order->status_badge_class }}">
                                            {{ $order->status }}
                                        </span>
                                    </td>
                                    <td class="py-3 text-right">
                                        <a href="{{ route('admin.orders.show', $order) }}" class="px-3 py-1 bg-slate-100 hover:bg-sky-100 text-slate-700 hover:text-sky-700 font-bold rounded-full text-[11px] transition-colors">
                                            Kelola
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <p class="text-xs text-slate-400 text-center py-8">Belum ada pesanan terbaru.</p>
            @endif
        </div>

        <!-- Low Stock Alert / Popular Products (4 cols) -->
        <div class="lg:col-span-4 bg-white rounded-3xl p-6 border border-slate-200/80 shadow-xs space-y-4">
            <div class="pb-3 border-b border-slate-100">
                <h3 class="font-display font-bold text-base text-slate-900">Peringatan Stok ⚠️</h3>
                <p class="text-xs text-slate-400">Produk dengan stok tersisa paling sedikit</p>
            </div>

            <div class="space-y-3">
                @foreach($popularProducts as $prod)
                    <div class="flex items-center justify-between gap-3 p-3 bg-slate-50/70 rounded-2xl border border-slate-100">
                        <div class="flex items-center gap-2.5 min-w-0">
                            <div class="w-10 h-10 rounded-xl bg-white p-1 border border-slate-200 shrink-0 flex items-center justify-center">
                                <img src="{{ $prod->image_url }}" alt="{{ $prod->name }}" class="w-full h-full object-contain">
                            </div>
                            <div class="truncate">
                                <p class="text-xs font-bold text-slate-800 truncate">{{ $prod->name }}</p>
                                <p class="text-[10px] text-slate-400">{{ $prod->category->name }}</p>
                            </div>
                        </div>

                        <span class="px-2.5 py-1 rounded-full text-xs font-black shrink-0 {{ $prod->stock <= 5 ? 'bg-rose-100 text-rose-700' : 'bg-sky-100 text-sky-700' }}">
                            {{ $prod->stock }} pcs
                        </span>
                    </div>
                @endforeach
            </div>

            <div class="pt-2">
                <a href="{{ route('admin.products.create') }}" class="w-full y2k-btn-secondary text-xs !py-2.5 text-center">
                    + Tambah Stok / Produk Baru
                </a>
            </div>
        </div>
    </div>
</div>
@endsection
