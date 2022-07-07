<?php

namespace App\Http\Livewire;

use App\Models\Caracteristica;
use App\Models\CaracteristicasColeccionable;
use App\Models\Coleccionable;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class Tabla extends Component
{
    public function render()
    {
        $caracteristicas = Caracteristica::all();

        $coleccionables = Coleccionable::all();

        $caracteristicascoleccionable = CaracteristicasColeccionable::all();

        return view('livewire.tabla', compact('coleccionables','caracteristicas','caracteristicascoleccionable'));
    }
}
