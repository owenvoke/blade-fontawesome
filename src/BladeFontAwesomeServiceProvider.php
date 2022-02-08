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
        $factory->add('fontawesome-brands', array_merge(['path' => "{$proIconsPath}/brands"], $config->get('blade-fontawesome.brands', [])));
        $factory->add('fontawesome-regular', array_merge(['path' => "{$proIconsPath}/regular"], $config->get('blade-fontawesome.regular', [])));
        $factory->add('fontawesome-solid', array_merge(['path' => "{$proIconsPath}/solid"], $config->get('blade-fontawesome.solid', [])));

        // Pro icon sets
        $factory->add('fontawesome-light', array_merge(['path' => "{$proIconsPath}/light"], $config->get('blade-fontawesome.light', [])));
        $factory->add('fontawesome-duotone', array_merge(['path' => "{$proIconsPath}/duotone"], $config->get('blade-fontawesome.duotone', [])));
        $factory->add('fontawesome-thin', array_merge(['path' => "{$proIconsPath}/thin"], $config->get('blade-fontawesome.thin', [])));

        if (is_dir("{$proIconsPath}/sharp")) {
            $factory->add('fontawesome-sharp', array_merge(['path' => "{$proIconsPath}/sharp"], $config->get('blade-fontawesome.sharp', [])));
        }
    }
}
