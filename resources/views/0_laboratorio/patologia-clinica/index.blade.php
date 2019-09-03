@extends('layouts.master')

@section('lab', 'active menu-open')
@section('lab.pat-clinica', 'active')

@section('breadcrumb')
<li><a href="#">Inicio</a></li>
<li><a href="#">Laboratorio</a></li>
@endsection

@section('content')

<div class="row">

    <div class="col-lg-3 col-md-4 col-sm-6">
        <div class="small-box bg-green">
            <div class="inner">
                <h3>#<sup style="font-size: 20px"></sup></h3>
                <p>Ordenes</p>
            </div>
            <div class="icon">
                <i class="fa fa-file-text-o"></i>
            </div>
            <a href="{{ route('lab.ordenes.index')  }}" class="small-box-footer">Ver <i class="fa fa-arrow-circle-right"></i></a>
        </div>
    </div>

    <div class="col-lg-3 col-md-4 col-sm-6">
        <div class="small-box bg-yellow">
            <div class="inner">
                <h3>#<sup style="font-size: 20px"></sup></h3>
                <p>Items CPT</p>
            </div>
            <div class="icon">
                <i class="fa fa-list"></i>
            </div>
            <a href="{{ route('lab.items.index')  }}" class="small-box-footer">Ver <i class="fa fa-arrow-circle-right"></i></a>
        </div>
    </div>

    <div class="col-lg-3 col-md-4 col-sm-6">
        <div class="small-box bg-purple">
            <div class="inner">
                <h3>#<sup style="font-size: 20px"></sup></h3>
                <p>Firmas</p>
            </div>
            <div class="icon">
                <i class="fa fa-camera"></i>
            </div>
            <a href="{{ route('lab.firmas.index')  }}" class="small-box-footer">Firmas <i class="fa fa-arrow-circle-right"></i></a>
        </div>
    </div>

    <div class="col-lg-3 col-md-4 col-sm-6">
        <div class="small-box bg-aqua">
            <div class="inner">
                <h3>#<sup style="font-size: 20px"></sup></h3>
                <p>Indicadores (periodos)</p>
            </div>
            <div class="icon">
                <i class="fa fa-calendar"></i>
            </div>
            <a href="{{ route('lab.periodos.index')  }}" class="small-box-footer">Ver <i class="fa fa-arrow-circle-right"></i></a>
        </div>
    </div>

    <div class="col-lg-3 col-md-4 col-sm-6">
        <div class="small-box bg-red">
            <div class="inner">
                <h3>#<sup style="font-size: 20px"></sup></h3>
                <p>Reporte Estadistica</p>
            </div>
            <div class="icon">
                <i class="fa fa-file-pdf-o"></i>
            </div>
            <a href="{{ route('lab.estadisticas.index')  }}" class="small-box-footer">Ver <i class="fa fa-arrow-circle-right"></i></a>
        </div>
    </div>

    <div class="col-lg-3 col-md-4 col-sm-6">
        <div class="small-box bg-blue">
            <div class="inner">
                <h3>#<sup style="font-size: 20px"></sup></h3>
                <p>Config. Antibiograma</p>
            </div>
            <div class="icon">
                <i class="fa fa-eyedropper"></i>
                <i class="fa fa-bug"></i>
            </div>
            <a href="{{ route('lab.config-antibiograma.index')  }}" class="small-box-footer">Ver <i class="fa fa-arrow-circle-right"></i></a>
        </div>
    </div>

</div>  
            
        
@endsection

