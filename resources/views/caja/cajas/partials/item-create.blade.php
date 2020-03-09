@php
	$model = 'cajas';
@endphp

<!--{{  Form::open(['route' => ['caja.cajas.store'], 'method'=>'POST', 'id'=>$model.'-form']) }} -->	
{{  Form::open(['route' => ['caja.cajas.store'], 'method'=>'POST', 'id'=>$model.'-form', 'enctype' => 'multipart/form-data']) }}
<fieldset class="scheduler-border">
	<legend class="scheduler-border">Datos Generales</legend>
	<div class="row" >
		<div class="col-sm-6 form-group" >
			<div class="input-group" style="width:100%">
			{{ Form::label('codigo', 'Codigo', ['class' => 'input-group-addon', 'style'=>'width:120px']) }}
			{{ Form::text('codigo', null, ['class'=>'form-control input-ss nrserie', 'maxlength' => 4]) }}
			</div>
		</div>
		<div class="col-sm-6 form-group" >
			<div class="input-group" style="width:100%">
			{{ Form::label('pc', 'Nombre de PC', ['class' => 'input-group-addon', 'style'=>'width:120px']) }}
			{{ Form::text('pc', null, ['class'=>'form-control input-ss']) }}
			</div>
		</div>
		<div class="col-sm-6 form-group">
			<div class="input-group" style="width:100%">
			{{ Form::label('desc', 'Descripcion', ['class' => 'input-group-addon', 'style'=>'width:120px']) }}
			{{ Form::text('desc', null, ['class'=>'form-control input-ss']) }}
			</div>
		</div>
		<div class="col-sm-6 form-group">
			<div class="input-group" style="width:100%">
			{{ Form::label('cmbIdTipoComprobante', 'Comprobante', ['class' => 'input-group-addon', 'style'=>'width:120px']) }}
			{{ Form::select('cmbIdTipoComprobante', [], null, ['class'=>'form-control input-ss']) }}
			</div>
		</div>
		<div class="col-sm-6 form-group">
			<div class="input-group" style="width:100%">
			{{ Form::label('impresora1', 'Impresora 1', ['class' => 'input-group-addon', 'style'=>'width:120px']) }}
			{{ Form::text('impresora1', null, ['class'=>'form-control input-ss']) }}
			</div>
			<span style="color: red">Impresora que se usará en Boletas de SERVICIOS</span>
		</div>
		<br>
		<div class="col-sm-6 form-group">
			<div class="input-group" style="width:100%">
			{{ Form::label('impresora2', 'Impresora 2', ['class' => 'input-group-addon', 'style'=>'width:120px']) }}
			{{ Form::text('impresora2', null, ['class'=>'form-control input-ss']) }}
			</div>
			<span style="color: red">Impresora que se usará en Boletas de FARMACIA</span>
		</div>
		<br>  
		<!-- <div class="col-sm-3 form-group" hidden>
				{{ Form::label('idtipocomprobante', 'Tipo de Comprobante') }}
				{{ Form::text('idtipocomprobante', null, ['class'=>'form-control input-sm',  'disabled' => 'disabled']) }}
		</div> -->
	</div>
</fieldset>
<fieldset class="scheduler-border">
	<legend class="scheduler-border">Generación de Comprobantes</legend>
	<div class="row">
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
				<tbody >
					<tr >
						<td>Recibo</td>
						<!--{{ Form::label('nroSerieRecibo', ' ') }}
						{{ Form::label('nroDocIniRecibo', ' ') }}
						{{ Form::label('nroDocFinRecibo', ' ') }}
						{{ Form::label('nroUltDocRecibo', ' ') }} -->
						<td>{{ Form::text('nroSerieRecibo', '000', ['class'=>'form-control input-sm nrserie', 'maxlength' => 3]) }}</td>
						<td>{{ Form::text('nroDocIniRecibo', '000000', ['class'=>'form-control input-sm nrserie','maxlength' => 6]) }}</td>
						<td>{{ Form::text('nroDocFinRecibo', '999999', ['class'=>'form-control input-sm nrserie','maxlength' => 6]) }}</td>
						<td>{{ Form::text('nroUltDocRecibo', '000000', ['class'=>'form-control input-sm nrserie','maxlength' => 6]) }}</td> 
					</tr>
					<tr>
						<td>Factura</td>
						<!--{{ Form::label('nroSerieFactura', ' ') }}
						{{ Form::label('nroDocIniFactura', ' ') }}
						{{ Form::label('nroDocFinFactura', ' ') }}
						{{ Form::label('nroUltDocFactura', ' ') }}-->
						<td>{{ Form::text('nroSerieFactura', '000', ['class'=>'form-control input-sm nrserie','maxlength' => 3]) }}</td>
						<td>{{ Form::text('nroDocIniFactura', '000000', ['class'=>'form-control input-sm nrserie','maxlength' => 6]) }}</td>
						<td>{{ Form::text('nroDocFinFactura', '999999', ['class'=>'form-control input-sm nrserie','maxlength' => 6]) }}</td>
						<td>{{ Form::text('nroUltDocFactura', '000000', ['class'=>'form-control input-sm nrserie','maxlength' => 6]) }}</td>
					</tr>
					<tr>
						<td>Boleta</td>
						<!--{{ Form::label('nroSerieBoleta', ' ') }}
						{{ Form::label('nroDocIniBoleta', ' ') }}
						{{ Form::label('nroDocFinBoleta', ' ') }}
						{{ Form::label('nroUltDocBoleta', ' ') }} -->
						<td>{{ Form::text('nroSerieBoleta', '000', ['class'=>'form-control input-sm nrserie','maxlength' => 3]) }}</td>
						<td>{{ Form::text('nroDocIniBoleta', '000000', ['class'=>'form-control input-sm nrserie','maxlength' => 6]) }}</td>
						<td>{{ Form::text('nroDocFinBoleta', '999999', ['class'=>'form-control input-sm nrserie','maxlength' => 6]) }}</td>
						<td>{{ Form::text('nroUltDocBoleta', '000000', ['class'=>'form-control input-sm nrserie','maxlength' => 6]) }}</td>
					</tr>
					<tr>
						<td>Ticket</td>
						<!--{{ Form::label('nroSerieTicket', ' ') }}
						{{ Form::label('nroDocIniTicket', ' ') }}
						{{ Form::label('nroDocFinTicket', ' ') }}
						{{ Form::label('nroUltDocTicket', ' ') }} -->
						<td>{{ Form::text('nroSerieTicket', '000', ['class'=>'form-control input-sm nrserie','maxlength' => 3]) }}</td>
						<td>{{ Form::text('nroDocIniTicket', '000000', ['class'=>'form-control input-sm nrserie','maxlength' => 6]) }}</td>
						<td>{{ Form::text('nroDocFinTicket', '999999', ['class'=>'form-control input-sm nrserie','maxlength' => 6]) }}</td>
						<td>{{ Form::text('nroUltDocTicket', '000000', ['class'=>'form-control input-sm nrserie','maxlength' => 6]) }}</td>
					</tr>
				</tbody>
			</table>
		</div>
		
		
		<div class="col-sm-12">
			<div class="pull-right">
				<a href="" class="btn btn-sm btn-default {{$model}}-btn-cancel" data-dismiss="modal"> CANCELAR</a>
				<button type="submit" class="btn btn-sm btn-primary {{$model}}-btn-store">CREAR</button>
			</div>
		</div>
		</fieldset>
	</div>
{{ Form::close() }}