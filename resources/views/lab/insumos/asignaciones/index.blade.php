@extends('layouts.master')

@section('LA', 'active menu-open')
@section('LA.IN', 'active')

@section('breadcrumb')
<li><a href="#">Inicio</a></li>
<li><a href="#">Laboratorio</a></li>
<li><a href="{{ route('lab.insumos') }}">Insumos</a></li>
<li class="active">Asiganaciones</li>
@endsection

@section('content')

@include('partials.my-modal')

{{ Form::hidden('InsumoAsignacionController', route('lab.asignaciones.index') ) }}

<div class="row">
    <div class="col-sm-12">
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title"><i class="fa fa-w fa-calendar"></i> Insumos - Asignaciones</h3>
                <div class="box-tools pull-right">
                    <a href="{{ route('lab.asignaciones.create') }}" class="btn btn-primary btn-xs periodos-btn-create"> <i class="fa fa-plus"></i> Nueva</a>
                </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <div class="row">
                    <div class="col-sm-12" style="margin-bottom:10px;">
                        {{ Form::model(Request::all(), ['route' => ['lab.asignaciones.index'], 'method'=>'GET', 'id'=>'periodos-form-filtro', 'class'=> 'row']) }}
                            
                            <div class="col-sm-4 form-group">
                                <label>Rango Fecha</label>
                                <div class="input-group">
                                    <div class="input-group-addon">
                                        <i class="fa fa-clock-o"></i>
                                    </div>
                                    {{ Form::text('rangoFecha', null, ['class'=>'form-control input-sm', 'id'=> 'rangoFecha', 'autocomplete'=>'off']) }}
                                </div>
                                <!-- /.input group -->
                            </div>
                        
                            <div class="col-sm-3 form-group">
                                <label for="">Movimiento</label>
                                {{ Form::text('movNum', null, ['class'=>'form-control input-sm periodos-input-filtro']) }}
                            </div>

                            <div class="col-sm-3 form-group">
                                <label for="">Empleado</label>
                                {{ Form::text('empleado', null, ['class'=>'form-control input-sm periodos-input-filtro']) }}
                            </div>

                            <div class="col-sm-2">
                                <div style="margin-top:22px" class="pull-right">
                                    <button type="submit" class="btn btn-sm btn-default periodos-btn-buscar"> <i class="fa fa-search"></i></button>
                                    <a href="{{route('lab.asignaciones.index')}}" class="btn btn-sm btn-default periodos-btn-limpiar"> <i class="fa fa-refresh"></i></a>
                                </div>
                            </div>
                        {{ Form::close() }}
                    </div>

                    <div class="col-sm-12 items-tabla">
                        <div class="table-responsive">
                            <table class="table table-bordered table-condensed">
                                <tr align="center" style="font-weight:bold;" class="bg-gray-active color-palette">
                                    <td rowspan="2" style="vertical-align: middle">Fecha</td>
                                    <td rowspan="2" style="vertical-align: middle">Mov</td>
                                    <td rowspan="2" style="vertical-align: middle">Tipo</td>
                                    <td rowspan="2" style="vertical-align: middle">DNI</td>
                                    <td rowspan="2" style="vertical-align: middle">Empleado</td>
                                    <td colspan="3">Insumos</td>
                                </tr>

                                <tr align="center" style="font-weight:bold;" class="bg-gray-active color-palette">
                                    <td>Codigo</td>
                                    <td>Nombre</td>
                                    <td>Cantidad</td>
                                </tr>
                                @foreach ($entradas as $entrada)

                                    @php
                                        $rowOnce = true;
                                        $insumos = $entrada->Insumos;
                                        $rowspan = count($insumos);
                                    @endphp

                                    @foreach ($insumos as $insumo)
                                        <tr>
                                            @if ($rowOnce)
                                                <td rowspan="{{ $rowspan }}" align="center">{{ $entrada->Fecha }}</td>
                                                <td rowspan="{{ $rowspan }}" align="center">{{ $entrada->MovNumero }}</td>
                                                <td rowspan="{{ $rowspan }}" align="center">{{ $entrada->MovTipo }}</td>
                                                <td rowspan="{{ $rowspan }}" align="center">{{ $entrada->DNI }}</td>
                                                <td rowspan="{{ $rowspan }}">{{ $entrada->FullnameEmpleado }}</td>

                                                <td>{{ $insumo->Codigo }}</td>
                                                <td>{{ $insumo->Nombre }}</td>
                                                <td  align="center">{{ $insumo->Cantidad }}</td>
                                            @else
                                                <td>{{ $insumo->Codigo }}</td>
                                                <td>{{ $insumo->Nombre }}</td>
                                                <td  align="center">{{ $insumo->Cantidad }}</td>
                                            @endif
                                        </tr>     
                                        @php
                                            $rowOnce = false;
                                        @endphp
                                    @endforeach
                                
                                @endforeach
                                
                            </table>
                        </div>
                    </div>
                </div>
    
            </div>
        </div>
    </div>

</div>     
        
@endsection


@section('scripts')
    
    <script>
        $(function(){
            $('#rangoFecha').daterangepicker({ 
                timePicker: true, 
                timePicker24Hour: true,
                autoUpdateInput: false,
                timePickerIncrement: 1, 
                locale: {
                    format: 'DD/MM/YYYY HH:mm',
                    daysOfWeek: [ 'Do', 'Lu', 'Ma', 'Mi', 'Ju', 'Vi', 'Sa' ],
                    monthNames: [
                        'Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio',
                        'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'
                    ],
                    applyLabel: 'Aceptar',
                    cancelLabel: 'Cancelar',
                    fromLabel: 'Desde',
                    toLabel: 'Hasta',
                }
            });

            $('#rangoFecha').on('apply.daterangepicker', function(ev, picker) {
                rango = ''
                desde = picker.startDate.format('DD/MM/YYYY HH:mm');
                hasta = picker.endDate.format('DD/MM/YYYY HH:mm');
                rango = desde + ' - ' + hasta;
                $('#rangoFecha').val(rango);
            });

            $('#rangoFecha').on('cancel.daterangepicker', function(ev, picker) {
                $('#rangoFecha').val('');
            });
        });
    </script>
    {{-- <script src="{{ url('/template/pages/lab.asignaciones.js') }}"></script> --}}
@endsection

