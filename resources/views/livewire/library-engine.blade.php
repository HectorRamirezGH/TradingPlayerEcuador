<div class="flex flex-col">
    
    <div class="flex flex-row grid grid-cols-3 place-items-stretch">
        <div class="flex-col">
            <p class="text-gray-200 text-xl leading-tight">{{ __('Filters') }}</p>
            <p class="text-gray-400 mt-2">{{ __('Select the filters you want to use!') }}</p>
        </div>
        
        <div class="flex flex-row bg-white col-span-2 rounded-lg gap-6 px-4 py-5 sm:p-6">
            <div class="flex-col">
                <label for="countries" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-400">1: {{ __('Select a type of collectable:') }}</label>
                    <select id="countries" wire:model="tipoId" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                        <option selected></option>
                        @forelse($coleccionableTipos as $tipo)
                        <option value="{{ $tipo->id }}">{{ $tipo->tipo }}</option>
                        @empty
                        @endforelse
                    </select>
            </div>

            <div class="flex-col">
                <label for="countries" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-400">2: {{ __('Select a serie:') }}</label>
                    <select id="countries" wire:model="serieId" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                        <option selected></option>
                        @forelse($series as $serie)
                        <option value="{{ $serie->id }}">{{ $serie->serie }}</option>
                        @empty
                        @endforelse
                    </select>
            </div>
        </div>
    </div>

    <x-jet-section-border />

    <div class="overflow-hidden shadow-xl sm:rounded-lg">           
        <div class="flex flex-col">
            <div class="flex flex-col">
                <div class="bg-white px-4 py-3 sm:px-6">
                    <div class="flex flex-row gap-4 grid grid-cols-2 place-items-stretch">
                        <ul class="max-w-xl bg-gradient-to-bl from-white via-red-200 to-white mt-4 mb-2 py-3 rounded-lg border-gray-200 shadow-md overflow-y-auto sm:px-6 h-96">            
                        <div class="flex flex-row grid grid-cols-2 rounded-lg bg-gradient-to-l from-white to-red-400">
                            <p class="ml-2">{{ __('Want to buy') }}</p>
                            <p class="justify-self-end mr-8">{{ __('Collectionists') }}</p>
                        </div>
                        @forelse($setcoleccionables as $setcoleccionable)
                            @if($setcoleccionable->tipo_set == 'b' && $setcoleccionable->visible == 0)
                            <li class="my-2 py-1 border border-gray-400 rounded-lg px-2">
                                <div class="flex flex-row grid grid-cols-3 place-items-center">
                                    @foreach($coleccionables as $coleccionable)
                                        @if($setcoleccionable->coleccionable == $coleccionable->id)
                                        <div class="flex flex-col justify-self-start">
                                            <div>
                                                <button class="tooltip-right" wire:click="searchColeccionable({{ $coleccionable->id }})">
                                                <img class="h-10 w-10 shadow-md rounded-full object-cover" src="http://127.0.0.1:8000/storage/{{ $coleccionable->coleccionable_photo_path }}" />
                                                <span class="tooltiptext-right">Mas Info</span>        
                                                </button>
                                            </div>
                                            <strong style="text-transform:capitalize">{{ $coleccionable->name }}</strong>
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
                                    @foreach($colecciones as $coleccion)
                                        @foreach($users as $user)
                                            @if($setcoleccionable->coleccion == $coleccion->id && $coleccion->user == $user->id)
                                            <div class="flex flex-col gap-1 justify-self-end items-center">
                                                <div class="flex flex-row place-items-center gap-4">
                                                    <button class="tooltip" wire:click="showUserPublicProfile({{$user->id}})">
                                                        <img class="h-10 w-10 rounded-full object-cover" src="{{ $user->profile_photo_url }}" />
                                                        <span class="tooltiptext">Perfil del usuario</span>
                                                    </button>                                           
                                                    <button class="tooltip" wire:click="startChat({{$user->id}})">
                                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" viewBox="0 0 20 20" fill="currentColor">
                                                        <path d="M2 5a2 2 0 012-2h7a2 2 0 012 2v4a2 2 0 01-2 2H9l-3 3v-3H4a2 2 0 01-2-2V5z" />
                                                        <path d="M15 7v2a4 4 0 01-4 4H9.828l-1.766 1.767c.28.149.599.233.938.233h2l3 3v-3h2a2 2 0 002-2V9a2 2 0 00-2-2h-1z" />
                                                        </svg>
                                                        <span class="tooltiptext">Chatea conmigo</span>
                                                    </button>
                                                </div>
                                                <strong style="text-transform:capitalize">{{ $user->name }}</strong>
                                            </div>
                                            @endif
                                        @endforeach
                                    @endforeach
                                </div>
                            </li>
                            @endif
                        @empty
                        @endforelse
                        </ul>
                        <ul class="max-w-xl bg-gradient-to-bl from-white via-emerald-200 to-white mt-4 mb-2 py-3 rounded-lg border-gray-200 shadow-md overflow-y-auto sm:px-6 h-96">            
                        <div class="flex flex-row grid grid-cols-2 rounded-lg bg-gradient-to-l from-white to-emerald-400">
                            <p class="ml-2">{{ __('Want to sell') }}</p>
                            <p class="justify-self-end mr-8">{{ __('Collectionists') }}</p>
                        </div>
                        @forelse($setcoleccionables as $setcoleccionable)
                            @if($setcoleccionable->tipo_set == 's' && $setcoleccionable->visible == 0)
                            <li class="my-2 py-1 border border-gray-400 rounded-lg px-2">
                                <div class="flex flex-row grid grid-cols-3 place-items-center">
                                    @foreach($coleccionables as $coleccionable)
                                        @if($setcoleccionable->coleccionable == $coleccionable->id)
                                        <div class="flex flex-col justify-self-start">
                                            <div>
                                                <button class="tooltip-right" wire:click="searchColeccionable({{ $coleccionable->id }})">
                                                <img class="h-10 w-10 shadow-md rounded-full object-cover" src="http://127.0.0.1:8000/storage/{{ $coleccionable->coleccionable_photo_path }}" />
                                                <span class="tooltiptext-right">Mas Info</span>        
                                                </button>
                                            </div>
                                            <strong style="text-transform:capitalize">{{ $coleccionable->name }}</strong>
                                        </div>
                                        @endif
                                    @endforeach
                                    <div class="flex flex-col justify-self-start text-green-500">
                                        <p>$ {{$setcoleccionable->precio}} por unidad</p>
                                        <p class="flex flex-row place-items-center gap-1"><svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
                                        </svg>{{$setcoleccionable->cant}}</p>
                                    </div>
                                    @foreach($colecciones as $coleccion)
                                        @foreach($users as $user)
                                            @if($setcoleccionable->coleccion == $coleccion->id && $coleccion->user == $user->id)
                                            <div class="flex flex-col gap-1 justify-self-end items-center">
                                                <div class="flex flex-row place-items-center gap-4">
                                                    <button class="tooltip" wire:click="showUserPublicProfile({{$user->id}})">
                                                        <img class="h-10 w-10 rounded-full object-cover" src="{{ $user->profile_photo_url }}" />
                                                        <span class="tooltiptext">Perfil del usuario</span>
                                                    </button>                                           
                                                    <button class="tooltip" wire:click="startChat({{$user->id}})">
                                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" viewBox="0 0 20 20" fill="currentColor">
                                                        <path d="M2 5a2 2 0 012-2h7a2 2 0 012 2v4a2 2 0 01-2 2H9l-3 3v-3H4a2 2 0 01-2-2V5z" />
                                                        <path d="M15 7v2a4 4 0 01-4 4H9.828l-1.766 1.767c.28.149.599.233.938.233h2l3 3v-3h2a2 2 0 002-2V9a2 2 0 00-2-2h-1z" />
                                                        </svg>
                                                        <span class="tooltiptext">Chatea conmigo</span>
                                                    </button>
                                                </div>
                                                <strong style="text-transform:capitalize">{{ $user->name }}</strong>
                                            </div>
                                            @endif
                                        @endforeach
                                    @endforeach
                                </div>
                            </li>
                            @endif
                        @empty
                        @endforelse
                        </ul>
                    </div>
                </div>
            </div>  
        </div>
    </div>


</div>

