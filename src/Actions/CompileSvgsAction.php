<?php

namespace OwenVoke\BladeFontAwesome\Actions;

use DirectoryIterator;
use function Safe\file_get_contents;
use function Safe\file_put_contents;

class CompileSvgsAction
{
    /** @var string */
    private $svgDirectory;

    /** @var string */
    private $svgOutputDirectory;

    public function __construct(string $svgDirectory, string $svgOutputDirectory)
    {
        $this->svgDirectory = $svgDirectory;
        $this->svgOutputDirectory = $svgOutputDirectory;
    }

    public function execute(): void
    {
        foreach (new DirectoryIterator($this->svgDirectory) as $svg) {
            if (! $svg->isFile() || $svg->getExtension() !== 'svg') {
                continue;
            }

            /** @var string $svgContent */
            $svgContent = file_get_contents($svg->getPathname());
            $svgContent = str_replace('<svg ', '<svg fill="currentColor" ', $svgContent);

            file_put_contents("{$this->svgOutputDirectory}/{$svg->getFilename()}", $svgContent);
        }
    }
}
