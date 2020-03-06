@php
	$model = 'cajas';
@endphp

<!-- {{  Form::model($item, ['route' => ['caja.cajas.store', $item->id], 'method'=>'POST', 'id'=>$model.'-form']) }} -->
	<fieldset class="scheduler-border">
	<legend class="scheduler-border">Datos Generales</legend>
	<div class="row">
			<div class="col-sm-6 form-group">
				{{ Form::label('codigo', 'Codigo') }}
				{{ Form::text('codigo', null, ['class'=>'form-control input-sm',  'disabled' => 'disabled']) }}
			</div>
			<div class="col-sm-6 form-group">
				{{ Form::label('pc', 'Nombre de PC') }}
				{{ Form::text('pc', null, ['class'=>'form-control input-sm',  'disabled' => 'disabled']) }}
			</div>
			<div class="col-sm-12 form-group">
				{{ Form::label('desc', 'Descripcion') }}
				{{ Form::text('desc', null, ['class'=>'form-control input-sm',  'disabled' => 'disabled']) }}
			</div>
			<div class="col-sm-6 form-group">
				{{ Form::label('impresora1', 'Impresora 1') }}
				{{ Form::text('impresora1', null, ['class'=>'form-control input-sm',  'disabled' => 'disabled']) }}
				<span style="color: red">Impresora que se usará en Boletas de SERVICIOS</span>
			</div>
			<br>
			<div class="col-sm-6 form-group">
				{{ Form::label('impresora2', 'Impresora 2') }}
				{{ Form::text('impresora2', null, ['class'=>'form-control input-sm',  'disabled' => 'disabled']) }}
				<span style="color: red">Impresora que se usará en Boletas de FARMACIA</span>
			</div>
			<div class="col-sm-3 form-group" hidden>
				{{ Form::label('idtipocomprobante', 'Tipo de Comprobante') }}
				{{ Form::text('idtipocomprobante', null, ['class'=>'form-control input-sm',  'disabled' => 'disabled']) }}
			</div>
			<div class="col-sm-6 form-group">
				{{ Form::label('cmbIdTipoComprobante', 'Tipo de Comprobante') }}
				{{ Form::select('cmbIdTipoComprobante', [], null, ['class'=>'form-control input-ss', 'style'=>'width:100%',  'disabled' => 'disabled']) }}
			</div>
	</fieldset>
	<fieldset class="scheduler-border">
	<legend class="scheduler-border">Generación de Comprobantes</legend>
		<div class="col-sm-12 form-group">
			<!-- {{ Form::label('lstComprobantes', 'Generación de Comprobantes') }} -->
			<table class="table table-condensed" style="margin-bottom:0">
				<thead>
					<tr>
						<td>Tipo Comprobante</td>
						<td>Nº Serie</td>
						<td>Nro.Doc.Inicial</td>
						<td>Nro.Doc.Final</td>
						<td>Ult.Doc.Generado</td>
					</tr>
				</thead>
				<tbody>
					<tr>
						<td>Recibo</td>
						<td>{{ Form::text('nroSerieRecibo', null, ['class'=>'form-control input-sm' ,  'disabled' => 'disabled']) }}</td>
						<td>{{ Form::text('nroDocIniRecibo', null, ['class'=>'form-control input-sm',  'disabled' => 'disabled']) }}</td>
						<td>{{ Form::text('nroDocFinRecibo', null, ['class'=>'form-control input-sm',  'disabled' => 'disabled']) }}</td>
						<td>{{ Form::text('nroUltDocRecibo', null, ['class'=>'form-control input-sm',  'disabled' => 'disabled']) }}</td>
					</tr>
					<tr>
						<td>Factura</td>
						{{ Form::label('nroUltDocFactura', ' ') }}
						<td>{{ Form::text('nroSerieFactura', null, ['class'=>'form-control input-sm',  'disabled' => 'disabled']) }}</td>
						<td>{{ Form::text('nroDocIniFactura', null, ['class'=>'form-control input-sm',  'disabled' => 'disabled']) }}</td>
						<td>{{ Form::text('nroDocFinFactura', null, ['class'=>'form-control input-sm',  'disabled' => 'disabled']) }}</td>
						<td>{{ Form::text('nroUltDocFactura', null, ['class'=>'form-control input-sm',  'disabled' => 'disabled']) }}</td>
					</tr>
					<tr>
						<td>Boleta</td>
						<td>{{ Form::text('nroSerieBoleta', null, ['class'=>'form-control input-sm',  'disabled' => 'disabled']) }}</td>
						<td>{{ Form::text('nroDocIniBoleta', null, ['class'=>'form-control input-sm',  'disabled' => 'disabled']) }}</td>
						<td>{{ Form::text('nroDocFinBoleta', null, ['class'=>'form-control input-sm',  'disabled' => 'disabled']) }}</td>
						<td>{{ Form::text('nroUltDocBoleta', null, ['class'=>'form-control input-sm',  'disabled' => 'disabled']) }}</td>
					</tr>
					<tr>
						<td>Ticket</td>
						<td>{{ Form::text('nroSerieTicket', null, ['class'=>'form-control input-sm',  'disabled' => 'disabled']) }}</td>
						<td>{{ Form::text('nroDocIniTicket', null, ['class'=>'form-control input-sm',  'disabled' => 'disabled']) }}</td>
						<td>{{ Form::text('nroDocFinTicket', null, ['class'=>'form-control input-sm',  'disabled' => 'disabled']) }}</td>
						<td>{{ Form::text('nroUltDocTicket', null, ['class'=>'form-control input-sm',  'disabled' => 'disabled']) }}</td>
					</tr>
				</tbody>
			</table>
		</div>
		
		
		<div class="col-sm-12">
			<div class="pull-right">
				<button class="btn btn-sm btn-primary {{$model}}-btn-store">Aceptar</button>
			</div>
		</div>
	</fieldset>
	</div>
{{ Form::close() }}