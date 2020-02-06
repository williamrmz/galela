@extends('layouts.master')

@section('KP', 'active menu-open')
@section('KP.Programacion', 'active')

@section('breadcrumb')
<li><a href='#'>Inicio</a></li>
<li><a href='#'>Programacion General</a></li>
<li class='active'>Programacion</li>
@endsection

@php
	$model = 'programacion';
@endphp

@section('content')

	@include('programacion-general.programacion.partials.item-form')

	<div class='row' id="listado-programacion">
		<div class='col-sm-12'>

			<div class="box box-primary">
				<div class="box-header with-border">
					<h3 class="box-title"><i class="fa fa-calendar text-yellow"></i> Programación general</h3>
					<div class="box-tools pull-right">
						<a href="#" class="btn btn-primary btn-xs" id="{{$model}}-btn-create"> <i class="fa fa-plus"></i> Crear</a>
					</div>
				</div>
				<!-- /.box-header -->
				<div class="box-body">
					<div class="row">
						<div class="col-sm-3">
							<h5>Buscar por médico</h5>

							<div class="row">

								{{-- Departamento --}}
								<div class="col-sm-12 form-group">
									<div class="input-group" style="width:100%">
										<span class="input-group-addon" style="width:120px">Departamento</span>
										{{ Form::select('fcmbIdDepartamento', [], null, ['class'=>'form-control input-ss', 'style'=>'width:100%']) }}
									</div>
								</div>

								{{-- Especialidad --}}
								<div class="col-sm-12 form-group">
									<div class="input-group" style="width:100%">
										<span class="input-group-addon" style="width:120px">Especialidad</span>
										{{ Form::select('fcmbIdEspecialidad', [], null, ['class'=>'form-control input-ss', 'style'=>'width:100%']) }}
									</div>
								</div>

								{{-- Médico --}}
								<div class="col-sm-12 form-group">
									<div class="input-group" style="width:100%">
										<span class="input-group-addon" style="width:120px">Médico</span>
										{{ Form::select('fcmbIdMedico', [], null, ['class'=>'form-control input-ss', 'style'=>'width:100%']) }}
									</div>
								</div>
							</div>


						</div>
						<div class="col-sm-3">
							<h5>Listado por día</h5>
							<div class="listado-dia-programacion">
								@include('programacion-general.programacion.partials.item-list')
							</div>
						</div>

						<div class="col-sm-3">
							<h5>Programación mensual</h5>
							<div class="listado-mes-programacion">

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
		var url = '{{ route("programacion-general.programacion.index") }}';
		var opcionBlanco  = { id: '', text: '...' };
		console.log(url);
	</script>


	<script src="{{ asset('js/programacion-general/programacion.js') }}"></script>
@endpush
