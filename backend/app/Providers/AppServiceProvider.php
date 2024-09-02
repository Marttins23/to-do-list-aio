<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Repositories\Task\TaskRepository;
use App\Services\Task\TaskService;
use Illuminate\Support\Facades\App;

class AppServiceProvider extends ServiceProvider
{

    /**
     * Register any application services.
     */
    public function register(): void
    {
        App::bind(TaskService::class, function () {
            return new TaskService(new TaskRepository());
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
