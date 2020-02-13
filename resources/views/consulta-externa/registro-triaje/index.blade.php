@extends('layouts.master')

@section('KX', 'active menu-open')
@section('KX.AtencionesTriaje', 'active')

@section('breadcrumb')
<li><a href='#'>Inicio</a></li>
<li><a href='#'>Consulta externa</a></li>
<li class='active'>Registro de Triaje</li>
@endsection

@php
	$model = 'registro-triaje';
@endphp

@section('content')

	@include('consulta-externa.registro-triaje.partials.item-form')

	<div class='row' id="listado-{{$model}}">
		<div class='col-sm-12'>

			<div class="box box-primary">
				<div class="box-header with-border">
					<h3 class="box-title"><i class="fa fa-hotel text-blue"></i> Registro de Triaje</h3>
					<div class="box-tools pull-right">
						<a href="#" class="btn btn-primary btn-xs" id="{{$model}}-btn-create"> <i class="fa fa-plus"></i> Crear</a>
					</div>
				</div>
				<!-- /.box-header -->
				<div class="box-body">
					<div class="row">

						<div class="col-sm-12">
							{{ Form::open(['route' => ['consulta-externa.registro-triaje.index'],
								'id'=>"$model-form-search", 'method'=>'GET']) }}
							<div class="row" style="margin-bottom:10px;">
								<div class="col-sm-11">
									<div class="row">
										<div class="col-md-2 form-group">
											{{ Form::label('ftxtNroHistoria', 'Nro. Historia') }}
											{{ Form::text('ftxtNroHistoria', null, ['class'=>"form-control input-sm"]) }}
										</div>
										<div class="col-md-2 form-group">
											{{ Form::label('ftxtApellidoPaterno', 'Apellido paterno') }}
											{{ Form::text('ftxtApellidoPaterno', null, ['class'=>"form-control input-sm"]) }}
										</div>
										<div class="col-md-2 form-group">
											{{ Form::label('ftxtApellidoMaterno', 'Apellido materno') }}
											{{ Form::text('ftxtApellidoMaterno', null, ['class'=>"form-control input-sm"]) }}
										</div>
										<div class="col-md-2 form-group">
											{{ Form::label('ftxtDni', 'DNI') }}
											{{ Form::number('ftxtDni', null, ['class'=>"form-control input-sm"]) }}
										</div>

										<div class="col-md-2 form-group">
											{{ Form::label('ftxtNroCuenta', 'Nro. Cuenta') }}
											{{ Form::number('ftxtNroCuenta', null, ['class'=>"form-control input-sm"]) }}
										</div>

										<div class="col-md-2 form-group">
											{{ Form::label('cmbFechaTriaje', 'Fecha triaje') }}
											{{ Form::select('cmbFechaTriaje', [date('d-m-Y') => date('d-m-Y'), '' => 'Todos'], date('d-m-Y'), ['class'=>'form-control input-sm']) }}
										</div>
									</div>

								</div>
								<div class="col-sm-1">
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
							@include('consulta-externa.registro-triaje.partials.item-list')
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
		var url = '{{ route("consulta-externa.registro-triaje.index") }}';
		var opcionBlanco = {id: '', text: '...'};
	</script>

    <script src="{{ asset('js/consulta-externa/registro-triaje.js') }}"></script>
@endpush
