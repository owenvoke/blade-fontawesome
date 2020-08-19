<?php

declare(strict_types=1);

namespace OwenVoke\BladeFontAwesome;

use BladeUI\Icons\Factory;
use Illuminate\Support\ServiceProvider;
use OwenVoke\BladeFontAwesome\Commands\SyncProIconsCommand;

final class BladeFontAwesomeServiceProvider extends ServiceProvider
{
    private const PATH = 'path';

    private const PREFIX = 'prefix';

    public function register(): void
    {
        $this->callAfterResolving(Factory::class, function (Factory $factory) {
            if (is_dir($proIconsPath = resource_path('icons/blade-fontawesome'))) {
                $this->registerProIcons($factory, $proIconsPath);

                return;
            }

            $factory->add('fontawesome-brands', [
                self::PATH => __DIR__.'/../resources/svg/brands',
                self::PREFIX => 'fab',
            ]);

            $factory->add('fontawesome-regular', [
                self::PATH => __DIR__.'/../resources/svg/regular',
                self::PREFIX => 'far',
            ]);

            $factory->add('fontawesome-solid', [
                self::PATH => __DIR__.'/../resources/svg/solid',
                self::PREFIX => 'fas',
            ]);
        });
    }

    public function boot(): void
    {
        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__.'/../resources/svg' => public_path('vendor/blade-fontawesome'),
            ], 'blade-fontawesome');

            $this->commands([
                SyncProIconsCommand::class,
            ]);
        }
    }

    private function registerProIcons(Factory $factory, string $proIconsPath): void
    {
        $factory->add('fontawesome-brands', [
            self::PATH => "{$proIconsPath}/brands",
            self::PREFIX => 'fab',
        ]);

        $factory->add('fontawesome-duotone', [
            self::PATH => "{$proIconsPath}/duotone",
            self::PREFIX => 'fad',
        ]);

        $factory->add('fontawesome-light', [
            self::PATH => "{$proIconsPath}/light",
            self::PREFIX => 'fal',
        ]);

        $factory->add('fontawesome-regular', [
            self::PATH => "{$proIconsPath}/regular",
            self::PREFIX => 'far',
        ]);

        $factory->add('fontawesome-solid', [
            self::PATH => "{$proIconsPath}/solid",
            self::PREFIX => 'fas',
        ]);
    }
}
