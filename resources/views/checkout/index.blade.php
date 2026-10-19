@extends('layouts.app')

@section('title', 'Checkout — AuraSpace ✦')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <!-- Breadcrumb -->
    <div class="flex items-center gap-2 text-xs font-semibold text-slate-400 mb-6">
        <a href="{{ route('home') }}" class="hover:text-sky-600">Home</a>
        <span>/</span>
        <a href="{{ route('cart.index') }}" class="hover:text-sky-600">Keranjang</a>
        <span>/</span>
        <span class="text-slate-700">Checkout</span>
    </div>

    <div class="mb-8">
        <span class="text-xs font-extrabold text-pink-600 tracking-wider uppercase">✦ FINAL STEP</span>
        <h1 class="font-display font-black text-3xl sm:text-4xl text-slate-900 tracking-tight mt-1">
            Konfirmasi Pesanan ✦
        </h1>
        <p class="text-xs sm:text-sm text-slate-500 mt-1">Lengkapi alamat pengiriman dan pilih metode pembayaran</p>
    </div>

    <form action="{{ route('checkout.process') }}" method="POST">
        @csrf
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-start">
            <!-- Left: Shipping & Payment Form -->
            <div class="lg:col-span-7 space-y-6">
                <!-- Shipping Form Card -->
                <div class="y2k-glass rounded-3xl p-6 sm:p-8 border border-white/80 shadow-md space-y-5">
                    <h2 class="font-display font-black text-lg text-slate-900 flex items-center gap-2">
                        <span>📍</span>
                        <span>Informasi Alamat Pengiriman</span>
                    </h2>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <!-- Recipient Name -->
                        <div>
                            <label for="recipient_name" class="block text-xs font-bold text-slate-700 mb-1">Nama Penerima *</label>
                            <input type="text" id="recipient_name" name="recipient_name" value="{{ old('recipient_name', $user->name) }}" required class="w-full bg-white border {{ $errors->has('recipient_name') ? 'border-rose-400' : 'border-slate-200' }} focus:border-sky-400 rounded-2xl px-4 py-2.5 text-xs font-medium focus:outline-none">
                            @error('recipient_name')
                                <p class="text-[11px] text-rose-500 font-semibold mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Phone -->
                        <div>
                            <label for="phone" class="block text-xs font-bold text-slate-700 mb-1">Nomor WhatsApp / HP *</label>
                            <input type="text" id="phone" name="phone" value="{{ old('phone', $user->phone) }}" required placeholder="08xxxxxxxxxx" class="w-full bg-white border {{ $errors->has('phone') ? 'border-rose-400' : 'border-slate-200' }} focus:border-sky-400 rounded-2xl px-4 py-2.5 text-xs font-medium focus:outline-none">
                            @error('phone')
                                <p class="text-[11px] text-rose-500 font-semibold mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <!-- Address -->
                    <div>
                        <label for="address" class="block text-xs font-bold text-slate-700 mb-1">Alamat Lengkap (Jalan, No. Rumah, RT/RW, Patokan) *</label>
                        <textarea id="address" name="address" rows="3" required placeholder="Contoh: Jl. Lavender Pastel No. 42, RT 03/05..." class="w-full bg-white border {{ $errors->has('address') ? 'border-rose-400' : 'border-slate-200' }} focus:border-sky-400 rounded-2xl p-4 text-xs font-medium focus:outline-none">{{ old('address', $user->address) }}</textarea>
                        @error('address')
                            <p class="text-[11px] text-rose-500 font-semibold mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <!-- City -->
                        <div>
                            <label for="city" class="block text-xs font-bold text-slate-700 mb-1">Kota / Kabupaten *</label>
                            <input type="text" id="city" name="city" value="{{ old('city') }}" required placeholder="Contoh: Bandung" class="w-full bg-white border {{ $errors->has('city') ? 'border-rose-400' : 'border-slate-200' }} focus:border-sky-400 rounded-2xl px-4 py-2.5 text-xs font-medium focus:outline-none">
                            @error('city')
                                <p class="text-[11px] text-rose-500 font-semibold mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Postal Code -->
                        <div>
                            <label for="postal_code" class="block text-xs font-bold text-slate-700 mb-1">Kode Pos *</label>
                            <input type="text" id="postal_code" name="postal_code" value="{{ old('postal_code') }}" required placeholder="Contoh: 40123" class="w-full bg-white border {{ $errors->has('postal_code') ? 'border-rose-400' : 'border-slate-200' }} focus:border-sky-400 rounded-2xl px-4 py-2.5 text-xs font-medium focus:outline-none">
                            @error('postal_code')
                                <p class="text-[11px] text-rose-500 font-semibold mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <!-- Notes -->
                    <div>
                        <label for="notes" class="block text-xs font-bold text-slate-700 mb-1">Catatan Tambahan (Opsional)</label>
                        <input type="text" id="notes" name="notes" value="{{ old('notes') }}" placeholder="Contoh: Titipkan ke satpam jika tidak ada di rumah" class="w-full bg-white border border-slate-200 focus:border-sky-400 rounded-2xl px-4 py-2 text-xs font-medium focus:outline-none">
                    </div>
                </div>

                <!-- Payment Method Card -->
                <div class="y2k-glass rounded-3xl p-6 sm:p-8 border border-white/80 shadow-md space-y-4">
                    <h2 class="font-display font-black text-lg text-slate-900 flex items-center gap-2">
                        <span>💳</span>
                        <span>Metode Pembayaran</span>
                    </h2>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <!-- Transfer Bank -->
                        <label class="relative flex flex-col p-4 bg-white/90 rounded-2xl border-2 border-slate-200 hover:border-sky-400 cursor-pointer transition-all has-checked:border-sky-500 has-checked:bg-sky-50/50 shadow-xs">
                            <input type="radio" name="payment_method" value="Transfer Bank" checked class="sr-only">
                            <div class="flex items-center justify-between mb-2">
                                <span class="font-bold text-xs text-slate-800">Transfer Bank</span>
                                <span class="text-base">🏦</span>
                            </div>
                            <p class="text-[11px] text-slate-500 leading-relaxed">
                                Transfer manual ke rekening BCA / Mandiri toko AuraSpace.
                            </p>
                        </label>

                        <!-- COD -->
                        <label class="relative flex flex-col p-4 bg-white/90 rounded-2xl border-2 border-slate-200 hover:border-pink-400 cursor-pointer transition-all has-checked:border-pink-500 has-checked:bg-pink-50/50 shadow-xs">
                            <input type="radio" name="payment_method" value="COD" {{ old('payment_method') === 'COD' ? 'checked' : '' }} class="sr-only">
                            <div class="flex items-center justify-between mb-2">
                                <span class="font-bold text-xs text-slate-800">Cash on Delivery (COD)</span>
                                <span class="text-base">🤝</span>
                            </div>
                            <p class="text-[11px] text-slate-500 leading-relaxed">
                                Bayar tunai di tempat saat kurir mengantarkan paket pesananmu.
                            </p>
                        </label>
                    </div>
                    @error('payment_method')
                        <p class="text-[11px] text-rose-500 font-semibold">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <!-- Right: Order Summary -->
            <div class="lg:col-span-5">
                <div class="y2k-glass rounded-3xl p-6 sm:p-7 border-2 border-white/90 shadow-xl space-y-5 sticky top-28">
                    <h2 class="font-display font-black text-lg text-slate-900">
                        Item Pesanan ({{ $cart->total_quantity }})
                    </h2>

                    <!-- Items Preview -->
                    <div class="max-h-64 overflow-y-auto space-y-3 pr-1 divide-y divide-slate-100">
                        @foreach($cart->items as $item)
                            <div class="pt-3 first:pt-0 flex items-center justify-between gap-3">
                                <div class="flex items-center gap-3 min-w-0">
                                    <div class="w-12 h-12 rounded-xl bg-gradient-to-tr from-sky-50 to-pink-50 p-1 shrink-0 border border-white flex items-center justify-center">
                                        <img src="{{ $item->product->image_url }}" alt="{{ $item->product->name }}" class="w-full h-full object-contain">
                                    </div>
                                    <div class="truncate">
                                        <p class="text-xs font-bold text-slate-800 truncate">{{ $item->product->name }}</p>
                                        <p class="text-[10px] text-slate-400">{{ $item->quantity }} x {{ $item->product->formatted_price }}</p>
                                    </div>
                                </div>
                                <span class="font-display font-bold text-xs text-slate-900 shrink-0">
                                    {{ $item->formatted_subtotal }}
                                </span>
                            </div>
                        @endforeach
                    </div>

                    <hr class="border-slate-100">

                    <!-- Breakdown -->
                    <div class="space-y-2.5 text-xs font-semibold text-slate-600">
                        <div class="flex items-center justify-between">
                            <span>Subtotal Produk</span>
                            <span class="text-slate-900 font-bold">{{ format_rupiah($subtotal) }}</span>
                        </div>
                        <div class="flex items-center justify-between">
                            <span>Biaya Pengiriman</span>
                            @if($shippingCost == 0)
                                <span class="text-emerald-600 font-bold uppercase">GRATIS ✦</span>
                            @else
                                <span class="text-slate-900 font-bold">{{ format_rupiah($shippingCost) }}</span>
                            @endif
                        </div>
                    </div>

                    <hr class="border-slate-100">

                    <div class="flex items-baseline justify-between">
                        <span class="font-display font-black text-base text-slate-900">Total Pembayaran</span>
                        <span class="font-display font-black text-2xl text-sky-700">
                            {{ format_rupiah($total) }}
                        </span>
                    </div>

                    <button type="submit" class="w-full y2k-btn-pink text-xs sm:text-sm !py-3.5 shadow-xl shadow-pink-200 font-bold tracking-wide">
                        Place Order ✦
                    </button>

                    <p class="text-[11px] text-slate-400 text-center font-medium">
                        ✦ Belanja aman terlindungi garansi retur jika barang rusak
                    </p>
                </div>
            </div>
        </div>
    </form>
</div>
@endsection
