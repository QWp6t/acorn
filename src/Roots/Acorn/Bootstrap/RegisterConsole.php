<?php

namespace Roots\Acorn\Bootstrap;

use WP_CLI;
use Illuminate\Contracts\Foundation\Application;
use Roots\Acorn\Console\Kernel;
use Symfony\Component\Console\Input\ArgvInput;
use Symfony\Component\Console\Output\ConsoleOutput;

class RegisterConsole
{
    /**
     * The application instance.
     *
     * @var \Illuminate\Contracts\Foundation\Application
     */
    protected $app;

    /**
     * Bootstrap the given application.
     *
     * @param  \Illuminate\Contracts\Foundation\Application  $app
     * @return void
     */
    public function bootstrap(Application $app)
    {
        $this->app = $app;

        if (! $this->app->runningInConsole() || ! class_exists('WP_CLI')) {
            return;
        }

        WP_CLI::add_command('acorn', function ($args, $assoc_args) {
            $args = array_merge(['acorn'], $args, collect($assoc_args)->map(function ($value, $key) {
                if ($value === true) {
                    return "--{$key}";
                }
                return "--{$key}='{$value}'";
            })->values()->all());

            $kernel = $this->app->make(Kernel::class);

            $kernel->commands();

            $status = $kernel->handle($input = new ArgvInput($args), new ConsoleOutput());

            $kernel->terminate($input, $status);

            exit($status);
        });
    }
}
