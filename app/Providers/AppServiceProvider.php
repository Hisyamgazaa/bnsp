<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\CartItem;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        view()->composer('*', function ($view) {
            if (Auth::check()) {
                $cartItemsCount = CartItem::where('user_id', Auth::id())
                    ->sum('quantity');
                $cartTotal = CartItem::where('user_id', Auth::id())
                    ->sum(DB::raw('quantity'));

                $view->with([
                    'cartItemsCount' => $cartItemsCount,
                    'cartTotal' => $cartTotal
                ]);
            } else {
                $view->with([
                    'cartItemsCount' => 0,
                    'cartTotal' => 0
                ]);
            }
        });
    }
}
