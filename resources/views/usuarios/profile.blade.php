@extends('layouts.master')

@section('content')

<div class="row">
    <div class="col-sm-3">
        <div class="box box-primary">
            <div class="box-body box-profile">
                <img class="profile-user-img img-responsive img-circle" src="{{ $user->getFoto() }}" alt="User profile picture">

                <h3 class="profile-username text-center">{{ $user->Usuario }}</h3>

                <p class="text-muted text-center"> {{ $user->tipoEmpleado->Descripcion }}</p>

                <ul class="list-group list-group-unbordered">
                <li class="list-group-item">
                    <b>DNI</b> <a class="pull-right"> {{ $user->DNI }}</a>
                </li>
                <li class="list-group-item">
                    <b>Nombres</b> <a class="pull-right">{{ $user->Nombres }}</a>
                </li>
                <li class="list-group-item">
                    <b>Apellidos</b> <a class="pull-right">{{ $user->ApellidoPaterno.' '.$user->ApellidoMaterno }}</a>
                </li>
                </ul>

                <a href="#" class="btn btn-primary btn-block"><b>Follow</b></a>
            </div>
            <!-- /.box-body -->
        </div>
    </div>

    <div class="col-md-9">
        <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
            <li class="active"><a href="#roles" data-toggle="tab">Roles</a></li>
            <li><a href="#cargos" data-toggle="tab">Cargos</a></li>
            <li><a href="#lugares" data-toggle="tab">Lugar</a></li>
            </ul>
            <div class="tab-content">
            <div class="active tab-pane" id="roles">
                <table class="table">
                    <tbody>
                        @foreach ($user->roles as $rol)
                            <tr>
                                <td> {{ $rol->Nombre }}</td>
                            </tr> 
                        @endforeach
                    </tbody>
                </table>
            </div>
            <!-- /.tab-pane -->
            <div class="tab-pane" id="cargos">
                <table class="table">
                    <tbody>
                        @foreach ($user->cargos as $cargo)
                            <tr>
                                <td> {{ $cargo->Cargo }}</td>
                            </tr> 
                        @endforeach
                    </tbody>
                </table>
            </div>
            <!-- /.tab-pane -->

            <div class="tab-pane" id="lugares">
                lugares
            </div>
            <!-- /.tab-pane -->
            </div>
            <!-- /.tab-content -->
        </div>
        <!-- /.nav-tabs-custom -->
    </div>
</div>
@endsection
