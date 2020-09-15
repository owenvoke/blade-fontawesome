# Blade Font Awesome

[![Latest Version on Packagist][ico-version]][link-packagist]
[![Software License][ico-license]](LICENSE.md)
[![Build Status][ico-github-actions]][link-github-actions]
[![Style CI][ico-styleci]][link-styleci]
[![Total Downloads][ico-downloads]][link-downloads]
[![Buy us a tree][ico-treeware-gifting]][link-treeware-gifting]

A package to easily make use of [Font Awesome](https://fontawesome.com) in your Laravel Blade views.

For a full list of available icons see [the SVG directory](./resources/svg).

## Requirements

- PHP 7.4 or higher
- Laravel 7.14 or higher

## Install

Via Composer

```bash
$ composer require owenvoke/blade-fontawesome
```

## Usage

Icons can be used a self-closing Blade components which will be compiled to SVG icons:

```blade
<x-fas-cloud/>
```

You can also pass classes to your icon components:

```blade
<x-fas-cloud class="w-6 h-6 text-gray-500"/>
```

And even use inline styles:

```blade
<x-fas-cloud style="color: #555"/>
```

### Raw SVG Icons

If you want to use the raw SVG icons as assets, you can publish them using:

```bash
php artisan vendor:publish --tag=blade-fontawesome --force
```

Then use them in your views like:

```blade
<img src="{{ asset('vendor/blade-fontawesome/solid/cloud.svg') }}" width="10" height="10"/>
```

### Font Awesome Pro

Blade Font Awesome supports pro icons using npm for downloads.

To use this, [install Font Awesome Pro](https://fontawesome.com/how-to-use/on-the-web/setup/using-package-managers#installing-pro) using `npm i --save @fortawesome/fontawesome-pro`, and then run the following Artisan command to add the icons to your `resources` path.

```bash
php artisan blade-fontawesome:sync-pro
```

Blade Font Awesome will then automatically detect and use the pro icons under the `resources/icons/blade-fontawesome` path.

### Blade Icons

Blade Font Awesome uses Blade Icons under the hood. Please refer to [the Blade Icons readme](https://github.com/blade-ui-kit/blade-icons) for additional functionality.

## Change log

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Testing

```bash
$ composer test
```

## Contributing

Please see [CONTRIBUTING](.github/CONTRIBUTING.md) for details.

## Security

If you discover any security related issues, please email security@voke.dev instead of using the issue tracker.

## Credits

- [Owen Voke][link-author]
- [All Contributors][link-contributors]

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.

## Treeware

You're free to use this package, but if it makes it to your production environment you are required to buy the world a tree.

It’s now common knowledge that one of the best tools to tackle the climate crisis and keep our temperatures from rising above 1.5C is to plant trees. If you support this package and contribute to the Treeware forest you’ll be creating employment for local families and restoring wildlife habitats.

You can buy trees [here][link-treeware-gifting].

Read more about Treeware at [treeware.earth][link-treeware].

[ico-version]: https://img.shields.io/packagist/v/owenvoke/blade-fontawesome.svg?style=flat-square
[ico-license]: https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square
[ico-github-actions]: https://img.shields.io/github/workflow/status/owenvoke/blade-fontawesome/Tests.svg?style=flat-square
[ico-styleci]: https://styleci.io/repos/274363158/shield
[ico-downloads]: https://img.shields.io/packagist/dt/owenvoke/blade-fontawesome.svg?style=flat-square
[ico-treeware-gifting]: https://img.shields.io/badge/Treeware-%F0%9F%8C%B3-lightgreen?style=flat-square

[link-packagist]: https://packagist.org/packages/owenvoke/blade-fontawesome
[link-github-actions]: https://github.com/owenvoke/blade-fontawesome/actions
[link-styleci]: https://styleci.io/repos/274363158
[link-downloads]: https://packagist.org/packages/owenvoke/blade-fontawesome
[link-treeware]: https://treeware.earth
[link-treeware-gifting]: https://ecologi.com/owenvoke?gift-trees
[link-author]: https://github.com/owenvoke
[link-contributors]: ../../contributors
