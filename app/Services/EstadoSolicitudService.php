<?php

namespace App\Services;

use Exception;
use App\Models\Empleado;
use App\Models\Solicitud;
use App\Models\EstadoSolicitud;
use Illuminate\Support\Facades\DB;
use App\Models\TrazabilidadSolicitud;

class EstadoSolicitudService
{
    public function continuar(Solicitud $solicitud, string $observaciones): bool
    {
        DB::beginTransaction();

        try {
            if ($this->validarRequisitosContinuar($solicitud)) {
                $solicitud->estado = $solicitud->estadoSolicitud->estadoSiguiente->id;
                $nuevaTrazabilidad = $this->generarTrazabilidad($solicitud, $observaciones);
                $nuevaTrazabilidad->usuario_asignado_id = $this->obtenerEmpleadoPorRol($solicitud->estadoSolicitud->estadoSiguiente->empleadoRol->id);
                $solicitud->empleado_id = $nuevaTrazabilidad->usuario_asignado_id;
                $nuevaTrazabilidad->save();
                $solicitud->save();
            } else {
                return false;
            }
            DB::commit();
            return true;
        } catch (Exception $e) {
            DB::rollBack();
            return false;
        }
    }

    public function rechazar(Solicitud $solicitud, string $observaciones): bool
    {
        DB::beginTransaction();

        try {
            $estadoAnterior = $solicitud->trazabilidad()->latest()->skip(1)->first();
            $usuarioAnterior = $estadoAnterior->usuarioAsignado;
            $solicitud->estado = $solicitud->estadoSolicitud->estadoAnterior->id;
            $solicitud->empleado_id = $usuarioAnterior->id;
            $nuevaTrazabilidad = $this->generarTrazabilidad($solicitud, $observaciones);
            $nuevaTrazabilidad->usuario_asignado_id = $usuarioAnterior->id;
            $nuevaTrazabilidad->save();
            $solicitud->save();
            DB::commit();
            return true;
        } catch (Exception $e) {
            DB::rollBack();
            return false;
        }
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

    public function generarTrazabilidad(Solicitud $solicitud, string $observaciones): TrazabilidadSolicitud
    {
        $trazabilidadActual = $solicitud->trazabilidad()->latest()->first();
        $nuevaTrazabilidad = new TrazabilidadSolicitud();
        $nuevaTrazabilidad->solicitud_id = $solicitud->id;
        $nuevaTrazabilidad->estado_solicitud_id = $solicitud->estado;
        $nuevaTrazabilidad->observaciones = $observaciones;
        $nuevaTrazabilidad->usuario_asignador_id = $trazabilidadActual->usuario_asignado_id;
        return $nuevaTrazabilidad;
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

    private function validarRequisitosContinuar(Solicitud $solicitud): bool
    {
        if ($solicitud->estado == 3 && ($solicitud->itemsMuestras->count() != $solicitud->itemsSolicitados->count())) {
            return false;
        }

        if ($solicitud->estado == 6 && !$solicitud->muestras->pluck('itemsMuestras')->pluck('documentosAnalisis')->count()) {
            return false;
        }

        if ($solicitud->estado == 9) {
            return false;
        }

        return true;
    }
}
