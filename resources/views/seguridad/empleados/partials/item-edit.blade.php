@php
	$model = 'empleados';
@endphp

{{  Form::open(['route' => ['seguridad.empleados.update', $item->IdEmpleado], 'method'=>'PUT', 'id'=>$model.'-form', 'autocomplete'=>'off']) }}
	<div class="row">
		<div class="col-sm-12">
			
			<div class="row">
				<div class="col-sm-6">
					<div class="box box-primary">
						<div class="box-header with-border">
							<h3 class="box-title">Empleado</h3>
							{{ Form::hidden('idEmpleado', $item->IdEmpleado, ['id'=>'idEmpleado']) }}
						</div>
						<!-- /.box-header -->
						<div class="box-body">
							<div class="row">
								<div class="col-sm-4"> {{ Form::label('codigoPlanilla', 'Codigo planilla') }}</div>
								<div class="col-sm-8"> {{ Form::text('codigoPlanilla', null, ['class'=>'form-control']) }} </div>

								<div class="col-sm-4"> {{ Form::label('idTipoDocumento', 'Documento') }} </div>
								<div class="col-sm-8"> 
									<div class="input-group">
										<span class="input-group-addon" style="padding:0; border:0;">
											{{ Form::select('idTipoDocumento', [], null, ['class'=>'form-control ', 'style'=>'width:150px;']) }}
										</span>
										{{ Form::text('dni', null, ['class'=>'form-control', 'id'=>'dni'] ) }}
									</div>
									
								</div>
								
								<div class="col-sm-4"> {{ Form::label('apellidoPaterno', 'Apellido paterno') }}</div>
								<div class="col-sm-8"> {{ Form::text('apellidoPaterno', null, ['class'=>'form-control']) }} </div>

								<div class="col-sm-4"> {{ Form::label('apellidoMaterno', 'Apellido materno') }}</div>
								<div class="col-sm-8"> {{ Form::text('apellidoMaterno', null, ['class'=>'form-control']) }} </div>

								<div class="col-sm-4"> {{ Form::label('nombres', 'Nombres') }}</div>
								<div class="col-sm-8"> {{ Form::text('nombres', null, ['class'=>'form-control']) }} </div>

								<div class="col-sm-4"> {{ Form::label('fechaNacimiento', 'Fecha nacimiento') }}</div>
								<div class="col-sm-8"> {{ Form::date('fechaNacimiento', null, ['class'=>'form-control']) }} </div>

								<div class="col-sm-4"> {{ Form::label('idTipoEmpleado', 'Tipo empleado') }}</div>
								<div class="col-sm-8"> {{ Form::select('idTipoEmpleado', [], null, ['class'=>'form-control', 'style'=>'width:100%;']) }}  </div>

								<div class="col-sm-4"> {{ Form::label('idCondicionTrabajo', 'Condicion trabajo') }}</div>
								<div class="col-sm-8"> {{ Form::select('idCondicionTrabajo', [], null, ['class'=>'form-control', 'style'=>'width:100%;']) }}  </div>

								<div class="col-sm-4"> {{ Form::label('idTipoDestacado', 'Tipo destacado') }}</div>
								<div class="col-sm-8"> {{ Form::select('idTipoDestacado', [], null, ['class'=>'form-control', 'style'=>'width:100%;']) }}  </div>

								<div class="col-sm-4"> {{ Form::label('idSupervisor', 'Supervisor (Galen)') }}</div>
								<div class="col-sm-8"> {{ Form::text('idSupervisor', null, ['class'=>'form-control']) }} </div>
								
								<div class="col-sm-4"> {{ Form::label('idEstablecimientoExterno', 'Cs, Ps externo donde labora (HisGalenhos)') }}</div>
								<div class="col-sm-8"> {{ Form::text('idEstablecimientoExterno', null, ['class'=>'form-control']) }} </div>

							</div>
						</div>
						<!-- /.box-body -->
					</div>
					
				</div>
				
				<div class="col-sm-6">
					<div class="row">
						<div class="col-sm-12">
							<div class="nav-tabs-custom">
								<ul class="nav nav-tabs">
									<li class="active"><a href="#tab_1" data-toggle="tab">Roles</a></li>
									<li><a href="#tab_2" data-toggle="tab">Cargos</a></li>
									<li><a href="#tab_3" data-toggle="tab">Labora</a></li>
								</ul>
								<div class="tab-content">
									<div class="tab-pane active" id="tab_1">
										<div class="row">
											<div class="col-sm-10">
												{{ Form::select('lista-roles', [], null, ['class'=>'form-control lista-roles', 'style'=>'width:100%']) }}
											</div>
											<div class="col-sm-2">
												<a href="" class="btn btn-sm btn-default btn-agregar-rol" title="agregar"> <i class="fa fa-fw fa-plus"></i> </a>
											</div>
											<div class="col-sm-12" style="margin-top:10px;">
												<div style="width: 100%; height: 140px; overflow-y: scroll;">
													<div class="table-responsive">
														<table class="table table-striped table-bordered" style="margin-top:0;">
															<thead>
																<tr style="font-weight:bold;">
																	<td width="30">#</td>
																	<td align="center">Roles</td>
																	<td width="30"></td>
																</tr>
															</thead>
															<tbody class="tbody-roles">
																{{-- <tr>
																	<td>1</td>
																	<td>Admin</td>
																	<td> <a href="btn btn-xs btn-default"> <i class="text-red fa fa-close"></i></a> </td>
																</tr> --}}
															</tbody>
														</table>
													</div>
												</div>
														
											</div>
										</div>
									</div>
									<!-- /.tab-pane -->
									<div class="tab-pane" id="tab_2">
										<div class="row">
											<div class="col-sm-10">
												{{ Form::select('lista-cargos', [], null, ['class'=>'form-control lista-cargos', 'style'=>'width:100%']) }}
											</div>
											<div class="col-sm-2">
												<a href="" class="btn btn-sm btn-default btn-agregar-cargo" title="agregar"> <i class="fa fa-fw fa-plus"></i> </a>
											</div>
											<div class="col-sm-12" style="margin-top:10px;">
												<div style="width: 100%; height: 140px; overflow-y: scroll;">
													<div class="table-responsive">
														<table class="table table-striped table-bordered" style="margin-top:0;">
															<thead>
																<tr style="font-weight:bold;">
																	<td width="30">#</td>
																	<td align="center">Cargos</td>
																	<td width="30"></td>
																</tr>
															</thead>
															<tbody class="tbody-cargos">
																{{-- <tr>
																	<td>1</td>
																	<td>Admin</td>
																	<td> <a href="btn btn-xs btn-default"> <i class="text-red fa fa-close"></i></a> </td>
																</tr> --}}
															</tbody>
														</table>
													</div>
												</div>
														
											</div>
										</div>
									</div>
									<!-- /.tab-pane -->
									<div class="tab-pane" id="tab_3">
										<div class="row">
											<div class="col-sm-5">
												{{ Form::select('lista-areas', [], null, ['class'=>'form-control lista-areas', 'style'=>'width:100%']) }}
											</div>
											<div class="col-sm-5" id="sub-areas">
												{{-- {{ Form::select('lista-sub-areas', [], null, ['class'=>'form-control lista-sub-areas']) }} --}}
											</div>
											<div class="col-sm-2">
												<a href="" class="btn btn-sm btn-default btn-agregar-area" title="agregar"> <i class="fa fa-fw fa-plus"></i> </a>
											</div>
											<div class="col-sm-12" style="margin-top:10px;">
												<div style="width: 100%; height: 140px; overflow-y: scroll;">
													<div class="table-responsive">
														<table class="table table-striped table-bordered" style="margin-top:0;">
															<thead>
																<tr style="font-weight:bold;">
																	<td width="30">#</td>
																	<td align="center">Area</td>
																	<td align="center">SubArea</td>
																	<td width="30"></td>
																</tr>
															</thead>
															<tbody class="tbody-lugares">
																{{-- <tr>
																	<td>1</td>
																	<td>Area1</td>
																	<td>SubArea2</td>
																	<td> <a href="btn btn-xs btn-default"> <i class="text-red fa fa-close"></i></a> </td>
																</tr> --}}
															</tbody>
														</table>
													</div>
												</div>
														
											</div>
										</div>
									</div>
									<!-- /.tab-pane -->
								</div>
								<!-- /.tab-content -->
							</div>
						</div>
						<div class="col-sm-12">
							<div class="box box-primary">
								<div class="box-header with-border">
									<h3 class="box-title">Usuario</h3>
								</div>
								<!-- /.box-header -->
								<div class="box-body">
									<div class="row">
										<div class="col-sm-5"> {{ Form::label('usuario', 'Usuario') }}</div>
										<div class="col-sm-7"> {{ Form::text('usuario', null, ['class'=>'form-control input-sm']) }} </div>

										<div class="col-sm-5"> {{ Form::label('clave', 'Clave') }}</div>
										<div class="col-sm-7"> {{ Form::password('clave',  ['class'=>'form-control input-sm']) }} </div>

										<div class="col-sm-5"> {{ Form::label('usaGalenhos', 'Esta usando Galenhos') }}</div>
										<div class="col-sm-7">
											<div class="input-group">
												<span class="input-group-addon"> {{ Form::checkbox('usaGalenhos', 1, false)}} </span>
												{{ Form::text('loginPc', null, ['class'=>'form-control input-sm ', 'readonly', 'id'=>'loginPc']) }}
											</div>
										</div>

										<div class="col-sm-5"> {{ Form::label('codigoDigitador', 'Codigo digitador (HIS)') }}</div>
										<div class="col-sm-7"> {{ Form::text('codigoDigitador', null, ['class'=>'form-control input-sm'])}} </div>

										<div class="col-sm-5"> {{ Form::label('reniecAutorizado', 'Autorizado por RENIEC') }}</div>
										<div class="col-sm-7"> {{ Form::checkbox('reniecAutorizado', 1, false, ['style'=>'margin-left: 13px'])}} </div>
									</div>
								</div>
							</div>
							
						</div>
					</div>
							
				</div>
			</div>

		</div>
	
		<div class="col-sm-12">
			<div class="pull-right">
				<a href="" class="btn btn-sm btn-default {{$model}}-btn-cancel" data-dismiss="modal"> CANCELAR</a>
				<button type="submit" class="btn btn-sm btn-success {{$model}}-btn-update">ACTUALIZAR</button>
			</div>
		</div>
	</div>
{{ Form::close() }}