@extends('layouts.admin')

@section('title', 'Edit Produk — ' . $product->name)
@section('page-title', 'Edit Produk ✏️')

@section('content')
<div class="max-w-4xl mx-auto space-y-6">
    <div class="flex items-center gap-2 text-xs font-semibold text-slate-400">
        <a href="{{ route('admin.products.index') }}" class="hover:text-sky-600">Katalog Produk</a>
        <span>/</span>
        <span class="text-slate-700 truncate max-w-xs">Edit: {{ $product->name }}</span>
    </div>

    <div class="bg-white rounded-3xl p-6 sm:p-8 border border-slate-200/80 shadow-xs space-y-6">
        <div class="pb-4 border-b border-slate-100 flex items-center justify-between">
            <div>
                <h3 class="font-display font-bold text-lg text-slate-900">Perbarui Data Produk</h3>
                <p class="text-xs text-slate-400">Slug: {{ $product->slug }}</p>
            </div>
            <a href="{{ route('shop.show', $product->slug) }}" target="_blank" class="text-xs font-bold text-sky-600 hover:underline">
                Lihat di Toko ↗
            </a>
        </div>

        <form action="{{ route('admin.products.update', $product) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
            @csrf
            @method('PUT')

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                <!-- Category -->
                <div>
                    <label for="category_id" class="block text-xs font-bold text-slate-700 mb-1">Kategori Produk *</label>
                    <select id="category_id" name="category_id" required class="w-full bg-slate-50 border {{ $errors->has('category_id') ? 'border-rose-400' : 'border-slate-200' }} focus:border-sky-400 rounded-2xl px-4 py-2.5 text-xs font-medium focus:outline-none">
                        @foreach($categories as $cat)
                            <option value="{{ $cat->id }}" {{ old('category_id', $product->category_id) == $cat->id ? 'selected' : '' }}>
                                {{ $cat->name }}
                            </option>
                        @endforeach
                    </select>
                    @error('category_id')
                        <p class="text-[11px] text-rose-500 font-semibold mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Name -->
                <div>
                    <label for="name" class="block text-xs font-bold text-slate-700 mb-1">Nama Produk *</label>
                    <input type="text" id="name" name="name" value="{{ old('name', $product->name) }}" required class="w-full bg-slate-50 border {{ $errors->has('name') ? 'border-rose-400' : 'border-slate-200' }} focus:border-sky-400 rounded-2xl px-4 py-2.5 text-xs font-medium focus:outline-none">
                    @error('name')
                        <p class="text-[11px] text-rose-500 font-semibold mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                <!-- Price -->
                <div>
                    <label for="price" class="block text-xs font-bold text-slate-700 mb-1">Harga (Rupiah) *</label>
                    <input type="number" id="price" name="price" value="{{ old('price', (int)$product->price) }}" required min="0" class="w-full bg-slate-50 border {{ $errors->has('price') ? 'border-rose-400' : 'border-slate-200' }} focus:border-sky-400 rounded-2xl px-4 py-2.5 text-xs font-medium focus:outline-none">
                    @error('price')
                        <p class="text-[11px] text-rose-500 font-semibold mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Stock -->
                <div>
                    <label for="stock" class="block text-xs font-bold text-slate-700 mb-1">Stok (pcs) *</label>
                    <input type="number" id="stock" name="stock" value="{{ old('stock', $product->stock) }}" required min="0" class="w-full bg-slate-50 border {{ $errors->has('stock') ? 'border-rose-400' : 'border-slate-200' }} focus:border-sky-400 rounded-2xl px-4 py-2.5 text-xs font-medium focus:outline-none">
                    @error('stock')
                        <p class="text-[11px] text-rose-500 font-semibold mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <!-- Description -->
            <div>
                <label for="description" class="block text-xs font-bold text-slate-700 mb-1">Deskripsi Lengkap *</label>
                <textarea id="description" name="description" rows="4" required class="w-full bg-slate-50 border {{ $errors->has('description') ? 'border-rose-400' : 'border-slate-200' }} focus:border-sky-400 rounded-2xl p-4 text-xs font-medium focus:outline-none">{{ old('description', $product->description) }}</textarea>
                @error('description')
                    <p class="text-[11px] text-rose-500 font-semibold mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Current Image & Replace Image Upload -->
            <div class="p-4 bg-slate-50 rounded-2xl border border-slate-200 space-y-3">
                <label class="block text-xs font-bold text-slate-700">Foto Produk</label>
                
                <div class="flex items-center gap-4">
                    <div class="w-16 h-16 rounded-xl bg-white p-1 border border-slate-200 shrink-0 flex items-center justify-center">
                        <img src="{{ $product->image_url }}" alt="{{ $product->name }}" class="w-full h-full object-contain">
                    </div>
                    <div class="flex-1">
                        <input type="file" id="image" name="image" accept="image/*" class="w-full text-xs text-slate-500 file:mr-4 file:py-1.5 file:px-4 file:rounded-full file:border-0 file:text-xs file:font-bold file:bg-sky-100 file:text-sky-700 hover:file:bg-sky-200">
                        <p class="text-[10px] text-slate-400 mt-1">Kosongkan jika tidak ingin mengubah foto produk.</p>
                    </div>
                </div>
                @error('image')
                    <p class="text-[11px] text-rose-500 font-semibold mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Checkboxes: is_featured & is_active -->
            <div class="flex flex-wrap items-center gap-6 pt-2">
                <label class="flex items-center gap-2 cursor-pointer text-xs font-bold text-slate-700">
                    <input type="checkbox" name="is_featured" value="1" {{ old('is_featured', $product->is_featured) ? 'checked' : '' }} class="rounded text-pink-500 focus:ring-0">
                    <span>✦ Jadikan Produk Unggulan (Featured)</span>
                </label>

                <label class="flex items-center gap-2 cursor-pointer text-xs font-bold text-slate-700">
                    <input type="checkbox" name="is_active" value="1" {{ old('is_active', $product->is_active) ? 'checked' : '' }} class="rounded text-sky-500 focus:ring-0">
                    <span>Tampilkan di Toko (Aktif)</span>
                </label>
            </div>

            <div class="flex items-center justify-end gap-3 pt-4 border-t border-slate-100">
                <a href="{{ route('admin.products.index') }}" class="px-5 py-2.5 rounded-full text-xs font-bold text-slate-600 hover:bg-slate-100 transition-colors">
                    Batal
                </a>
                <button type="submit" class="y2k-btn-primary text-xs !py-2.5 !px-6 font-bold shadow-md">
                    Simpan Perubahan ✦
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
