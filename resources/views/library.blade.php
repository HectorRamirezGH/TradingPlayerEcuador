<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Library') }}
        </h2>
    </x-slot>

    <div class="py-12 fade-in-div">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="overflow-hidden fade-in-div">
                <livewire:library-engine></livewire:library-engine>
            </div>
        </div>
    </div>
    
</x-app-layout>