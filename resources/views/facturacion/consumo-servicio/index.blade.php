@extends('layouts.master')

@section('FE', 'active menu-open')
@section('FE.FacturacionGeneral', 'active')

@section('breadcrumb')
<li><a href='#'>Inicio</a></li>
<li><a href='#'>Facturación</a></li>
<li class='active'>Consumo en el Servicio</li>
@endsection

@php
	$model = 'consumoServicio';
@endphp

@section('content')

	{{ Form::hidden($model.'-path-ctrl', route('facturacion.consumo-servicio.index')) }}

	@include('partials.my-modal')

	<div class='row'>
		<div class='col-sm-12'>

			<div class="box box-primary">
				<div class="box-header with-border">
					<h3 class="box-title"><i class="fa fa-battery-2 text-yellow"></i> Consumo en el Servicio</h3>
					<div class="box-tools pull-right">
						<a href="#" class="btn btn-primary btn-xs" id="{{$model}}-btn-create"> <i class="fa fa-plus"></i> Crear</a>
					</div>
				</div>
				<!-- /.box-header -->
				<div class="box-body">
					<div class="row">

						<div class="col-sm-12">
							{{ Form::open(['route' => ['facturacion.consumo-servicio.index'], 
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

@section('scripts')
    <script src="{{ url('/js/facturacion/consumo-servicio.js') }}"></script>
@endsection
