@extends('layouts.reportes')

@section('titulo', 'Reporte PDF')

@section('portada')

    @parent

@endsection

@section('contenido')
    <div style="color: #0152bd !important; border-bottom: 3px solid #0152bd;">
        <div class="" style="margin-top:5px;">
            <div class="">
                <p style="font-size:18px;text-align:right;">{{date ('d/m/Y h:i:s');}}</p>
                <br>
                <p style="font-size:18px;margin-top:-16px;">Paciente: <span>{{$solicitud->cliente->usuario->name}}</span></p>
                <br>
                <p style="font-size:18px;text-align:center; margin-top:-25px;">Telefono: <span>{{$solicitud->cliente->usuario->telefono}}</span></p>
            </div>
        </div>
        <div class="row" style="margin-top: 10px;">
            <div class="col-md-6">
                <p style="font-size:18px;margin-top:-16px;text-align:left;">Codigo Solicitud: <span>{{$solicitud->codigo}}</span></p>
                <br>
                <p style="font-size:18px;text-align:right; margin-top:-22px;margin-right:30px;">No. Expediente: <span>{{$solicitud->cliente->no_expediente}}</span></p>
            </div>
        </div>
    </div>
    <div class="row" style="margin-top:60px; color: #0152bd !important;">
        <div class="col-md-6">
            <p style="font-size:18px;text-align:left; margin-top:-25px;">Analisis Realizados</p>
        </div>
    </div>
    <div class="row" style="padding: 0 .8rem;">
        <div class="table-responsive">
            <table class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Item</th>
                        <th>Tipo Examen</th>
                        <th>Resultado</th>
                    </tr>
                </thead>
                <tbody>
                        @foreach ($documentosAnalisis as $resultado)
                        @php
                            $count = 1;
                        @endphp
                        <tr>
                            <td>
                                {{$count++}}
                            </td>
                            <td>
                                {{$resultado->itemMuestra->item->nombre}}
                            </td>
                            <td>
                                {{$resultado->itemMuestra->item->tipoExamen->nombre}}
                            </td>
                            <td>
                                {{$resultado->conclusion}}
                            </td>
                        </tr>
                        @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <div class="row" style="padding: 0 .8rem; margin-top:8rem; max-width: 90vw !important;">
        <p style="font-size:20px;text-align:left;color: #0152bd !important;margin-bottom:25px;">Observaciones Generales:</p>
        <p>
            {{$solicitud->documento->observaciones}}
        </p>
    </div>

@endsection
