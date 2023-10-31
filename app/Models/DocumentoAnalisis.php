<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DocumentoAnalisis extends Model
{
    use HasFactory;

    protected $table = 'documentos_analisis';
    protected $fillable = ['item_muestra_id', 'conclusion'];
    // Relación con la muestra a la que pertenece el documento
    public function muestra()
    {
        return $this->belongsTo(Muestra::class, 'muestra_id');
    }

    // Relación con el tipo de documento de análisis
    public function tipoDocumentoAnalisis()
    {
        return $this->belongsTo(TipoDocumentoAnalisis::class, 'tipo_documento_analisis_id');
    }

    // Relación con el item de muestra
    public function itemMuestra()
    {
        return $this->belongsTo(ItemsMuestra::class, 'item_muestra_id');
    }
}
