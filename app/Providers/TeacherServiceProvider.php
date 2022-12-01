<?php

namespace App\Providers;

use App\Services\impl\TeacherServiceImpl;
use App\Services\TeacherService;
use Illuminate\Contracts\Support\DeferrableProvider;
use Illuminate\Support\ServiceProvider;

class TeacherServiceProvider extends ServiceProvider implements DeferrableProvider
{
    public array $singletons = [
        TeacherService::class => TeacherServiceImpl::class
    ];

    public function provides(): array
    {
        return [TeacherService::class];
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
