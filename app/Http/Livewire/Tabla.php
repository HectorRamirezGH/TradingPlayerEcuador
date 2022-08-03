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
    public $col;
    public $col_carac;

    public $showCollectionModal;

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

    public function showCollectionModal($id_col)
    {
        $this->col = Coleccionable::findOrFail($id_col);

        $this->col_carac = CaracteristicasColeccionable::where('coleccionable',$this->col->id)->get();

        $this->showCollectionModal = true;
    }

    public function showUserPublicProfile($user_id)
    {
        return redirect()->route('user', ['user_id'=>$user_id]);
    }

    public function startChat($user_id)
    {
        return redirect()->route('chatroom');
    }
}
