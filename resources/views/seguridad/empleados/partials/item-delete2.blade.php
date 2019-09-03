@php
	$model = 'empleados';
@endphp

{{  Form::model($item, ['route' => ['seguridad.empleados.destroy', $item->id], 'method'=>'DELETE', 'id'=>$model.'-form']) }}
	<div class="row">
		<div class="col-sm-12 form-group">
			{{ Form::label('name', 'name (*)') }}
			{{ Form::text('name', null, ['class'=>'form-control input-sm', 'disabled']) }}
		</div>
	
		<div class="col-sm-12">
			<div class="pull-right">
				<a href="" class="btn btn-sm btn-default {{$model}}-btn-cancel" data-dismiss="modal"> CANCELAR</a>
				<button type="submit" class="btn btn-sm btn-danger {{$model}}-btn-destroy">ELIMINAR</button>
			</div>
		</div>
	</div>
{{ Form::close() }}


