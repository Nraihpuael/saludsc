<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;
class User extends Authenticatable
{
    use HasApiTokens;
    use HasFactory;
    use HasProfilePhoto;
    use Notifiable;
    use TwoFactorAuthenticatable;
    use HasRoles;
    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'ci',
        'name',
        'email',
        'password',
        'ap_paterno',
        'ap_materno',
        'telefono',
        'departamento',
        'localidad',
        'barrio',
        'ubicacion',
        'latitud',
        'longitud',
        'estado',
        'genero',
        'fecha_nac',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = [
        'profile_photo_url',
    ];


    public function estadiasEnfermedades(){
        return $this->hasMany('App\Models\estadia_enfermedad');
    }

    public function brigadas(){
        return $this->belongsToMany('App\Models\brigada');
    }


    public function atenciones_como_medico(){
        return $this->hasMany('App\Models\Atencion','medico_id');
    }

    public function atenciones_como_paciente(){
        return $this->hasMany('App\Models\Atencion','paciente_id');
    }

    public function solicitudes(){
        return $this->hasMany('App\Models\solicitud','user_id');
    }

}
