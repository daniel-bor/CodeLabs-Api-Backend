<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EstadoSolicitud extends Model
{
    use HasFactory;
    protected $table = 'estado_solicitudes';
    // Relación con el usuario que creó este tipo de examen
    public function creadoPor()
    {
        return $this->belongsTo(User::class, 'creado_por');
    }

    // Relación con el usuario que lo modificó (si es necesario)
    public function modificadoPor()
    {
        return $this->belongsTo(User::class, 'modificado_por');
    }

    public function estadoAnterior()
    {
        return $this->belongsTo(EstadoSolicitud::class, 'estado_anterior');
    }

    public function estadoSiguiente()
    {
        return $this->belongsTo(EstadoSolicitud::class, 'estado_siguiente');
    }

    public function empleadoRol()
    {
        return $this->belongsTo(Rol::class, 'empleado_rol');
    }

    public function estadoEspera()
    {
        return EstadoSolicitud::where('nombre', 'ESPERA')->first();
    }

    public function estadoCancelado()
    {
        return EstadoSolicitud::where('nombre', 'CANCELADO')->first();
    }

    public function estadoRechazado()
    {
        return EstadoSolicitud::where('nombre', 'RECHAZADO')->first();
    }
}
