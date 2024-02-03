<?php

namespace App\Providers;

use App\Contracts\Services\GoogleMapServiceInterface;
use App\Contracts\Services\LocationServiceInterface;
use App\Contracts\Services\UploadServiceInterface;
use App\Services\GoogleMapService;
use App\Services\LocationService;
use App\Services\UploadLocationService;
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
            UploadLocationService::class
        );

        $this->app->bind(
            GoogleMapServiceInterface::class,
            GoogleMapService::class
        );
    }
}
