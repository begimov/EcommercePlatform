<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Services\App\Cart;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(Cart::class, function ($app) {

            $app->auth->user()->load([
                'cart.stock'
            ]);

            return new Cart($app->auth->user());
        });
    }
}
