@extends('layouts.admin')

@section('title', 'Manajemen Kategori')
@section('page-title', 'Kategori Produk 🏷️')

@section('content')
<div class="space-y-8">
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-start">
        <!-- Form Tambah Kategori (4 cols) -->
        <div class="lg:col-span-4 bg-white p-6 rounded-3xl border border-slate-200/80 shadow-xs space-y-4">
            <h3 class="font-display font-bold text-base text-slate-900 flex items-center gap-2">
                <span>➕</span>
                <span>Tambah Kategori Baru</span>
            </h3>

            <form action="{{ route('admin.categories.store') }}" method="POST" class="space-y-4">
                @csrf
                <div>
                    <label for="name" class="block text-xs font-bold text-slate-700 mb-1">Nama Kategori *</label>
                    <input type="text" id="name" name="name" value="{{ old('name') }}" required placeholder="Contoh: Wall Clock" class="w-full bg-white border {{ $errors->has('name') ? 'border-rose-400' : 'border-slate-200' }} focus:border-sky-400 rounded-2xl px-4 py-2 text-xs font-medium focus:outline-none">
                    @error('name')
                        <p class="text-[11px] text-rose-500 font-semibold mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="description" class="block text-xs font-bold text-slate-700 mb-1">Deskripsi Singkat</label>
                    <textarea id="description" name="description" rows="3" placeholder="Deskripsi kategori..." class="w-full bg-white border border-slate-200 focus:border-sky-400 rounded-2xl p-3 text-xs font-medium focus:outline-none">{{ old('description') }}</textarea>
                </div>

                <button type="submit" class="w-full y2k-btn-primary text-xs !py-2.5 font-bold">
                    Simpan Kategori ✦
                </button>
            </form>
        </div>

        <!-- Tabel Daftar Kategori (8 cols) -->
        <div class="lg:col-span-8 bg-white p-6 rounded-3xl border border-slate-200/80 shadow-xs space-y-4">
            <div class="flex items-center justify-between pb-3 border-b border-slate-100">
                <div>
                    <h3 class="font-display font-bold text-base text-slate-900">Daftar Kategori</h3>
                    <p class="text-xs text-slate-400">Kelola kategori untuk mengelompokkan produk di toko</p>
                </div>
                <span class="text-xs font-bold bg-slate-100 px-3 py-1 rounded-full text-slate-700">
                    {{ $categories->total() }} Kategori
                </span>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full text-left text-xs">
                    <thead>
                        <tr class="text-slate-400 uppercase tracking-wider border-b border-slate-100">
                            <th class="pb-3 font-bold">Nama Kategori</th>
                            <th class="pb-3 font-bold">Slug</th>
                            <th class="pb-3 font-bold">Jumlah Produk</th>
                            <th class="pb-3 font-bold text-right">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100 font-medium text-slate-700">
                        @foreach($categories as $category)
                            <tr class="hover:bg-slate-50/80 transition-colors">
                                <td class="py-3 font-bold text-slate-900">
                                    {{ $category->name }}
                                    @if($category->description)
                                        <p class="text-[10px] text-slate-400 font-normal line-clamp-1">{{ $category->description }}</p>
                                    @endif
                                </td>
                                <td class="py-3 text-slate-500 font-mono text-[11px]">
                                    {{ $category->slug }}
                                </td>
                                <td class="py-3">
                                    <span class="px-2.5 py-0.5 rounded-full text-[10px] font-bold bg-sky-100 text-sky-800">
                                        {{ $category->products_count }} produk
                                    </span>
                                </td>
                                <td class="py-3 text-right">
                                    <div class="flex items-center justify-end gap-2">
                                        <!-- Edit inline toggle or button -->
                                        <button onclick="editCategory({{ $category->id }}, '{{ addslashes($category->name) }}', '{{ addslashes($category->description ?? '') }}')" class="p-1.5 text-slate-500 hover:text-sky-600 rounded-lg hover:bg-sky-50 transition-colors" title="Edit">
                                            ✏️
                                        </button>

                                        <!-- Delete form -->
                                        <form action="{{ route('admin.categories.destroy', $category) }}" method="POST" onsubmit="return confirm('Hapus kategori {{ $category->name }}?');">
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
                {{ $categories->links() }}
            </div>
        </div>
    </div>
</div>

<!-- Edit Category Modal Dialog -->
<div id="editModal" class="hidden fixed inset-0 z-50 bg-slate-900/40 backdrop-blur-xs flex items-center justify-center p-4">
    <div class="bg-white rounded-3xl p-6 max-w-md w-full shadow-2xl border border-slate-100 space-y-4">
        <div class="flex items-center justify-between pb-2 border-b border-slate-100">
            <h3 class="font-display font-bold text-base text-slate-900">Edit Kategori</h3>
            <button onclick="closeEditModal()" class="text-slate-400 hover:text-slate-700 text-sm">✕</button>
        </div>

        <form id="editForm" method="POST" class="space-y-4">
            @csrf
            @method('PUT')

            <div>
                <label for="edit_name" class="block text-xs font-bold text-slate-700 mb-1">Nama Kategori *</label>
                <input type="text" id="edit_name" name="name" required class="w-full bg-white border border-slate-200 focus:border-sky-400 rounded-2xl px-4 py-2 text-xs font-medium focus:outline-none">
            </div>

            <div>
                <label for="edit_description" class="block text-xs font-bold text-slate-700 mb-1">Deskripsi Singkat</label>
                <textarea id="edit_description" name="description" rows="3" class="w-full bg-white border border-slate-200 focus:border-sky-400 rounded-2xl p-3 text-xs font-medium focus:outline-none"></textarea>
            </div>

            <div class="flex items-center justify-end gap-2 pt-2">
                <button type="button" onclick="closeEditModal()" class="px-4 py-2 rounded-full text-xs font-bold text-slate-600 hover:bg-slate-100 transition-colors">
                    Batal
                </button>
                <button type="submit" class="y2k-btn-primary text-xs !py-2 !px-5 font-bold">
                    Perbarui ✦
                </button>
            </div>
        </form>
    </div>
</div>

@push('scripts')
<script>
    function editCategory(id, name, desc) {
        const modal = document.getElementById('editModal');
        const form = document.getElementById('editForm');
        form.action = '/admin/categories/' + id;
        document.getElementById('edit_name').value = name;
        document.getElementById('edit_description').value = desc;
        modal.classList.remove('hidden');
    }

    function closeEditModal() {
        document.getElementById('editModal').classList.add('hidden');
    }
</script>
@endpush
@endsection
