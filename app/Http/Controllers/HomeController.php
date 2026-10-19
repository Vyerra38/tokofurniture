<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\View\View;

class HomeController extends Controller
{
    public function index(): View
    {
        $categories = Category::withCount('products')->get();

        $featuredProducts = Product::active()
            ->featured()
            ->with('category')
            ->take(8)
            ->get();

        $newArrivals = Product::active()
            ->with('category')
            ->latest()
            ->take(4)
            ->get();

        $bestSellers = Product::active()
            ->with('category')
            ->inRandomOrder()
            ->take(4)
            ->get();

        return view('home', compact('categories', 'featuredProducts', 'newArrivals', 'bestSellers'));
    }

    public function about(): View
    {
        return view('about');
    }

    public function contact(): View
    {
        return view('contact');
    }
}
