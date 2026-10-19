<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class OrderController extends Controller
{
    public function index(): View
    {
        $orders = Order::with(['items', 'payment'])
            ->where('user_id', Auth::id())
            ->latest()
            ->paginate(10);

        return view('orders.index', compact('orders'));
    }

    public function show(string $orderNumber): View
    {
        $order = Order::with(['items.product', 'payment', 'user'])
            ->where('user_id', Auth::id())
            ->where('order_number', $orderNumber)
            ->firstOrFail();

        return view('orders.show', compact('order'));
    }

    public function cancel(string $orderNumber): RedirectResponse
    {
        $order = Order::with('items')
            ->where('user_id', Auth::id())
            ->where('order_number', $orderNumber)
            ->firstOrFail();

        if ($order->status !== 'Menunggu Pembayaran') {
            return back()->with('error', 'Pesanan ini tidak dapat dibatalkan karena sudah diproses.');
        }

        DB::transaction(function () use ($order) {
            $order->update(['status' => 'Dibatalkan']);

            if ($order->payment) {
                $order->payment->update(['payment_status' => 'failed']);
            }

            // Kembalikan stok produk
            foreach ($order->items as $item) {
                if ($item->product_id) {
                    Product::where('id', $item->product_id)->increment('stock', $item->quantity);
                }
            }
        });

        return back()->with('info', '✦ Pesanan #' . $order->order_number . ' telah dibatalkan dan stok dikembalikan.');
    }
}
