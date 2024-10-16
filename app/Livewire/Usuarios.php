<?php

namespace App\Livewire;

use App\Models\User;
use Illuminate\Support\Facades\Log;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithPagination;

class Usuarios extends Component
{
    use WithPagination;

    public $search = '';
    public $selected = [];
    public $selectAll = false;

    protected $paginationTheme = 'tailwind';

    #[On('userAdd')]
    public function refreshUserAdd()
    {
        $this->resetPage();
        session()->flash('message', 'Usuario creado con éxito.');
    }

    #[On('userUpdate')]
    public function refreshUserUpdate()
    {
        $this->resetPage();
        session()->flash('message', 'Usuario editado con éxito.');
    }

    public function delete($id)
    {

        try {
            $roles = User::findOrFail($id);
            $roles->delete();
            session()->flash('message', 'Usuario eliminado con éxito.');
        } catch (\Exception $e) {
            Log::error('Error al eliminar Permiso: ' . $e->getMessage());
            session()->flash('error', 'Error al eliminar el Usuario.');
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
        User::whereIn('id', $this->selected)->delete();
        $this->selected = [];
        $this->selectAll = false;
        session()->flash('message', 'Usuario seleccionados eliminados con éxito.');
    }

    public function toggleUserStatus($id)
    {
        $user = User::findOrFail($id);
        $user->is_active = !$user->is_active;
        $user->save();

        $status = $user->is_active ? 'activado' : 'desactivado';
        session()->flash('message', "Usuario {$status} con éxito.");

        $this->dispatch('userUpdated');
    }

    public function render()
    {
        try {
            $usuarios = User::where('name', 'like', '%' . $this->search . '%')
                ->orWhere('username', 'like', '%' . $this->search . '%')
                ->orWhere('email', 'like', '%' . $this->search . '%')
                ->paginate(10);
            return view('livewire.usuarios', ['usuarios' => $usuarios]);
        } catch (\Throwable $e) {
            Log::error('Error al cargar equipos: ' . $e->getMessage());
            return view('livewire.usuarios', ['usuarios' => null]);
        }
    }
}
