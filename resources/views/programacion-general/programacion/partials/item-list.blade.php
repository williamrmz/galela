@php
	$model = 'programacion';
@endphp

<table class="table table-condensed" style="margin-bottom:0">
	<thead class="bg-gray">
		<tr>
			<td width="70px">Hora</td>
			<td>Especialidad</td>
			<td width="100"></td>
		</tr>
	</thead>
	<tbody>

	@php(isset($items)?$items=$items:$items=Array())
	@foreach($items as $item)
		<tr style="background: rgb({{ $item->color_red }}, {{ $item->color_green }}, {{ $item->color_blue  }})">
			<td>{{ dateFormat($item->HoraInicio,'h:i A') }} - {{ dateFormat($item->HoraFin,'h:i A')  }}</td>
			<td>
				{{ $item->Nombre }}
				@if($item->Descripcion != null && trim($item->Descripcion) != "")
					<br>
					<i>Observación: {{ $item->Descripcion }}</i>
				@endif
			</td>
			<td>
				<input type="hidden" value="{{ $item->IdProgramacion }}">
				<a href="#" class="btn btn-xs btn-default {{$model}}-btn-show" title="ver"> <i class="fa fa-fw fa-eye"></i></a>
				<a href="#" class="btn btn-xs btn-default {{$model}}-btn-edit" title="editar"> <i class="fa fa-fw fa-edit"></i></a>
				<a href="#" class="btn btn-xs btn-default {{$model}}-btn-delete" title="eliminar"> <i class="fa fa-fw fa-trash"></i></a>
			</td>
		</tr>
	@endforeach

	@if(count($items) == 0)
		<tr>
			<td colspan="3">Sin resultados</td>
		</tr>
	@endif
	</tbody>
</table>


