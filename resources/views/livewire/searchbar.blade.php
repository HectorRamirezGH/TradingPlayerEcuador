<div class="bg-white col-span-6 sm:col-span-4 px-4 py-3 h-32 sm:px-6">
<x-jet-form-section submit="searchColeccionable">
        <x-slot name="title">
        </x-slot>

        <x-slot name="description">
            @foreach($coleccionables as $coleccionable)
                @if($search == $coleccionable->name)
                <div class="flex flex-col p-6">
                    <img class="mx-auto shadow-md rounded-full object-cover" src="http://127.0.0.1:8000/storage/{{ $coleccionable->coleccionable_photo_path}}" alt="{{ $coleccionable->name }}" />
                </div>
                @endif
            @endforeach
        </x-slot>

        <x-slot name="form">
        <div class="col-span-6">
        <x-jet-input type="text" list="names" class="mt-1 block w-full" wire:model="search" autocomplete="name" placeholder="search"/>
        <datalist id="names" class="overflow-y-auto h-10">
            @foreach($coleccionables as $coleccionable)
                @if($search != '')
                <option value="{{ $coleccionable->name }}">
                @endif
            @endforeach
        </datalist>
        </div>

        </x-slot>
        <x-slot name="actions">
        <x-jet-action-message class="mr-3" on="saved">
                    {{ __('Set successfully created!') }}
                </x-jet-action-message>
            <x-jet-button class="bg-emerald-500 hover:bg-emerald-700">
                {{ __('Search!') }}
            </x-jet-button>
        </x-slot>
    </x-jet-form-section>
</div>   