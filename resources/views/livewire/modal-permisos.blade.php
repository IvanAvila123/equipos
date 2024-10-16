<div>
    <x-primary-button wire:click='openModal'>Crear Permiso</x-primary-button>

    <x-modal name="crear-permiso" wire:model='modalVisible'>
        <div class="p-6">
            <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                {{ $permissionsId ? __('Editar Permiso') : __('Crear Nuevo Permiso') }}
            </h2>

            <div class="mt-6">
                <x-input-label for="name" value="{{ __('Permiso') }}" />
                <x-text-input id="name" class="block w-full mt-1" type="text" wire:model.defer="name"
                    autocomplete="off" />
                @error('name')
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
