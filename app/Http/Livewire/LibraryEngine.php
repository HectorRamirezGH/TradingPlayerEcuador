<?php

namespace App\Http\Livewire;

use App\Models\ColeccionableTipo;
use Livewire\Component;
use Illuminate\Support\Facades\DB;
use App\Models\Caracteristica;
use App\Models\CaracteristicasColeccionable;
use App\Models\Coleccionable;
use App\Models\Colecciones;
use App\Models\SetColeccionable;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class LibraryEngine extends Component
{
    public $series = [];
    public $coleccionables = [];
    public $setcoleccionables = [];

    public $tipoId;
    public $serieId;

    public $col;
    public $col_carac;

    protected $listeners = ['refreshComponent' => '$refresh'];

    public function render()
    {
        $coleccionableTipos = ColeccionableTipo::all();

        $caracteristicas = Caracteristica::all();

        $colecciones = Colecciones::all();

        $caracteristicascoleccionable = CaracteristicasColeccionable::all();

        $users = User::all();

        $this->series = DB::table('series')->whereIn('id', function ($query) {
            $query->select('coleccionable_serie')
            ->from('coleccionables')
            ->where('coleccionable_tipo', $this->tipoId);
        })->get();

        $this->coleccionables = DB::table('coleccionables')
        ->where('coleccionable_tipo', $this->tipoId)
        ->where('coleccionable_serie', $this->serieId)
        ->get();

        $this->setcoleccionables = DB::table('set_coleccionables')->whereIn('coleccionable', function ($query) {
            $query->select('id')
            ->from('coleccionables')
            ->where('coleccionable_tipo', $this->tipoId)
            ->where('coleccionable_serie', $this->serieId);
        })->where('deleted_at', null)->latest()->get();

        return view('livewire.library-engine', compact('coleccionableTipos', 'caracteristicas', 'colecciones', 'caracteristicascoleccionable', 'users'));
    }

    public function searchColeccionable($id_col)
    {
        return redirect()->route('collectable', ['id_col'=>$id_col]);
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
