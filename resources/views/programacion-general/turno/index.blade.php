@extends('layouts.master')

@section('KP', 'active menu-open')
@section('KP.Turno', 'active')

@section('breadcrumb')
<li><a href='#'>Inicio</a></li>
<li><a href='#'>Programacion General</a></li>
<li class='active'>Turno</li>
@endsection

@php
	$model = 'turno';
@endphp

@section('content')

	@include('programacion-general.turno.partials.item-form')

	<div class='row' id="listado-{{$model}}">
		<div class='col-sm-12'>

			<div class="box box-primary">
				<div class="box-header with-border">
					<h3 class="box-title"><i class="fa fa-clock-o"></i> Turno</h3>
					<div class="box-tools pull-right">
						<a href="#" class="btn btn-primary btn-xs" id="{{$model}}-btn-create"> <i class="fa fa-plus"></i> Crear</a>
					</div>
				</div>
				<!-- /.box-header -->
				<div class="box-body">
					<div class="row">

						<div class="col-sm-12">
							{{ Form::open(['route' => ['programacion-general.turno.index'], 
								'id'=>"$model-form-search", 'method'=>'GET', 'class'=> 'form-inline pull-right']) }}
								<div class="form-group">
									{{ Form::text('search', null, ['class'=>"form-control input-sm $model-input-search"]) }}
								</div>
								<button type="submit" class="btn btn-sm btn-default" id="{{$model}}-btn-search" 
									title="buscar"> <i class="fa fa-search"></i></button>
								<a href="#" class="btn btn-sm btn-default" id="{{$model}}-btn-clear" 
									title="limpiar"> <i class="fa fa-refresh"></i></a>
							{{ Form::close() }}
						</div>

						<div class="col-sm-12 periodos-tabla">
							<div class="table-responsive {{$model}}-table">

							</div>
						</div>
					</div>
		
				</div>
			</div>
			
		</div>
	</div>

@endsection

@push('scripts')
	<script>
		var model = '{{ $model }}';
		var url = '{{ route("programacion-general.turno.index") }}';
		console.log(url);
	</script>

    <script src="{{ asset('js/programacion-general/turno.js') }}"></script>
@endpush
