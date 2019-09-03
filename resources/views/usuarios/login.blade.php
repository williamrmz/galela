@extends('layouts.auth')

@section('content')

    <div class="login-box">
        <div class="login-logo">
            <b>GalenZ</b>
        </div>
        <!-- /.login-logo -->
        <div class="login-box-body">
            <p class="login-box-msg">Login</p>

            @include('partials.flash-message')
            @include('partials.validator-message')
            
            {{ Form::open([ 'action'=> ['UsuarioController@login'], 'method'=>'POST']) }}
            <div class="form-group has-feedback">
                {{ Form::text('usuario', null, ['class'=>'form-control']) }}
                <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
            </div>
            <div class="form-group has-feedback">
                {{ Form::password('clave', ['class'=>'form-control']) }}
                <span class="glyphicon glyphicon-lock form-control-feedback"></span>
            </div>

            <div class="checkbox">
                <label>
                    {{ Form::checkbox('recordarme', 1, false)}} Recordarme
                </label> 
            </div>

            <button type="submit" class="btn btn-primary btn-block btn-flat">INGRESAR</button>
            
            {{ Form::close() }}
        </div>
    <!-- /.login-box-body -->
    </div>

@endsection
