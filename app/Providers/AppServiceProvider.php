<?php

namespace App\Providers;

use App\Constants\MicroserviceConstants;
use App\Services\HttpService;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->singleton('UsersService', function($app){
            return new HttpService(MicroserviceConstants::getUsersServiceUrl());
        });

        $this->app->singleton('FaciltiesService',function($app){
            return new HttpService(MicroserviceConstants::getFacilitiesServiceUrl());
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
