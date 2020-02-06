@extends('layouts.master')

@section('LA', 'active menu-open')
@section('LA.OrdenesLaboratorio', 'active')

@section('breadcrumb')
<li><a href="#">Inicio</a></li>
<li><a href="#">Laboratorio</a></li>
<li><a href="{{ route('lab.patologia-clinica') }}">Patologia clinica</a></li>
<li class="active">Config. Antibiograma</li>
@endsection

@section('content')

{{ Form::hidden('germenes-path-ctrl', route('lab.germenes.index')) }}
{{ Form::hidden('antibioticos-path-ctrl', route('lab.antibioticos.index')) }}

@include('partials.my-modal')

<div class="row">
    <div class="col-sm-6">
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title"><i class="fa fa-w fa-bug"></i> Germenes</h3>
                <div class="box-tools pull-right">
                    <a href="#" class="btn btn-primary btn-xs germenes-btn-create"> <i class="fa fa-plus"></i> Crear</a>
                </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <div class="row">

                    <div class="col-sm-12">
                        {{ Form::open(['route' => ['lab.germenes.index'], 'id'=>'germenes-form-filtro', 'class'=> 'form-inline pull-right']) }}
                            <div class="form-group">
                                {{ Form::text('filtro', null, ['class'=>'form-control input-sm germenes-input-filtro']) }}
                            </div>
                            <button type="submit" class="btn btn-sm btn-default germenes-btn-buscar"> <i class="fa fa-search"></i></button>
                            <a href="#" class="btn btn-sm btn-default germenes-btn-limpiar"> <i class="fa fa-refresh"></i></a>
                        {{ Form::close() }}
                    </div>

                    <div class="col-sm-12 germenes-tabla">
                    
                    </div>
                </div>
    
            </div>
        </div>
    </div>

    <div class="col-sm-6">
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title"><i class="fa fa-w fa-bug"></i> Antibioticos</h3>
                <div class="box-tools pull-right">
                    <a href="#" class="btn btn-primary btn-xs antibioticos-btn-create"> <i class="fa fa-plus"></i> Crear</a>
                </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <div class="row">

                    <div class="col-sm-12">
                        {{ Form::open(['route' => ['lab.antibioticos.index'], 'id'=>'antibioticos-form-filtro', 'class'=> 'form-inline pull-right']) }}
                            <div class="form-group">
                                {{ Form::text('filtro', null, ['class'=>'form-control input-sm antibioticos-input-filtro']) }}
                            </div>
                            <button type="submit" class="btn btn-sm btn-default antibioticos-btn-buscar"> <i class="fa fa-search"></i></button>
                            <a href="#" class="btn btn-sm btn-default antibioticos-btn-limpiar"> <i class="fa fa-refresh"></i></a>
                        {{ Form::close() }}
                    </div>

                    <div class="col-sm-12 antibioticos-tabla">
                    
                    </div>
                </div>
    
            </div>
        </div>
    </div>
</div>   
@endsection

@section('scripts')
    <script src="{{ url('/template/pages/lab.germenes.js') }}"></script>
    <script src="{{ url('/template/pages/lab.antibioticos.js') }}"></script>
@endsection

