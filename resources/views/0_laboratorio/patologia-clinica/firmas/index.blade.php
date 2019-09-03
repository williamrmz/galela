@extends('layouts.master')

@section('lab', 'active menu-open')
@section('lab.pat-clinica', 'active')

@section('breadcrumb')
<li><a href="#">Inicio</a></li>
<li><a href="#">Laboratorio</a></li>
<li><a href="{{ route('lab.patologia-clinica') }}">Patologia clinica</a></li>
<li class="active">Firmas</li>
@endsection

@section('content')
    {{ Form::hidden('firmas-path-ctrl', route('lab.firmas.index') ) }}

    @include('partials.my-modal')

    <div class="box box-primary">
        <div class="box-header with-border">
            <h3 class="box-title">Firmas de Empleados</h3>
        </div>

        <div class="box-body">
            <div class="row">
                <div class="col-sm-12" style="margin-bottom:10px">
                    {{Form::open(['route'=>['lab.firmas.index'], 'id'=>'firmas-form-buscar', 'class'=>'form-inline pull-right' ]) }}
                        <div class="form-group">
                            {{ Form::text('buscar', null, ['class'=>'form-control input-sm firmas-input-buscar'])}}
                        </div>
                        <button type="submit" class="btn btn-sm btn-default firmas-btn-buscar"><i class="fa fa-search"></i></button>
                        <a href="#" class="btn btn-sm btn-default firmas-btn-limpiar"><i class="fa fa-refresh"></i></a>
                    {{ Form::close() }}
                </div>
                <div class="col-sm-12 table-responsive firmas-tabla">
                    
                </div>
            </div>
        </div>
    </div>

@endsection


@section('scripts')
    <script src="{{ url('/template/pages/lab.firmas.js') }}"></script>
@endsection