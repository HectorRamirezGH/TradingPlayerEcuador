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
                <p>{{ __('Here you can look on the sets of your current collections') }}</p>
            </div>
        </div>

        @foreach($colecciones as $coleccion)
            <div class="flex flex-col">
                
                <div class="bg-white px-4 py-3 sm:px-6">
                    <div class="flex flex-row border border-gray-300 shadow-md sm:rounded-lg">
                        <h2 class="text-xl text-gray-800 px-4 py-3 leading-tight">
                            {{ $coleccion->name }}
                        </h2>
                        <div class="text-xl text-gray-800 px-4 py-2 leading-tight">
                            <x-jet-button class="bg-emerald-500 hover:bg-emerald-700" wire:click="createSetModal({{ $coleccion->id }})" wire:loading.attr="disabled">
                                {{ __('Create Set') }}
                            </x-jet-button>
                        </div>
                    </div>
                    
                    <ul class="bg-white mt-4 mb-2 py-3 rounded-lg border-gray-200 shadow-md overflow-y-auto sm:px-6 h-80">            
                    @forelse($setcoleccionables as $setcoleccionable)
                        @if($setcoleccionable->coleccion == $coleccion->id)
                        <li class="my-2 py-4 hover:bg-gray-100 rounded-lg px-2" type="button" wire:click="">
                            <div class="flex">
                                <div class="flex flex-col">
                                    <img class="h-10 w-10 shadow-md rounded-full object-cover" src="http://127.0.0.1:8000/storage/" alt="" />
                                </div>
                                <div class="flex flex-col px-4">
                                    <strong style="text-transform:capitalize">{{ $setcoleccionable->name }}</strong>
                                </div>
                            </div>
                        </li>
                        @endif
                    @empty
                    @endforelse
                    </ul>
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
        <x-jet-form-section submit="createCollection">
            <x-slot name="title">
                {{ __('Create Set') }}
            </x-slot>

            <x-slot name="description">
                {{ __('Select a set among the ones we have! you may choose as well the pricing of the set too!') }}
                @foreach($coleccionables as $coleccionable)
                    @if($search == $coleccionable->name)
                    <div class="flex flex-col p-6">
                        <img class="mx-auto shadow-md rounded-full object-cover" src="http://127.0.0.1:8000/storage/{{ $coleccionable->coleccionable_photo_path}}" alt="{{ $coleccionable->name }}" />
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
                    <x-jet-label for="visible" class="ml-3" value="{{ __('Not Visible') }}" />
                    <x-jet-input-error for="visible" class="mt-2" />
                </div>

                <div class="flex flex-row max-w-xl px-4 py-1 gap-4 col-span-6 border rounded-lg items-center">
                    <x-jet-input id="tipo_set" name="tipo_set" type="radio" class="block" value="s" wire:model.defer="state.tipo_set" autocomplete="tipo_set" />
                    <x-jet-label for="tipo_set" class="ml-3" value="{{ __('Want To Sell') }}" />
                    <x-jet-input-error for="tipo_set" class="mt-2" />
                    
                    <x-jet-input id="tipo_set" name="tipo_set" type="radio" class="block" value="b" wire:model.defer="state.tipo_set" autocomplete="tipo_set" />
                    <x-jet-label for="tipo_set" class="ml-3" value="{{ __('Want To Buy') }}" />
                    <x-jet-input-error for="tipo_set" class="mt-2" />
                </div>

            </x-slot>
            <x-slot name="actions">
                <x-jet-action-message class="mr-3" on="saved">
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
</div>