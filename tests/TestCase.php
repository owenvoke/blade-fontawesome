<?php

namespace OwenVoke\BladeFontAwesome\Tests;

use BladeUI\Icons\BladeIconsServiceProvider;
use Orchestra\Testbench;
use OwenVoke\BladeFontAwesome\BladeFontAwesomeServiceProvider;

class TestCase extends Testbench\TestCase
{
    protected function getPackageProviders($app): array
    {
        return [
            BladeIconsServiceProvider::class,
            BladeFontAwesomeServiceProvider::class,
        ];
    }
}
