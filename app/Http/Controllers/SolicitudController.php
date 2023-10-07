<?php

namespace App\Http\Controllers;

use App\Models\Solicitud;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class SolicitudController extends Controller
{
    public function index()
    {
      // Iniciar la consulta con el modelo Solicitud
      $solicitudes = Solicitud::select('id','codigo', 'no_soporte','cliente_id','created_at')
      ->with('itemsSolicitados')
      ->with('usuarioasignado')
      ->with('estadoSolicitud')
      ->with('muestra')
      ->with('itemsSolicitados')
      ->with('documentosMuestra')
      ->with('cliente')->get();

      $resultados = $solicitudes->map(function ($item){
        $usuarioAsignado = $item->usuarioasignado->last(); // Obtener el primer usuario asignado
        $nombreUsuarioAsignado = $usuarioAsignado ? $usuarioAsignado->name : null;
        
        //estado de la solicitud
        $solicitudEstado = $item->estadoSolicitud; // Obtener el primer usuario asignado
        $nombresolicitudEstado = $solicitudEstado ? $solicitudEstado->nombre : null;
        return [
            'id' => $item->id,
            'codigo' => $item->codigo,
            'NoExpediente' => $item->Cliente->NoExpediente,
            'nit' => $item->cliente->nit,
            'no_soporte' => $item->no_soporte,
            'TipoExamen' => $item->itemsSolicitados,
            'UsuarioAsigando' => $nombreUsuarioAsignado,
            'estadoSolicitud' => $nombresolicitudEstado,
            'FechaCreacion' => $item->created_at,
            'CantidadMuestra' =>$item->muestra->count(),
            'CantidadItemMuestra' =>$item->itemsSolicitados->count(),
            'CantidadDocumento' =>$item->documentosMuestra->count(),
        ];
    });
        return response()->json(['data' => $solicitudes], 200);
    }

    public function buscarSolicitudes(Request $request)
    {
        // Obtener los valores de los parámetros de consulta
        $CodigoSolicitud = $request->query('CodigoSolicitud');
        $NoExpendiente = $request->query('NoExpediente');
        $NoSoporte = $request->query('NoSoporte');
        $UsuarioAsignacion = $request->query('UsuarioAsignacion');
        $FechaCreacion = $request->query('FechaCreacion');
        $NIT = $request->query('NIT');
        $EstadoSolicitud = $request->query('EstadoSolicitud');

        // Iniciar la consulta con el modelo Solicitud
        $query = Solicitud::select('id','codigo', 'no_soporte','cliente_id','created_at')
        ->with('itemsSolicitados')
        ->with('usuarioasignado')
        ->with('estadoSolicitud')
        ->with('muestra')
        ->with('itemsSolicitados')
        ->with('documentosMuestra')
        ->with('cliente');

        // Aplicar condiciones en función de las variables
        if (!empty($CodigoSolicitud)) {
            $query->where('codigo_solicitud', $CodigoSolicitud);
        }else{
            if (!empty($NoExpendiente)) {
                $query->where('tipo_soporte_id', $NoExpendiente);
            }
    
            if (!empty($NoSoporte)) {
                $query->where('no_soporte', $NoSoporte);
            }
    
            if (!empty($UsuarioAsignacion)) {
                $query->where('UsuarioAsignacion', $UsuarioAsignacion);
            }
    
            if (!empty($FechaCreacion)) {
                $query->where('fecha_creacion', $FechaCreacion);
            }
    
            if (!empty($NIT)) {
                $query->where('NIT', $NIT);
            }
    
            if (!empty($EstadoSolicitud)) {
                $query->where('EstadoSolicitud', $EstadoSolicitud);
            }
        }

        
       
        $resultados = $query->get()->map(function ($item){
            $usuarioAsignado = $item->usuarioasignado->last(); // Obtener el primer usuario asignado
            $nombreUsuarioAsignado = $usuarioAsignado ? $usuarioAsignado->name : null;
            
            //estado de la solicitud
            $solicitudEstado = $item->estadoSolicitud; // Obtener el primer usuario asignado
            $nombresolicitudEstado = $solicitudEstado ? $solicitudEstado->nombre : null;
            return [
                'id' => $item->id,
                'codigo' => $item->codigo,
                'NoExpediente' => $item->Cliente->NoExpediente,
                'nit' => $item->cliente->nit,
                'no_soporte' => $item->no_soporte,
                'TipoExamen' => $item->itemsSolicitados,
                'UsuarioAsigando' => $nombreUsuarioAsignado,
                'estadoSolicitud' => $nombresolicitudEstado,
                'FechaCreacion' => $item->created_at,
                'CantidadMuestra' =>$item->muestra->count(),
                'CantidadItemMuestra' =>$item->itemsSolicitados->count(),
                'CantidadDocumento' =>$item->documentosMuestra->count(),
            ];
        });

        // Puedes retornar los resultados como JSON u otra representación según tus necesidades
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
            'Codigo solicitud' => $solicitud->codigo??'',
            'No. expediente' => $solicitud->cliente->usuario_id??'',
            'NIT' => $solicitud->cliente->nit??'',
            'No. soporte' => $solicitud->no_soporte??'',
            'Tipo soporte' => $solicitud->tipoSoporte->nombre??'',
            'Usuario asignado' => $solicitud->usuarioAsignado[0]->name??'',
            'Usuario creación' => $solicitud->usuarioAsignador[0]->name??'',
            'Estado solicitud' => $solicitud->estadoSolicitud->nombre??'',
            'Fecha creación' => $solicitud->created_at??'',
            'Muestras' => $solicitud->muestras->map(function ($muestra) {
                return [
                    'ID Muestra' => $muestra->id??'',
                    'Items' => $muestra->items->pluck('nombre')??'', // Asumiendo que 'nombre' es el campo que quieres obtener
                ];
            }),
            'Documentos' => $solicitud->documentos->pluck('ruta')??'', // Asumiendo que 'ruta' es el campo que quieres obtener
            'Descripción' => $solicitud->descripcion??'',
            'Solicitante' => $solicitud->cliente->usuario->name??'',
            'Teléfono' => $solicitud->cliente->usuario->telefono??'',
            'Email' => $solicitud->cliente->usuario->email??'',
        ];

        return response()->json(['data' => $datos], 200);
    }
}
