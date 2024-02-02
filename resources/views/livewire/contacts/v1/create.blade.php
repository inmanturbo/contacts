<?php

use Illuminate\Validation\Rule;

use Laravel\Jetstream\InteractsWithBanner;
use Inmanturbo\ContactsManager\ContactType;
use Inmanturbo\ContactsManager\BusinessType;
use Inmanturbo\ContactsManager\BusinessDirectory;
use Inmanturbo\ContactsManager\Models\Contact;

use function Livewire\Volt\{state,with,rules,uses};

uses([
    InteractsWithBanner::class,
]);

state([
    'name' => '',
    'business_type' => '',
    'directory' => '',
    'type' => ContactType::business->name,
]);

with([
    'businessTypes' => BusinessType::cases(),
    'directories' => BusinessDirectory::cases(),
]);

rules([
    'name' => ['required', 'string', 'max:255'],
    'business_type' => ['required', Rule::enum(BusinessType::class)],
    'directory' => ['required', Rule::enum(BusinessDirectory::class)],
]);

$createContact = function () {
    $this->validate();

    $contact = [
        'name' => $this->name,
        'business_type' => $this->business_type,
        'directory' => $this->directory,
        'type' => $this->type,
    ];

    $contact['user_uuid'] = auth()->user()->uuid;
    $contact['team_uuid'] = auth()->user()->currentTeam->uuid;

    $contact = Contact::create($contact);

    $this->banner('Contact created successfully.');

    // return redirect()->route('contacts.show', $contact);
};

?>

<x-form-section submit="createContact">
    <x-slot name="title">
        {{ __('Business Contact Details') }}
    </x-slot>

    <x-slot name="description">
        {{ __('Business Or Responsible Entity.') }}
    </x-slot>

    <x-slot name="form">

        <div class="col-span-6 sm:col-span-4">
            <x-label for="name" value="{{ __('Legal Name') }}" />
            <x-input id="name" type="text" class="block w-full mt-1" wire:model="name" autofocus />
            <x-input-error for="name" class="mt-2" />
        </div>

        <div class="col-span-6 sm:col-span-4">
            <x-label for="business_type" value="{{ __('Business Type') }}" />
            <x-select id="business_type" class="block w-full mt-1" wire:model="business_type">
                <option></option>
                @foreach($businessTypes as $type)
                    <option>{{ $type }}</option>
                @endforeach
            </x-select>
            <x-input-error for="business_type" class="mt-2" />
        </div>

        <div class="col-span-6 sm:col-span-4">
            <x-label for="directory" value="{{ __('Business Directory') }}" />
            <x-select id="directory" class="block w-full mt-1" wire:model="directory">
                <option></option>
                @foreach($directories as $directory)
                    <option>{{ $directory }}</option>
                @endforeach
            </x-select>
            <x-input-error for="directory" class="mt-2" />
        </div>

    </x-slot>

    <x-slot name="actions">
        <div class="flex flex-row space-x-1">

            <x-secondary-button-link href="javascript:history.go(-1)">
                {{ __('Cancel') }}
            </x-secondary-button-link>
            
            <x-button>
                {{ __('Create') }}
            </x-button>
        </div>
    </x-slot>
</x-form-section>
