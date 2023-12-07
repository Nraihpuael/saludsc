<?php

namespace App\Http\Livewire;

use App\Models\tipo_punto;
use Livewire\Component;
use Livewire\WithPagination;

class Tipospuntos extends Component
{
    use WithPagination;
    //definimos unas variables
    public $nombre, $descripcion, $id_tipo_punto;
    public $create_modal = false;
    public $edit_modal = false;
    public $search = '';

    protected $listeners = ['render' => 'render'];

    protected $rules = [
        'nombre' => 'required|max:30',
        'descripcion' => 'required|max:70'
    ];
    public $pageViews;
    public $loaded = false;
    public function mount()
    {
        $this->pageViews = getPageViews('tipos_puntos_inicio'); // Reemplaza 'example-page' con el nombre de tu página actual
    }
    public function render()
    {
        $tipo_punto = tipo_punto::where('nombre', 'like', '%' . $this->search . '%')->paginate(8);
        return view('puntosatencion.tipospuntos.index', compact('tipo_punto'));
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function create()
    {
        $this->cleanFields();
        $this->open_create();
    }
    public function open_create()
    {
        $this->create_modal = true;
    }
    public function close_create()
    {
        $this->create_modal = false;
    }
    public function cleanFields()
    {
        $this->nombre = '';
        $this->descripcion = '';
        $this->id_tipo_punto = '';
    }
    public function store()
    {
        $this->validate();
        tipo_punto::create(
            [
                'nombre' => $this->nombre,
                'descripcion' => $this->descripcion,
            ]
        );
        $this->emitSelf('render');
        $this->emit('alert', 'Tipo agregado exitosamente!');
        $this->close_create();
        $this->cleanFields();
    }

    public function edit($id)
    {
        $tipo_punto = tipo_punto::findOrFail($id);
        $this->id_tipo_punto = $id;
        $this->nombre = $tipo_punto->nombre;
        $this->descripcion = $tipo_punto->descripcion;
        $this->open_edit();
    }

    public function delete($id){
        tipo_punto::find($id)->delete();
        session()->flash('message', 'Registro eliminado correctamente');
    }
    public function open_edit()
    {
        $this->edit_modal = true;
    }
    public function close_edit()
    {
        $this->edit_modal = false;
    }
    public function update() 
    {
        $this->validate();
        $tipo_punto = tipo_punto::find($this->id_tipo_punto);
        $tipo_punto->nombre = $this->nombre;
        $tipo_punto->descripcion = $this->descripcion;
        $tipo_punto->update();
        $this->emitSelf('render');
        $this->emit('alert', '¡Tipo editado exitosamente!');
        $this->close_edit();
        $this->cleanFields();  
    }
}