<?php

namespace App\Livewire;

use App\Models\User;
use Livewire\Component;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Livewire\Attributes\On;

class ModalUsuarios extends Component
{
    public $roles;
    public $userId;
    public $name;
    public $email;
    public $username;
    public $password;
    public $modalVisible = false;
    public $selectedRoleId;

    public function mount()
    {
        $this->roles = Role::all();
    }

    public function openModal()
    {
        $this->resetFields();
        $this->modalVisible = true;
    }

    #[On('editUser')]
    public function show($id)
    {
        $this->userId = $id;
        $user = User::findOrFail($id);
        $this->name = $user->name;
        $this->email = $user->email;
        $this->username = $user->username;
        $this->selectedRoleId = $user->roles->first()->id ?? null;
        $this->modalVisible = true;
    }

    public function save()
    {
        $this->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255',
            'username'=> ['required', Rule::unique('users')->ignore($this->userId)],
            'password' => $this->userId ? 'nullable|string|min:6' : 'required|string|min:6',
            'selectedRoleId' => 'required|exists:roles,id',
        ]);

        $data = [
            'name' => $this->name,
            'email' => $this->email,
            'username' => $this->username,
            'is_active' => true,
        ];

        if ($this->password) {
            $data['password'] = Hash::make($this->password);
        }

        if ($this->userId) {
            $user = User::findOrFail($this->userId);
            $user->update($data);
            $this->dispatch('userUpdate');
        } else {
            $user = User::create($data);
            $this->dispatch('userAdd');
        }

        $user->syncRoles([$this->selectedRoleId]);

        $this->modalVisible = false;
        $this->resetFields();
    }

    private function resetFields()
    {
        $this->reset(['userId', 'name', 'email', 'username', 'password', 'selectedRoleId']);
    }

    public function render()
    {
        return view('livewire.modal-usuarios');
    }
}
