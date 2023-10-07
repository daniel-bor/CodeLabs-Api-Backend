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
        // Obtener todos las solicitudes
        $solicitudes = Solicitud::with('itemsSolicitados')
            ->where('estado', 1)
            ->get();

        return response()->json(['data' => $solicitudes], 200);
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
