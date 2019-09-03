@php
	$model = 'archiveros';
@endphp

<table class="table table-condensed" style="margin-bottom:0">
	<thead>
		<tr class="bg-purple disabled">
			<td>#</td>
			<td>Ap. Paterno</td>
			<td>Ap. Materno</td>
			<td>Nombres</td>
			<td width="100"></td>
		</tr>
	</thead>
	<tbody>
		@foreach ($items as $key => $item)
		@php
			// dd($item);
		@endphp
			<tr>
				<td>{{ $key+1 }}</td>
				<td>{{ $item->ApellidoPaterno }}</td>
				<td>{{ $item->ApellidoMaterno }}</td>
				<td>{{ $item->Nombres }}</td>
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





