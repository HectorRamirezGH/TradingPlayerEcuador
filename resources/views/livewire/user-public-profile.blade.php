<div class="py-12 fade-in-div">
    <div class="max-w-7xl mt-10 mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
            <div class="bg-white col-span-6 sm:col-span-4 px-4 py-3 h-32 sm:px-6">
                <x-jet-action-section>
                    <x-slot name="title">
                        {{ __('Collections') }}
                    </x-slot>

                    <x-slot name="description">
                        {{ __('Here you can look the current collections of ') }} {{$user->name}}
                        <div class="flex flex-col gap-1 items-center">
                            <div class="flex flex-row grid grid-cols-2 place-items-center gap-4 mt-6">
                                <img class="h-20 w-20 rounded-full object-cover" src="{{ $user->profile_photo_url }}" />

                                <button wire:click="startChat({{$user->id}})">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-20 w-20" viewBox="0 0 20 20" fill="currentColor">
                                    <path d="M2 5a2 2 0 012-2h7a2 2 0 012 2v4a2 2 0 01-2 2H9l-3 3v-3H4a2 2 0 01-2-2V5z" />
                                    <path d="M15 7v2a4 4 0 01-4 4H9.828l-1.766 1.767c.28.149.599.233.938.233h2l3 3v-3h2a2 2 0 002-2V9a2 2 0 00-2-2h-1z" />
                                    </svg>
                                </button>
                            </div>
                        </div>
                    </x-slot>

                    <x-slot name="content">
                        <div class="text-sm text-gray-600 overflow-y-auto h-72">
                            <div class="flex flex-row grid place-items-stretch shadow sm:rounded-lg">
                                <table class="min-w-full">
                                <thead class="border-b bg-gray-800">
                                    <tr>
                                    <th scope="col" class="max-w-xl text-sm font-medium text-white px-2 py-4">
                                        Nombre
                                    </th>
                                    <th scope="col" class="max-w-wl text-sm font-medium text-white px-2 py-4">
                                        Descripción
                                    </th>
                                    </tr>
                                </thead>
                                <tbody class="bg-gradient-to-bl from-white via-indigo-200 to-white "> 
                                    @foreach ($userCollections as $collection)
                                    <tr>
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
                        
                        <div class="bg-gradient-to-b from-white via-violet-200 to-white px-4 py-3 sm:px-6">
                            <div class="bg-gray-800 flex flex-row shadow-md sm:rounded-lg">
                                <h2 class="text-xl text-white px-4 py-3 leading-tight">
                                    {{ $coleccion->name }}
                                </h2>
                            </div>

                            <div class="flex flex-row gap-4 grid grid-cols-2 place-items-stretch">
                            <ul class="max-w-xl bg-gradient-to-bl from-white via-red-200 to-white mt-4 mb-2 py-3 rounded-lg border-gray-200 shadow-md overflow-y-auto sm:px-6 h-80">            
                            <div class="flex flex-row grid grid-cols-2 rounded-lg bg-gradient-to-l from-white to-red-400">
                                <p class="ml-2">{{ __('Want to buy') }}</p>
                            </div>
                            @forelse($setcoleccionables as $setcoleccionable)
                                @if($setcoleccionable->coleccion == $coleccion->id && $setcoleccionable->tipo_set == 'b')
                                <li class="my-2 py-1 border border-gray-400 rounded-lg px-2">
                                    <div class="flex flex-row grid grid-cols-2 place-items-center">
                                        @foreach($coleccionables as $coleccionable)
                                            @if($setcoleccionable->coleccionable == $coleccionable->id)
                                            <div class="flex flex-col justify-self-start">
                                                <div>
                                                    <button wire:click="showCollectionModal({{ $coleccionable->id }})">
                                                    <img class="h-10 w-10 shadow-md rounded-full object-cover" src="http://127.0.0.1:8000/storage/{{ $coleccionable->coleccionable_photo_path }}" />
                                                    <span class="tooltiptext-right">Mas Info</span>        
                                                    </button>
                                                </div>
                                            </div>
                                            @break
                                            @endif
                                        @endforeach
                                        <div class="flex flex-col justify-self-start text-red-500">
                                            <p>$ {{$setcoleccionable->precio}} por unidad</p>
                                            <p class="flex flex-row place-items-center gap-1"><svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
                                            </svg>{{$setcoleccionable->cant}}</p>
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
                                    <div class="flex flex-row grid grid-cols-2 place-items-center">
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
                                            <p>$ {{$setcoleccionable->precio}} por unidad</p>
                                            <p class="flex flex-row place-items-center gap-1"><svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
                                            </svg>{{$setcoleccionable->cant}}</p>
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

    </div>
</div>