<?php

namespace App\Livewire;

use Livewire\Attributes\On;
use Livewire\Component;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class ModalPermisos extends Component
{
    public $roles;
    public $permissionsId;
    public $permissions;
    public $name;
    public $modalVisible = false;

    public function mount()
    {
        $this->roles = Role::all();
    }

    public function openModal()
    {
        $this->modalVisible = true;
    }

    #[On('editPermission')]
    public function show($id)
    {
        $this->permissionsId = $id;
        $permissions = Permission::find($id);
        if ($permissions) {
            $this->name = $permissions->name;
            $this->modalVisible = true;
        }
    }

    public function save()
    {
        $this->validate([
            'name'=> 'required|unique:permissions,name'
        ]);

        $data = [
            'name' => $this->name,
        ];

        if ($this->permissionsId) {
            $permissions =Permission::find($this->permissionsId);
            if ($permissions) {
                $permissions->update($data);
                $this->dispatch('permissionUpdate');
            }

        }else{
            Permission::create($data);
            $this->dispatch('permissionsAdd');
        }

        $this->modalVisible = true;
        $this->reset(['name']);
    }

    public function render()
    {
        return view('livewire.modal-permisos');
    }
}
