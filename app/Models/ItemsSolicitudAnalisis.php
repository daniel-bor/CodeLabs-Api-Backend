<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ItemsSolicitudAnalisis extends Model
{
    use HasFactory;
    protected $table = 'items_solicitud_analisis';

    // Relación con la solicitud asociada
    public function solicitud()
    {
        return $this->belongsTo(Solicitud::class, 'solicitud_id');
    }

    // Relación con el item asociado
    public function item()
    {
        return $this->belongsTo(Item::class, 'item_id');
    }

    protected $fillable = [
        'solicitud_id',
        'item_id',
        'estado'
    ];
}
