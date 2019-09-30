@extends('layouts.master')

@section('KX', 'active menu-open')
@section('KX.PacienteCE', 'active')

@section('breadcrumb')
<li><a href='#'>Inicio</a></li>
<li><a href='#'>Consulta externa</a></li>
<li><a href='{{ url('paciente.index') }}'>Paciente</a></li>
<li class='active'>Crear</li>
@endsection

@php
	$model = 'paciente';
@endphp

@section('content')

{{ Form::hidden($model.'-path-ctrl', route('consulta-externa.paciente.index')) }}
{{ Form::hidden('current_action', $action, ['class'=>'current_action']) }}
{{ Form::hidden('id_paciente', $id_paciente, ['class'=>'id_paciente']) }}

{{  Form::open(['route' => ['consulta-externa.paciente.store'], 'method'=>'POST', 'id'=>$model.'-form', 'enctype' => 'multipart/form-data']) }}
<div class="row">
	<div class="col-sm-12">
		<div class="nav-tabs-custom">
			<ul class="nav nav-tabs">
				<li class="active"><a href="#tab_1" data-toggle="tab">1.1) Datos del paciente</a></li>
				<li><a href="#tab_2" data-toggle="tab">1.2) SUNASA</a></li>
			</ul>
			<div class="tab-content" style="padding-bottom:40px;">

				<div class="tab-pane active" id="tab_1">
					{{-- Datos de la historia clinica --}}
					<fieldset class="scheduler-border">
						<legend class="scheduler-border">Datos de la Historia Clinica</legend>
						<div class="row">
							<div class="col-sm-4 form-group">
								<div class="input-group" style="width:100%">
									<span class="input-group-addon" style="width:120px">Documento</span>
									{{ Form::select('cmbIdDocIndentidad', [], null, ['class'=>'form-control input-ss', 'style'=>'width:100%']) }}
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
											{{ Form::textarea('txtObservacion', null, ['class'=>'form-control input-ss', 'rows'=>3]) }}
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
												<img src="{{url('/storage/images/config/SIN_IMAGEN.PNG')}}" alt="" width="90%" id="imagenPacientePreview">
											</div>
											<div class="col-sm-4" style="padding-left: 5px">
												<input type="file" class='hide' name="imagenPaciente" id="imagenPaciente">
												<label for="imagenPaciente" class="btn btn-block btn-sm btn-default"> <i class="text-yellow fa fa-camera"></i> </label>
												<a href="#" class="btn btn-block btn-sm btn-default" id="imagenPacienteClear"> <i class="text-red fa fa-close"></i></a>
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
							<fieldset class="scheduler-border" >
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
								<fieldset class="scheduler-border" >
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
							<li><a href="#tab_epicrisis" data-toggle="tab">Datos de epicrisis</a></li>
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
									<div class="col-sm-4 form-group">
										<div class="checkbox" style="margin-top:5px; margin-bottom:5px;">
											<label>
												{{ Form::checkbox('chkIgualQueDomicilio', 1 , false) }} Igual que el domicilio
											</label>
										</div>
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
									<div class="col-sm-4 form-group">
										<div class="checkbox" style="margin-top:5px; margin-bottom:5px;">
											<label>
												{{ Form::checkbox('chkIgualQueDomicilioNac', 1 , false) }} Igual que el domicilio
											</label>
										</div>
									</div>
								</div>
							</div>
							
							{{-- Datos de epicrisis --}}
							<div class="tab-pane" id="tab_epicrisis">
								<div class="form-group">
									<div class="input-group" style="width:100%">
										<span class="input-group-addon" style="width:120px">País</span>
										{{ Form::textarea('grdEpicrisis', null, ['class'=>'form-control input-ss', 'rows'=>3, 'style'=>'height: 75px']) }}
									</div>
								</div>
							</div>
							<!-- /.tab-pane -->
						</div>
						<!-- /.tab-content -->
					</div>
				</div>
				<!-- /.tab-pane -->
				<div class="tab-pane" id="tab_2">
					<div class="row">
						{{-- Info general --}}
						<div class="col-sm-12">
							<div class="row">
								<div class="col-sm-6">
									<div class="row">

										<div class="col-sm-12 form-group">
											<div class="input-group" style="width:100%">
												<span class="input-group-addon" style="width:120px">Paciente</span>
												{{ Form::text('txtPaciente', null, ['class'=>'form-control input-ss', 'readonly']) }}
											</div>
										</div>
										<div class="col-sm-6 form-group">
											<div class="input-group" style="width:100%">
												<span class="input-group-addon" style="width:120px">Documento</span>
												{{ Form::text('txtDocumento', null, ['class'=>'form-control input-ss', 'readonly']) }}
											</div>
										</div>
										<div class="col-sm-6 form-group">
											<div class="input-group" style="width:100%">
												<span class="input-group-addon" style="width:120px">N° Documento</span>
												{{ Form::text('txtNdocumento', null, ['class'=>'form-control input-ss', 'readonly']) }}
											</div>
										</div>
									</div>
								</div>
								<div class="col-sm-4">
									<div class="row">
										<div class="col-sm-12 form-group">
											<div class="input-group" style="width:100%">
												<span class="input-group-addon" style="width:120px">Sexo</span>
												{{ Form::text('txtSexo', null, ['class'=>'form-control input-ss', 'readonly']) }}
											</div>
										</div>
										<div class="col-sm-12 form-group">
											<div class="input-group" style="width:100%">
												<span class="input-group-addon" style="width:120px">Pais</span>
												{{ Form::text('txtPais', null, ['class'=>'form-control input-ss', 'readonly']) }}
											</div>
										</div>
									</div>
								</div>
								<div class="col-sm-2">
									<div class="row">
										<div class="col-sm-12 form-group">
											<div class="checkbox" style="margin-top:5px; margin-bottom:5px;">
												<label>
													{{ Form::checkbox('chkNuevoSeguro', 1, false) }}
													Nuevo Seguro
												</label>
											</div>
										</div>
										<div class="col-sm-12 form-group">
											<div class="checkbox"  style="margin-top:5px; margin-bottom:5px;">
												<label>
													{{ Form::checkbox('chkNoTieneSeguro', 1, false) }}
													Sin Seguro
												</label>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>

					<div class="row" id="forms-sunasa">
						{{-- Datos del paciente (Asegurado) --}}
						<div class="col-sm-8">
							<fieldset class="scheduler-border" >
								<legend class="scheduler-border">Datos del paciente (Asegurado)</legend>
								<div class="row">
									<div class="col-sm-6 form-group">
										<div class="input-group" style="width:100%">
											<span class="input-group-addon" style="width:120px">Ap.Casada</span>
											{{ Form::text('txtApellidoCasada', null, ['class'=>'form-control input-ss']) }}
										</div>
									</div>
									<div class="col-sm-6 form-group">
										<div class="input-group" style="width:100%">
											<span class="input-group-addon" style="width:120px">Paren. Titular</span>
											{{ Form::select('cmbParentescoTitular', [], null, ['class'=>'form-control input-ss', 'style'=>'width:100%']) }}
										</div>
									</div>

									<div class="col-sm-6 form-group">
										<div class="input-group" style="width:100%">
											<span class="input-group-addon" style="width:120px">Doc.(ant)</span>
											{{ Form::select('cmbDocumentoAnterior', [], null, ['class'=>'form-control input-ss', 'style'=>'width:100%']) }}
										</div>
									</div>
									<div class="col-sm-6 form-group">
										<div class="input-group" style="width:100%">
											<span class="input-group-addon" style="width:120px">N° Doc.(ant)</span>
											{{ Form::text('txtNroDocumentoAnterior', null, ['class'=>'form-control input-ss']) }}
										</div>
									</div>

									<div class="col-sm-6 form-group">
										<div class="input-group" style="width:100%">
											<span class="input-group-addon" style="width:120px">F.Nacimiento</span>
											{{ Form::date('txtFnacimiento', null, ['class'=>'form-control input-ss', 'readonly']) }}
										</div>
									</div>
									<div class="col-sm-6 form-group">
										<div class="input-group" style="width:100%">
											<span class="input-group-addon" style="width:120px">Ubigeo(domi.)</span>
											{{ Form::text('txtUbigeo', null, ['class'=>'form-control input-ss', 'readonly']) }}
										</div>
									</div>
								</div>
							</fieldset>
						</div>

						{{-- Datos del titular --}}
						<div class="col-sm-4">
							<fieldset class="scheduler-border" >
								<legend class="scheduler-border">Datos del titular</legend>
								<div class="row">
									<div class="col-sm-12 form-group">
										<div class="input-group" style="width:100%">
											<span class="input-group-addon" style="width:120px">Pais</span>
											{{ Form::select('cmbPaisTitular', [], null, ['class'=>'form-control input-ss', 'style'=>'width:100%']) }}
										</div>
									</div>
									<div class="col-sm-12 form-group">
										<div class="input-group" style="width:100%">
											<span class="input-group-addon" style="width:120px">Documento</span>
											{{ Form::select('cmbDocumentoTitular', [], null, ['class'=>'form-control input-ss', 'style'=>'width:100%']) }}
										</div>
									</div>

									<div class="col-sm-12 form-group">
										<div class="input-group" style="width:100%">
											<span class="input-group-addon" style="width:120px">N°Documento</span>
											{{ Form::text('txtNdocumentoTitular', null, ['class'=>'form-control input-ss']) }}
										</div>
									</div>
								</div>
							</fieldset>
						</div>

						{{-- Datos del seguro --}}
						<div class="col-sm-12">
							<fieldset class="scheduler-border" >
								<legend class="scheduler-border">Datos del seguro</legend>
								<div class="row">
									<div class="col-sm-4 form-group">
										<div class="input-group" style="width:100%">
											<span class="input-group-addon" style="width:140px">Regimen</span>
											{{ Form::select('cmbRegimen', [], null, ['class'=>'form-control input-ss', 'style'=>'width:100%']) }}
										</div>
									</div>
									<div class="col-sm-4 form-group">
										<div class="input-group" style="width:100%">
											<span class="input-group-addon" style="width:140px">C.Afiliacion(SIS)</span>
											{{ Form::text('txtNroAfiliacion1', 19, ['class'=>'form-control input-ss', 'readonly']) }}
											<span class="input-group-addon" style="width: 0px;padding-right: 0px;padding-left: 0px;border-left-width: 0px;border-right-width: 0px;" ></span>
											{{ Form::text('txtNroAfiliacion2', null, ['class'=>'form-control input-ss']) }}
											<span class="input-group-addon" style="width: 0px;padding-right: 0px;padding-left: 0px;border-left-width: 0px;border-right-width: 0px;" ></span>
											{{ Form::text('txtNroAfiliacion3', null, ['class'=>'form-control input-ss']) }}
										</div>
									</div>
									<div class="col-sm-4 form-group">
										<div class="input-group" style="width:100%">
											<span class="input-group-addon" style="width:140px">C.Estab.IAFA</span>
											{{ Form::text('txtCodEstablecIAFA', '043717', ['class'=>'form-control input-ss', 'readonly']) }}
										</div>
									</div>

									<div class="col-sm-4 form-group">
										<div class="input-group" style="width:100%">
											<span class="input-group-addon" style="width:140px">Producto/Pan</span>
											{{ Form::text('txtProductoPlan1', null, ['class'=>'form-control input-ss']) }}
											<span class="input-group-addon" style="width: 0px;padding-right: 0px;padding-left: 0px;border-left-width: 0px;border-right-width: 0px;" ></span>
											{{ Form::text('txtProductoPlan2', null, ['class'=>'form-control input-ss']) }}
										</div>
									</div>
									<div class="col-sm-4 form-group">
										<div class="input-group" style="width:100%">
											<span class="input-group-addon" style="width:140px">Tipo Af.</span>
											{{ Form::select('cmbTipoAfiliacion', [],  null, ['class'=>'form-control input-ss', 'style'=>'width:100%']) }}
										</div>
									</div>
									<div class="col-sm-4 form-group">
										<div class="input-group" style="width:100%">
											<span class="input-group-addon" style="width:140px">C.Estab.RENAES</span>
											{{ Form::text('txtCodEstablecRENAES', '043717', ['class'=>'form-control input-ss', 'readonly']) }}
										</div>
									</div>


									<div class="col-sm-4 form-group">
										<div class="input-group" style="width:100%">
											<span class="input-group-addon" style="width:140px">F.Inicio Af.</span>
											{{ Form::date('txtFechaInicioAfiliacion', null, ['class'=>'form-control input-ss']) }}
										</div>
									</div>
									<div class="col-sm-4 form-group">
										<div class="input-group" style="width:100%">
											<span class="input-group-addon" style="width:140px">F.Final Af.</span>
											{{ Form::date('txtFechaFinalAfiliacion', null, ['class'=>'form-control input-ss']) }}
										</div>
									</div>
									<div class="col-sm-4 form-group">
										<div class="input-group" style="width:100%">
											<span class="input-group-addon" style="width:140px">Carnet Ident.</span>
											{{ Form::text('txtCarnetIdentidad', null, ['class'=>'form-control input-ss']) }}
										</div>
									</div>

									<div class="col-sm-4 form-group">
										<div class="input-group" style="width:100%">
											<span class="input-group-addon" style="width:140px">RUC Empleador</span>
											{{ Form::text('txtRUCempleador', null, ['class'=>'form-control input-ss']) }}
										</div>
									</div>
									<div class="col-sm-4 form-group">
										<div class="input-group" style="width:100%">
											<span class="input-group-addon" style="width:140px">Valida R.Ident</span>
											{{ Form::select('cmbValidacionRegIden', [], null, ['class'=>'form-control input-ss', 'style'=>'width:100%']) }}
										</div>
									</div>

									<div class="col-sm-4 form-group">
										<div class="input-group" style="width:100%">
											<span class="input-group-addon" style="width:140px">Estado Seguro</span>
											{{ Form::select('cmbEstadoSeguro', [], null, ['class'=>'form-control input-ss', 'style'=>'width:100%']) }}
										</div>
									</div>
									<div class="col-sm-4 form-group">
										<div class="input-group" style="width:100%">
											<span class="input-group-addon" style="width:140px">Codigo IAFA</span>
											{{ Form::text('txtCodigoIAFA', null, ['class'=>'form-control input-ss']) }}
										</div>
									</div>

								</div>
							</fieldset>
						</div>

						{{-- Datos del encargado del sepelio (SIS) --}}
						<div class="col-sm-6">
							<fieldset class="scheduler-border" >
								<legend class="scheduler-border">Datos del encargado del sepelio (Asegurado)</legend>
								<div class="row">
									<div class="col-sm-12 form-group">
										<div class="input-group" style="width:100%">
											<span class="input-group-addon" style="width:140px">Ap.Nombres</span>
											{{ Form::text('txtSepelioApellidosYnombre', null, ['class'=>'form-control input-ss']) }}
										</div>
									</div>

									<div class="col-sm-12 form-group">
										<div class="input-group" style="width:100%">
											<span class="input-group-addon" style="width:120px">F.Nacimiento</span>
											{{ Form::date('txtSepelioFnacimiento', null, ['class'=>'form-control input-ss']) }}
										</div>
									</div>
									<div class="col-sm-6 form-group">
										<div class="input-group" style="width:100%">
											<span class="input-group-addon" style="width:120px">N° DNI</span>
											{{ Form::text('txtSpelioDNI', null, ['class'=>'form-control input-ss']) }}
										</div>
									</div>

									<div class="col-sm-6 form-group">
										<div class="input-group" style="width:100%">
											<span class="input-group-addon" style="width:140px">Sexo</span>
											{{ Form::select('cmbSepelioSexo', [], null, ['class'=>'form-control input-ss', 'style'=>'width:100%']) }}
										</div>
									</div>

								</div>
							</fieldset>
						</div>

						{{-- Extra --}}
						<div class="col-sm-6">
							<fieldset class="scheduler-border" >
								<legend class="scheduler-border">#</legend>
								<div class="row">
									<div class="col-sm-12 form-group">
										<div class="input-group" style="width:100%">
											<span class="input-group-addon" style="width:120px">DNI Usuario</span>
											{{ Form::text('txtDNIUsuario', null, ['class'=>'form-control input-ss']) }}
										</div>
									</div>

									<div class="col-sm-12 form-group">
										<div class="input-group" style="width:100%">
											<span class="input-group-addon" style="width:120px">Tipo operacion</span>
											{{ Form::select('cmbTipoOperacion', [], null, ['class'=>'form-control input-ss', 'style'=>'width:100%']) }}
										</div>
									</div>
									<div class="col-sm-12 form-group">
										<div class="input-group" style="width:100%">
											<span class="input-group-addon" style="width:120px">Fecha Envio</span>
											{{ Form::date('txtFechaEnvio', null, ['class'=>'form-control input-ss']) }}
											<span class="input-group-addon">H</span>
											{{ Form::time('txtHoraEnvio', null, ['class'=>'form-control input-ss']) }}
										</div>
									</div>

								</div>
							</fieldset>
						</div>
					</div>
				</div>
				<!-- /.tab-pane -->

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

@endsection

@section('scripts')
    <script src="{{ url('/js/consulta-externa/paciente.create.js') }}"></script>
@endsection
