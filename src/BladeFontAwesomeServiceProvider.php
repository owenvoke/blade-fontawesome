<?php

declare(strict_types=1);

namespace OwenVoke\BladeFontAwesome;

use BladeUI\Icons\Factory;
use Illuminate\Contracts\Config\Repository as ConfigRepository;
use Illuminate\Contracts\Container\Container;
use Illuminate\Support\ServiceProvider;
use OwenVoke\BladeFontAwesome\Commands\SyncIconsCommand;

final class BladeFontAwesomeServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->registerConfig();

        $this->callAfterResolving(Factory::class, function (Factory $factory, Container $container) {
            /** @var ConfigRepository $config */
            $config = $container->make(ConfigRepository::class);

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

    private function registerProIcons(Factory $factory, string $proIconsPath, ConfigRepository $config): void
    {
        foreach ($config->get('blade-fontawesome', []) as $name => $itemSet) {
            if ($itemSet === false) {
                continue;
            }

            if (! is_dir("{$proIconsPath}/{$name}")) {
                continue;
            }

            $factory->add("fontawesome-{$name}", array_merge(['path' => "{$proIconsPath}/{$name}"], $config->get("blade-fontawesome.{$name}", [])));
        }
    }
}
