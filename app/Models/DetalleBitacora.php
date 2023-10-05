<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetalleBitacora extends Model
{
    use HasFactory;

    public function encabezadoBitacora()
    {
        return $this->belongsTo(EncabezadoBitacora::class, 'encabezado_id');
    }
}
