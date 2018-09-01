<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Repositories\Contracts\Products\{
    CategoryRepository,
    ProductRepository
};
use App\Repositories\Eloquent\Products\{
    EloquentCategoryRepository,
    EloquentProductRepository
};

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(CategoryRepository::class, EloquentCategoryRepository::class);

        $this->app->bind(ProductRepository::class, EloquentProductRepository::class);
    }
}