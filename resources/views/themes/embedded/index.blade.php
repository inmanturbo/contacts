<x-contacts::app>

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

    {{-- @if(tap(new Laravel\Jetstream\Agent(), fn ($agent) => $agent->setUserAgent(request()->userAgent()))->isDesktop()) --}}
        <x-slot name="header">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Contacts') }}
            </h2>
        </x-slot>
    {{-- @endif --}}

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg">
                @livewire('contacts.v1.index')
            </div>
        </div>
    </div>
</x-contacts::app>
