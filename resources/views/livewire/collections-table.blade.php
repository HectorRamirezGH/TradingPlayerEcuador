<x-jet-action-section>
    <x-slot name="title">
        {{ __('Colecctions') }}
    </x-slot>

    <x-slot name="description">
        {{ __('Here you can look on your current collections!') }}
    </x-slot>

    <x-slot name="content">
        <div class="text-sm text-gray-600">
            <div class="overflow-hidden shadow border-b border-gray-200 sm:rounded-lg">
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
                <tbody>
                    @foreach ($userCollections as $collection)
                    <tr class="bg-white transition duration-300 ease-in-out hover:bg-gray-100">
                    <td align="center" class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                    {{ $collection->name }}
                    </td>
                    <td align="center" class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                    {{ $collection->desc }}
                    </td>
                    <td align="center" class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                    <x-jet-button class="bg-blue-700 hover:bg-blue-800" wire:click="editCollectionModal({{ $collection->id }})" wire:loading.attr="disabled">
                        {{ __('Edit') }}
                    </x-jet-button>
                    </td>
                    <td align="center" class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                    <x-jet-button class="bg-rose-700 hover:bg-rose-800" wire:click="deleteCollectionModal({{ $collection->id }})" wire:loading.attr="disabled">
                        {{ __('Delete') }}
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
                {{ __('Create collection') }}
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
                    <x-jet-action-message class="mr-3" on="saved">
                        {{ __('Collection successfully created!') }}
                    </x-jet-action-message>

                    <x-jet-button class="bg-emerald-500 hover:bg-emerald-700">
                    {{ __('Create collection') }}
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
                    {{ __('Update Collection') }}
                </x-slot>

                <x-slot name="description">
                    {{ __('Make sure your collection is the up to!') }}
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
                    <x-jet-action-message class="mr-3" on="updated">
                        {{ __('Collection successfully updated!') }}
                    </x-jet-action-message>

                    <x-jet-button class="bg-emerald-500 hover:bg-emerald-700">
                        {{ __('Update collection') }}
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