<?php

namespace App\Http\Controllers;

use App\Models\Solicitud;
use App\Models\TrazabilidadSolicitud;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Validation\ValidationException;

class SolicitudController extends Controller
{
    public function index(Request $request)
    {
        try {
            $request->validate([
                'CodigoSolicitud' => 'string|codigo_solicitud',
                'NoExpediente' => 'string|numero_expediente',
                'NoSoporte' => 'string|min:3|max:50',
                'FechaCreacion' => 'date_format:yyyy-mm-dd_yyyy-mm-dd',
                'NIT' => 'digits_between:3,12',
                'EstadoSolicitud' => 'exists:estado_solicitudes,id',
            ]);
        } catch (ValidationException $e) {
            return response()->json(['errors' => $e->errors()], 422);
        }

        $resultados = Solicitud::select('id', 'codigo', 'no_soporte', 'cliente_id', 'created_at')
            ->with('usuarioAsignado')
            ->with('estadoSolicitud')
            ->with('cliente')
            ->when($request->has('CodigoSolicitud'), function ($query) use ($request) {
                return $query->where('codigo', $request->input('CodigoSolicitud'));
            })
            ->when($request->has('NoExpediente'), function ($query) use ($request) {
                return $query->where('tipo_soporte_id', $request->input('NoExpediente'));
            })
            ->when($request->has('NoSoporte'), function ($query) use ($request) {
                return $query->where('no_soporte', $request->input('NoSoporte'));
            })
            ->when($request->has('UsuarioAsignacion'), function ($query) use ($request) {
                return $query->where('UsuarioAsignacion', $request->input('UsuarioAsignacion'));
            })
            ->when($request->has('FechaCreacion'), function ($query) use ($request) {
                $fechas = explode('-', $request->input('FechaCreacion'));
                $fechaInicio = \Carbon\Carbon::createFromFormat('d/m/Y', trim($fechas[0]));
                $fechaFin = \Carbon\Carbon::createFromFormat('d/m/Y', trim($fechas[1]));
                return $query->whereBetween('fecha_creacion', [$fechaInicio, $fechaFin]);
            })
            ->when($request->has('NIT'), function ($query) use ($request) {
                // Utiliza una subconsulta para obtener el NIT desde la tabla cliente
                $query->whereHas('cliente', function ($clienteQuery) use ($request) {
                    $clienteQuery->where('nit', $request->input('NIT'));
                });
            })
            ->when($request->has('EstadoSolicitud'), function ($query) use ($request) {
                return $query->where('estado', $request->input('EstadoSolicitud'));
            })
            ->get()
            ->map(function ($item) {
                $solicitudEstado = $item->estadoSolicitud;
                $nombreSolicitudEstado = $solicitudEstado ? $solicitudEstado->nombre : null;

                return [
                    'id' => $item->id,
                    'codigo' => $item->codigo,
                    'no_expediente' => $item->cliente->NoExpediente,
                    'nit' => $item->cliente->nit,
                    'no_soporte' => $item->no_soporte,
                    'usuario_asignado' => $item->usuarioAsignado[0]->name ?? '',
                    'estado_solicitud' => $nombreSolicitudEstado,
                    'fecha_creacion' => $item->created_at,
                ];
            });

        return response()->json(['data' => $resultados], 200);
    }


    public function store(Request $request)
    {
        try {
            // Validación de datos de entrada
            $validatedData = $request->validate([
                'tipo_soporte_id' => 'required|exists:tipo_soportes,id',
                'no_soporte' => 'required|string|max:50',
                'descripcion' => 'required|string|max:100',
                'cliente_id' => 'required|exists:clientes,usuario_id',
                'longitud' => 'string',
                'latitud' => 'string',
                'items' => 'required|array',
                'items.*.id' => 'required|integer',
            ]);
        } catch (ValidationException $e) {
            // En caso de validación fallida, se devuelve la respuesta con los errores
            return response()->json(['errors' => $e->errors()], 422);
        }

        try {
            // Generar el código
            $codigo = 'EX-' . now()->format('Ymd') . '-' . Str::random(5);
            // Agregar el código a los datos validados
            $validatedData['codigo'] = $codigo;
            // Creación de la solicitud
            $solicitud = Solicitud::create($validatedData);
            // Creación de los elementos de solicitud
            $items = collect($validatedData['items'])->pluck('id')->all();
            $solicitud->itemsSolicitados()->attach($items);
            return response()->json(['message' => 'Solicitud creada correctamente'], 201);
        } catch (\Exception $e) {
            return response()->json(['error' => 'No se pudo registrar el usuario'], 500);
        }
    }

    public function getDetalle($solicitud_id)
    {
        $solicitud = Solicitud::with([
            'cliente.usuario', // Relación con Cliente y su Usuario
            'estadoSolicitud',
            'usuarioAsignado',
            'usuarioAsignador',
            'muestras.items',
            'documentos',
            'tipoSoporte',
        ])->find($solicitud_id);

        // Formatear los datos necesarios
        $datos = [
            'codigo_solicitud' => $solicitud->codigo ?? '',
            'no_expediente' => $solicitud->cliente->usuario_id ?? '',
            'nit' => $solicitud->cliente->nit ?? '',
            'no_soporte' => $solicitud->no_soporte ?? '',
            'tipo_soporte' => $solicitud->tipoSoporte->nombre ?? '',
            'usuario_asignado' => $solicitud->usuarioAsignado[0]->name ?? '',
            'usuario_creación' => $solicitud->usuarioAsignador[0]->name ?? '',
            'estado_solicitud' => $solicitud->estadoSolicitud->nombre ?? '',
            'fecha_creación' => $solicitud->created_at ?? '',
            'muestras' => $solicitud->muestras->map(function ($muestra) {
                return [
                    'muestra_id' => $muestra->id ?? '',
                    'items' => $muestra->items->pluck('nombre') ?? '', // Asumiendo que 'nombre' es el campo que quieres obtener
                ];
            }),
            'documentos' => $solicitud->documentos->pluck('ruta') ?? '', // Asumiendo que 'ruta' es el campo que quieres obtener
            'descripción' => $solicitud->descripcion ?? '',
            'solicitante' => $solicitud->cliente->usuario->name ?? '',
            'telefono' => $solicitud->cliente->usuario->telefono ?? '',
            'email' => $solicitud->cliente->usuario->email ?? '',
        ];

        return response()->json(['data' => $datos], 200);
    }

    public function getTrazabilidad($solicitud_id)
    {
        $solicitud = Solicitud::with('estadoSolicitud')->find($solicitud_id);

        if (!$solicitud) {
            return response()->json(['error' => 'Solicitud no encontrada'], 404);
        }

        $trazabilidad = TrazabilidadSolicitud::with('estadoSolicitud')
            ->where('solicitud_id', $solicitud_id)
            ->orderBy('created_at', 'asc')
            ->get();

        $response = [
            'id' => $solicitud->id,
            'estado_actual' => $solicitud->estadoSolicitud->nombre,
            'tiempo_total' => $solicitud->created_at->longAbsoluteDiffForHumans(now()),
            'trazabilidad' => [],
        ];

        $trazabilidadCount = count($trazabilidad);
        for ($i = 0; $i < $trazabilidadCount; $i++) {
            $trazabilidadItem = $trazabilidad[$i];
            $nextTrazabilidad = ($i < $trazabilidadCount - 1) ? $trazabilidad[$i + 1] : null;

            $tiempo = ($nextTrazabilidad) ? $nextTrazabilidad->created_at : now();
            $tiempoDiferencia = Carbon::parse($trazabilidadItem->created_at)->longAbsoluteDiffForHumans($tiempo);

            $trazabilidadData = [
                'id' => $trazabilidadItem->id,
                'estado' => $trazabilidadItem->estadoSolicitud->nombre,
                'observaciones' => $trazabilidadItem->observaciones,
                'usuario_asignador' => $trazabilidadItem->usuarioAsignador->name ?? null,
                'usuario_asignado' => $trazabilidadItem->usuarioAsignado->name ?? null,
                'created_at' => $trazabilidadItem->created_at,
                'updated_at' => $trazabilidadItem->updated_at,
                'tiempo' => $tiempoDiferencia
            ];

            $response['trazabilidad'][] = $trazabilidadData;
        }

        return response()->json(['data' => $response], 200);
    }
}
