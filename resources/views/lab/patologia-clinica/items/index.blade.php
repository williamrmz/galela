@extends('layouts.master')

@section('LA', 'active menu-open')
@section('LA.OrdenesLaboratorio', 'active')

@section('breadcrumb')
<li><a href="#">Inicio</a></li>
<li><a href="#">Laboratorio</a></li>
<li><a href="{{ route('lab.patologia-clinica') }}">Patologia clinica</a></li>
<li class="active">Items CPT</li>
@endsection

@section('content')
    {{ Form::hidden('items-path-ctrl', route('lab.items.index') ) }}

    @include('partials.my-modal')

    <div class="box box-primary">
        <div class="box-header with-border">
            <h3 class="box-title">Items de pruebas</h3>

            <div class="box-tools pull-right">
                <a href="#" class="btn btn-xs btn-primary items-btn-create"> <i class="fa fa-plus"></i> Nuevo</a>
            </div>
        </div>

        <div class="box-body">
            <div class="row">
                <div class="col-sm-12" style="margin-bottom:10px">
                    {{ Form::open(['route'=>['lab.items.index'], 'id'=>'items-form-buscar', 'class'=>'form-inline pull-right' ]) }}
                        <div class="form-group">
                            {{ Form::text('buscar', null, ['class'=>'form-control input-sm items-input-buscar']) }}
                        </div>
                        <button type="submit" class="btn btn-sm btn-default firmas-btn-buscar"><i class="fa fa-search"></i></button>
                        <a href="#" class="btn btn-sm btn-default items-btn-limpiar"><i class="fa fa-refresh"></i></a>
                    {{ Form::close() }}
                </div>
                <div class="col-sm-12 table-responsive items-tabla">
                    
                </div>
            </div>
        </div>
    </div>

@endsection


@section('scripts')
    <script src="{{ url('/template/pages/lab.items.js') }}"></script>
@endsection