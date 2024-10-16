<div class="p-6 bg-gray-100 dark:bg-gray-900">

    @if (session()->has('message'))
        <div class="p-4 mb-4 text-green-700 bg-green-100 border-l-4 border-green-500 dark:bg-green-900 dark:text-green-300" role="alert">
            <p class="font-bold">Éxito</p>
            <p>{{ session('message') }}</p>
        </div>
    @endif

    @if (session()->has('error'))
        <div class="p-4 mb-4 text-red-700 bg-red-100 border-l-4 border-red-500 dark:bg-red-900 dark:text-red-300" role="alert">
            <p class="font-bold">Error</p>
            <p>{{ session('error') }}</p>
        </div>
    @endif

    <div class="mb-4">
        <input wire:model.live="search" type="text" placeholder="Buscar usuario..."
               class="w-full px-4 py-2 text-gray-700 bg-white border border-gray-300 rounded-md dark:bg-gray-800 dark:text-gray-300 dark:border-gray-700 focus:border-blue-500 dark:focus:border-blue-500 focus:outline-none">
    </div>

    <div class="relative overflow-x-auto overflow-y-auto bg-white rounded-lg shadow dark:bg-gray-800">
        <table class="w-full whitespace-no-wrap">
            <thead>
                <tr class="text-left bg-gray-100 dark:bg-gray-700">
                    <th class="px-4 py-3 font-medium text-gray-600 dark:text-gray-200">
                        <x-text-input type="checkbox" wire:model="selectAll"></x-text-input>
                    </th>
                    <th class="px-4 py-3 font-medium text-gray-600 dark:text-gray-200">Nombre</th>
                    <th class="px-4 py-3 font-medium text-gray-600 dark:text-gray-200">Username</th>
                    <th class="px-4 py-3 font-medium text-gray-600 dark:text-gray-200">Email</th>
                    <th class="px-4 py-3 font-medium text-gray-600 dark:text-gray-200">Rol</th>
                    <th class="px-4 py-3 font-medium text-gray-600 dark:text-gray-200">Estado del usuario</th>
                    <th class="px-4 py-3 font-medium text-gray-600 dark:text-gray-200">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($usuarios as $usuario)
                <tr class="border-t border-gray-200 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                    <td class="px-4 py-3">
                        <x-text-input type="checkbox" wire:model="selected" value="{{ $usuario->id }}"></x-text-input>
                    </td>
                    <td class="px-4 py-3 text-gray-700 dark:text-gray-300">
                        {{ $usuario->name }}
                    </td>
                    <td class="px-4 py-3 text-gray-700 dark:text-gray-300">
                        {{ $usuario->username }}
                    </td>
                    <td class="px-4 py-3 text-gray-700 dark:text-gray-300">
                        {{ $usuario->email }}
                    </td>
                    <td class="px-4 py-3 text-gray-700 dark:text-gray-300">
                        {{ $usuario->roles->first()->name ?? 'Sin rol' }}
                    </td>
                    <td class="px-4 py-3">
                        <button wire:click="toggleUserStatus({{ $usuario->id }})"
                                class="px-2 py-1 text-xs font-semibold {{ $usuario->is_active ? 'bg-green-500 hover:bg-green-600' : 'bg-red-500 hover:bg-red-600' }} text-white rounded">
                            {{ $usuario->is_active ? 'Activo' : 'Inactivo' }}
                        </button>
                    </td>
                    <td class="px-4 py-3">
                        <x-primary-button wire:click="$dispatch('editUser', { id: {{ $usuario->id }} })">
                            Editar
                        </x-primary-button>
                        <x-danger-button wire:click="delete({{ $usuario->id }})">
                            Borrar
                        </x-danger-button>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="3" class="px-4 py-4 text-center text-gray-500 dark:text-gray-400">
                        No se encontraron permisos
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-4">
        {{ $usuarios->links() }}
    </div>

    <div class="mt-4">
        <button wire:click="deleteSelected"
                class="px-4 py-2 font-bold text-white bg-red-500 rounded hover:bg-red-700 dark:bg-red-600 dark:hover:bg-red-800 focus:outline-none focus:shadow-outline">
            Eliminar seleccionados
        </button>
    </div>
</div>

