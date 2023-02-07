<?php

namespace App\Providers;

use Illuminate\Pagination\Paginator;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
      $this->app->singleton(
        \App\Repositories\Product\ProductRepositoryInterface::class,
        \App\Repositories\Product\ProductRepository::class,
      );

      $this->app->singleton(
        \App\Repositories\Category\CategoryRepositoryInterface::class,
        \App\Repositories\Category\CategoryRepository::class,
      );

      $this->app->singleton(
        \App\Repositories\Attribute\AttributeRepositoryInterface::class,
        \App\Repositories\Attribute\AttributeRepository::class,
      );

      $this->app->singleton(
        \App\Repositories\NewCategory\NewCategoryRepositoryinterface::class,
        \App\Repositories\NewCategory\NewCategoryRepository::class,
      );

      $this->app->singleton(
        \App\Repositories\News\NewRepositoryInterface::class,
        \App\Repositories\News\NewRepository::class,
      );

      $this->app->singleton(
        \App\Repositories\Order\OrderRepositoryInterface::class,
        \App\Repositories\Order\OrderRepository::class,
      );

      $this->app->singleton(
        \App\Repositories\OrderItem\OrderItemRepositoryInterface::class,
        \App\Repositories\OrderItem\OrderItemRepository::class,
      );

      $this->app->singleton(
        \App\Repositories\Permission\PermissionRepositoryInterface::class,
        \App\Repositories\Permission\PermissionRepository::class,
      );

      $this->app->singleton(
        \App\Repositories\ProductGallery\ProductGalleryRepositoryInterface::class,
        \App\Repositories\ProductGallery\ProductGalleryRepository::class,
      );

      $this->app->singleton(
        \App\Repositories\Role\RoleRepositoryInterface::class,
        \App\Repositories\Role\RoleRepository::class,
      );

      $this->app->singleton(
        \App\Repositories\User\UserRepositoryInterface::class,
        \App\Repositories\User\UserRepository::class,
      );
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
      Paginator::useBootstrap();
    }
}
