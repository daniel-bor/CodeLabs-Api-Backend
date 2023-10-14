<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TrazabilidadSolicitud extends Model
{
    use HasFactory;
    protected $table = 'trazabilidad_solicitudes';


    // Relación con la solicitud asociada
    public function solicitud()
    {
        return $this->belongsTo(Solicitud::class, 'solicitud_id');
    }

    // Relación con el usuario asociado
    public function usuarioAsignador()
    {
        return $this->belongsTo(User::class, 'usuario_asignador_id');
    }

    // Relación con el usuario asociado
    public function usuarioAsignado()
    {
        return $this->belongsTo(User::class, 'usuario_asignado_id');
    }

    // Relación con el estado de solicitud asociado
    public function estadoSolicitud()
    {
        return $this->belongsTo(EstadoSolicitud::class, 'estado_solicitud_id');
    }

    protected $fillable = [
        'solicitud_id',
        'estado_solicitud_id',
        'observaciones',
        'usuario_asignador_id',
        'usuario_asignado_id',
        'created_at',
        'updated_at'
    ];
}
