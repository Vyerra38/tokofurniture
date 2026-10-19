<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Product;
use Carbon\Carbon;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class OrderController extends Controller
{
    public function index(Request $request): View
    {
        $query = Order::with(['user', 'payment', 'items']);

        if ($request->filled('status')) {
            $query->where('status', $request->input('status'));
        }

        if ($request->filled('search')) {
            $search = $request->input('search');
            $query->where(function ($q) use ($search) {
                $q->where('order_number', 'like', "%{$search}%")
                  ->orWhere('recipient_name', 'like', "%{$search}%")
                  ->orWhere('phone', 'like', "%{$search}%");
            });
        }

        $orders = $query->latest()->paginate(10)->withQueryString();

        return view('admin.orders.index', compact('orders'));
    }

    public function show(Order $order): View
    {
        $order->load(['user', 'payment', 'items.product']);
        return view('admin.orders.show', compact('order'));
    }

    public function updateStatus(Request $request, Order $order): RedirectResponse
    {
        $validated = $request->validate([
            'status' => ['required', 'in:Menunggu Pembayaran,Diproses,Dikemas,Dikirim,Selesai,Dibatalkan'],
            'payment_status' => ['nullable', 'in:unpaid,pending,paid,failed'],
        ]);

        $oldStatus = $order->status;
        $newStatus = $validated['status'];

        DB::transaction(function () use ($order, $oldStatus, $newStatus, $validated) {
            // Jika status diubah menjadi Dibatalkan dan sebelumnya bukan Dibatalkan, kembalikan stok
            if ($newStatus === 'Dibatalkan' && $oldStatus !== 'Dibatalkan') {
                foreach ($order->items as $item) {
                    if ($item->product_id) {
                        Product::where('id', $item->product_id)->increment('stock', $item->quantity);
                    }
                }
            }

            // Jika sebelumnya Dibatalkan lalu diaktifkan kembali, kurangi stok lagi jika mencukupi
            if ($oldStatus === 'Dibatalkan' && $newStatus !== 'Dibatalkan') {
                foreach ($order->items as $item) {
                    if ($item->product_id) {
                        Product::where('id', $item->product_id)->decrement('stock', $item->quantity);
                    }
                }
            }

            $order->update(['status' => $newStatus]);

            if ($order->payment && !empty($validated['payment_status'])) {
                $updateData = ['payment_status' => $validated['payment_status']];
                if ($validated['payment_status'] === 'paid' && !$order->payment->paid_at) {
                    $updateData['paid_at'] = Carbon::now();
                }
                $order->payment->update($updateData);
            }
        });

        return back()->with('success', '✦ Status pesanan #' . $order->order_number . ' berhasil diperbarui ke: ' . $newStatus);
    }
}
