@extends('layouts.master')

@section('CA', 'active menu-open')
@section('CA.GestionCaja', 'active')

@section('breadcrumb')
<li><a href='#'>Inicio</a></li>
<li><a href='#'>Caja</a></li>
<li class='active'>Gestion de caja</li>
@endsection

@php
	$model = 'gestionCaja';
@endphp

@section('content')

	{{ Form::hidden($model.'-path-ctrl', route('caja.gestion-caja.index')) }}

	@include('partials.my-modal')

	<div class='row'>
		<div class='col-sm-12'>

			<div class="box box-primary">
				<div class="box-header with-border">
					<h3 class="box-title"><i class="fa fa-dashboard"></i> Gestion de caja</h3>
					<div class="box-tools pull-right">
						<a href="#" class="btn btn-primary btn-xs" id="{{$model}}-btn-create"> <i class="fa fa-plus"></i> Abrir caja</a>
						<a href="#" class="btn btn-primary btn-xs" id="{{$model}}-btn-edit"> <i class="fa fa-plus"></i> Aperturar caja</a>
						<a href="#" class="btn btn-primary btn-xs disabled" id="{{$model}}-btn-cerrar"> <i class="fa fa-close"></i> Cerrar caja</a>
					</div>
				</div>
				<!-- /.box-header -->
				<div class="box-body">
					<div class="row">
						<div class="col-sm-12">
							{{ Form::open(['route' => ['caja.gestion-caja.index'], 
								'id'=>"$model-form-search", 'method'=>'GET']) }}
									<div class="row">
										<div class="col-sm-1 form-group">
											{{ Form::label('serie', 'Serie') }}
											{{ Form::text('serie', null, ['class'=>'form-control input-sm']) }}
										</div>
										<div class="col-sm-1 form-group">
											{{ Form::label('numDocumento', 'N° Docum') }}
											{{ Form::text('numDocumento', null, ['class'=>'form-control input-sm']) }}
										</div>
										<div class="col-sm-1 form-group">
											{{ Form::label('numHistoria', 'Nro Hist') }}
											{{ Form::text('numHistoria', null, ['class'=>'form-control input-sm']) }}
										</div>
										<div class="col-sm-2 form-group">
											{{ Form::label('cmbCaja', 'Caja') }}
											{{ Form::select('cmbCaja', [], null, ['class'=>'form-control input-ss', 'style'=>'width:100%']) }}
										</div>
										<div class="col-sm-1 form-group">
											{{ Form::label('cmbTurno', 'Turno') }}
											{{ Form::select('cmbTurno', [], null, ['class'=>'form-control input-ss', 'style'=>'width:100%']) }}
										</div>
										<div class="col-sm-2 form-group">
											{{ Form::label('rsocial', 'R. Social') }}
											{{ Form::text('rsocial', null, ['class'=>'form-control input-sm']) }}
										</div>	
										<div class="col-sm-2 form-group">
											{{ Form::label('fechaInicio', 'Fecha I.') }}
											{{ Form::text('fechaInicio', date('d/m/2018 00:00:00'), ['class'=>'form-control input-sm']) }}
										</div>
										<div class="col-sm-2 form-group">
											{{ Form::label('fechaFin', 'Fecha F.') }}
											{{ Form::text('fechaFin', date('d/m/y 23:59:00'), ['class'=>'form-control input-sm']) }}
										</div>
									</div>
									<div class="row">
										<div class="col-sm-12 form-group">
											{{ Form::label('cmbCajero', 'Cajero') }}
											{{ Form::select('cmbCajero', [], null, ['class'=>'form-control input-ss', 'style'=>'width:100%']) }}
										</div>
									</div>
									<div class="row">
										<div class="col-sm-3 form-group">
											<button type="submit" class="btn btn-sm btn-default" id="{{$model}}-btn-search" 
											title="buscar"> <i class="fa fa-search"></i> Buscar</button>
											<a href="#" class="btn btn-sm btn-default" id="{{$model}}-btn-clear" 
											title="limpiar"> <i class="fa fa-refresh"></i></a>
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
    <script src="{{ url('/js/caja/gestion-caja.js?v=Math.random();') }}"></script>
@endpush
