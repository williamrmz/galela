@php
	$model = 'registroAtenciones';
@endphp

{{  Form::open(['route' => ['consulta-externa.registro-atenciones.store'], 'method'=>'POST', 'id'=>$model.'-form']) }}
	<div class="row">

		<div class="col-sm-12">
			<fieldset class="scheduler-border" style="background-color: white; margin-bottom:10px;">
				<legend class="scheduler-border">Triaje</legend>
				<div class="row">
					<div class="col-sm-2">
						{{ Form::label('presion', 'Presion (Sist/Diast)') }}
						{{ Form::text('presion', null, ['class'=>'form-control input-sm'])}}
					</div>
					<div class="col-sm-2">
							{{ Form::label('temperatura', 'Temperatura (°C)') }}
							{{ Form::text('temperatura', null, ['class'=>'form-control input-sm'])}}
						</div>
					<div class="col-sm-2">
						{{ Form::label('peso', 'Peso (Kg)') }}
						{{ Form::text('peso', null, ['class'=>'form-control input-sm'])}}
					</div>
					<div class="col-sm-2">
						{{ Form::label('talla', 'Talla(cm)') }}
						{{ Form::text('talla', null, ['class'=>'form-control input-sm'])}}
					</div>
					<div class="col-sm-2">
						{{ Form::label('pulso', 'Pulso (0-250)') }}
						{{ Form::text('pulso', null, ['class'=>'form-control input-sm'])}}
					</div>
					<div class="col-sm-2">
						{{ Form::label('frecuencia_respiratoria', 'F.Respiratoria (0-70)') }}
						{{ Form::text('frecuencia_respiratoria', null, ['class'=>'form-control input-sm'])}}
					</div>
				</div>
			</fieldset>
		</div>

		<div class="col-sm-12">
			<div class="nav-tabs-custom">
				<ul class="nav nav-tabs">
					<li class="active"><a href="#tab_1" data-toggle="tab">3.1 Anam/Ex.Fisico</a></li>
					<li><a href="#tab_2" data-toggle="tab">3.2 Diagnosticos</a></li>
					<li><a href="#tab_3" data-toggle="tab">3.3 Ordenes Medicas</a></li>
					<li><a href="#tab_4" data-toggle="tab">3.4 Tratamiento</a></li>
					<li><a href="#tab_5" data-toggle="tab">3.5 Destino Atencion</a></li>
				</ul>
				<div class="tab-content">
					{{-- tab_1 Examen --}}
					<div class="tab-pane active" id="tab_1">
						<div class="row">
							{{-- Antecedentes Personales --}}
							<div class="col-sm-12">
								<fieldset class="scheduler-border">
									<legend class="scheduler-border">Antecedentes Personales</legend>
									<div class="row">
										<div class="col-sm-6">
											<div class="row">
												<div class="col-sm-3">Quirúrgicos</div>
												<div class="col-sm-9"> {{Form::textarea('antecedentes_quirurgicos', null, ['class'=>'form-control input-sm', 'rows'=>2]) }}</div>
											</div>
										</div>
										<div class="col-sm-6">
											<div class="row">
												<div class="col-sm-3">Alergias</div>
												<div class="col-sm-9"> {{Form::textarea('antecedentes_alergias', null, ['class'=>'form-control input-sm', 'rows'=>2]) }}</div>
											</div>
										</div>
									</div>

									<div class="row">
										<div class="col-sm-6">
											<div class="row">
												<div class="col-sm-3">Patologicos</div>
												<div class="col-sm-9"> {{Form::textarea('antecedentes_patologicos', null, ['class'=>'form-control input-sm', 'rows'=>2]) }}</div>
											</div>
										</div>
										<div class="col-sm-6">
											<div class="row">
												<div class="col-sm-3">Familiares</div>
												<div class="col-sm-9"> {{Form::textarea('antecedentes_familiares', null, ['class'=>'form-control input-sm', 'rows'=>2]) }}</div>
											</div>
										</div>
									</div>

									<div class="row">
										<div class="col-sm-6">
											<div class="row">
												<div class="col-sm-3">Obstétricos</div>
												<div class="col-sm-9"> {{Form::textarea('antecedentes_obstetricos', null, ['class'=>'form-control input-sm', 'rows'=>2]) }}</div>
											</div>
										</div>
										<div class="col-sm-6">
											<div class="row">
												<div class="col-sm-3">otros</div>
												<div class="col-sm-9"> {{Form::textarea('antecedentes_otros', null, ['class'=>'form-control input-sm', 'rows'=>2]) }}</div>
											</div>
										</div>
									</div>
									
								</fieldset>
							</div>
							{{-- Motivo de la consulta --}}
							<div class="col-sm-6">
								<fieldset class="scheduler-border">
									<legend class="scheduler-border">Motivo de la consulta</legend>
									{{ Form::textarea('motivo_consulta', null, ['class'=>'form-control input-sm', 'rows'=>3] )}}
								</fieldset>
							</div>

							{{-- Examen Fisico --}}
							<div class="col-sm-6">
								<fieldset class="scheduler-border">
									<legend class="scheduler-border">Examen Fisico</legend>
									{{ Form::textarea('examen_fisico', null, ['class'=>'form-control input-sm', 'rows'=>3] )}}
								</fieldset>
							</div>

							{{-- Antecedentes relacionados a la consulta --}}
							<div class="col-sm-12">
								<fieldset class="scheduler-border">
									<legend class="scheduler-border">Antecedentes relacionados a la consulta</legend>
									{{ Form::textarea('antecedentes_consulta', null, ['class'=>'form-control input-sm', 'rows'=>3] )}}
								</fieldset>
							</div>

						</div>
					</div>

					{{-- tab_2 Diagnostico --}}
					<div class="tab-pane" id="tab_2">
							<div class="row">
								{{-- Diagnostico--}}
								<div class="col-sm-12">
									<fieldset class="scheduler-border">
										<legend class="scheduler-border">Diagnostico</legend>
										<div class="row">
											<div class="col-sm-12">
												<div class="row" style="margin-bottom:10px;">
													<div class="col-sm-2"> 
														Diagnostico
														<a href="#" class="btn btn-xs btn-default btn-seleccionar-diagnostico"> <i class="fa fa-search"></i></a>
													</div>
													<div class="col-sm-2">
														{{ Form::text('', null, ['class'=>'form-control'])}}
													</div>
													<div class="col-sm-8">
														{{ Form::text('', null, ['class'=>'form-control'])}}
													</div>
												</div>

												<div class="row" style="margin-bottom:10px;">
								
													<div class="col-sm-6">
														<div class="input-group">
															<span class="input-group-addon">Tipo Diagnostico</span>
															{{ Form::select('cbx_id_tipo_diagnostico', [], null, ['class'=>'form-control', 'style'=>'width:100%'])}}
														</div>
													</div>
													<div class="col-sm-5">
														<div class="input-group">
															<span class="input-group-addon">Lab (HIS)</span>
															{{ Form::select('cbx_lab_his', [], null, ['class'=>'form-control', 'style'=>'width:100%'])}}
														</div>
													</div>
													<div class="col-sm-1"> 
														<a href="#" class="btn btn-sm btn-default btn-block"> <i class="fa fa-plus"></i></a>
													</div>
												</div>

											</div>
											<div class="col-sm-12">

											</div>
											<div class="col-sm-12">
												<table class="table table-condensed table-hover" style="margin-bottom:0px;">
													<thead>
														<tr class="bg-purple disabled">
															<td>Tipo diagnostico</td>
															<td>CIE</td>
															<td>Descripcion</td>
															<td>Lab (HIS)</td>
															<td></td>
														</tr>
													</thead>
													<tbody>
														{{-- class=tbody_diagnostico_lista --}}
													</tbody>
												</table>
											</div>
										</div>
									</fieldset>
								</div>
								
								{{-- Informacion adicional del paciente --}}
								<div class="col-sm-12">
									<fieldset class="scheduler-border">
										<legend class="scheduler-border">Informacion adicional del paciente</legend>
										<div class="row">
											<div class="col-sm-10">
												{{ Form::textarea('diagnostico-informacion', null, ['class'=>'form-control input-sm', 'rows'=>3] )}}
											</div>
											<div class="col-sm-2">
												<label for="">N° Hijos</label>
												{{ Form::text('diagnostico_num_hijos', null, ['class'=>'form-control']) }}
											</div>
										</div>
									</fieldset>
								</div>

								{{-- Condicion del paciente --}}
								<div class="col-sm-12">
										<fieldset class="scheduler-border">
											<legend class="scheduler-border">Condicion del paciente</legend>
											<div class="row">

												<div class="col-sm-6">
													<div class="input-group">
														<span class="input-group-addon">En el estab.</span>
														{{ Form::select('cbx_id_condicion_establecimiento', [], null, ['class'=>'form-control', 'style'=>'width:100%'])}}
													</div>
												</div>
												<div class="col-sm-6">
													<div class="input-group">
														<span class="input-group-addon">En el servicio</span>
														{{ Form::select('cbx_id_condicion_servicio', [], null, ['class'=>'form-control', 'style'=>'width:100%'])}}
													</div>
												</div>

											</div>
										</fieldset>
									</div>

								<div class="col-sm-12">
									<fieldset class="scheduler-border" style="margin-top:10px;">
										<legend class="scheduler-border">Otros CPT <a href="" class="btn btn-xs btn-default"> <i class="fa fa-search"></i></a> </legend>
										<table class="table table-hover table-condensed" style="maring-bottom: 0px;">
											<thead>
												<tr class="bg-purple disabled">
													<td>Codigo</td>
													<td>Nombre</td>
													<td>Cantidad</td>
													<td>Precio</td>
													<td>Total</td>
												</tr>
											</thead>
											<tbody class="tbody_diagnostico_cpt">
												{{-- class='tbody_diagnostico_cpt' --}}
											</tbody>
										</table>
									</fieldset>
								</div>
							</div>
					</div>

					{{-- tab_3 Ordenes --}}
					<div class="tab-pane" id="tab_3">
						<div class="row">
							{{-- Farmacia --}}
							<div class="col-sm-12">
								<fieldset class="scheduler-border">
									<legend class="scheduler-border">Farmacia</legend>
									<table class="table table-hover table-condensed" style="margin-bottom:0px;">
										<thead>
											<tr class="bg-purple disabled">
												<td>Medicamento/Insumo</td>
												<td>Cantidad</td>
												<td>N°Dosis</td>
												<td>HaySado</td>
												<td width="30">
													<input type="hidden" class="context" value="farmacia">
													<a href="#" class="btn btn-xs btn-default {{$model}}-btn-buscar-procedimiento"> <i class="fa fa-plus"></i></a>
												</td>
											</tr>
										</thead>
										<tbody class="tbody_farmacia">
											<tr>
												<td>Med 001</td>
												<td>10</td>
												<td>2</td>
												<td>Si</td>
												<td>
													<a href="" class="btn btn-xs btn-default"> <i class="fa fa-close"></i></a>
												</td>
											</tr>
										</tbody>
									</table>
								</fieldset>
							</div>

							<div class="col-sm-6">
								<div class="row">
									{{-- Rayos X --}}
									<div class="col-sm-12">
										<fieldset class="scheduler-border">
											<legend class="scheduler-border">Rayos X</legend>
											<table class="table table-hover table-condensed"  style="margin-bottom:0px;">
												<thead>
													<tr class="bg-purple disabled">
														<td>Procedimiento</td>
														<td>Cant</td>
														<td>Hay</td>
														<td width="30">
															<input type="hidden" class="context" value="rayos">
															<a href="#" class="btn btn-xs btn-default {{$model}}-btn-buscar-procedimiento"> <i class="fa fa-plus"></i></a>
														</td>
													</tr>
												</thead>
												<tbody class="tbody_rayos">
													<tr>
														<td>Med 001</td>
														<td>10</td>
														<td>Si</td>
														<td>
															<a href="" class="btn btn-xs btn-default btn-quitar-proc-rayos-x"> <i class="fa fa-close"></i></a>
														</td>
													</tr>
												</tbody>
											</table>
										</fieldset>
									</div>

									{{-- Ecografia Obstétrica --}}
									<div class="col-sm-12">
										<fieldset class="scheduler-border">
											<legend class="scheduler-border">Ecografia Obstétrica</legend>
											<table class="table table-hover table-condensed" style="margin-bottom:0px;">
												<thead>
													<tr class="bg-purple disabled">
														<td>Procedimiento</td>
														<td>Cant</td>
														<td>Hay</td>
														<td width="30">
															<input type="hidden" class="context" value="ecografia_obstetrica">
															<a href="#" class="btn btn-xs btn-default {{$model}}-btn-buscar-procedimiento"> <i class="fa fa-plus"></i></a>
														</td>
													</tr>
												</thead>
												<tbody class="tbody_ecografia_obstetrica">
													<tr>
														<td>Med 001</td>
														<td>10</td>
														<td>Si</td>
														<td>
															<a href="" class="btn btn-xs btn-default btn-quitar-proc-ecografia-obstetrica"> <i class="fa fa-close"></i></a>
														</td>
													</tr>
												</tbody>
											</table>
										</fieldset>
									</div>

									{{-- Ecografia General --}}
									<div class="col-sm-12">
										<fieldset class="scheduler-border">
											<legend class="scheduler-border">Ecografia General</legend>
											<table class="table table-hover table-condensed" style="margin-bottom:0px;">
												<thead>
													<tr class="bg-purple disabled">
														<td>Procedimiento</td>
														<td>Cant</td>
														<td>Hay</td>
														<td width="30">
															<input type="hidden" class="context" value="ecografia_general">
															<a href="#" class="btn btn-xs btn-default {{$model}}-btn-buscar-procedimiento"> <i class="fa fa-plus"></i></a>
														</td>
													</tr>
												</thead>
												<tbody class="tbody_ecografia_general">
													<tr>
														<td>Med 001</td>
														<td>10</td>
														<td>Si</td>
														<td>
															<a href="" class="btn btn-xs btn-default btn-quitar-proc-ecografia-general"> <i class="fa fa-close"></i></a>
														</td>
													</tr>
												</tbody>
											</table>
										</fieldset>
									</div>

									{{-- Tomografia --}}
									<div class="col-sm-12">
										<fieldset class="scheduler-border">
											<legend class="scheduler-border">Tomografía</legend>
											<table class="table table-hover table-condensed" style="margin-bottom:0px;">
												<thead>
													<tr class="bg-purple disabled">
														<td>Procedimiento</td>
														<td>Cant</td>
														<td>Hay</td>
														<td width="30">
															<input type="hidden" class="context" value="tomografia">
															<a href="#" class="btn btn-xs btn-default {{$model}}-btn-buscar-procedimiento"> <i class="fa fa-plus"></i></a>
														</td>
													</tr>
												</thead>
												<tbody class="tbody_tomografia">
													<tr>
														<td>Med 001</td>
														<td>10</td>
														<td>Si</td>
														<td>
															<a href="" class="btn btn-xs btn-default btn-quitar-proc-tomografia"> <i class="fa fa-close"></i></a>
														</td>
													</tr>
												</tbody>
											</table>
										</fieldset>
									</div>
								</div>
							</div>

							<div class="col-sm-6">
								<div class="row">
									{{-- Patologia Clinica --}}
									<div class="col-sm-12">
										<fieldset class="scheduler-border">
											<legend class="scheduler-border">Patología Clínica</legend>
											<table class="table table-hover table-condensed" style="margin-bottom:0px;">
												<thead>
													<tr class="bg-purple disabled">
														<td>Procedimiento</td>
														<td>Cant</td>
														<td>Hay</td>
														<td width="30">
															<input type="hidden" class="context" value="patologia_clinica">
															<a href="#" class="btn btn-xs btn-default {{$model}}-btn-buscar-procedimiento"> <i class="fa fa-plus"></i></a>
														</td>
													</tr>
												</thead>
												<tbody class="tbody_patologia_clinica">
													<tr>
														<td>Med 001</td>
														<td>10</td>
														<td>Si</td>
														<td>
															<a href="" class="btn btn-xs btn-default btn-quitar-proc-patologia-clinica"> <i class="fa fa-close"></i></a>
														</td>
													</tr>
												</tbody>
											</table>
										</fieldset>
									</div>

									{{-- Anatomía Patológica --}}
									<div class="col-sm-12">
										<fieldset class="scheduler-border">
											<legend class="scheduler-border">Anatomía Patológica</legend>
											<table class="table table-hover table-condensed" style="margin-bottom:0px;">
												<thead>
													<tr class="bg-purple disabled">
														<td>Procedimiento</td>
														<td>Cant</td>
														<td>Hay</td>
														<td width="30">
															<input type="hidden" class="context" value="anatomia_patologica">
															<a href="#" class="btn btn-xs btn-default {{$model}}-btn-buscar-procedimiento"> <i class="fa fa-plus"></i></a>
														</td>
													</tr>
												</thead>
												<tbody class="tbody_anatomia_patologica">
													<tr>
														<td>Med 001</td>
														<td>10</td>
														<td>Si</td>
														<td>
															<a href="" class="btn btn-xs btn-default btn-quitar-proc-anatomia-patologica"> <i class="fa fa-close"></i></a>
														</td>
													</tr>
												</tbody>
											</table>
										</fieldset>
									</div>

									{{-- Banco de sangre --}}
									<div class="col-sm-12">
										<fieldset class="scheduler-border">
											<legend class="scheduler-border">Banco de Sangre</legend>
											<table class="table table-hover table-condensed" style="margin-bottom:0px;">
												<thead>
													<tr class="bg-purple disabled">
														<td>Procedimiento</td>
														<td>Cant</td>
														<td>Hay</td>
														<td width="30">
															<input type="hidden" class="context" value="banco_sangre">
															<a href="#" class="btn btn-xs btn-default {{$model}}-btn-buscar-procedimiento"> <i class="fa fa-plus"></i></a>
														</td>
													</tr>
												</thead>
												<tbody class="tbody_banco_sangre">
													<tr>
														<td>Med 001</td>
														<td>10</td>
														<td>Si</td>
														<td>
															<a href="" class="btn btn-xs btn-default btn-quitar-proc-banco-sangre"> <i class="fa fa-close"></i></a>
														</td>
													</tr>
												</tbody>
											</table>
										</fieldset>
									</div>

								</div>
							</div>

						</div>
					</div>

					{{-- tab_4 Tratamiento --}}
					<div class="tab-pane" id="tab_4">
						<div class="row">
							{{-- Indicaciones del Tratamiento --}}
							<div class="col-sm-6">
									<fieldset class="scheduler-border">
										<legend class="scheduler-border">Indicaciones del Tratamiento</legend>
										{{ Form::textarea('tratamiento_indicaciones', null, ['class'=>'form-control input-sm', 'rows'=>10] )}}
									</fieldset>
								</div>
	
							{{-- Otras Observaciones --}}
							<div class="col-sm-6">
								<fieldset class="scheduler-border">
									<legend class="scheduler-border">Otras Observaciones</legend>
									{{ Form::textarea('tratamiento_observaciones', null, ['class'=>'form-control input-sm', 'rows'=>10] )}}
								</fieldset>
							</div>
						</div>
					</div>

					{{-- tab_5 Destino --}}
					<div class="tab-pane" id="tab_5">
						<div class="row">
							
							{{-- Cita (calendario) --}}
							<div class="col-sm-6">
									<fieldset class="scheduler-border">
										<legend class="scheduler-border">Cita</legend>

										<div class="row" style="margin-bottom:10px;">
											<div class="col-sm-3">Alta definiva</div>
											<div class="col-sm-9">{{ Form::checkbox('cita_alta_definitiva', 1, false) }}</div>
										</div>

										<div class="row" style="margin-bottom:10px;">
											<div class="col-sm-3">Destino</div>
											<div class="col-sm-9">{{ Form::select('cbx_id_destino_atencion', [], null, ['class'=>'form-control', 'style'=>'width:100%']) }}</div>
										</div>

										<div class="row" style="margin-bottom:10px;">
											<div class="col-sm-3">Proxima cita</div>
											<div class="col-sm-9">{{ Form::text('cita_proxima', null, ['class'=>'form-control'] ) }}</div>
										</div>

										<div class="row" style="margin-bottom:10px;">
											<div class="col-sm-12">{{ Form::date('cita_fecha', null, ['class'=>'form-control']) }}</div>
										</div>
									</fieldset>
								</div>
	
							
							{{-- Referencia y Episodio --}}
							<div class="col-sm-6">
								<div class="row">
									<div class="col-sm-12">
										<fieldset class="scheduler-border">
											<legend class="scheduler-border">Destino de referencia</legend>
											<div class="row" style="margin-bottom:10px;">
												<div class="col-sm-4">Tipo Referencia</div>
												<div class="col-sm-8"> {{ Form::select('cbx_id_tipo_referencia_destino', [], null, ['class'=>'form-control', 'style'=>'width:100%']) }}</div>
											</div>
											<div class="row" style="margin-bottom:10px;">
												<div class="col-sm-4">Estado Ref. <a href="#" class="btn btn-xs btn-default {{$model}}-btn-buscar-establecimiento"><i class="fa fa-search"></i> </a></div>
												

												<div class="col-sm-8">
													<table>
														<tr>
															<td width="50">{{ Form::text('referencia_estado', null, ['class'=>'form-control']) }} </td>
															<td>{{ Form::text('referencia_estado', null, ['class'=>'form-control']) }} <td>
														</tr>
													</table>
													
												</div>
												
												
												
											</div>
										</fieldset>
									</div>
									<div class="col-sm-12">
										<fieldset class="scheduler-border">
											<legend class="scheduler-border">Episodio Clinico</legend>
											<div class="row">
												<div class="col-sm-4">Episodio Clinico</div>
												<div class="col-sm-8"> {{ Form::select('cbx_episodios_historicos', [], null, ['class'=>'form-control', 'style'=>'width:100%']) }}</div>
											</div>
											<div class="row">
												<div class="col-sm-4">Nuevo Episodio</div>
												<div class="col-sm-8"> {{ Form::checkbox('episodio_nuevo', 1, false) }}</div>
											</div>
											<div class="row">
												<div class="col-sm-4">Cierre de Episodio</div>
												<div class="col-sm-8"> {{ Form::checkbox('episodio_cierre', 1, false) }}</div>
											</div>
										</fieldset>
									</div>
								</div>
							</div>
						</div>
					</div>

				</div>
				<!-- /.tab-content -->
				</div>
		</div>
	
		<div class="col-sm-12">
			<div class="pull-right">
				<a href="" class="btn btn-sm btn-default {{$model}}-btn-cancel" data-dismiss="modal"> CANCELAR</a>
				<button type="submit" class="btn btn-sm btn-primary {{$model}}-btn-store">CREAR</button>
			</div>
		</div>
	</div>
{{ Form::close() }}