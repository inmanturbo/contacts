# Laravel Contacts Manager

[![Latest Version on Packagist](https://img.shields.io/packagist/v/sellinnate/laravel-contacts-manager.svg?style=flat-square)](https://packagist.org/packages/sellinnate/laravel-contacts-manager)
[![GitHub Tests Action Status](https://img.shields.io/github/actions/workflow/status/sellinnate/laravel-contacts-manager/run-tests.yml?branch=main&label=tests&style=flat-square)](https://github.com/sellinnate/laravel-contacts-manager/actions?query=workflow%3Arun-tests+branch%3Amain)
[![GitHub Code Style Action Status](https://img.shields.io/github/actions/workflow/status/sellinnate/laravel-contacts-manager/fix-php-code-style-issues.yml?branch=main&label=code%20style&style=flat-square)](https://github.com/sellinnate/laravel-contacts-manager/actions?query=workflow%3A"Fix+PHP+code+style+issues"+branch%3Amain)
[![Total Downloads](https://img.shields.io/packagist/dt/sellinnate/laravel-contacts-manager.svg?style=flat-square)](https://packagist.org/packages/sellinnate/laravel-contacts-manager)

A simple utility package to handle contacts lists in Laravel


## Installation

You can install the package via composer:

```bash
composer require sellinnate/laravel-contacts-manager
```

You can publish and run the migrations with:

```bash
php artisan vendor:publish --tag="laravel-contacts-manager-migrations"
php artisan migrate
```

Optionally, you can publish the views using

```bash
php artisan vendor:publish --tag="laravel-contacts-manager-views"
```

## Usage

```php
//Create a contact
Contact::create([
    'first_name' => '...',
    'last_name' => '...',
    'business_name' => '...',
    'address' => '...',
    'zip_code' => '...',
    'country_code' => '...',
    'email' => '...',
    'mobile' => '...',
    'phone' => '...',
    'vat_number' => '...',
    'notes' => '...',
    'type' => '...' // MANDATORY: 'private' or 'business',
]);

//Create a contact list
ContactList::create([
    'user_id' => '1' //desired user id
    'name' => 'this is the list name'
]);

//attach a contact to a list and viceversa

$contact->lists()->attach($listId)
$list->contacts()->attach($contactId)

//fetch contacts from a list

$list->contacts

//fetch all lists connected to a contact

$contact->lists
```

## Testing

```bash
composer test
```

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

## Security Vulnerabilities

Please review [our security policy](../../security/policy) on how to report security vulnerabilities.

## Credits

- [Filippo Calabrese](https://github.com/filippocalabrese)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
