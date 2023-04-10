<?php

use Sellinnate\LaravelContactsManager\Models\Contact;
use Sellinnate\LaravelContactsManager\Models\ContactList;

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
