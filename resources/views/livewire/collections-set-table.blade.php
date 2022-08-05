<div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
    <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">           
        <div class="flex flex-col">

            <div class="flex flex-row">
                <div class="bg-white px-4 py-3 sm:px-6">
                    <h2 class="text-xl text-gray-800 leading-tight">
                        {{ __('Collections Sets') }}
                    </h2>
                </div>

                <div class="bg-white px-4 py-3 sm:px-6">
                    <p>{{ __('Here you can look on the sets of your current collections!') }}</p>
                </div>
            </div>

            @foreach($colecciones as $coleccion)
                <div class="flex flex-col">
                    
                    <div class="bg-gradient-to-b from-white via-violet-200 to-white px-4 py-3 sm:px-6">
                        <div class="bg-gray-800 flex flex-row shadow-md sm:rounded-lg">
                            <h2 class="text-xl text-white px-4 py-3 leading-tight">
                                {{ $coleccion->name }}
                            </h2>
                            <div class="text-xl text-gray-800 px-4 py-2 leading-tight">
                                <x-jet-button class="bg-emerald-500 hover:bg-emerald-700" wire:click="createSetModal({{ $coleccion->id }})" wire:loading.attr="disabled">
                                    {{ __('Create Set') }}
                                </x-jet-button>
                            </div>
                        </div>

                        <div class="flex flex-row gap-4 grid grid-cols-2 place-items-stretch">
                        <ul class="max-w-xl bg-gradient-to-bl from-white via-red-200 to-white mt-4 mb-2 py-3 rounded-lg border-gray-200 shadow-md overflow-y-auto sm:px-6 h-80">            
                        <div class="flex flex-row grid grid-cols-2 rounded-lg bg-gradient-to-l from-white to-red-400">
                            <p class="ml-2">{{ __('Want to buy') }}</p>
                        </div>
                        @forelse($setcoleccionables as $setcoleccionable)
                            @if($setcoleccionable->coleccion == $coleccion->id && $setcoleccionable->tipo_set == 'b')
                            <li class="my-2 py-1 border border-gray-400 rounded-lg px-2">
                                <div class="flex flex-row grid grid-cols-4 gap-2 place-items-center">
                                    @foreach($coleccionables as $coleccionable)
                                        @if($setcoleccionable->coleccionable == $coleccionable->id)
                                        <div class="flex flex-col justify-self-start">
                                            <div>
                                                <button wire:click="showCollectionModal({{ $coleccionable->id }})">
                                                <img class="h-10 w-10 shadow-md rounded-full object-cover" src="http://127.0.0.1:8000/storage/{{ $coleccionable->coleccionable_photo_path }}" />       
                                                </button>
                                            </div>
                                            <strong style="text-transform:capitalize">{{ $coleccionable->name }}</strong>
                                        </div>
                                        @break
                                        @endif
                                    @endforeach
                                    <div class="flex flex-col justify-self-start text-red-500">
                                        <p><small>$ {{$setcoleccionable->precio}} por unidad</small></p>
                                        <p class="flex flex-row place-items-center gap-1"><svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
                                        </svg><small>{{$setcoleccionable->cant}}</small></p>
                                    </div>
                                    <div class="flex flex-row gap-1">
                                        @if($setcoleccionable->visible == 0)
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                        </svg>
                                        Visible
                                        @elseif($setcoleccionable->visible == 1)
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21" />
                                        </svg>
                                        Invisible
                                        @endif
                                    </div>
                                    <div class="flex flex-col gap-2 place-items-center">
                                        <x-jet-button class="bg-yellow-500 hover:bg-yellow-600 text-center" wire:click="editSetModal({{ $setcoleccionable->id }})" wire:loading.attr="disabled">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                        </svg>
                                        </x-jet-button>
                                        <x-jet-button class="bg-purple-500 hover:bg-purple-600 text-center" wire:click="deleteSetModal({{ $setcoleccionable->id }})" wire:loading.attr="disabled">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                        </svg>
                                        </x-jet-button>
                                    </div>
                                </div>
                            </li>
                            @endif
                        @empty
                        @endforelse
                        </ul>
                        <ul class="max-w-xl bg-gradient-to-bl from-white via-emerald-200 mt-4 mb-2 py-3 rounded-lg border-gray-200 shadow-md overflow-y-auto sm:px-6 h-80">            
                        <div class="flex flex-row grid grid-cols-2 rounded-lg bg-gradient-to-l from-white to-emerald-400">
                            <p class="ml-2">{{ __('Want to sell') }}</p>
                        </div>
                        @forelse($setcoleccionables as $setcoleccionable)
                            @if($setcoleccionable->coleccion == $coleccion->id && $setcoleccionable->tipo_set == 's')
                            <li class="my-2 py-1 border border-gray-400 rounded-lg px-2">
                                <div class="flex flex-row grid grid-cols-4 gap-2 place-items-center">
                                    @foreach($coleccionables as $coleccionable)
                                        @if($setcoleccionable->coleccionable == $coleccionable->id)
                                        <div class="flex flex-col justify-self-start">
                                            <div>
                                                <button wire:click="showCollectionModal({{ $coleccionable->id }})">
                                                <img class="h-10 w-10 shadow-md rounded-full object-cover" src="http://127.0.0.1:8000/storage/{{ $coleccionable->coleccionable_photo_path }}" />     
                                                </button>
                                            </div>
                                            <strong style="text-transform:capitalize">{{ $coleccionable->name }}</strong>
                                        </div>
                                        @break
                                        @endif
                                    @endforeach
                                    <div class="flex flex-col justify-self-start text-green-500">
                                        <p><small>$ {{$setcoleccionable->precio}} por unidad</small></p>
                                        <p class="flex flex-row place-items-center gap-1"><svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
                                        </svg><small>{{$setcoleccionable->cant}}</small></p>
                                    </div>
                                    <div class="flex flex-row gap-1">
                                        @if($setcoleccionable->visible == 0)
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                        </svg>
                                        Visible
                                        @elseif($setcoleccionable->visible == 1)
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21" />
                                        </svg>
                                        Invisible
                                        @endif
                                    </div>
                                    <div class="flex flex-col gap-2 place-items-center">
                                        <x-jet-button class="bg-yellow-500 hover:bg-yellow-600 text-center" wire:click="editSetModal({{ $setcoleccionable->id }})" wire:loading.attr="disabled">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                        </svg>
                                        </x-jet-button>
                                        <x-jet-button class="bg-purple-500 hover:bg-purple-600 text-center" wire:click="deleteSetModal({{ $setcoleccionable->id }})" wire:loading.attr="disabled">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                        </svg>
                                        </x-jet-button>
                                    </div>
                                </div>
                            </li>
                            @endif
                        @empty
                        @endforelse
                        </ul>
                        </div>
                    </div>

                </div>  
            @endforeach
        </div>
    </div>
    <x-jet-dialog-modal wire:model="createSetModal">
        <x-slot name="title">
            {{ __('Set') }}
        </x-slot>

        <x-slot name="content">
        <x-jet-form-section submit="createSetCollection">
            <x-slot name="title">
                {{ __('Create Set') }}
            </x-slot>

            <x-slot name="description">
                {{ __('Select a set among the ones we have! you may choose as well the pricing of the set too!') }}
                @foreach($coleccionables as $coleccionable)
                    @if($search == $coleccionable->name)
                    <div class="flex flex-col items-center gap-4 p-6">
                        <img class="mx-auto shadow-md object-cover" src="http://127.0.0.1:8000/storage/{{ $coleccionable->coleccionable_photo_path}}" alt="{{ $coleccionable->name }}" />
                        <p>{{ $coleccionable->name }}</p>
                    </div>
                    @endif
                @endforeach
            </x-slot>

            <x-slot name="form">

                <div class="col-span-6 sm:col-span-4">
                    <x-jet-label for="name" value="{{ __('Name') }}" />
                    <x-jet-input type="text" list="names" class="mt-1 block w-full" wire:model="search" autocomplete="name" required/>
                    <datalist id="names" class="overflow-y-auto h-20">
                    @foreach($coleccionables as $coleccionable)
                        @if($search != '')
                        <option value="{{ $coleccionable->name }}">
                        @endif
                    @endforeach
                    </datalist>
                    <x-jet-input-error for="name" class="mt-2" />
                </div>

                <div class="col-span-6 sm:col-span-4">
                    <x-jet-label for="price" value="{{ __('Price Per Unit (in $)') }}" />
                    <x-jet-input id="price" type="number" class="mt-1 block w-full" min="0.01" step="0.01" wire:model.defer="state.price" autocomplete="price" required/>
                    <x-jet-input-error for="price" class="mt-2" />
                </div>

                <div class="col-span-6 sm:col-span-4">
                    <x-jet-label for="cant" value="{{ __('Quantity') }}" />
                    <x-jet-input id="cant" type="number" class="mt-1 block w-full" min="1" step="1" wire:model.defer="state.cant" autocomplete="cant" required/>
                    <x-jet-input-error for="cant" class="mt-2" />
                </div>

                <div class="flex flex-row max-w-xl px-4 py-1 gap-4 col-span-6 border rounded-lg items-center">
                    <x-jet-input id="visible" name="visible" type="radio" class="block" value="0" wire:model.defer="state.visible" autocomplete="visible" required/>
                    <x-jet-label for="visible" class="ml-3" value="{{ __('Visible') }}" />
                    <x-jet-input-error for="visible" class="mt-2" />
                    
                    <x-jet-input id="visible" name="visible" type="radio" class="block" value="1" wire:model.defer="state.visible" autocomplete="visible" />
                    <x-jet-label for="visible" class="ml-3" value="{{ __('Invisible') }}" />
                    <x-jet-input-error for="visible" class="mt-2" />
                </div>

                <div class="flex flex-row max-w-xl px-4 py-1 gap-4 col-span-6 border rounded-lg items-center">
                    <x-jet-input id="tipo_set" name="tipo_set" type="radio" class="block" value="s" wire:model.defer="state.tipo_set" autocomplete="tipo_set" required/>
                    <x-jet-label for="tipo_set" class="ml-3" value="{{ __('Want to sell') }}" />
                    <x-jet-input-error for="tipo_set" class="mt-2" />
                    
                    <x-jet-input id="tipo_set" name="tipo_set" type="radio" class="block" value="b" wire:model.defer="state.tipo_set" autocomplete="tipo_set" />
                    <x-jet-label for="tipo_set" class="ml-3" value="{{ __('Want to buy') }}" />
                    <x-jet-input-error for="tipo_set" class="mt-2" />
                </div>

            </x-slot>
            <x-slot name="actions">
                <x-jet-action-message class="mr-3 text-white" on="saved">
                    {{ __('Set successfully created!') }}
                </x-jet-action-message>

                <x-jet-button class="bg-emerald-500 hover:bg-emerald-700">
                {{ __('Create Set') }}
                </x-jet-button>
            </x-slot>
        </x-jet-form-section>
        </x-slot>

        <x-slot name="footer">
            <x-jet-secondary-button wire:click="$toggle('createSetModal')" wire:loading.attr="disabled">
                {{ __('Exit') }}
            </x-jet-secondary-button>
        </x-slot>
    </x-jet-dialog-modal>

    <x-jet-dialog-modal wire:model="editSetModal">
        <x-slot name="title">
            {{ __('Set') }}
        </x-slot>

        <x-slot name="content">
        <x-jet-form-section submit="editSetCollection">
            <x-slot name="title">
                {{ __('Edit Set') }}
            </x-slot>

            <x-slot name="description">
                {{ __('Make sure your Set is up to date!') }}
                @foreach($coleccionables as $coleccionable)
                    @if($search == $coleccionable->name)
                    <div class="flex flex-col items-center gap-4 p-6">
                        <img class="mx-auto shadow-md object-cover" src="http://127.0.0.1:8000/storage/{{ $coleccionable->coleccionable_photo_path}}" alt="{{ $coleccionable->name }}" />
                        <p>{{ $coleccionable->name }}</p>
                    </div>
                    @endif
                @endforeach
            </x-slot>

            <x-slot name="form">

                <div class="col-span-6 sm:col-span-4">
                    <x-jet-label for="name" value="{{ __('Name') }}" />
                    <x-jet-input type="text" list="names" class="mt-1 block w-full" wire:model="search" autocomplete="name" />
                    <datalist id="names" class="overflow-y-auto h-20">
                    @foreach($coleccionables as $coleccionable)
                        @if($search != '')
                        <option value="{{ $coleccionable->name }}">
                        @endif
                    @endforeach
                    </datalist>
                    <x-jet-input-error for="name" class="mt-2" />
                </div>

                <div class="col-span-6 sm:col-span-4">
                    <x-jet-label for="price" value="{{ __('Price Per Unit (in $)') }}" />
                    <x-jet-input id="price" type="number" class="mt-1 block w-full" step=".01" wire:model.defer="state.price" autocomplete="price" />
                    <x-jet-input-error for="price" class="mt-2" />
                </div>

                <div class="col-span-6 sm:col-span-4">
                    <x-jet-label for="cant" value="{{ __('Quantity') }}" />
                    <x-jet-input id="cant" type="number" class="mt-1 block w-full" step="1" wire:model.defer="state.cant" autocomplete="cant" />
                    <x-jet-input-error for="cant" class="mt-2" />
                </div>

                <div class="flex flex-row max-w-xl px-4 py-1 gap-4 col-span-6 border rounded-lg items-center">
                    <x-jet-input id="visible" name="visible" type="radio" class="block" value="0" wire:model.defer="state.visible" autocomplete="visible" />
                    <x-jet-label for="visible" class="ml-3" value="{{ __('Visible') }}" />
                    <x-jet-input-error for="visible" class="mt-2" />
                    
                    <x-jet-input id="visible" name="visible" type="radio" class="block" value="1" wire:model.defer="state.visible" autocomplete="visible" />
                    <x-jet-label for="visible" class="ml-3" value="{{ __('Invisible') }}" />
                    <x-jet-input-error for="visible" class="mt-2" />
                </div>

                <div class="flex flex-row max-w-xl px-4 py-1 gap-4 col-span-6 border rounded-lg items-center">
                    <x-jet-input id="tipo_set" name="tipo_set" type="radio" class="block" value="s" wire:model.defer="state.tipo_set" autocomplete="tipo_set" />
                    <x-jet-label for="tipo_set" class="ml-3" value="{{ __('Want to sell') }}" />
                    <x-jet-input-error for="tipo_set" class="mt-2" />
                    
                    <x-jet-input id="tipo_set" name="tipo_set" type="radio" class="block" value="b" wire:model.defer="state.tipo_set" autocomplete="tipo_set" />
                    <x-jet-label for="tipo_set" class="ml-3" value="{{ __('Want to buy') }}" />
                    <x-jet-input-error for="tipo_set" class="mt-2" />
                </div>

            </x-slot>
            <x-slot name="actions">
                <x-jet-action-message class="mr-3 text-white" on="updated">
                    {{ __('Set successfully updated!') }}
                </x-jet-action-message>

                <x-jet-button class="bg-emerald-500 hover:bg-emerald-700">
                {{ __('Update Set') }}
                </x-jet-button>
            </x-slot>
        </x-jet-form-section>
        </x-slot>

        <x-slot name="footer">
            <x-jet-secondary-button wire:click="$toggle('editSetModal')" wire:loading.attr="disabled">
                {{ __('Exit') }}
            </x-jet-secondary-button>
        </x-slot>
    </x-jet-dialog-modal>

    <x-jet-dialog-modal wire:model="deleteSetModal">
        <x-slot name="title">
            {{ __('Set') }}
        </x-slot>

        <x-slot name="content">
            {{ __('Are you sure you want to delete this Set?') }}
        </x-slot>

        <x-slot name="footer">
            <x-jet-secondary-button wire:click="$toggle('deleteSetModal')" wire:loading.attr="disabled">
                {{ __('Exit') }}
            </x-jet-secondary-button>
            <x-jet-danger-button class="ml-3" wire:click="deleteSetCollection" wire:loading.attr="disabled">
                {{ __('Delete Set') }}
            </x-jet-danger-button>
        </x-slot>
    </x-jet-dialog-modal>

    <x-jet-dialog-modal wire:model="showCollectionModal">
            <x-slot name="title">
                {{ __('Collectable') }}
            </x-slot>

            <x-slot name="content">
            <x-jet-form-section submit="editCollection">
                <x-slot name="title">
                    {{ __('') }}
                </x-slot>

                <x-slot name="description">
                    {{ __('Here you can see the characteristics of this collectable') }}
                    <div class="flex flex-col p-6 items-center gap-4">
                        @isset($col)
                        <img class="mx-auto shadow-md object-cover" src="http://127.0.0.1:8000/storage/{{ $col->coleccionable_photo_path}}" alt="{{ $col->name }}" />
                        <p>{{ $col->name }}</p>
                        @endisset
                    </div>
                </x-slot>

                <x-slot name="form">
                    <ul class="col-span-6 px-2 overflow-y-auto h-96 bg-gradient-to-b from-white via-violet-200 to-white rounded-lg">
                        @forelse($carac_name as $c_name)
                            @isset($col_carac)
                                @forelse($col_carac as $c_carac)
                                    @if($c_name->id == $c_carac->caracteristica)
                                        <li class="shadow-md sm:rounded-lg px-4 py-3 my-2">
                                            <p>{{$c_name->name}}: {{$c_carac->value}}</p>
                                        </li>
                                    @endif
                                @empty
                                @endforelse
                            @endisset
                        @empty
                        @endforelse
                    </ul>
                </x-slot>
            </x-jet-form-section>
            </x-slot>

            <x-slot name="footer">
                <x-jet-secondary-button wire:click="$toggle('showCollectionModal')" wire:loading.attr="disabled">
                    {{ __('Exit') }}
                </x-jet-secondary-button>
            </x-slot>
        </x-jet-dialog-modal>
</div>