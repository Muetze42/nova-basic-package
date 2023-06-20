<?php

namespace NormanHuth\NovaBasePackage;

use NormanHuth\NovaBasePackage\Helpers\Composer;
use ReflectionClass;

trait ServiceProviderTrait
{
    /**
     * Add additional data to the output of the "about" command.
     *
     * @param string $section
     * @return void
     */
    protected function addAbout(string $section = 'Nova Packages'): void
    {
        if (!class_exists(\Illuminate\Foundation\Console\AboutCommand::class)) {
            return;
        }

        if (!$this->app->runningInConsole()) {
            return;
        }

        $reflection = new ReflectionClass(__CLASS__);
        $composerJson = dirname($reflection->getFileName(), 2).DIRECTORY_SEPARATOR.'composer.json';

        if (!file_exists($composerJson)) {
            return;
        }

        $contents = json_decode(file_get_contents($composerJson), true);
        $name = data_get($contents, 'name');

        if (!$name) {
            return;
        }

        \Illuminate\Foundation\Console\AboutCommand::add($section, fn () => [$name => Composer::getLockedVersion($name)]);
    }
}
