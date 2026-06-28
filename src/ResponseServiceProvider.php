<?php

namespace Fbpkg\LaravelResponse;

use Illuminate\Support\ServiceProvider;

class ResponseServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        //
    }

    public function register(): void
    {
        $this->app->singleton('laravel-response', function () {
            return new LaravelResponse();
        });
    }
}