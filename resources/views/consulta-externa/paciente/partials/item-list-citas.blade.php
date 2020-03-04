@php
	$model = 'paciente';
	$mode = isset($mode)? $mode: "DATA";
@endphp

<table class="table table-condensed table-bordered table-hover" style="margin-bottom:0">
	<thead>
		<tr class="bg-purple disabled">
			<td>Nro Historia</td>
			<td>Ap. Paterno</td>
			<td>Ap. Materno</td>
			<td>1er Nombre</td>
			<td>2do Nombre</td>
			<td>Fecha Nac.</td>
			<td>Tipo Numeración</td>
			<td>Ult. Tipo Serv.</td>
			<td>Ult. Fec Ing.</td>
			<td>Ult. Fec Egr.</td>
			<td>Ult. Serv. Ing.</td>
			<td width="100"></td>
		</tr>
	</thead>
	<tbody class="{{$model}}-tbody">
		@if( $mode == 'DATA' && count($items) > 0 )
			@foreach ($items as $item)
				{{-- grdPacientes.Bands(0).Columns("IdPaciente").Hidden = True
				grdPacientes.Bands(0).Columns("IdTipoNumeracion").Hidden = True --}}
				<tr>
					<td>{{ $item->NroHistoriaClinica }}</td>
					<td>{{ $item->ApellidoPaterno }}</td>
					<td>{{ $item->ApellidoMaterno }}</td>
					<td>{{ $item->PrimerNombre }}</td>
					<td>{{ $item->SegundoNombre }}</td>
					<td>{{ $item->FechaNacimiento }}</td>
					<td>{{ $item->TipoNumeracion }}</td>
					<td>{{ $item->TipoServicio }}</td>
					<td>{{ $item->FechaIngreso }}</td>
					<td>{{ $item->FechaEgreso }}</td>
					<td>{{ $item->ServicioIngreso }}</td>
					<td>
						<input type="hidden" value="{{ $item->IdPaciente }}">
						<a href="#" class="btn btn-xs btn-default {{$model}}-btn-seleccionar" title="Seleccionar"><i class="fa fa-plus"></i></a>
					</td>
				</tr>  
			@endforeach
		@else
			<tr> <td colspan="12" class="text-center"> Sin resultados</td> </tr>
		@endif
		
	</tbody>
</table>

<div class="{{$model}}-paginator">
	@if( $mode == 'DATA' && count($items) > 0 )
		{{ $items->render() }}
	@endif
	
</div>





