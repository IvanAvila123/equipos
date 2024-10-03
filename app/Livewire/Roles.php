<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\Volt\Compilers\Mount;
use Spatie\Permission\Models\Role;

class Roles extends Component
{
    public $role;

    public function mount()
    {
        $this->role = Role::all();
    }
    
    public function render()
    {
        return view('livewire.roles');
    }
}
