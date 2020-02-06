@extends('layouts.master')

@section('LA', 'active menu-open')
@section('LA.OrdenesLaboratorio', 'active')

@section('breadcrumb')
<li><a href="#">Inicio</a></li>
<li><a href="#">Laboratorio</a></li>
<li><a href="{{ route('lab.patologia-clinica') }}">Patologia clinica</a></li>
<li><a href="{{ route('lab.periodos.index') }}">Periodo de indicadores</a></li>
<li class="active">Indicadores</li>
@endsection

@section('content')

{{ Form::hidden('periodos-path-ctrl', route('lab.periodos.index')) }}

@include('partials.my-modal')

<style>
    .cell-td {
        /* padding-left: 0px; padding-right: 0px; position:relative; width:20px; */
        /* padding-left: 0px; padding-right: 0px;  width:20px; */
        padding: 0px; width:20px;
    }

    .col-td {
        
    }

    .cell-input {
        /* border:0; width:100%; top:0px; position:absolute; height:100%; text-align: center; */
        border:0; width:100%; top:0px;  height:27px; text-align: center;
        background:#C4C4C4;
    }

</style>

<div class="row">
    <div class="col-sm-12">
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title"><i class="fa fa-w fa-calendar"></i> Periodo</h3>
                <div class="box-tools pull-right">
                    <span class="badge bg-yellow">{{ $periodo->periodoTxt() }}</span>
                </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <div class="row">
                    <div class="col-sm-12">
                        <table class="table table-bordered table-condensed">
                            @php
                                $cols = [];
                                foreach ($data as $row) { $cols = $row->dias; break; };
                            @endphp
                            <tr style="font-weight:bold; text-align: center; " class="bg-light-blue color-palette">
                                <td rowspan="2" style="vertical-align:middle;">INDICADORES</td>
                                <td colspan="{{ count($cols) }}">DIA</td>
                            </tr>
                            <tr style="text-align: center;" class="bg-light-blue disabled color-palette">
                                @foreach ($cols as $col)
                                    <td style="padding-left: 0px; padding-right: 0px;">{{ sprintf("%02d",$col->Dia) }}</td> 
                                @endforeach
                            </tr>
                            @foreach ($data as $row)
                            <tr>
                                @php
                                    $indicadorNombre = $row->indicador_nombre;
                                    $maxlen = 67;
                                    if( strlen($indicadorNombre) > $maxlen){
                                        $indicadorNombre = substr( $row->indicador_nombre, 0, $maxlen ).' ...';
                                    }
                                    
                                @endphp
                                <td title="{{ $row->indicador_nombre }}">{{ $indicadorNombre }}</td>
                                @foreach ($row->dias as $dia)
                                
                                <td class="cell-td" style="padding: 0px;">
                                    <input type="hidden" class="IdPeriodoDia" value="{{ $dia->IdPeriodoDia }}">
                                    <input type="text" value="{{$dia->Valor}}" class="cell-input write" readonly>
                                </td> 
                                @endforeach
                            </tr>
                            @endforeach   
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>     
        
@endsection


@section('scripts')
    <script src="{{ url('/template/pages/lab.periodos.show.js') }}"></script>
@endsection

