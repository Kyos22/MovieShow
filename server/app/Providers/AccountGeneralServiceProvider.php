<?php

namespace App\Providers;

use App\Services\AccountGeneralService;
use Illuminate\Support\ServiceProvider;

class AccountGeneralServiceProvider extends ServiceProvider
{
    
    public function register(): void
    {
        $this->app->bind(AccountGeneralService::class,function($app){
            return new AccountGeneralService();
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
