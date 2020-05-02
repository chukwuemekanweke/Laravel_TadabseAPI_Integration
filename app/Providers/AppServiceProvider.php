<?php

namespace App\Providers;
use GuzzleHttp\Client;

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
        // call the baseURL from .env file
        $baseURL = env('API_BASE_URL');

        $this->app->singleton('GuzzleHttp\Client', function($api) use ($baseURL) {

            return new Client([
                'base_uri' => $baseURL
            ]);
        });
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
