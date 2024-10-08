<?php

namespace App\Livewire;

use Livewire\Component;
use Spatie\Permission\Models\Permission;

class Permisos extends Component
{
    public $permissions;

    public function mount ()
    {
        $this->permissions = Permission::all();
    }

    public function render()
    {
        return view('livewire.permisos');
    }
}
