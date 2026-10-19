@extends('layouts.app')

@section('title', 'About Us — AuraSpace Studio')

@section('content')
<div class="max-w-4xl mx-auto px-4 sm:px-6 py-12">
    <!-- Breadcrumb -->
    <div class="flex items-center gap-2 text-xs font-semibold text-slate-400 mb-6">
        <a href="{{ route('home') }}" class="hover:text-sky-600">Home</a>
        <span>/</span>
        <span class="text-slate-700">About AuraSpace</span>
    </div>

    <div class="y2k-glass rounded-3xl p-8 sm:p-12 border-2 border-white/80 shadow-xl space-y-8">
        <div class="text-center space-y-3">
            <span class="text-xs font-extrabold text-pink-600 tracking-widest uppercase bg-pink-100 px-3 py-1 rounded-full">
                OUR STORY ✦
            </span>
            <h1 class="font-display font-black text-3xl sm:text-4xl text-slate-900 tracking-tight">
                Bringing Back The Retrofuturistic Era
            </h1>
            <p class="text-slate-600 text-sm max-w-xl mx-auto font-medium">
                AuraSpace lahir dari kecintaan kami terhadap perpaduan desain retro futuristik dan pastel — memadukan warna cerah, material transparan, dan bentuk futuristik yang menyenangkan untuk mempercantik ruanganmu.
            </p>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-3 gap-6 pt-6">
            <div class="bg-white/70 p-6 rounded-2xl border border-white text-center space-y-2">
                <span class="text-3xl">🪞</span>
                <h3 class="font-display font-bold text-slate-800 text-sm">Aesthetic Obsessed</h3>
                <p class="text-xs text-slate-500">Setiap produk didesain agar terlihat fotogenik di setiap sudut ruangan kamu.</p>
            </div>
            <div class="bg-white/70 p-6 rounded-2xl border border-white text-center space-y-2">
                <span class="text-3xl">🫧</span>
                <h3 class="font-display font-bold text-slate-800 text-sm">Bubble & Glossy</h3>
                <p class="text-xs text-slate-500">Sentuhan material akrilik, chrome, dan resin tahan banting berstandar tinggi.</p>
            </div>
            <div class="bg-white/70 p-6 rounded-2xl border border-white text-center space-y-2">
                <span class="text-3xl">💌</span>
                <h3 class="font-display font-bold text-slate-800 text-sm">Crafted with Care</h3>
                <p class="text-xs text-slate-500">Kami mengemas setiap paket layaknya hadiah spesial untuk kamu.</p>
            </div>
        </div>

        <div class="pt-6 border-t border-slate-200/60 text-center">
            <a href="{{ route('shop.index') }}" class="y2k-btn-primary text-xs !py-3 !px-6">
                Jelajahi Koleksi AuraSpace ✦
            </a>
        </div>
    </div>
</div>
@endsection
