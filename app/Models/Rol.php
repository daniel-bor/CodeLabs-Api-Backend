<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rol extends Model
{
    use HasFactory;
    protected $table = 'roles';

    public function empleados()
    {
        return $this->hasMany(Empleado::class, 'rol_id');
    }
}
