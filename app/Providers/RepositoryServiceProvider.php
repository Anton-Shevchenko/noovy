<?php

namespace App\Providers;

use App\Contracts\Repositories\LocationRepositoryInterface;
use App\Repositories\LocationRepository;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
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
            LocationRepositoryInterface::class,
            LocationRepository::class
        );
    }
}
