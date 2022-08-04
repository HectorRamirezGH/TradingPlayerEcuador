<div class="py-12">
    <div class="max-w-7xl mt-10 mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
            <div class="bg-white col-span-6 sm:col-span-4 px-4 py-3 h-32 sm:px-6">
                <x-jet-form-section submit="searchColeccionable">
                    <x-slot name="title">
                    </x-slot>

                    <x-slot name="description">
                        @foreach($coleccionables as $coleccionable)
                            @if($coleccionable->id == $id_col)
                            <div class="flex flex-col items-center gap-4 p-6">
                                <img class="mx-auto shadow-md object-cover" src="http://127.0.0.1:8000/storage/{{ $coleccionable->coleccionable_photo_path}}" alt="{{ $coleccionable->name }}" />
                                <p>{{ $coleccionable->name }}</p>
                            </div>
                            @endif
                        @endforeach
                    </x-slot>

                    <x-slot name="form">
                        
                        <div class="col-span-6 px-2 overflow-y-auto h-96 bg-gradient-to-b from-white via-violet-200 to-white rounded-lg">
                            <ul>
                            @forelse($carac_name as $c_name)
                                @forelse($col_carac as $c_carac)
                                    @if($c_name->id == $c_carac->caracteristica)
                                        <li class="shadow-md sm:rounded-lg px-4 py-3 my-2">
                                            <p>{{$c_name->name}} : {{$c_carac->value}}</p>
                                        </li>
                                    @endif
                                @empty
                                @endforelse
                            @empty
                            @endforelse

                            </ul>
                        </div>
                        
                    </x-slot>
                </x-jet-form-section>
                
            </div> 

        </div>

        <x-jet-section-border />

        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
            <div class="flex flex-col">
                <div class="bg-white px-4 py-3 sm:px-6">
                    <div class="flex flex-row gap-4 grid grid-cols-2 place-items-stretch">
                        <ul class="max-w-xl bg-gradient-to-bl from-white via-red-200 to-white mt-4 mb-2 py-3 rounded-lg border-gray-200 shadow-md overflow-y-auto sm:px-6 h-96">            
                        <div class="flex flex-row grid grid-cols-2 rounded-lg bg-gradient-to-l from-white to-red-400">
                            <p class="ml-2">{{ __('Want to buy') }}</p>
                            <p class="justify-self-end mr-8">{{ __('Collectionists') }}</p>
                        </div>
                        @forelse($setcoleccionables as $setcoleccionable)
                            @if($setcoleccionable->tipo_set == 'b' && $setcoleccionable->coleccionable == $id_col && $setcoleccionable->visible == 1)
                            <li class="my-2 py-1 border border-gray-400 rounded-lg px-2">
                                <div class="flex flex-row grid grid-cols-3 place-items-center">
                                    @foreach($coleccionables as $coleccionable)
                                        @if($setcoleccionable->coleccionable == $coleccionable->id)
                                        <div class="flex flex-col justify-self-start">
                                            <img class="h-10 w-10 shadow-md rounded-full object-cover" src="http://127.0.0.1:8000/storage/{{ $coleccionable->coleccionable_photo_path }}" />
                                            <strong style="text-transform:capitalize">{{ $coleccionable->name }}</strong>
                                        </div>
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
                                                    <button>
                                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" viewBox="0 0 20 20" fill="currentColor">
                                                        <path d="M8 3a1 1 0 011-1h2a1 1 0 110 2H9a1 1 0 01-1-1z" />
                                                        <path d="M6 3a2 2 0 00-2 2v11a2 2 0 002 2h8a2 2 0 002-2V5a2 2 0 00-2-2 3 3 0 01-3 3H9a3 3 0 01-3-3z" />
                                                        </svg>
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
                            @if($setcoleccionable->tipo_set == 's' && $setcoleccionable->coleccionable == $id_col && $setcoleccionable->visible == 1)
                            <li class="my-2 py-1 border border-gray-400 rounded-lg px-2">
                                <div class="flex flex-row grid grid-cols-3 place-items-center">
                                    @foreach($coleccionables as $coleccionable)
                                        @if($setcoleccionable->coleccionable == $coleccionable->id)
                                        <div class="flex flex-col justify-self-start">
                                            <img class="h-10 w-10 shadow-md rounded-full object-cover" src="http://127.0.0.1:8000/storage/{{ $coleccionable->coleccionable_photo_path }}" />
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
                                                    <button>
                                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" viewBox="0 0 20 20" fill="currentColor">
                                                        <path d="M8 3a1 1 0 011-1h2a1 1 0 110 2H9a1 1 0 01-1-1z" />
                                                        <path d="M6 3a2 2 0 00-2 2v11a2 2 0 002 2h8a2 2 0 002-2V5a2 2 0 00-2-2 3 3 0 01-3 3H9a3 3 0 01-3-3z" />
                                                        </svg>
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