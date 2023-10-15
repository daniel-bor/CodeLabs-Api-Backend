<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TipoRecipiente extends Model
{
    use HasFactory;
    protected $table = 'tipo_recipientes';

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

    public function tiposMuestra()
    {
        return $this->belongsToMany(TipoMuestra::class, 'tipo_recipiente_muestra', 'tipo_recipiente_id', 'tipo_muestra_id');
    }
}
