<?php

namespace App\Http\Livewire;

use App\Models\Coleccionable;
use App\Models\Colecciones;
use App\Models\SetColeccionable;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class CollectionsSetTable extends Component
{
    public $createSetModal = false;

    public $search;
    public $id_set;

    public $state = [
        'price',
        'cant',
        'visible',
        'tipo_set',
        'coleccionable',
    ];

    public function render()
    {
        $colecciones = Colecciones::all();

        $coleccionables = Coleccionable::all();

        $setcoleccionables = SetColeccionable::all();

        return view('livewire.collections-set-table',compact('colecciones', 'coleccionables','setcoleccionables'));
    }

    public function createSetModal($id_set)
    {
        $this->id_set = $id_set;

        $this->createSetModal = true;
    }

    public function createCollection()
    {
        

        $setcoleccionable = new SetColeccionable();
        
        $setcoleccionable->precio = $this->state['price'];
        $setcoleccionable->cant = $this->state['cant'];
        $setcoleccionable->visible = $this->state['visible'];
        $setcoleccionable->tipo_set = $this->state['tipo_set'];
        $setcoleccionable->coleccionable = Coleccionable::where('name',$this->search)->value('id');
        $setcoleccionable->coleccion = $this->id_set;

        $setcoleccionable->save();
        $this->emit('saved');
    }
}
