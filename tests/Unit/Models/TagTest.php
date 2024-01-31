<?php

use Inmanturbo\ContactsManager\Models\Contact;
use Inmanturbo\ContactsManager\Models\ContactList;
use Inmanturbo\ContactsManager\Models\Tag;

it('can create a tag', function () {

    Tag::create([
        'name' => 'Test tag',
        'user_id' => 1,
    ]);

    expect(count(Tag::all()))->toBe(1);

});

it('can assign a tag to a Contact', function () {

    $contact = Contact::factory()->create();
    $tag = Tag::create([
        'name' => 'Test tag',
        'user_id' => 1,
    ]);

    $tag->contacts()->attach($contact->id);

    expect(count($tag->contacts))->toBe(1);
});

it('can assign a tag to a ContactList', function () {

    $contactList = ContactList::create(['name' => 'test name', 'user_id' => 1]);
    $tag = Tag::create([
        'name' => 'Test tag',
        'user_id' => 1,
    ]);

    $tag->contactLists()->attach($contactList->id);

    expect(count($tag->contactLists))->toBe(1);
});
