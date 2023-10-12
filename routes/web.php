<?php

use App\Http\Controllers\AtencionController;
use App\Http\Controllers\BitacoraController;
use App\Http\Controllers\BrigadaController;
use App\Http\Controllers\BusquedaController;
use App\Http\Controllers\CasoController;
use App\Http\Controllers\EnfermedadViralController;
use App\Http\Controllers\EquipoController;
use App\Http\Controllers\EstadiaEnfermedadBrigadaController;
use App\Http\Controllers\EstadiaEnfermedadController;
use App\Http\Controllers\ImportController;
use App\Http\Controllers\LaboratorioController;
use App\Http\Controllers\MapaController;
use App\Http\Controllers\PrediccionController;
use App\Http\Controllers\PuntoAtencionController;
use App\Http\Controllers\ResultadoController;
use App\Http\Controllers\SolicitudController;
use App\Http\Controllers\TrabajoController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\visualizarController;
use App\Http\Livewire\Roles;
use App\Http\Livewire\Sintomas;
use App\Http\Livewire\TiposPuntos;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboard', [visualizarController::class, 'mostrarGraficaEnfermedades'
    ])->name('dashboard');


    /**
     * Administer Entinty
     */
    Route::post('users/cambiar-estado', [UserController::class, 'cambiarEstado'])->name('users.cambiarEstado');
    Route::get('users/export-data', [UserController::class, 'excel'])->name('users.export');
    Route::get('estadia-punto/export-data', [EstadiaEnfermedadController::class, 'excel'])->name('estadiaPunto.export');
    Route::get('estadia-brigada/export-data', [EstadiaEnfermedadBrigadaController::class, 'excel'])->name('estadiaBrigada.export');
    Route::get('bitacora/export-data', [BitacoraController::class, 'excel'])->name('bitacora.export');
    Route::resource('users', UserController::class);
    //Route::resource('tipospunto', TipoPuntoController::class);
    Route::get('tipospuntos', TiposPuntos::class)->name('tipospuntos');
    Route::get('roles', Roles::class)->name('roles');
    
    Route::get('sintomas', Sintomas::class)->name('sintomas');
    Route::resource('enfermedades', EnfermedadViralController::class);
    
    Route::post('puntosatencion/trabajadores-agregar', [TrabajoController::class, 'agregar'])->name('trabajadores.agregar');
    Route::get('puntosatencion/trabajadores-quitar/{id}', [TrabajoController::class, 'quitar'])->name('trabajadores.quitar');
    Route::get('puntosatencion/trabajadores', [TrabajoController::class, 'index'])->name('trabajadores.index');
    
    Route::resource('puntosatencion', PuntoAtencionController::class);
    Route::resource('brigadas', BrigadaController::class);
    Route::resource('registrarcasosPunto', EstadiaEnfermedadController::class);
    Route::resource('registrarcasosBrigada', EstadiaEnfermedadBrigadaController::class);
    Route::resource('atenciones', AtencionController::class);
    Route::resource('resultados', ResultadoController::class);
    Route::get('bitacora', [BitacoraController::class, 'index'])->name('bitacora.index');
    Route::resource('solicitudes', SolicitudController::class);

    Route::resource('equipos', EquipoController::class);

    Route::get('caso/{id}', [CasoController::class, 'ver'])->name('caso.ver');
    
    Route::get('Hospitales/visualizar', [visualizarController::class, 'ver'])->name('visualizar.ver');


    Route::get('prediccion/', [PrediccionController::class, 'index'])->name('prediccion.index');
    Route::get('datosPrediccion/{id}/{fecha_ini}/{fecha_fin}/', [PrediccionController::class, 'getDataHospital']);

    Route::view('/mapacalor', 'analisis.mapascalor')->name('mapascalor.index');

    Route::resource('mapas', MapaController::class);

    Route::get('/buscar', [BusquedaController::class,'buscar'])->name('buscar');
    Route::get('/redireccionar/{tabla}/{id}', [BusquedaController::class,'redireccionar'])->name('redireccionar');

    Route::get('laboratorios/export-data', [LaboratorioController::class, 'excel'])->name('laboratorios.export');
    Route::post('laboratorios/import-data', [LaboratorioController::class, 'import'])->name('laboratorios.import');
    Route::resource('laboratorios', LaboratorioController::class);

    Route::post('/import', [ImportController::class, 'labImport'])->name('import.import');;

});
