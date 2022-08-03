<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Colecciones;
use Illuminate\Support\Facades\Auth;

class CollectionsTable extends Component
{
    public $createCollectionModal = false;
    public $deleteCollectionModal = false;
    public $editCollectionModal = false;

    public $edit_coleccion;

    public $state = [
        'name' => '',
        'desc' => '',
    ];

    public function render()
    {
        $userCollections = Colecciones::where('user','=',Auth::user()->getAuthIdentifier())->get();

        return view('livewire.collections-table', compact('userCollections'));
    }

    public function createCollectionModal()
    {
        $this->state['name'] = '';
        $this->state['desc'] = '';

        $this->createCollectionModal = true;
    }

    public function editCollectionModal($id_edit)
    {
        $this->edit_coleccion = Colecciones::findOrFail($id_edit);

        $this->state['name'] = $this->edit_coleccion->name;
        $this->state['desc'] = $this->edit_coleccion->desc;

        $this->editCollectionModal = true;
    }

    public function deleteCollectionModal($id_edit)
    {
        $this->edit_coleccion = Colecciones::findOrFail($id_edit);

        $this->deleteCollectionModal = true;
    }

    public function createCollection()
    {
        $coleccion = new Colecciones();
        
        $coleccion->name = $this->state['name'];
        $coleccion->desc = $this->state['desc'];
        $coleccion->user = Auth::user()->getAuthIdentifier();

        $coleccion->save();

        $this->emit('refreshComponent');
        $this->emit('saved');
    }

    public function editCollection()
    {
        $this->edit_coleccion->name = $this->state['name'];
        $this->edit_coleccion->desc = $this->state['desc'];
        
        $this->edit_coleccion->save();
        $this->emit('updated');
    }
    
    public function deleteCollection()
    {
        $this->edit_coleccion->delete();

        $this->deleteCollectionModal = false;     
        
        $this->emit('refreshComponent');
    }
}
