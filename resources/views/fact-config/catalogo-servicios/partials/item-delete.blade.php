@php
	$model = 'catalogoServicios';
@endphp

{{  Form::open(['route' => ['fact-config.catalogo-servicios.destroy', $item->IdProducto], 'method'=>'DELETE', 'id'=>$model.'-form']) }}
	<div class="row">

		<div class="col-sm-12">
			<div class="box box-solid">
				<div class="box-header with-border">
					Datos Generales
					<input type="hidden" id="idProducto" value="{{ $item->IdProducto }}">
					<input type="hidden" id="idServicioGrupoTmp" value="{{ $item->IdServicioGrupo }}">
					<input type="hidden" id="idServicioSubGrupoTmp" value="{{ $item->IdServicioSubGrupo }}">
					<input type="hidden" id="idServicioSeccionTmp" value="{{ $item->IdServicioSeccion }}">
					<input type="hidden" id="idServicioSubSeccionTmp" value="{{ $item->IdServicioSubSeccion }}">
					<input type="hidden" id="idCentroCostoTmp" value="{{ $item->IdCentroCosto }}">
					<input type="hidden" id="idPartidaTmp" value="{{ $item->IdPartida }}">
				</div>
				<!-- /.box-header -->
				<div class="box-body clearfix">
					<div class="row">
						<div class="col-sm-4">
							<table class="" style="width:100%;">
								<tr>
									<td>{{ Form::label('codigo', 'Codigo') }}</td>
									<td>{{ Form::text('codigo', $item->Codigo, ['class'=>'form-control input-sm', 'readonly']) }}</td>
								</tr>
								<tr>
									<?php $tipoServicio = $item->EsCPT? 'S': 'I' ?>
									<td>{{ Form::label('tipoServicio', 'Servicio') }}</td>
									<td>{{ Form::select('tipoServicio', ['S'=>'Procedimiento CPT', 'I'=>'Insumo'], $tipoServicio, ['class'=>'form-control input-sm', 'disabled']) }}</td>
								</tr>
								<tr>
									<?php $estado = $item->idEstado? true: false;?>
									<td>{{ Form::label('estado', 'Estado') }}</td>
									<td>{{ Form::checkbox('estado', 1, $estado, ['disabled']) }}</td>
								</tr>
							</table>
						</div>
						<div class="col-sm-8">
							<table style="width:100%;">
								<tr>
									<td width="100">{{ Form::label('nombre', 'Nombre') }}</td>
									<td>{{ Form::text('nombre', $item->Nombre, ['class'=>'form-control input-sm', 'readonly']) }}</td>
								</tr>
								<tr>
									<td width="100">{{ Form::label('nombreMinsa', 'Nombre MINSA') }}</td>
									<td>{{ Form::text('nombreMinsa', $item->NombreMINSA, ['class'=>'form-control input-sm', 'disabled']) }}</td>
								</tr>
								<tr>
									<td width="100">{{ Form::label('codigoSis', 'Codigo SIS') }}</td>
									<td>{{ Form::text('codigoSis', $item->codigoSIS, ['class'=>'form-control input-sm', 'disabled']) }}</td>
								</tr>
							</table>
						</div>
					</div>
				</div>
				<!-- /.box-body -->
			</div>
					
		</div>

		{{-- Grupo y Presupuesto--}}
		<div class="col-sm-4">
			<div class="row">
				<div class="col-sm-12">
					<div class="box box-solid">
						<div class="box-header with-border">
							Grupo
						</div>
						<!-- /.box-header -->
						<div class="box-body clearfix">
							
							<table style="width:100%;">
								<tr>
									<td width="100">{{ Form::label('idServicioGrupo', 'Grupo') }}</td>
									<td>{{ Form::select('idServicioGrupo', [], null, ['class'=>'form-control input-sm', 'disabled']) }}</td>
								</tr>
								<tr>
									<td width="100">{{ Form::label('idServicioSubGrupo', 'Sub rupo') }}</td>
									<td>{{ Form::select('idServicioSubGrupo', [], null, ['class'=>'form-control input-sm', 'disabled']) }}</td>
								</tr>
								<tr>
									<td width="100">{{ Form::label('idServicioSeccion', 'Seccion') }}</td>
									<td>{{ Form::select('idServicioSeccion', [], null, ['class'=>'form-control input-sm', 'disabled']) }}</td>
								</tr>
								<tr>
									<td width="100">{{ Form::label('idServicioSubSeccion', 'Sub Seccion') }}</td>
									<td>{{ Form::select('idServicioSubSeccion', [], null, ['class'=>'form-control input-sm', 'disabled']) }}</td>
								</tr>
							</table>
						</div>
						<!-- /.box-body -->
					</div>
				</div>
				<div class="col-sm-12">
					<div class="box box-solid">
						<div class="box-header with-border">
							Presupuesto
						</div>
						<!-- /.box-header -->
						<div class="box-body clearfix">
							<table style="width:100%;">
								<tr>
									<td width="100">{{ Form::label('idCentroCosto', 'Centro costo') }}</td>
									<td>{{ Form::select('idCentroCosto', [], null, ['class'=>'form-control input-sm', 'disabled']) }}</td>
								</tr>
								<tr>
									<td width="100">{{ Form::label('idPartida', 'Partida') }}</td>
									<td>{{ Form::select('idPartida', [], null, ['class'=>'form-control input-sm', 'disabled']) }}</td>
								</tr>
							</table>
						</div>
						<!-- /.box-body -->
					</div>
				</div>
			</div>
		</div>

		{{-- punto de carga --}}
		<div class="col-sm-4"> 
			<div class="box box-solid">
				<div class="box-header with-border">
					Puntos de carga
				</div>
				<!-- /.box-header -->
				<div class="box-body clearfix">
					<div class="form-group">
						<div class="input-group">
							{{ Form::select('lista-puntos-carga', [], null, ['class'=>'form-control input-sm', 'id'=>'lista-puntos-carga', 'disabled']) }}
							<a href="#" class="input-group-addon btn-agregar-punto-carga"><i class="fa fa-plus"></i></a>
						</div>
					</div>

					<div style="width: 100%; height: 235px; overflow-y: scroll;">
						<table class="table table-condensed table-bordered">
							<thead>
								<tr align="center" style="font-weight:bold;"> 
									<td>Id</td><td>Descripcion</td><td>EsPreVenta</td> <td></td>
								</tr>
							</thead>
							<tbody class="tbody-puntos">
								{{-- <tr>
									<td>1</td>
									<td>Aislados</td>
									<td align="center"> {{Form::checkbox('esPreVenta[1][]', 1, false) }}</td>
									<td align="center"> <a href="#" class="btn btn-xs btn-default"> <i class="text-red fa fa-close"></i></a></td>
								</tr> --}}
							</tbody>
						</table>
					</div>
				</div>
				<!-- /.box-body -->
			</div>
		</div>

		{{-- Precios --}}
		<div class="col-sm-4">
			<div class="box box-solid">
				<div class="box-header with-border">
					Precios
				</div>
				<!-- /.box-header -->
				<div class="box-body clearfix">
					<div style="width: 100%; height: 280px; overflow-y: scroll;">
						<table class="table table-condensed table-bordered">
							<thead>
								<tr align="center" style="font-weight:bold;">
									<td>Producto /Plan</td>
									<td width="50">Precio Unidad</td>
									<td width="50">Usa Precio=0</td>
								</tr>
							</thead>
							<tbody class="tbody-precios">
								{{-- <tr>
									<td>Clínica Convenios</td>
									<td align="center"> {{Form::text('precio[1][]', 0, ['style'=>'width:40px; text-align:center;']) }}</td>
									<td align="center"> {{Form::checkbox('precioCero[1][]',1, false) }}</td>
								</tr>
								<tr>
									<td>Clínica Convenios</td>
									<td align="center"> {{Form::text('precio[1][]', 0, ['style'=>'width:40px; text-align:center;']) }}</td>
									<td align="center"> {{Form::checkbox('precioCero[1][]',1, false) }}</td>
								</tr> --}}
							</tbody>
						</table>
					</div>
				</div>
				<!-- /.box-body -->
			</div>
		</div>

		<div class="col-sm-12">
			<div class="pull-right">
				<a href="" class="btn btn-sm btn-default {{$model}}-btn-cancel" data-dismiss="modal"> CANCELAR</a>
				<button type="submit" class="btn btn-sm btn-danger {{$model}}-btn-destroy">ELIMINAR</button>
			</div>
		</div>
	</div>
{{ Form::close() }}