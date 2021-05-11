<?php

namespace OwenVoke\BladeFontAwesome\Generator\Commands;

use BladeUI\Icons\Console\AbstractGenerateCommand;
use DOMDocument;
use DOMElement;

class GenerateCommand extends AbstractGenerateCommand
{
    protected static string $npmPackage = '@fortawesome/fontawesome-free';
    protected static string $sourceSvgFolder = '/svgs';

    protected static array $iconSets = [
        'regular' => 'fa-',
        'brands' => 'fab-',
        'solid' => 'fas-',
    ];

    public function normalizeSvgFile(string $tempFilepath, string $iconSet): void
    {
        $doc = new DOMDocument();
        $doc->load($tempFilepath);
        /**
         * @var DOMElement $svgElement
         */
        $svgElement = $doc->getElementsByTagName('svg')[0];
        $svgElement->setAttribute('fill', 'currentColor');
        $doc->save($tempFilepath);

        $svgLine = trim(file($tempFilepath)[1]);
        file_put_contents($tempFilepath, $svgLine);
    }
}
