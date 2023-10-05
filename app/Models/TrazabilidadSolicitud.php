<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TrazabilidadSolicitud extends Model
{
    use HasFactory;

    // Relación con la solicitud asociada
    public function solicitud()
    {
        return $this->belongsTo(Solicitud::class, 'solicitud_id');
    }

    // Relación con el estado de solicitud asociado
    public function estadoSolicitud()
    {
        return $this->belongsTo(EstadoSolicitud::class, 'estado_solicitud_id');
    }
}
