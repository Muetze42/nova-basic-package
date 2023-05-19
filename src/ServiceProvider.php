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

        if ($this->app->runningInConsole()) {
            $this->commands($this->getCommands());
        }
    }

    /**
     * Get all package commands.
     *
     * @return array
     */
    protected function getCommands(): array
    {
        return array_filter(array_map(function ($item) {
            return '\\'.__NAMESPACE__.'\\Console\\Commands\\'.pathinfo($item, PATHINFO_FILENAME);
        }, glob(__DIR__.'/Console/Commands/*.php')), function ($item) {
            return class_basename($item) != 'Command';
        });
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
