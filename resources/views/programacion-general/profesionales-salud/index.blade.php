@extends('layouts.master')

@section('KP', 'active menu-open')
@section('KP.Medico', 'active')

@section('breadcrumb')
<li><a href='#'>Inicio</a></li>
<li><a href='#'>Programación General</a></li>
<li class='active'>Profesionales de la salud</li>
@endsection

@php
	$model = 'profesionales-salud';
@endphp

@section('content')

	@include('programacion-general.profesionales-salud.partials.item-form')

	<div class='row' id="listado-{{$model}}">
		<div class='col-sm-12'>

			<div class="box box-primary">
				<div class="box-header with-border">
					<h3 class="box-title"><i class="fa fa-user-md text-green"></i> Profesionales de salud</h3>
					<div class="box-tools pull-right">
						<a href="#" class="btn btn-primary btn-xs" id="{{$model}}-btn-create"> <i class="fa fa-plus"></i> Crear</a>
					</div>
				</div>
				<!-- /.box-header -->
				<div class="box-body">
					<div class="row">

						<div class="col-sm-12">
							{{ Form::open(['route' => ['programacion-general.profesionales-salud.index'],
								'id'=>"$model-form-search", 'method'=>'GET']) }}
							<div class="row" style="margin-bottom:10px;">
								<div class="col-sm-10">
									<div class="row">
										<div class="col-sm-3 form-group">
											{{ Form::label('ftxtCodPlanilla', 'Cod. Planilla') }}
											{{ Form::text('ftxtCodPlanilla', null, ['class'=>"form-control input-sm"]) }}
										</div>
										<div class="col-sm-3 form-group">
											{{ Form::label('ftxtApellidoPaterno', 'Apellido paterno') }}
											{{ Form::text('ftxtApellidoPaterno', null, ['class'=>"form-control input-sm"]) }}
										</div>
										<div class="col-sm-3 form-group">
											{{ Form::label('ftxtApellidoMaterno', 'Apellido materno') }}
											{{ Form::text('ftxtApellidoMaterno', null, ['class'=>"form-control input-sm"]) }}
										</div>
										<div class="col-sm-3 form-group">
											{{ Form::label('ftxtNombres', 'Nombres') }}
											{{ Form::text('ftxtNombres', null, ['class'=>"form-control input-sm"]) }}
										</div>
									</div>

								</div>
								<div class="col-sm-2">
									<div style="margin:5px; padding:5px;" class="visible-md visible-lg"></div>
									<div class="text-right">
										<button type="submit" class="btn btn-sm btn-default" id="{{$model}}-btn-search"
												title="buscar"> <i class="fa fa-search"></i></button>
										<a href="#" class="btn btn-sm btn-default" id="{{$model}}-btn-clear"
										   title="limpiar"> <i class="fa fa-refresh"></i></a>
									</div>
								</div>
							</div>
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
		var url = '{{ route("programacion-general.profesionales-salud.index") }}';
		var opcionBlanco  = { id: '', text: '...' };
	</script>

    <script src="{{ asset('js/programacion-general/profesionales-salud.js') }}"></script>
@endpush
