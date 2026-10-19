@extends('layouts.app')

@section('title', 'Register — Join the Club ♡ AuraSpace')

@section('content')
<div class="max-w-md mx-auto px-4 py-14">
    <div class="y2k-glass rounded-3xl p-8 sm:p-10 border-2 border-white/90 shadow-2xl relative overflow-hidden">
        <!-- Floating Accent -->
        <div class="absolute -top-10 -right-10 w-32 h-32 bg-pink-300/30 rounded-full blur-2xl pointer-events-none"></div>

        <div class="text-center space-y-2 mb-8">
            <span class="w-12 h-12 rounded-full bg-gradient-to-tr from-pink-300 to-purple-300 inline-flex items-center justify-center text-white text-xl font-bold shadow-md mb-2">♡</span>
            <h1 class="font-display font-black text-2xl sm:text-3xl text-slate-900 tracking-tight">
                Join the club ♡
            </h1>
            <p class="text-xs text-slate-500 font-medium">
                Daftar akun gratis dan nikmati kemudahan belanja furniture estetik ✦
            </p>
        </div>

        <form action="{{ route('register') }}" method="POST" class="space-y-4">
            @csrf

            <!-- Name -->
            <div>
                <label for="name" class="block text-xs font-bold text-slate-700 mb-1">Nama Lengkap</label>
                <input type="text" id="name" name="name" value="{{ old('name') }}" required autofocus placeholder="Contoh: Luna Stella" class="w-full bg-white/90 border {{ $errors->has('name') ? 'border-rose-400' : 'border-slate-200' }} focus:border-pink-400 rounded-full px-4 py-2.5 text-xs font-medium focus:outline-none shadow-xs">
                @error('name')
                    <p class="text-[11px] text-rose-500 font-semibold mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Email -->
            <div>
                <label for="email" class="block text-xs font-bold text-slate-700 mb-1">Alamat Email</label>
                <input type="email" id="email" name="email" value="{{ old('email') }}" required placeholder="nama@email.com" class="w-full bg-white/90 border {{ $errors->has('email') ? 'border-rose-400' : 'border-slate-200' }} focus:border-pink-400 rounded-full px-4 py-2.5 text-xs font-medium focus:outline-none shadow-xs">
                @error('email')
                    <p class="text-[11px] text-rose-500 font-semibold mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Phone -->
            <div>
                <label for="phone" class="block text-xs font-bold text-slate-700 mb-1">Nomor WhatsApp (Opsional)</label>
                <input type="text" id="phone" name="phone" value="{{ old('phone') }}" placeholder="08xxxxxxxxxx" class="w-full bg-white/90 border border-slate-200 focus:border-pink-400 rounded-full px-4 py-2.5 text-xs font-medium focus:outline-none shadow-xs">
                @error('phone')
                    <p class="text-[11px] text-rose-500 font-semibold mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Password -->
            <div>
                <label for="password" class="block text-xs font-bold text-slate-700 mb-1">Password (Min. 6 Karakter)</label>
                <input type="password" id="password" name="password" required placeholder="••••••••" class="w-full bg-white/90 border {{ $errors->has('password') ? 'border-rose-400' : 'border-slate-200' }} focus:border-pink-400 rounded-full px-4 py-2.5 text-xs font-medium focus:outline-none shadow-xs">
                @error('password')
                    <p class="text-[11px] text-rose-500 font-semibold mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Password Confirmation -->
            <div>
                <label for="password_confirmation" class="block text-xs font-bold text-slate-700 mb-1">Ulangi Password</label>
                <input type="password" id="password_confirmation" name="password_confirmation" required placeholder="••••••••" class="w-full bg-white/90 border border-slate-200 focus:border-pink-400 rounded-full px-4 py-2.5 text-xs font-medium focus:outline-none shadow-xs">
            </div>

            <!-- Submit Button -->
            <button type="submit" class="w-full y2k-btn-pink text-xs sm:text-sm !py-3 font-bold mt-2">
                Daftar Sekarang ♡
            </button>
        </form>

        <div class="mt-6 pt-6 border-t border-slate-100 text-center text-xs text-slate-600">
            <span>Sudah memiliki akun?</span>
            <a href="{{ route('login') }}" class="font-bold text-sky-600 hover:underline ml-1">
                Masuk di sini ✦
            </a>
        </div>
    </div>
</div>
@endsection
