<?php

namespace OwenVoke\BladeFontAwesome\Actions;

use DirectoryIterator;
use RuntimeException;

class CompileSvgsAction
{
    private string $svgDirectory;

    private string $svgOutputDirectory;

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

            $svgContent = file_get_contents($svg->getPathname());

            if ($svgContent === false) {
                throw new RuntimeException('Unable to read SVG file.');
            }

            $svgContent = str_replace('<svg ', '<svg fill="currentColor" ', $svgContent);
            $svgContent = str_replace('height="1em" ', ' ', $svgContent);

            $result = file_put_contents("{$this->svgOutputDirectory}/{$svg->getFilename()}", $svgContent);

            if ($result === false) {
                throw new RuntimeException('Unable to write SVG file.');
            }
        }
    }
}
