@extends('layouts.admin')

@section('title', 'Manajemen Produk')
@section('page-title', 'Katalog Produk 📦')

@section('content')
<div class="space-y-6">
    <!-- Header Action Bar -->
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 bg-white p-5 rounded-3xl border border-slate-200/80 shadow-xs">
        <div>
            <h3 class="font-display font-bold text-base text-slate-900">Semua Produk</h3>
            <p class="text-xs text-slate-400">Total terdaftar: {{ $products->total() }} produk</p>
        </div>

        <a href="{{ route('admin.products.create') }}" class="y2k-btn-primary text-xs !py-2.5 !px-5 self-start sm:self-auto font-bold shadow-md">
            + Tambah Produk Baru ✦
        </a>
    </div>

    <!-- Filter Bar -->
    <div class="bg-white p-5 rounded-3xl border border-slate-200/80 shadow-xs">
        <form action="{{ route('admin.products.index') }}" method="GET" class="grid grid-cols-1 sm:grid-cols-12 gap-3 items-center">
            <!-- Search -->
            <div class="sm:col-span-6 relative">
                <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari nama produk..." class="w-full bg-slate-50 border border-slate-200 focus:border-sky-400 rounded-full pl-9 pr-4 py-2 text-xs font-medium focus:outline-none">
                <svg class="w-4 h-4 text-slate-400 absolute left-3 top-2.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
            </div>

            <!-- Category -->
            <div class="sm:col-span-4">
                <select name="category_id" class="w-full bg-slate-50 border border-slate-200 focus:border-sky-400 rounded-full px-4 py-2 text-xs font-medium focus:outline-none">
                    <option value="">Semua Kategori</option>
                    @foreach($categories as $cat)
                        <option value="{{ $cat->id }}" {{ request('category_id') == $cat->id ? 'selected' : '' }}>
                            {{ $cat->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <!-- Submit -->
            <div class="sm:col-span-2 flex items-center gap-2">
                <button type="submit" class="w-full y2k-btn-secondary text-xs !py-2 text-center font-bold">
                    Filter
                </button>
                @if(request()->anyFilled(['search', 'category_id']))
                    <a href="{{ route('admin.products.index') }}" class="p-2 text-slate-400 hover:text-rose-500 text-xs" title="Reset">✕</a>
                @endif
            </div>
        </form>
    </div>

    <!-- Products Table -->
    <div class="bg-white rounded-3xl p-6 border border-slate-200/80 shadow-xs">
        @if($products->count() > 0)
            <div class="overflow-x-auto">
                <table class="w-full text-left text-xs">
                    <thead>
                        <tr class="text-slate-400 uppercase tracking-wider border-b border-slate-100">
                            <th class="pb-3 font-bold">Foto</th>
                            <th class="pb-3 font-bold">Nama Produk</th>
                            <th class="pb-3 font-bold">Kategori</th>
                            <th class="pb-3 font-bold">Harga</th>
                            <th class="pb-3 font-bold">Stok</th>
                            <th class="pb-3 font-bold">Status</th>
                            <th class="pb-3 font-bold text-right">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100 font-medium text-slate-700">
                        @foreach($products as $product)
                            <tr class="hover:bg-slate-50/80 transition-colors">
                                <!-- Photo -->
                                <td class="py-3 w-14">
                                    <div class="w-12 h-12 rounded-xl bg-slate-100 border border-slate-200 p-1 flex items-center justify-center shrink-0">
                                        <img src="{{ $product->image_url }}" alt="{{ $product->name }}" class="w-full h-full object-contain">
                                    </div>
                                </td>

                                <!-- Name -->
                                <td class="py-3 font-bold text-slate-900 max-w-xs">
                                    <span class="truncate block">{{ $product->name }}</span>
                                    <span class="text-[10px] text-slate-400 font-normal">Slug: {{ $product->slug }}</span>
                                </td>

                                <!-- Category -->
                                <td class="py-3">
                                    <span class="px-2.5 py-0.5 rounded-full text-[10px] font-bold bg-sky-50 text-sky-700 border border-sky-100">
                                        {{ $product->category->name }}
                                    </span>
                                </td>

                                <!-- Price -->
                                <td class="py-3 font-display font-bold text-slate-900">
                                    {{ $product->formatted_price }}
                                </td>

                                <!-- Stock -->
                                <td class="py-3">
                                    <span class="px-2.5 py-0.5 rounded-full text-[10px] font-bold {{ $product->stock <= 5 ? 'bg-rose-100 text-rose-700' : 'bg-emerald-100 text-emerald-700' }}">
                                        {{ $product->stock }} pcs
                                    </span>
                                </td>

                                <!-- Status -->
                                <td class="py-3">
                                    <div class="flex items-center gap-1.5">
                                        @if($product->is_featured)
                                            <span class="px-2 py-0.5 rounded-full text-[10px] font-bold bg-pink-100 text-pink-700">✦ Featured</span>
                                        @endif
                                        @if($product->is_active)
                                            <span class="px-2 py-0.5 rounded-full text-[10px] font-bold bg-emerald-50 text-emerald-600">Aktif</span>
                                        @else
                                            <span class="px-2 py-0.5 rounded-full text-[10px] font-bold bg-slate-100 text-slate-500">Nonaktif</span>
                                        @endif
                                    </div>
                                </td>

                                <!-- Actions -->
                                <td class="py-3 text-right">
                                    <div class="flex items-center justify-end gap-2">
                                        <a href="{{ route('admin.products.edit', $product) }}" class="p-1.5 text-slate-500 hover:text-sky-600 rounded-lg hover:bg-sky-50 transition-colors" title="Edit">
                                            ✏️
                                        </a>

                                        <form action="{{ route('admin.products.destroy', $product) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus produk {{ $product->name }}?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="p-1.5 text-slate-500 hover:text-rose-600 rounded-lg hover:bg-rose-50 transition-colors" title="Hapus">
                                                🗑️
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="mt-4">
                {{ $products->links() }}
            </div>
        @else
            <p class="text-xs text-slate-400 text-center py-10">Belum ada data produk yang cocok dengan pencarian.</p>
        @endif
    </div>
</div>
@endsection
