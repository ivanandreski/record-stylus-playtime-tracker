<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Repository\AlbumCacheRepository;
use App\Repository\AlbumCacheRepositoryInterface;

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
