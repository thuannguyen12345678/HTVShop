<?php

namespace App\Providers;
use App\Repositories\Api\Brand\BrandApiRepository;
use App\Repositories\api\Brand\BrandApiRepositoryInterface;
use App\Repositories\Api\Product\FeProductRepository;
use App\Repositories\Api\Product\FeProductRepositoryInterface;
use App\Repositories\Banner\BannerRepository;
use App\Repositories\Banner\BannerRepositoryInterface;
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
use App\Repositories\Group\GroupRepository;
use App\Repositories\Group\GroupRepositoryInterface;
use App\Repositories\User\UserRepository;
use App\Repositories\User\UserRepositoryInterface;
use App\Services\User\UserService;
use App\Services\User\UserServiceInterface;
use App\Repositories\Product\ProductRepository;
use App\Repositories\Product\ProductRepositoryInterface;
use App\Services\Api\Brand\BrandApiService;
use App\Services\Api\Brand\BrandApiServiceInterface;
use App\Services\Api\Product\FeProductService;
use App\Services\Api\Product\FeProductServiceInterface;
use App\Services\Banner\BannerService;
use App\Services\Banner\BannerServiceInterface;
use App\Services\Brand\BrandService;
use App\Services\Brand\BrandServiceInterface;
use App\Services\Category\CategoryService;
use App\Services\Category\CategoryServiceInterface;
use App\Services\Group\GroupService;
use App\Services\Group\GroupServiceInterface;
use App\Services\Product\ProductService;
use App\Services\Product\ProductServiceInterface;

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

        $this->app->bind(UserRepositoryInterface::class, UserRepository::class);
        $this->app->bind(UserServiceInterface::class, UserService::class);

        // register brand
        $this->app->singleton(BrandRepositoryInterface::class, BrandRepository::class);
        $this->app->singleton(BrandServiceInterface::class, BrandService::class);
          // register product
          $this->app->bind(ProductRepositoryInterface::class, ProductRepository::class);
          $this->app->bind(ProductServiceInterface::class, ProductService::class);
        //Banner
        $this->app->bind(BannerRepositoryInterface::class, BannerRepository::class);
        $this->app->bind(BannerServiceInterface::class, BannerService::class);

        $this->app->bind(GroupRepositoryInterface::class, GroupRepository::class);
        $this->app->bind(GroupServiceInterface::class, GroupService::class);


    //frontend:
        //brand
        $this->app->bind(BrandApiRepositoryInterface::class, BrandApiRepository::class);
        $this->app->bind(BrandApiServiceInterface::class, BrandApiService::class);
        $this->app->bind(FeProductRepositoryInterface::class, FeProductRepository::class);
        $this->app->bind(FeProductServiceInterface::class, FeProductService::class);
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
