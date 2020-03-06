@extends('layouts.master')

@section('CA', 'active menu-open')
@section('CA.Cajas', 'active')

@section('breadcrumb')
<li><a href='#'>Inicio</a></li>
<li><a href='#'>Caja</a></li>
<li class='active'>Cajas</li>
@endsection

@php
	$model = 'cajas';
@endphp

@section('content')

	{{ Form::hidden($model.'-path-ctrl', route('caja.cajas.index')) }}

	@include('partials.my-modal')

	<div class='row'>
		<div class='col-sm-12'>

			<div class="box box-primary">
				<div class="box-header with-border">
					<h3 class="box-title"><i class="fa fa-inbox text-blue"></i> Cajas</h3>
					<div class="box-tools pull-right">
						<a href="#" class="btn btn-primary btn-xs" id="{{$model}}-btn-create"> <i class="fa fa-plus"></i> Agregar</a>
					</div>
				</div>
				<!-- /.box-header -->
				<div class="box-body">
					<div class="row">

						<div class="col-sm-12">
							{{ Form::open(['route' => ['caja.cajas.index'], 
								'id'=>"$model-form-search", 'method'=>'GET', 'class'=> 'form-inline pull-right']) }}
								<div class="form-group">
									{{ Form::label('fCodigo', 'Codigo') }}
									{{ Form::text('fCodigo', null, ['class'=>"form-control input-sm $model-input-search"]) }}
								</div>
								<div class="form-group">
									{{ Form::label('fDescripcion', 'Descripción') }}
									{{ Form::text('fDescripcion', null, ['class'=>"form-control input-sm $model-input-search"]) }}
								</div>
								<button type="submit" class="btn btn-sm btn-default" id="{{$model}}-btn-search" 
									title="buscar"> <i class="fa fa-search"></i></button>
								<a href="#" class="btn btn-sm btn-default" id="{{$model}}-btn-clear" 
									title="limpiar"> <i class="fa fa-refresh"></i></a>
							{{ Form::close() }}
						</div>
								<br><br><br>
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
    <script src="{{ url('/js/caja/cajas.js') }}"></script>
@endpush
