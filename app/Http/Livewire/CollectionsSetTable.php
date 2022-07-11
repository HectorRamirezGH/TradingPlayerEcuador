<?php

namespace App\Http\Livewire;

use App\Models\Caracteristica;
use App\Models\CaracteristicasColeccionable;
use App\Models\Coleccionable;
use App\Models\Colecciones;
use App\Models\SetColeccionable;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Livewire\Component;

class CollectionsSetTable extends Component
{
    public $createSetModal = false;
    public $editSetModal = false;
    public $deleteSetModal = false;
    public $showCollectionModal = false;

    public $search;

    public $col;
    public $col_carac;

    public $id_set;
    public $edit_set;

    public $state = [
        'price',
        'cant',
        'visible',
        'tipo_set',
    ];

    public function render()
    {
        $colecciones = Colecciones::where('user',Auth::user()->getAuthIdentifier())->get();

        $coleccionables = Coleccionable::all();

        $setcoleccionables = SetColeccionable::all();

        $carac_name = Caracteristica::all();

        return view('livewire.collections-set-table',compact('colecciones', 'coleccionables','setcoleccionables','carac_name'));
    }

    public function createSetModal($id_set)
    {
        $this->id_set = $id_set;

        $this->state['price'] = '';
        $this->state['cant'] = '';
        $this->state['visible'] = '';
        $this->state['tipo_set'] = '';
        $this->search = '';

        $this->createSetModal = true;
    }

    public function showCollectionModal($id_col)
    {
        $this->col = Coleccionable::findOrFail($id_col);

        $this->col_carac = CaracteristicasColeccionable::where('coleccionable',$this->col->id)->get();

        $this->showCollectionModal = true;
    }

    public function editSetModal($id_set)
    {
        $this->id_set = $id_set;

        $this->edit_set = SetColeccionable::findOrFail($id_set);

        $this->state['price'] = $this->edit_set->precio;
        $this->state['cant'] = $this->edit_set->cant;
        $this->state['visible'] = $this->edit_set->visible;
        $this->state['tipo_set'] = $this->edit_set->tipo_set;
        $this->search = Coleccionable::where('id',$this->edit_set->coleccionable)->value('name');

        $this->editSetModal = true;
    }

    public function deleteSetModal($id_set)
    {
        $this->edit_set = SetColeccionable::findOrFail($id_set);

        $this->deleteSetModal = true;
    }

    public function createSetCollection()
    {
        $setcoleccionable = new SetColeccionable();
        
        $setcoleccionable->precio = $this->state['price'];
        $setcoleccionable->cant = $this->state['cant'];
        $setcoleccionable->visible = $this->state['visible'];
        $setcoleccionable->tipo_set = $this->state['tipo_set'];
        $setcoleccionable->coleccionable = Coleccionable::where('name',$this->search)->value('id');
        $setcoleccionable->coleccion = $this->id_set;

        $validator = Validator::make($setcoleccionable->toArray(), [
            'coleccionable' => ['required', 
            Rule::in([Coleccionable::where('id',$setcoleccionable->coleccionable)->value('id')])],
        ]);

        if ($validator->fails()) {
            $this->search = 'Write a valid name';
        }else{
            $setcoleccionable->save();
            $this->emit('saved');
        }
        
    }

    public function editSetCollection()
    {
        $this->edit_set->precio = $this->state['price'];
        $this->edit_set->cant = $this->state['cant'];
        $this->edit_set->visible = $this->state['visible'];
        $this->edit_set->tipo_set = $this->state['tipo_set'];
        $this->edit_set->coleccionable = Coleccionable::where('name',$this->search)->value('id');
        
        $validator = Validator::make($this->edit_set->toArray(), [
            'coleccionable' => ['required', 
            Rule::in([Coleccionable::where('id',$this->edit_set->coleccionable)->value('id')])],
        ]);

        if ($validator->fails()) {
            $this->search = 'Write a valid name';
        }else{
            $this->edit_set->save();
            $this->emit('updated');
        }
    }

    public function deleteSetCollection()
    {
        $this->edit_set->delete();

        $this->deleteSetModal = false;
    }
}
