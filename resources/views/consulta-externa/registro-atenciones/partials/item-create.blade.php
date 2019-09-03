@php
	$model = 'registroAtenciones';
@endphp

{{  Form::open(['route' => ['consulta-externa.registro-atenciones.store'], 'method'=>'POST', 'id'=>$model.'-form']) }}
	<div class="row">

		<div class="col-sm-12">
			<div class="row">
				<div class="col-sm-2 form-group">
					{{ Form::label('presion', 'Presion (Sist/Diast)') }}
					{{ Form::text('presion', null, ['class'=>'form-control'])}}
				</div>
				<div class="col-sm-2 form-group">
						{{ Form::label('temperatura', 'Temperatura (°C)') }}
						{{ Form::text('temperatura', null, ['class'=>'form-control'])}}
					</div>
				<div class="col-sm-2 form-group">
					{{ Form::label('peso', 'Peso (Kg)') }}
					{{ Form::text('peso', null, ['class'=>'form-control'])}}
				</div>
				<div class="col-sm-2 form-group">
					{{ Form::label('talla', 'Talla(cm)') }}
					{{ Form::text('talla', null, ['class'=>'form-control'])}}
				</div>
				<div class="col-sm-2 form-group">
					{{ Form::label('pulso', 'Pulso (0-250)') }}
					{{ Form::text('pulso', null, ['class'=>'form-control'])}}
				</div>
				<div class="col-sm-2 form-group">
					{{ Form::label('fCardiaca', 'F.Cardiaca (0-70)') }}
					{{ Form::text('fCardiaca', null, ['class'=>'form-control'])}}
				</div>
			</div>
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
					{{-- tab_1 --}}
					<div class="tab-pane active" id="tab_1">
						<div class="row">
							<div class="col-sm-12">
								<div class="box box-solid box-primary">
									<div class="box-header with-border">
										<h4 class="box-title">Antecedentes personales</h4>
									</div>
									<!-- /.box-header -->
									<div class="box-body clearfix">
										datos aki
									</div>
									<!-- /.box-body -->
								</div>
							</div>
							<div class="col-sm-6">
								<div class="box box-solid box-primary">
									<div class="box-header with-border">
										<h4 class="box-title">Motivo de la consulta</h4>
									</div>
									<!-- /.box-header -->
									<div class="box-body clearfix">
										datos aki
									</div>
									<!-- /.box-body -->
								</div>
							</div>

							<div class="col-sm-6">
								<div class="box box-solid box-primary">
									<div class="box-header with-border">
										<h4 class="box-title">Examen Fisico</h4>
									</div>
									<!-- /.box-header -->
									<div class="box-body clearfix">
										datos aki
									</div>
									<!-- /.box-body -->
								</div>
							</div>

							<div class="col-sm-12">
								<div class="box box-solid box-primary">
									<div class="box-header with-border">
										<h4 class="box-title">Antecedentes relacionados a la consulta</h4>
									</div>
									<!-- /.box-header -->
									<div class="box-body clearfix">
										datos aki
									</div>
									<!-- /.box-body -->
								</div>
							</div>


						</div>
					</div>

					{{-- tab_2 --}}
					<div class="tab-pane" id="tab_2">
						tab_2
					</div>

					{{-- tab_3 --}}
					<div class="tab-pane" id="tab_3">
						<div class="row">
							<div class="col-sm-12">
								{{ Form::label('tbl-famacia', 'Farmacia') }}
								<table class="table table-hover table-condensed">
									<thead>
										<tr class="bg-purple disabled">
											<td>Medicamento/Insumo</td>
											<td>Cantidad</td>
											<td>N°Dosis</td>
											<td>HaySado</td>
											<td width="30"></td>
										</tr>
									</thead>
									<tbody class="tbody-farmacia">
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
							</div>
						</div>
					</div>

					{{-- tab_4 --}}
					<div class="tab-pane" id="tab_4">
						tab_4
					</div>

					{{-- tab_5 --}}
					<div class="tab-pane" id="tab_5">
						tab_5
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