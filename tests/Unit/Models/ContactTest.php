<?php

it('can create a contact', function () {
    \Sellinnate\LaravelContactsManager\Models\Contact::factory()->create();
    expect(count(\Sellinnate\LaravelContactsManager\Models\Contact::all()))->tobe(1);
});

it('can assign first name to a contact', function () {
    \Sellinnate\LaravelContactsManager\Models\Contact::factory()->create(['first_name' => 'Mario']);
    expect(\Sellinnate\LaravelContactsManager\Models\Contact::first()->first_name)->toBe('Mario');
});

it('fetch the correct contact name attribute for a private contact', function () {
    $model = \Sellinnate\LaravelContactsManager\Models\Contact::factory()->create(
        [
            'first_name' => 'Mario',
            'last_name' => 'Rossi',
            'type' => 'private',
        ]);
    expect($model->name)->toBe('Mario Rossi');
});

it('fetch the correct contact name attribute for a business contact', function () {
    $model = \Sellinnate\LaravelContactsManager\Models\Contact::factory()->create(
        [
            'type' => 'business',
            'business_name' => 'sellinnate',
        ]);
    expect($model->name)->toBe('sellinnate');
});
