# Upgrade Guide

## 3.x

### Font Awesome 7

This major release updates to Font Awesome 7.x, if you are using Font Awesome Pro icons, these should be updated.

### Configuration

#### Custom Kit Icons

The config key for custom icons has changed from `custom` to `custom-icons`.

Please update your config to make this change if you are using custom icons.

This does not affect the usage of the icons, which will continue to use the `fak` prefix.

#### Icon Loading

Blade FontAwesome will now load all icon sets defined in your `config/blade-fontawesome.php` file.

To remove a default pro icon set, set the value to `false`. For example:

```php
'sharp-regular' => false,
```

### Laravel 12 required

Laravel `12` or higher is now required.

### PHP 8.4 required

PHP `8.4` or higher is now required.

## 2.x

### Font Awesome 6

This major release updates to Font Awesome 6.x, if you are using Font Awesome Pro icons, these should be updated.

It also includes the new Thin (`fat`) icon set, and will support Sharp (`fash`) out of the box on release.

### Laravel 9 required

Laravel `9` or higher is now required.

### PHP 8.0 required

PHP `8.0` or higher is now required.
