@extends('layouts.master')

@section('content')

{{ Form::hidden('path-ctrl', route('seguridad.roles.index')) }}

@include('partials.my-modal')

<div class="row">
    <div class="col-sm-12">
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title"><i class="fa fa-w fa-user"></i> Crear Rol</h3>
                <div class="box-tools pull-right">
                    <a href="#" class="btn btn-default btn-xs"> <i class="fa fa-arrow-left"></i> Cancelar</a>
                    <a href="#" class="btn btn-primary btn-xs"> <i class="fa fa-save"></i> Guardar</a>
                </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                {{ Form::open(['route' => 'seguridad.roles.store', 'method'=>'POST' ]) }}
                <div class="row">
                    <div class="col-sm-12">
                        <div class="nav-tabs-custom">
                            <ul class="nav nav-tabs">
                                <li class="active"><a href="#tab_modulos" data-toggle="tab">Modulos</a></li>
                                <li><a href="#tab_permisos" data-toggle="tab">Permisos</a></li>
                                <li><a href="#tab_reportes" data-toggle="tab">Reportes</a></li>
                            </ul>
                            <div class="tab-content">
                                <div class="tab-pane active" id="tab_modulos">
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <div class="form-inline pull-right">
                                                <div class="form-group">
                                                    {{ Form::select('modulos', [], null, ['class'=>'form-control', 'id'=>'modulosId']) }}
                                                </div>
                                                <div class="form-group">
                                                    <div class="checkbox" style="margin-right:10px">
                                                        <label for="item-check-agregar">
                                                                {{ Form::checkbox('item-check-agregar', 1, null, ['id'=>'item-check-agregar']) }} Agregar
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <div class="checkbox" style="margin-right:10px">
                                                        <label for="item-check-modificar">
                                                                {{ Form::checkbox('item-check-modificar', 1, null, ['id'=>'item-check-modificar']) }} Modificar
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <div class="checkbox" style="margin-right:10px">
                                                        <label for="item-check-consultar">
                                                                {{ Form::checkbox('item-check-consultar', 1, null, ['id'=>'item-check-consultar']) }} Consultar
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <div class="checkbox" style="margin-right:10px">
                                                        <label for="item-check-eliminar">
                                                                {{ Form::checkbox('item-check-eliminar', 1, null, ['id'=>'item-check-eliminar']) }} Eliminar
                                                        </label>
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <a href="#" class="btn btn-xs btn-default btn-modulo-agregar"> AGREGAR</a>
                                                </div>
                                                
                                            </div>
                                        </div>
                                        <div class="col-sm-12" style="margin-top:10px">
                                            <table class="table table-condensed table-hover  tabla-modulos">
                                                <thead>
                                                    <tr align="center" class="bg-purple color-palette disabled">
                                                        <td>SubModulo</td>
                                                        <td>Modulo</td>
                                                        <td>Agregar</td>
                                                        <td>Modificar</td>
                                                        <td>Consultar</td>
                                                        <td>Eliminar</td>
                                                        <td width="30"></td>
                                                    </tr>
                                                </thead>
                                                <tbody class="tbody-modulos">
                                                    {{-- js --}}
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                                <!-- /.tab-pane -->
                                <div class="tab-pane" id="tab_permisos">
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <div class="form-inline pull-right">
                                                <div class="form-group">
                                                    {{ Form::select('items', [], null, ['class'=>'form-control']) }}
                                                </div>

                                                <div class="form-group">
                                                    <a href="#" class="btn btn-xs btn-default btn-permiso-agregar"> AGREGAR</a>
                                                </div>
                                                
                                            </div>
                                        </div>

                                        <div class="col-sm-12" style="margin-top:10px">
                                            <table class="table table-condensed table-hover">
                                                <thead>
                                                    <tr align="center" class="bg-purple color-palette disabled">
                                                        <td>Descripcion</td>
                                                        <td width="30"></td>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td>Facturacion - Autorizado a 'Cuenta Pagada'</td>
                                                        <td align="center">
                                                            <input type="hidden" value="1">
                                                            <a href="#" class='btn btn-xs btn-default btn-permiso-quitar'> <i class="text-red fa fa-close"></i></a> 
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                                <!-- /.tab-pane -->
                                <div class="tab-pane" id="tab_reportes">
                                    <div class="row">
                                            <div class="col-sm-12">
                                                <div class="row">
                                                    <div class="col-sm-6 form-group">
                                                        {{ Form::select('reportesId', [], null, ['class'=>'form-control', 'id'=> 'reportesId', 'style'=>'width:100%']) }}
                                                    </div>

                                                    <div class="col-sm-6 " >
                                                        <div class="form-inline" style="margin-top:8px">
                                                            <div class="form-group">
                                                                <a href="#" class="btn btn-xs btn-default btn-reporte-agregar-todos"> TODOS</a>
                                                            </div>
                                                            <div class="form-group">
                                                                <a href="#" class="btn btn-xs btn-default btn-reporte-agregar-ninguno"> NINGUNO</a>
                                                            </div>
                                                            <div class="form-group">
                                                                <a href="#" class="btn btn-xs btn-default btn-reporte-agregar"> AGREGAR</a>
                                                            </div>
                                                        </div>
                                                    </div>

                                                        
                                                </div>
            
                                            </div>
                                            <div class="col-sm-12" style="margin-top:10px">
                                                <table class="table table-condensed table-hover">
                                                    <thead>
                                                        <tr align="center" class="bg-purple color-palette disabled">
                                                            <td>Reporte</td>
                                                            <td>Modulo</td>
                                                            <td>Tiene Acceso</td>
                                                            <td width="30"></td>
                                                        </tr>
                                                    </thead>
                                                    <tbody class="tbody-reportes">
                                                        {{-- js --}}
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                </div>
                                <!-- /.tab-pane -->
                            </div>
                            <!-- /.tab-content -->
                            </div>
                    </div>
                </div>

                {{ Form::close() }}
    
            </div>
        </div>
    </div>

</div>     
        
@endsection


@section('scripts')
    <script src="{{ url('/template/pages/seguridad.roles.js') }}"></script>
@endsection

