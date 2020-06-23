<?php

declare(strict_types=1);

namespace OwenVoke\BladeFontAwesome;

use BladeUI\Icons\Factory;
use Illuminate\Support\ServiceProvider;

final class BladeFontAwesomeServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        $this->app->make(Factory::class)->add('fontawesome-brands', [
            'path' => __DIR__.'/../resources/svg/brands',
            'prefix' => 'fab',
        ]);

        $this->app->make(Factory::class)->add('fontawesome-regular', [
            'path' => __DIR__.'/../resources/svg/regular',
            'prefix' => 'far',
        ]);

        $this->app->make(Factory::class)->add('fontawesome-solid', [
            'path' => __DIR__.'/../resources/svg/solid',
            'prefix' => 'fas',
        ]);

        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__.'/../resources/svg' => public_path('vendor/blade-fontawesome'),
            ], 'blade-fontawesome');
        }
    }
}
