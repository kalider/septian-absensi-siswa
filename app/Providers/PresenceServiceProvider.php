<?php

namespace App\Providers;

use App\Services\Impl\PresenceServiceImpl;
use App\Services\PresenceService;
use Illuminate\Support\ServiceProvider;

class PresenceServiceProvider extends ServiceProvider
{
    public array $singletons = [
        PresenceService::class => PresenceServiceImpl::class
    ];

    public function provides() : array
    {
        return [PresenceService::class];
    }

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
