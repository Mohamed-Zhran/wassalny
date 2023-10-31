<?php

namespace App\Providers;

use App\Domain\Repositories\Classes\UserRepository;
use App\Domain\Repositories\Interfaces\IUserRepository;
use App\Domain\Services\Classes\UserService;
use App\Domain\Services\Interfaces\IUserService;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(IUserRepository::class, UserRepository::class);
        $this->app->bind(IUserService::class, UserService::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
