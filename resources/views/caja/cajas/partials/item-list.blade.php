@php
	$model = 'cajas';
@endphp

<table class="table table-condensed" style="margin-bottom:0">
	<thead>
		<tr>
			<td>Código</td>
			<td>Descripción</td>
			<td>PC Login</td>
			<td>Impresora por Defecto</td>
			<td>Impresora auxiliar</td>
			<td>ID Tipo Comprobante</td>
			<td width="100"></td>
		</tr>
	</thead>
	<tbody>
		@foreach ($items as $item)
			<tr>
				<td>{{ $item->Codigo }}</td>
				<td>{{ $item->Descripcion }}</td>
				<td>{{ $item->loginPC }}</td>
				<td>{{ $item->ImpresoraDefault }}</td>
				<td>{{ $item->Impresora2 }}</td>
				<td>{{ $item->idTipoComprobante }}</td>
				<td>
					<input type="hidden" value="{{ $item->IdCaja }}">
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





