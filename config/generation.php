<?php

$svgNormalization = static function (string $tempFilepath, array $iconSet) {
    /** @var string $svgContent */
    $svgContent = file_get_contents($tempFilepath);
    $svgContent = str_replace('<svg ', '<svg fill="currentColor" ', $svgContent);
    file_put_contents($tempFilepath, $svgContent);
};

return [
    [
        'source' => __DIR__.'/../node_modules/@fortawesome/fontawesome-free/svgs/regular',
        'destination' => __DIR__.'/../resources/svg/regular',
        'after' => $svgNormalization,
        'safe' => true,
    ],
    [
        'source' => __DIR__.'/../node_modules/@fortawesome/fontawesome-free/svgs/brands',
        'destination' => __DIR__.'/../resources/svg/brands',
        'after' => $svgNormalization,
        'safe' => true,
    ],
    [
        'source' => __DIR__.'/../node_modules/@fortawesome/fontawesome-free/svgs/solid',
        'destination' => __DIR__.'/../resources/svg/solid',
        'after' => $svgNormalization,
        'safe' => true,
    ],
];
