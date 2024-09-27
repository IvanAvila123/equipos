<div class="container mx-auto px-4 py-8">
    @if (session()->has('message'))
        <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-4" role="alert">
            <p class="font-bold">Éxito</p>
            <p>{{ session('message') }}</p>
        </div>
    @endif

    @if (session()->has('error'))
        <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-4" role="alert">
            <p class="font-bold">Error</p>
            <p>{{ session('error') }}</p>
        </div>
    @endif
    <!-- component -->
    <div class="relative text-lg bg-transparent text-gray-800 mb-4">
        <div class="flex items-center border-b border-b-2 border-teal-500 py-2">
            <input class="bg-transparent border-none mr-3 px-2 leading-tight focus:outline-none" type="text"
                placeholder="Search">
            <button type="submit" class="absolute right-0 top-0 mt-3 mr-4">
                <svg class="h-4 w-4 fill-current" xmlns="http://www.w3.org/2000/svg"
                    xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" id="Capa_1" x="0px" y="0px"
                    viewBox="0 0 56.966 56.966" style="enable-background:new 0 0 56.966 56.966;" xml:space="preserve"
                    width="512px" height="512px">
                    <path
                        d="M55.146,51.887L41.588,37.786c3.486-4.144,5.396-9.358,5.396-14.786c0-12.682-10.318-23-23-23s-23,10.318-23,23  s10.318,23,23,23c4.761,0,9.298-1.436,13.177-4.162l13.661,14.208c0.571,0.593,1.339,0.92,2.162,0.92  c0.779,0,1.518-0.297,2.079-0.837C56.255,54.982,56.293,53.08,55.146,51.887z M23.984,6c9.374,0,17,7.626,17,17s-7.626,17-17,17  s-17-7.626-17-17S14.61,6,23.984,6z" />
                </svg>
            </button>
        </div>
    </div>
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
        @forelse ($equipos as $equipo)
            <div
                class="bg-white rounded-lg shadow-md overflow-hidden transition duration-300 ease-in-out transform hover:-translate-y-1 hover:shadow-lg">
                <div class="relative pb-[100%]">
                    <img src="{{ $equipo->image_url ? asset('storage/' . $equipo->image_url) : asset('path/to/default/image.jpg') }}"
                        alt="{{ $equipo->modelo }}" class="absolute inset-0 w-full h-full object-cover">
                </div>
                <div class="p-4">
                    <h3 class="font-bold text-xl mb-2">{{ $equipo->modelo }}</h3>
                    <div class="text-sm text-gray-600 space-y-1">
                        <p><i class="fas fa-hdd mr-2"></i>Capacidad: {{ $equipo->capacidad }}</p>
                        <p><i class="fas fa-mobile-alt mr-2"></i>Pantalla: {{ $equipo->tamano }}</p>
                        <p><i class="fas fa-expand mr-2"></i>Resolución: {{ $equipo->resolucion }}</p>
                        <p><i class="fas fa-camera mr-2"></i>Cámara: {{ $equipo->camara }}</p>
                        <p><i class="fab fa-apple mr-2"></i><i class="fab fa-android mr-2"></i>SO:
                            {{ $equipo->sistema }}</p>
                    </div>
                    <div class="mt-4 flex justify-between">
                        <button wire:click="delete({{ $equipo->id }})"
                            class="bg-red-500 hover:bg-red-600 text-white font-bold py-2 px-4 rounded transition duration-300 ease-in-out">
                            <i class="fas fa-trash mr-2"></i>Eliminar
                        </button>
                        <button wire:click="$dispatch('editEquipo', { id: {{ $equipo->id }} })"
                            class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded transition duration-300 ease-in-out">
                            <i class="fas fa-edit mr-2"></i>Editar
                        </button>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-span-full text-center py-4">
                <p class="text-gray-500">No hay equipos disponibles.</p>
            </div>
        @endforelse
    </div>

    @if ($equipos && method_exists($equipos, 'links'))
        <div class="mt-6">
            {{ $equipos->links() }}
        </div>
    @endif
</div>
