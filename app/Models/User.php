<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;
use Tymon\JWTAuth\Contracts\JWTSubject;

class User extends Authenticatable implements AuthenticatableContract, AuthorizableContract, CanResetPasswordContract, JWTSubject
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'telefono'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    // Relación con la tabla "empleados"
    public function empleado()
    {
        return $this->hasOne(Empleado::class, 'usuario_id');
    }

    public function cliente()
    {
        return $this->hasOne(Cliente::class, 'usuario_id');
    }

    // Relación con la tabla "clientes"

    // Relación con la tabla "roles"
    public function rol()
    {
        return $this->belongsTo(Rol::class, 'rol_id');
    }

    // Relación con la tabla "encabezado_bitacora"
    public function encabezadosBitacora()
    {
        return $this->hasMany(EncabezadoBitacora::class, 'usuario_id');
    }

    // Implementación de las funciones de la interfaz JWTSubject
    // Implementación de la función getJWTIdentifier
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    // Implementación de la función getJWTCustomClaims
    public function getJWTCustomClaims()
    {
        return [
            'user_id' => $this->id,
            'email' => $this->email,
            // Puedes agregar más reclamaciones personalizadas aquí según tus necesidades.
        ];
    }
}
