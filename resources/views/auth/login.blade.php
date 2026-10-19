@extends('layouts.app')

@section('title', 'Login — Welcome Back ✦ AuraSpace')

@section('content')
<div class="max-w-md mx-auto px-4 py-16">
    <div class="y2k-glass rounded-3xl p-8 sm:p-10 border-2 border-white/90 shadow-2xl relative overflow-hidden">
        <!-- Floating Accent -->
        <div class="absolute -top-10 -right-10 w-32 h-32 bg-sky-300/30 rounded-full blur-2xl pointer-events-none"></div>

        <div class="text-center space-y-2 mb-8">
            <span class="w-12 h-12 rounded-full bg-gradient-to-tr from-sky-300 to-pink-300 inline-flex items-center justify-center text-white text-xl font-bold shadow-md mb-2">✦</span>
            <h1 class="font-display font-black text-2xl sm:text-3xl text-slate-900 tracking-tight">
                Welcome back ✦
            </h1>
            <p class="text-xs text-slate-500 font-medium">
                Masuk ke akunmu untuk melanjutkan pesanan dekorasi impianmu ♡
            </p>
        </div>

        <form action="{{ route('login') }}" method="POST" class="space-y-4">
            @csrf

            <!-- Email -->
            <div>
                <label for="email" class="block text-xs font-bold text-slate-700 mb-1">Alamat Email</label>
                <input type="email" id="email" name="email" value="{{ old('email') }}" required autofocus placeholder="nama@email.com" class="w-full bg-white/90 border {{ $errors->has('email') ? 'border-rose-400' : 'border-slate-200' }} focus:border-sky-400 rounded-full px-4 py-2.5 text-xs font-medium focus:outline-none shadow-xs">
                @error('email')
                    <p class="text-[11px] text-rose-500 font-semibold mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Password -->
            <div>
                <label for="password" class="block text-xs font-bold text-slate-700 mb-1">Password</label>
                <input type="password" id="password" name="password" required placeholder="••••••••" class="w-full bg-white/90 border {{ $errors->has('password') ? 'border-rose-400' : 'border-slate-200' }} focus:border-sky-400 rounded-full px-4 py-2.5 text-xs font-medium focus:outline-none shadow-xs">
                @error('password')
                    <p class="text-[11px] text-rose-500 font-semibold mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Remember me -->
            <div class="flex items-center justify-between text-xs">
                <label class="flex items-center gap-2 cursor-pointer text-slate-600 font-medium">
                    <input type="checkbox" name="remember" class="rounded text-sky-500 focus:ring-0">
                    <span>Ingat saya di perangkat ini</span>
                </label>
            </div>

            <!-- Submit Button -->
            <button type="submit" class="w-full y2k-btn-primary text-xs sm:text-sm !py-3 font-bold mt-2">
                Masuk Sekarang ✦
            </button>
        </form>

        <div class="mt-8 pt-6 border-t border-slate-100 text-center text-xs text-slate-600">
            <span>Belum punya akun?</span>
            <a href="{{ route('register') }}" class="font-bold text-pink-600 hover:underline ml-1">
                Join the club ♡
            </a>
        </div>
    </div>
</div>
@endsection
