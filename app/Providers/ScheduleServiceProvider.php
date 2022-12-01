<?php

namespace App\Providers;

use App\Services\impl\ScheduleServiceImpl;
use App\Services\ScheduleService;
use Illuminate\Support\ServiceProvider;

class ScheduleServiceProvider extends ServiceProvider
{
    public array $singletons = [
        ScheduleService::class => ScheduleServiceImpl::class
    ];

    public function provides(): array
    {
        return [ScheduleService::class];
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
