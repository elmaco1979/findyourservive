<?php

namespace App\Providers;

use Illuminate\Routing\UrlGenerator;
use Illuminate\Support\ServiceProvider;
use Laravel\Dusk\DuskServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //This will allow your application to load the Laravel IDE Helper on non-production enviroments.
        if ($this->app->environment('local', 'testing')) {
            $this->app->register(\Barryvdh\LaravelIdeHelper\IdeHelperServiceProvider::class);
            $this->app->register(DuskServiceProvider::class);
        }
    }

    /**
     * Bootstrap any application services.
     *
     * @param \Illuminate\Routing\UrlGenerator $url
     *
     * @return void
     */
    public function boot(UrlGenerator $url)
    {
        if ($this->app->environment() == 'production') {
            $url->forceScheme('https');
            //Force URL to use HTTPS
        }
    }
}
