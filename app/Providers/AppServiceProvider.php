<?php

namespace App\Providers;

use App\Application\Repositories\CategoryRepository;
use App\Application\Repositories\ProductRepository;
use App\Application\Repositories\TodoRepository;
use App\Domain\Interfaces\CategoryInterface;
use App\Domain\Interfaces\ProductInterface;
use App\Domain\Interfaces\TodoRepositoryInterface;
use App\Infrastructure\Persistence\Eloquent\EloquentTodoRepository;
use Illuminate\Support\ServiceProvider;

use App\Application\Repositories\AuthRepository;
use App\Domain\Interfaces\AuthRepositoryInterface;

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
