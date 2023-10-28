<?php

namespace App\Http\Controllers;

use Exception;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\Muestra;
use App\Models\TipoMuestra;
use Illuminate\Support\Str;
use App\Models\UnidadMedida;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class MuestraController extends Controller
{
    public function store(Request $request)
    {
        try {
            $request->validate([
                'tipo_muestra_id' => 'required|exists:tipo_muestras,id',
                'tipo_recipiente_id' => 'required|exists:tipo_recipientes,id',
                'cantidad_unidades' => 'required|numeric|min:1|max:4',
                'unidad_medida_id' => 'required|exists:unidad_medidas,id',
                'solicitud_id' => 'required|exists:solicitudes,id',
                'fecha_vencimiento' => 'required|date|after:today',
            ]);
        } catch (ValidationException $e) {
            return response()->json(['errors' => $e->errors()], 422);
        }

        try {
            $codigoMuestra = $this->generateMuestraCode($request->tipo_muestra_id);
            $request->merge(['codigo' => $codigoMuestra]);
            Muestra::create($request->all());

            return response()->json(['message' => 'Muestra creada con éxito'], 201);
        } catch (Exception $e) {
            return response()->json(['errors' => $e->getMessage()], 422);
        }
    }


    public function exportToPDF($muestra_id)
    {

        try {

            $muestra = Muestra::with(['tipoMuestra', 'tipoRecipiente', 'unidadMedida', 'estadoMuestra'])
                ->select('id', 'codigo', 'tipo_muestra_id', 'tipo_recipiente_id', 'cantidad_unidades', 'unidad_medida_id', 'fecha_vencimiento', 'created_at', 'estado')
                ->find($muestra_id);

            if (!$muestra) {
                return response()->json(['message' => 'Muestra no encontrada'], 404);
            }

            $data = [[
                'id' => $muestra->id,
                'codigo' => $muestra->codigo,
                'muestra' => $muestra->tipoMuestra->nombre,
                'recipiente' => $muestra->tipoRecipiente->nombre,
                'unidades' => $muestra->cantidad_unidades,
                'medida' => $muestra->unidadMedida->nombre,
                'vencimiento' => Carbon::parse($muestra->fecha_vencimiento)->format('d/m/Y'),
                'creacion' => Carbon::parse($muestra->created_at)->format('d/m/Y'),
                'estado' => $muestra->estadoMuestra->nombre
            ]];

            $pdf = App::make('dompdf.wrapper');
            $pdf->setPaper('landscape');
            $pdf->loadView('pdf', compact('data'));
            
            return $pdf->stream();
        } catch (Exception $e) {
            return response()->json(['errors' => $e->getMessage()], 422);
        }

    }

    public function getTiposMuestras()
    {
        try {
            $tiposMuestras = TipoMuestra::select('id', 'nombre')->get();

            return response()->json(['data' => $tiposMuestras], 200);
        } catch (Exception $e) {
            return response()->json(['errors' => $e->getMessage()], 500);
        }
    }

    public function getRecipientesTipoMuestra($tipo_muestra_id)
    {
        try {
            $tipoMuestra = TipoMuestra::find($tipo_muestra_id);
            $tipoRecipientes = $tipoMuestra->tiposRecipiente->pluck('nombre', 'id')->map(function ($nombre, $id) {
                return [
                    'id' => intval($id),
                    'nombre' => $nombre,
                ];
            })->values();
            return response()->json(['data' => $tipoRecipientes], 200);
        } catch (Exception $e) {
            return response()->json(['errors' => $e->getMessage()], 500);
        }
    }

    public function getUnidadesMedida()
    {
        try {
            $unidadesMedida = UnidadMedida::select('id', 'nombre')->get();

            return response()->json(['data' => $unidadesMedida], 200);
        } catch (Exception $e) {
            return response()->json(['errors' => $e->getMessage()], 500);
        }
    }

    public function asociarItems(Request $request)
    {
        $data = $request->json()->all();

        try {
            foreach ($data as $itemData) {
                $validator = Validator::make($itemData, [
                    'id' => 'required|exists:muestras,id',
                    'items' => 'required|array',
                    'items.*.id' => ['required', Rule::exists('items', 'id')->where('estado', 1)],
                ]);

                if ($validator->fails()) {
                    return response()->json(['message' => 'Error de validación', 'errors' => $validator->errors()], 400);
                }

                $muestra = Muestra::findOrFail($itemData['id']);
                $items = $itemData['items'];

                foreach ($items as $item) {
                    $muestra->items()->attach($item['id']);
                }
            }

            return response()->json(['message' => 'Relaciones establecidas con éxito'], 200);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Error interno del servidor', 'error' => $e->getMessage()], 500);
        }
    }

    //Metodo para Funcionalidad de ACCIONES:
    private function generateMuestraCode($tipo_muestra_id)
    {
        $tipoMuestra = TipoMuestra::find($tipo_muestra_id);
        $fechaSolicitud = now()->format('Ymd');
        $guid = Str::random(6);
        $codigoMuestra = substr($tipoMuestra->nombre, 0, 2) . '-' . $fechaSolicitud . '-' . $guid;
        return $codigoMuestra;
    }

    public function getDetalleById($muestra_id)
    {
        $muestra = Muestra::with([
            'solicitud.cliente.usuario', // Relación con Solicitud, Cliente y su Usuario
            'tipoRecipiente',
            'unidadMedida',
            'items',
        ])->find($muestra_id);
        // $solicitud = Solicitud::with([
        //     'cliente.usuario', // Relación con Cliente y su Usuario
        //     'estadoSolicitud',
        //     'usuarioAsignado',
        //     'usuarioAsignador',
        //     'muestras.items',
        //     'documentos',
        //     'tipoSoporte',
        // ])->find($solicitud_id);

        // Formatear los datos necesarios
        $datos = [
            'codigo_solicitud' => $muestra->solicitud->codigo ?? null,
            'estado_solicitud' => $muestra->solicitud->estadoSolicitud->nombre ?? null,
            'descripcion_solicitud' => $muestra->solicitud->descripcion ?? null,
            'fecha_creacion_solicitud' => $muestra->solicitud->created_at ?? null,
            'usuario_actual_solicitud' => $muestra->solicitud->usuarioAsignado[0]->name ?? null,
            'usuario_anterior_solicitud' => $muestra->solicitud->usuarioAsignador[0]->name ?? null,
            'cliente' => $muestra->solicitud->cliente->usuario->name ?? null,
            'no_expediente' => $muestra->solicitud->cliente->no_expediente ?? null,
            'email' => $muestra->solicitud->cliente->usuario->email ?? null,
            'no_soporte' => $muestra->solicitud->no_soporte ?? null,
            'tipo_soporte' => $muestra->solicitud->tipoSoporte->nombre ?? null,
            'codigo_muestra' => $muestra->codigo ?? null,
            'fecha_creacion_muestra' => $muestra->created_at ?? null,
            'fecha_vencimiento_muestra' => $muestra->fecha_vencimiento ?? null,
            'cantidad_unidades' => $muestra->cantidad_unidades ?? null,
            'tipo_recipiente' => $muestra->tipoRecipiente->nombre ?? null,
            'tipo_muestra' => $muestra->tipoMuestra->nombre ?? null,
            'unidad_medida' => $muestra->unidadMedida->nombre ?? null,
            'items_muestra' => $muestra->items->map(function ($item) {
                return [
                    'id' => $item->id ?? null,
                    'nombre' => $item->nombre ?? null,
                ];
            }),
        ];

        return response()->json(['data' => $datos], 200);
    }

    public function deleteById($muestra_id)
    {
        try {
            $muestra = Muestra::find($muestra_id);
            // Validar que la muestra existe en la tabla
            if (!$muestra) {
                return response()->json(['message' => 'La muestra no existe'], 404);
            }

            // Validar que la muestra no tenga items asociados
            if ($muestra->items->isNotEmpty()) {
                return response()->json(['message' => 'La muestra tiene items asociados y no puede ser eliminada'], 400);
            }

            // Realizar la eliminación lógica
            $muestra->delete();

            return response()->json(['message' => 'Muestra eliminada con éxito'], 200);
        } catch (Exception $e) {
            return response()->json(['errors' => $e->getMessage()], 500);
        }
    }
}
