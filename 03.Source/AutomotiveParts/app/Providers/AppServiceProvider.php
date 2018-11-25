<?php

namespace App\Providers;
use App\Http\Common\Repository\AccessaryLinkRepository;
use App\Http\Common\Repository\AccessaryRepository;
use App\Http\Common\Repository\CarBrandRepository;
use App\Http\Common\Repository\CarLinkRepository;
use App\Http\Common\Repository\CarRepository;
use App\Http\Common\Repository\CatalogCarRepository;
use App\Http\Common\Repository\CatalogPartsRepository;
use App\Http\Common\Repository\Implement\AccessaryLinkRepositoryImpl;
use App\Http\Common\Repository\Implement\AccessaryRepositoryImpl;
use App\Http\Common\Repository\Implement\CarBrandRepositoryImpl;
use App\Http\Common\Repository\Implement\CarLinkRepositoryImpl;
use App\Http\Common\Repository\Implement\CarRepositoryImpl;
use App\Http\Common\Repository\Implement\CatalogCarRepositoryImpl;
use App\Http\Common\Repository\Implement\CatalogPartsRepositoryImpl;
use App\Http\Common\Repository\Implement\NationRepositoryImplement;
use App\Http\Common\Repository\Implement\PartsRepositoryImpl;
use App\Http\Common\Repository\Implement\QuotationRepositoryImpl;
use App\Http\Common\Repository\Implement\TempPriceRepositoryImpl;
use App\Http\Common\Repository\Implement\TradeMarkRepositoryImpl;
use App\Http\Common\Repository\Implement\UserRepositoryImpl;
use App\Http\Common\Repository\Implement\YearManufactureRepositoryImpl;
use App\Http\Common\Repository\NationRepository;
use App\Http\Common\Repository\PartsRepository;
use App\Http\Common\Repository\QuotationRepository;
use App\Http\Common\Repository\TempPriceRepository;
use App\Http\Common\Repository\TradeMarkRepository;
use App\Http\Common\Repository\UserRepository;
use App\Http\Common\Repository\YearManufactureRepository;
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
        if(config('app.env') === 'production') {
            \URL::forceScheme('https');
        }
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
            AccessaryRepository::class,
            AccessaryRepositoryImpl::class
        );

        $this->app->singleton(
            UserRepository::class,
            UserRepositoryImpl::class
        );

        $this->app->singleton(
            TempPriceRepository::class,
            TempPriceRepositoryImpl::class
        );

        $this->app->singleton(
            AccessaryLinkRepository::class,
            AccessaryLinkRepositoryImpl::class
        );

        $this->app->singleton(
            YearManufactureRepository::class,
            YearManufactureRepositoryImpl::class
        );

        $this->app->singleton(
            QuotationRepository::class,
            QuotationRepositoryImpl::class
        );

        $this->app->singleton(
            CarLinkRepository::class,
            CarLinkRepositoryImpl::class
        );
    }
}
