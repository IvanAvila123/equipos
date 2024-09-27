<div>
    <x-primary-button wire:click="openModal">Crear Equipo</x-primary-button>

    <x-modal name="crear-equipo" wire:model="modalVisible">
        <div class="p-6">
            <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                {{ $equipoId ? __('Editar Equipo') : __('Crear Nuevo Equipo') }}
            </h2>

            <div class="mt-6">
                <x-input-label for="modelo" value="{{ __('Modelo Del Equipo') }}" />
                <x-text-input id="modelo" class="block mt-1 w-full" type="text" wire:model.defer="modelo"
                    autocomplete="off" />
                @error('modelo')
                    <span class="text-red-500 text-sm mt-1">{{ $message }}</span>
                @enderror
            </div>

            <div class="mt-4">
                <x-input-label for="capacidad" value="{{ __('Capacidad Del Equipo') }}" />
                <x-text-input id="capacidad" class="block mt-1 w-full" type="text" wire:model.defer="capacidad"
                    autocomplete="off" />
                @error('capacidad')
                    <span class="text-red-500 text-sm mt-1">{{ $message }}</span>
                @enderror
            </div>

            <div class="mt-4">
                <x-input-label for="tamano" value="{{ __('Tamaño De Pantalla') }}" />
                <x-text-input id="tamano" class="block mt-1 w-full" type="text" wire:model.defer="tamano"
                    autocomplete="off" />
                @error('tamano')
                    <span class="text-red-500 text-sm mt-1">{{ $message }}</span>
                @enderror
            </div>

            <div class="mt-4">
                <x-input-label for="resolucion" value="{{ __('Resolucion De La Pantalla') }}" />
                <x-text-input id="resolucion" class="block mt-1 w-full" type="text" wire:model.defer="resolucion"
                    autocomplete="off" />
                @error('resolucion')
                    <span class="text-red-500 text-sm mt-1">{{ $message }}</span>
                @enderror
            </div>

            <div class="mt-4">
                <x-input-label for="camara" value="{{ __('Camara') }}" />
                <x-text-input id="camara" class="block mt-1 w-full" type="text" wire:model.defer="camara"
                    autocomplete="off" />
                @error('camara')
                    <span class="text-red-500 text-sm mt-1">{{ $message }}</span>
                @enderror
            </div>

            <div class="mt-4">
                <x-input-label for="sistema" value="{{ __('Sistema Operativo') }}" />
                <x-text-input id="sistema" class="block mt-1 w-full" type="text" wire:model.defer="sistema"
                    autocomplete="off" />
                @error('sistema')
                    <span class="text-red-500 text-sm mt-1">{{ $message }}</span>
                @enderror
            </div>

            <div class="mt-4">
                <x-input-label for="image" value="{{ __('Imagen Del Equipo') }}" />
                <x-text-input id="image" class="block mt-1 w-full" type="file" wire:model.defer="image"
                    autocomplete="off" />
                @error('image')
                    <span class="text-red-500 text-sm mt-1">{{ $message }}</span>
                @enderror
            </div>

            <div class="mt-6 flex justify-end">
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
