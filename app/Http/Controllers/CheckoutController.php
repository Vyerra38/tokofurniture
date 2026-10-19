<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Payment;
use App\Models\Product;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\View\View;

class CheckoutController extends Controller
{
    public function index(): View|RedirectResponse
    {
        $cart = Cart::with(['items.product'])->where('user_id', Auth::id())->first();

        if (!$cart || $cart->items->isEmpty()) {
            return redirect()->route('cart.index')
                ->with('warning', 'Keranjang belanjamu masih kosong. Yuk pilih produk dulu ✦');
        }

        // Cek jika ada produk di cart yang stoknya habis
        foreach ($cart->items as $item) {
            if ($item->quantity > $item->product->stock) {
                return redirect()->route('cart.index')
                    ->with('error', 'Stok untuk ' . $item->product->name . ' tersisa ' . $item->product->stock . ' pcs. Silakan sesuaikan jumlah di keranjang.');
            }
        }

        $user = Auth::user();
        $subtotal = $cart->total_price;
        $shippingCost = $subtotal >= 500000 ? 0 : 25000;
        $total = $subtotal + $shippingCost;

        return view('checkout.index', compact('cart', 'user', 'subtotal', 'shippingCost', 'total'));
    }

    public function process(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'recipient_name' => ['required', 'string', 'max:255'],
            'phone' => ['required', 'string', 'max:25'],
            'address' => ['required', 'string'],
            'city' => ['required', 'string', 'max:100'],
            'postal_code' => ['required', 'string', 'max:10'],
            'notes' => ['nullable', 'string', 'max:500'],
            'payment_method' => ['required', 'in:Transfer Bank,COD'],
        ], [
            'recipient_name.required' => 'Nama penerima wajib diisi.',
            'phone.required' => 'Nomor WhatsApp / telepon wajib diisi.',
            'address.required' => 'Alamat lengkap pengiriman wajib diisi.',
            'city.required' => 'Kota pengiriman wajib diisi.',
            'postal_code.required' => 'Kode pos wajib diisi.',
            'payment_method.required' => 'Silakan pilih metode pembayaran.',
        ]);

        $cart = Cart::with(['items.product'])->where('user_id', Auth::id())->first();

        if (!$cart || $cart->items->isEmpty()) {
            return redirect()->route('cart.index')
                ->with('warning', 'Keranjang belanja kosong.');
        }

        try {
            $order = DB::transaction(function () use ($cart, $validated) {
                $subtotal = 0;

                // 1. Verifikasi stok dan hitung ulang total secara aman di backend
                foreach ($cart->items as $item) {
                    $product = Product::lockForUpdate()->find($item->product_id);

                    if (!$product || $item->quantity > $product->stock) {
                        throw new \Exception('Oops! Stok produk ' . ($product ? $product->name : '') . ' tidak mencukupi.');
                    }

                    $subtotal += ($product->price * $item->quantity);
                }

                $shippingCost = $subtotal >= 500000 ? 0 : 25000;
                $total = $subtotal + $shippingCost;

                // 2. Generate nomor order unik
                $orderNumber = 'ORD-' . date('Ymd') . '-' . strtoupper(Str::random(5));

                // 3. Simpan data Order
                $order = Order::create([
                    'user_id' => Auth::id(),
                    'order_number' => $orderNumber,
                    'recipient_name' => $validated['recipient_name'],
                    'phone' => $validated['phone'],
                    'address' => $validated['address'],
                    'city' => $validated['city'],
                    'postal_code' => $validated['postal_code'],
                    'notes' => $validated['notes'] ?? null,
                    'subtotal' => $subtotal,
                    'shipping_cost' => $shippingCost,
                    'total' => $total,
                    'status' => 'Menunggu Pembayaran',
                ]);

                // 4. Simpan Order Items dan kurangi stok produk
                foreach ($cart->items as $item) {
                    $product = Product::find($item->product_id);

                    $itemSubtotal = $product->price * $item->quantity;

                    OrderItem::create([
                        'order_id' => $order->id,
                        'product_id' => $product->id,
                        'product_name' => $product->name,
                        'price' => $product->price,
                        'quantity' => $item->quantity,
                        'subtotal' => $itemSubtotal,
                    ]);

                    // Kurangi stok produk
                    $product->decrement('stock', $item->quantity);
                }

                // 5. Buat entri Payment
                Payment::create([
                    'order_id' => $order->id,
                    'payment_method' => $validated['payment_method'],
                    'payment_status' => $validated['payment_method'] === 'COD' ? 'pending' : 'unpaid',
                ]);

                // 6. Kosongkan keranjang belanja
                $cart->items()->delete();

                return $order;
            });

            return redirect()->route('orders.show', $order->order_number)
                ->with('success', '✦ Pesanan berhasil dibuat! Nomor Pesanan: ' . $order->order_number);

        } catch (\Exception $e) {
            return back()->with('error', $e->getMessage())->withInput();
        }
    }
}
