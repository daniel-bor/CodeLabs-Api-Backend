<?php

namespace App\Http\Controllers;

use App\Models\TipoSoporte;
use Illuminate\Http\Request;

class TipoSoporteController extends Controller
{
    public function index()
    {
        // Obtener todos los tipos de soporte
        $tiposSoporte = TipoSoporte::all();

        return response()->json(['data' => $tiposSoporte], 200);
    }
}
