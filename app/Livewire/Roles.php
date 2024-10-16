<?php

namespace App\Livewire;

use Illuminate\Support\Facades\Log;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithPagination;
use Spatie\Permission\Models\Role;

class Roles extends Component
{
    use WithPagination;

    public $search = '';
    public $selected = [];
    public $selectAll = false;

    protected $paginationTheme = 'tailwind';

    #[On('roleAdd')]
    public function refreshRolAdd()
    {
        $this->resetPage();
        session()->flash('message', 'Rol creado con éxito.');
    }

    #[On('roleUpdate')]
    public function refreshRolUpdate()
    {
        $this->resetPage();
        session()->flash('message', 'Rol editado con éxito.');
    }

    public function delete($id){

        try {
            $roles = Role::findOrFail($id);
            $roles->delete();
            session()->flash('message', 'Permiso eliminado con éxito.');
        } catch (\Exception $e) {
            Log::error('Error al eliminar Permiso: ' . $e->getMessage());
            session()->flash('error', 'Error al eliminar el Permiso.');
        }
    }

    public function updatedSelectAll($value)
    {
        if ($value) {
            $this->selected = $this->roles->pluck('id')->map(fn($id) => (string) $id);
        } else {
            $this->selected = [];
        }
    }

    public function deleteSelected()
    {
        Role::whereIn('id', $this->selected)->delete();
        $this->selected = [];
        $this->selectAll = false;
        session()->flash('message', 'Roles seleccionados eliminados con éxito.');
    }

    public function render()
    {
        try {
            $roles = Role::where('name', 'like', '%' . $this->search . '%')
            ->paginate(10);
            return view('livewire.roles', ['roles' => $roles]);
        } catch (\Throwable $e) {
            Log::error('Error al cargar Permisos: ' . $e->getMessage());
            return view('livewire.roles', ['roles' => null]);
        }

    }
}
