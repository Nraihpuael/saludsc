<?php

namespace App\Http\Livewire;

use App\Models\bitacora;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;
use Spatie\Permission\Models\Role;

class Roles extends Component
{
    use WithPagination;
    //definimos unas variables
    public $name, $id_rol;
    public $create_modal = false;
    public $edit_modal = false;
    public $search = '';

    protected $listeners = ['render' => 'render'];

    protected $rules = [
        'name' => 'required|max:30'
    ];

    public $pageViews;
    public $loaded = false;
    public function mount()
    {
        $this->pageViews = getPageViews('roles_inicio'); // Reemplaza 'example-page' con el nombre de tu página actual
    }

    public function render()
    {
        $roles = Role::where('name', 'like', '%' . $this->search . '%')->paginate(8);
        return view('roles.index', compact('roles'));
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
        $this->name = '';
        $this->id_rol = '';
    }
    public function store()
    {
        try {
            $this->validate();
            Role::create(
                [
                    'name' => $this->name,
                ]
            );
            bitacora::create([
                'accion' => 'Iniciar sesion',
                'descripcion' => 'el usuario ' . Auth::user()->name . ' inicio sesion',
                'id_user' => Auth::user()->id
            ]);
            $this->emitSelf('render');
            $this->emit('alert', '¡Rol agregado exitosamente!');
            $this->close_create();
            $this->cleanFields();
        } catch (\Throwable $th) {
            $this->emit('alert-error', 'Ocurrio un error, el rol que tratas de agregar tal vez ya existe');
        }
    }

    public function edit($id)
    {
        $rol = Role::findOrFail($id);
        $this->id_rol = $id;
        $this->name = $rol->name;
        $this->open_edit();
    }

    // public function borrar($id)
    // {
    //     Role::find($id)->delete();
    //     session()->flash('message', 'Registro eliminado correctamente');
    // }
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
        try {
            $this->validate();
            $rol = Role::find($this->id_rol);
            $rol->name = $this->name;
            $rol->update();
            $this->emitSelf('render');
            $this->emit('alert', '¡Rol editado exitosamente!');
            $this->close_edit();
            $this->cleanFields();
        } catch (\Throwable $th) {
            $this->emit('alert-error', 'Ocurrio un error, el rol que tratas de agregar tal vez ya existe');
        }
    }
}
