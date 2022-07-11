<?php

namespace App\Http\Livewire;

use App\Models\Caracteristica;
use App\Models\CaracteristicasColeccionable;
use App\Models\Coleccionable;
use App\Models\Colecciones;
use App\Models\SetColeccionable;
use App\Models\User;
use Livewire\Component;

class Collectable extends Component
{
    public $id_col;
    public $col_carac;

    public function render()
    {
        $coleccionables = Coleccionable::all();

        $caracteristicascoleccionable = CaracteristicasColeccionable::all();

        $colecciones = Colecciones::all();

        $carac_name = Caracteristica::all();

        $users = User::all();   

        $setcoleccionables = SetColeccionable::all();

        return view('livewire.collectable', compact('colecciones','coleccionables', 'caracteristicascoleccionable', 'carac_name', 'users', 'setcoleccionables'));
    }

    public function mount($id_col)
    {
        $this->id_col = $id_col;

        $this->col_carac = CaracteristicasColeccionable::where('coleccionable',$this->id_col)->get();
    }
}
