@extends('layouts.admin')

@section('title', 'Tambah Produk Baru')
@section('page-title', 'Tambah Produk Baru 📦')

@section('content')
<div class="max-w-4xl mx-auto space-y-6">
    <div class="flex items-center gap-2 text-xs font-semibold text-slate-400">
        <a href="{{ route('admin.products.index') }}" class="hover:text-sky-600">Katalog Produk</a>
        <span>/</span>
        <span class="text-slate-700">Tambah Baru</span>
    </div>

    <div class="bg-white rounded-3xl p-6 sm:p-8 border border-slate-200/80 shadow-xs space-y-6">
        <div class="pb-4 border-b border-slate-100">
            <h3 class="font-display font-bold text-lg text-slate-900">Formulir Produk Baru ✦</h3>
            <p class="text-xs text-slate-400">Isi data produk furniture / dekorasi yang ingin dijual</p>
        </div>

        <form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
            @csrf

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                <!-- Category -->
                <div>
                    <label for="category_id" class="block text-xs font-bold text-slate-700 mb-1">Kategori Produk *</label>
                    <select id="category_id" name="category_id" required class="w-full bg-slate-50 border {{ $errors->has('category_id') ? 'border-rose-400' : 'border-slate-200' }} focus:border-sky-400 rounded-2xl px-4 py-2.5 text-xs font-medium focus:outline-none">
                        <option value="">-- Pilih Kategori --</option>
                        @foreach($categories as $cat)
                            <option value="{{ $cat->id }}" {{ old('category_id') == $cat->id ? 'selected' : '' }}>
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
                    <input type="text" id="name" name="name" value="{{ old('name') }}" required placeholder="Contoh: Chrome Bubble Wall Clock" class="w-full bg-slate-50 border {{ $errors->has('name') ? 'border-rose-400' : 'border-slate-200' }} focus:border-sky-400 rounded-2xl px-4 py-2.5 text-xs font-medium focus:outline-none">
                    @error('name')
                        <p class="text-[11px] text-rose-500 font-semibold mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                <!-- Price -->
                <div>
                    <label for="price" class="block text-xs font-bold text-slate-700 mb-1">Harga (Rupiah) *</label>
                    <input type="number" id="price" name="price" value="{{ old('price') }}" required placeholder="Contoh: 289000" min="0" class="w-full bg-slate-50 border {{ $errors->has('price') ? 'border-rose-400' : 'border-slate-200' }} focus:border-sky-400 rounded-2xl px-4 py-2.5 text-xs font-medium focus:outline-none">
                    @error('price')
                        <p class="text-[11px] text-rose-500 font-semibold mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Stock -->
                <div>
                    <label for="stock" class="block text-xs font-bold text-slate-700 mb-1">Stok Awal (pcs) *</label>
                    <input type="number" id="stock" name="stock" value="{{ old('stock', 10) }}" required min="0" class="w-full bg-slate-50 border {{ $errors->has('stock') ? 'border-rose-400' : 'border-slate-200' }} focus:border-sky-400 rounded-2xl px-4 py-2.5 text-xs font-medium focus:outline-none">
                    @error('stock')
                        <p class="text-[11px] text-rose-500 font-semibold mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <!-- Description -->
            <div>
                <label for="description" class="block text-xs font-bold text-slate-700 mb-1">Deskripsi Lengkap *</label>
                <textarea id="description" name="description" rows="4" required placeholder="Tuliskan spesifikasi, bahan, ukuran, dan keunggulan estetika produk..." class="w-full bg-slate-50 border {{ $errors->has('description') ? 'border-rose-400' : 'border-slate-200' }} focus:border-sky-400 rounded-2xl p-4 text-xs font-medium focus:outline-none">{{ old('description') }}</textarea>
                @error('description')
                    <p class="text-[11px] text-rose-500 font-semibold mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Image Upload -->
            <div>
                <label for="image" class="block text-xs font-bold text-slate-700 mb-1">Foto Produk</label>
                <input type="file" id="image" name="image" accept="image/*" class="w-full bg-slate-50 border {{ $errors->has('image') ? 'border-rose-400' : 'border-slate-200' }} rounded-2xl p-2 text-xs font-medium focus:outline-none file:mr-4 file:py-1.5 file:px-4 file:rounded-full file:border-0 file:text-xs file:font-bold file:bg-sky-100 file:text-sky-700 hover:file:bg-sky-200">
                <p class="text-[10px] text-slate-400 mt-1">Format gambar: JPG, PNG, WEBP, atau SVG. Maksimal 2MB.</p>
                @error('image')
                    <p class="text-[11px] text-rose-500 font-semibold mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Checkboxes: is_featured & is_active -->
            <div class="flex flex-wrap items-center gap-6 pt-2">
                <label class="flex items-center gap-2 cursor-pointer text-xs font-bold text-slate-700">
                    <input type="checkbox" name="is_featured" value="1" {{ old('is_featured') ? 'checked' : '' }} class="rounded text-pink-500 focus:ring-0">
                    <span>✦ Jadikan Produk Unggulan (Featured)</span>
                </label>

                <label class="flex items-center gap-2 cursor-pointer text-xs font-bold text-slate-700">
                    <input type="checkbox" name="is_active" value="1" {{ old('is_active', true) ? 'checked' : '' }} class="rounded text-sky-500 focus:ring-0">
                    <span>Tampilkan di Toko (Aktif)</span>
                </label>
            </div>

            <div class="flex items-center justify-end gap-3 pt-4 border-t border-slate-100">
                <a href="{{ route('admin.products.index') }}" class="px-5 py-2.5 rounded-full text-xs font-bold text-slate-600 hover:bg-slate-100 transition-colors">
                    Batal
                </a>
                <button type="submit" class="y2k-btn-primary text-xs !py-2.5 !px-6 font-bold shadow-md">
                    Simpan Produk ✦
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
