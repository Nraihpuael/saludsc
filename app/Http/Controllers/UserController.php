<?php

namespace App\Http\Controllers;

use App\Exports\UserExport;
use App\Models\bitacora;
use App\Models\User;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $roles = [];
        $rol = $request->role;

        if ($request->role) {
            array_push($roles, $rol);
        }

        if (sizeof($roles) == 0) {
            if (Auth::user()->hasPermissionTo('ver adminis')) {
                array_push($roles, 'Admin');
            }
            if (Auth::user()->hasPermissionTo('ver funcionarios')) {
                array_push($roles, 'Funcionario');
            }
            if (Auth::user()->hasPermissionTo('ver personal medico')) {
                array_push($roles, 'Personal Médico');
            }
            if (Auth::user()->hasPermissionTo('ver pacientes')) {
                array_push($roles, 'Paciente');
            }
        }

        $textSearch = trim($request->textSearch);

        $users = User::whereHas('roles', function ($query) use ($roles) {
            $query->whereIn('name', $roles);
        })
            ->where('name', 'LIKE', '%' . $textSearch . '%')
            ->orWhere('ci', 'LIKE', '%' . $textSearch . '%')
            ->orWhere('email', 'LIKE', '%' . $textSearch . '%')
            ->orWhere('ap_paterno', 'LIKE', '%' . $textSearch . '%')
            ->orWhere('ap_materno', 'LIKE', '%' . $textSearch . '%')
            ->orderBy('created_at', 'desc')->paginate(10);
        $sRoles = Role::select('name')->get();
        return view('usuarios.index', compact('users', 'sRoles', 'textSearch', 'rol'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = Role::select('name')->get();
        return view('usuarios.create', compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        dd($request);
        $validatedData = $request->validate([
            'ci' => 'required|integer|unique:users,ci',
            'name' => 'required|string|max:50',
            'email' => 'required|email|unique:users,email',
            'ap_paterno' => 'nullable|string|max:50',
            'ap_materno' => 'nullable|string|max:50',
            'telefono' => 'nullable|string|max:20',
            'departamento' => 'nullable|string',
            'localidad' => 'nullable|string',
            'barrio' => 'nullable|string',
            'ubicacion' => 'nullable|string',
            'longitud' => 'nullable|numeric',
            'latitud' => 'nullable|numeric',
            // 'estado' => 'integer|in:0,1',
            'genero' => 'required|string|max:1',
            'fecha_nac' => 'required|date',
            'password' => 'required|string|min:8|confirmed',
            // 'profile_photo' => 'nullable|image|max:2048',
        ]);

        // Procesar y guardar los datos en la base de datos
        $user = new User;
        $user->ci = $validatedData['ci'];
        $user->name = $validatedData['name'];
        $user->email = $validatedData['email'];
        $user->ap_paterno = $validatedData['ap_paterno'];
        $user->ap_materno = $validatedData['ap_materno'];
        $user->telefono = $validatedData['telefono'];
        $user->departamento = $validatedData['departamento'];
        $user->localidad = $validatedData['localidad'];
        $user->barrio = $validatedData['barrio'];
        $user->ubicacion = $validatedData['ubicacion'];
        $user->longitud = $validatedData['longitud'];
        $user->latitud = $validatedData['latitud'];
        // $user->estado = $validatedData['estado'];
        $user->genero = $validatedData['genero'];
        $user->fecha_nac = $validatedData['fecha_nac'];
        $user->password = bcrypt($validatedData['password']);

        // Subir la foto de perfil si está presente
        /* if ($request->hasFile('profile_photo')) {
        $profilePhotoPath = $request->file('profile_photo')->store('profile_photos');
        $user->profile_photo_path = $profilePhotoPath;
    } */

        $user->save();
        $user->assignRole($request->role);

        bitacora::create([
            'accion' => 'Crear Usuario',
            'descripcion' => 'El usuario ' . Auth::user()->name . ' agrego un nuevo usuario con ci: ' . $user->ci,
            'id_user' => Auth::user()->id,
        ]);

        return redirect()->back()->with('message', 'Usuario creado exitosamente.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {

        return view('usuarios.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {

        $validatedData = $request->validate([
            'ci' => 'required|integer|unique:users,ci',
            'name' => 'required|string|max:50',
            'email' => 'required|email|unique:users,email',
            'ap_paterno' => 'nullable|string|max:50',
            'ap_materno' => 'nullable|string|max:50',
            'telefono' => 'nullable|string|max:20',
            'departamento' => 'nullable|string',
            'localidad' => 'nullable|string',
            'barrio' => 'nullable|string',
            'ubicacion' => 'nullable|string',
            'longitud' => 'nullable|numeric',
            'latitud' => 'nullable|numeric',
            // 'estado' => 'integer|in:0,1',
            'genero' => 'required|string|max:1',
            'fecha_nac' => 'required|date',
            'password' => 'required|string',
            // 'profile_photo' => 'nullable|image|max:2048',
        ]);

        // Procesar y guardar los datos en la base de datos
        $user->ci = $validatedData['ci'];
        $user->name = $validatedData['name'];
        $user->email = $validatedData['email'];
        $user->ap_paterno = $validatedData['ap_paterno'];
        $user->ap_materno = $validatedData['ap_materno'];
        $user->telefono = $validatedData['telefono'];
        $user->departamento = $validatedData['departamento'];
        $user->localidad = $validatedData['localidad'];
        $user->barrio = $validatedData['barrio'];
        $user->ubicacion = $validatedData['ubicacion'];
        $user->longitud = $validatedData['longitud'];
        $user->latitud = $validatedData['latitud'];
        // $user->estado = $validatedData['estado'];
        $user->genero = $validatedData['genero'];
        $user->fecha_nac = $validatedData['fecha_nac'];
        $user->password = bcrypt($validatedData['password']);

        // Subir la foto de perfil si está presente
        /* if ($request->hasFile('profile_photo')) {
        $profilePhotoPath = $request->file('profile_photo')->store('profile_photos');
        $user->profile_photo_path = $profilePhotoPath;
    } */

        $user->update();
        bitacora::create([
            'accion' => 'Editar Usuario',
            'descripcion' => 'El usuario ' . Auth::user()->name . ' edito informacion del usuario con ci: ' . $user->ci,
            'id_user' => Auth::user()->id,
        ]);
        // Redireccionar o devolver una respuesta según sea necesario
        return redirect()->route('users.index')->with('success', 'Usuario editado exitosamente.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function cambiarEstado(Request $request)
    {
        try {
            $message = '';
            $user = User::findOrFail($request->input('id'));
            $user->estado = $user->estado == 0 ? 1 : 0;
            if ($user->estado == 0) {
                $message = "Usuario inhabilitado exitosamente";
            }else{
                $message = "Usuario habilitado exitosamente";
            }
            $user->update();
            return response()->json(['message' => $message], 200);
        } catch (ModelNotFoundException $e) {
            return response()->json(['error' => 'Ocurrio un error, intentalo de nuevo'], 500);
        }
    }

    public function excel(){
        return Excel::download(new UserExport, 'users.xlsx');
    }
}
