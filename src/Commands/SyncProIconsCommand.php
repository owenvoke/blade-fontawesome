<?php

namespace OwenVoke\BladeFontAwesome\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

final class SyncProIconsCommand extends Command
{
    protected $signature = 'blade-fontawesome:sync-pro
                          {directory? : The root directory containing the npm Font Awesome fonts}';

    protected $description = 'Synchronise Font Awesome Pro icons from npm';

    /** @var string|null */
    private $directory;

    public function handle(): ?int
    {
        /** @phpstan-ignore-next-line */
        $this->directory = (string) ($this->argument('directory') ?? base_path());

        $fullSourcePath = "{$this->directory}/node_modules/@fortawesome/fontawesome-pro/svgs";

        if (!is_dir($fullSourcePath)) {
            $this->warn("Unable to find Font Awesome Pro SVGs in '{$this->directory}'");

            return 1;
        }

        $destinationPath = resource_path('icons/blade-fontawesome');

        if (!File::copyDirectory($fullSourcePath, $destinationPath)) {
            $this->warn("Unable to find Font Awesome Pro SVGs in '{$this->directory}'");

            return 1;
        }

        $this->info("Successfully updated Font Awesome Pro SVGs");
        $this->line("- From: {$fullSourcePath}");
        $this->line("- To: {$destinationPath}");

        return 0;
    }
}
