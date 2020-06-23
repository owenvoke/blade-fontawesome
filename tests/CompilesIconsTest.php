<?php

declare(strict_types=1);

use OwenVoke\BladeFontAwesome\Tests\TestCase;

uses(TestCase::class);

it('compiles a single anonymous component', function () {
    $result = svg('fas-plus')->toHtml();

    $expected = <<<SVG
<svg fill="currentColor" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><path d="M416 208H272V64c0-17.67-14.33-32-32-32h-32c-17.67 0-32 14.33-32 32v144H32c-17.67 0-32 14.33-32 32v32c0 17.67 14.33 32 32 32h144v144c0 17.67 14.33 32 32 32h32c17.67 0 32-14.33 32-32V304h144c17.67 0 32-14.33 32-32v-32c0-17.67-14.33-32-32-32z"/></svg>
SVG;

    $this->assertSame($expected, $result);
});

it('can add classes to icons', function () {
    $result = svg('fas-plus', 'w-6 h-6 text-gray-500')->toHtml();

    $expected = <<<SVG
<svg class="w-6 h-6 text-gray-500" fill="currentColor" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><path d="M416 208H272V64c0-17.67-14.33-32-32-32h-32c-17.67 0-32 14.33-32 32v144H32c-17.67 0-32 14.33-32 32v32c0 17.67 14.33 32 32 32h144v144c0 17.67 14.33 32 32 32h32c17.67 0 32-14.33 32-32V304h144c17.67 0 32-14.33 32-32v-32c0-17.67-14.33-32-32-32z"/></svg>
SVG;

    $this->assertSame($expected, $result);
});

it('can add styles to icons', function () {
    $result = svg('fas-plus', ['style' => 'color: #555'])->toHtml();

    $expected = <<<SVG
<svg style="color: #555" fill="currentColor" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><path d="M416 208H272V64c0-17.67-14.33-32-32-32h-32c-17.67 0-32 14.33-32 32v144H32c-17.67 0-32 14.33-32 32v32c0 17.67 14.33 32 32 32h144v144c0 17.67 14.33 32 32 32h32c17.67 0 32-14.33 32-32V304h144c17.67 0 32-14.33 32-32v-32c0-17.67-14.33-32-32-32z"/></svg>
SVG;

    $this->assertSame($expected, $result);
});

