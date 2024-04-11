<?php

namespace App\Providers;

use App\Services\SignUpService;
use Illuminate\Support\ServiceProvider;

class SignUpServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(SignUpService::class,function($app){
            return new SignUpService();
        });
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
