@php
	$model = 'roles';
	// dd($item);
@endphp

{{  Form::open(['route' => ['seguridad.roles.show', $item->IdRol], 'method'=>'GET', 'id'=>$model.'-form']) }}
	<div class="row">
		{{ Form::hidden('idRol', $item->IdRol ) }}
		<div class="col-sm-12 form-group">
			{{ Form::text('nombreRol', $item->Nombre, ['class'=>'form-control']) }}
		</div>

		<div class="col-sm-12 form-group">
			<div class="nav-tabs-custom">
				<ul class="nav nav-tabs">
					<li class="active"><a href="#tab_modulos" data-toggle="tab">Modulos</a></li>
					<li><a href="#tab_permisos" data-toggle="tab">Permisos</a></li>
					<li><a href="#tab_reportes" data-toggle="tab">Reportes</a></li>
					<li class="pull-right"><a href="#" class="text-muted"><i class="fa fa-gear"></i></a></li>
				</ul>
				<div class="tab-content">
					<div class="tab-pane active" id="tab_modulos">
						<div class="row">
							<div class="col-sm-12">
								<div class="row">
									<div class="col-md-6 col-sm-12">
										{{ Form::select('lista_modulos', [], null, ['class'=>'form-control lista-modulos', 'style'=>'width: 100%;'] ) }}
									</div>
									<div class="col-md-1 col-sm-12">
										<div class="checkbox" disabled>
											<label><input type="checkbox" class="chk-modulo-agregar" disabled>agregar</label>
										</div>
									</div>
									<div class="col-md-1 col-sm-12">
										<div class="checkbox">
											<label><input type="checkbox" class="chk-modulo-modificar" disabled>modificar</label>
										</div>	
									</div>
									<div class="col-md-1 col-sm-12">
										<div class="checkbox">
											<label><input type="checkbox" class="chk-modulo-consultar" disabled>consultar</label>
										</div>
									</div>
									<div class="col-md-1 col-sm-12">
										<div class="checkbox">
											<label><input type="checkbox" class="chk-modulo-eliminar" disabled>eliminar</label>
										</div>
									</div>
									<div class="col-md-2 col-sm-12">
										<a href="#" class="btn btn-sm btn-default btn-block btn-agregar-modulo disabled"> <i class="fa fa-plus"></i> ADD </a>
									</div>
								</div>
							</div>
							<div class="col-sm-12">
								<div style="width: 100%; height: 250px; overflow-y: scroll;">
									<table class="table table-stripted table-hover table-bordered">
										<thead>
											<tr class="bg-primary disabled">
												<td align="center">SubModulo</td>
												<td align="center">Modulo</td>
												<td align="center">Agregar</td>
												<td align="center">Modificar</td>
												<td align="center">Consultar</td>
												<td align="center">Eliminar</td>
												<td width="40"></td>
											</tr>
										</thead>
										<tbody class="tbody-modulos">
											{{-- <tr>
												<td>Lab Config</td>
												<td>Lab</td>
												<td> {{ Form::checkbox('agregar', 1, true) }} </td>
												<td> {{ Form::checkbox('modificar', 1, true) }} </td>
												<td> {{ Form::checkbox('consultar', 1, true) }} </td>
												<td> {{ Form::checkbox('eliminar', 1, true) }} </td>
												<td> <a href="#" class="btn btn-xs btn-default btn-quitar-modulo"> <i class="text-red fa fa-close"></i></a> </td>
											</tr> --}}
										</tbody>
									</table>
								</div>
								
							</div>
						</div>
					</div>
					<!-- /.tab-pane -->
					<div class="tab-pane" id="tab_permisos">
						<div class="row">
							<div class="col-sm-12">
								<div class="row">
									<div class="col-md-6 col-sm-12">
										{{ Form::select('lista_permisos', [], null, ['class'=>'form-control lista-permisos', 'style'=>'width: 100%;'] ) }}
									</div>
									
									<div class="col-md-2 col-sm-12 col-md-offset-4">
										<a href="#" class="btn btn-sm btn-default btn-block btn-agregar-permiso disabled"> <i class="fa fa-plus"></i> ADD </a>
									</div>
								</div>
							</div>
							<div class="col-sm-12" style="margin-top:5px;">
								<div style="width: 100%; height: 250px; overflow-y: scroll;">
									<table class="table table-stripted table-hover table-bordered">
										<thead>
											<tr class="bg-primary disabled">
												<td align="center">Descripcion</td>
												<td width="40"></td>
											</tr>
										</thead>
										<tbody class="tbody-permisos">
											{{-- <tr>
												<td>hola...</td>
												<td> <a href="#" class="btn btn-xs btn-default btn-quitar-permiso"> <i class="text-red fa fa-close"></i></a> </td>
											</tr> --}}
										</tbody>
									</table>
								</div>
							</div>
						</div>
					</div>
					<!-- /.tab-pane -->
					<div class="tab-pane" id="tab_reportes">
						<div class="row">
							<div class="col-sm-12">
								<div class="row">
									<div class="col-md-6 col-sm-12">
										{{ Form::select('lista-reportes', [], null, ['class'=>'form-control lista-reportes', 'style'=>'width: 100%;'] ) }}
									</div>
									<div class="col-md-2 col-sm-12">
										<div class="checkbox">
											<label><input type="checkbox" class="chk-reporte-todos" disabled>Todos</label>
										</div>
									</div>
									<div class="col-md-2 col-sm-12">
										<div class="checkbox">
											<label><input type="checkbox" class="chk-reporte-ninguno" disabled>Ninguno</label>
										</div>	
									</div>
									<div class="col-md-2 col-sm-12">
										<a href="#" class="btn btn-sm btn-default btn-block btn-agregar-reporte disabled"> <i class="fa fa-plus"></i> ADD </a>
									</div>
								</div>
							</div>
							<div class="col-sm-12">
								<div style="width: 100%; height: 250px; overflow-y: scroll;">
									<table class="table table-stripted table-hover table-bordered">
										<thead>
											<tr class="bg-primary disabled">
												<td align="center">Reporte</td>
												<td align="center">Modulo</td>
												<td align="center">Tiene Acceso</td>
												<td width="40"></td>
											</tr>
										</thead>
										<tbody class="tbody-reportes">
											{{-- <tr>
												<td>Lab Config</td>
												<td>Lab</td>
												<td> {{ Form::checkbox('agregar', 1, true) }} </td>
												<td> <a href="#" class="btn btn-xs btn-default btn-quitar-reporte"> <i class="text-red fa fa-close"></i></a> </td>
											</tr> --}}
										</tbody>
									</table>
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
			<div class="pull-right">
				<a href="" class="btn btn-sm btn-default {{$model}}-btn-cancel" data-dismiss="modal"> CANCELAR</a>
				{{-- <button type="submit" class="btn btn-sm btn-danger {{$model}}-btn-destroy">ELIMINAR</button> --}}
			</div>
		</div>
	</div>
{{ Form::close() }}