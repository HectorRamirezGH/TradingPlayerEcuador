<?php

namespace App\Http\Livewire;

use App\Models\Caracteristica;
use App\Models\CaracteristicasColeccionable;
use App\Models\Coleccionable;
use App\Models\Colecciones;
use App\Models\SetColeccionable;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
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

        $setcoleccionables = DB::table('set_coleccionables')->latest()->where('deleted_at', null)->get();

        return view('livewire.collectable', compact('colecciones','coleccionables', 'caracteristicascoleccionable', 'carac_name', 'users', 'setcoleccionables'));
    }

    public function mount($id_col)
    {
        $this->id_col = $id_col;

        $this->col_carac = CaracteristicasColeccionable::where('coleccionable',$this->id_col)->get();
    }

    public function showUserPublicProfile($user_id)
    {
        return redirect()->route('user', ['user_id'=>$user_id]);
    }

    public function startChat($user_id)
    {
        if(Auth::check()){
            DB::table('friends')->updateOrInsert(['user' => Auth::user()->id, 'friend' => $user_id]);
            DB::table('friends')->updateOrInsert(['user' => $user_id, 'friend' => Auth::user()->id]);
        }

        return redirect()->route('chatroom');
    }
}
