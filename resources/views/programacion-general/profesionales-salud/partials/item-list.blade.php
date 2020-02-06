@php
	$model = 'profesionales-salud';
@endphp

<table class="table table-condensed table-bordered table-hover" style="margin-bottom:0">
	<thead>
	<tr class="bg-purple disabled">
		<td>Cod. Planilla</td>
		<td>Apellido paterno</td>
		<td>Apellido materno</td>
		<td>Nombres</td>
		<td>Especialidad</td>
		<td>Colegiatura</td>
		<td width="100"></td>
	</tr>
	</thead>
	<tbody class="{{$model}}-tbody">
	@if(count($items) > 0 )
		@foreach ($items as $item)
			{{-- grdPacientes.Bands(0).Columns("IdPaciente").Hidden = True
            grdPacientes.Bands(0).Columns("IdTipoNumeracion").Hidden = True --}}
			<tr>
				<td>{{ $item->CodigoPlanilla }}</td>
				<td>{{ $item->ApellidoPaterno }}</td>
				<td>{{ $item->ApellidoMaterno }}</td>
				<td>{{ $item->Nombres }}</td>
				<td>{{ $item->Especialidad }}</td>
				<td>{{ $item->Colegiatura }}</td>
				<td>
					<input type="hidden" value="{{ $item->IdMedico }}">
					<a href="#" class="btn btn-xs btn-default {{$model}}-btn-show" title="ver"> <i class="fa fa-fw fa-eye"></i></a>
					<a href="#" class="btn btn-xs btn-default {{$model}}-btn-edit" title="editar"> <i class="fa fa-fw fa-edit"></i></a>
					<a href="#" class="btn btn-xs btn-default {{$model}}-btn-delete" title="eliminar"> <i class="fa fa-fw fa-trash"></i></a>
				</td>
			</tr>
		@endforeach
	@else
		<tr> <td colspan="12" class="text-center"> Sin resultados</td> </tr>
	@endif

	</tbody>
</table>

<div class="{{$model}}-paginator">
	@if(count($items) > 0 )
		{{ $items->render() }}
	@endif

</div>





