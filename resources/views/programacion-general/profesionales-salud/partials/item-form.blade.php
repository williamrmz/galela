{{  Form::open(['route' => ['programacion-general.profesionales-salud.store'], 'method'=>'POST', 'id'=>$model.'-form', 'enctype' => 'multipart/form-data']) }}

<div class="row" id="form-profesionales-salud" style="display: none">
    <div class="col-sm-12">
        <div class="nav-tabs-custom">
            <div class="tab-content" style="padding-bottom:40px;">

                {{-- Campos ocultos --}}
                {{ Form::hidden('accion-profesionales-salud', 'CREATE', ['id'=>'accion-profesionales-salud' ]) }}
                {{ Form::hidden('id-profesionales-salud', '', ['id'=>'id-profesionales-salud' ]) }}

                <fieldset class="scheduler-border">
                    <legend class="scheduler-border">Formulario: Profesionales de salud</legend>
                    <div class="row">

                        <div class="col-md-6">
                            <div class="col-sm-6 form-group">
                                <div class="input-group" style="width:100%">
                                    <span class="input-group-addon" style="width:120px">Documento</span>
                                    {{ Form::select('cmbIdDocIdentidad', [], null, ['class'=>'form-control input-ss', 'style'=>'width:100%']) }}
                                </div>
                            </div>

                            <div class="col-sm-6 form-group">
                                <div class="input-group" style="width:100%">
                                    <span class="input-group-addon" style="width:120px" title="Número de documento">Número doc.</span>
                                    {{ Form::text('txtNroDocumento', null, ['class'=>'form-control input-ss']) }}
                                </div>
                            </div>

                            <div class="col-sm-6 form-group">
                                <div class="input-group" style="width:100%">
                                    <span class="input-group-addon" style="width:120px" title="Apellido paterno">Ape. paterno</span>
                                    {{ Form::text('txtApellidoPaterno', null, ['class'=>'form-control input-ss']) }}
                                </div>
                            </div>

                            <div class="col-sm-6 form-group">
                                <div class="input-group" style="width:100%">
                                    <span class="input-group-addon" style="width:120px" title="Apellido materno">Ape. materno</span>
                                    {{ Form::text('txtApellidoMaterno', null, ['class'=>'form-control input-ss']) }}
                                </div>
                            </div>

                            <div class="col-sm-6 form-group">
                                <div class="input-group" style="width:100%">
                                    <span class="input-group-addon" style="width:120px">Nombres</span>
                                    {{ Form::text('txtNombres', null, ['class'=>'form-control input-ss']) }}
                                </div>
                            </div>

                            <div class="col-sm-6 form-group">
                                <div class="input-group" style="width:100%">
                                    <span class="input-group-addon" style="width:120px" title="Fecha de nacimiento">F. de nacimiento</span>
                                    {{ Form::date('txtFechaNacimiento', null, ['class'=>'form-control input-ss']) }}
                                </div>
                            </div>

                            <div class="col-sm-6 form-group">
                                <div class="input-group" style="width:100%">
                                    <span class="input-group-addon" style="width:120px" title="Código de planilla">Cod. planilla</span>
                                    {{ Form::text('txtCodigoPlanilla', null, ['class'=>'form-control input-ss', 'maxlength'=>'8']) }}
                                </div>
                            </div>

                            <div class="col-sm-6 form-group">
                                <div class="input-group" style="width:100%">
                                    <span class="input-group-addon" style="width:120px">Colegiatura</span>
                                    {{ Form::text('txtColegiatura', null, ['class'=>'form-control input-ss']) }}
                                </div>
                            </div>

                            <div class="col-sm-6 form-group">
                                <div class="input-group" style="width:100%">
                                    <span class="input-group-addon" style="width:120px">Tipo empleado</span>
                                    {{ Form::select('cmbIdTipoEmpleado', [], null, ['class'=>'form-control input-ss', 'style'=>'width:100%']) }}
                                </div>
                            </div>

                            <div class="col-sm-6 form-group">
                                <div class="input-group" style="width:100%">
                                    <span class="input-group-addon" style="width:120px" title="Condición de trabajo">Cond. trabajo</span>
                                    {{ Form::select('cmbIdCondicionTrabajo', [], null, ['class'=>'form-control input-ss', 'style'=>'width:100%']) }}
                                </div>
                            </div>

                            <div class="col-sm-6 form-group">
                                <div class="input-group" style="width:100%">
                                    <span class="input-group-addon" style="width:120px" title="Tipo destacado">Tipo destacado</span>
                                    {{ Form::select('cmbIdDestacado', [], null, ['class'=>'form-control input-ss', 'style'=>'width:100%']) }}
                                </div>
                            </div>

                            <div class="col-sm-6 form-group">
                                <div class="input-group" style="width:100%">
                                    <span class="input-group-addon" style="width:120px">Lote (HIS)</span>
                                    {{ Form::text('txtLote', null, ['class'=>'form-control input-ss']) }}
                                </div>
                            </div>

                            <div class="col-sm-6 form-group">
                                <div class="input-group" style="width:100%">
                                    <span class="input-group-addon" style="width:120px" title="Colegio profesional">Colegio Prof.</span>
                                    {{ Form::select('cmbIdColegio', [], null, ['class'=>'form-control input-ss', 'style'=>'width:100%']) }}
                                </div>
                            </div>

                            <div class="col-sm-6">
                                <div class="input-group">
                                    {{ Form::select('cmbIdSupervisor', [], null, ['class'=>'form-control input-ss', 'style'=>'width:100%']) }}
                                    <span class="input-group-btn">
                                <button class="btn btn-default btn-supervisor-limpiar" type="button"><i class="fa fa-close text-danger"></i></button>
                                </span>
                                </div>
                            </div>

                        </div>


                        <div class="col-md-6">

                            <div class="col-sm-12 form-group">
                                <div class="input-group" style="width:100%">
                                    <span class="input-group-addon" style="width:120px" title="Colegio profesional">Departamento</span>
                                    {{ Form::select('cmbIdDepartamento', [], null, ['class'=>'form-control input-ss', 'style'=>'width:100%']) }}
                                </div>
                            </div>

                            <div class="col-sm-12 form-group">
                                <div class="input-group" style="width:100%">
                                    <span class="input-group-addon" style="width:120px" title="Colegio profesional">Especialidad</span>
                                    {{ Form::select('cmbIdEspecialidad', [], null, ['class'=>'form-control input-ss', 'style'=>'width:100%']) }}
                                </div>
                            </div>

                            <div class="col-sm-12 text-right">
                                <div class="btn-group" role="group" aria-label="Button group with nested dropdown">
                                    <button type="button" class="btn btn-sm btn-secondary btn-especialidad-agregar"><i
                                                class="fa fa-plus"></i> Agregar
                                    </button>
                                </div>
                            </div>

                            <div class="col-sm-12" style="margin-top: 10px">
                                <fieldset class="scheduler-border">
                                    <legend class="scheduler-border">Especialidades</legend>

                                    {{--Tabla de especialidades por medico --}}
                                    <table class="table table-condensed table-bordered table-hover"
                                           style="margin-bottom:0">
                                        <thead>
                                        <tr class="bg-purple disabled">
                                            <td>ID</td>
                                            <td>Descripción</td>
                                            <td width="100"></td>
                                        </tr>
                                        </thead>
                                        <tbody class="{{$model}}-especialidades">
                                        </tbody>
                                    </table>


                                </fieldset>
                            </div>

                        </div>

                    </div>
                </fieldset>

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