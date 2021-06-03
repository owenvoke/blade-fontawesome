<?php

use BladeUI\Icons\Generation\IconGenerator;
use BladeUI\Icons\Generation\IconSetConfig;

return IconGenerator::create('blade-fontawesome')
    ->fromNpm('@fortawesome/fontawesome-free') // Optionally specify an `npm` package to load from
    ->directory('/svgs') // Specify a directory, if an npm package isn't set, this can be anywhere
    ->withIconSets([
        IconSetConfig::create('regular'),
        IconSetConfig::create('brands'),
        IconSetConfig::create('solid'),
    ])
    ->withSvgNormalisation(function (string $tempFilepath, IconSetConfig $iconSet) {
        /** @var string $svgContent */
        $svgContent = file_get_contents($tempFilepath);
        $svgContent = str_replace('<svg ', '<svg fill="currentColor" ', $svgContent);
        file_put_contents($tempFilepath, $svgContent);
    })
    ->safe();
