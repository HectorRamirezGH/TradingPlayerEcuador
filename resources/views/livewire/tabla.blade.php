<div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">           
    <div class="flex flex-col">
        <div class="flex flex-col">
            <div class="bg-white px-4 py-3 sm:px-6">
                <div class="flex flex-row gap-4 grid grid-cols-2 place-items-stretch">
                <ul class="max-w-xl bg-white mt-4 mb-2 py-3 rounded-lg border-gray-200 shadow-md overflow-y-auto sm:px-6 h-96">            
                {{ __('Want to buy') }}
                @forelse($setcoleccionables as $setcoleccionable)
                    @if($setcoleccionable->tipo_set == 'b' && $setcoleccionable->visible == 1)
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
                            @foreach($colecciones as $coleccion)
                                @foreach($users as $user)
                                    @if($setcoleccionable->coleccion == $coleccion->id && $coleccion->user == $user->id)
                                    <div>
                                        <img wire:click="" class="h-10 w-10 shadow-md rounded-full object-cover" src="{{ $user->profile_photo_url }}" />
                                    </div>
                                    <div>
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
                <ul class="max-w-xl bg-white mt-4 mb-2 py-3 rounded-lg border-gray-200 shadow-md overflow-y-auto sm:px-6 h-96">            
                Want to sell
                @forelse($setcoleccionables as $setcoleccionable)
                    @if($setcoleccionable->tipo_set == 's' && $setcoleccionable->visible == 1)
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
                            @foreach($colecciones as $coleccion)
                                @foreach($users as $user)
                                    @if($setcoleccionable->coleccion == $coleccion->id && $coleccion->user == $user->id)
                                    <div>
                                        <img wire:click="showUserPublicProfile({{$user->id}})" class="h-10 w-10 shadow-md rounded-full object-cover" src="{{ $user->profile_photo_url }}" />
                                    </div>
                                    <div>
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