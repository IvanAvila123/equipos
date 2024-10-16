<div>
    <x-primary-button wire:click='openModal'>Crear Rol</x-primary-button>

    <x-modal name="crear-rol" wire:model='modalVisible'>
        <div class="p-6">
            <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                {{ $roleId ? __('Editar Rol') : __('Crear Nuevo Rol') }}
            </h2>

            <div class="mt-6">
                <x-input-label for="name" value="{{ __('Rol') }}" />
                <x-text-input id="name" class="block w-full mt-1" type="text" wire:model.defer="name"
                    autocomplete="off" />
                @error('name')
                    <span class="mt-1 text-sm text-red-500">{{ $message }}</span>
                @enderror
            </div>

            <div class="mt-6">
                <x-input-label for="selectedPermissions" value="{{ __('Rol') }}" />
                <div class="mt-2">
                    @foreach($permissions as $permission)
                        <div class="flex items-start">
                            <div class="flex items-center h-5">
                                <x-text-input type="checkbox" wire:model.defer="selectedPermissions" value="{{ $permission->id }}"></x-text-input>
                            </div>
                            <div class="ml-3 text-sm">
                                <x-input-label for="permission-{{ $permission->id }}" class="font-medium text-gray-700">{{ $permission->name }}</x-input-label>
                            </div>  
                        </div>
                    @endforeach
                </div>
                @error('selectedPermissions')
                    <span class="mt-1 text-sm text-red-500">{{ $message }}</span>
                @enderror
            </div>

            <div class="flex justify-end mt-6">
                <x-secondary-button wire:click="$set('modalVisible', false)" wire:loading.attr="disabled" class="mr-3">
                    {{ __('Cancelar') }}
                </x-secondary-button>

                <x-primary-button wire:click="save" wire:loading.attr="disabled">
                    {{ __('Guardar') }}
                </x-primary-button>
            </div>
        </div>
    </x-modal>
</div>
