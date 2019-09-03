@extends('layouts.auth')

@section('content')

    <div class="login-box">
        <div class="login-logo">
            <b>Galela</b>
        </div>
        <!-- /.login-logo -->
        <div class="login-box-body">
            <p class="login-box-msg">Login</p>

            @include('partials.validator-message')
            
            {{ Form::open([ 'route'=> ['login'], 'method'=>'POST']) }}
            
                <div class="form-group has-feedback">
                    {{ Form::text('username', null, ['class'=>'form-control', 'placeholder'=> 'usuario']) }}
                    <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                </div>

                <div class="form-group has-feedback">
                    {{ Form::password('password', ['class'=>'form-control', 'placeholder' => 'contraseña']) }}
                    <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                </div>

                <div class="checkbox">
                    <label>
                        {{ Form::checkbox('remember', 1, false)}} Recordarme
                    </label> 
                </div>

                <button type="submit" class="btn btn-primary btn-block btn-flat">INGRESAR</button>
            
            {{ Form::close() }}
        </div>
    <!-- /.login-box-body -->
    </div>

@endsection
