<?php

namespace App\Providers;

use App\Domain\Services\Classes\AddressService;
use App\Domain\Services\Classes\CarService;
use App\Domain\Services\Classes\RoleService;
use App\Domain\Services\Classes\TripService;
use App\Domain\Services\Classes\UserService;
use App\Domain\Services\Interfaces\IAddressService;
use App\Domain\Services\Interfaces\ICarService;
use App\Domain\Services\Interfaces\IRoleService;
use App\Domain\Services\Interfaces\ITripService;
use App\Domain\Services\Interfaces\IUserService;
use Illuminate\Support\ServiceProvider;

class ServiceServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(IUserService::class, UserService::class);
        $this->app->bind(ICarService::class, CarService::class);
        $this->app->bind(IRoleService::class, RoleService::class);
        $this->app->bind(ITripService::class, TripService::class);
        $this->app->bind(IAddressService::class, AddressService::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
