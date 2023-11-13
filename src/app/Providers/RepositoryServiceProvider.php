<?php

declare(strict_types=1);

namespace App\Providers;

use App\Domain\Repositories\Classes\AddressRepository;
use App\Domain\Repositories\Classes\CarRepository;
use App\Domain\Repositories\Classes\RoleRepository;
use App\Domain\Repositories\Classes\TripRepository;
use App\Domain\Repositories\Classes\UserRepository;
use App\Domain\Repositories\Interfaces\IAddressRepository;
use App\Domain\Repositories\Interfaces\ICarRepository;
use App\Domain\Repositories\Interfaces\IRoleRepository;
use App\Domain\Repositories\Interfaces\ITripRepository;
use App\Domain\Repositories\Interfaces\IUserRepository;
use App\Models\Address;
use App\Models\Car;
use App\Models\Role;
use App\Models\Trip;
use App\Models\User;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(IUserRepository::class, function (Application $app) {
            return new UserRepository($app->make(User::class));
        });
        $this->app->bind(ICarRepository::class, function (Application $app) {
            return new CarRepository($app->make(Car::class));
        });
        $this->app->bind(IRoleRepository::class, function (Application $app) {
            return new RoleRepository($app->make(Role::class));
        });
        $this->app->bind(ITripRepository::class, function (Application $app) {
            return new TripRepository($app->make(Trip::class));
        });
        $this->app->bind(IAddressRepository::class, function (Application $app) {
            return new AddressRepository($app->make(Address::class));
        });
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
