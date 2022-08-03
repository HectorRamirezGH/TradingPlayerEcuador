<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Profile') }}
        </h2>
    </x-slot>

    <div>
        <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8 fade-in-div">

            <livewire:collections-table/>
            
            <x-jet-section-border />
         
            <div class="mt-10 sm:mt-0">
                <livewire:collections-set-table/>
            </div>
        </div>
    </div>
</x-app-layout>
