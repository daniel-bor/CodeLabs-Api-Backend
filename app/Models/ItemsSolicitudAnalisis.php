<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ItemsSolicitudAnalisis extends Model
{
    use HasFactory;

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
}
