@extends('layouts.master')

@section('KX', 'active menu-open')
@section('KX.PacienteCE', 'active')

@section('breadcrumb')
<li><a href='#'>Inicio</a></li>
<li><a href='#'>Consulta externa</a></li>
<li class='active'>Paciente</li>
@endsection

@php
	$model = 'paciente';
@endphp

@section('content')

	{{ Form::hidden($model.'-path-ctrl', route('consulta-externa.paciente.index')) }}

	@include('partials.my-modal')

	@include('consulta-externa.paciente.partials.item-create')

	<div class='row' id="partial-list">
		<div class='col-sm-12'>

			<div class="box box-primary">
				<div class="box-header with-border">
					<h3 class="box-title"><i class="fa fa-male text-aqua"></i> Paciente</h3>
					<div class="box-tools pull-right">
						<a href="#" class="btn btn-primary btn-xs" id="{{$model}}-btn-create"> <i class="fa fa-plus"></i>Crear</a>
					</div>
				</div>
				<!-- /.box-header -->
				<div class="box-body">
					<div class="row">

						<div class="col-sm-12">
							{{ Form::open(['route' => ['consulta-externa.paciente.index'], 
								'id'=>"$model-form-search", 'method'=>'GET']) }}
								<div class="row" style="margin-bottom:10px;">
									<div class="col-sm-10">
										<div class="row">
											<div class="col-sm-3 form-group">
												{{ Form::label('ftxtDni', 'DNI') }}
												{{ Form::text('ftxtDni', null, ['class'=>"form-control input-sm"]) }}
											</div>
											<div class="col-sm-3 form-group">
												{{ Form::label('ftxtNroHistoria', 'Historia') }}
												{{ Form::text('ftxtNroHistoria', null, ['class'=>"form-control input-sm"]) }}
											</div>
											<div class="col-sm-3 form-group">
												{{ Form::label('ftxtApellidoPaterno', 'A.Paterno') }}
												{{ Form::text('ftxtApellidoPaterno', null, ['class'=>"form-control input-sm"]) }}
											</div>
											<div class="col-sm-3 form-group">
												{{ Form::label('ftxtApellidoMaterno', 'A.Materno') }}
												{{ Form::text('ftxtApellidoMaterno', null, ['class'=>"form-control input-sm"]) }}
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
								@include('consulta-externa.paciente.partials.item-list', ['mode'=>'NO_DATA'])
							</div>
						</div>
					</div>
		
				</div>
			</div>
			
		</div>
	</div>

@endsection

@push('scripts')
	<script src="{{ url('/js/consulta-externa/paciente.js') }}"></script>
	<script src="{{ url('/js/consulta-externa/paciente.crudv2.js') }}"></script>
@endpush
