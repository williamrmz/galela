@extends('layouts.master')

@section('LA', 'active menu-open')
@section('LA.OrdenesLaboratorio', 'active')

@section('breadcrumb')
<li><a href="#">Inicio</a></li>
<li><a href="#">Laboratorio</a></li>
<li><a href="{{ route('lab.patologia-clinica') }}">Patologia clinica</a></li>
<li><a href="{{ route('lab.estadisticas.index') }}">Estadistica</a></li>
<li class="active">Reporte</li>
@endsection

@php
@endphp

@section('content')

    <section class="invoice" id="invoice">
        <style>
            body { 
                /* font-size: 11px;  */
            }
            tr {
                -webkit-print-color-adjust: exact; 
            }
    
            table {
                width: 100%;
                /* border: 1px solid black; */
            }
            table > tbody > tr > td {
                /* border: 1px solid black; */
            }
    
            .line-bottom { border-bottom: 1px solid #ddd; }
            .line-bottom2 { border-bottom: 1px solid #000; }
    
            .bg-danger{ color:red; }
            .bg-warning{ color:orange; }
            .bg-success{ color:green; }
    
        </style>

        @php
            CONST PATH_PARTIALS = 'lab.patologia-clinica.estadisticas.partials-print.';
        @endphp
    
        <div class="row">
            <div class="col-xs-12">
                <table >
                    <thead>
                        @include(PATH_PARTIALS.'header')
                    </thead>
                    <tbody>
                        <tr> <td> @include(PATH_PARTIALS.'tarifas') </td> </tr>
                        <tr> <td> @include(PATH_PARTIALS.'resumen') </td> </tr>
                    </tbody>
                </table>
            </div>
        </div>
    
        <!-- this row will not appear when printing -->
        <a href="#" style="position:fixed; bottom:10px; right:2px;  z-index:90; border-radius:50%;"
            class="no-print btn btn-lg btn-primary btn-print" title="imprimir"> <i class="fa fa-print"></i></a>
    
    </section>
    
    <script>
        $(function(){
            $(".btn-print").click(function (e) {
                e.preventDefault();
                window.print();
                $(this).blur()
            });
        });
    </script>

@endsection

