@extends('layouts.master')

@section('content')

{{ Form::hidden('path-ctrl', route('seguridad.roles.index')) }}

@include('partials.my-modal')

<div class="row">
    <div class="col-sm-12">
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title"><i class="fa fa-w fa-calendar"></i> Roles</h3>
                <div class="box-tools pull-right">
                    <a href="{{ route('seguridad.roles.create') }}" class="btn btn-primary btn-xs periodos-btn-create"> <i class="fa fa-plus"></i> Crear</a>
                </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <div class="row">

                    <div class="col-sm-12">
                        {{ Form::open(['route' => ['lab.periodos.index'], 'id'=>'periodos-form-filtro', 'class'=> 'form-inline pull-right']) }}
                            <div class="form-group">
                                {{ Form::text('filtro', null, ['class'=>'form-control input-sm periodos-input-filtro']) }}
                            </div>
                            <button type="submit" class="btn btn-sm btn-default periodos-btn-buscar"> <i class="fa fa-search"></i></button>
                            <a href="#" class="btn btn-sm btn-default periodos-btn-limpiar"> <i class="fa fa-refresh"></i></a>
                        {{ Form::close() }}
                    </div>

                    <div class="col-sm-12 periodos-tabla">
                        <table class="table table-condensed table-hover">
                            <thead>
                                <tr>
                                    <td>#</td>
                                    <td>Nombre</td>
                                    <td width="100"></td>
                                </tr>
                            </thead>
                           
                            @foreach ($roles as $rol)
                            <tr>
                                <td>{{ $rol->IdRol }}</td>
                                <td>{{ $rol->Nombre }}</td>
                                <td>
                                    <a href="{{ route('seguridad.roles.edit', $rol->IdRol) }}" class="btn btn-xs btn-default"> <i class="fa fa-fw fa-edit"></i></a>
                                    <a href="{{ route('seguridad.roles.show', $rol->IdRol) }}" class="btn btn-xs btn-default"> <i class="fa fa-fw fa-eye"></i></a>
                                    <a href="{{ route('seguridad.roles.show', $rol->IdRol) }}" class="btn btn-xs btn-default"> <i class="fa fa-fw fa-trash"></i></a>
                                </td>
                            </tr>
                            @endforeach
                        </table>
                    </div>
                </div>
    
            </div>
        </div>
    </div>

</div>     
        
@endsection


@section('scripts')
    <script src="{{ url('/template/pages/seguridad.roles.js') }}"></script>
@endsection

