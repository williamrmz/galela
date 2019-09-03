@php
	$model = 'archiveros';
@endphp

{{  Form::open(['route' => ['archivo-clinico.archiveros.destroy', 0], 'method'=>'DELETE', 'id'=>$model.'-form']) }}
	<div class="box box-primary" style="margin-bottom: 0px;">
		
		<!-- /.box-header -->
		<div class="box-body" >
			<div class="row">
				{{-- Archivo --}}
				<div class="col-sm-12 form-group">
					<div class="row">
						<div class="col-sm-3">
							<a href="" class="btn btn-sm btn-block btn-default btn-archivero disabled"> Archivero <i class="fa fa-search"></i></a>
						</div>
						<div class="col-sm-3">
							{{ Form::hidden('idEmpleado', null, ['id'=>'idEmpleado']) }}
							{{ Form::text('codigoEmpleado', null, ['class'=>'form-control', 'id'=>'codigoEmpleado', 'readonly']) }}
						</div>
						<div class="col-sm-6">
							{{ Form::text('nombreEmpleado', null, ['class'=>'form-control', 'id'=>'nombreEmpleado', 'readonly']) }}
						</div>
					</div>
				</div>
		
				{{-- Servicio --}}
				<div class="col-sm-12 form-group">
					<div class="row">
						<div class="col-sm-3">
							<a href="" class="btn btn-sm btn-block btn-default btn-servicio disabled"> Servicio <i class="fa fa-search"></i></a>
						</div>
						<div class="col-sm-3">
							{{ Form::hidden('idServicio', null, ['id'=>'idServicio']) }}
							{{ Form::text('codigoServicio', null, ['class'=>'form-control', 'id'=>'codigoServicio', 'readonly']) }}
						</div>
						<div class="col-sm-6">
							<div class="input-group">
								{{ Form::text('nombreServicio', null, ['class'=>'form-control', 'id'=>'nombreServicio', 'readonly']) }}
								<a href="#" class="input-group-addon btn-agregar-servicio btn disabled"> <i class="fa fa-plus"></i></a>
							</div>
							
						</div>
					</div>
				</div>
		
				{{-- Lista Servicios --}}
				<div class="col-sm-12">
					<div style="width: 100%; height: 250px; overflow-y: scroll;">
						<table class="table table-striped table-condensed table-hover" >
							<thead>
								<tr style="font-weight:bold;">
									<td width="100">Codigo</td>
									<td>Servicios</td>
									<td width="30"></td>
								</tr>
							</thead>
							<tbody class="tbody-servicios">
								{{-- <tr>
									<td>123</td>
									<td>Servicio 01</td>
									<td align="center">
										<a href="#" class="btn btn-xs btn-default"> <i class="text-red fa fa-close"></i></a>
									</td>
								</tr> --}}
							</tbody>
						</table>
					</div>
				</div>
			
				<div class="col-sm-12">
					<div class="pull-right">
						<a href="" class="btn btn-sm btn-default {{$model}}-btn-cancel" data-dismiss="modal"> CANCELAR</a>
						<a href="#" class="btn btn-sm btn-danger {{$model}}-btn-destroy" id="{{$model}}-btn-destroy">ELIMINAR</a>
					</div>
				</div>
			</div>
		</div>
	</div>
	
{{ Form::close() }}