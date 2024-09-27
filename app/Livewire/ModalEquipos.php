<?php

namespace App\Livewire;

use App\Models\Equipo;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithFileUploads;

class ModalEquipos extends Component
{
    use WithFileUploads;
    public $modalVisible = false;
    public $equipos;
    public $equipoId;
    public $modelo;
    public $capacidad;
    public $tamano;
    public $resolucion;
    public $camara;
    public $sistema;
    public $image;

    protected function rules()
    {
        $rules = [

            'modelo' => 'required|string',
            'capacidad' => 'required|string',
            'tamano' => 'required|string',
            'resolucion' => 'required|string',
            'camara' => 'required|string',
            'sistema' => 'required|string',
            'image' => 'required|image|max:1024',
        ];

        return $rules;
    }

    public function openModal()
    {
        $this->modalVisible = true;
    }


#[On('editEquipo')]
public function show($id)
{
    $this->equipoId = $id;
    $equipo = Equipo::find($id);
    if ($equipo) {
        $this->modelo = $equipo->modelo;
        $this->capacidad = $equipo->capacidad;
        $this->tamano = $equipo->tamano;
        $this->resolucion = $equipo->resolucion;
        $this->camara = $equipo->camara;
        $this->sistema = $equipo->sistema;
        $this->image = null;  // Reset the image field
        $this->modalVisible = true;  // Open the modal
    }
}

public function save()
{
    $this->validate();

    $data = [
        'modelo' => $this->modelo,
        'capacidad' => $this->capacidad,
        'tamano' => $this->tamano,
        'resolucion' => $this->resolucion,
        'camara' => $this->camara,
        'sistema' => $this->sistema,
    ];

    if ($this->image) {
        $data['image_url'] = $this->image->store('equipos', 'public');
    }

    if ($this->equipoId) {
        $equipo = Equipo::find($this->equipoId);
        if ($equipo) {
            $equipo->update($data);
            $this->dispatch('equipoUpdate');
        }
    } else {
        Equipo::create($data);
        $this->dispatch('equipoAdd');
    }

    $this->modalVisible = false;
    $this->reset(['equipoId', 'modelo', 'capacidad', 'tamano', 'resolucion', 'camara', 'sistema', 'image']);

}

    public function render()
    {
        return view('livewire.modal-equipos');
    }
}
