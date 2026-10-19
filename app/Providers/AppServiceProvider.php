<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        require_once app_path('Helpers/helpers.php');
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        \Illuminate\Support\Facades\View::composer('*', function ($view) {
            if (\Illuminate\Support\Facades\Auth::check()) {
                $user = \Illuminate\Support\Facades\Auth::user();
                $cart = \App\Models\Cart::where('user_id', $user->id)->first();
                $count = $cart ? $cart->items()->sum('quantity') : 0;
                $view->with('navCartCount', $count);
            } else {
                $view->with('navCartCount', 0);
            }
        });
    }
}
