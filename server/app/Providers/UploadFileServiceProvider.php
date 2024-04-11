<?php

namespace App\Providers;

use App\Services\FileUploadService;
use Illuminate\Support\ServiceProvider;

class UploadFileServiceProvider extends ServiceProvider
{
    
    public function register(): void
    {
        $this->app->bind(FileUploadService::class,function($app){
            return new FileUploadService();
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
