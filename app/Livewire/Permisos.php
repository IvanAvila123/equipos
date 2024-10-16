<?php

namespace App\Livewire;

use Illuminate\Support\Facades\Log;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithPagination;
use Spatie\Permission\Models\Permission;

class Permisos extends Component
{
    use WithPagination;

    public $search = '';
    public $selected = [];
    public $selectAll = false;

    protected $paginationTheme = 'tailwind';

    #[On('permissionsAdd')]
    public function refreshPermisoAdd()
    {
        $this->resetPage();
        session()->flash('message', 'Permiso creado con éxito.');
    }

    #[On('permissionUpdate')]
    public function refreshPermisoUpdate()
    {
        $this->resetPage();
        session()->flash('message', 'Permiso editado con éxito.');
    }

    public function delete($id){

        try {
            $permiso = Permission::findOrFail($id);
            $permiso->delete();
            session()->flash('message', 'Permiso eliminado con éxito.');
        } catch (\Exception $e) {
            Log::error('Error al eliminar Permiso: ' . $e->getMessage());
            session()->flash('error', 'Error al eliminar el Permiso.');
        }
    }

    public function updatedSelectAll($value)
    {
        if ($value) {
            $this->selected = $this->permisos->pluck('id')->map(fn($id) => (string) $id);
        } else {
            $this->selected = [];
        }
    }

    public function deleteSelected()
    {
        Permission::whereIn('id', $this->selected)->delete();
        $this->selected = [];
        $this->selectAll = false;
        session()->flash('message', 'Permisos seleccionados eliminados con éxito.');
    }

    public function render()
    {
        try {
            $permisos = Permission::where('name', 'like', '%' . $this->search . '%')
            ->paginate(10);
            return view('livewire.permisos', ['permisos' => $permisos]);
        } catch (\Throwable $e) {
            Log::error('Error al cargar Permisos: ' . $e->getMessage());
            return view('livewire.permisos', ['permisos' => null]);
        }

    }
}
