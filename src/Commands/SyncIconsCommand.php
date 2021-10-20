<?php

namespace OwenVoke\BladeFontAwesome\Commands;

use DirectoryIterator;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;
use OwenVoke\BladeFontAwesome\Actions\CompileSvgsAction;

final class SyncIconsCommand extends Command
{
    protected $signature = 'blade-fontawesome:sync-icons
                          {directory? : The root directory containing the npm Font Awesome fonts}
                          {--free : Use the fontawesome-free npm package}
                          {--pro : Use the fontawesome-pro npm package}';

    protected $description = 'Synchronise Font Awesome icons from npm';

    protected function configure(): void
    {
        /** @deprecated */
        $this->setAliases(['blade-fontawesome:sync-pro']);
    }

    public function handle(): ?int
    {
        /** @phpstan-ignore-next-line */
        $baseDirectory = (string) ($this->argument('directory') ?? base_path());

        $proSourcePath = "{$baseDirectory}/node_modules/@fortawesome/fontawesome-pro/svgs";
        $freeSourcePath = "{$baseDirectory}/node_modules/@fortawesome/fontawesome-free/svgs";

        if ($this->option('pro')) {
            $fullSourcePath = $proSourcePath;
        } elseif ($this->option('free')) {
            $fullSourcePath = $freeSourcePath;
        } else {
            $fullSourcePath = collect([
                $proSourcePath,
                $freeSourcePath,
            ])->filter(fn (string $path): bool => is_dir($path))->first() ?? $proSourcePath;
        }

        if (! is_dir($fullSourcePath)) {
            $this->warn("Unable to find Font Awesome SVGs in '{$baseDirectory}'");

            return 1;
        }

        $destinationPath = resource_path('icons/blade-fontawesome');

        if (! File::copyDirectory($fullSourcePath, $destinationPath)) {
            $this->warn("Unable to find Font Awesome SVGs in '{$baseDirectory}'");

            return 1;
        }

        $sets = [];

        foreach (new DirectoryIterator($destinationPath) as $directory) {
            if ($directory->isDot() || ! $directory->isDir()) {
                continue;
            }

            (new CompileSvgsAction($directory->getPathname(), $directory->getPathname()))->execute();

            $sets[] = $directory->getBasename();
        }

        $this->info('Successfully updated Font Awesome SVGs');
        $this->line("- From: {$fullSourcePath}");
        $this->line("- To: {$destinationPath}");

        $this->line("\nSets copied: ".implode(', ', $sets));

        return 0;
    }
}
