<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Repositories\Contracts\Products\{
    CategoryRepository,
    ProductRepository,
    ProductVariationRepository
};
use App\Repositories\Contracts\Locations\AddressRepository;

use App\Repositories\Eloquent\Products\{
    EloquentCategoryRepository,
    EloquentProductRepository,
    EloquentProductVariationRepository
};
use App\Repositories\Eloquent\Locations\EloquentAddressRepository;

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

        $this->app->bind(ProductVariationRepository::class, EloquentProductVariationRepository::class);

        $this->app->bind(AddressRepository::class, EloquentAddressRepository::class);
    }
}