<?php

namespace NormanHuth\NovaBasePackage;

use Illuminate\Support\ServiceProvider as Provider;
use Laravel\Nova\Events\ServingNova;
use Laravel\Nova\Nova;

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
        Nova::serving(function (ServingNova $event) {
            Nova::style('nova-basic-package-styles', __DIR__.'/../dist/css/package.css');
        });

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
