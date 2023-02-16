<?php

namespace App\Providers;

use App\Repository\AlbumCacheRepositoryInterface;
use Illuminate\Support\ServiceProvider;

class AlbumCacheRepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(AlbumCacheRepositoryInterface::class, AlbumCacheRepository::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
