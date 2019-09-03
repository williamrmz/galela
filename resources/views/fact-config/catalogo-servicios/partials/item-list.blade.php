@php
	$model = 'catalogoServicios';
@endphp

<div class="box-group" id="accordion">
	<!-- we are adding the .panel class so bootstrap.js collapse plugin detects it -->
	@foreach ($items as $grupo)
	@php
		// dd($items);
	@endphp
		<div class="panel box">
			<div class="box-header with-border">
			<h4 class="box-title">
				
				<a data-toggle="collapse" data-parent="#accordion" href="#collapse{{$grupo->idServicioSubGrupo}}" class="collapsed" aria-expanded="false" class="">
					<i class="fa fa-table"> </i>
				</a>
				{{$grupo->descripcion}} ({{ count($grupo->servicios) }})
			</h4>
			</div>
			<div id="collapse{{$grupo->idServicioSubGrupo}}" class="panel-collapse collapse" aria-expanded="false" style="">
			<div class="box-body">
					<div style="width: 100%; height: 200px; overflow-y: scroll;">
						<table class="table table-condensed table-hover table-bordered">
							<thead>
								<tr style="font-weight:bold;">
									<td>Codigo</td>
									<td>Nombre</td>
									<td width="100"></td>
								</tr>
							</thead>
							<tbody>
								@php
									$servicios = $grupo->servicios;
									// echo count($servicios);
								@endphp
									@foreach ($servicios as $servicio)
										<tr>
											<td>{{ $servicio->codigo }}</td>
											<td>{{ $servicio->nombre }}</td>
											<td width="100">
												<input type="hidden" value="{{$servicio->idProducto}}">
												<a href="#" class="btn btn-xs btn-default {{$model}}-btn-show"> <i class="fa fa-eye"></i></a>
												<a href="#" class="btn btn-xs btn-default {{$model}}-btn-edit"> <i class="fa fa-edit"></i></a>
												<a href="#" class="btn btn-xs btn-default {{$model}}-btn-delete"> <i class="fa fa-trash"></i></a>
											</td>
										</tr>
									@endforeach
							</tbody>
						</table>
					</div>
			</div>
			</div>
		</div>	
	@endforeach
	
	{{-- <div class="panel box box-danger">
		<div class="box-header with-border">
		<h4 class="box-title">
			<a data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" class="collapsed" aria-expanded="false">
			Collapsible Group Danger
			</a>
		</h4>
		</div>
		<div id="collapseTwo" class="panel-collapse collapse" aria-expanded="false" style="height: 0px;">
		<div class="box-body">
			Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3
			wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum
			eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla
			assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred
			nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer
			farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus
			labore sustainable VHS.
		</div>
		</div>
	</div>
	<div class="panel box box-success">
		<div class="box-header with-border">
			<h4 class="box-title">
				<a data-toggle="collapse" data-parent="#accordion" href="#collapseThree" class="collapsed" aria-expanded="false">
				Collapsible Group Success
				</a>
			</h4>
		</div>
		<div id="collapseThree" class="panel-collapse collapse" aria-expanded="false" style="height: 0px;">
			<div class="box-body">
				Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3
				wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum
				eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla
				assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred
				nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer
				farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus
				labore sustainable VHS.
			</div>
		</div>
	</div> --}}
</div>


<div class="{{$model}}-paginator">
	{{-- {{ $items->render() }} --}}
</div>





