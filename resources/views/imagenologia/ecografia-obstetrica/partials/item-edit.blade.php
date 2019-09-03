@php
	$model = 'ecografiaObstetrica';
@endphp

{{  Form::model($item, ['route' => ['imagenologia.ecografia-obstetrica.store', $item->id], 'method'=>'PUT', 'id'=>$model.'-form']) }}
	<div class="row">
		<div class="col-sm-12 form-group">
			{{ Form::label('name', 'name (*)') }}
			{{ Form::text('name', null, ['class'=>'form-control input-sm']) }}
		</div>
	
		<div class="col-sm-12">
			<div class="pull-right">
				<a href="" class="btn btn-sm btn-default {{$model}}-btn-cancel" data-dismiss="modal"> CANCELAR</a>
				<button type="submit" class="btn btn-sm btn-success {{$model}}-btn-update">ACTUALIZAR</button>
			</div>
		</div>
	</div>
{{ Form::close() }}



