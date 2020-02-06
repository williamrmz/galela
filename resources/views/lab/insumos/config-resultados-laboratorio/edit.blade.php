@extends('layouts.master')

@section('LA', 'active menu-open')
@section('LA.IN', 'active')

@section('breadcrumb')
<li><a href="#">Inicio</a></li>
<li><a href="#">Laboratorio</a></li>
<li><a href="{{ route('lab.insumos') }}">Insumos</a></li>
<li><a href="{{ route('lab.configuracion-resultados.index') }}">Resultados de laboratorio</a></li>
<li class="active">Configuracion</li>
@endsection

@section('content')

    @include('partials.flash-message')
    <input type="hidden" id="IdProducto" value="{{ $servicio->IdProducto }}">
    <div class="box box-primary">
        <div class="box-header with-border">
            <h3 class="box-title">Editar - Catalogo de servicios</h3>

            <div class="box-tools pull-right">
                <a href="javascript: $('#form-servicio').submit();" class="btn btn-sm btn-primary">Guardar</a>
            </div>
        </div>

        <div class="box-body">
            {{ Form::open(['action' => ['Lab\ConfigResultadoLaboratorioController@update', $servicio->IdProducto], 'method'=>'PUT', 'id'=>'form-servicio']) }}
            <div class="row">
                <div class="col-sm-8" style="margin-bottom:10px">
                    <label for="">Items <a href="#" class="badge bg-blue"> Nuevo</a> </label> 
                    <div class="table-responsive">
                        <table class="table table-condensed table-hover table-bordered">
                            <thead>
                                <tr>
                                    <td><b>#</b></td>
                                    <td><b>Grupo Items</b></td>
                                    <td><b>Items</b></td>
                                    <td title="Opciones si es combo"><b>Opciones</b></td>
                                    <td title="Valores de referencia"><b>Ref</b></td>
                                    <td title="Orden"><b><i class="fa fa-list-ol"></i></b></td>
                                    <td><b>Metodo</b></td>
                                    <td title="Numero"><b>N</b></td>
                                    <td title="Texto"><b><i class="fa fa-text-width"></i></b></td>
                                    <td title="Combo"><b><i class="fa fa-list"></i></b></td>
                                    <td title="Check"><b><i class="fa fa-check-square-o"></i></b></td>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($itemsCPT as $itemCPT)
                                <tr>
                                    <td>{{ $itemCPT->idProductoCpt }}</td>
                                    <td>{{ $itemCPT->labItemGrupo->Grupo }}</td>
                                    <td>{{ $itemCPT->labItem->Item }}</td>
                                    <td>{{ $itemCPT->ValoreSiEsCombo }}</td>
                                    <td>{{ $itemCPT->ValorReferencial }}</td>
                                    <td>{{ $itemCPT->ordenXresultado }}</td>
                                    <td>{{ $itemCPT->Metodo }}</td>
                                    <td>{{ Form::checkbox('SoloNumero', 1, $itemCPT->SoloNumero, ['disabled']) }}</td>
                                    <td>{{ Form::checkbox('SoloTexto', 1, $itemCPT->SoloTexto, ['disabled']) }}</td>
                                    <td>{{ Form::checkbox('SoloCombo', 1, $itemCPT->SoloCombo, ['disabled']) }}</td>
                                    <td>{{ Form::checkbox('SoloCheck', 1, $itemCPT->SoloCheck, ['disabled']) }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="col-sm-4" style="margin-bottom:10px">
                    <label for="">Insumos</label>
                    <div class="table-responsive">
                        <table class="table table-condensed table-hover table-bordered">
                            <thead>
                                <tr>
                                    <td><b>#</b></td>
                                    <td><b>Insumo</b></td>
                                    <td><b>Cantidad</b></td>
                                    <td><b>Unidad</b></td>
                                    <td>
                                        <a href="#" class="btn btn-xs btn-primary btn-modal-insumos"> <i class="fa fa-plus"></i></a>
                                    </td>
                                </tr>
                            </thead>
                            <tbody id="tbody-insumos">
                                
                            </tbody>
                        </table>
                    </div>
                </div>
           
            </div>
            {{ Form::close() }}
        </div>
    </div>

    <!-- MODAL SELCCIONAR INSUMOS -->
    <div class="modal fade" id="modal-insumos" style="display: none;">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span></button>
                    <h4 class="modal-title">Insumos</h4>
                </div>
                <div class="modal-body" id="modal-insumos-body">
                    
                </div>
            </div>
        </div>
    </div>

@endsection


@section('scripts')

    <script src="{{ url('/template/pages/config_resultado_laboratorio.js') }}" defer></script> 

@endsection

