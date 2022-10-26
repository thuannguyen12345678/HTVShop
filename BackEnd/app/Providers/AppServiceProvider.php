<?php

namespace App\Providers;

use App\Repositories\Customer\CustomerRepository;
use App\Repositories\Customer\CustomerRepositoryInterface;
use App\Repositories\Order\OrderRepository;
use App\Repositories\Order\OrderRepositoryInterface;
use App\Services\Customer\CustomerService;
use App\Services\Customer\CustomerServiceInterface;
use App\Services\Order\OrderService;
use App\Services\Order\OrderServiceInterface;
use App\Repositories\Brand\BrandRepository;
use App\Repositories\Brand\BrandRepositoryInterface;
use App\Repositories\Category\CategoryRepository;
use App\Repositories\Category\CategoryRepositoryInterface;
use App\Services\Brand\BrandService;
use App\Services\Brand\BrandServiceInterface;
use App\Services\Category\CategoryService;
use App\Services\Category\CategoryServiceInterface;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //Customer
        $this->app->singleton(CustomerRepositoryInterface::class, CustomerRepository::class);
        $this->app->singleton(CustomerServiceInterface::class, CustomerService::class);
        //Order
        $this->app->bind(OrderRepositoryInterface::class, OrderRepository::class);
        $this->app->bind(OrderServiceInterface::class, OrderService::class);
        // register category
        $this->app->bind(CategoryRepositoryInterface::class, CategoryRepository::class);
        $this->app->bind(CategoryServiceInterface::class, CategoryService::class);
        // register brand
        $this->app->singleton(BrandRepositoryInterface::class, BrandRepository::class);
        $this->app->singleton(BrandServiceInterface::class, BrandService::class);
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Paginator::useBootstrapFive();
        Paginator::useBootstrapFour();
        Schema::defaultStringLength(191);
    }
}
