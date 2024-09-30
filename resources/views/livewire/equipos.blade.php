<div class="container px-4 py-8 mx-auto dark:bg-gray-900">
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

    <div class="relative mb-4 text-lg text-gray-800 bg-transparent dark:text-gray-200">
        <div class="flex items-center py-2 border-b border-b-2 border-teal-500">
            <input class="px-2 mr-3 leading-tight bg-transparent border-none focus:outline-none dark:text-white" type="text"
                placeholder="Search">
            <button type="submit" class="absolute top-0 right-0 mt-3 mr-4">
                <svg class="w-4 h-4 text-gray-800 fill-current dark:text-gray-200" xmlns="http://www.w3.org/2000/svg"
                    viewBox="0 0 56.966 56.966">
                    <path d="M55.146,51.887L41.588,37.786c3.486-4.144,5.396-9.358,5.396-14.786c0-12.682-10.318-23-23-23s-23,10.318-23,23  s10.318,23,23,23c4.761,0,9.298-1.436,13.177-4.162l13.661,14.208c0.571,0.593,1.339,0.92,2.162,0.92  c0.779,0,1.518-0.297,2.079-0.837C56.255,54.982,56.293,53.08,55.146,51.887z M23.984,6c9.374,0,17,7.626,17,17s-7.626,17-17,17  s-17-7.626-17-17S14.61,6,23.984,6z" />
                </svg>
            </button>
        </div>
    </div>

    <div class="grid grid-cols-1 gap-6 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4">
        @forelse ($equipos as $equipo)
            <div class="overflow-hidden transition duration-300 ease-in-out transform bg-white rounded-lg shadow-md dark:bg-gray-800 hover:-translate-y-1 hover:shadow-lg">
                <div class="relative pb-[100%]">
                    <img src="{{ $equipo->image_url ? asset('storage/' . $equipo->image_url) : asset('path/to/default/image.jpg') }}"
                        alt="{{ $equipo->modelo }}" class="absolute inset-0 object-cover w-full h-full">
                </div>
                <div class="p-4">
                    <h3 class="mb-2 text-xl font-bold dark:text-white">{{ $equipo->modelo }}</h3>
                    <div class="space-y-1 text-sm text-gray-600 dark:text-gray-300">
                        <p><i class="mr-2 fas fa-hdd"></i>Capacidad: {{ $equipo->capacidad }}</p>
                        <p><i class="mr-2 fas fa-mobile-alt"></i>Pantalla: {{ $equipo->tamano }}</p>
                        <p><i class="mr-2 fas fa-expand"></i>Resolución: {{ $equipo->resolucion }}</p>
                        <p><i class="mr-2 fas fa-camera"></i>Cámara: {{ $equipo->camara }}</p>
                        <p><i class="mr-2 fab fa-apple"></i><i class="mr-2 fab fa-android"></i>SO: {{ $equipo->sistema }}</p>
                    </div>
                    <div class="flex justify-between mt-4">
                        <button wire:click="delete({{ $equipo->id }})"
                            class="px-4 py-2 font-bold text-white transition duration-300 ease-in-out bg-red-500 rounded hover:bg-red-600 dark:bg-red-700 dark:hover:bg-red-800">
                            <i class="mr-2 fas fa-trash"></i>Eliminar
                        </button>
                        <button wire:click="$dispatch('editEquipo', { id: {{ $equipo->id }} })"
                            class="px-4 py-2 font-bold text-white transition duration-300 ease-in-out bg-blue-500 rounded hover:bg-blue-600 dark:bg-blue-700 dark:hover:bg-blue-800">
                            <i class="mr-2 fas fa-edit"></i>Editar
                        </button>
                    </div>
                </div>
            </div>
        @empty
            <div class="py-4 text-center col-span-full">
                <p class="text-gray-500 dark:text-gray-400">No hay equipos disponibles.</p>
            </div>
        @endforelse
    </div>

    @if ($equipos && method_exists($equipos, 'links'))
        <div class="mt-6">
            {{ $equipos->links() }}
        </div>
    @endif
</div>
