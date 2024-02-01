<?php

namespace App\Providers;

use App\Contracts\Services\LocationServiceInterface;
use App\Contracts\Services\UploadServiceInterface;
use App\Services\LocationService;
use App\Services\UploadService;
use Illuminate\Support\ServiceProvider;

class ServiceServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        $this->app->bind(
            LocationServiceInterface::class,
            LocationService::class
        );
        $this->app->bind(
            UploadServiceInterface::class,
            UploadService::class
        );
    }
}
