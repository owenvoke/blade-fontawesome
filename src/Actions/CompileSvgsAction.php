<?php

namespace OwenVoke\BladeFontAwesome\Actions;

use DirectoryIterator;

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
            /** RuntimeExceptions added to handle (potential) errors */
            $svgContent = file_get_contents($svg->getPathname());
            if ($svgContent === false) {
                throw new \RuntimeException("Failed to read SVG file: {$svg->getPathname()}");
            }
            $svgContent = str_replace('<svg ', '<svg fill="currentColor" ', $svgContent);

            $outputFile = "{$this->svgOutputDirectory}/{$svg->getFilename()}";
            if (file_put_contents($outputFile, $svgContent) === false) {
                throw new \RuntimeException("Failed to write SVG file: $outputFile");
            }
        }
    }
}
