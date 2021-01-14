<?php

namespace Roots\Acorn;

use Illuminate\Foundation\ComposerScripts as FoundationComposerScripts;
use Roots\Acorn\Console\Console;
use Roots\Acorn\Filesystem\Filesystem;

class ComposerScripts extends FoundationComposerScripts
{
    /**
     * Clear the cached Laravel bootstrapping files.
     *
     * @return void
     */
    protected static function clearCompiled()
    {
        // $laravel = new Application(getcwd());
        //
        // if (is_file($servicesPath = $laravel->getCachedServicesPath())) {
        //     @unlink($servicesPath);
        // }
        //
        // if (is_file($packagesPath = $laravel->getCachedPackagesPath())) {
        //     @unlink($packagesPath);
        // }

        $console = new Console(new Filesystem(), getcwd());

        $console->packageClear();
    }
}
