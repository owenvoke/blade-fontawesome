<?php

declare(strict_types=1);

namespace OwenVoke\BladeFontAwesome;

use BladeUI\Icons\Factory;
use Illuminate\Contracts\Config\Repository;
use Illuminate\Contracts\Container\Container;
use Illuminate\Support\ServiceProvider;
use OwenVoke\BladeFontAwesome\Commands\SyncIconsCommand;

final class BladeFontAwesomeServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->registerConfig();

        $this->callAfterResolving(Factory::class, function (Factory $factory, Container $container) {
            $config = $container->make('config');

            if (is_dir($proIconsPath = resource_path('icons/blade-fontawesome'))) {
                $this->registerProIcons($factory, $proIconsPath, $config);

                return;
            }

            $factory->add('fontawesome-brands', array_merge(['path' => __DIR__.'/../resources/svg/brands'], $config->get('blade-fontawesome.brands', [])));
            $factory->add('fontawesome-regular', array_merge(['path' => __DIR__.'/../resources/svg/regular'], $config->get('blade-fontawesome.regular', [])));
            $factory->add('fontawesome-solid', array_merge(['path' => __DIR__.'/../resources/svg/solid'], $config->get('blade-fontawesome.solid', [])));
        });
    }

    private function registerConfig(): void
    {
        $this->mergeConfigFrom(__DIR__.'/../config/blade-fontawesome.php', 'blade-fontawesome');
    }

    public function boot(): void
    {
        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__.'/../resources/svg' => public_path('vendor/blade-fontawesome'),
            ], 'blade-fontawesome');

            $this->publishes([
                __DIR__.'/../config/blade-fontawesome.php' => $this->app->configPath('blade-fontawesome.php'),
            ], 'blade-fontawesome-config');

            $this->commands([
                SyncIconsCommand::class,
            ]);
        }
    }

    private function registerProIcons(Factory $factory, string $proIconsPath, Repository $config): void
    {
        $addProIconSet = function (string $name) use ($factory, $proIconsPath, $config): void {
            if (! is_dir("{$proIconsPath}/{$name}")) {
                return;
            }

            $factory->add("fontawesome-{$name}", array_merge(['path' => "{$proIconsPath}/{$name}"], $config->get("blade-fontawesome.{$name}", [])));
        };

        // Standard icon sets
        $addProIconSet('brands');
        $addProIconSet('regular');
        $addProIconSet('solid');

        // Pro icon sets
        $addProIconSet('light');
        $addProIconSet('duotone');
        $addProIconSet('thin');

        // Sharp icon sets
        $addProIconSet('sharp-light');
        $addProIconSet('sharp-regular');
        $addProIconSet('sharp-solid');
        $addProIconSet('sharp-duotone-solid');
        $addProIconSet('sharp-thin');

        // Custom icon sets
        $addProIconSet('custom');
    }
}
