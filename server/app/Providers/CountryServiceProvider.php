<?php

namespace App\Providers;

use App\Service\CountryService;
use Illuminate\Support\ServiceProvider;

class CountryServiceProvider extends ServiceProvider
{
    
    public function register(): void
    {
        $this->app->bind(CountryService::class,function($app){
            return new CountryService();
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
