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
                        @forelse($coleccionableTipos as $tipo)
                        <option value="{{ $tipo->id }}">{{ $tipo->tipo }}</option>
                        @empty
                        @endforelse
                    </select>
            </div>

            <div class="flex-col">
                <label for="countries" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-400">2: {{ __('Select a serie:') }}</label>
                    <select id="countries" wire:model="serieId" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                        <option></option>
                        @forelse($series as $serie)
                        <option value="{{ $serie->id }}">{{ $serie->serie }}</option>
                        @empty
                        @endforelse
                    </select>
            </div>
        </div>
    </div>

    <x-jet-section-border />

    <div class="overflow-hidden bg-white shadow-xl sm:rounded-lg">
        <div class="flex-col">
            <div class="px-4 py-3 sm:px-6">
                <div class="flex flex-row gap-4">
                    <div class="w-full mt-4 mb-2 py-3 place-items-center flex flex-row grid grid-cols-4 gap-6 rounded-lg border-gray-200 overflow-y-auto sm:px-6 h-96">
                        @forelse($coleccionables as $coleccionable)
                        <div class="w-48 bg-white border border-gray-200 shadow-md dark:bg-gray-800 dark:border-gray-700">
                            <a href="#">
                                <img class="object-cover" src="http://127.0.0.1:8000/storage/{{ $coleccionable->coleccionable_photo_path }}" alt="" />
                            </a>
                            <div class="p-2">
                                <p class="mb-3 font-normal text-gray-200">{{ $coleccionable->name }}</p>
                            </div>
                        </div>
                        @empty
                        <div class="col-span-4">
                            <p class="text-xl">{{__('Here you will see the results of your search')}}</p>
                        </div>
                        @endforelse
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>

