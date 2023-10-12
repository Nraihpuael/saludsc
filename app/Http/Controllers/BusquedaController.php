<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;

class BusquedaController extends Controller
{


    public function buscar(Request $request)
    {
        $query = $request->input('query');
        // return $query;

        // Obtener todas las tablas de la base de datos
        $tablas = Schema::getConnection()->getDoctrineSchemaManager()->listTableNames();

        // return $tablas;
        // Tablas que deseas excluir de la búsqueda
        $tablasExcluidas = ['bitacoras', 'failed_jobs','fotos','migrations','model_has_permissions','model_has_roles','notifications','page_views','password_resets','permissions','personal_access_tokens','roles','role_has_permissions','sessions'];

        foreach ($tablas as $tabla) {
            // Verificar si la tabla actual está en la lista de tablas excluidas
            if (!in_array($tabla, $tablasExcluidas)) {
                $columnas = Schema::getColumnListing($tabla);

                // Buscar en cada columna de la tabla
                foreach ($columnas as $columna) {
                    $resultados = DB::table($tabla)
                        ->where($columna, 'LIKE', '%' . $query . '%')
                        ->get();

                    // Si se encontraron resultados, redireccionar al primer resultado
                    if (!$resultados->isEmpty()) {

                        $rutaIndex = $tabla . '.index';
                        if (Route::has($rutaIndex)) {
                            return redirect()->route($rutaIndex);
                        } else {
                            return redirect()->back()->with('alerta', 'La ruta de índice no existe');
                        }

                        // return $resultados;
                        //return redirect()->route($tabla . '.index');
                        //return redirect()->route('redireccionar', ['tabla' => $tabla, 'id' => $resultados->first()->id]);
                    }
                }
            }
        }

        // Si no se encontraron resultados, mostrar un mensaje o redireccionar a una página de resultados vacíos
        return redirect()->back()->with('alerta', 'La ruta de índice no existe');
    }

    public function redireccionar($tabla, $id)
    {
        // Aquí puedes realizar cualquier lógica adicional antes de redireccionar a la tupla encontrada
        // Por ejemplo, podrías realizar una validación para asegurarte de que el usuario tiene permiso para ver esta tupla

        // Redireccionar a la tupla encontrada
        return redirect()->route($tabla . '.show', $id);
    }

}
