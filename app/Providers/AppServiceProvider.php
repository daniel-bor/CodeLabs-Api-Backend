<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Validator;

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
        Validator::extend('codigo_solicitud', function ($attribute, $value, $parameters, $validator) {
            // La lógica de validación personalizada aquí
            return preg_match('/^EX-\d{8}-[A-Za-z0-9]{5}$/', $value);
        });
    }
}
