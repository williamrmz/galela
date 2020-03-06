@php
	$model = 'gestionCaja';
@endphp

<table class="table table-condensed" style="margin-bottom:0">
	<thead>
		<tr>
			<td>Caja</td>
			<td>Turno</td>
			<td>Fecha</td>
			<td>NroSerie</td>
			<td>NroDocumento</td>
			<td>NroHistoriaClinica</td>
			<td>Razon Social</td>
			<td>Total</td>
			<td>IdCuentaAtencion</td>
			<td>Estado</td>
			<td>CajeroApPat</td>
			<td>CajeroApMat</td>
			<td>CajeroNombres</td>
			<td>BienServicio</td>
			<td>IdPaciente</td>
			<td>idTurno</td>
			<td>idCaja</td>
			<td>IdCajero</td>
			<td>IdEmpleado</td>
			<td>idFormaPago</td>
			<td>dFormaPago</td>
			<td>IdEstadoComprobante</td>
			<td>IdTipoOrden</td>
			<td>idFarmacia</td>
			<td>dFarmacia</td>
			<td>exoneraciones</td>
			<td>IdTipoComprobante</td>
		</tr>
	</thead>
	<tbody>
		
		@foreach ($items as $item)
			<tr>
				<td>{{ $item->Caja }}</td>
				<td>{{ $item->Turno }}</td>
				<td>{{ $item->Fecha }}</td>
				<td>{{ $item->NroSerie }}</td>
				<td>{{ $item->NroDocumento }}</td>
				<td>{{ $item->NroHistoriaClinica }}</td>
				<td>{{ $item->RazonSocial }}</td>
				<td>{{ (double) $item->Total }}</td>
				<td>{{ $item->IdCuentaAtencion }}</td>
				<td>{{ $item->Estado }}</td>
				<td>{{ $item->CajeroApPat }}</td>
				<td>{{ $item->CajeroApMat }}</td>
				<td>{{ $item->CajeroNombres }}</td>
				<td>{{ $item->BienServicio }}</td>
				<td>{{ $item->IdPaciente }}</td>
				<td>{{ $item->idTurno }}</td>
				<td>{{ $item->idCaja }}</td>
				<td>{{ $item->IdCajero }}</td>
				<td>{{ $item->IdEmpleado }}</td>
				<td>{{ $item->idFormaPago }}</td>
				<td>{{ $item->dFormaPago }}</td>
				<td>{{ $item->IdEstadoComprobante }}</td>
				<td>{{ $item->IdTipoOrden }}</td>
				<td>{{ $item->idFarmacia }}</td>
				<td>{{ $item->dFarmacia }}</td>
				<td>{{ (double) $item->exoneraciones }}</td>
				<td>{{ $item->IdTipoComprobante }}</td>
			</tr>  
		@endforeach
	</tbody>
</table>

<div class="{{$model}}-paginator">
	{{ $items->render() }}
</div>





