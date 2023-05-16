<?php

namespace NormanHuth\NovaBasePackage\Helpers;

use Composer\Autoload\ClassLoader;
use Illuminate\Support\Arr;
use ReflectionClass;

/**
 * Based on https://github.com/Muetze42/helpers-collection-php/blob/main/src/Composer.php
 */
class Composer
{
    /**
     * @var string|null
     */
    protected static ?string $path = null;

    /**
     * Get Project root path
     *
     * @return string
     */
    public static function getProjectPath(): string
    {
        if (self::$path) {
            return self::$path;
        }

        if (!class_exists('\Composer\Autoload\ClassLoader')) {
            return dirname(__DIR__, 5);
        }

        $reflection = new ReflectionClass(ClassLoader::class);

        return dirname($reflection->getFileName(), 3);
    }

    /**
     * Get composer.lock content as array
     *
     * @return array<string, mixed>
     */
    public static function getComposerLockData(): array
    {
        $file = static::getProjectPath().DIRECTORY_SEPARATOR.'composer.lock';

        if (!file_exists($file)) {
            return [];
        }

        return json_decode(file_get_contents($file), true);
    }

    /**
     * Return installed version composer package version via lock file.
     * Returns null if not found
     *
     * @param string $package
     * @param bool   $includeDev
     * @return string|int|null
     */
    public static function getLockedVersion(string $package, bool $includeDev = true): int|string|null
    {
        $data = static::getComposerLockData();
        $packages = data_get($data, 'packages');
        if ($includeDev) {
            $packages = array_merge($packages, data_get($data, 'packages-dev'));
        }
        $filtered = Arr::first($packages, function ($value) use ($package) {
            return !empty($value['name']) && $value['name'] == $package;
        });

        return data_get($filtered, 'version');
    }
}
