<div class="bg-gradient-to-bl from-white via-indigo-200 to-white shadow-xl col-span-6 sm:col-span-4 px-4 py-3 sm:px-6">
    <x-jet-form-section submit="searchColeccionable">
        <x-slot name="title">
        </x-slot>

        <x-slot name="description">
            <div class="rounded-full h-35 w-35 shadow-xl border flex p-6 items-center">
            @foreach($coleccionables as $coleccionable)
                @if($search == $coleccionable->name)
                <img class="w-28 h-28 object-contain" src="http://127.0.0.1:8000/storage/{{ $coleccionable->coleccionable_photo_path}}" alt="{{ $coleccionable->name }}" />
                @endif
            @endforeach
            </div>
        </x-slot>

        <x-slot name="form">
        <div class="flex col-span-6 items-center">
        <x-jet-input type="text" list="names" class="mt-1 block w-full" wire:model="search" autocomplete="name" placeholder="search"/>
        <datalist id="names" class="overflow-y-auto h-10">
            @foreach($coleccionables as $coleccionable)
                @if($search != '')
                <option value="{{ $coleccionable->name }}">
                @endif
            @endforeach
        </datalist>
        <div>
        <svg xmlns="http://www.w3.org/2000/svg" class="mx-2 h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
        <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
        </svg>
        </div>
        
        </div>

        </x-slot>
        <x-slot name="actions">
            <x-jet-button class="bg-emerald-500 hover:bg-emerald-700">
                {{ __('More Info!') }}
            </x-jet-button>
        </x-slot>
    </x-jet-form-section>
</div>   