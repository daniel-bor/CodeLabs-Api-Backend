<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Muestra extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $table = 'muestras';
    // Relación con el tipo de muestra
    public function tipoMuestra()
    {
        return $this->belongsTo(TipoMuestra::class, 'tipo_muestra_id', 'id');
    }

    // Relación con el tipo de recipiente de muestra
    public function tipoRecipiente()
    {
        return $this->belongsTo(TipoRecipiente::class, 'tipo_recipiente_id');
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
        return $this->belongsToMany(Item::class, 'items_muestras', 'id_muestra', 'id_item')
            ->withTimestamps();
    }

    public function itemsMuestras()
    {
        return $this->hasMany(ItemsMuestra::class, 'id_muestra');
    }

    //Relacion para el estado de muestra
    public function estadoMuestra()
    {
        return $this->belongsTo(EstadoSolicitud::class, 'estado', 'id');
    }

    protected $fillable = [
        'codigo',
        'tipo_muestra_id',
        'tipo_recipiente_id',
        'cantidad_unidades',
        'unidad_medida_id',
        'etiqueta',
        'solicitud_id',
        'dia_vencimiento',
        'estado',
    ];
}
