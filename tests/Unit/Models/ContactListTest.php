<?php

use Sellinnate\LaravelContactsManager\Models\Contact;
use Sellinnate\LaravelContactsManager\Models\ContactList;

it('can create a contact list', function () {
    \Sellinnate\LaravelContactsManager\Models\ContactList::create(['name' => 'Test list']);
    expect(count(\Sellinnate\LaravelContactsManager\Models\ContactList::all()))->toBe(1);
});

it('can set name for a contact list', function () {
    $model = \Sellinnate\LaravelContactsManager\Models\ContactList::create(['name' => 'Test list']);
    expect($model->name)->toBe('Test list');
});

it('correctly attach to a user', function () {

    $contact = Contact::factory()->create();
    $list = ContactList::create(['name' => 'test list']);
    $list->contacts()->attach($contact->id);

    expect(count($list->contacts))->toBe(1);
});
