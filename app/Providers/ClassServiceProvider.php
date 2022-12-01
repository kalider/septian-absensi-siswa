<?php

namespace App\Providers;

use App\Services\ClassService;
use App\Services\impl\ClassServiceImpl;
use Illuminate\Contracts\Support\DeferrableProvider;
use Illuminate\Support\ServiceProvider;

class ClassServiceProvider extends ServiceProvider implements DeferrableProvider
{

    public array $singletons = [
        ClassService::class => ClassServiceImpl::class
    ];

    public function provides(): array
    {
        return [ClassService::class];
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
