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
use Illuminate\Support\Facades\Auth;

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

        $setcoleccionables = SetColeccionable::
        whereIn('coleccion', Colecciones::where('user','=',$this->user_id)->get())
        ->where('visible',0)
        ->get();

        $carac_name = Caracteristica::all();

        $coleccionables = DB::table('coleccionables')
        ->join('set_coleccionables', 'coleccionables.id', '=', 'set_coleccionables.coleccionable')
        ->select('coleccionables.*')
        ->get();

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

    public function startChat($user_id)
    {    
        DB::table('friends')->updateOrInsert(['user' => Auth::user()->id, 'friend' => $user_id]);
        DB::table('friends')->updateOrInsert(['user' => $user_id, 'friend' => Auth::user()->id]);
        
        return redirect()->route('chatroom');
    }
}
