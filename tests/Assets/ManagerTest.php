<?php

use Roots\Acorn\Assets\Contracts\Bundle;
use Roots\Acorn\Assets\Manager;
use Roots\Acorn\Tests\TestCase;

use function Spatie\Snapshots\assertMatchesSnapshot;

uses(TestCase::class);

it('reads an assets manifest', function () {
    $assets = new Manager([
        'manifests' => [
            'theme' => [
                'path' => $this->fixture('bud_single_runtime'),
                'url' => 'https://k.jo',
                'assets' => $this->fixture('bud_single_runtime/public/manifest.json'),
            ]
        ]
    ]);

    assertMatchesSnapshot($assets->manifest('theme')->asset('app.css')->uri());
    assertMatchesSnapshot($assets->manifest('theme')->asset('app.js')->uri());
});

it('reads a bundles manifest', function () {
    $assets = new Manager([
        'manifests' => [
            'theme' => [
                'path' => $this->fixture('bud_single_runtime'),
                'url' => 'https://k.jo',
                'bundles' => $this->fixture('bud_single_runtime/public/entrypoints.json'),
            ]
        ]
    ]);

    assertMatchesSnapshot($assets->manifest('theme')->bundle('app')->js()->toJson());
    assertMatchesSnapshot($assets->manifest('theme')->bundle('editor')->js()->toJson());
    assertMatchesSnapshot($assets->manifest('theme')->bundle('editor')->js()->toJson());
});

it('reads a mix manifest', function () {
    $assets = new Manager([
        'manifests' => [
            'theme' => [
                'path' => $this->fixture('mix_no_bundle/public'),
                'url' => 'https://k.jo/public',
                'assets' => $this->fixture('mix_no_bundle/public/mix-manifest.json'),
            ]
        ]
    ]);

    assertMatchesSnapshot($assets->manifest('theme')->asset('styles/app.css')->uri());
    assertMatchesSnapshot($assets->manifest('theme')->asset('scripts/app.js')->uri());
});

it('reads a mix hot manifest', function () {
    $assets = new Manager([
        'manifests' => [
            'theme' => [
                'path' => $this->fixture('mix_no_bundle_hmr/public'),
                'url' => 'https://k.jo/public',
                'assets' => $this->fixture('mix_no_bundle_hmr/public/mix-manifest.json'),
            ]
        ]
    ]);

    assertMatchesSnapshot($assets->manifest('theme')->asset('styles/app.css')->uri());
    assertMatchesSnapshot($assets->manifest('theme')->asset('scripts/app.js')->uri());
});
