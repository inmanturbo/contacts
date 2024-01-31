<?php

use Inmanturbo\ContactsManager\Models\Contact;
use Inmanturbo\ContactsManager\Models\ContactList;

it('can create a contact list', function () {
    ContactList::create(['name' => 'Test list',  'user_id' => 1]);
    expect(count(ContactList::all()))->toBe(1);
});

it('can set name for a contact list', function () {
    $model = ContactList::create(['name' => 'Test list',  'user_id' => 1]);
    expect($model->name)->toBe('Test list');
});

it('correctly attach to a user', function () {

    $contact = Contact::factory()->create();
    $list = ContactList::create(['name' => 'test list', 'user_id' => 1]);
    $list->contacts()->attach($contact->id);

    expect(count($list->contacts))->toBe(1);
});

it('can covert into a mail array', function () {
    $contactList = ContactList::create([
        'name' => 'Test list',
        'user_id' => 1,
    ]);

    Contact::factory(3)->create()->each(function (Contact $contact) use ($contactList) {
        $contact->lists()->attach($contactList->id);
    });

    expect($contactList->toEmailsArray())->toBeArray();
});

it('can covert into a names array', function () {
    $contactList = ContactList::create([
        'name' => 'Test list',
        'user_id' => 1,
    ]);

    Contact::factory(3)->create()->each(function (Contact $contact) use ($contactList) {
        $contact->lists()->attach($contactList->id);
    });

    expect($contactList->toNamesArray())->toBeArray();
});

it('excludes empty values from email array', function () {
    $contactList = ContactList::create([
        'name' => 'Test list',
        'user_id' => 1,
    ]);

    Contact::factory(3)->create()->each(function (Contact $contact) use ($contactList) {
        $contact->lists()->attach($contactList->id);
    });

    Contact::factory()->create(['email' => ''])->lists()->attach($contactList->id);
    Contact::factory()->create(['email' => null])->lists()->attach($contactList->id);

    expect(count($contactList->toEmailsArray()))->toBe(3);
});

it('excludes empty values from names array', function () {
    $contactList = ContactList::create([
        'name' => 'Test list',
        'user_id' => 1,
    ]);

    Contact::factory(3)->create()->each(function (Contact $contact) use ($contactList) {
        $contact->lists()->attach($contactList->id);
    });

    expect(count($contactList->toNamesArray()))->toBe(3);
});
