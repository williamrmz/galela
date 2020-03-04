<div class="row" id="form-citas-admision" style="display: none">
    <div class="col-sm-12">

        <div class="nav-tabs-custom">
            <div class="tab-content">
                <div class="row">
                    {{-- BUSQUEDA PACIENTE--}}
                    <div class="col-sm-8">
                        {{-- BLOQUE INICIO: BUSQUEDA--}}
                        <div id="paciente-form-buscar">
                            <fieldset class="scheduler-border">
                                <legend class="scheduler-border">Búsqueda: Paciente</legend>
                                <div class="row">
                                    <div class="col-sm-12">


                                        {{ Form::open(['route' => ['consulta-externa.paciente.index'],'id'=>"paciente-form-search", 'method'=>'GET']) }}

                                        <div class="row" style="margin-bottom:10px;">
                                            <div class="col-sm-10">
                                                <div class="row">
                                                    <div class="col-sm-3 form-group">
                                                        {{ Form::label('ftxtDni', 'DNI') }}
                                                        {{ Form::text('ftxtDni', null, ['class'=>"form-control input-sm"]) }}
                                                    </div>
                                                    <div class="col-sm-3 form-group">
                                                        {{ Form::label('ftxtNroHistoria', 'Historia') }}
                                                        {{ Form::text('ftxtNroHistoria', null, ['class'=>"form-control input-sm"]) }}
                                                    </div>
                                                    <div class="col-sm-3 form-group">
                                                        {{ Form::label('ftxtApellidoPaterno', 'A.Paterno') }}
                                                        {{ Form::text('ftxtApellidoPaterno', null, ['class'=>"form-control input-sm"]) }}
                                                    </div>
                                                    <div class="col-sm-3 form-group">
                                                        {{ Form::label('ftxtApellidoMaterno', 'A.Materno') }}
                                                        {{ Form::text('ftxtApellidoMaterno', null, ['class'=>"form-control input-sm"]) }}
                                                    </div>
                                                </div>

                                            </div>
                                            <div class="col-sm-2">
                                                <div style="margin:5px; padding:5px;"
                                                     class="visible-md visible-lg"></div>
                                                <div class="text-right">
                                                    <a href="#" class="btn btn-sm btn-success" id="paciente-btn-add"
                                                       title="Nuevo paciente"> <i class="fa fa-user-plus"></i></a>
                                                    &nbsp; &nbsp;
                                                    <button type="submit" class="btn btn-sm btn-default"
                                                            id="paciente-btn-search" title="buscar"><i
                                                            class="fa fa-search"></i></button>
                                                    <a href="#" class="btn btn-sm btn-default" id="paciente-btn-clear"
                                                       title="Limpiar"> <i class="fa fa-refresh"></i></a>
                                                </div>
                                            </div>
                                        </div>

                                        {{ Form::close() }}
                                    </div>

                                    <div class="col-sm-12">
                                        <div class="table-responsive paciente-table">
                                            @include('consulta-externa.paciente.partials.item-list', ['mode'=>'NO_DATA'])
                                        </div>
                                    </div>


                                </div>
                            </fieldset>
                        </div>
                        {{-- BLOQUE FIN: BUSQUEDA--}}
                    </div>

                    {{-- LISTA DE ATENCIONES --}}

                    <div class="col-sm-4">
                        <div style="height: 180px; overflow-y: scroll;">

                            <table class="table table-condensed table-bordered table-hover">
                                <thead>
                                <tr class="bg-purple disabled">
                                    <th>Fecha</th>
                                    <th>Consultorio</th>
                                    <th>Plan</th>
                                    <th>CE</th>
                                    <th>CS</th>
                                </tr>

                                </thead>

                                <tbody id="paciente-consultas-anteriores">

                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>

            </div>

            <ul class="nav nav-tabs">
                <li class="active"><a href="#paciente_tab" data-toggle="tab" aria-expanded="true">Paciente</a></li>
                <li class=""><a href="#citas_tab" data-toggle="tab" aria-expanded="true">Citas</a></li>
            </ul>
            <div class="tab-content" style="padding-bottom:40px;">


                <div class="tab-pane active" id="paciente_tab">

                    {{  Form::open(['route' => ['consulta-externa.citas-admision.store'], 'method'=>'POST', 'id'=>$model.'-form', 'enctype' => 'multipart/form-data']) }}

                    {{-- Campos ocultos --}}
                    {{ Form::hidden('accion-cita', 'CREATE', ['id'=>'accion-cita' ]) }}
                    {{ Form::hidden('accion-paciente', 'CREATE', ['id'=>'accion-paciente' ]) }}

                    <div id="paciente-form-div">
                        @include('consulta-externa.paciente.partials.html-form')
                    </div>
                </div>

                <div class="tab-pane" id="citas_tab">
                    <div id="cita-form-div">
                        <fieldset class="scheduler-border">
                            <legend class="scheduler-border">Formulario: Citas N° <span class="cita_nro_cita"></span>
                            </legend>
                            <div class="row">

                                <div class="col-md-6">
                                    <div class="col-sm-6 form-group">
                                        <div class="input-group" style="width:100%">
                                            <span class="input-group-addon" style="width:120px">Tipo de servicio</span>
                                            {{ Form::select('cita_cmbIdTipoServicio', [], null, ['class'=>'form-control input-ss', 'style'=>'width:100%']) }}
                                        </div>
                                    </div>

                                    <div class="col-sm-6 form-group">
                                        <div class="input-group" style="width:100%">
                                            <span class="input-group-addon" style="width:120px">Origen</span>
                                            {{ Form::select('cita_cmbIdTipoReferencia', [], null, ['class'=>'form-control input-ss', 'style'=>'width:100%']) }}
                                        </div>
                                    </div>

                                    <div class="col-sm-12 form-group">
                                        <div class="input-group" style="width:100%">
                                            <span class="input-group-addon" style="width:120px" title="">Médico</span>
                                            {{ Form::text('cita_txtMedico', null, ['class'=>'form-control input-ss']) }}
                                        </div>
                                    </div>

                                    <div class="col-sm-6 form-group">
                                        <div class="input-group" style="width:100%">
                                            <span class="input-group-addon" style="width:120px">Especialidad</span>
                                            {{ Form::select('cita_cmbIdEspecialidad', [], null, ['class'=>'form-control input-ss', 'style'=>'width:100%']) }}
                                        </div>
                                    </div>

                                    <div class="col-sm-6 form-group">
                                        <div class="input-group" style="width:100%">
                                            <span class="input-group-addon" style="width:120px">Servicio</span>
                                            {{ Form::select('cita_cmbIdServicio', [], null, ['class'=>'form-control input-ss', 'style'=>'width:100%']) }}
                                        </div>
                                    </div>

                                    <div class="col-sm-12 form-group">
                                        <div class="input-group" style="width:100%">
                                            <span class="input-group-addon" style="width:120px" title="">Fecha</span>
                                            {{ Form::date('cita_txtFecha', null, ['class'=>'form-control input-ss']) }}
                                        </div>
                                    </div>

                                    <div class="col-sm-6 form-group">
                                        <div class="input-group" style="width:100%">
                                            <span class="input-group-addon" style="width:120px" title="">Hora Inicio</span>
                                            {{ Form::time('cita_txtHoraInicio', null, ['class'=>'form-control']) }}
                                        </div>
                                    </div>

                                    <div class="col-sm-6 form-group">
                                        <div class="input-group" style="width:100%">
                                            <span class="input-group-addon" style="width:120px" title="">Hora Fin</span>
                                            {{ Form::time('cita_txtHoraFin', null, ['class'=>'form-control']) }}
                                        </div>
                                    </div>

                                    <div class="col-sm-6 form-group">
                                        <div class="input-group" style="width:100%">
                                            <span class="input-group-addon" style="width:120px" title="">Edad</span>
                                            {{ Form::text('cita_txtEdad', null, ['class'=>'form-control input-ss']) }}
                                        </div>
                                    </div>

                                    <div class="col-sm-6 form-group">
                                        <div class="input-group" style="width:100%">
                                            <span class="input-group-addon" style="width:120px" title="">Medida edad</span>
                                            {{ Form::select('cita_cmbIdTipoEdad', [], null, ['class'=>'form-control input-ss', 'style'=>'width:100%']) }}
                                        </div>
                                    </div>

                                    <div class="col-sm-12 form-group">
                                        <div class="input-group" style="width:100%">
                                            <span class="input-group-addon" style="width:120px">Tipo consulta</span>
                                            {{ Form::select('cita_cmbIdTipoConsulta', [], null, ['class'=>'form-control input-ss', 'style'=>'width:100%']) }}
                                        </div>
                                    </div>

                                    <fieldset class="scheduler-border">
                                        <legend class="scheduler-border">Referencia origen</legend>

                                        <div class="col-sm-12 form-group">
                                            <div class="input-group" style="width:100%">
                                            <span class="input-group-addon" style="width:120px"
                                                  title="Tipo de referencia">T. de referencia</span>
                                                {{ Form::select('cita_cmbIdOrigenReferencia', [], null, ['class'=>'form-control input-ss', 'style'=>'width:100%']) }}
                                            </div>
                                        </div>

                                        <div class="col-sm-6 form-group">
                                            <div class="input-group">
                                            <span class="input-group-addon" style="width:120px"
                                                  title="">Establecimiento</span>
                                                {{ Form::text('cita_txtCodigoEstablecimiento', null, ['class'=>'form-control input-ss']) }}
                                                <span class="input-group-btn">
                                                <button type="button" class="btn btn-default btn-establecimiento-buscar" data-toggle="modal" data-target="#modal_establecimiento">
                                                    <i class="fa fa-search"></i>
                                                </button>
                                                <button class="btn btn-default btn-establecimiento-limpiar" type="button"><i class="fa fa-close text-danger"></i></button>
                                            </span>

                                            </div>
                                        </div>

                                        <div class="col-sm-6 form-group">
                                            {{ Form::text('cita_txtNombreEstablecimiento', null, ['class'=>'form-control input-ss']) }}
                                        </div>

                                        <div class="col-sm-12 form-group">
                                            <div class="input-group" style="width:100%">
                                            <span class="input-group-addon" style="width:120px"
                                                  title="">Nro. referencia</span>
                                                {{ Form::text('cita_txtNroReferencia', null, ['class'=>'form-control input-ss']) }}
                                            </div>
                                        </div>

                                    </fieldset>

                                </div>


                                <div class="col-md-6">

                                    <div class="col-sm-12 form-group">
                                        <div class="input-group" style="width:100%">
                                            <span class="input-group-addon" style="width:120px" title="Colegio profesional">Fte. Financiamiento / IAFA</span>
                                            {{ Form::select('cita_cmbIdFuenteFinanciamiento', [], null, ['class'=>'form-control input-ss', 'style'=>'width:100%']) }}
                                        </div>
                                    </div>

                                    <div class="col-sm-12 form-group">
                                        <div class="input-group" style="width:100%">
                                            <span class="input-group-addon" style="width:120px" title="Colegio profesional">Producto / Plan &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>
                                            {{ Form::select('cita_cmbIdProducto', [], null, ['class'=>'form-control input-ss', 'style'=>'width:100%']) }}
                                        </div>
                                    </div>

                                    <div class="col-sm-6 form-group">
                                        <div class="input-group" style="width:100%">
                                            <span class="input-group-addon" style="width:120px" title="">Nro. cuenta &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>
                                            {{ Form::text('cita_txtNroCuenta', null, ['class'=>'form-control input-ss']) }}
                                        </div>
                                    </div>

                                    <div class="col-sm-6 form-group">
                                        <div class="input-group" style="width:100%">
                                        <span class="input-group-addon" style="width:120px"
                                              title="">Orden de pago</span>
                                            {{ Form::text('cita_txtOrdenPago', null, ['class'=>'form-control input-ss']) }}
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </fieldset>
                    </div>
                </div>

                <div class="col-sm-12 text-right">
                    <a href="#" class="btn btn-default btn-sm btn-cancel">CANCELAR</a>
                    <a href="#" class="btn btn-primary btn-sm btn-save">GUARDAR</a>
                </div>
            </div>


            <!-- /.tab-content -->
        </div>
    </div>

</div>

{{ Form::close() }}


<div id="modal_establecimiento" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Seleccionar establecimiento</h4>
            </div>

            <div class="modal-body">

                {{ Form::open(['id'=>"establecimiento-form-search", 'method'=>'GET']) }}
                <div class="row" style="margin-bottom:10px;">
                    <div class="col-sm-10">
                        <div class="row">
                            <div class="col-sm-6 form-group">
                                {{ Form::label('establecimiento_cmbIdDepartamento', 'Departamento') }}
                                {{ Form::select('establecimiento_cmbIdDepartamento', [], null, ['class'=>'form-control input-ss', 'style'=>'width:100%']) }}
                            </div>
                            <div class="col-sm-6 form-group">
                                {{ Form::label('establecimiento_ftxNombre', 'Nombre') }}
                                {{ Form::text('establecimiento_ftxNombre', null, ['class'=>"form-control input-sm"]) }}
                            </div>
                        </div>

                    </div>
                    <div class="col-sm-2">
                        <div style="margin:5px; padding:5px;"
                             class="visible-md visible-lg"></div>
                        <div class="text-right">
                            <button type="submit" class="btn btn-sm btn-default"
                                    id="establecimiento-btn-search" title="buscar"><i
                                    class="fa fa-search"></i></button>
                            <a href="#" class="btn btn-sm btn-default" id="establecimiento-btn-clear"
                               title="Limpiar"> <i class="fa fa-refresh"></i></a>
                        </div>
                    </div>

                    <div class="col-sm-12">
                        <div class="table-responsive establecimiento-table">
                            @include('consulta-externa.citas-admision.partials.item-list-establecimientos')
                        </div>
                    </div>
                </div>
                {{ Form::close() }}
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>
