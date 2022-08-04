<?php

namespace App\Http\Livewire;

use App\Models\ColeccionableTipo;
use Livewire\Component;
use Illuminate\Support\Facades\DB;

class LibraryEngine extends Component
{
    public $series = [];
    public $coleccionables = [];

    public $tipoId;
    public $serieId;

    protected $listeners = ['refreshComponent' => '$refresh'];

    public function render()
    {
        $coleccionableTipos = ColeccionableTipo::all();

        $this->series = DB::table('series')->whereIn('id', function ($query) {
            $query->select('coleccionable_serie')
            ->from('coleccionables')
            ->where('coleccionable_tipo', $this->tipoId);
        })->get();

        $this->coleccionables = DB::table('coleccionables')
        ->where('coleccionable_tipo', $this->tipoId)
        ->where('coleccionable_serie', $this->serieId)
        ->get();

        return view('livewire.library-engine', compact('coleccionableTipos'));
    }
}
