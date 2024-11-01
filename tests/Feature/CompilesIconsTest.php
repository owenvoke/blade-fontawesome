<?php

declare(strict_types=1);

use Illuminate\View\Compilers\BladeCompiler;

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

it('can use Blade component', function () {
    $result = BladeCompiler::render(
        '<x-fas-plus />',
    );

    expect($result)->toMatchSnapshot();
});

it('can use Blade directive', function () {
    $result = BladeCompiler::render(
        "@svg('fas-plus')",
    );

    expect($result)->toMatchSnapshot();
});
