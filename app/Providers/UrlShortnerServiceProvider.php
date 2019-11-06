<?php

namespace App\Providers;

use App\Utilities\UrlShortner;
use App\Contract\UrlShortnerContract;
use Illuminate\Support\ServiceProvider;

class UrlShortnerServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->app->bind(UrlShortnerContract::class, UrlShortner::class);
    }
}
