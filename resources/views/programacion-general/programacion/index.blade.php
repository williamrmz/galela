@extends('layouts.master')

@section('KP', 'active menu-open')
@section('KP.Programacion', 'active')

@section('breadcrumb')
    <li><a href='#'>Inicio</a></li>
    <li><a href='#'>Programacion General</a></li>
    <li class='active'>Programacion</li>
@endsection

@php
    $model = 'programacion';
@endphp

@section('content')

    @include('programacion-general.programacion.partials.item-form')

    <div class='row' id="listado-programacion">
        <div class='col-sm-12'>

            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title"><i class="fa fa-calendar text-yellow"></i> Programación general</h3>
                    <div class="box-tools pull-right">
                        <a href="#" class="btn btn-primary btn-xs" id="{{$model}}-btn-create"> <i
                                    class="fa fa-plus"></i> Crear</a>
                    </div>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <div class="row">
                        <div class="col-sm-3">
                            <h5>Buscar por médico</h5>

                            <div class="row">

                                {{-- Departamento --}}
                                <div class="col-sm-12 form-group">
                                    <div class="input-group" style="width:100%">
                                        <span class="input-group-addon" style="width:120px">Departamento</span>
                                        {{ Form::select('fcmbIdDepartamento', [], null, ['class'=>'form-control input-ss', 'style'=>'width:100%']) }}
                                    </div>
                                </div>

                                {{-- Especialidad --}}
                                <div class="col-sm-12 form-group">
                                    <div class="input-group" style="width:100%">
                                        <span class="input-group-addon" style="width:120px">Especialidad</span>
                                        {{ Form::select('fcmbIdEspecialidad', [], null, ['class'=>'form-control input-ss', 'style'=>'width:100%']) }}
                                    </div>
                                </div>

                                {{-- Médico --}}
                                <div class="col-sm-12 form-group">
                                    <div class="input-group" style="width:100%">
                                        <span class="input-group-addon" style="width:120px">Médico</span>
                                        {{ Form::select('fcmbIdMedico', [], null, ['class'=>'form-control input-ss', 'style'=>'width:100%']) }}
                                    </div>
                                </div>
                            </div>


                        </div>
                        <div class="col-sm-3">
                            <h5>Listado por día</h5>
                            <div class="listado-dia-programacion">
                                @include('programacion-general.programacion.partials.item-list')
                            </div>
                        </div>

                        <div class="col-sm-6">
                            <div class="row">
                                <div class="col-md-12">
                                    <h5>Programación mensual
                                        <div class="pull-right">
                                            <form class="form-inline">
                                                {!! Form::selectMes("cmbMes", date('m'))  !!}
                                                {{ Form::selectRange('cmbAnio', date('Y'), 2005, date('Y'), ['class'=>'form-control']) }}
                                            </form>
                                        </div>
                                    </h5>

                                    <div class="listado-mes-programacion">
                                        <div id="div-calendario">
                                            <table class="table table-condensed table-bordered">
                                                <thead class="bg-purple disabled">
                                                <tr align="center">
                                                    <td>Lu</td>
                                                    <td>Ma</td>
                                                    <td>Mi</td>
                                                    <td>Ju</td>
                                                    <td>Vi</td>
                                                    <td>Sa</td>
                                                    <td>Do</td>
                                                </tr>
                                                </thead>
                                                <tbody id="tbody-calendario">
                                                {{-- js --}}
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>

                                </div>
                            </div>


                        </div>
                    </div>

                </div>
            </div>

        </div>
    </div>
@endsection

@push('scripts')

    <script>
        var model = '{{ $model }}';
        var url = '{{ route("programacion-general.programacion.index") }}';
        var opcionBlanco = {id: '', text: '...'};
    </script>


    <script src="{{ asset('js/programacion-general/programacion.js') }}"></script>
@endpush
