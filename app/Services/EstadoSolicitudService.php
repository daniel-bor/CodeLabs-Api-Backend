<?php

namespace App\Services;

use App\Models\Empleado;
use App\Models\EstadoSolicitud;
use App\Models\Solicitud;
use App\Models\TrazabilidadSolicitud;

class EstadoSolicitudService
{
    private $mapeoEstados = [
        'CREADO' => ['nuevoEstado' => 'REVISADO', 'nuevoEmpleado' => 'Tecnico', 'previoEstado' => 'CREADO'],
        'REVISADO' => ['nuevoEstado' => 'INICIADO', 'nuevoEmpleado' => 'Centralizador', 'previoEstado' => 'CREADO'],
        'INICIADO' => ['nuevoEstado' => 'ASOCIADO', 'nuevoEmpleado' => 'Centralizador', 'previoEstado' => 'REVISADO'],
        'ASOCIADO' => ['nuevoEstado' => 'VALIDADO', 'nuevoEmpleado' => 'Centralizador', 'previoEstado' => 'INICIADO'],
        'VALIDADO' => ['nuevoEstado' => 'ANALISIS', 'nuevoEmpleado' => 'Centralizador', 'previoEstado' => 'ASOCIADO'],
        'ANALISIS' => ['nuevoEstado' => 'COMPLETADO', 'nuevoEmpleado' => 'Centralizador', 'previoEstado' => 'VALIDADO'],
        'COMPLETADO' => ['nuevoEstado' => 'REVISION_FINAL', 'nuevoEmpleado' => 'Centralizador', 'previoEstado' => 'ANALISIS'],
        'REVISION_FINAL' => ['nuevoEstado' => 'FINALIZADO', 'nuevoEmpleado' => 'Centralizador', 'previoEstado' => 'COMPLETADO'],
    ];

    public function asignar(Solicitud $solicitud, string $observaciones): void
    {
        $this->cambiarEstado($solicitud, 'SIGUIENTE');
        $this->actualizarTrazabilidad($solicitud, 'SIGUIENTE', $observaciones);
    }

    public function rechazar(Solicitud $solicitud, string $observaciones): void
    {
        $this->cambiarEstado($solicitud, 'ANTERIOR');
        $this->actualizarTrazabilidad($solicitud, 'ANTERIOR', $observaciones);
    }

    public function pausar(Solicitud $solicitud): void
    {
        $solicitud->estado = EstadoSolicitud::where('nombre', 'ESPERA')->first()->id;
        $solicitud->save();
    }

    public function cancelar(Solicitud $solicitud): void
    {
        $solicitud->estado = EstadoSolicitud::where('nombre', 'CANCELADO')->first()->id;
        $solicitud->save();
    }

    public function cambiarEstado(Solicitud $solicitud, string $to): void
    {
        if ($to == 'SIGUIENTE') {
            $solicitud->estado = $solicitud->estadoSolicitud->estadoSiguiente->id;
        }elseif ($to == 'ANTERIOR') {
            $solicitud->estado = $solicitud->estadoSolicitud->estadoAnterior->id;
        }
        $solicitud->save();
    }

    public function obtenerEmpleadoPorRol(int $rol_id): int
    {
        $empleadoAleatorio = Empleado::whereHas('rol', function ($query) use ($rol_id) {
            $query->where('id', $rol_id);
        })
            ->inRandomOrder()
            ->first();

        return $empleadoAleatorio->id;
    }

    public function obtenerUltimoEstadoSolicitud(Solicitud $solicitud): EstadoSolicitud
    {
        $ultimoEstado = $solicitud->estadoTrazabilidad()->latest()->first();
        return $ultimoEstado;
    }

    public function actualizarTrazabilidad(Solicitud $solicitud, string $to, string $observaciones): void
    {
        $trazabilidadActual = $solicitud->trazabilidad()->latest()->first();
        $nuevaTrazabilidad = new TrazabilidadSolicitud();
        $nuevaTrazabilidad->solicitud_id = $solicitud->id;
        $nuevaTrazabilidad->estado_solicitud_id = $solicitud->estado;
        $nuevaTrazabilidad->observaciones = $observaciones;
        $nuevaTrazabilidad->usuario_asignador_id = $trazabilidadActual->usuario_asignado_id;
        if ($to == 'SIGUIENTE') {
            $nuevaTrazabilidad->usuario_asignado_id = $this->obtenerEmpleadoPorRol($solicitud->estadoSolicitud->estadoSiguiente->empleadoRol->id);
        }elseif ($to == 'ANTERIOR') {
            $nuevaTrazabilidad->usuario_asignado_id = TrazabilidadSolicitud::where('solicitud_id', $solicitud->id)->orderBy('created_at', 'desc')->limit(3)->skip(1)->first();
        }
        $solicitud->empleado_id = $nuevaTrazabilidad->usuario_asignado_id;
        $solicitud->save();
        $nuevaTrazabilidad->save();
    }

    public function crearTrazabilidad(Solicitud $solicitud): void
    {
        $nuevaTrazabilidad = new TrazabilidadSolicitud();
        $nuevaTrazabilidad->solicitud_id = $solicitud->id;
        $nuevaTrazabilidad->estado_solicitud_id = $solicitud->estado;
        $nuevaTrazabilidad->usuario_asignado_id = $this->obtenerEmpleadoPorRol($solicitud->estadoSolicitud->empleadoRol->id);
        $solicitud->empleado_id = $nuevaTrazabilidad->usuario_asignado_id;
        $solicitud->save();
        $nuevaTrazabilidad->save();
    }
}
