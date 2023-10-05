<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Empleado extends Model
{
    use HasFactory;

     // Relación con la tabla "usuarios" para representar al empleado como usuario
     public function usuario()
     {
         return $this->belongsTo(User::class, 'usuario_id');
     }

     // Relación con la tabla "roles" para representar el rol del empleado
     public function rol()
     {
         return $this->belongsTo(Rol::class, 'rol_id');
     }
}
