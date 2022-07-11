<?php

namespace App\Http\Livewire;

use App\Models\Caracteristica;
use App\Models\CaracteristicasColeccionable;
use App\Models\Coleccionable;
use App\Models\Colecciones;
use App\Models\SetColeccionable;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class Tabla extends Component
{
    public function render()
    {
        $caracteristicas = Caracteristica::all();

        $coleccionables = Coleccionable::all();

        $colecciones = Colecciones::all();

        $caracteristicascoleccionable = CaracteristicasColeccionable::all();

        $setcoleccionables = SetColeccionable::all();

        $users = User::all();

        return view('livewire.tabla', compact('users','coleccionables','caracteristicas','caracteristicascoleccionable', 'setcoleccionables', 'colecciones'));
    }
}
