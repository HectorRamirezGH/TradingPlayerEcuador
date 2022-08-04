<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Chatroom') }}
        </h2>
    </x-slot>

    <div class="py-12 fade-in-div">
        <div class="max-w-7xl mt-10 mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg fade-in-div">
                <livewire:chatroom></livewire:chatroom>
            </div>
        </div>
    </div>
    
</x-app-layout>
