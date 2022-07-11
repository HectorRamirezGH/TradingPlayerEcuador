<div class="py-12">
    <div class="max-w-7xl mt-10 mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
            <div class="bg-white col-span-6 sm:col-span-4 px-4 py-3 h-32 sm:px-6">
                <x-jet-action-section>
                    <x-slot name="title">
                        {{ __('Colecctions') }}
                    </x-slot>

                    <x-slot name="description">
                        {{ __('Here you can look the current collections of ') }} {{$user->name}}
                        <div class="flex flex-col grid place-items-center">
                            <img class="shadow-md rounded-full object-cover mt-6" src="{{ $user->profile_photo_url }}" />
                        </div>
                    </x-slot>

                    <x-slot name="content">
                        <div class="text-sm text-gray-600">
                            <div class="shadow border-b border-gray-200 sm:rounded-lg">
                                <table class="min-w-full">
                                <thead class="border-b bg-gray-800">
                                    <tr>
                                    <th scope="col" class="max-w-xl text-sm font-medium text-white px-2 py-4">
                                        Name
                                    </th>
                                    <th scope="col" class="max-w-wl text-sm font-medium text-white px-2 py-4">
                                        Description
                                    </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($userCollections as $collection)
                                    <tr class="bg-white transition duration-300 ease-in-out hover:bg-gray-100">
                                    <td align="center" class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                                    {{ $collection->name }}
                                    </td>
                                    <td align="center" class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                                    {{ $collection->desc }}
                                    </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                                </table>
                            </div>
                        </div>
                    </x-slot>
                </x-jet-action-section>
            </div>
        </div>

        <x-jet-section-border />

        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">           
                <div class="flex flex-col">
                @foreach($userCollections as $coleccion)
                    <div class="flex flex-col">
                        
                        <div class="bg-white px-4 py-3 sm:px-6">
                            <div class="flex flex-row shadow-md sm:rounded-lg">
                                <h2 class="text-xl text-gray-800 px-4 py-3 leading-tight">
                                    {{ $coleccion->name }}
                                </h2>
                            </div>

                            <div class="flex flex-row gap-4 grid grid-cols-2 place-items-stretch">
                            <ul class="max-w-xl bg-white mt-4 mb-2 py-3 rounded-lg border-gray-200 shadow-md overflow-y-auto sm:px-6 h-80">            
                            {{ __('Want to buy') }}
                            @forelse($setcoleccionables as $setcoleccionable)
                                @if($setcoleccionable->coleccion == $coleccion->id && $setcoleccionable->tipo_set == 'b')
                                <li class="my-2 py-2 hover:bg-gray-100 rounded-lg px-2">
                                    <div class="flex flex-row grid grid-cols-4 gap-6 place-items-center">
                                        @foreach($coleccionables as $coleccionable)
                                            @if($setcoleccionable->coleccionable == $coleccionable->id)
                                            <div class="flex flex-col justify-self-start">
                                                <img wire:click="showCollectionModal({{ $coleccionable->id }})" class="h-10 w-10 shadow-md rounded-full object-cover" src="http://127.0.0.1:8000/storage/{{ $coleccionable->coleccionable_photo_path }}" />
                                                <strong style="text-transform:capitalize">{{ $coleccionable->name }}</strong>
                                            </div>
                                            @endif
                                        @endforeach
                                        <div class="flex flex-col">
                                            <p><small>$ {{$setcoleccionable->precio}} por unidad</small></p>
                                            <p class="flex flex-row place-items-center gap-2"><svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
                                            </svg> <small>{{$setcoleccionable->cant}}</small></p>
                                        </div>
                                    </div>
                                </li>
                                @endif
                            @empty
                            @endforelse
                            </ul>
                            <ul class="max-w-xl bg-white mt-4 mb-2 py-3 rounded-lg border-gray-200 shadow-md overflow-y-auto sm:px-6 h-80">            
                            Want to sell
                            @forelse($setcoleccionables as $setcoleccionable)
                                @if($setcoleccionable->coleccion == $coleccion->id && $setcoleccionable->tipo_set == 's')
                                <li class="my-2 py-2 hover:bg-gray-100 rounded-lg px-2">
                                    <div class="flex flex-row grid grid-cols-4 gap-6 place-items-center">
                                        @foreach($coleccionables as $coleccionable)
                                            @if($setcoleccionable->coleccionable == $coleccionable->id)
                                            <div class="flex flex-col justify-self-start">
                                                <img wire:click="showCollectionModal({{ $coleccionable->id }})" class="h-10 w-10 shadow-md rounded-full object-cover" src="http://127.0.0.1:8000/storage/{{ $coleccionable->coleccionable_photo_path }}" />
                                                <strong style="text-transform:capitalize">{{ $coleccionable->name }}</strong>
                                            </div>
                                            @endif
                                        @endforeach
                                        <div class="flex flex-col">
                                            <p><small>$ {{$setcoleccionable->precio}} por unidad</small></p>
                                            <p class="flex flex-row place-items-center gap-2"><svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
                                            </svg> <small>{{$setcoleccionable->cant}}</small></p>
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
                            <div class="flex flex-col p-6">
                                @isset($col)
                                <img class="mx-auto shadow-md rounded-full object-cover" src="http://127.0.0.1:8000/storage/{{ $col->coleccionable_photo_path}}" alt="{{ $col->name }}" />
                                @endisset
                            </div>
                        </x-slot>

                        <x-slot name="form">
                            @forelse($carac_name as $c_name)
                            <div class="col-span-6">
                                <ul>
                                @isset($col_carac)
                                    @forelse($col_carac as $c_carac)
                                        @if($c_name->id == $c_carac->caracteristica)
                                            <li class="shadow-md sm:rounded-lg px-4 py-3">
                                                <p>{{$c_name->name}} : {{$c_carac->value}}</p>
                                            </li>
                                        @endif
                                    @empty
                                    @endforelse
                                @endisset

                                </ul>
                            </div>
                            @empty
                            @endforelse
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

    </div>
</div>