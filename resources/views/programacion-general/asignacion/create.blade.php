@extends('layouts.master')

@section('KP', 'active menu-open')
@section('KP.Asignacion', 'active')

@section('breadcrumb')
    <li><a href='#'>Inicio</a></li>
    <li><a href='#'>Programacion General</a></li>
    <li class='active'>Asignación de roles</li>
@endsection

@section('content')


<div class="row">
    <div class="col-sm-12">
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">Registrar "asignación de roles para programación médica"</h3>
                <div class="box-tools pull-right">
                    <a href="{{ route('programacion-general.asignacion.index') }}" class="btn btn-primary btn-xs">
                        <i class="fa fa-backward"></i> &nbsp; Volver</a>
                </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <div class="row">
                        {{ Form::open(['route'=>['programacion-general.asignacion.store'], 'method'=>'POST']) }}
                            @include('programacion-general.asignacion.form')
                        {{ Form::close() }}
                </div>
            </div>
        </div>

    </div>
</div>

{{ Form::close() }}

@endsection

@push('scripts')
    <script>
        var url = '{{ route("programacion-general.asignacion.index") }}';
    </script>

    <script src="{{ asset('js/programacion-general/asignacion.js') }}"></script>
@endpush
