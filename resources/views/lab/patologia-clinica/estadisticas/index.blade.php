@extends('layouts.master')

@section('LA', 'active menu-open')
@section('LA.OrdenesLaboratorio', 'active')

@section('breadcrumb')
<li><a href="#">Inicio</a></li>
<li><a href="#">Laboratorio</a></li>
<li><a href="{{ route('lab.patologia-clinica') }}">Patologia clinica</a></li>
<li class="active">Estadistica puebas</li>
@endsection

@section('content')

@include('partials.validator-message')

<div class="row">
    <div class="col-sm-8 col-sm-offset-2">
        <div class="box box-primary">
            <div class="box-header with-border">
                <i class="fa fa-bar-chart"></i>
                <h3 class="box-title">Estadistica</h3>

                <div class="box-tools pull-right">
                    <a class="btn btn-sm btn-primary" href="javascript: $('#form-print').submit()">
                        <span class="fa fa-file-pdf-o" aria-hidden="true"></span> GENERAR
                    </a>
                </div>

            </div>
            <!-- /.box-header -->
            <div class="box-body">

                {{ Form::open(['route' => ['lab.estadisticas.print'], 'method'=>'GET', 'id'=>'form-print']) }}
                    <div class="row">

                        <div class="form-group col-sm-6">
                            {{ Form::label('desde') }}
                            {{ Form::date('desde', $desde, ['class'=>'form-control input-sm']) }}
                        </div>

                        <div class="form-group col-sm-6">
                            {{ Form::label('hasta') }}
                            {{ Form::date('hasta', $hasta, ['class'=>'form-control input-sm']) }}
                        </div>

                        <div class="form-group col-sm-6">
                            <label for="desde">Tarifas</label>
                            <div style="height: 300px; overflow-y: scroll;">
                                <table class="table table-striped">
                                    @foreach($tarifas as $tarifa)
                                    <tr><td>
                                        <div class="checkbox" style="margin:0px">
                                            <label><input type="checkbox" name="tarifas_id[]" value="{{ $tarifa->IdTipoFinanciamiento }}" >
                                                {{ $tarifa->Descripcion}}                               
                                            </label>
                                        </div>
                                    </td></tr>
                
                                    @endforeach
                                </table>
                            </div>
                        </div>

                        <div class="form-group col-sm-6">
                            <label for="desde">Areas</label>
                            <div style="height: 300px; overflow-y: scroll;">
                                <table class="table table-striped">
                                    @foreach($areas as $area)
                                    <tr><td>
                                        <div class="checkbox" style="margin:0px">
                                            <label><input type="checkbox" name="areas_id[]" value="{{ $area->idGrupo }}" >
                                                {{ $area->NombreGrupo }}                              
                                            </label>
                                        </div>
                                    </td></tr>
                
                                    @endforeach
                                </table>
                            </div>
                            
                        </div>

                    </div>
                {{ Form::close() }}
      
            </div>
            <!-- /.box-body -->
        </div>
        <!-- /.box -->
    </div>
</div>
@endsection

