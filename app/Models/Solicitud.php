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
        return $this->belongsTo(Cliente::class, 'cliente_id', 'usuario_id');
    }

    public function itemsSolicitados()
    {
        return $this->belongsToMany(Item::class, 'items_solicitud_analisis', 'solicitud_id', 'item_id');
    }

    public function estadoSolicitud()
    {
        return $this->belongsTo(EstadoSolicitud::class, 'estado_solicitudes', 'estado', 'id');
    }

    public function usuarioAsignado()
    {
        return $this->belongsToMany(User::class, 'usuario_asignaciones', 'solicitud_id', 'usuario_asignado_id')
            ->orderBy('created_at', 'desc') // Ordena por la fecha más reciente
            ->limit(1); // Limita a un solo registro (el más reciente)
    }

    public function usuarioAsignador()
    {
        return $this->belongsToMany(User::class, 'usuario_asignaciones', 'solicitud_id', 'usuario_asignador_id')
            ->orderBy('created_at', 'desc') // Ordena por la fecha más reciente
            ->limit(1); // Limita a un solo registro (el más reciente)
    }

    public function muestras()
    {
        return $this->hasMany(Muestra::class, 'solicitud_id');
    }

    public function documentos()
    {
        return $this->hasMany(Documento::class, 'solicitud_id');
    }


    protected $fillable = [
        'tipo_soporte_id',
        'no_soporte',
        'descripcion',
        'cliente_id',
        'longitud',
        'latitud',
        'codigo'
    ];
}
