<?php

use Laravel\Jetstream\InteractsWithBanner;
use Inmanturbo\ContactsManager\Models\Contact;

use function Livewire\Volt\{computed, usesPagination, state, uses, usesFileUploads};
use function Laravel\Folio\{name, middleware};

usesPagination();
usesFileUploads();

state(['count' => 0]);

uses([InteractsWithBanner::class]);

state(['search'])->url();

state(['sort_column' => 'name'])->url();

state(['sort_direction' => 'asc'])->url();

state(['per_page' => '10'])->url();

$sort = function ($column, $direction) {
	$this->sort_column = $column;
	$this->sort_direction = $direction;
};

$contacts = computed(function () {
    $perPage = $this->per_page ?? 10;

    $sortColumn = $this->sort_column ?? 'business_name';

    $sortDirection = $this->sort_direction ?? 'asc';

    $contacts = Contact::orderBy($sortColumn, $sortDirection);

    if ($this->search) {
        $contacts->where('name', 'like', '%' . $this->search . '%')->orWhere('email', 'like', '%' . $this->search . '%');
    }

    return $contacts->paginate($perPage);
});

?>

<div class="flex justify-center items-center sm:px-1">
    <div class="container">
        <div class="px-4 space-y-1 sm:flex sm:items-center sm:px-1 sm:space-x-1">
            <x-contacts::input type="search"
                class="py-2 px-4 mt-1 w-full text-gray-700 bg-gray-200 rounded-lg sm:p-1 sm:w-3/12"
                placeholder="Search Contacts..." wire:model.live="search" />

            <x-contacts::secondary-button-link wire:navigate="true" :href="route('contacts.v1.create')" px="px-4" py="py-2" class="justify-center w-full sm:w-16">
                <span>
                    {{ __('Add') }}
                </span>
            </x-contacts::secondary-button-link>

            <x-contacts::button wire:click="$set('uploadDialog', true)" type="file" px="px-0" py="py-2"
                class="justify-center space-x-1 w-full sm:w-40" title="uploadCsv">
                <x-contacts::icons.upload-arrow />
                <span>
                    {{ __('Upload Csv') }}
                </span>
            </x-contacts::button>

            <x-contacts::button wire:click="downloadCsv()" px="px-0" py="py-2" class="justify-center w-full space-x-1 sm:w-40" title="downloadCsv">
                <x-contacts::icons.download-arrow />
                <span>
                    {{ __('Download Csv') }}
                </span>
            </x-contacts::button>

            <x-contacts::select class="py-2 px-1 mt-1 w-full text-gray-700 bg-gray-200 rounded-lg sm:p-1 sm:w-32"
                wire:model.live.debounce.50ms="per_page">
                <option value="10">10 per page</option>
                <option value="25">25 per page</option>
                <option value="50">50 per page</option>
                <option value="100">1000 per page</option>
            </x-contacts::select>
        </div>
        <table
            class="flex overflow-hidden flex-row py-2 px-4 mt-0 mb-5 w-full rounded-lg sm:mt-2 sm:rounded-none sm:border sm:border-gray-500 sm:border-collapse flex-no-wrap">
            <thead class="text-gray-100">
                @foreach ($this->contacts as $contact)
                    <tr
                        class="flex flex-col mb-2 bg-gray-600 rounded-l-lg sm:table-row sm:mb-0 sm:rounded-none flex-no wrap">
                        <th class="p-3 space-x-1 text-left sm:py-0 sm:px-2 sm:border sm:border-gray-400">
                            <div class="flex items-center space-x-1">
                                <span class="inline-block">
                                    Name
                                </span>
                                @if (($this->sort_column != 'name' && $this->sort_direction != 'asc') || ($this->sort_column == 'name' && $this->sort_direction == 'desc'))
                                <span class="inline-block cursor-pointer" wire:click="sort('business_name', 'asc')">
                                    <x-contacts::icons.up-arrow/>
                                </span>
                            @elseif ($this->sort_column != 'name' && $this->sort_direction != 'desc' || $this->sort_column == 'name' && $this->sort_direction == 'asc')
                                <span class="inline-block cursor-pointer" wire:click="sort('business_name', 'desc')">
                                    <x-contacts::icons.down-arrow />
                                </span>
                                @endif
                            </div>
                        </th>
                        <th class="p-3 space-x-1 text-left sm:py-0 sm:px-2 sm:border sm:border-gray-400">

                            <div class="flex items-center space-x-1">

                                <span>
                                    Email
                                </span>
                                @if (($this->sort_column != 'email' && $this->sort_direction != 'asc') || ($this->sort_column == 'email' && $this->sort_direction == 'desc'))
                                <span class="cursor-pointer" wire:click="sort('email', 'asc')">
                                    <x-contacts::icons.up-arrow/>
                                </span>
                            @elseif ($this->sort_column != 'email' && $this->sort_direction != 'desc' || $this->sort_column == 'email' && $this->sort_direction == 'asc')
                                <span class="cursor-pointer" wire:click="sort('email', 'desc')">
                                    <x-contacts::icons.down-arrow />
                                </span>
                                @endif
                            </div>
                        </th>
                        <th class="p-3 space-x-1 text-left sm:py-0 sm:px-2 sm:border sm:border-gray-400" width="110px">
                            Actions</th>
                    </tr>
                @endforeach
            </thead>
            <tbody class="flex-1 text-gray-800 sm:flex-none dark:text-gray-300">
                @foreach ($this->contacts as $contact)
                    <tr
                        class="flex flex-col mb-2 sm:table-row sm:mb-0 odd:bg-indigo-300 dark:odd:text-gray-800 max-w-60">
                        <td class="p-3 border border-gray-400 sm:px-2 sm:py-0 overflow-hidden whitespace-nowrap">{{ $contact->name }}</td>
                        <td class="p-3 truncate border border-gray-400 sm:px-2 sm:py-0 sm:h-auto">{{ $contact->email }}</td>
                        <td class="p-3 px-0 border border-gray-400 sm:py-0 sm:px-2">

                            <div class="flex justify-around items-center p-0 space-x-1">
                                <x-contacts::danger-button wire:click="delete()" px="px-2" py="sm:py-0.5 py-0.5"
                                    class="w-12 sm:w-8">
                                    {{ __('X') }}
                                </x-contacts::danger-button>
                                <x-contacts::button wire:click="edit()" px="sm:px-2" py="py-0.5"
                                    class="justify-center w-12 sm:w-8">
                                    <x-contacts::icons.edit />
                                </x-contacts::button>
                                <!-- download button -->
                                <x-contacts::button wire:click="downloadVCard()" px="sm:px-2" py="py-0.5"
                                    class="justify-center w-12 sm:w-8">
                                    <x-contacts::icons.download-arrow />
                                </x-contacts::button>
                                <!-- add button -->
                                <x-contacts::button :disabled="false" px="sm:px-2" py="py-0.5"
                                    class="justify-center w-12 sm:w-8">
                                    @if (true)
                                        <x-contacts::icons.add />
                                    @else
                                        <x-contacts::icons.check-badge class="h-4 text-green-500" />
                                    @endif
                                </x-contacts::button>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <div
            class="py-3 px-4 sm:flex sm:flex-row-reverse sm:px-6 dark:text-gray-300">
            {{ $this->contacts->links() }}
        </div>

    </div>
</div>
