<?php

declare(strict_types=1);

namespace App\Providers;

use App\Domain\Responder\Classes\ApiHttpResponder;
use App\Domain\Responder\Interfaces\IApiHttpResponder;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public $singletons = [
        IApiHttpResponder::class => ApiHttpResponder::class
    ];
    /**
     * Register any application services.
     */
    public function register(): void
    {
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
