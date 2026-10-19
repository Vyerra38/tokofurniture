@extends('layouts.admin')

@section('title', 'Daftar Pelanggan')
@section('page-title', 'Pelanggan Terdaftar 👥')

@section('content')
<div class="space-y-6">
    <!-- Search Bar -->
    <div class="bg-white p-5 rounded-3xl border border-slate-200/80 shadow-xs">
        <form action="{{ route('admin.customers.index') }}" method="GET" class="flex items-center gap-3">
            <div class="relative flex-1">
                <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari nama, email, nomor HP pelanggan..." class="w-full bg-slate-50 border border-slate-200 focus:border-sky-400 rounded-full pl-9 pr-4 py-2 text-xs font-medium focus:outline-none">
                <svg class="w-4 h-4 text-slate-400 absolute left-3 top-2.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
            </div>
            <button type="submit" class="y2k-btn-secondary text-xs !py-2 !px-5 font-bold">
                Cari
            </button>
            @if(request('search'))
                <a href="{{ route('admin.customers.index') }}" class="p-2 text-slate-400 hover:text-rose-500 text-xs" title="Reset">✕</a>
            @endif
        </form>
    </div>

    <!-- Customers Table -->
    <div class="bg-white rounded-3xl p-6 border border-slate-200/80 shadow-xs space-y-4">
        <div class="flex items-center justify-between pb-3 border-b border-slate-100">
            <h3 class="font-display font-bold text-base text-slate-900">Daftar Akun Customer</h3>
            <span class="text-xs font-bold text-slate-500">{{ $customers->total() }} Pelanggan</span>
        </div>

        @if($customers->count() > 0)
            <div class="overflow-x-auto">
                <table class="w-full text-left text-xs">
                    <thead>
                        <tr class="text-slate-400 uppercase tracking-wider border-b border-slate-100">
                            <th class="pb-3 font-bold">Nama Customer</th>
                            <th class="pb-3 font-bold">Kontak</th>
                            <th class="pb-3 font-bold">Alamat</th>
                            <th class="pb-3 font-bold">Total Transaksi</th>
                            <th class="pb-3 font-bold">Total Belanja</th>
                            <th class="pb-3 font-bold text-right">Bergabung</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100 font-medium text-slate-700">
                        @foreach($customers as $customer)
                            <tr class="hover:bg-slate-50/80 transition-colors">
                                <td class="py-3 font-bold text-slate-900">
                                    <div class="flex items-center gap-2.5">
                                        <div class="w-8 h-8 rounded-full bg-pink-100 text-pink-700 flex items-center justify-center font-bold text-xs shrink-0">
                                            {{ strtoupper(substr($customer->name, 0, 1)) }}
                                        </div>
                                        <span>{{ $customer->name }}</span>
                                    </div>
                                </td>

                                <td class="py-3">
                                    <span class="block">{{ $customer->email }}</span>
                                    <span class="text-[10px] text-slate-400">{{ $customer->phone ?? '-' }}</span>
                                </td>

                                <td class="py-3 max-w-xs truncate text-slate-500">
                                    {{ $customer->address ?? 'Belum ada alamat' }}
                                </td>

                                <td class="py-3">
                                    <span class="px-2.5 py-0.5 rounded-full text-[10px] font-bold bg-sky-100 text-sky-800">
                                        {{ $customer->orders_count }} Pesanan
                                    </span>
                                </td>

                                <td class="py-3 font-display font-bold text-slate-900">
                                    {{ format_rupiah($customer->total_spent ?? 0) }}
                                </td>

                                <td class="py-3 text-right text-slate-400 text-[11px]">
                                    {{ $customer->created_at->format('d/m/Y') }}
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="mt-4">
                {{ $customers->links() }}
            </div>
        @else
            <p class="text-xs text-slate-400 text-center py-10">Tidak ditemukan pelanggan yang sesuai.</p>
        @endif
    </div>
</div>
@endsection
