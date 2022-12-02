<?php

namespace App\Providers;

use App\Services\impl\PresenceReportServiceImpl;
use App\Services\PresenceReportService;
use Illuminate\Support\ServiceProvider;

class PresenceReportServiceProvider extends ServiceProvider
{
    public array $singletons = [
        PresenceReportService::class => PresenceReportServiceImpl::class
    ];

    public function provides() : array
    {
        return [PresenceReportService::class];
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
