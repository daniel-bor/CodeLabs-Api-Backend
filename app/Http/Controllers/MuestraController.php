<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\Muestra;
use App\Models\TipoMuestra;
use Illuminate\Support\Str;
use App\Models\UnidadMedida;
use Illuminate\Http\Request;
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
}
