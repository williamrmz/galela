@extends('layouts.master')

@section('lab', 'active menu-open')
@section('lab.pat-clinica', 'active')   

@section('breadcrumb')
<li><a href="#">Inicio</a></li>
<li><a href="#">Laboratorio</a></li>
<li><a href="{{ route('lab.patologia-clinica') }}">Patologia clinica</a></li>
<li><a href="{{ route('lab.ordenes.index') }}">Ordenes</a></li>
<li class="active">Crear</li>
@endsection

@section('content')

@include('partials.flash-message')

<div class="row">
    <div class="col-sm-8">
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">Datos de Cabecera</h3>
            </div>
    
            <div class="box-body">
                <div class="row">
                    <div class="col-sm-3 form-group">
                        {{Form::label('numMovimiento', 'N° Movimiento')}}
                        {{Form::text('numMovimiento', null, ['class'=>'form-control'])}}
                    </div>
                    <div class="col-sm-3 form-group">
                        {{Form::label('estado', 'Estado')}}
                        {{Form::text('estado', null, ['class'=>'form-control'])}}
                    </div>
                    <div class="col-sm-3 form-group">
                        {{Form::label('fechaRegistro', 'F.Registro')}}
                        {{Form::date('fechaRegistro', null, ['class'=>'form-control'])}}
                    </div>
                    <div class="col-sm-3 form-group">
                        {{Form::label('fechaRealizaCPT', 'F.Realiza CPT')}}
                        {{Form::date('fechaRealizaCPT', null, ['class'=>'form-control'])}}
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-3 form-group">
                        {{Form::label('cuenta', 'Cuenta')}}
                        {{Form::text('cuenta', null, ['class'=>'form-control'])}}
                    </div>
                    <div class="col-sm-6 form-group">
                        {{Form::label('datosDeCuenta', 'Datos de cuenta')}}
                        {{Form::text('datosDeCuenta', null, ['class'=>'form-control'])}}
                    </div>

                    <div class="col-sm-3 form-group">
                        {{Form::label('receta', 'Receta')}}
                        {{Form::text('receta', null, ['class'=>'form-control'])}}
                    </div>

                    <div class="col-sm-6 form-group">
                        {{Form::label('procedencia', 'Procedencia')}}
                        {{Form::text('procedencia', null, ['class'=>'form-control'])}}
                    </div>

                    <div class="col-sm-6 form-group">
                        {{Form::label('formaPago', 'formaPago')}}
                        {{Form::select('formaPago', [], null, ['class'=>'form-control'])}}
                    </div>

                    <div class="col-sm-6 form-group">
                        {{Form::label('plan', 'Fte.Finan/IAFA')}}
                        {{Form::text('plan', null, ['class'=>'form-control'])}}
                    </div>

                    <div class="col-sm-6 form-group">
                        <div class="checkbox">
                            <label>
                                <input type="checkbox"> IAFA no cubre
                            </label>
                        </div>
                    </div>

                    <div class="col-sm-12 form-group">
                        {{Form::label('responsable', 'Registra orden (*)')}}
                        {{Form::select('responsable', [], null, ['class'=>'form-control'])}}
                    </div>

                    <div class="col-sm-12 form-group">
                        {{Form::label('medico', 'Medico solicita (*)')}}
                        {{Form::select('medico', [], null, ['class'=>'form-control'])}}
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-sm-4">
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">Datos de paciente</h3>
            </div>
    
            <div class="box-body">
                <table class="table">
                    <tr>
                        <td>{{ Form::label('historia')}}</td>
                        <td>
                            {{ Form::text('historia', null, ['class'=>'form-control']) }}
                            {{ Form::text('historia', null, ['class'=>'form-control']) }}
                        </td>
                    </tr>
                    <tr>
                        <td>{{ Form::label('Apellido Paterno')}}</td>
                        <td>{{ Form::text('apellidoPaterno', null, ['class'=>'form-control']) }}</td>
                    </tr>
                    <tr>
                        <td>{{ Form::label('Apellido Materno')}}</td>
                        <td>{{ Form::text('apellidoMaterno', null, ['class'=>'form-control']) }}</td>
                    </tr>
                    <tr>
                        <td>{{ Form::label('Primer Nombre')}}</td>
                        <td>{{ Form::text('primerNombre', null, ['class'=>'form-control']) }}</td>
                    </tr>
                    <tr>
                        <td>{{ Form::label('Segundo Nombre')}}</td>
                        <td>{{ Form::text('segundoNombre', null, ['class'=>'form-control']) }}</td>
                    </tr>
                    <tr>
                        <td>{{ Form::label('Sexo')}}</td>
                        <td>{{ Form::select('sexo', [1=>'Masculino', 2=>'Femenino'], null, ['class'=>'form-control']) }}</td>
                    </tr>
                    <tr>
                        <td>{{ Form::label('F.Nacimiento')}}</td>
                        <td>{{ Form::text('fechaNacimiento', null, ['class'=>'form-control']) }}</td>
                    </tr>
                    <tr>
                        <td>{{ Form::label('edad')}}</td>
                        <td>{{ Form::text('Edad', null, ['class'=>'form-control']) }}</td>
                    </tr>
                </table>
            </div>
        </div>
    </div>

    <div class="col-sm-12">
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">Pruebas a realizar</h3>
            </div>
    
            <div class="box-body">
                
            </div>
        </div>
    </div>
</div>

    

@endsection