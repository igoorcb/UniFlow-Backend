<?php

namespace App\Providers;

use App\Application\Repository\CreateCategoryRepository;
use App\Application\Repository\CreateProductRepository;
use App\Application\Repository\TodoRepository;
use App\Domain\Repositories\CreateCategoryInterface;
use App\Domain\Repositories\CreateProductInterface;
use App\Domain\Repositories\TodoRepositoryInterface;
use App\Infrastructure\Repositories\EloquentTodoRepository;
use Illuminate\Support\ServiceProvider;

use App\Application\Repository\AuthRepository;
use App\Domain\Repositories\AuthRepositoryInterface;

class AppServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind(TodoRepositoryInterface::class, EloquentTodoRepository::class);
        $this->app->bind(TodoRepository::class, function ($app) {
            return new TodoRepository($app->make(TodoRepositoryInterface::class));
        });

        $this->app->bind(AuthRepositoryInterface::class, AuthRepository::class);
        $this->app->bind(CreateCategoryInterface::class, CreateCategoryRepository::class);
        $this->app->bind(CreateProductInterface::class, CreateProductRepository::class);
    }

    public function boot()
    {
        //
    }
}
