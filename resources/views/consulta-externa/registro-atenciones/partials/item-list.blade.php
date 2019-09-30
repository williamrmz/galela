@php
	$model = 'registroAtenciones';
@endphp

<table class="table table-condensed table-bordered" style="margin-bottom:0">
	<thead>
		<tr class="bg-purple disabled">
			<td>#</td>
			<td>A.Paterno</td>
			<td>A.Materno</td>
			<td>Nombres</td>
			<td>H.Clinica</td>
			<td>Ficha Familiar</td>
			<td>F.Nacimiento</td>
			<td>Fecha Ingreso</td>
			<td>Hora Ingreso</td>
			<td>F.S. Atencion</td>
			<td>H.S. Atencion</td>
			<td>Pasó Triaje</td>
			<td>Pagó Consulta</td>
			<td>Tipo Numeracion</td>
			<td>FechaEgreso Adminsion</td>
			<td>Plan</td>
			<td>IdEstado Atencion</td>
			<td width="100"></td>
		</tr>
	</thead>
	<tbody>
		@foreach ($items as $key => $item)
		@php
			// dd($item->ServicioActual);
		@endphp
			<tr>
				<td>{{ $key+1 }}</td>
				<td>{{ $item->ApellidoPaterno }}</td>
				<td>{{ $item->ApellidoMaterno }}</td>
				<td>{{ $item->PrimerNombre }}</td>
				<td>{{ $item->NroHistoriaClinica }}</td>
				<td>{{ $item->FichaFamiliar }}</td>
				<td>{{ dateFormat($item->FecNacim, 'd/m/Y') }}</td>
				<td>{{ $item->FechaIngreso }}</td>
				<td>{{ $item->HoraIngreso }}</td>
				<td>{{ "---" }}</td>
				<td>{{ "---" }}</td>
				<td>{{ $item->ServicioActual }}</td>
				<td>{{ $item->PagoConsulta }}</td>
				<td>{{ $item->TipoNumeracion }}</td>
				<td>{{ "---" }}</td>
				<td>{{ "---" }}</td>
				<td>{{ $item->IdEstadoAtencion }}</td>
				<td align="center">
					<input type="hidden" value="{{ $item->IdPaciente }}">
					<a href="#" class="btn btn-xs btn-default {{$model}}-btn-show" title="ver"> <i class="fa fa-fw fa-eye"></i></a>
					<a href="#" class="btn btn-xs btn-default {{$model}}-btn-edit" title="editar"> <i class="fa fa-fw fa-edit"></i></a>
					<a href="#" class="btn btn-xs btn-default {{$model}}-btn-delete" title="eliminar"> <i class="fa fa-fw fa-trash"></i></a>
				</td>
			</tr>  
		@endforeach
		
	</tbody>
</table>

<div class="{{$model}}-paginator">
	{{ $items->render() }}
</div>





