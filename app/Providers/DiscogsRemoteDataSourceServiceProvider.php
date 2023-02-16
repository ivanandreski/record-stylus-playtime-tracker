<?php

namespace App\Providers;

use App\Repository\DiscogsRemoteDataSource;
use App\Repository\DiscogsRemoteDataSourceInterface;
use Illuminate\Support\ServiceProvider;

class DiscogsRemoteDataSourceServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(DiscogsRemoteDataSourceInterface::class, DiscogsRemoteDataSource::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
