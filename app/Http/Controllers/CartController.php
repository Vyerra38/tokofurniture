<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Product;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class CartController extends Controller
{
    public function index(): View
    {
        $cart = Cart::with(['items.product.category'])
            ->firstOrCreate(['user_id' => Auth::id()]);

        return view('cart.index', compact('cart'));
    }

    public function add(Request $request, Product $product): RedirectResponse
    {
        $request->validate([
            'quantity' => ['nullable', 'integer', 'min:1'],
        ]);

        $quantity = (int) $request->input('quantity', 1);

        if ($product->stock <= 0) {
            return back()->with('error', 'Oops! Produk ' . $product->name . ' sedang habis.');
        }

        $cart = Cart::firstOrCreate(['user_id' => Auth::id()]);

        $item = CartItem::where('cart_id', $cart->id)
            ->where('product_id', $product->id)
            ->first();

        $newQuantity = $item ? $item->quantity + $quantity : $quantity;

        if ($newQuantity > $product->stock) {
            return back()->with('error', 'Oops! Jumlah pesanan melebihi stok yang tersedia (' . $product->stock . ' pcs).');
        }

        if ($item) {
            $item->update(['quantity' => $newQuantity]);
        } else {
            CartItem::create([
                'cart_id' => $cart->id,
                'product_id' => $product->id,
                'quantity' => $newQuantity,
            ]);
        }

        if ($request->boolean('buy_now')) {
            return redirect()->route('checkout.index');
        }

        return back()->with('success', '✦ ' . $product->name . ' berhasil ditambahkan ke keranjang!');
    }

    public function update(Request $request, CartItem $item): RedirectResponse
    {
        // Pastikan item milik cart user saat ini
        if ($item->cart->user_id !== Auth::id()) {
            abort(403);
        }

        $request->validate([
            'quantity' => ['required', 'integer', 'min:1'],
        ]);

        $quantity = (int) $request->input('quantity');

        if ($quantity > $item->product->stock) {
            return back()->with('error', 'Oops! Stok produk ' . $item->product->name . ' hanya tersisa ' . $item->product->stock . ' pcs.');
        }

        $item->update(['quantity' => $quantity]);

        return back()->with('success', '✦ Jumlah produk berhasil diperbarui!');
    }

    public function remove(CartItem $item): RedirectResponse
    {
        // Pastikan item milik cart user saat ini
        if ($item->cart->user_id !== Auth::id()) {
            abort(403);
        }

        $productName = $item->product->name;
        $item->delete();

        return back()->with('info', '✦ ' . $productName . ' telah dihapus dari keranjang.');
    }
}
