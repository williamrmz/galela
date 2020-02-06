@extends('layouts.master')

@section('LA', 'active menu-open')
@section('LA.OrdenesLaboratorio', 'active')

@section('breadcrumb')
<li><a href="#">Inicio</a></li>
<li><a href="#">Laboratorio</a></li>
<li><a href="{{ route('lab.patologia-clinica') }}">Patologia clinica</a></li>
<li class="active">Periodo de indicadores</li>
@endsection

@section('content')

{{ Form::hidden('periodos-path-ctrl', route('lab.periodos.index')) }}

@include('partials.my-modal')

<div class="row">
    <div class="col-sm-12">
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title"><i class="fa fa-w fa-calendar"></i> Periodos de indicadores</h3>
                <div class="box-tools pull-right">
                    <a href="#" class="btn btn-primary btn-xs periodos-btn-create"> <i class="fa fa-plus"></i> Crear</a>
                </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <div class="row" >

                    <div class="col-sm-12" style="margin-bottom:10px;">
                        {{ Form::open(['route' => ['lab.periodos.index'], 'id'=>'periodos-form-filtro', 'class'=> 'form-inline pull-right']) }}
                            <div class="form-group">
                                {{ Form::text('filtro', null, ['class'=>'form-control input-sm periodos-input-filtro']) }}
                            </div>
                            <button type="submit" class="btn btn-sm btn-default periodos-btn-buscar"> <i class="fa fa-search"></i></button>
                            <a href="#" class="btn btn-sm btn-default periodos-btn-limpiar"> <i class="fa fa-refresh"></i></a>
                        {{ Form::close() }}
                    </div>

                    <div class="col-sm-12 periodos-tabla">
                    
                    </div>
                </div>
    
            </div>
        </div>
    </div>

</div>     
        
@endsection


@section('scripts')
    <script src="{{ url('/template/pages/lab.periodos.js') }}"></script>
@endsection

