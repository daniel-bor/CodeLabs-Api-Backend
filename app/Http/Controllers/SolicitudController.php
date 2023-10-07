<?php

namespace App\Http\Controllers;

use App\Models\Solicitud;
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

            // Creación de la solicitud
            $solicitud = Solicitud::create($validatedData);

            // Creación de los elementos de solicitud
            $items = collect($validatedData['items'])->pluck('id')->all();

            $solicitud->itemsSolicitados()->attach($items);

            return response()->json(['message' => 'Solicitud creada correctamente'], 201);
        } catch (ValidationException $e) {
            // En caso de validación fallida, se devuelve la respuesta con los errores
            return response()->json(['errors' => $e->errors()], 422);
        }
    }
}
