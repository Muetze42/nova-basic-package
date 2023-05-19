<?php

namespace NormanHuth\NovaBasePackage\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class FontAwesomeCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'nova-package:font-awesome';



    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Install Font Awesome free into Laravel Nova';

    /**
     * Execute the console command.
     */
    public function handle(): void
    {
        if (!is_dir(public_path('css'))) {
            File::makeDirectory(public_path('css'));
        }
        File::copy(realpath(__DIR__.'/../../../assets/font-awesome/css/fontawesome.css'), public_path('css/fontawesome.css'));
        File::copyDirectory(realpath(__DIR__.'/../../../assets/font-awesome/webfonts'), public_path('webfonts'));

        $file = resource_path('views/vendor/nova/partials/meta.blade.php');
        $meta = file_exists($file) ? file_get_contents($file)."\n" : '';
        /** @noinspection HtmlUnknownTarget */
        if (
            !str_contains($meta, '<link rel="stylesheet" href="/css/fontawesome.css">') &&
            !str_contains($meta, '<link rel="stylesheet" href="{{ asset(\'css/fontawesome.css\') }}">')
        ) {
            $this->createTarget();
            /** @noinspection HtmlUnknownTarget */
            $meta.= '<link rel="stylesheet" href="{{ asset(\'css/fontawesome.css\') }}">';-
            file_put_contents($file, $meta);
        }
    }

    protected function createTarget(): void
    {
        if (!is_dir(resource_path('views'))) {
            File::makeDirectory(resource_path('views'));
        }
        if (!is_dir(resource_path('views/vendor'))) {
            File::makeDirectory(resource_path('views/vendor'));
        }
        if (!is_dir(resource_path('views/vendor/nova'))) {
            File::makeDirectory(resource_path('views/vendor/nova'));
        }
        if (!is_dir(resource_path('views/vendor/nova/partials'))) {
            File::makeDirectory(resource_path('views/vendor/nova/partials'));
        }
    }
}
