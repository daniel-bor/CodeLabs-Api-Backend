<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TipoMuestra extends Model
{
    use HasFactory;
    protected $table = 'tipo_muestras';

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

    public function tiposRecipiente()
    {
        return $this->belongsToMany(TipoRecipiente::class, 'tipo_recipiente_muestra', 'tipo_muestra_id', 'tipo_recipiente_id');
    }

    public function muestras()
    {
        return $this->hasMany(Muestra::class, 'tipo_muestra_id');
    }
}
