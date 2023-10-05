<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TipoRecipienteMuestra extends Model
{
    use HasFactory;

    // Relación con el usuario que creó este tipo de examen
    public function creadoPor()
    {
        return $this->belongsTo(User::class, 'creado_por');
    }

    // Relación con el usuario que lo modificó (si es necesario)
    public function modificadoPor()
    {
        return $this->belongsTo(User::class, 'modificado_por');
    }
}
