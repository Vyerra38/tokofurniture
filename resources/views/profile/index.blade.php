@extends('layouts.app')

@section('title', 'Profil Akun — AuraSpace ✦')

@section('content')
<div class="max-w-2xl mx-auto px-4 sm:px-6 py-10">
    <!-- Breadcrumb -->
    <div class="flex items-center gap-2 text-xs font-semibold text-slate-400 mb-6">
        <a href="{{ route('home') }}" class="hover:text-sky-600">Home</a>
        <span>/</span>
        <span class="text-slate-700">Profil Saya</span>
    </div>

    <div class="mb-8 text-center sm:text-left">
        <span class="text-xs font-extrabold text-pink-600 tracking-wider uppercase">✦ ACCOUNT SETTINGS</span>
        <h1 class="font-display font-black text-3xl text-slate-900 tracking-tight mt-1">
            Kelola Profil Akun 👤
        </h1>
        <p class="text-xs text-slate-500 mt-1">Perbarui data profil dan alamat pengiriman default kamu</p>
    </div>

    <div class="y2k-glass rounded-3xl p-6 sm:p-10 border-2 border-white/90 shadow-xl space-y-6">
        <!-- User Avatar & Status -->
        <div class="flex items-center gap-4 pb-6 border-b border-slate-100">
            <div class="w-16 h-16 rounded-3xl bg-gradient-to-tr from-sky-400 via-pink-400 to-purple-500 p-0.5 shadow-md shrink-0">
                <div class="w-full h-full bg-white rounded-3xl flex items-center justify-center font-display font-black text-2xl text-slate-800">
                    {{ strtoupper(substr($user->name, 0, 1)) }}
                </div>
            </div>
            <div>
                <h3 class="font-bold text-base text-slate-900">{{ $user->name }}</h3>
                <p class="text-xs text-slate-500">{{ $user->email }}</p>
                <span class="inline-block mt-1 text-[10px] font-bold text-pink-700 bg-pink-100 px-2.5 py-0.5 rounded-full capitalize">
                    Member {{ ucfirst($user->role) }} ✦
                </span>
            </div>
        </div>

        <form action="{{ route('profile.update') }}" method="POST" class="space-y-5">
            @csrf
            @method('PUT')

            <!-- Name -->
            <div>
                <label for="name" class="block text-xs font-bold text-slate-700 mb-1">Nama Lengkap *</label>
                <input type="text" id="name" name="name" value="{{ old('name', $user->name) }}" required class="w-full bg-white/90 border {{ $errors->has('name') ? 'border-rose-400' : 'border-slate-200' }} focus:border-sky-400 rounded-2xl px-4 py-2.5 text-xs font-medium focus:outline-none shadow-xs">
                @error('name')
                    <p class="text-[11px] text-rose-500 font-semibold mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Email (Readonly) -->
            <div>
                <label class="block text-xs font-bold text-slate-700 mb-1">Alamat Email</label>
                <input type="email" value="{{ $user->email }}" disabled class="w-full bg-slate-100 border border-slate-200 rounded-2xl px-4 py-2.5 text-xs font-medium text-slate-400 cursor-not-allowed">
                <p class="text-[10px] text-slate-400 mt-1">Email digunakan sebagai ID akun utama.</p>
            </div>

            <!-- Phone -->
            <div>
                <label for="phone" class="block text-xs font-bold text-slate-700 mb-1">Nomor WhatsApp / HP</label>
                <input type="text" id="phone" name="phone" value="{{ old('phone', $user->phone) }}" placeholder="08xxxxxxxxxx" class="w-full bg-white/90 border {{ $errors->has('phone') ? 'border-rose-400' : 'border-slate-200' }} focus:border-sky-400 rounded-2xl px-4 py-2.5 text-xs font-medium focus:outline-none shadow-xs">
                @error('phone')
                    <p class="text-[11px] text-rose-500 font-semibold mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Address Default -->
            <div>
                <label for="address" class="block text-xs font-bold text-slate-700 mb-1">Alamat Pengiriman Default</label>
                <textarea id="address" name="address" rows="3" placeholder="Alamat lengkap tempat tinggal kamu..." class="w-full bg-white/90 border {{ $errors->has('address') ? 'border-rose-400' : 'border-slate-200' }} focus:border-sky-400 rounded-2xl p-4 text-xs font-medium focus:outline-none shadow-xs">{{ old('address', $user->address) }}</textarea>
                @error('address')
                    <p class="text-[11px] text-rose-500 font-semibold mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Password Change Section -->
            <div class="pt-4 border-t border-slate-100 space-y-4">
                <h4 class="font-display font-bold text-xs uppercase tracking-wider text-slate-700">
                    Ganti Password (Opsional)
                </h4>

                <div>
                    <label for="current_password" class="block text-xs font-bold text-slate-700 mb-1">Password Saat Ini</label>
                    <input type="password" id="current_password" name="current_password" placeholder="••••••••" class="w-full bg-white/90 border {{ $errors->has('current_password') ? 'border-rose-400' : 'border-slate-200' }} focus:border-sky-400 rounded-2xl px-4 py-2.5 text-xs font-medium focus:outline-none">
                    @error('current_password')
                        <p class="text-[11px] text-rose-500 font-semibold mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div>
                        <label for="new_password" class="block text-xs font-bold text-slate-700 mb-1">Password Baru</label>
                        <input type="password" id="new_password" name="new_password" placeholder="Minimal 6 karakter" class="w-full bg-white/90 border {{ $errors->has('new_password') ? 'border-rose-400' : 'border-slate-200' }} focus:border-sky-400 rounded-2xl px-4 py-2.5 text-xs font-medium focus:outline-none">
                        @error('new_password')
                            <p class="text-[11px] text-rose-500 font-semibold mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="new_password_confirmation" class="block text-xs font-bold text-slate-700 mb-1">Ulangi Password Baru</label>
                        <input type="password" id="new_password_confirmation" name="new_password_confirmation" placeholder="••••••••" class="w-full bg-white/90 border border-slate-200 focus:border-sky-400 rounded-2xl px-4 py-2.5 text-xs font-medium focus:outline-none">
                    </div>
                </div>
            </div>

            <button type="submit" class="w-full y2k-btn-primary text-xs sm:text-sm !py-3 font-bold shadow-md">
                Simpan Perubahan Profil ✦
            </button>
        </form>
    </div>
</div>
@endsection
