<?php
 
use Laravel\Jetstream\InteractsWithBanner;
use Inmanturbo\ContactsManager\Models\Contact;

use function Livewire\Volt\{computed, usesPagination, state, uses, usesFileUploads};
use function Laravel\Folio\{name, middleware};

usesPagination();
usesFileUploads();
 
state(['count' => 0]);

uses([
    InteractsWithBanner::class,
]);

state(['search'])->url();

state(['sort_column' => 'name'])->url();

state(['sort_direction' => 'asc'])->url();

state(['per_page' => '10'])->url();
 
$contacts = computed(function () {

	$perPage = $this->per_page ?? 10;

	$sortColumn = $this->sort_column ?? 'name';

	$sortDirection = $this->sort_direction ?? 'asc';

	$contacts = Contact::orderBy($sortColumn, $sortDirection);

	if ($this->search) {
		$contacts->where('name', 'like', '%' . $this->search . '%')->orWhere('email', 'like', '%' . $this->search . '%');
	}

	return $contacts->paginate($perPage);
});
 
?>
                
                <div class="flex items-center justify-center sm:px-1">
                <div class="container">
                <div class="px-4 space-y-1 sm:space-x-1 sm:px-1 sm:items-center sm:flex">
							<x-contacts::input type="search" class="w-full px-4 py-2 mt-1 text-gray-700 bg-gray-200 rounded-lg sm:p-1 sm:w-3/12" placeholder="Search Contacts..." wire:model.live="search"/>

							<x-contacts::button wire:click="add()" px="px-4" py="py-2" class="justify-center w-full sm:w-16">
								<span>
									{{ __('Add') }}
								</span>
							</x-contacts::button>

							<x-contacts::button wire:click="$set('uploadDialog', true)" type="file"  px="px-0" py="py-2" class="justify-center w-full space-x-1 sm:w-40" title="uploadCsv">
								<x-contacts::icons.upload-arrow /> 
								<span>
									{{ __('Upload Csv') }}
								</span>
							</x-contacts::button>

							<x-contacts::button wire:click="downloadCsv()" px="px-0" py="py-2" title="downloadCsv">
								<x-contacts::icons.download-arrow/>
								<span>
									{{ __('Download Csv') }}
								</span>
							</x-contacts::button>

							<x-contacts::select class="w-full px-1 py-2 mt-1 text-gray-700 bg-gray-200 rounded-lg sm:p-1 sm:w-32" wire:model.live.debounce.50ms="per_page">
								<option value="10">10 per page</option>
								<option value="25">25 per page</option>
								<option value="50">50 per page</option>
								<option value="100">1000 per page</option>
							</x-contacts::select>
						</div>

                

		<table class="flex flex-row flex-no-wrap w-full px-4 py-2 mt-0 mb-5 overflow-hidden rounded-lg sm:mt-2 sm:border-collapse sm:border sm:border-gray-500 sm:rounded-none">
			<thead class="text-gray-100">
				<tr class="flex flex-col mb-2 bg-gray-600 rounded-l-lg flex-no wrap sm:table-row sm:rounded-none sm:mb-0">
					<th class="p-3 space-x-1 text-left sm:px-2 sm:py-0 sm:border sm:border-gray-400">
                    	<div class="flex items-center space-x-1">
                            <span class="inline-block">
                                Name
                            </span>
                            {{-- @if ($this->sort_column != 'name' && $this->sort_direction != 'asc' || $this->sort_column == 'name' && $this->sort_direction == 'desc')
                                <span class="inline-block cursor-pointer" wire:click="sort('name', 'asc')">
                                    <x-contacts::icons.up-arrow/>
                                </span>
                            @elseif ($this->sort_column != 'name' && $this->sort_direction != 'desc' || $this->sort_column == 'name' && $this->sort_direction == 'asc') --}}
                                <span class="inline-block cursor-pointer" wire:click="sort('name', 'desc')">
                                    <x-contacts::icons.down-arrow/>
                                </span>
                            {{-- @endif --}}
						</div>
                    </th>
					<th class="p-3 space-x-1 text-left sm:px-2 sm:py-0 sm:border sm:border-gray-400">
                    
                        <div class="flex items-center space-x-1">

                            <span>
                                Email
                            </span>
                            {{-- @if ($this->sort_column != 'email' && $this->sort_direction != 'asc' || $this->sort_column == 'email' && $this->sort_direction == 'desc')
                                <span class="cursor-pointer" wire:click="sort('email', 'asc')">
                                    <x-contacts::icons.up-arrow/>
                                </span>
                            @elseif ($this->sort_column != 'email' && $this->sort_direction != 'desc' || $this->sort_column == 'email' && $this->sort_direction == 'asc') --}}
                                <span class="cursor-pointer" wire:click="sort('email', 'desc')">
                                    <x-contacts::icons.down-arrow/>
                                </span>
                            {{-- @endif --}}
						</div>
                    </th>
					<th class="p-3 space-x-1 text-left sm:px-2 sm:py-0 sm:border sm:border-gray-400" width="110px">Actions</th>
				</tr>
				<tr class="flex flex-col mb-2 bg-gray-600 rounded-l-lg flex-no wrap sm:table-row sm:rounded-none sm:mb-0">
					<th class="p-3 space-x-1 text-left sm:px-2 sm:py-0 sm:border sm:border-gray-400">
                    	<div class="flex items-center space-x-1">
                            <span class="inline-block">
                                Name
                            </span>
                            {{-- @if ($this->sort_column != 'name' && $this->sort_direction != 'asc' || $this->sort_column == 'name' && $this->sort_direction == 'desc')
                                <span class="inline-block cursor-pointer" wire:click="sort('name', 'asc')">
                                    <x-contacts::icons.up-arrow/>
                                </span>
                            @elseif ($this->sort_column != 'name' && $this->sort_direction != 'desc' || $this->sort_column == 'name' && $this->sort_direction == 'asc') --}}
                                <span class="inline-block cursor-pointer" wire:click="sort('name', 'desc')">
                                    <x-contacts::icons.down-arrow/>
                                </span>
                            {{-- @endif --}}
						</div>
                    </th>
					<th class="p-3 space-x-1 text-left sm:px-2 sm:py-0 sm:border sm:border-gray-400">
                    
                        <div class="flex items-center space-x-1">

                            <span>
                                Email
                            </span>
                            {{-- @if ($this->sort_column != 'email' && $this->sort_direction != 'asc' || $this->sort_column == 'email' && $this->sort_direction == 'desc')
                                <span class="cursor-pointer" wire:click="sort('email', 'asc')">
                                    <x-contacts::icons.up-arrow/>
                                </span>
                            @elseif ($this->sort_column != 'email' && $this->sort_direction != 'desc' || $this->sort_column == 'email' && $this->sort_direction == 'asc') --}}
                                <span class="cursor-pointer" wire:click="sort('email', 'desc')">
                                    <x-contacts::icons.down-arrow/>
                                </span>
                            {{-- @endif --}}
						</div>
                    </th>
					<th class="p-3 space-x-1 text-left sm:px-2 sm:py-0 sm:border sm:border-gray-400" width="110px">Actions</th>
				</tr>
				<tr class="flex flex-col mb-2 bg-gray-600 rounded-l-lg flex-no wrap sm:table-row sm:rounded-none sm:mb-0">
					<th class="p-3 space-x-1 text-left sm:px-2 sm:py-0 sm:border sm:border-gray-400">
                    	<div class="flex items-center space-x-1">
                            <span class="inline-block">
                                Name
                            </span>
                            {{-- @if ($this->sort_column != 'name' && $this->sort_direction != 'asc' || $this->sort_column == 'name' && $this->sort_direction == 'desc')
                                <span class="inline-block cursor-pointer" wire:click="sort('name', 'asc')">
                                    <x-contacts::icons.up-arrow/>
                                </span>
                            @elseif ($this->sort_column != 'name' && $this->sort_direction != 'desc' || $this->sort_column == 'name' && $this->sort_direction == 'asc') --}}
                                <span class="inline-block cursor-pointer" wire:click="sort('name', 'desc')">
                                    <x-contacts::icons.down-arrow/>
                                </span>
                            {{-- @endif --}}
						</div>
                    </th>
					<th class="p-3 space-x-1 text-left sm:px-2 sm:py-0 sm:border sm:border-gray-400">
                    
                        <div class="flex items-center space-x-1">

                            <span>
                                Email
                            </span>
                            {{-- @if ($this->sort_column != 'email' && $this->sort_direction != 'asc' || $this->sort_column == 'email' && $this->sort_direction == 'desc')
                                <span class="cursor-pointer" wire:click="sort('email', 'asc')">
                                    <x-contacts::icons.up-arrow/>
                                </span>
                            @elseif ($this->sort_column != 'email' && $this->sort_direction != 'desc' || $this->sort_column == 'email' && $this->sort_direction == 'asc') --}}
                                <span class="cursor-pointer" wire:click="sort('email', 'desc')">
                                    <x-contacts::icons.down-arrow/>
                                </span>
                            {{-- @endif --}}
						</div>
                    </th>
					<th class="p-3 space-x-1 text-left sm:px-2 sm:py-0 sm:border sm:border-gray-400" width="110px">Actions</th>
				</tr>
			</thead>
			<tbody class="flex-1 text-gray-800 sm:flex-none dark:text-gray-300">
				<tr class="flex flex-col mb-2 flex-no wrap sm:table-row sm:mb-0 odd:bg-indigo-300 dark:odd:text-gray-800">
					<td class="p-3 border border-gray-400 sm:px-2 sm:py-0">John Covv</td>
					<td class="h-[3.08rem] p-3 truncate border border-gray-400 sm:px-2 sm:py-0 sm:h-auto">contato@johncovv.com</td>
					<td class="p-3 border border-gray-400 sm:px-2 sm:py-0">
                    
                    <div class="flex items-center justify-around h-6 space-x-1">
                        <x-contacts::danger-button wire:click="delete()" px="px-2" py="sm:py-0.5 py-0.5" class="w-12 sm:w-8">
							{{ __('X') }}
						</x-contacts::danger-button>
                        <x-contacts::button wire:click="edit()" px="sm:px-2" py="py-0.5" class="justify-center w-12 sm:w-8">
							<x-contacts::icons.edit/>
						</x-contacts::button>
                        <!-- download button -->
						<x-contacts::button wire:click="downloadVCard()" px="sm:px-2" py="py-0.5" class="justify-center w-12 sm:w-8">
							<x-contacts::icons.download-arrow/>
						</x-contacts::button>
                        <!-- add button -->
                        <x-contacts::button :disabled="false" px="sm:px-2" py="py-0.5" class="justify-center w-12 sm:w-8">
                            @if(true)
                                <x-contacts::icons.add/>
                            @else
                                <x-contacts::icons.check-badge class="h-4 text-green-500"/>
                            @endif
						</x-contacts::button>
                    </div>
                    
                    </td>
				</tr>
				<tr class="flex flex-col mb-2 flex-no wrap sm:table-row sm:mb-0 odd:bg-indigo-300 dark:odd:text-gray-800">
					<td class="p-3 border border-gray-400 sm:px-2 sm:py-0">John Covv</td>
					<td class="h-[3.08rem] p-3 truncate border border-gray-400 sm:px-2 sm:py-0 sm:h-auto">contato@johncovv.com</td>
					<td class="p-3 border border-gray-400 sm:px-2 sm:py-0">
                    
                    <div class="flex items-center justify-around h-6 space-x-1">
                        <x-contacts::danger-button wire:click="delete()" px="px-2" py="sm:py-0.5 py-0.5" class="w-12 sm:w-8">
							{{ __('X') }}
						</x-contacts::danger-button>
                        <x-contacts::button wire:click="edit()" px="sm:px-2" py="py-0.5" class="justify-center w-12 sm:w-8">
							<x-contacts::icons.edit/>
						</x-contacts::button>
                        <!-- download button -->
						<x-contacts::button wire:click="downloadVCard()" px="sm:px-2" py="py-0.5" class="justify-center w-12 sm:w-8">
							<x-contacts::icons.download-arrow/>
						</x-contacts::button>
                        <!-- add button -->
                        <x-contacts::button :disabled="false" px="sm:px-2" py="py-0.5" class="justify-center w-12 sm:w-8">
                            @if(true)
                                <x-contacts::icons.add/>
                            @else
                                <x-contacts::icons.check-badge class="h-4 text-green-500"/>
                            @endif
						</x-contacts::button>
                    </div>
                    
                    </td>
				</tr>
				<tr class="flex flex-col mb-2 flex-no wrap sm:table-row sm:mb-0 odd:bg-indigo-300 dark:odd:text-gray-800">
					<td class="p-3 border border-gray-400 sm:px-2 sm:py-0">John Covv</td>
					<td class="h-[3.08rem] p-3 truncate border border-gray-400 sm:px-2 sm:py-0 sm:h-auto">contato@johncovv.com</td>
					<td class="p-3 border border-gray-400 sm:px-2 sm:py-0">
                    
                    <div class="flex items-center justify-around h-6 space-x-1">
                        <x-contacts::danger-button wire:click="delete()" px="px-2" py="sm:py-0.5 py-0.5" class="w-12 sm:w-8">
							{{ __('X') }}
						</x-contacts::danger-button>
                        <x-contacts::button wire:click="edit()" px="sm:px-2" py="py-0.5" class="justify-center w-12 sm:w-8">
							<x-contacts::icons.edit/>
						</x-contacts::button>
                        <!-- download button -->
						<x-contacts::button wire:click="downloadVCard()" px="sm:px-2" py="py-0.5" class="justify-center w-12 sm:w-8">
							<x-contacts::icons.download-arrow/>
						</x-contacts::button>
                        <!-- add button -->
                        <x-contacts::button :disabled="false" px="sm:px-2" py="py-0.5" class="justify-center w-12 sm:w-8">
                            @if(true)
                                <x-contacts::icons.add/>
                            @else
                                <x-contacts::icons.check-badge class="h-4 text-green-500"/>
                            @endif
						</x-contacts::button>
                    </div>
                    
                    </td>
				</tr>
			</tbody>
		</table>

		</div>
                	<style>

  @media (min-width: 640px) {
    table {
      display: inline-table !important;
    }

    thead tr:not(:first-child) {
      display: none;
    }
  }

  td:not(:last-child) {
    border-bottom: 0;
  }

  th:not(:last-child) {
    border-bottom: 1px solid rgba(0, 0, 0, .1);
  }
</style>
                </div>