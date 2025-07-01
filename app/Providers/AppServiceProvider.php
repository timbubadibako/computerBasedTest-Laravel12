<?php

namespace App\Providers;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\URL; // <-- PENTING: Import Facade URL
use Illuminate\Http\Request;       // <-- PENTING: Import Request

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
       if ($this->app->environment('local')) {

            // Cek apakah ada header khusus yang dikirim oleh Ngrok
            $ngrokHeader = request()->header('X-Forwarded-Host');

            if ($ngrokHeader) {
                // Paksa Laravel untuk menggunakan skema HTTPS
                URL::forceScheme('https');
                // Paksa Laravel untuk menggunakan URL dari Ngrok sebagai root URL
                URL::forceRootUrl('https://' . $ngrokHeader);
            }
        }
    }
}
