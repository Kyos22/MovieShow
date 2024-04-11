<?php

namespace App\Providers;

use App\Services\AdminService;
use App\Services\MovieService;
use Illuminate\Support\ServiceProvider;

class MovieServiceProvider extends ServiceProvider
{
    
    public function register(): void
    {
        $this->app->bind(MovieService::class,function($app){
            return new MovieService();
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
