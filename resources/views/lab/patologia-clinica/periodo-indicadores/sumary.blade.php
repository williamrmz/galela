@extends('layouts.master')

@section('LA', 'active menu-open')
@section('LA.OrdenesLaboratorio', 'active')

@section('breadcrumb')
<li><a href="#">Inicio</a></li>
<li><a href="#">Laboratorio</a></li>
<li><a href="{{ route('lab.patologia-clinica') }}">Patologia clinica</a></li>
<li><a href="{{ route('lab.periodos.index') }}">Periodo de indicadores</a></li>
<li class="active">Resumen</li>
@endsection

@section('content')
    <section class="invoice">
        <div class="row invoice-content">
            <div class="col-xs-12">
                <table class="table table-condensed">
                    <thead>
                        <tr> <td colspan="5"><i class="fa fa-calendar"></i> INDICADOR DE CALIDAD</td></tr>
                        <tr> <td colspan="5"><b>Periodo: </b><?=$periodo->periodoTxt()?></td></tr>
                        <tr> <td colspan="5"><b>Area:</b> <?=$periodo->area->NombreGrupo?></td> </tr>
                        <tr> <td colspan="5"><b>Descripcion:</b> <?=$periodo->Descrip?></td> </tr>
                        <tr>
                            <th>GRUPO</th>
                            <th>INDICADOR</th>
                            <th>TOTAL</th>
                            <th>PROMEDIO</th>
                            <th>PORCENTAJE</th>
                        </tr>
                    </thead>
                    @foreach($grupos as $grupo)
                        @php $showGrupo = true; @endphp
                        @foreach($grupo->indicadores as $indicador)
                        <tr>
                            @if($showGrupo)
                            <td rowspan="{{ count($grupo->indicadores) }}" width="100">{{ $grupo->Nombre }}</td>
                            @endif
                            <td>{{ $indicador->NombreIndicador }}</td>
                            <td>{{ $indicador->Suma }}</td>
                            <td>{{ number_format($indicador->Promedio, 2, '.', '') }}</td>
                            <td>
                                @php
                                    if($indicador->Total> 0 ){
                                        $porcent = ($indicador->Suma/$indicador->Total)*100;
                                        echo number_format($porcent, 2, '.', '').'%';
                                    }else{
                                        echo '0';
                                    }
                                @endphp
                            </td>
                        </tr>
                        @php $showGrupo = false; @endphp
                        @endforeach
                        
                    @endforeach
                </table>
            </div>
        </div>

        
    </section>

    <!-- this row will not appear when printing -->
    <a href="#" style="position:fixed; bottom:10px; right:2px;  z-index:90; border-radius:50%;"
            class="no-print btn btn-lg btn-primary btn-print" title="Imprimir"> <i class="fa fa-print"></i></a>
   
@endsection

@section('scripts')

    <script>
        $(function(){
            $(".btn-print").click(function(e) {
                e.preventDefault();
                window.print();
                $(this).blur()
            });
        });
    </script>
    
    
@endsection

