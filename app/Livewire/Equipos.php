<?php

namespace App\Livewire;

use App\Models\Equipo;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Log;

class Equipos extends Component
{
    use WithPagination;

    public $search = '';

    protected $paginationTheme = 'tailwind';

    #[On('equipoAdd')]
    public function refreshEquipoAdd()
    {
        $this->resetPage();
        session()->flash('message', 'Equipo creado con éxito.');
    }

    #[On('equipoUpdate')]
    public function refreshEquipoUpdate()
    {

        $this->resetPage();
        session()->flash('message', 'Equipo Editado con éxito.');
    }

    public function delete($id)
    {
        try {
            $equipo = Equipo::findOrFail($id);
            $equipo->delete();
            session()->flash('message', 'Equipo eliminado con éxito.');
        } catch (\Exception $e) {
            Log::error('Error al eliminar equipo: ' . $e->getMessage());
            session()->flash('error', 'Error al eliminar el equipo.');
        }
    }

    public function render()
    {
        try {
            $equipos = Equipo::where('modelo', 'like', '%' . $this->search . '%')
                ->orWhere('capacidad', 'like', '%' . $this->search . '%')
                ->orWhere('tamano', 'like', '%' . $this->search . '%')
                ->orWhere('resolucion', 'like', '%' . $this->search . '%')
                ->orWhere('camara', 'like', '%' . $this->search . '%')
                ->orWhere('sistema', 'like', '%' . $this->search . '%')
                ->paginate(10);

            return view('livewire.equipos', ['equipos' => $equipos]);
        } catch (\Exception $e) {
            Log::error('Error al cargar equipos: ' . $e->getMessage());
            return view('livewire.equipos', ['equipos' => null]);
        }
    }
}
