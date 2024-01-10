<?php

namespace App\Http\Controllers;

use App\Models\Muestra;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class MuestraController extends Controller
{
    public function store(Request $request)
    {
        try {
            $request->validate([
                'tipo_muestra_id' => 'required',
                'tipo_recipiente_muestra_id' => 'required',
                'cantidad_unidades' => 'required',
                'unidad_medida_id' => 'required',
                'etiqueta' => 'required',
                'solicitud_id' => 'required',
                'dia_vencimiento' => 'required|datetime|after:today',
            ]);
        } catch (ValidationException $e) {
            return response()->json(['errors' => $e->errors()], 422);
        }

        try {
            $muestra = Muestra::create($request->all());

            return response()->json(['message' => 'Muestra creada con éxito', 'muestra' => $muestra], 201);
        } catch (Exception $e) {
            return response()->json(['errors' => $e->getMessage()], 422);
        }
    }
}
