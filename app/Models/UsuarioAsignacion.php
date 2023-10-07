<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UsuarioAsignacion extends Model
{
    use HasFactory;
    protected $table = 'usuario_asignaciones';
    // Relación con el usuario asignado
    public function usuarioAsignado()
    {
        return $this->belongsTo(User::class, 'usuario_asignado_id');
    }

    // Relación con el usuario asignador
    public function usuarioAsignador()
    {
        return $this->belongsTo(User::class, 'usuario_asignador_id');
    }

    // Relación con la solicitud asociada
    public function solicitud()
    {
        return $this->belongsTo(Solicitud::class, 'solicitud_id');
    }

}
