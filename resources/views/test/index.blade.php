@extends('layouts.master')

@section('KX', 'active menu-open')
@section('KX.PacienteCE', 'active')

@section('breadcrumb')
    <li><a href='#'>Inicio</a></li>
    <li><a href='#'>Consulta externa</a></li>
    <li class='active'>Paciente</li>
@endsection

@php
    $model = 'paciente';
@endphp


@section('content')
    <div class="row">
        <h1>CONSULTA RENIEC</h1>
        {!! Storage::url('pacientes/'.$personaDatos['nro_documento'].".jpeg") !!}
        <img src="{{ asset('storage/pacientes/'.$personaDatos['nro_documento'].".jpeg") }}" alt="">
        {!! dd($personaDatos) !!}
        <h3>Foto</h3>
    </div>
@endsection