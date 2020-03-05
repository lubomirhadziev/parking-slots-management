<?php

namespace App\Providers;

use App\Interfaces\DiscountCardsRepositoryInterface;
use App\Interfaces\RatesRepositoryInterface;
use App\Interfaces\SlotsRepositoryInterface;
use App\Interfaces\SlotsServiceInterface;
use App\Interfaces\VehicleTypesRatesRepositoryInterface;
use App\Interfaces\VehicleTypesRepositoryInterface;
use App\Repositories\DiscountCardsRepository;
use App\Repositories\RatesRepository;
use App\Repositories\SlotsRepository;
use App\Repositories\VehicleTypesRatesRepository;
use App\Repositories\VehicleTypesRepository;
use App\Services\SlotsService;
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
        $this->app->bind(VehicleTypesRepositoryInterface::class, VehicleTypesRepository::class);
        $this->app->bind(RatesRepositoryInterface::class, RatesRepository::class);
        $this->app->bind(VehicleTypesRatesRepositoryInterface::class, VehicleTypesRatesRepository::class);
        $this->app->bind(DiscountCardsRepositoryInterface::class, DiscountCardsRepository::class);
        $this->app->bind(SlotsRepositoryInterface::class, SlotsRepository::class);
        $this->app->bind(SlotsServiceInterface::class, SlotsService::class);
    }
}
