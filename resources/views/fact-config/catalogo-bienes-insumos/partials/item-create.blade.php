@php
	$model = 'catalogoBienesInsumos';
@endphp

{{  Form::open(['route' => ['fact-config.catalogo-bienes-insumos.store'], 'method'=>'POST', 'id'=>$model.'-form']) }}
	<div class="row">
		<div class="col-sm-6">
			<div class="box box-solid">
				<div class="box-header with-border">
					Datos Generales
				</div>
				<div class="box-body clearfix">
					<div class="row">
							<div class="col-sm-4">{{ Form::label('codigo', 'Codigo (*)') }}</div>
							<div class="col-sm-5">{{ Form::text('codigo', null, ['class'=>'form-control input-sm', 'autocomplete'=>'off']) }}</div>
							<div class="col-sm-4">{{Form:: label('nombre','Nombre  (d+p+c+f)')}}</div>
							<div class="col-sm-8">{{Form:: text ('nombre', null,  ['class'=>'form-control input-sm'])}}</div>

							<div class="col-sm-4">{{Form:: label ('nombreComercial', 'Nombre Comercial')}}</div>
							<div class="col-sm-8">{{Form:: text ('nombreComercial', null, ['class'=>'form-control input-sm'])}}</div>

							<div class="col-sm-4">{{Form:: label ('denominacion', 'Denominacion (d)')}}</div>
							<div class="col-sm-8">{{Form:: text ('denominacion', null, ['class'=>'form-control input-sm']) }}</div>

							<div class="col-sm-4">{{Form:: label ('presentacion', 'Presentacion (p)')}}</div>
							<div class="col-sm-8">{{Form:: text ('presentacion', null, ['class'=> 'form-control input-sm '])}}</div>

							<div class="col-sm-4">{{Form:: label ('concentracion', 'Concentración(c)')}}</div>
							<div class="col-sm-8">{{Form:: text ('concentracion', null, ['class'=>'form-control input-sm'])}}</div>

							<div class="col-sm-4">{{Form:: label ('formaFarm', 'Forma Farmacéut(f)')}}</div>
							<div class="col-sm-8">{{Form:: text ('formafarm', null, ['class'=>'form-control input-sm'])}}</div>

							<div class="col-sm-4">{{Form:: label ('formaFarm', 'Forma')}}</div>
							<div class="col-sm-8">{{Form:: text ('formafarm', null, ['class'=>'form-control input-sm'])}}</div>

							<div class="col-sm-4">{{Form:: label ('paisOrigen', 'Pais Origen')}}</div>
							<div class="col-sm-8">{{Form:: text ('paisOrigen', null, ['class'=>'form-control input-sm'])}}</div>

							<div class="col-sm-4">{{Form:: label ('materialEnvase', 'Materia de Envase')}}</div>
							<div class="col-sm-8">{{Form:: text ('materialEnvase', null, ['class'=>'form-control input-sm'])}}</div>

							<div class="col-sm-4">{{Form:: label ('presentacionEnvase', 'Present. Envase')}}</div>
							<div class="col-sm-8">{{Form:: text ('presentacionEnvase', null, ['class'=>'form-control input-sm'])}}</div>

							<div class="col-sm-4">{{Form:: label ('fabricante', 'Fabricante')}}</div>
							<div class="col-sm-8">{{Form:: text ('fabricante', null, ['class'=>'form-control input-sm'])}}</div>

							<div class="col-sm-4">{{Form:: label ('petitorio', 'Petitorio')}}</div>
							<div class="col-sm-8">{{Form:: text ('petitorio', null, ['class'=>'form-control input-sm'])}}</div>

							<div class="col-sm-4">{{Form:: label ('grupo', 'Grupo')}}</div>
							<div class="col-sm-8">{{Form:: text ('Grupo', null, ['class'=>'form-control input-sm'])}}</div>

							<div class="col-sm-4">{{Form:: label ('subGrupo', 'Sub Grupo')}}</div>
							<div class="col-sm-8">{{Form:: text ('subGrupo', null, ['class'=>'form-control input-sm'])}}</div>

							<div class="col-sm-4">{{Form:: label ('centroCosto', 'Centro de Costos')}}</div>
							<div class="col-sm-8">{{Form:: text ('centroCosto', null, ['class'=>'form-control input-sm'])}}</div>

							<div class="col-sm-4">{{Form:: label ('partida', 'Partida')}}</div>
							<div class="col-sm-8">{{Form:: text ('partida', null, ['class'=>'form-control input-sm'])}}</div>

					</div>
				</div>
			</div>
		</div>
		<div class="col-sm-6">
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
									<td>Producto /Plans</td>
									<td width="50">Pr.Vent</td>
									<td width="50">Pr.Dist</td>
									<td width="50">Pr.Comp</td>
									<td width="50">Pr.Dona</td>
								</tr>
							</thead>
							<tbody class="tbody-precios">
								
							</tbody>
						</table>
					</div>
				</div>
				<!-- /.box-body -->
			</div>
		</div>
		
	</div>

	<div class='row'>
		<div class="col-sm-6">
			<div class="box box-solid">
				<div class="box-header with-border">
					Grupo Farmacológico
				</div>
				<div class="box-body clearfix">
					<div class="row">
						
							<div class="col-sm-4">{{Form:: label ('grupo', 'Grupo')}}</div>
							<div class="col-sm-8">{{Form:: text ('Grupo', null, ['class'=>'form-control input-sm'])}}</div>

							<div class="col-sm-4">{{Form:: label ('subGrupo', 'Sub Grupo')}}</div>
							<div class="col-sm-8">{{Form:: text ('subGrupo', null, ['class'=>'form-control input-sm'])}}</div>

							<div class="col-sm-4">{{Form:: label ('centroCosto', 'Centro de Costos')}}</div>
							<div class="col-sm-8">{{Form:: text ('centroCosto', null, ['class'=>'form-control input-sm'])}}</div>

							<div class="col-sm-4">{{Form:: label ('partida', 'Partida')}}</div>
							<div class="col-sm-8">{{Form:: text ('partida', null, ['class'=>'form-control input-sm'])}}</div>

					</div>
				</div>
			</div>
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