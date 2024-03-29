<x-jet-action-section>
    <x-slot name="title">
        <p class="text-gray-200">{{ __('Colecctions') }}</p>
    </x-slot>

    <x-slot name="description">
        <p class="text-gray-400">{{ __('Here you can look on your current collections!') }}</p>
    </x-slot>

    <x-slot name="content">
        <div class="text-sm text-gray-600 overflow-y-auto h-72">
            <div class="overflow-hidden shadow">
                <table class="min-w-full">
                <thead class="border-b bg-gray-800">
                    <tr>
                    <th scope="col" class="w-48 text-sm font-medium text-white px-2 py-4">
                        Name
                    </th>
                    <th scope="col" class="w-60 text-sm font-medium text-white px-2 py-4">
                        Description
                    </th>
                    <th scope="col" class="w-48 text-sm font-medium text-white px-2 py-4">
                        Edit
                    </th>
                    <th scope="col" class="w-48 text-sm font-medium text-white px-2 py-4">
                        Delete
                    </th>
                    </tr>
                </thead>
                <tbody class="bg-gradient-to-bl from-white via-indigo-200 to-white">
                    @foreach ($userCollections as $collection)
                    <tr>
                    <td align="center" class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                    {{ $collection->name }}
                    </td>
                    <td align="center" class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                    {{ $collection->desc }}
                    </td>
                    <td align="center" class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                    <x-jet-button class="bg-yellow-500 hover:bg-yellow-600" wire:click="editCollectionModal({{ $collection->id }})" wire:loading.attr="disabled">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                        </svg>
                    </x-jet-button>
                    </td>
                    <td align="center" class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                    <x-jet-button class="bg-purple-500 hover:bg-purple-600" wire:click="deleteCollectionModal({{ $collection->id }})" wire:loading.attr="disabled">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                        </svg>
                    </x-jet-button>
                    </td>
                    </tr>
                    @endforeach
                </tbody>
                </table>
            </div>
        </div>

        <div class="mt-5">
            <x-jet-button class="bg-emerald-500 hover:bg-emerald-700" wire:click="createCollectionModal" wire:loading.attr="disabled">
                {{ __('Create Collection') }}
            </x-jet-button>
        </div>

        <!-- Create Collection User Confirmation Modal -->
        <x-jet-dialog-modal wire:model="createCollectionModal">
            <x-slot name="title">
                {{ __('Collection') }}
            </x-slot>

            <x-slot name="content">
            <x-jet-form-section submit="createCollection">
                <x-slot name="title">
                    {{ __('Create Collection') }}
                </x-slot>

                <x-slot name="description">
                    {{ __('Make sure your collection is the greatest!') }}
                </x-slot>

                <x-slot name="form">
                    <div class="col-span-6 sm:col-span-4">
                        <x-jet-label for="name" value="{{ __('Name of Collection') }}" />
                        <x-jet-input id="name" type="text" class="mt-1 block w-full" wire:model.defer="state.name" autocomplete="name" />
                        <x-jet-input-error for="name" class="mt-2" />
                        
                    </div>

                    <div class="col-span-6 sm:col-span-4">
                        <x-jet-label for="desc" value="{{ __('Description') }}" />
                        <x-jet-input id="desc" type="text" class="mt-1 block w-full" wire:model.defer="state.desc" autocomplete="desc" />
                        <x-jet-input-error for="desc" class="mt-2" />
                    </div>

                </x-slot>
                <x-slot name="actions">
                    <x-jet-action-message class="mr-3 text-white" on="saved">
                        {{ __('Collection Successfully Created!') }}
                    </x-jet-action-message>

                    <x-jet-button class="bg-emerald-500 hover:bg-emerald-700">
                    {{ __('Create Collection') }}
                    </x-jet-button>
                </x-slot>
            </x-jet-form-section>
            </x-slot>

            <x-slot name="footer">
                <x-jet-secondary-button wire:click="$toggle('createCollectionModal')" wire:loading.attr="disabled">
                    {{ __('Exit') }}
                </x-jet-secondary-button>
            </x-slot>
        </x-jet-dialog-modal>

        <x-jet-dialog-modal wire:model="editCollectionModal">
            <x-slot name="title">
                {{ __('Collection') }}
            </x-slot>

            <x-slot name="content">
            <x-jet-form-section submit="editCollection">
                <x-slot name="title">
                    {{ __('Edit Collection') }}
                </x-slot>

                <x-slot name="description">
                    {{ __('Make sure your collection is the up to date!') }}
                </x-slot>

                <x-slot name="form">
                    <div class="col-span-6 sm:col-span-4">
                        <x-jet-label for="name" value="{{ __('Name of Collection') }}" />
                        <x-jet-input id="name" type="text" class="mt-1 block w-full" wire:model.defer="state.name" autocomplete="name" />
                        <x-jet-input-error for="name" class="mt-2" />
                    </div>

                    <div class="col-span-6 sm:col-span-4">
                        <x-jet-label for="desc" value="{{ __('Description') }}" />
                        <x-jet-input id="desc" type="text" class="mt-1 block w-full" wire:model.defer="state.desc" autocomplete="desc" />
                        <x-jet-input-error for="desc" class="mt-2" />
                    </div>

                </x-slot>
                <x-slot name="actions">
                    <x-jet-action-message class="mr-3 text-white" on="updated">
                        {{ __('Collection Successfully Updated!') }}
                    </x-jet-action-message>

                    <x-jet-button class="bg-emerald-500 hover:bg-emerald-700">
                        {{ __('Update Collection') }}
                    </x-jet-button>
                </x-slot>
            </x-jet-form-section>
            </x-slot>

            <x-slot name="footer">
                <x-jet-secondary-button wire:click="$toggle('editCollectionModal')" wire:loading.attr="disabled">
                    {{ __('Exit') }}
                </x-jet-secondary-button>
            </x-slot>
        </x-jet-dialog-modal>

        <x-jet-dialog-modal wire:model="deleteCollectionModal">
            <x-slot name="title">
                {{ __('Collection') }}
            </x-slot>

            <x-slot name="content">
                {{ __('Are you sure you want to delete this collection?') }}
            </x-slot>

            <x-slot name="footer">
                <x-jet-secondary-button wire:click="$toggle('deleteCollectionModal')" wire:loading.attr="disabled">
                    {{ __('Exit') }}
                </x-jet-secondary-button>
                <x-jet-danger-button class="ml-3" wire:click="deleteCollection" wire:loading.attr="disabled">
                    {{ __('Delete Collection') }}
                </x-jet-danger-button>
            </x-slot>
        </x-jet-dialog-modal>

    </x-slot>

</x-jet-action-section>