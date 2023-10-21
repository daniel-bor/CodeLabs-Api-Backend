<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TipoExamen extends Model
{
    use HasFactory;
    protected $table = 'tipo_examenes';

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

    public function items()
    {
        return $this->hasMany(Item::class, 'tipo_examen_id');
    }

    public function tipoMuestra()
    {
        return $this->belongsTo(TipoMuestra::class, 'tipo_muestra_id');
    }
}
