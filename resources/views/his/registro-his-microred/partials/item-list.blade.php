@php
	$model = 'registroHisMicrored';
@endphp

<table class="table table-condensed" style="margin-bottom:0">
	<thead>
		<tr>
			<td>#</td>
			<td>name</td>
			<td width="100"></td>
		</tr>
	</thead>
	<tbody>
		@foreach ($items as $item)
			<tr>
				<td>{{ $item->id }}</td>
				<td>{{ $item->name }}</td>
				<td>
					<input type="hidden" value="{{ $item->id }}">
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





