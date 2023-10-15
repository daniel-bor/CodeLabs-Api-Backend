<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    use HasFactory;
    protected $table = 'items';

    public function creador()
    {
        return $this->belongsTo(User::class, 'creado_por');
    }

    // Relación con el usuario que lo modificó (opcional, puede ser nulo)
    public function modificador()
    {
        return $this->belongsTo(User::class, 'modificado_por');
    }

    // Relación con el tipo de examen al que pertenece
    public function tipoExamen()
    {
        return $this->belongsTo(TipoExamen::class, 'tipo_examen_id');
    }

    public function muestras()
    {
        return $this->belongsToMany(Muestra::class, 'items_muestras', 'id_item', 'id_muestra')
            ->withTimestamps();
    }
}
