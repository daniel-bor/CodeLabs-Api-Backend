<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\Solicitud;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Models\EstadoSolicitud;
use App\Models\TrazabilidadSolicitud;
use App\Services\EstadoSolicitudService;
use Illuminate\Validation\ValidationException;

class SolicitudController extends Controller
{
    private EstadoSolicitudService $_estadoSolicitudService;

    public function __construct(EstadoSolicitudService $estadoSolicitudService)
    {
        $this->_estadoSolicitudService = $estadoSolicitudService;
    }

    public function index(Request $request)
    {
        try {
            $request->validate([
                'CodigoSolicitud' => 'string|codigo_solicitud',
                'NoExpediente' => 'string|numero_expediente',
                'NoSoporte' => 'string|min:3|max:50',
                'FechaCreacion' => 'regex:/\d{4}-\d{2}-\d{2}_\d{4}-\d{2}-\d{2}/',
                'NIT' => 'digits_between:3,12',
                'EstadoSolicitud' => 'exists:estado_solicitudes,id',
            ]);
        } catch (ValidationException $e) {
            return response()->json(['errors' => $e->errors()], 422);
        }

        $usuarioActualId = $request->user()->id; // Obtiene el usuario autenticado

        $resultados = Solicitud::select('id', 'codigo', 'no_soporte', 'estado', 'cliente_id', 'empleado_id', 'created_at')
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
                $fechas = explode('_', $request->input('FechaCreacion'));
                return $query->whereBetween('created_at', [$fechas[0], $fechas[1]]);
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
            ->where('empleado_id', $usuarioActualId)
            ->get()
            ->map(function ($item) {
                $solicitudEstado = $item->estadoSolicitud;
                $nombreSolicitudEstado = $solicitudEstado ? $solicitudEstado->nombre : null;

                return [
                    'id' => $item->id,
                    'codigo' => $item->codigo,
                    'no_expediente' => $item->cliente->no_expediente,
                    'nit' => $item->cliente->nit,
                    'no_soporte' => $item->no_soporte,
                    'estado_solicitud' => $nombreSolicitudEstado,
                    'fecha_creacion' => $item->created_at
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
                'cliente_id' => 'required|exists:clientes,id',
                'direccion' => 'required|string|max:100',
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
            $validatedData['estado'] = 1;
            // Creación de la solicitud
            $solicitud = Solicitud::create($validatedData);
            // Creación de los elementos de solicitud
            $items = collect($validatedData['items'])->pluck('id')->all();
            $solicitud->itemsSolicitados()->attach($items);
            // Creación de la trazabilidad
            $this->_estadoSolicitudService->crearTrazabilidad($solicitud);
            return response()->json(['message' => 'Solicitud creada correctamente'], 201);
        } catch (\Exception $e) {
            return response()->json(['errors' => ['message' => 'Error al registrar la solicitud', 'message' => $e->getMessage()]], 500);
        }
    }

    public function getDetalleById($solicitud_id)
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
            'codigo_solicitud' => $solicitud->codigo ?? null,
            'no_expediente' => $solicitud->cliente->no_expediente ?? null,
            'nit' => $solicitud->cliente->nit ?? null,
            'no_soporte' => $solicitud->no_soporte ?? null,
            'tipo_soporte' => $solicitud->tipoSoporte->nombre ?? null,
            'usuario_asignado' => $solicitud->usuarioAsignado[0]->name ?? null,
            'usuario_creación' => $solicitud->usuarioAsignador[0]->name ?? null,
            'estado_solicitud' => $solicitud->estadoSolicitud->nombre ?? null,
            'fecha_creación' => $solicitud->created_at ?? null,
            'muestras' => $solicitud->muestras->map(function ($muestra) {
                return [
                    'muestra_id' => $muestra->id ?? null,
                    'codigo' => $muestra->codigo ?? null,
                    'items' => $muestra->items->pluck('nombre') ?? null, // Asumiendo que 'nombre' es el campo que quieres obtener
                ];
            }),
            'documentos' => $solicitud->documentos->pluck('ruta') ?? null, // Asumiendo que 'ruta' es el campo que quieres obtener
            'descripción' => $solicitud->descripcion ?? null,
            'solicitante' => $solicitud->cliente->usuario->name ?? null,
            'telefono' => $solicitud->cliente->usuario->telefono ?? null,
            'email' => $solicitud->cliente->usuario->email ?? null,
        ];

        return response()->json(['data' => $datos], 200);
    }

    public function getTrazabilidad($solicitud_id)
    {
        $solicitud = Solicitud::with('estadoSolicitud')->find($solicitud_id);


        if (!$solicitud) {
            return response()->json(['errors' => ['message' => 'Solicitud no encontrada']], 404);
        }

        $trazabilidad = TrazabilidadSolicitud::with('estadoSolicitud')
            ->where('solicitud_id', $solicitud_id)
            ->orderBy('created_at', 'asc')
            ->get();

        $response = [
            'id' => $solicitud->id,
            'estado_actual' => $solicitud->estadoSolicitud->nombre,
            'empleado_actual' => $solicitud->empleadoAsignado->usuario->name ?? null,
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

    public function getMuestras($solicitud_id)
    {
        $solicitud = Solicitud::with('muestras')->find($solicitud_id);

        if (!$solicitud) {
            return response()->json(['message' => 'Solicitud no encontrada'], 404);
        }

        $response = [
            'id' => $solicitud->id,
            'codigo' => $solicitud->codigo,
            'cliente' => $solicitud->cliente->usuario->name,
            'no_expediente' => $solicitud->cliente->no_expediente,
            'fecha_creacion' => $solicitud->created_at,
            'estado_solicitud' => $solicitud->estadoSolicitud->nombre,
            'muestras' => [],
            'items_disponibles' => []
        ];

        $itemsDisponibles = $solicitud->itemsSolicitados()
            // ->whereDoesntHave('itemMuestra')
            ->get();

        $response['items_disponibles'] = $itemsDisponibles->map(function ($item) use ($solicitud_id) {
            return [
                'id' => $item->id,
                'nombre' => $item->nombre,
                'tipo_examen_id' => $item->tipoExamen->id,
                'tipo_examen' => $item->tipoExamen->nombre,
                'muestras_compatibles' => $item->tipoExamen->tipoMuestra->muestras->where('solicitud_id', $solicitud_id)->pluck('id')
            ];
        });

        // Procesar las muestras
        $response['muestras'] = $solicitud->muestras->map(function ($muestra) {
            return [
                'id' => $muestra->id,
                'codigo' => $muestra->codigo,
                'tipo_muestra' => $muestra->tipoMuestra->nombre,
                'tipo_recipiente' => $muestra->tipoRecipiente->nombre,
                'cantidad_unidades' => $muestra->cantidad_unidades,
                'unidad_medida' => $muestra->unidadMedida->nombre,
                'fecha_vencimiento' => $muestra->fecha_vencimiento,
                'fecha_creacion' => $muestra->created_at,
                'items' => $muestra->items->map(function ($item) use ($muestra) {
                    return [
                        'id' => $item->id,
                        'nombre' => $item->nombre,
                        'tipo_examen_id' => $item->tipoExamen->id,
                        'tipo_examen' => $item->tipoExamen->nombre,
                        'muestras_compatibles' => $item->tipoExamen->tipoMuestra->muestras->where('solicitud_id', $muestra->solicitud_id)->pluck('id')
                    ];
                }),
                'estado' => $muestra->estadoMuestra->nombre
            ];
        });
        return response()->json(['data' => $response], 200);
    }

    public function getItems($solicitud_id)
    {
        try {
            $solicitud = Solicitud::find($solicitud_id);
            if (!$solicitud) {
                return response()->json(['errors' => ['message' => 'Solicitud no encontrada']], 422);
            }
            $itemsSeleccionados = $solicitud->itemsSolicitados
                ->filter(function ($item) {
                    return $item->estado == 1;
                })
                ->pluck('nombre', 'id')->map(function ($nombre, $id) {
                    return [
                        'id' => intval($id),
                        'nombre' => $nombre,
                    ];
                })->values();

            return response()->json(['data' => $itemsSeleccionados], 200);
        } catch (Exception $e) {
            return response()->json(['errors' => ['message' => $e->getMessage()]], 500);
        }
    }

    public function deleteById($solicitud_id)
    {
        try {
            $solicitud = Solicitud::find($solicitud_id);
            if (!$solicitud) {
                return response()->json(['errors' => ['message' => 'Solicitud no encontrada']], 422);
            }
            // Validar que la muestra no tenga items asociados
            if ($solicitud->muestras->isNotEmpty()) {
                return response()->json(['message' => 'La solicitud tiene muestras asociadas y no puede ser eliminada'], 400);
            }
            $solicitud->delete();
            return response()->json(['message' => 'Solicitud eliminada correctamente'], 200);
        } catch (Exception $e) {
            return response()->json(['errors' => ['message' => $e->getMessage()]], 500);
        }
    }

    public function getEstados()
    {
        $estados = EstadoSolicitud::select('id', 'nombre')->where('estado', 1)->get();
        return response()->json(['data' => $estados], 200);
    }

    public function assignToRole(Request $request)
    {
        try {
            $request->validate([
                'solicitud_id' => 'required|exists:solicitudes,id',
                'accion' => 'required|string|in:SIGUIENTE,ANTERIOR',
                'observaciones' => 'max:100',
            ]);
        } catch (ValidationException $e) {
            return response()->json(['errors' => $e->errors()], 422);
        }

        $solicitud = Solicitud::find($request->input('solicitud_id'));

        if (!$solicitud || ($solicitud->empleado_id != $request->user()->id)) {
            return response()->json(['errors' => ['message' => 'Solicitud no asignada, revise los datos enviados']], 422);
        }

        try {
            $estadoTransaccion = false;
            switch ($request->input('accion')) {
                case 'SIGUIENTE':
                    $estadoTransaccion = $this->_estadoSolicitudService->continuar($solicitud, $request->input('observaciones') ?? "ASIGNADO POR ACCIÓN DE USUARIO");
                    break;
                case 'ANTERIOR':
                    $estadoTransaccion = $this->_estadoSolicitudService->rechazar($solicitud, $request->input('observaciones') ?? "RECHAZADO");
                    break;
                default:
                    return response()->json(['errors' => ['message' => 'Acción no permitida']], 422);
            }
            if (!$estadoTransaccion) {
                return response()->json(['errors' => ['message' => 'No se pudo realizar la acción']], 422);
            } else {
                return response()->json(['message' => 'Solicitud asignada correctamente'], 200);
            }
        } catch (Exception $e) {
            return response()->json(['errors' => ['message' => $e->getMessage()]], 500);
        }
    }
}
