<?php

namespace App\Livewire;

use Livewire\Attributes\On;
use Livewire\Component;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class ModalRoles extends Component
{
    public $roleId;
    public $name;
    public $permissions = [];
    public $selectedPermissions = [];
    public $modalVisible = false;

    public function mount()
    {
        $this->permissions = Permission::all();
    }

    public function openModal()
    {
        $this->modalVisible = true;
    }

    #[On('editPermission')]
    public function show($id)
    {
        $this->roleId = $id;
        $role = Role::find($id);
        if ($role) {
            $this->name = $role->name;
            $this->selectedPermissions = $role->permissions->pluck('id')->toArray();
            $this->modalVisible = true;
        }
    }

    public function save()
    {
        $this->validate([
            'name'=> 'required|unique:roles,name',
            'selectedPermissions' => 'array',
        ]);

        $permissions = Permission::whereIn('id', $this->selectedPermissions)->pluck('name')->toArray();

        $data = [
            'name' => $this->name,
        ];


        if ($this->roleId) {
            $role =Role::find($this->roleId);
            if ($role) {
                $role->update($data);
                $this->dispatch('roleUpdate');
                $role->syncPermisssions($permissions);
            }

        }else{
            $role = Role::create($data);
            $this->dispatch('roleAdd');
            $role->syncPermisssions($permissions);
        }

        $this->modalVisible = true;
        $this->reset(['name']);
    }

    public function render()
    {
        return view('livewire.modal-roles');
    }
}
