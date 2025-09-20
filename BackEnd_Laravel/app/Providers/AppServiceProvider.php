<?php

namespace App\Providers;

use App\Contracts\PaymentInterface;
use Illuminate\Support\ServiceProvider;
use App\Services\PaymentGateways\PayPalGateway;
use App\Services\PaymentGateways\StripeGateway;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
        $this->app->bind(PaymentInterface::class, function ($app) {
            // Get payment method from config or request
            $method = request()->input('payment_method') 
                   ?? config('payment.default');
            
            return match($method) {
                'paypal' => new PayPalGateway(),
                default => new StripeGateway(),
            };
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
