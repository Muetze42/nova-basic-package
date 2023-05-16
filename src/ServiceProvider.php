<?php

namespace NormanHuth\NovaBasePackage;

use Illuminate\Support\ServiceProvider as Provider;

class ServiceProvider extends Provider
{
    use ServiceProviderTrait;

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot(): void
    {
        if (class_exists(\Laravel\Nova\Events\ServingNova::class) && class_exists(\Laravel\Nova\Nova::class)) {
            \Laravel\Nova\Nova::serving(function (\Laravel\Nova\Events\ServingNova $event) {
                \Laravel\Nova\Nova::style('nova-basic-package-styles', __DIR__.'/../dist/css/package.css');
            });
        }

        $this->addAbout();
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register(): void
    {
        //
    }
}
