<?php

namespace App\Providers;

use App\Actions\Jetstream\DeleteUser;
use App\Models\bitacora;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\ServiceProvider;
use Laravel\Fortify\Fortify;
use Laravel\Jetstream\Jetstream;

class JetstreamServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->configurePermissions();

        $bitacoraCreated = false;

        Fortify::authenticateUsing(function (Request $request) use (&$bitacoraCreated) {
            $user = User::where('email', $request->email)->first();
        
            if ($user && Hash::check($request->password, $user->password)) {
                if (!$bitacoraCreated) {
                    bitacora::create([
                        'accion' => 'Iniciar sesion',
                        'descripcion' => 'el usuario ' . $user->name . ' inicio sesion',
                        'id_user' => $user->id
                    ]);
                    $bitacoraCreated = true;
                }
                return $user;
            }
        });

        Jetstream::deleteUsersUsing(DeleteUser::class);
    }

    /**
     * Configure the permissions that are available within the application.
     *
     * @return void
     */
    protected function configurePermissions()
    {
        Jetstream::defaultApiTokenPermissions(['read']);

        Jetstream::permissions([
            'create',
            'read',
            'update',
            'delete',
        ]);
    }
}
