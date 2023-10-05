<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Muestra extends Model
{
    use HasFactory;

    // Relación con el tipo de muestra
    public function tipoMuestra()
    {
        return $this->belongsTo(TipoMuestra::class, 'tipo_muestra_id');
    }

    // Relación con el tipo de recipiente de muestra
    public function tipoRecipienteMuestra()
    {
        return $this->belongsTo(TipoRecipienteMuestra::class, 'tipo_recipiente_muestra_id');
    }

    // Relación con la unidad de medida
    public function unidadMedida()
    {
        return $this->belongsTo(UnidadMedida::class, 'unidad_medida_id');
    }

    // Relación con la solicitud a la que pertenece la muestra
    public function solicitud()
    {
        return $this->belongsTo(Solicitud::class, 'solicitud_id');
    }
}
