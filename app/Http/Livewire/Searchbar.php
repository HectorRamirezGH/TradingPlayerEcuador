<?php

namespace App\Http\Livewire;

use App\Models\Coleccionable;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Livewire\Component;


class Searchbar extends Component
{
    public $search;
    public $col;
    public $validator;
    public $id_col;

    public function render()
    {
        $coleccionables = Coleccionable::all();

        return view('livewire.searchbar', compact('coleccionables'));
    }

    public function searchColeccionable()
    {
        $col = Coleccionable::where('name',$this->search)->get();

        $id_col = Coleccionable::where('name',$this->search)->value('id');

        foreach($col as $c){
        $validator = Validator::make($c->toArray(), [
            'name' => ['required',Rule::in([Coleccionable::where('name',$this->search)->value('name')])],
        ]);
        }

        if(isset($validator)){
            if ($validator->fails()) {
                $this->search = 'Write a valid name';
            }else{
                return redirect()->route('collectable', ['id_col'=>$id_col]);
            }
        }
        
    }
}
