@extends('layouts.master')
@section('sidebar', 'sidebar-collapse')

@section('LA', 'active menu-open')
@section('LA.IN', 'active')

@section('breadcrumb')
<li><a href="#">Inicio</a></li>
<li><a href="#">Laboratorio</a></li>
<li><a href="{{ route('lab.insumos') }}">Insumos</a></li>
<li class="active">Consumos</li>
@endsection

@section('content')

@include('partials.my-modal')

{{ Form::hidden('InsumoConsumoController', route('lab.consumos.index') ) }}

<div class="row">
    <div class="col-sm-12">
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title"><i class="fa fa-w fa-calendar"></i> Insumos - Consumos</h3>
                <div class="box-tools pull-right">
                    {{--  --}}
                </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <div class="row">
                    <div class="col-sm-12" style="margin-bottom:10px;">
                        {{ Form::model(Request::all(), ['route' => ['lab.consumos.index'], 'id'=>'consumo-form-filtro', 'class'=> 'row', 'method'=>'GET']) }}
                            
                            <div class="col-sm-5 form-group">
                                {{ Form::label('rangoFecha', 'Rango fecha') }}
                                <div class="input-group">
                                    <div class="input-group-addon">
                                        <i class="fa fa-calendar"></i>
                                    </div>
                                    {{ Form::text('rangoFecha', null, ['class'=>'form-control', 'id'=> 'rangoFecha', 'autocomplete'=>'off', 'placeholder'=>'desde - hasta']) }}
                                </div>
                                <!-- /.input group -->
                            </div>

                            <div class="col-sm-5 form-group">
                                    {{ Form::label('almacen', 'Almacen') }}
                                    <div class="input-group">
                                        <a href="#" class="input-group-addon btn-clear-select"> <i class="fa fa-close"></i></a>
                                        {{ Form::select('almacen', [], null, ['class'=>'form-control', 'style'=>"width: 100%;"]) }}
                                        
                                    </div>
                                </div>  
                            <div class="col-sm-2 form-group">
                                <div style="margin-top:22px" class="">
                                    <a href="#" class="btn btn-flat btn-default consumos-btn-limpiar"> LIMPIAR </a>
                                </div>
                            </div>
                        
                            <div class="col-sm-5 form-group">
                                {{ Form::label('insumo', 'Insumo') }}
                                <div class="input-group">
                                    <a href="#" class="input-group-addon btn-clear-select"> <i class="fa fa-close"></i></a>
                                    {{ Form::select('insumo', [], null, ['class'=>'form-control', 'style'=>"width: 100%;"]) }}
                                    
                                </div>
                            </div>

                            <div class="col-sm-5 form-group">
                                {{ Form::label('empleado', 'Empleado') }}
                                <div class="input-group">
                                    <a href="#" class="input-group-addon btn-clear-select"> <i class="fa fa-close"></i></a>
                                    {{ Form::select('empleado', [], null, ['class'=>'form-control', 'style'=>"width: 100%;"]) }}
                                </div>
                                
                            </div>

                            <div class="col-sm-2">
                                <div style="margin-top:22px" class="">
                                    <button type="submit" class="btn btn-flat btn-primary consumos-btn-buscar"> BUSCAR</button>
                                </div>
                            </div>
                        {{ Form::close() }}
                    </div>

                    <div class="col-sm-12 items-tabla">
                        
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

    <script src="{{ url('/template/pages/lab.consumos.js') }}"></script>
@endsection

