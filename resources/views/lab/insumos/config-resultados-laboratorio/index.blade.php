@extends('layouts.master')

@section('LA', 'active menu-open')
@section('LA.IN', 'active')

@section('breadcrumb')
<li><a href="#">Inicio</a></li>
<li><a href="#">Laboratorio</a></li>
<li><a href="{{ route('lab.insumos') }}">Insumos</a></li>
<li class="active">Configuracion</li>
@endsection




@section('content')

    {{ Form::hidden('path_ctrl', route('lab.configuracion-resultados.index') ) }}

    <div class="box box-primary">
        <div class="box-header with-border">
            <h3 class="box-title">Catalogo de servicios</h3>
        </div>

        <div class="box-body">
            <div class="row">
                <div class="col-sm-12" style="margin-bottom:10px">
                    {{ Form::model(Request::all(), ['route'=>['lab.configuracion-resultados.index'], 'method'=>'GET', 'id'=>'item-form-buscar']) }}
                    <div class="form-inline pull-right">
                        <div class="form-group">
                            {{-- {{ Form::label('nombre', 'Nombre')}} --}}
                            {{ Form::text('buscar', null, ['class'=>'form-control input-sm', 'placeholder'=>'codigo / nombre']) }}
                        </div>
                        
                        <button type="submit" class="btn btn-sm btn-default item-btn-buscar"> <i class="fa fa-search"></i></button>
                        <a href="#" class="btn btn-sm btn-default item-btn-limpiar"> <i class="fa fa-refresh"></i></a>
                    </div>
                    {{ Form::close() }}
                </div>
                <div class="col-sm-12">
                    <div class="items-tabla table-responsive">
                        {{-- js --}}
                    </div>
                </div>
            </div>
        </div>
    </div>

    
            
        
@endsection


@section('scripts-head')

    <script async src="{{ url('/template/pages/fact_config.resultados_lab.js') }}"></script>
 
@endsection

