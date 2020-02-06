@extends('layouts.master')

@section('LA', 'active menu-open')
@section('LA.IN', 'active')

@section('breadcrumb')
<li><a href="#">Inicio</a></li>
<li><a href="#">Laboratorio</a></li>
<li class="active">Insumos</li>
@endsection

@section('content')

<div class="row">

    <div class="col-lg-3 col-md-4 col-sm-6">
        <div class="small-box bg-yellow">
            <div class="inner">
                <h3>#<sup style="font-size: 20px"></sup></h3>
                <p>Consumos</p>
            </div>
            <div class="icon">
                <i class="fa fa-list"></i>
            </div>
            <a href="{{ route('lab.consumos.index')  }}" class="small-box-footer">Ver <i class="fa fa-arrow-circle-right"></i></a>
        </div>
    </div>

    <div class="col-lg-3 col-md-4 col-sm-6">
        <div class="small-box bg-green">
            <div class="inner">
                <h3>#<sup style="font-size: 20px"></sup></h3>
                <p>Asignaciones</p>
            </div>
            <div class="icon">
                <i class="fa fa-file-text-o"></i>
            </div>
            <a href="{{ route('lab.asignaciones.index')  }}" class="small-box-footer">Ver <i class="fa fa-arrow-circle-right"></i></a>
        </div>
    </div>


    <div class="col-lg-3 col-md-4 col-sm-6">
        <div class="small-box bg-primary">
            <div class="inner">
                <h3>#<sup style="font-size: 20px"></sup></h3>
                <p>Configuracion de insumos</p>
            </div>
            <div class="icon">
                <i class="fa fa-file-text-o"></i>
            </div>
            <a href="{{ route('lab.configuracion-resultados.index')  }}" class="small-box-footer">Ver <i class="fa fa-arrow-circle-right"></i></a>
        </div>
    </div>

</div>  
            
        
@endsection

