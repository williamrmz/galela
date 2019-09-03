@php
	$model = 'empleados';
@endphp

<table class="table table-condensed table-hover" style="margin-bottom:0">
	<thead>
		<tr style="font-weight:bold;" class="bg-purple disabled">
			<td>#</td>
			<td>Cod. Planilla</td>
			<td>Apellido Paterno</td>
			<td>Apellido Materno</td>
			<td>Nombres</td>
			<td>DNI</td>
			<td>Tipo Empleado</td>	
			<td>Condicion Trabajo</td>
			<td width="100"></td>
		</tr>
	</thead>
	<tbody>
		@foreach ($items as $item)
		{{-- @php
			dd($item);
		@endphp --}}
			<tr>
				<td>{{ $item->IdEmpleado }}</td>
				<td>{{ $item->CodigoPlanilla }}</td>
				<td>{{ $item->ApellidoPaterno }}</td>
				<td>{{ $item->ApellidoMaterno }}</td>
				<td>{{ $item->Nombres }}</td>
				<td>{{ $item->DNI }}</td>
				<td>{{ $item->TipoEmpleado }}</td>
				<td>{{ $item->CondicionTrabajo }}</td>
				<td>
					<input type="hidden" value="{{ $item->IdEmpleado }}">
					<a href="#" class="btn btn-xs btn-default {{$model}}-btn-show" title="ver"> <i class="fa fa-fw fa-eye"></i></a>
					<a href="#" class="btn btn-xs btn-default {{$model}}-btn-edit" title="editar"> <i class="fa fa-fw fa-edit"></i></a>
					<a href="#" class="btn btn-xs btn-default {{$model}}-btn-delete" title="eliminar"> <i class="fa fa-fw fa-trash"></i></a>
				</td>
			</tr>  
		@endforeach
		
	</tbody>
</table>

<div class="{{$model}}-paginator">
	{{-- {{ $items->render() }} --}}
</div>





