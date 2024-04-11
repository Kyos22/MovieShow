<?php

namespace App\Providers;

use App\Services\AdminService;
use Illuminate\Support\ServiceProvider;

class AdminServiceProvider extends ServiceProvider
{
    
    public function register(): void
    {
        $this->app->bind(AdminService::class,function($app){
            return new AdminService();
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
