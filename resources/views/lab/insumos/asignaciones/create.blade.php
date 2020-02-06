@extends('layouts.master')

@section('LA', 'active menu-open')
@section('LA.IN', 'active')

@section('breadcrumb')
<li><a href="#">Inicio</a></li>
<li><a href="#">Laboratorio</a></li>
<li><a href="{{ route('lab.insumos') }}">Insumos</a></li>
<li><a href="{{ route('lab.asignaciones.index') }}">Asignaciones</a></li>
<li class="active">Nuevo</li>
@endsection

@section('content')

<div class="modal fade" id="modal-responsables" style="display: none;">
    <div class="modal-dialog" id="modal-responsables-size">
        <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span></button>
            <h4 class="modal-title" id="modal-responsables-title">Title</h4>
        </div>
        <div class="modal-body" id="modal-responsables-body">
            <div class="row">
                <div class="col-sm-12">
                    {{ Form::open(['url' => '#', 'method'=>'GET', 'id'=>'responsable-form-buscar', 'class'=> 'form-inline pull-right']) }}
                        <div class="form-group">
                            {{ Form::text('buscar', null, ['class'=>'form-control input-sm', 'placeholder'=>'DNI / Nombre']) }}
                        </div>
                        <button type="submit" class="btn btn-sm btn-default responsable-btn-buscar"> <i class="fa fa-search"></i></button>
                        <a class="btn btn-sm btn-default responsable-btn-limpiar"> <i class="fa fa-refresh"></i></a>
                    {{ Form::close() }}
                </div>
                <div class="col-sm-12">
                    <div id="modal-responsables-results">

                    </div>
                </div>
            </div>
        </div>
        </div>
    </div>
</div>

@include('partials.flash-message')
@include('partials.validator-message')

{{ Form::hidden('InsumoAsignacionController', route('lab.asignaciones.index') ) }}

<div class="row">
    <div class="col-sm-12">
        <div class="info-box">
            <span class="info-box-icon bg-green"><i class="fa fa-user"></i></span>

            <div class="info-box-content">
                @php
                    $empleado = 'NO DATA';
                    $movNumero = 'NO DATA';
                    $fechaCreacion = 'NO DATA';
                    if($responsable){
                        $empleado = $responsable->Nombres.' '.$responsable->ApellidoPaterno.' '.$responsable->ApellidoMaterno;
                        $movNumero = $responsable->MovNumero;
                        $fechaCreacion = $responsable->fechaCreacion;
                    }
                    

                @endphp
                <table class="table table-striped table-condensed" style="margin-bottom:0">
                    <tr>
                        <td width="200"><b>RESPONSABLE:</b></td>
                        <td>{{ $empleado }}</td>
                    </tr>
                    <tr>
                        <td><b>NOTA INGRESO:</b></td>
                        <td>{{ $movNumero }}</td>
                    </tr>
                    <tr>
                        <td><b>FECHA:</b></td>
                        <td>{{ $fechaCreacion }}</td>
                    </tr>
                </table>
            </div>
            <!-- /.info-box-content -->
        </div>
    </div>
</div>

<div class="row">
    <div class="col-sm-12">
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title"><i class="fa fa-w fa-calendar"></i> Insumos - Asignaciones</h3>
                <div class="box-tools pull-right">
                    <a href="#" class="btn btn-primary btn-xs btn-enviar"> Enviar</a>
                </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                {{ Form::open(['route' => 'lab.asignaciones.store', 'method'=>'POST', 'id'=>'my-form' ]) }}
                    <div class="row">
                        <div class="col-sm-3 form group">
                            {{ Form::label('numDoc', 'Num. Documento (*)') }}
                            {{ Form::text('numDoc', $numDocumento, ['class' => 'form-control']) }}
                        </div>

                        <div class="col-sm-3 form group">
                            {{ Form::label('almacenId', 'Destino (*)') }}
                            {{ Form::select('almacenId', ['13'=>'RESPONSABLE', '12'=>'ALMACEN'], null, ['class' => 'form-control']) }}
                        </div>

                        <div class="col-sm-6 form group">
                            <div class="responsable-lab">
                                {{ Form::label('IdResponsable', 'Responsable (*)') }}

                                <div class="input-group">
                                    <a href="#" class="input-group-addon btn-clear-select"> <i class="fa fa-close"></i></a>
                                    {{ Form::select('IdResponsable', [], null, ['class'=>'form-control', 'style'=>"width: 100%;"]) }}
                                </div>
                            </div>
                        </div>


                        <div class="col-sm-12" style="margin-top:10px;">
                            {{ Form::label('productos', 'Productos (*)') }}

                            

                            <div class="table-responsive">
                                <table class="table table-hover table-condensed table-bordered">
                                    <thead>
                                        <tr style="font-weight: bold;" align="center" class="bg-gray">
                                            <td>Codigo</td>
                                            <td>Nombre</td>
                                            <td>Tipo</td>
                                            <td>Lote</td>
                                            <td>F.Vencimiento</td>
                                            <td>Saldo</td>
                                            <td>
                                                Consumo
                                                <div class="btn-group">
                                                    <a href="" class="btn btn-xs btn-calcular-consumo" title="Calcular consumo"> <i class="fa fa-calculator"></i></a>
                                                    <a href="" class="btn btn-xs btn-limpiar-consumo" title="Limpiar calculos"> <i class="fa fa-rotate-left"></i></a>
                                                </div>
                                                
                                            </td>
                                            <td>Enviar</td>
                                            <td>Precio</td>
                                            <td>Total</td>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($productos as $key =>  $producto)
                                        @php
                                            $codigo = trim($producto->Codigo);
                                            $fecha = dateFormat($producto->FechaVencimiento, 'd/m/Y');
                                            $saldo = number_format($producto->Saldo, 0, '.', '');
                                            $cantConsumida = $saldo;
                                            $cantEnviar = $saldo - $cantConsumida;
                                            $precio = number_format($producto->Precio, 3, '.', '');
                                            
                                            // $cantidad = $saldo;
                                            // $total = number_format( ($cantidad * $precio) , 3, '.', '');
                                            $cantidad = 0;
                                            $total = number_format( 0 , 3, '.', '');
                                        @endphp
                                            <tr align="center">
                                                <td>
                                                    <input type="hidden" name='productos[{{$key}}][model]' value="{{ json_encode($producto) }}" 
                                                         style="text-align:center; width:60px; border:0" readonly>

                                                    <input type="text" name="productos[{{$key}}][codigo]" value="{{$codigo}}" 
                                                        class="input-codigo" style="text-align:center; width:60px; border:0" readonly>
                                                </td>
                                                <td align="left">{{ $producto->Nombre }}</td>
                                                <td>{{ $producto->tipo }}</td>
                                                <td>{{ $producto->Lote }}</td>
                                                <td>{{ $fecha }}</td>
                                                
                                                <td>
                                                    <input type="text" name="productos[{{$key}}][saldo]" value="{{$saldo}}" 
                                                        class="input-saldo" style="text-align:center; width:60px; border:0" readonly>
                                                </td>
                                                <td>
                                                    <input type="text" name="productos[{{$key}}][cantConsumida]" value="{{$cantConsumida}}" placeholder="0" 
                                                        class="input-cant-consumida" style="text-align:center; width:60px; border:0" readonly>
                                                </td>
                                                <td>
                                                    <input type="text" name="productos[{{$key}}][cantEnviar]" value="{{$cantEnviar}}" placeholder="0" 
                                                        class="input-cant-enviar integer" style="text-align:center; width:60px;">
                                                </td>

                                                <td>
                                                    <input type="text" name="productos[{{$key}}][precio]" value="{{$precio}}" 
                                                        class="input-precio" style="text-align:center; width:60px; border:0" readonly>
                                                </td>
                                                <td>
                                                    <input type="text" name="productos[{{$key}}][total]" value="{{$total}}" 
                                                        class="input-total" style="text-align:center; width:60px; border:0" readonly>
                                                </td>
                                            </tr>   
                                        @endforeach
                                    </tbody>
                                    
                                </table>
                            </div>
                        </div>
                        
                    </div>
                {{ Form::close() }}
            </div>
        </div>
    </div>

</div>     
        

@include('partials.my-modal', ['id'=>'modalConsumos'])

@endsection


@section('scripts')
    <script src="{{ url('/template/plugins/numeric/jquery.numeric.min.js') }}"></script>
    <script src="{{ url('/template/pages/lab.asignaciones.create.js') }}"></script>
@endsection

