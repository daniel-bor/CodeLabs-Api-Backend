<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Solicitud extends Model
{
    use HasFactory;
    protected $table = 'solicitudes';

    // Relación con el tipo de soporte
    public function tipoSoporte()
    {
        return $this->belongsTo(TipoSoporte::class, 'tipo_soporte_id');
    }

    // Relación con el cliente que realiza la solicitud
    public function cliente()
    {
        return $this->belongsTo(Cliente::class, 'cliente_id', 'usuario_id');
    }

    public function itemsSolicitados()
    {
        return $this->belongsToMany(Item::class, 'items_solicitud_analisis', 'solicitud_id', 'item_id');
    }


    protected $fillable = [
        'tipo_soporte_id',
        'no_soporte',
        'descripcion',
        'cliente_id',
        'longitud',
        'latitud'
    ];
}
