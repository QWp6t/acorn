<?php

namespace Roots\Acorn\Console\Commands;

use Illuminate\Support\Str;
use Illuminate\Console\GeneratorCommand as GeneratorCommandBase;

abstract class GeneratorCommand extends GeneratorCommandBase
{
    use \Roots\Acorn\Console\Concerns\ClearLine;
    use \Roots\Acorn\Console\Concerns\Exec;
    use \Roots\Acorn\Console\Concerns\Task;
    use \Roots\Acorn\Console\Concerns\Title;

    /**
     * The application implementation.
     *
     * @var \Roots\Acorn\Application
     */
    protected $app;

    /**
     * {@inheritdoc}
     */
    public function setLaravel($laravel)
    {
        parent::setLaravel($this->app = $laravel);
    }

    /**
     * {@inheritdoc}
     */
    protected function replaceClass($stub, $name)
    {
        $class = str_replace($this->getNamespace($name) . '\\', '', $name);
        $class = str_replace(
            ['DummySlug', 'DummyCamel', 'DummySnake'],
            [Str::slug($class), Str::camel($class), Str::snake($class)],
            $stub
        );

        return str_replace(
            ['{{ class }}', '{{class}}'],
            $class,
            $stub
        );
    }

    /**
     * {@inheritdoc}
     */
    protected function getNameInput()
    {
        return trim(
            is_array($name = $this->argument('name')) ? array_pop($name) : $name
        );
    }

    /**
     * {@inheritdoc}
     */
    protected function userProviderModel()
    {
        //
    }
}
