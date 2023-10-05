<?php

namespace App\Http\Controllers;

use App\Models\TipoExamen;
use Illuminate\Http\Request;

class ExamenController extends Controller
{
    public function index()
    {
        // Obtén todos los tipos de examen con sus items relacionados
        $examenesConItems = TipoExamen::with('items')->get();

        return response()->json(['data' => $examenesConItems], 200);
    }
}
