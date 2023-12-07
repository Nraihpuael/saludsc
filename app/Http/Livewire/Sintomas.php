<?php

namespace App\Http\Livewire;

use App\Models\PageView;
use App\Models\sintoma;
use Livewire\Component;
use Livewire\WithPagination;

class Sintomas extends Component
{
    use WithPagination;
    //definimos unas variables
    public $nombre, $descripcion, $id_sintoma;
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
        $this->pageViews = getPageViews('sintomas_inicio'); // Reemplaza 'example-page' con el nombre de tu página actual
    }
    public function render()
    {
        $sintomas = sintoma::where('nombre', 'like', '%' . $this->search . '%')->paginate(8);
        return view('enfermedades.sintomas.index', compact('sintomas'));
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
        $this->id_sintoma = '';
    }
    public function store()
    {
        $this->validate();
        sintoma::create(
            [
                'nombre' => $this->nombre,
                'descripcion' => $this->descripcion,
            ]
        );
        $this->emitSelf('render');
        $this->emit('alert', 'Síntoma agregado exitosamente!');
        $this->close_create();
        $this->cleanFields();
    }

    public function edit($id)
    {
        $sintoma = sintoma::findOrFail($id);
        $this->id_sintoma = $id;
        $this->nombre = $sintoma->nombre;
        $this->descripcion = $sintoma->descripcion;
        $this->open_edit();
    }

    public function borrar($id)
    {
        sintoma::find($id)->delete();
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
        $sintoma = sintoma::find($this->id_sintoma);
        $sintoma->nombre = $this->nombre;
        $sintoma->descripcion = $this->descripcion;
        $sintoma->update();
        $this->emitSelf('render');
        $this->emit('alert', '¡Síntoma editado exitosamente!');
        $this->close_edit();
        $this->cleanFields();
    }
}
