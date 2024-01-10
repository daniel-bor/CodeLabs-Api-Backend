<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use App\Models\Solicitud;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

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

    public function getDataClientNit($nit)
    {
        $cliente = Cliente::where('nit', $nit)->first();
        if ($cliente) {
            $datosCliente = [
                'tax_name' => $cliente->tax_name,
                'nit' => $cliente->nit,
                'telefono' => $cliente->usuario->telefono,
                'correo' => $cliente->usuario->email
            ];
        } else {
            $api_key = env('API_KEY_EMP')??'';
            $company_id = env('API_ID_EMP')??'';
            $api_url = env('API_CERT_URL')??'';
            $response = Http::withHeaders([
                'X-Authorization' => $api_key,
                'Accept' => 'application/json',
            ])->get("$api_url/api/entity/$company_id/find/NIT/$nit");

            $data = json_decode($response->body(), true);
            $datosCliente = [
                'tax_name' => $data[0]['tax_name'] ?? '',
                'nit' => $data[0]['tax_code'] ?? '',
                'telefono' => '',
                'correo' => ''
            ];
            // return $data;
        }

        return response()->json($datosCliente);
    }

    //funcion para obtener el expediente por cliente_id
    public function getExpediente($cliente_id){
        $cliente = Cliente::findOrFail($cliente_id);

        $response = [
            'no_expediente' => $cliente->no_expediente,
            'nombre' => $cliente->usuario->name,
            'nit' => $cliente->nit,
            'tax_name' => $cliente->tax_name
        ];

        return response()->json($response, 200);
    }
}
