@php
	if (!isset($items)) { $items = Array(); }
	$model = 'registro-triaje';
@endphp

<table class="table table-condensed table-bordered table-hover registro-triaje-table" style="margin-bottom:0">
	<thead>
	<tr class="bg-purple disabled">
		<td>Nro. Cuenta</td>
		<td>Nro. Historia</td>
		<td>Ap. Paterno</td>
		<td>Ap. Materno</td>
		<td>Primer nombre</td>
		<td>Fecha triaje</td>
		<td>Consultorio</td>
		<td>Fecha de cita</td>
		<td width="100"></td>
	</tr>
	</thead>
	<tbody class="{{$model}}-tbody">
	@if(count($items) > 0 )
		@foreach ($items as $item)
			{{-- grdPacientes.Bands(0).Columns("IdPaciente").Hidden = True
            grdPacientes.Bands(0).Columns("IdTipoNumeracion").Hidden = True --}}
			<tr>
				<td>{{ $item->IdCuentaAtencion }}</td>
				<td>{{ $item->NroHistoriaClinica }}</td>
				<td>{{ $item->ApellidoPaterno }}</td>
				<td>{{ $item->ApellidoMaterno }}</td>
				<td>{{ $item->PrimerNombre }}</td>
				<td>{{ $item->TriajeFecha }}</td>
				<td>{{ $item->Consultorio }}</td>
				<td>{{ $item->FechaCita }}</td>
				<td>
					<input type="hidden" value="{{ $item->idAtencion }}">
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


