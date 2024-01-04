<?php

namespace App\Http\Controllers;

use App\Models\Muestra;
use App\Models\Documento;
use App\Models\Solicitud;
use App\Models\ItemsMuestra;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Validation\Rule;
use App\Models\DocumentoAnalisis;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class ReportesController extends Controller
{
    public function createReportResultados(Request $request)
    {
        try {
            DB::beginTransaction();
            foreach ($request->resultados as $resultado) {
                $validator = Validator::make($resultado, [
                    'item_muestra_id' => 'required|exists:items_muestras,id',
                    'resultado' => 'required|string|max:130'
                ]);

                if ($validator->fails()) {
                    return response()->json(['errors' => $validator->errors()], 400);
                }

                // Encuentra un registro existente o crea uno nuevo en función de 'item_muestra_id'
                $documentoAnalisis =  DocumentoAnalisis::updateOrInsert(
                    ['item_muestra_id' => $resultado['item_muestra_id']],
                    ['conclusion' => $resultado['resultado']]
                );
            }
            DB::commit();
            $solicitud = ItemsMuestra::find($request->resultados[0]['item_muestra_id'])->muestra->solicitud;
            $documentosAnalisis = $solicitud->muestras->pluck('itemsMuestras')->flatten()->pluck('documentoAnalisis')->flatten();
            $pdf = PDF::loadView('reportes.resultados_solicitud', ['solicitud' => $solicitud, 'documentosAnalisis' => $documentosAnalisis])
                ->setPaper('a4')
                ->setOption(['margin-top', 5, 'margin-bottom', 5]);

            $filePath = 'public/pdfs/' . 'resultados_' . date('d_m_Y_H_i_s', strtotime(now())) . '.pdf';
            Storage::put($filePath, $pdf->output());

            DB::beginTransaction();
            Documento::updateOrInsert(
                ['solicitud_id' => $solicitud->id],
                ['observaciones' => $request->observaciones_generales ?? '', 'ruta' => $filePath]
            );
            DB::commit();
            // return response()->file(storage_path('app/' . $filePath));
            return $pdf->stream('Mi_reporte_' . date('d_m_Y_H_i_s', strtotime(now())) . '.pdf');
        } catch (ValidationException $e) {
            DB::rollBack();
            return response()->json(['errors' => $e->errors()], 422);
        }
    }

    public function getResultadosSolicitud($solicitud_id)
    {
        $solicitud = Solicitud::find($solicitud_id);
        if (!$solicitud) {
            return response()->json(['errors' => ['Solicitud no encontrada']], 404);
        }

        $rutaRelativa = $solicitud->documento->ruta;
        $rutaAbsoluta = Storage::url($rutaRelativa);

        return response()->json(['data' => ['url' => $rutaAbsoluta]], 200);
    }
}
