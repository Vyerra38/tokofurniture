<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function index(): View
    {
        $totalProducts = Product::count();
        $totalCategories = Category::count();
        $totalCustomers = User::where('role', 'customer')->count();
        $todayOrdersCount = Order::whereDate('created_at', Carbon::today())->count();
        $totalOrdersCount = Order::count();
        
        $totalRevenue = Order::whereNotIn('status', ['Dibatalkan'])->sum('total');
        
        $lowStockProducts = Product::where('stock', '<=', 5)->get();

        $recentOrders = Order::with(['user', 'payment', 'items'])
            ->latest()
            ->take(6)
            ->get();

        $popularProducts = Product::with('category')
            ->orderBy('stock', 'asc')
            ->take(5)
            ->get();

        return view('admin.dashboard', compact(
            'totalProducts',
            'totalCategories',
            'totalCustomers',
            'todayOrdersCount',
            'totalOrdersCount',
            'totalRevenue',
            'lowStockProducts',
            'recentOrders',
            'popularProducts'
        ));
    }
}
