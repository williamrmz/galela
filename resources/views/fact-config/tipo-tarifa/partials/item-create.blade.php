@php
	$model = 'tipoTarifa';
@endphp

{{  Form::open(['route' => ['fact-config.tipo-tarifa.store'], 'method'=>'POST', 'id'=>$model.'-form']) }}
	<div class="row">
		<div class="col-sm-12 form-group">
			{{ Form::label('name', 'name (*)') }}
			{{ Form::text('name', null, ['class'=>'form-control input-sm']) }}
		</div>
	
		<div class="col-sm-12">
			<div class="pull-right">
				<a href="" class="btn btn-sm btn-default {{$model}}-btn-cancel" data-dismiss="modal"> CANCELAR</a>
				<button type="submit" class="btn btn-sm btn-primary {{$model}}-btn-store">CREAR</button>
			</div>
		</div>
	</div>
{{ Form::close() }}