{{  Form::open(['route' => ['programacion-general.programacion.store'], 'method'=>'POST', 'id'=>$model.'-form', 'enctype' => 'multipart/form-data']) }}

{{ Form::hidden('id-programacion', '', ['id'=>'id-programacion' ]) }}
{{ Form::hidden('accion-programacion', '', ['id'=>'accion-programacion' ]) }}


<div class="row" id="form-programacion" style="display: none">
    <div class="col-sm-12">
        <div class="nav-tabs-custom">
            <div class="tab-content" style="padding-bottom:40px;">
                <fieldset class="scheduler-border">
                    <legend class="scheduler-border">Formulario: Programación</legend>
                    <div class="row">

                        <div class="col-md-4">
                            <div class="row">
                                {{-- Tipo de servicio --}}
                                <div class="col-sm-12 form-group">
                                    <div class="input-group" style="width:100%">
                                        <span class="input-group-addon" style="width:120px">Tipo servicio</span>
                                        {{ Form::select('cmbIdTipoServicio', [], null, ['class'=>'form-control input-ss', 'style'=>'width:100%']) }}
                                    </div>
                                </div>

                                {{-- Médico --}}
                                <div class="col-sm-12 form-group">
                                    <div class="input-group" style="width:100%">
                                        <span class="input-group-addon" style="width:120px">Médico</span>
                                        {{ Form::hidden('txtIdMedico', null, ['class'=>'form-control input-ss']) }}
                                        {{ Form::text('txtNombreMedico', null, ['class'=>'form-control input-ss', 'readonly']) }}
                                    </div>
                                </div>

                                {{-- Fecha inicio --}}
                                <div class="col-sm-12 form-group">
                                    <div class="input-group" style="width:100%">
                                        <span class="input-group-addon" style="width:120px" title="Fecha de inicio">Fecha de inicio</span>
                                        {{ Form::date('txtFechaInicio', null, ['class'=>'form-control input-ss']) }}
                                    </div>
                                </div>

                                {{-- Fecha fin --}}
                                <div class="col-sm-12 form-group">
                                    <div class="input-group" style="width:100%">
                                        <span class="input-group-addon" style="width:120px" title="Fecha de fin">Fecha de fin</span>
                                        {{ Form::date('txtFechaFin', null, ['class'=>'form-control input-ss']) }}
                                    </div>
                                </div>

                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="row">
                                {{-- Especialidad--}}
                                <div class="col-sm-12 form-group">
                                    <div class="input-group" style="width:100%">
                                        <span class="input-group-addon" style="width:120px">Especialidad</span>
                                        {{ Form::select('cmbIdEspecialidad', [], null, ['class'=>'form-control input-ss', 'style'=>'width:100%']) }}
                                    </div>
                                </div>

                                {{-- Servicio --}}
                                <div class="col-sm-12 form-group">
                                    <div class="input-group" style="width:100%">
                                        <span class="input-group-addon" style="width:120px">Servicio</span>
                                        {{ Form::select('cmbIdServicio', [], null, ['class'=>'form-control input-ss', 'style'=>'width:100%']) }}
                                    </div>
                                </div>

                                {{-- Tipo de programación --}}
                                <div class="col-sm-12 form-group">
                                    <div class="input-group" style="width:100%">
                                        <span class="input-group-addon" style="width:120px" title="Tipo de programación">Tipo program.</span>
                                        {{ Form::select('cmbIdTipoProgramacion', [], null, ['class'=>'form-control input-ss', 'style'=>'width:100%']) }}
                                    </div>
                                </div>

                                {{-- Turno --}}
                                <div class="col-sm-12 form-group">
                                    <div class="input-group" style="width:100%">
                                        <span class="input-group-addon" style="width:120px">Turno</span>
                                        {{ Form::select('cmbIdTurno', [], null, ['class'=>'form-control input-ss', 'style'=>'width:100%', 'required']) }}
                                    </div>
                                </div>

                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="row">
                                <div class="col-sm-12 form-group">
                                    <div class="input-group" style="width:100%">
                                        <span class="input-group-addon" style="width:120px">Hora inicio</span>
                                        {{ Form::time('txtHoraInicio', null, ['class'=>'form-control input-ss', 'required']) }}
                                    </div>
                                </div>

                                <div class="col-sm-12 form-group">
                                    <div class="input-group" style="width:100%">
                                        <span class="input-group-addon" style="width:120px">Hora fin</span>
                                        {{ Form::time('txtHoraFin', null, ['class'=>'form-control input-ss', 'required']) }}
                                    </div>
                                </div>

                                <div class="col-sm-12 form-group">
                                    <div class="input-group" style="width:100%">
                                        <span class="input-group-addon" style="width:120px">Descripción</span>
                                        {{ Form::text('txtDescripcion', null, ['class'=>'form-control input-ss']) }}
                                    </div>
                                </div>

                                <div class="col-sm-12 form-group">
                                    <div class="input-group" style="width:100%">
                                        <span class="input-group-addon" style="width:120px">Color</span>
                                        {{ Form::color('txtColor', null, ['class'=>'form-control input-ss']) }}
                                    </div>
                                </div>
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