<div>
    <x-primary-button wire:click='openModal'>Crear Usuario</x-primary-button>

    <x-modal name="crear-rol" wire:model='modalVisible'>
        <div class="p-6">
            <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                {{ $userId ? __('Editar Usuario') : __('Crear Nuevo Usuario') }}
            </h2>

            <div class="mt-6">
                <x-input-label for="name" value="{{ __('nombre') }}" />
                <x-text-input id="name" class="block w-full mt-1" type="text" wire:model.defer="name"
                    autocomplete="off" />
                @error('name')
                    <span class="mt-1 text-sm text-red-500">{{ $message }}</span>
                @enderror
            </div>

            <div class="mt-6">
                <x-input-label for="email" value="{{ __('Email') }}" />
                <x-text-input id="email" class="block w-full mt-1" type="email" wire:model.defer="email"
                    autocomplete="off" />
                @error('email')
                    <span class="mt-1 text-sm text-red-500">{{ $message }}</span>
                @enderror
            </div>

            <div class="mt-6">
                <x-input-label for="username" value="{{ __('Username') }}" />
                <x-text-input id="username" class="block w-full mt-1" type="text" wire:model.defer="username"
                    autocomplete="off" />
                @error('username')
                    <span class="mt-1 text-sm text-red-500">{{ $message }}</span>
                @enderror
            </div>

            <div class="mt-6">
                <x-input-label for="password" value="{{ __('Contraseña') }}" />
                <x-text-input id="password" class="block w-full mt-1" type="password" wire:model.defer="password"
                    autocomplete="off" />
                @error('password')
                    <span class="mt-1 text-sm text-red-500">{{ $message }}</span>
                @enderror
            </div>

            <div class="mt-6">
                <x-input-label for="role" value="{{ __('Rol') }}" />
                <div class="mt-2">
                        <div class="flex items-start">
                            <select id="role" class="block w-full mt-1 text-gray-900 bg-white border-gray-300 rounded-md shadow-sm dark:bg-gray-700 dark:text-gray-100 dark:border-gray-600 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600" wire:model.defer="selectedRoleId">
                                <option value="">{{ __('Seleccione un rol') }}</option>
                                @foreach ($roles as $role)
                                    <option value="{{ $role->id }}">{{ $role->name }}</option>
                                @endforeach
                            </select>
                        </div>
                </div>
                @error('selectedRoleId')
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

