<?php

namespace App\Providers;

use App\Services\Contracts\UplinkServiceContract;
use App\Services\CurlUplinkService;
use App\Utils\ActionValidator;
use App\Utils\Contracts\ActionValidatorContract;
use App\Utils\Contracts\ResponseWrapperContract;
use App\Utils\ResponseWrapper;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(UplinkServiceContract::class, CurlUplinkService::class);

        $this->app->bind(ResponseWrapperContract::class, ResponseWrapper::class);

        $this->app->bind(ActionValidatorContract::class, fn () => new ActionValidator());
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
