<?php

declare(strict_types=1);

use OwenVoke\BladeFontAwesome\Tests\TestCase;

uses(TestCase::class);

it('compiles a single anonymous component', function () {
    $result = svg('fas-plus')->toHtml();

    expect($result)->toMatchSnapshot();
});

it('can add classes to icons', function () {
    $result = svg('fas-plus', 'w-6 h-6 text-gray-500')->toHtml();

    expect($result)->toMatchSnapshot();
});

it('can add styles to icons', function () {
    $result = svg('fas-plus', ['style' => 'color: #555'])->toHtml();

    expect($result)->toMatchSnapshot();
});
