<?php

namespace App\Providers;

use App\Application\Services\TodoService;
use App\Domain\Repositories\TodoRepositoryInterface;
use App\Infrastructure\Repositories\EloquentTodoRepository;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind(TodoRepositoryInterface::class, EloquentTodoRepository::class);
        $this->app->bind(TodoService::class, function ($app) {
            return new TodoService($app->make(TodoRepositoryInterface::class));
        });
    }

    public function boot()
    {
        //
    }
}