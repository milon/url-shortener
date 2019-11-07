<?php

namespace App\Providers;

use App\Utilities\UrlShortener;
use App\Contracts\UrlShortenerContract;
use Illuminate\Support\ServiceProvider;

class UrlShortenerServiceProvider extends ServiceProvider
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
        $this->app->bind(UrlShortenerContract::class, UrlShortener::class);
    }
}
