<?php

namespace App\Providers;

use App\Application\Repository\CategoryRepository;
use App\Application\Repository\ProductRepository;
use App\Application\Repository\TodoRepository;
use App\Domain\Interface\CategoryInterface;
use App\Domain\Interface\ProductInterface;
use App\Domain\Interface\TodoRepositoryInterface;
use App\Infrastructure\Repositories\EloquentTodoRepository;
use Illuminate\Support\ServiceProvider;

use App\Application\Repository\AuthRepository;
use App\Domain\Interface\AuthRepositoryInterface;

class AppServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind(TodoRepositoryInterface::class, EloquentTodoRepository::class);
        $this->app->bind(TodoRepository::class, function ($app) {
            return new TodoRepository($app->make(TodoRepositoryInterface::class));
        });

        $this->app->bind(AuthRepositoryInterface::class, AuthRepository::class);
        $this->app->bind(CategoryInterface::class, CategoryRepository::class);
        $this->app->bind(ProductInterface::class, ProductRepository::class);
    }

    public function boot()
    {
        //
    }
}
