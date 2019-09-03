
@extends('layouts.master')

@section('sidebar', 'sidebar-collapse')

@section('lab', 'active menu-open')
@section('lab.pat-clinica', 'active')

@section('breadcrumb')
<li><a href="#">Inicio</a></li>
<li><a href="#">Laboratorio</a></li>
<li><a href="{{ route('lab.patologia-clinica') }}">Patologia clinica</a></li>
<li><a href="{{ route('lab.ordenes.index') }}">Ordenes</a></li>
<li><a href="{{ route('lab.ordenes.detalle', ['idMovimiento'=>$movLab->IdMovimiento]) }}">Pruebas</a></li>
<li class="active">Resultados</li>
@endsection

@section('content')

@include('partials.flash-message')

<div class="modal fade" id="modal-preview">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">×</span></button>
                <h4 class="modal-title" id="modal-preview-title">Vista Previa
                    <a href="{{ route('lab.ordenes.imprimir', ['idOrden'=>$movLab->IdOrden]) }}"
                        target="_blank" class='btn btn-default btn-sm'><i class="fa fa-print"></i> PRINT</a>
                </h4>
            </div>
            <div class="modal-body" id="modal-preview-body">
                Modal body
            </div>
        </div>
    </div>
</div>

{{ Form::hidden('IdResponsable', $responsable->IdEmpleado, ['id'=>'IdEmpleado']) }}
{{ Form::hidden('IdUsuario', $user->id, ['id'=>'IdUsuario'] ) }}

{{ Form::open(['route' => ['lab.ordenes.resultados-update'], 'method'=> 'POST', 'id'=>'my-form']) }}
    {{ Form::hidden('idOrden', $movLab->IdOrden) }}
    {{ Form::hidden('idProductoCpt', $movCPT->idProductoCPT) }}

    <div class="row">
        <div class="col-sm-6">
            <div class="box box-warning">
                <div class="box-header with-border">
                    <h3 class="box-title"><i class="fa fa-bed"></i> Datos del paciente</h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <div class="row">
                        <div class="col-sm-12">
                            <table class="table table-striped table-condensed" style="margin-bottom:0px">
                                <tbody>
                                    <tr> <th >Paciente:</th><td>{{ $movLab->Paciente }}</td> </tr>
                                    <tr> <th >Historia:</th><td>{{ $movLab->historia() }}</td> </tr>
                                    <tr> <th >Sexo:</th><td>{{ $movLab->sexo->Descripcion }}</td> </tr>
                                    <tr> <th >Edad:</th><td>{{ $movLab->edad().' años' }}</td> </tr>
                                    <tr> <th >Medico ordena:</th><td>{{ $movLab->OrdenaPrueba }}</td> </tr>
                                </tbody>
                                
                            </table>
                        </div>
                    </div>
                </div>
                    <!-- /.box-body -->
            </div>
        </div>

        <div class="col-sm-6">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title"> <i class="fa fa-user"></i> Responsable</h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <div class="row">
                        <div class="col-sm-12">
                            <table class="table" style="margin-bottom:8px">
                                <tr> <th>Fecha Resultado:</th><td>
                                    <input type="date" name="fechaRegistro" value="{{ $itemsData->fechaResultados }}" class="form-control input-sm">
                                </td> </tr>
                                <tr> <th>Responsable:</th><td>
                                <input type="text" class="form-control input-sm" value="{{ $responsable->fullname() }}" readOnly>
                                </td> </tr>
                                <tr> <th>Validar:</th><td>{!! $itemsData->itemValidar->formValidar !!} </td></tr>
                                <tr> <th>Observaciones:</th><td>{!! $itemsData->itemObservacion->formObservacion !!} </td></tr>
                            </table>
                        </div>
                    </div>
                </div>
                    <!-- /.box-body -->
            </div>
        </div>

        <div class="col-sm-8">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Servicio - Resultados</h3>

                    <div class="box-tools pull-right">
                        <button type="submit" class="btn btn-sm btn-primary hidden"> GUARDAR</button>
                    </div>
                </div>
        
                <div class="box-body">
                    <table class="table table-condensed table-hover my-table">
                        <thead>
                            <tr align="center" style="font-weight:bold">
                                <td>ID</td>
                                <td>Grupo</td>
                                <td>Item</td>
                                <td>P</td>
                                <td>Numero</td>
                                <td>Texto</td>
                                <td>Combo</td>
                                <td>Check</td>
                                <td>Referencia</td>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($itemsData->items as $itemCPT)
                                <tr>
                                    <td>{!! $itemCPT->formItem !!}</td>
                                    <td>{{ $itemCPT->Grupo }}</td>
                                    <td>{{ $itemCPT->Item }}</td>
                                    <td>{!! $itemCPT->formPendiente !!}</td>
                                    <td>{!! $itemCPT->formNumero !!}</td>
                                    <td>{!! $itemCPT->formTexto !!}</td>
                                    <td>{!! $itemCPT->formCombo !!}</td>
                                    <td>{!! $itemCPT->formCheck !!}</td>
                                    <td>{!! $itemCPT->formOpciones !!}</td>
                                </tr>   
                            @endforeach
                            
                        </tbody>
                            
                    </table>
                    
                </div>
            </div>
        </div>

        <div class="col-sm-4">
            @include('laboratorio.patologia-clinica.ordenes.partials.insumos')
        </div>

    </div>
{{ Form::close()}}

<!-- Modal para seleccion de germenes -->
<div class="modal fade " id="modal-antibiograma" style="display: none;">
    <div class="modal-dialog modal-lg">
        <div class="modal-content" style="background-color: #ecf0f5; !important;">
            <div class="modal-header" style="border-bottom-color: #cccccc;">
                
                <div class="pull-right">
                    <a href="#" class="btn btn-xs btn-default btn-flat pull-left" data-dismiss="modal" >CANCELAR</a>
                    <a href="#" class="btn btn-xs btn-primary btn-flat btn-aceptar-antibiograma" style="margin-left:5px">ACEPTAR</a>
                </div>
                <h4 class="modal-title" id="modal-title">My Modal</h4>
            </div>
            <div class="modal-body">
    
            <div class="row">
                <div class="col-sm-6">
                    <div class="form-group">
                        <div class="input-group">
                            <label for="muestras" class="input-group-addon">Muestra</label>
                            <select id="muestras" class="form-control input-sm"></select>
                        </div>                       
                    </div>
                </div>
                <div class="col-sm-6 col-sm-offset-6">
                </div>
    
                <div class="col-sm-6">
                    <div class="box box-primary">
                        <div class="box-header with-border" >
                            <h3 class="box-title">Germenes</h3>
                            <div class="pull-right form-inline">
                                <input type="search" class="form-control input-sm germen-input-filtro">
                                <a href="" class="btn btn-sm btn-default germen-btn-buscar"> <i class="fa fa-search"></i></a>
                                <a href="" class="btn btn-sm btn-default germen-btn-limpiar"> <i class="fa fa-refresh"></i></a>
                            </div>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body no-padding" style="height: 400px; overflow-y: scroll;">
                            <div id="tabla-germenes">

                            </div>
                        </div>
                        <!-- /.box-body -->
                    </div>
                </div>
    
                <div class="col-sm-6">
                    <div class="nav-tabs-custom" style="margin-bottom:0">
                        <ul class="nav nav-tabs" id="tab-navs">
                            <li class="active"><a href="#tab_1" data-toggle="tab">Tab 1</a></li>
                            <li><a href="#tab_2" data-toggle="tab">Tab 2</a></li>
                            <li><a href="#tab_3" data-toggle="tab">Tab 3</a></li>
                        </ul>
                        <div class="tab-content" id="tab-contents" style="height: 410px; overflow-y: scroll;">
                            <div class="tab-pane active" id="tab_1">
                                <div class="input-group">
                                    <label class="input-group-addon">Cantidad</label>
                                    <input type="text" class="form-control input-sm">
                                </div>
                                
                            </div>
                            <!-- /.tab-pane -->
                            <div class="tab-pane" id="tab_2">
                                tab2
                            </div>
                            <!-- /.tab-pane -->
                            <div class="tab-pane" id="tab_3">
                                tab3
                            </div>
                            <!-- /.tab-pane -->
                        </div>
                        <!-- /.tab-content -->
                    </div>
                </div>  
            </div>
    
            </div>

        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
    
<!-- Modal para ver referencias de un item -->
<div class="modal fade " id="modal-ref" style="display: none;">
    <div class="modal-dialog">
    <div class="modal-content" >
        <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span></button>
        <h4 class="modal-title" id="modal-ref-title">Rerefencias</h4>
        </div>
        <div class="modal-body" id="modal-ref-body">
                                        
        </div>
        <div class="modal-footer">
            <div class="pull-right">
                <button type="button" class="btn btn-default btn-flat pull-left" data-dismiss="modal">CERRAR</button>
            </div>
        </div>
    </div>
    <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>

<!-- Modal para ingresar comentario -->
<div class="modal fade " id="modal-observaciones" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content" >
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span></button>
                <h4 class="modal-title" id="modal-ref-title">Observaciones</h4>
            </div>
            <div class="modal-body">
                <textarea  id="editor1" cols="30" rows="10"></textarea>                              
                
            </div>
            <div class="modal-footer">
                <div class="pull-right">
                    <a href="#" class="btn btn-sm btn-default" data-dismiss="modal">CANCELAR</button>
                    <a href="#" class='btn btn-sm btn-primary btn-aceptar-observaciones'>ACEPTAR</a>
                </div>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>

{{ Form::hidden('url_preview', route('lab.ordenes.previa', ['idOrden'=>$movLab->IdOrden])) }}

<a href="#"  style="position:fixed; bottom:10px; right:2px;  z-index:90; border-radius:50%;"
    class="no-print btn btn-primary btn-warning btn-preview" title="Vista previa"> <i class="fa fa-eye"></i></a>

    <a href="#"  style="position:fixed; bottom:10px; right:50px;  z-index:90; border-radius:50%;"
    class="no-print btn btn-primary btn-primary btn-save-form" title="Guardar cambios"> <i class="fa fa-save"></i></a>

@endsection

@section('scripts')

    <script>
        $(function() {
            $('[data-toggle="tooltip"]').tooltip();

            $(".btn-save-form").click( function (e) {
                e.preventDefault();
                $("#my-form").submit();
            })
            
        });
    </script>

    <script src="{{ url('/template/pages/lab.forms.js') }}"></script>
    <script src="{{ url('/template/pages/lab.antibiograma.js') }}"></script>

    
@endsection