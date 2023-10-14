<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Muestra extends Model
{
    use HasFactory;
    protected $table = 'muestras';
    // Relación con el tipo de muestra
    public function tipoMuestra()
    {
        return $this->belongsTo(TipoMuestra::class, 'tipo_muestra_id','id');
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

    public function items()
    {
        return $this->belongsToMany(Item::class, 'items_muestras', 'id_muestra', 'id_item');
    }

    protected $fillable = [
        'tipo_muestra_id',
        'tipo_recipiente_muestra_id',
        'cantidad_unidades',
        'unidad_medida_id',
        'etiqueta',
        'solicitud_id',
        'dia_vencimiento',
        'estado',
    ];
}
