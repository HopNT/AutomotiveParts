<?php

namespace App\Providers;
use App\Http\Common\Repository\AccessayRepository;
use App\Http\Common\Repository\CarBrandRepository;
use App\Http\Common\Repository\CarRepository;
use App\Http\Common\Repository\CatalogCarRepository;
use App\Http\Common\Repository\CatalogPartsRepository;
use App\Http\Common\Repository\Implement\AccessaryRepositoryImpl;
use App\Http\Common\Repository\Implement\CarBrandRepositoryImpl;
use App\Http\Common\Repository\Implement\CarRepositoryImpl;
use App\Http\Common\Repository\Implement\CatalogCarRepositoryImpl;
use App\Http\Common\Repository\Implement\CatalogPartsRepositoryImpl;
use App\Http\Common\Repository\Implement\NationRepositoryImplement;
use App\Http\Common\Repository\Implement\PartsRepositoryImpl;
use App\Http\Common\Repository\Implement\TradeMarkRepositoryImpl;
use App\Http\Common\Repository\NationRepository;
use App\Http\Common\Repository\PartsRepository;
use App\Http\Common\Repository\TradeMarkRepository;
use Illuminate\Support\ServiceProvider;
class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(
            NationRepository::class,
            NationRepositoryImplement::class
        );

        $this->app->singleton(
            CarBrandRepository::class,
            CarBrandRepositoryImpl::class
        );

        $this->app->singleton(
            CatalogCarRepository::class,
            CatalogCarRepositoryImpl::class
        );

        $this->app->singleton(
            CarRepository::class,
            CarRepositoryImpl::class
        );

        $this->app->singleton(
            CatalogPartsRepository::class,
            CatalogPartsRepositoryImpl::class
        );

        $this->app->singleton(
            PartsRepository::class,
            PartsRepositoryImpl::class
        );

        $this->app->singleton(
            TradeMarkRepository::class,
            TradeMarkRepositoryImpl::class
        );

        $this->app->singleton(
            AccessayRepository::class,
            AccessaryRepositoryImpl::class
        );
    }
}
