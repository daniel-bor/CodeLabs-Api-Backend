<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Solicitud extends Model
{
    use HasFactory;
    protected $table = 'solicitudes';

    // Relación con el tipo de soporte
    public function tipoSoporte()
    {
        return $this->belongsTo(TipoSoporte::class, 'tipo_soporte_id');
    }

    // Relación con el cliente que realiza la solicitud
    public function cliente()
    {
        return $this->belongsTo(Cliente::class, 'cliente_id', 'id');
    }

    //Relacion de usuario que esta asignado
    public function usuarioasignado()
    {
        return $this->belongsToMany(User::class, 'usuario_asignaciones','usuario_asignado_id','usuario_asignador_id');
    }

    //Relacion para el estado de solicitud
    public function estadoSolicitud()
    {
        return $this->belongsTo(estadoSolicitud::class, 'id', 'id');
    }


    //Relacion para mostrar la cantidad de muestras
    public function muestra()
    {
        return $this->hasMany(Muestra::class, 'solicitud_id');
    }
 
    // Relacion para obtener los item de las muestras relacionadas a la solicitud
    public function itemsSolicitados()
    {
        return $this->belongsToMany(itemsMuestra::class, 'muestras', 'solicitud_id', 'id');
    }

    //Relacion para obtener la cantidad de documento delas muestras
    public function documentosMuestra()
    {
        return $this->hasMany(Documento::class, 'solicitud_id', 'id');
    }

   

    protected $fillable = [
        'tipo_soporte_id',
        'no_soporte',
        'descripcion',
        'cliente_id',
        'cliente_id',
        'longitud',
        'latitud'
    ];
}
