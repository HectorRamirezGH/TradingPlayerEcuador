<?php

namespace App\Http\Livewire;

use App\Models\Caracteristica;
use App\Models\CaracteristicasColeccionable;
use App\Models\Coleccionable;
use App\Models\Colecciones;
use App\Models\SetColeccionable;
use App\Models\User;
use Livewire\Component;

class UserPublicProfile extends Component
{
    public $user_id;
    public $col;
    public $col_carac;
    public $showCollectionModal;

    public function render()
    {
        $userCollections = Colecciones::where('user','=',$this->user_id)->get();

        $user = User::findOrFail($this->user_id);

        $setcoleccionables = SetColeccionable::all();

        $carac_name = Caracteristica::all();

        $coleccionables = Coleccionable::all();

        return view('livewire.user-public-profile', compact('user','coleccionables','userCollections', 'setcoleccionables', 'carac_name'));
    }

    public function showCollectionModal($id_col)
    {
        $this->col = Coleccionable::findOrFail($id_col);

        $this->col_carac = CaracteristicasColeccionable::where('coleccionable',$this->col->id)->get();

        $this->showCollectionModal = true;
    }

    public function mount($user_id)
    {
        $this->user_id = $user_id;
    }
}
