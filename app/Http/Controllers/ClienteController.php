<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use App\Models\Solicitud;
use Illuminate\Http\Request;

class ClienteController extends Controller
{
    public function index()
    {
        // Obtener todos los clientes
        $clientes = Cliente::all();

        return response()->json(['data' => $clientes], 200);
    }

    public function show($cliente_id)
    {
        // Obtener un cliente específico por ID
        $cliente = Cliente::findOrFail($cliente_id);

        return response()->json(['data' => $cliente], 200);
    }

    public function listarSolicitudes($cliente_id)
    {
        // Obtener todas las solicitudes del cliente
        $solicitudes = Solicitud::with('itemsSolicitados')->where('cliente_id', $cliente_id)->get();

        return response()->json(['data' => $solicitudes], 200);
    }

    public function verSolicitud($cliente_id, $solicitud_id)
    {
        // Obtener una solicitud específica del cliente
        $solicitud = Solicitud::with('itemsSolicitados')->where('cliente_id', $cliente_id)->findOrFail($solicitud_id);

        return response()->json(['data' => $solicitud], 200);
    }
}
