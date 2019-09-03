@extends('layouts.master')

@section('lab', 'active menu-open')
@section('lab.pat-clinica', 'active')   

@section('breadcrumb')
<li><a href="#">Inicio</a></li>
<li><a href="#">Laboratorio</a></li>
<li><a href="{{ route('lab.patologia-clinica') }}">Patologia clinica</a></li>
<li><a href="{{ route('lab.ordenes.index') }}">Ordenes</a></li>
<li class="active">Pruebas</li>
@endsection

@section('content')

@include('partials.flash-message')

<div class="row">
    <div class="col-sm-4">
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">Paciente</h3>
            </div>
    
            <div class="box-body">
                <table class="table table-bordered table-hover table-condensed" style="margin-bottom:0">
                    <tr><td>PACIENTE</td><td>{{ $movLab->Paciente }}</td></tr>
                    <tr><td>HISTORIA</td><td>{{ $movLab->historia() }}</td></tr>   
                    <tr><td>SEXO</td><td>{{ $movLab->sexo->Descripcion }}</td></tr>   
                    <tr><td>F.NACIMIENTO</td><td>{{ dateFormat($movLab->FechaNacimiento, 'd/m/Y') }}</td></tr>   
                    <tr><td>MEDICO ORDENA</td><td>{{ $movLab->OrdenaPrueba }}</td></tr>   
                </table>
            </div>
        </div>
    </div>

    <div class="col-sm-8">
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">Servicios</h3>
            </div>
    
            <div class="box-body">
                <table class="table table-bordered table-hover table-condensed" style="margin-bottom:0">
                    <thead>
                        <tr>
                            <td>N°</td>
                            <td>Grupo</td>
                            <td>C.Prueba</td>
                            <td>Nombre de Prueba</td>
                            <td>Cantidad</td>
                            <td>Precio</td>
                            <td>Total</td>
                            <td>Resutado</td>
                            <td></td>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $puedeEditar = \Auth::user()->tieneAccion('MODIFICAR', 'ANAT. PATOLOGICA');
                            // dd($puedeEditar);
                        @endphp
                        @foreach ($movLab->movsCPT as $key => $movCPT)

                            @php
                                $estado = pruebaValidada($movCPT->idMovimiento, $movCPT->idProductoCPT);
                                $estadoIcon = $estado? 'text-green fa fa-check': 'text-red fa fa-close';
                            

                                $grupoExamen = 'Uknown';
                                try {
                                    $grupoExamen = $movCPT->servicio->grupoExamen->NombreGrupo;
                                } catch (Exception $e) { }
                                
                            @endphp
                            <tr>
                                <td> {{$key+1}} </td>
                                <td> {{$grupoExamen}}</td>
                                <td> {{$movCPT->servicio->Codigo}} </td>
                                <td> {{$movCPT->servicio->Nombre}} </td>
                                <td> {{$movCPT->cantidad}} </td>
                                <td> {{$movCPT->precio}} </td>
                                <td> {{$movCPT->cantidad*$movCPT->precio}} </td>
                                <td> <span class="{{$estadoIcon}}"></span></td>
                                <td>
                                    <a href="{{ route('lab.ordenes.resultados', ['idMovimiento'=> $movLab->IdMovimiento, 'idProducto'=>$movCPT->idProductoCPT ]) }}" 
                                    class="btn btn-xs btn-default {{ !$puedeEditar?'disabled':'' }}"><i class="fa fa-edit"></i></a>
                                </td>
                            </tr>   
                        @endforeach
                        
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

    

@endsection