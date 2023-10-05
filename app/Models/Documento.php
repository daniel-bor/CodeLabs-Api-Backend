<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Documento extends Model
{
    use HasFactory;

    // Relación con la solicitud asociada
    public function solicitud()
    {
        return $this->belongsTo(Solicitud::class, 'solicitud_id');
    }
}
