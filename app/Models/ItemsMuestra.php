<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ItemsMuestra extends Model
{
    use HasFactory;
    use SoftDeletes;

    // Relación con el item asociado
    public function item()
    {
        return $this->belongsTo(Item::class, 'id_item');
    }

    // Relación con la muestra asociada
    public function muestra()
    {
        return $this->belongsTo(Muestra::class, 'id_muestra');
    }

    public function documentoAnalisis()
    {
        return $this->hasOne(DocumentoAnalisis::class, 'item_muestra_id', 'id');
    }
}
