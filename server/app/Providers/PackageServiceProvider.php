<?php

namespace App\Providers;

use App\Services\PackageService;
use Illuminate\Support\ServiceProvider;

class PackageServiceProvider extends ServiceProvider
{
    
    public function register(): void
    {
        $this->app->bind(PackageService::class,function($app){
            return new PackageService();
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
