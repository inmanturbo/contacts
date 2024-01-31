# Laravel Contacts Manager

A simple utility package to handle contacts lists in Laravel


## Installation

You can install the package via composer:

```bash
composer require inmanturbo/laravel-contacts-manager
```

You can publish and run the migrations with:

```bash
php artisan vendor:publish --tag="contacts-manager-migrations"
php artisan migrate
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

$contact->lists()->attach($listId);
$list->contacts()->attach($contactId);

//fetch contacts from a list

$list->contacts;

//fetch all lists connected to a contact

$contact->lists;

//Contact and ContactList are taggable. Feel free to use tags as you desire in your flow
//Tags are meant to be a flexible way to categorize your model.
$tag = Tag::create(['name' => 'Test tag', 'user_id' => $user->id]);

$contact->tags()->attach($tag->id);

$contactList->tags()->attach($tag->id);

//Retrive taggable elements from a tag

$tag->contacts; //returns a collection of Contacts
$tag->contactLists; //returns a collection of ContactList
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
