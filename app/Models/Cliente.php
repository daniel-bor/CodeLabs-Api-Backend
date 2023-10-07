<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    use HasFactory;
    protected $table = 'clientes';
    protected $fillable = ['nit', 'profesion'];

    public function usuario()
    {
        return $this->belongsTo(User::class, 'usuario_id');
    }
}
