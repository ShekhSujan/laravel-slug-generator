<?php

namespace Sujan\LaravelSlugGenerator;

use Illuminate\Support\ServiceProvider;

class SlugGeneratorServiceProvider extends ServiceProvider
{

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind('laravel-slug-generator', function ($app) {
            return new \Sujan\LaravelSlugGenerator\SlugGenerator();
        });

        $this->mergeConfigFrom(
            __DIR__ . '/../config/laravel-slug-generator.php',
            'laravel-slug-generator'
        );
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->publishes([
            __DIR__ . '/../config/laravel-slug-generator.php' => config_path('laravel-slug-generator.php'),
        ]);
    }
}
