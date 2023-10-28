<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Solicitud extends Model
{
    use HasFactory;
    use SoftDeletes;
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
    public function usuarioAsignado()
    {
        return $this->belongsToMany(User::class, 'trazabilidad_solicitudes','solicitud_id', 'usuario_asignado_id')
        ->orderBy('created_at', 'desc') // Ordena por la fecha más reciente
        ->limit(1); // Limita a un solo registro (el más reciente)
    }

    //Relacion de usuario que esta asignado
    public function empleadoAsignado()
    {
        return $this->belongsTo(Empleado::class, 'empleado_id', 'usuario_id')->first();
    }

    //Relacion para el estado de solicitud
    public function estadoSolicitud()
    {
        return $this->belongsTo(EstadoSolicitud::class, 'estado');
    }

    //Relacion para mostrar la cantidad de muestras
    public function muestras()
    {
        return $this->hasMany(Muestra::class, 'solicitud_id');
    }

    // Relacion para obtener los item de las muestras relacionadas a la solicitud
    public function itemsSolicitados()
    {
        return $this->belongsToMany(Item::class, 'items_solicitud_analisis', 'solicitud_id', 'item_id');
    }

    // Relacion para obtener los item de las muestras relacionadas a las muestras de solicitud
    public function itemsMuestras()
    {
        return $this->belongsToMany(ItemsMuestra::class, 'muestras', 'solicitud_id', 'id');
    }


    public function usuarioAsignador()
    {
        return $this->belongsToMany(User::class, 'trazabilidad_solicitudes', 'solicitud_id', 'usuario_asignador_id')
            ->orderBy('created_at', 'desc') // Ordena por la fecha más reciente
            ->limit(1); // Limita a un solo registro (el más reciente)
    }

    //Relacion para obtener la cantidad de documento delas muestras
    public function documentosMuestra()
    {
        return $this->hasMany(Documento::class, 'solicitud_id', 'id');
    }

    public function documentos()
    {
        return $this->hasMany(Documento::class, 'solicitud_id');
    }

    public function estadoTrazabilidad()
    {
        return $this->belongsToMany(EstadoSolicitud::class, 'trazabilidad_solicitud', 'estado_solicitud_id','solicitud_id');
    }

    public function trazabilidad()
    {
        return $this->hasMany(TrazabilidadSolicitud::class, 'solicitud_id');
    }


    protected $fillable = [
        'tipo_soporte_id',
        'no_soporte',
        'descripcion',
        'cliente_id',
        'direccion',
        'longitud',
        'latitud',
        'codigo',
        'estado'
    ];
}
