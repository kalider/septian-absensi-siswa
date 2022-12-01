<?php

namespace App\Providers;

use App\Services\DepartmentService;
use App\Services\impl\DepartmentServiceImpl;
use Illuminate\Contracts\Support\DeferrableProvider;
use Illuminate\Support\ServiceProvider;

class DepartmentServiceProvider extends ServiceProvider implements DeferrableProvider
{
    public array $singletons = [
        DepartmentService::class => DepartmentServiceImpl::class
    ];

    public function provides(): array
    {
        return [DepartmentService::class];
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
