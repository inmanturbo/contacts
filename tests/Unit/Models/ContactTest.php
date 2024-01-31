<?php

use Inmanturbo\ContactsManager\Models\Contact;
use Inmanturbo\ContactsManager\Models\ContactList;

it('can create a contact', function () {
    Contact::factory()->create();
    expect(count(Contact::all()))->tobe(1);
});

it('can assign first name to a contact', function () {
    Contact::factory()->create(['first_name' => 'Mario']);
    expect(Contact::first()->first_name)->toBe('Mario');
});

it('fetch the correct contact name attribute for a private contact', function () {
    $model = Contact::factory()->create(
        [
            'first_name' => 'Mario',
            'last_name' => 'Rossi',
            'type' => 'private',
        ]);
    expect($model->name)->toBe('Mario Rossi');
});

it('fetch the correct contact name attribute for a business contact', function () {
    $model = Contact::factory()->create(
        [
            'type' => 'business',
            'business_name' => 'sellinnate',
        ]);
    expect($model->name)->toBe('sellinnate');
});

it('correctly attach to a list', function () {
    $contact = Contact::factory()->create();
    $list = ContactList::create(['name' => 'test list', 'user_id' => 1]);
    $contact->lists()->attach($list->id);

    expect(count($contact->lists))->toBe(1);
});
