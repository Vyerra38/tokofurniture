@extends('layouts.admin')

@section('title', 'Manajemen Pesanan')
@section('page-title', 'Manajemen Pesanan 🛍️')

@section('content')
<div class="space-y-6">
    <!-- Filter and Search Bar -->
    <div class="bg-white p-5 rounded-3xl border border-slate-200/80 shadow-xs">
        <form action="{{ route('admin.orders.index') }}" method="GET" class="grid grid-cols-1 sm:grid-cols-12 gap-3 items-center">
            <!-- Search -->
            <div class="sm:col-span-6 relative">
                <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari No. Order, nama penerima, no HP..." class="w-full bg-slate-50 border border-slate-200 focus:border-sky-400 rounded-full pl-9 pr-4 py-2 text-xs font-medium focus:outline-none">
                <svg class="w-4 h-4 text-slate-400 absolute left-3 top-2.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
            </div>

            <!-- Status Filter -->
            <div class="sm:col-span-4">
                <select name="status" class="w-full bg-slate-50 border border-slate-200 focus:border-sky-400 rounded-full px-4 py-2 text-xs font-medium focus:outline-none">
                    <option value="">Semua Status Pesanan</option>
                    @foreach(['Menunggu Pembayaran', 'Diproses', 'Dikemas', 'Dikirim', 'Selesai', 'Dibatalkan'] as $st)
                        <option value="{{ $st }}" {{ request('status') === $st ? 'selected' : '' }}>
                            {{ $st }}
                        </option>
                    @endforeach
                </select>
            </div>

            <!-- Submit -->
            <div class="sm:col-span-2 flex items-center gap-2">
                <button type="submit" class="w-full y2k-btn-secondary text-xs !py-2 text-center font-bold">
                    Filter
                </button>
                @if(request()->anyFilled(['search', 'status']))
                    <a href="{{ route('admin.orders.index') }}" class="p-2 text-slate-400 hover:text-rose-500 text-xs" title="Reset">✕</a>
                @endif
            </div>
        </form>
    </div>

    <!-- Orders Table -->
    <div class="bg-white rounded-3xl p-6 border border-slate-200/80 shadow-xs space-y-4">
        <div class="flex items-center justify-between pb-3 border-b border-slate-100">
            <h3 class="font-display font-bold text-base text-slate-900">Daftar Semua Pesanan</h3>
            <span class="text-xs font-bold text-slate-500">{{ $orders->total() }} Pesanan Ditemukan</span>
        </div>

        @if($orders->count() > 0)
            <div class="overflow-x-auto">
                <table class="w-full text-left text-xs">
                    <thead>
                        <tr class="text-slate-400 uppercase tracking-wider border-b border-slate-100">
                            <th class="pb-3 font-bold">No. Order</th>
                            <th class="pb-3 font-bold">Customer / Penerima</th>
                            <th class="pb-3 font-bold">Metode Bayar</th>
                            <th class="pb-3 font-bold">Total Nilai</th>
                            <th class="pb-3 font-bold">Status Pesanan</th>
                            <th class="pb-3 font-bold text-right">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100 font-medium text-slate-700">
                        @foreach($orders as $order)
                            <tr class="hover:bg-slate-50/80 transition-colors">
                                <td class="py-3 font-bold text-slate-900">
                                    #{{ $order->order_number }}
                                    <span class="block text-[10px] font-normal text-slate-400">{{ $order->created_at->format('d/m/Y H:i') }}</span>
                                </td>

                                <td class="py-3">
                                    <span class="font-bold text-slate-900 block">{{ $order->recipient_name }}</span>
                                    <span class="text-[10px] text-slate-400">{{ $order->phone }} • {{ $order->city }}</span>
                                </td>

                                <td class="py-3">
                                    <span class="font-semibold block">{{ $order->payment->payment_method ?? 'Transfer Bank' }}</span>
                                    <span class="inline-block px-2 py-0.5 rounded-full text-[9px] font-bold border {{ $order->payment->status_badge_class ?? '' }}">
                                        {{ strtoupper($order->payment->payment_status ?? 'unpaid') }}
                                    </span>
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
                                    <a href="{{ route('admin.orders.show', $order) }}" class="px-3.5 py-1.5 bg-sky-50 hover:bg-sky-100 text-sky-700 font-bold rounded-full text-[11px] transition-colors inline-block">
                                        Rincian & Status →
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="mt-4">
                {{ $orders->links() }}
            </div>
        @else
            <p class="text-xs text-slate-400 text-center py-10">Belum ada pesanan yang sesuai filter.</p>
        @endif
    </div>
</div>
@endsection
