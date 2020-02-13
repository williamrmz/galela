{{  Form::open(['route' => ['programacion-general.turno.store'], 'method'=>'POST', 'id'=>$model.'-form', 'enctype' => 'multipart/form-data']) }}

<div class="row" id="form-registro-triaje" style="display: none">
    <div class="col-sm-12">
        <div class="nav-tabs-custom">
            <div class="tab-content" style="padding-bottom:40px;">

                {{-- Campos ocultos --}}
                {{ Form::hidden('accion-registro-triaje', 'CREATE', ['id'=>'accion-registro-triaje' ]) }}
                {{ Form::hidden('id-registro-triaje', 'CREATE', ['id'=>'id-registro-triaje' ]) }}

                <fieldset class="scheduler-border">
                    <legend class="scheduler-border">Formulario: Registro de triaje</legend>
                    <div class="row">
                        <div class="col-sm-3">
                            <div class="input-group" style="width:100%">
                                <span class="input-group-addon" style="width:120px">Nro. cuenta</span>
                                {{ Form::number('txtNroCuenta', null, ['class'=>'form-control', 'maxlength' => 8]) }}
                                <span class="input-group-btn">
                                    <button class="btn btn-default btn-buscar-nrocuenta" type="button">...</button>
                                </span>
                            </div>
                        </div>

                        <div class="col-sm-5 form-group">
                            <div class="input-group" style="width:100%">
                                {{ Form::text('txtNombreInformacion', null, ['class'=>'form-control input-ss', 'disabled']) }}
                            </div>
                        </div>

                        <div class="col-sm-4 form-group">
                            <div class="input-group" style="width:100%">
                                {{ Form::text('txtPlanInformacion', null, ['class'=>'form-control input-ss', 'disabled']) }}
                            </div>
                        </div>

                        <div class="col-sm-9 col-sm-offset-3 form-group">
                            <div class="input-group" style="width:100%">
                                {{ Form::text('txtCitaInformacion', null, ['class'=>'form-control input-ss', 'disabled']) }}
                            </div>
                        </div>
                    </div>

                    <div class="row">

                        <div class="col-md-6">
                            {{-- Pulso --}}
                            <div class="row">
                                <div class="col-md-6 form-group">
                                    <div class="input-group" style="width:100%">
                                        <span class="input-group-addon" style="width:120px">Pulso</span>
                                        {{ Form::number('txtPulso', null, ['class'=>'form-control input-ss']) }}
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="galela-pt-10 text-danger text-bold">60 a 100</div>
                                </div>
                            </div>

                            {{-- Temperatura --}}
                            <div class="row">
                                <div class="col-md-6 form-group">
                                    <div class="input-group" style="width:100%">
                                        <span class="input-group-addon" style="width:120px">Temperatura</span>
                                        {{ Form::number('txtTemperatura', null, ['class'=>'form-control input-ss']) }}
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="galela-pt-10 text-danger text-bold">° C</div>
                                </div>
                            </div>

                            {{-- Presion arterial --}}
                            <div class="row">
                                <div class="col-md-6 form-group">
                                    <div class="input-group" style="width:100%">
                                        <span class="input-group-addon" style="width:120px">Pre. arterial</span>
                                        {{ Form::text('txtPresionArterial', null, ['class'=>'form-control input-ss']) }}
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="galela-pt-10 text-danger text-bold">Sistólica / Diastólica</div>
                                </div>
                            </div>
                            {{-- Fin --}}

                        </div>

                        <div class="col-md-6">
                            {{-- Frecuencia respiratoria --}}
                            <div class="row">
                                <div class="col-md-6 form-group">
                                    <div class="input-group" style="width:100%">
                                        <span class="input-group-addon" style="width:120px">Fre. respiratoria</span>
                                        {{ Form::number('txtFreRespiratoria', null, ['class'=>'form-control input-ss']) }}
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="galela-pt-10 text-danger text-bold">10 a 20</div>
                                </div>
                            </div>

                            {{-- Peso --}}
                            <div class="row">
                                <div class="col-md-6 form-group">
                                    <div class="input-group" style="width:100%">
                                        <span class="input-group-addon" style="width:120px">Peso</span>
                                        {{ Form::number('txtPeso', null, ['class'=>'form-control input-ss']) }}
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="galela-pt-10 text-danger text-bold">Kg.</div>
                                </div>
                            </div>

                            {{-- Talla --}}
                            <div class="row">
                                <div class="col-md-6 form-group">
                                    <div class="input-group" style="width:100%">
                                        <span class="input-group-addon" style="width:120px">Talla</span>
                                        {{ Form::number('txtTalla', null, ['class'=>'form-control input-ss']) }}
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="galela-pt-10 text-danger text-bold">cm.</div>
                                </div>
                            </div>

                            {{-- Fin --}}
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