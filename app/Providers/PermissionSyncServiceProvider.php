<?php

namespace App\Providers;

use App\Services\PermissionSyncService;
use Illuminate\Support\ServiceProvider;

class PermissionSyncServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->singleton(PermissionSyncService::class, function ($app) {
            return new PermissionSyncService();
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
