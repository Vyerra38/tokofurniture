@extends('layouts.app')

@section('title', 'Hubungi Kami — AuraSpace Studio')

@section('content')
<div class="max-w-4xl mx-auto px-4 sm:px-6 py-12">
    <!-- Breadcrumb -->
    <div class="flex items-center gap-2 text-xs font-semibold text-slate-400 mb-6">
        <a href="{{ route('home') }}" class="hover:text-sky-600">Home</a>
        <span>/</span>
        <span class="text-slate-700">Hubungi Kami</span>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-12 gap-8">
        <!-- Contact Info -->
        <div class="md:col-span-5 y2k-glass rounded-3xl p-8 border border-white/80 shadow-xl space-y-6">
            <div>
                <span class="text-xs font-extrabold text-sky-600 tracking-wider uppercase">✦ GET IN TOUCH</span>
                <h1 class="font-display font-black text-2xl text-slate-900 mt-1">Kami Siap Membantu Kamu ♡</h1>
                <p class="text-xs text-slate-500 mt-2 leading-relaxed">
                    Punya pertanyaan tentang produk, pengiriman, atau ingin berkonsultasi seputar dekor ruangan impianmu? Hubungi kami kapan saja!
                </p>
            </div>

            <div class="space-y-4 text-xs font-semibold text-slate-700">
                <div class="flex items-center gap-3 p-3 bg-white/70 rounded-2xl border border-white">
                    <span class="text-xl">📍</span>
                    <div>
                        <p class="text-slate-400 text-[10px]">Showroom & Studio</p>
                        <p>Jl. Senopati Raya No. 1, Jakarta Selatan</p>
                    </div>
                </div>

                <div class="flex items-center gap-3 p-3 bg-white/70 rounded-2xl border border-white">
                    <span class="text-xl">📱</span>
                    <div>
                        <p class="text-slate-400 text-[10px]">WhatsApp Customer Care</p>
                        <p>+62 812-3456-7890</p>
                    </div>
                </div>

                <div class="flex items-center gap-3 p-3 bg-white/70 rounded-2xl border border-white">
                    <span class="text-xl">💌</span>
                    <div>
                        <p class="text-slate-400 text-[10px]">Email</p>
                        <p>hello@auraspace.com</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Contact Form -->
        <div class="md:col-span-7 y2k-glass rounded-3xl p-8 border border-white/80 shadow-xl">
            <h2 class="font-display font-bold text-lg text-slate-900 mb-4">Kirim Pesan Langsung ✦</h2>
            
            <form onsubmit="event.preventDefault(); alert('Pesan kamu berhasil terkirim! Tim kami akan membalas via WhatsApp/Email segera ✦');" class="space-y-4">
                <div>
                    <label class="block text-xs font-bold text-slate-700 mb-1">Nama Lengkap</label>
                    <input type="text" required placeholder="Nama kamu..." class="w-full bg-white/90 border border-slate-200 focus:border-sky-400 rounded-xl px-4 py-2 text-xs focus:outline-none">
                </div>

                <div>
                    <label class="block text-xs font-bold text-slate-700 mb-1">Email / No. WhatsApp</label>
                    <input type="text" required placeholder="Email atau nomor WA..." class="w-full bg-white/90 border border-slate-200 focus:border-sky-400 rounded-xl px-4 py-2 text-xs focus:outline-none">
                </div>

                <div>
                    <label class="block text-xs font-bold text-slate-700 mb-1">Pesan / Pertanyaan</label>
                    <textarea rows="4" required placeholder="Tulis pesan atau pertanyaanmu di sini..." class="w-full bg-white/90 border border-slate-200 focus:border-sky-400 rounded-xl p-4 text-xs focus:outline-none"></textarea>
                </div>

                <button type="submit" class="w-full y2k-btn-primary text-xs !py-3">
                    Kirim Pesan ✦
                </button>
            </form>
        </div>
    </div>
</div>
@endsection
