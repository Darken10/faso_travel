<?php

namespace App\Providers;

use App\features\payement\PaymentGatewayFactory2;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->singleton(PaymentGatewayFactory2::class, function ($app) {
            return new PaymentGatewayFactory2();
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
