<?php

namespace App\Providers;

use App\Services\impl\StudentServiceImpl;
use App\Services\StudentService;
use Illuminate\Contracts\Support\DeferrableProvider;
use Illuminate\Support\ServiceProvider;

class StudentServiceProvider extends ServiceProvider implements DeferrableProvider
{
    public array $singletons = [
        StudentService::class => StudentServiceImpl::class
    ];

    public function provides(): array
    {
        return [StudentService::class];
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
