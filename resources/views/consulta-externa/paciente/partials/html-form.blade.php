{{-- Datos de la historia clinica --}}
<fieldset class="scheduler-border">
    <legend class="scheduler-border">Datos de la Historia Clinica</legend>
    <div class="row">
        <div class="col-sm-4 form-group">
            <div class="input-group" style="width:100%">
                <span class="input-group-addon" style="width:120px">Documento</span>
                {{ Form::select('cmbIdDocIdentidad', [], null, ['class'=>'form-control input-ss', 'style'=>'width:100%']) }}
            </div>
        </div>
        <div class="col-sm-4 form-group">
            <div class="input-group" style="width:100%">
                <span class="input-group-addon" style="width:120px">N° Documento</span>
                {{ Form::text('txtNroDocumento', null, ['class'=>'form-control input-ss']) }}
            </div>
        </div>
        <div class="col-sm-4 form-group">
            <div class="input-group" style="width:100%">
                <span class="input-group-addon" style="width:120px">F. Creacion</span>
                {{ Form::date('txtFechaCreacion', null, ['class'=>'form-control input-ss']) }}
            </div>
        </div>
        <div class="col-sm-4 form-group">
            <div class="input-group" style="width:100%">
                <span class="input-group-addon" style="width:120px">Historia</span>
                {{ Form::select('cmbIdTipoGenHistoriaClinica', [], null, ['class'=>'form-control input-ss', 'style'=>'width:100%']) }}
            </div>
        </div>
        <div class="col-sm-4 form-group">
            <div class="input-group" style="width:100%">
                <span class="input-group-addon" style="width:120px">N° Historia</span>
                {{ Form::text('txtIdNroHistoria', null, ['class'=>'form-control input-ss']) }}
            </div>
        </div>

        <div class="col-sm-4 hidden">
            <div class="checkbox" style="margin-top:5px; margin-bottom:5px;">
                <label for="chkNuevoSeguro">
                    {{ Form::checkbox('chkNN', 1, false, ["id"=>"chkNN"]) }}
                    <label for="chkNN">No identificado (N.N)</label>
                </label>
            </div>
        </div>
    </div>
</fieldset>

{{-- Datos del paciente --}}
<fieldset class="scheduler-border">
    <legend class="scheduler-border">Datos del paciente</legend>
    <div class="row">
        <div class="col-sm-6">
            <div class="row">

                <div class="col-sm-6 form-group">
                    <div class="input-group" style="width:100%">
                        <span class="input-group-addon" style="width:120px">A.Paterno</span>
                        {{ Form::text('txtApellidoPaterno', null, ['class'=>'form-control input-ss']) }}
                    </div>
                </div>
                <div class="col-sm-6 form-group">
                    <div class="input-group" style="width:100%">
                        <span class="input-group-addon" style="width:120px">A.Materno</span>
                        {{ Form::text('txtApellidoMaterno', null, ['class'=>'form-control input-ss']) }}
                    </div>
                </div>

                <div class="col-sm-6 form-group">
                    <div class="input-group" style="width:100%">
                        <span class="input-group-addon" style="width:120px">Nombre 1°</span>
                        {{ Form::text('txtPrimerNombre', null, ['class'=>'form-control input-ss']) }}
                    </div>
                </div>
                <div class="col-sm-6 form-group">
                    <div class="input-group" style="width:100%">
                        <span class="input-group-addon" style="width:120px">Nombre 2°</span>
                        {{ Form::text('txtSegundoNombre', null, ['class'=>'form-control input-ss']) }}
                    </div>
                </div>

                <div class="col-sm-6 form-group">
                    <div class="input-group" style="width:100%">
                        <span class="input-group-addon" style="width:120px">Nombre 3°</span>
                        {{ Form::text('txtTercerNombre', null, ['class'=>'form-control input-ss']) }}
                    </div>
                </div>
                <div class="col-sm-6 form-group">
                    <div class="input-group" style="width:100%">
                        <span class="input-group-addon" style="width:120px">F.Nac.</span>
                        {{ Form::date('txtFechaNacimiento', null, ['class'=>'form-control input-ss']) }}
                    </div>
                </div>

                <div class="col-sm-6 form-group">
                    <div class="input-group" style="width:100%">
                        <span class="input-group-addon" style="width:120px">Sexo</span>
                        {{ Form::select('cmbIdTipoSexo', [], null, ['class'=>'form-control input-ss', 'style'=>'width:100%']) }}
                    </div>
                </div>
                <div class="col-sm-6 form-group">
                    <div class="input-group" style="width:100%">
                        <span class="input-group-addon" style="width:120px">N° Hijo</span>
                        {{ Form::text('txtNroHijo', null, ['class'=>'form-control input-ss']) }}
                    </div>
                </div>

                <div class="col-sm-6 form-group">
                    <div class="input-group" style="width:100%">
                        <span class="input-group-addon" style="width:120px">Etnia</span>
                        {{ Form::select('cmbEtnia', [], null, ['class'=>'form-control input-ss', 'style'=>'width:100%']) }}
                    </div>
                </div>
                <div class="col-sm-6 form-group">
                    <div class="input-group" style="width:100%">
                        <span class="input-group-addon" style="width:120px">Idioma Mater.</span>
                        {{ Form::select('cmbIdIdioma', [], null, ['class'=>'form-control input-ss', 'style'=>'width:100%']) }}
                    </div>
                </div>

                <div class="col-sm-12 form-group">
                    <div class="input-group" style="width:100%">
                        <span class="input-group-addon" style="width:120px">Observaciones</span>
                        {{ Form::textarea('txtObservacion', null, ['class'=>'form-control input-ss  text-red', 'rows'=>3]) }}
                    </div>
                </div>

            </div>
        </div>
        <div class="col-sm-6">
            <div class="row">

                <div class="col-sm-6 form-group">
                    <div class="input-group" style="width:100%">
                        <span class="input-group-addon" style="width:120px">Estado Civil</span>
                        {{ Form::select('cmbIdEstadoCivil', [], null, ['class'=>'form-control input-ss', 'style'=>'width:100%']) }}
                    </div>
                </div>
                <div class="col-sm-6 form-group">
                    <div class="input-group" style="width:100%">
                        <span class="input-group-addon" style="width:120px">ID.Paciente</span>
                        {{ Form::text('txtIdPaciente', null, ['class'=>'form-control input-ss']) }}
                    </div>
                </div>

                <div class="col-sm-12 form-group">
                    <div class="input-group" style="width:100%">
                        <span class="input-group-addon" style="width:120px">Gr.Instruc</span>
                        {{ Form::select('cmbIdGradoInstruccion', [], null, ['class'=>'form-control input-ss', 'style'=>'width:100%']) }}
                    </div>
                </div>


                <div class="col-sm-6 form-group">
                    <div class="input-group" style="width:100%">
                        <span class="input-group-addon" style="width:120px">Edad Actual</span>
                        {{ Form::text('txtEdadActual', null, ['class'=>'form-control input-ss']) }}
                    </div>
                </div>
                <div class="col-sm-6 form-group">
                    <div class="input-group" style="width:100%">
                        <span class="input-group-addon" style="width:120px">Telefono</span>
                        {{ Form::text('txtTelefono', null, ['class'=>'form-control input-ss']) }}
                    </div>
                </div>

                <div class="col-sm-12 form-group">
                    <div class="input-group" style="width:100%">
                        <span class="input-group-addon" style="width:120px">Procedencia</span>
                        {{ Form::select('cmbIdProcedencia', [], null, ['class'=>'form-control input-ss', 'style'=>'width:100%']) }}
                    </div>
                </div>

                <div class="col-sm-12 form-group">
                    <div class="input-group" style="width:100%">
                        <span class="input-group-addon" style="width:120px">Ocupacion</span>
                        {{ Form::select('cmbIdTipoOcupacion', [], null, ['class'=>'form-control input-ss', 'style'=>'width:100%']) }}
                    </div>
                </div>

                <div class="col-sm-8">
                    <div class="row">
                        <div class="col-sm-12 form-group">
                            <div class="input-group" style="width:100%">
                                <span class="input-group-addon" style="width:120px">Email</span>
                                {{ Form::text('txtEmail', null, ['class'=>'form-control input-ss']) }}
                            </div>
                        </div>
                        <div class="col-sm-12 form-group">
                            <div class="input-group" style="width:100%">
                                <span class="input-group-addon" style="width:120px">Nombre Padre</span>
                                {{ Form::text('txtNombrePadre', null, ['class'=>'form-control input-ss']) }}
                            </div>

                        </div>
                    </div>
                </div>

                <div class="col-sm-4">
                    <div class="row">
                        <div class="col-sm-8">
                            <img src="{{url('/storage/images/config/SIN_IMAGEN.PNG')}}" alt="" width="90%"
                                 id="imagenPacientePreview">
                            <input type="hidden" id="foto_base64" name="foto_base64">
                        </div>
                        <div class="col-sm-4" style="padding-left: 5px">
                            <input type="file" class='hide' name="imagenPaciente" id="imagenPaciente">
                            <label for="imagenPaciente" class="btn btn-block btn-sm btn-default"> <i
                                        class="text-yellow fa fa-camera"></i> </label>
                            <a href="#" class="btn btn-block btn-sm btn-default" id="imagenPacienteClear"> <i
                                        class="text-red fa fa-close"></i></a>
                        </div>
                    </div>
                </div>


            </div>
        </div>
    </div>
</fieldset>

{{-- Datos de la madre o tutor / Datos del sector y Sectorista--}}
<div class="row">
    <div class="col-sm-6">
        <fieldset class="scheduler-border">
            <legend class="scheduler-border">Datos de la madre o tutor</legend>
            <div class="row">
                <div class="col-sm-6 form-group">
                    <div class="input-group" style="width:100%">
                        <span class="input-group-addon" style="width:120px">Documento</span>
                        {{ Form::select('cmbMadreTipoDocumento', [], null, ['class'=>'form-control input-ss', 'style'=>'width:100%']) }}
                    </div>
                </div>
                <div class="col-sm-6 form-group">
                    <div class="input-group" style="width:100%">
                        <span class="input-group-addon" style="width:120px">N° Documento</span>
                        {{ Form::text('txtMadreDocumento', null, ['class'=>'form-control input-ss']) }}
                    </div>
                </div>

                <div class="col-sm-6 form-group">
                    <div class="input-group" style="width:100%">
                        <span class="input-group-addon" style="width:120px">Ap.Paterno</span>
                        {{ Form::text('txtMadreApellidoP', null, ['class'=>'form-control input-ss']) }}
                    </div>
                </div>
                <div class="col-sm-6 form-group">
                    <div class="input-group" style="width:100%">
                        <span class="input-group-addon" style="width:120px">Ap.Materno</span>
                        {{ Form::text('txtMadreApellidoM', null, ['class'=>'form-control input-ss']) }}
                    </div>
                </div>

                <div class="col-sm-6 form-group">
                    <div class="input-group" style="width:100%">
                        <span class="input-group-addon" style="width:120px">Nombre 1°</span>
                        {{ Form::text('txtMadreNombre', null, ['class'=>'form-control input-ss']) }}
                    </div>
                </div>
                <div class="col-sm-6 form-group">
                    <div class="input-group" style="width:100%">
                        <span class="input-group-addon" style="width:120px">Nombre 2°</span>
                        {{ Form::text('txtMadreSnombre', null, ['class'=>'form-control input-ss']) }}
                    </div>
                </div>
            </div>
        </fieldset>
    </div>
    <div class="col-sm-6">
        <div class="col-sm-6">
            <fieldset class="scheduler-border">
                <legend class="scheduler-border">Datos del Sector y Sectorista</legend>


            </fieldset>
        </div>
    </div>
</div>

{{-- Ubigeo --}}
<div class="nav-tabs-custom ">
    <ul class="nav nav-tabs ">
        <li class="active"><a href="#tab_docmicilio" data-toggle="tab">Datos de domicilio</a></li>
        <li><a href="#tab_procedencia" data-toggle="tab">Datos de procedencia</a></li>
        <li><a href="#tab_nacimiento" data-toggle="tab">Datos de nacimiento</a></li>
        @if(!empty($origen_form)  && $origen_form == "PACIENTE")
            <li><a href="#tab_epicrisis" data-toggle="tab">Datos de epicrisis</a></li>
        @endif
    </ul>
    <div class="tab-content">
        {{-- Datos de domicilio --}}
        <div class="tab-pane active" id="tab_docmicilio">
            <div class="row">
                <div class="col-sm-4 form-group">
                    <div class="input-group" style="width:100%">
                        <span class="input-group-addon" style="width:120px">Departamento</span>
                        {{ Form::select('cmbIdDepartamentoDomicilio', [], null, ['class'=>'form-control input-ss', 'style'=>'width:100%']) }}
                    </div>
                </div>
                <div class="col-sm-4 form-group">
                    <div class="input-group" style="width:100%">
                        <span class="input-group-addon" style="width:120px">Provincia</span>
                        {{ Form::select('cmbIdProvinciaDomicilio', [], null, ['class'=>'form-control input-ss', 'style'=>'width:100%']) }}
                    </div>
                </div>
                <div class="col-sm-4 form-group">
                    <div class="input-group" style="width:100%">
                        <span class="input-group-addon" style="width:120px">Distrito</span>
                        {{ Form::select('cmbIdDistritoDomicilio', [], null, ['class'=>'form-control input-ss', 'style'=>'width:100%']) }}
                    </div>
                </div>
                <div class="col-sm-4 form-group">
                    <div class="input-group" style="width:100%">
                        <span class="input-group-addon" style="width:120px">Centro Pobl.</span>
                        {{ Form::select('cmbIdCentroPobladoDomicilio', [], null, ['class'=>'form-control input-ss', 'style'=>'width:100%']) }}
                    </div>
                </div>
                <div class="col-sm-4 form-group">
                    <div class="input-group" style="width:100%">
                        <span class="input-group-addon" style="width:120px">País</span>
                        {{ Form::select('cmbIdPaisDomicilio', [], null, ['class'=>'form-control input-ss', 'style'=>'width:100%']) }}
                    </div>
                </div>
                <div class="col-sm-4 form-group">
                    <div class="input-group" style="width:100%">
                        <span class="input-group-addon" style="width:120px">Direccion</span>
                        {{ Form::text('txtDireccionDomicilio', null, ['class'=>'form-control input-ss']) }}
                    </div>
                </div>
            </div>
        </div>

        {{-- Datos de procedencia --}}
        <div class="tab-pane" id="tab_procedencia">
            <div class="row">
                <div class="col-sm-4 form-group">
                    <div class="input-group" style="width:100%">
                        <span class="input-group-addon" style="width:120px">Departamento</span>
                        {{ Form::select('cmbIdDepartamentoProcedencia', [], null, ['class'=>'form-control input-ss', 'style'=>'width:100%']) }}
                    </div>
                </div>
                <div class="col-sm-4 form-group">
                    <div class="input-group" style="width:100%">
                        <span class="input-group-addon" style="width:120px">Provincia</span>
                        {{ Form::select('cmbIdProvinciaProcedencia', [], null, ['class'=>'form-control input-ss', 'style'=>'width:100%']) }}
                    </div>
                </div>
                <div class="col-sm-4 form-group">
                    <div class="input-group" style="width:100%">
                        <span class="input-group-addon" style="width:120px">Distrito</span>
                        {{ Form::select('cmbIdDistritoProcedencia', [], null, ['class'=>'form-control input-ss', 'style'=>'width:100%']) }}
                    </div>
                </div>
                <div class="col-sm-4 form-group">
                    <div class="input-group" style="width:100%">
                        <span class="input-group-addon" style="width:120px">Centro Pobl.</span>
                        {{ Form::select('cmbIdCentroPobladoProcedencia', [], null, ['class'=>'form-control input-ss', 'style'=>'width:100%']) }}
                    </div>
                </div>
                <div class="col-sm-4 form-group">
                    <div class="input-group" style="width:100%">
                        <span class="input-group-addon" style="width:120px">País</span>
                        {{ Form::select('cmbIdPaisProcedencia', [], null, ['class'=>'form-control input-ss', 'style'=>'width:100%']) }}
                    </div>
                </div>
                <div class="col-sm-4 form-group" style="margin-top: 5px;">
                    <a href="#!" class="btn btn-xs btn-default" id="btnIgualQueDomicilioP">Igual que el domicilio</a>
                </div>
            </div>
        </div>

        {{-- Datos de nacimiento --}}
        <div class="tab-pane" id="tab_nacimiento">
            <div class="row">
                <div class="col-sm-4 form-group">
                    <div class="input-group" style="width:100%">
                        <span class="input-group-addon" style="width:120px">Departamento</span>
                        {{ Form::select('cmbIdDepartamentoNacimiento', [], null, ['class'=>'form-control input-ss', 'style'=>'width:100%']) }}
                    </div>
                </div>
                <div class="col-sm-4 form-group">
                    <div class="input-group" style="width:100%">
                        <span class="input-group-addon" style="width:120px">Provincia</span>
                        {{ Form::select('cmbIdProvinciaNacimiento', [], null, ['class'=>'form-control input-ss', 'style'=>'width:100%']) }}
                    </div>
                </div>
                <div class="col-sm-4 form-group">
                    <div class="input-group" style="width:100%">
                        <span class="input-group-addon" style="width:120px">Distrito</span>
                        {{ Form::select('cmbIdDistritoNacimiento', [], null, ['class'=>'form-control input-ss', 'style'=>'width:100%']) }}
                    </div>
                </div>
                <div class="col-sm-4 form-group">
                    <div class="input-group" style="width:100%">
                        <span class="input-group-addon" style="width:120px">Centro Pobl.</span>
                        {{ Form::select('cmbIdCentroPobladoNacimiento', [], null, ['class'=>'form-control input-ss', 'style'=>'width:100%']) }}
                    </div>
                </div>
                <div class="col-sm-4 form-group">
                    <div class="input-group" style="width:100%">
                        <span class="input-group-addon" style="width:120px">País</span>
                        {{ Form::select('cmbIdPaisNacimiento', [], null, ['class'=>'form-control input-ss', 'style'=>'width:100%']) }}
                    </div>
                </div>
                <div class="col-sm-4 form-group" style="margin-top: 5px;">
                    <a href="#!" class="btn btn-xs btn-default" id="btnIgualQueDomicilioN">Igual que el domicilio</a>
                </div>
            </div>
        </div>

        @if(!empty($origen_form)  && $origen_form == "PACIENTE")
            {{-- Datos de epicrisis --}}
            <div class="tab-pane" id="tab_epicrisis">
                <div class="form-group">
                    <div class="input-group" style="width:100%">
                        <span class="input-group-addon" style="width:120px">País</span>
                        {{ Form::textarea('grdEpicrisis', null, ['class'=>'form-control input-ss', 'rows'=>3, 'style'=>'height: 75px']) }}
                    </div>
                </div>
            </div>
    @endif
    <!-- /.tab-pane -->
    </div>
    <!-- /.tab-content -->
</div>