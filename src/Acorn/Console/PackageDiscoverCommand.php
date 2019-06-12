<?php

namespace Roots\Acorn\Console;

use Illuminate\Contracts\Foundation\Application;
use Illuminate\Filesystem\Filesystem;
use Roots\Acorn\PackageManifest;

class PackageDiscoverCommand extends Command
{
    /** @var \Roots\Acorn\PackageManifest */
    protected $manifest;

    public function __construct(Filesystem $files, Application $app, PackageManifest $manifest)
    {
        parent::__construct($files, $app);

        $this->manifest = $manifest;
    }

    /**
     * Discover and publish vendor packages.
     *
     * ## EXAMPLES
     *
     *     wp acorn package:discover
     *
     * @return void
     */
    public function __invoke($args, $assoc_args)
    {
        $this->manifest->build();

        foreach (array_keys($this->manifest->manifest) as $package) {
            $this->info("Discovered Package: {$package}");
        }

        $this->success('Package manifest generated successfully.');
    }
}
