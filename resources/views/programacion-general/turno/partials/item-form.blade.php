{{  Form::open(['route' => ['programacion-general.turno.store'], 'method'=>'POST', 'id'=>$model.'-form', 'enctype' => 'multipart/form-data']) }}

<div class="row" id="form-turno" style="display: none">
    <div class="col-sm-12">
        <div class="nav-tabs-custom">
            <div class="tab-content" style="padding-bottom:40px;">

                {{-- Campos ocultos --}}
                {{ Form::hidden('accion-turno', 'CREATE', ['id'=>'accion-turno' ]) }}
                {{ Form::hidden('id-turno', 'CREATE', ['id'=>'id-turno' ]) }}

                <fieldset class="scheduler-border">
                    <legend class="scheduler-border">Formulario: Turnos</legend>
                    <div class="row">

                        <div class="col-sm-4 form-group">
                            <div class="input-group" style="width:100%">
                                <span class="input-group-addon" style="width:120px">Código</span>
                                {{ Form::text('txtCodigo', null, ['class'=>'form-control input-ss', 'maxlength' => 3]) }}
                                {{--									{{ Form::select('cmbIdDocIndentidad', [], null, ['class'=>'form-control input-ss', 'style'=>'width:100%']) }}--}}
                            </div>
                        </div>
                        <div class="col-sm-4 form-group">
                            <div class="input-group" style="width:100%">
                                <span class="input-group-addon" style="width:120px">Descripción</span>
                                {{ Form::text('txtDescripcion', null, ['class'=>'form-control input-ss']) }}
                            </div>
                        </div>

                        <div class="col-sm-4 form-group">
                            <div class="input-group" style="width:100%">
                                <span class="input-group-addon" style="width:120px">Tipo servicio</span>
                                {{ Form::select('cmbIdTipoServicio', \App\VB\SIGHDatos\TiposServicio::listadoParaTurno(), null, ['class'=>'form-control input-ss', 'style'=>'width:100%']) }}
                            </div>
                        </div>

                        <div class="col-sm-4 form-group">
                            <div class="input-group" style="width:100%">
                                <span class="input-group-addon" style="width:120px">Hora de inicio</span>
                                {{ Form::time('txtHoraInicio', null, ['class'=>'form-control input-ss']) }}
                            </div>
                        </div>

                        <div class="col-sm-4 form-group">
                            <div class="input-group" style="width:100%">
                                <span class="input-group-addon" style="width:120px">Hora de fin</span>
                                {{ Form::time('txtHoraFin', null, ['class'=>'form-control input-ss']) }}
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