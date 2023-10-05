<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ItemsMuestra extends Model
{
    use HasFactory;

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
}
