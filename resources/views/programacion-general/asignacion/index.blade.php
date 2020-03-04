@extends('layouts.master')

@section('KP', 'active menu-open')
@section('KP.Asignacion', 'active')

@section('breadcrumb')
    <li><a href='#'>Inicio</a></li>
    <li><a href='#'>Programacion General</a></li>
    <li class='active'>Asignación de roles</li>
@endsection

@php
    $model = 'asignacion';
@endphp

@section('content')

    @include('programacion-general.turno.partials.item-form')

    <div class='row' id="listado-{{$model}}">
        <div class='col-sm-12'>

            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title"><i class="fa fa-clock-o"></i> Asginación de roles</h3>
                    <div class="box-tools pull-right">
                        <a href="{{ route('programacion-general.asignacion.create') }}" class="btn btn-primary btn-xs">
                            <i class="fa fa-plus"></i> Crear</a>
                    </div>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <div class="row">
                        <div class="col-sm-12">
                            <table class="table table-condensed table-bordered table-hover">
                                <thead>
                                <tr class="bg-purple disabled">
                                    <td>Profesional</td>
                                    <td>Cargo</td>
                                    <td>Departamento</td>
                                    <td>Servicio</td>
                                </tr>
                                </thead>

                                @if(count($items) > 0 )
                                    @foreach ($items as $item)
                                        {{-- grdPacientes.Bands(0).Columns("IdPaciente").Hidden = True
                                        grdPacientes.Bands(0).Columns("IdTipoNumeracion").Hidden = True --}}
                                        <tr>
                                            <td>{{ $item->CodigoPlanilla }}</td>
                                            <td>{{ $item->ApellidoPaterno }}</td>
                                            <td>{{ $item->ApellidoMaterno }}</td>
                                            <td>{{ $item->Nombres }}</td>
                                            <td>{{ $item->Especialidad }}</td>
                                            <td>{{ $item->Colegiatura }}</td>
                                            <td>
                                                <input type="hidden" value="{{ $item->IdMedico }}">
                                                <a href="#" class="btn btn-xs btn-default {{$model}}-btn-show" title="ver"> <i class="fa fa-fw fa-eye"></i></a>
                                                <a href="#" class="btn btn-xs btn-default {{$model}}-btn-edit" title="editar"> <i class="fa fa-fw fa-edit"></i></a>
                                                <a href="#" class="btn btn-xs btn-default {{$model}}-btn-delete" title="eliminar"> <i class="fa fa-fw fa-trash"></i></a>
                                            </td>
                                        </tr>
                                    @endforeach
                                @else
                                    <tr> <td colspan="12" class="text-center"> Sin resultados</td> </tr>
                                @endif
                            </table>
                        </div>
                    </div>

                </div>
            </div>

        </div>
    </div>

@endsection
