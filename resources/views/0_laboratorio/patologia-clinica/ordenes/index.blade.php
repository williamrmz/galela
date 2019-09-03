@extends('layouts.master')

@section('lab', 'active menu-open')
@section('lab.pat-clinica', 'active')

@section('breadcrumb')
<li><a href="#">Inicio</a></li>
<li><a href="#">Laboratorio</a></li>
<li><a href="{{ route('lab.patologia-clinica') }}">Patologia clinica</a></li>
<li class="active">Ordenes</li>
@endsection

@section('content')

    <div class="box box-primary">
        <div class="box-header with-border">
            <h3 class="box-title">Movimientos</h3>

            <div class="pull-right box-tools">
                <a href="{{ url('/laboratorio/patologia-clinica/create') }}" class="btn btn-sm btn-primary"> <i class="fa fa-plus"></i> Nueva</a>
            </div>
        </div>

        <div class="box-body">
            <div class="row">
                <div class="col-sm-12">
                    {{ Form::model(Request::all(), ['route'=>['lab.ordenes.index'], 'method'=>'GET', 'class'=>'form-inline pull-right']) }}
                        {{ Form::text('filtro', null, ['class'=>'form-control input-sm']) }}
                        <button type="submit" class="btn btn-sm btn-primary"> <i class="fa fa-search"></i></button>
                        <a href="{{ route('lab.ordenes.index') }}" class="btn btn-sm btn-default"> <i class="fa fa-refresh"></i></a>
                    {{ Form::close() }}
                </div>
                <div class="col-sm-12" style="margin-top: 10px">
                    <div class="table-responsive">
                        <table class="table table-hover table-condensed" style="margin-bottom:0">
                            <thead>
                                <tr align="center" style="font-weight:bold">
                                    <td>Mov</td>
                                    <td>Cuenta</td>
                                    <td>N° H.C</td>
                                    <td>Paciente</td>
                                    <td>Estado Orden</td>
                                    <td>F. Registro</td>
                                    <td>Ordena</td>
                                    <td>F. Nacimiento</td>
                                    <td>Sexo</td>
                                    <td colspan="2"></td>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($labOrdenes as $labOrden)
                                    @php
                                        $ordenEstado = $labOrden->estado;
                                        $ordenAnulada = $ordenEstado =='Anulado'? 1: 0;
                                        $ordenValidada = $labOrden->validado;

                                        $ordenEstadoBadge = "";
                                        if(strtoupper($ordenEstado) == strtoupper('Anulado')){
                                            $ordenEstadoBadge = "<span class='label label-danger'>$ordenEstado</span>";
                                        }else if(strtoupper($ordenEstado) == strtoupper('Atendido')){
                                            $ordenEstadoBadge = "<span class='label label-primary'>$ordenEstado</span>";
                                        }
                                    @endphp
                                    <tr>
                                        <td> {{ $labOrden->idMovimiento }}</td>
                                        <td> {{ $labOrden->cuenta }}</td>
                                        <td> {{ $labOrden->historia }}</td>
                                        <td> {{ $labOrden->paciente }}</td>
                                        <td align="center"> {!! $ordenEstadoBadge !!}</td>
                                        <td> {{ dateFormat($labOrden->fechaRegistro, 'd/m/Y H:i A') }}</td>
                                        <td> {{ $labOrden->ordena }}</td>
                                        <td> {{ dateFormat($labOrden->fechaNacimiento, 'd/m/Y') }}</td>
                                        <td> {{ $labOrden->sexo }}</td>

                                        <td width="33">
                                            <a href="{{ route('lab.ordenes.imprimir', ['idMovimiento'=>$labOrden->idOrden]) }}" target="_blank" 
                                                class="btn btn-xs 
                                                    <?= $ordenValidada? 'btn-warning': 'btn-default' ?> 
                                                    <?= $ordenAnulada? 'hide': 'show' ?> "> 
                                                <i class="fa fa-print"></i></a>
                                        </td>
                                        <td width="33">
                                            <a href="{{ route('lab.ordenes.detalle', ['idMovimiento'=>$labOrden->idMovimiento]) }}" 
                                                class="btn btn-xs btn-default
                                                    <?= $ordenAnulada? 'hide': 'show' ?> "> 
                                                <i class="fa fa-eye"></i></a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        {{ $labOrdenes->render() }}
                    </div>
                </div>
            </div>
                    
        </div>
    </div>
            
        
@endsection

