<?php

namespace App\Providers;

use App\Services\impl\LessonServiceImpl;
use App\Services\LessonService;
use Illuminate\Support\ServiceProvider;

class LessonServiceProvider extends ServiceProvider
{
    public array $singletons = [
        LessonService::class => LessonServiceImpl::class
    ];

    public function provides(): array
    {
        return [LessonService::class];
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
