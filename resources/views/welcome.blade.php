<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Welcome') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-xl mt-10 mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <livewire:searchbar></livewire:searchbar>
            </div>
        </div>
    </div>

    <x-jet-section-border />

    <div class="max-w-7xl mt-10 mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
            <livewire:tabla></livewire:tabla>
        </div>
    </div>
    
</x-app-layout>