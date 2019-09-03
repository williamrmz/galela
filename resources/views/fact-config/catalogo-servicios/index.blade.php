@extends('layouts.master')

@section('FC', 'active menu-open')
@section('FC.FacturacionCatalogoServicios', 'active')

@section('breadcrumb')
<li><a href='#'>Inicio</a></li>
<li><a href='#'>Fact - Config</a></li>
<li class='active'>Catalogo de servicios</li>
@endsection

@php
	$model = 'catalogoServicios';
@endphp

@section('content')

	{{ Form::hidden($model.'-path-ctrl', route('fact-config.catalogo-servicios.index')) }}

	@include('partials.my-modal')

	<div class='row'>
		<div class='col-sm-12'>

			<div class="box box-primary">
				<div class="box-header with-border">
					<h3 class="box-title"><i class="fa fa-list text-blue"></i> Catalogo de servicios</h3>
					<div class="box-tools pull-right">
						<a href="#" class="btn btn-primary btn-xs" id="{{$model}}-btn-create"> <i class="fa fa-plus"></i> Crear</a>
					</div>
				</div>
				<!-- /.box-header -->
				<div class="box-body">
					<div class="row">

						<div class="col-sm-12">
							{{ Form::open(['route' => ['fact-config.catalogo-servicios.index'], 
								'id'=>"$model-form-search", 'method'=>'GET', 'class'=> 'row']) }}
								@php
									$options = [];
									foreach ($tiposCatalogoData as $key => $row) {
										$options[$row->IdTipoFinanciamiento] = $row->Descripcion;
									}
								@endphp
								<div class="col-sm-4 form-group">
									{{ Form::label('fIdTipoCatalogo', 'Tipo Catalogo')}}
									{{ Form::select('fIdTipoCatalogo', $options, null, ['class'=>"form-control input-sm $model-input-fIdTipoCatalogo"]) }}
								</div>
								<div class="col-sm-3 form-group">
									{{ Form::label('fCodigo', 'Codigo')}}
									{{ Form::text('fCodigo', 20003, ['class'=>"form-control input-sm $model-input-fNombre"]) }}
								</div>
								<div class="col-sm-4 form-group">
									{{ Form::label('fNombre', 'Nombre')}}
									{{ Form::text('fNombre', null, ['class'=>"form-control input-sm $model-input-fCodigo"]) }}
								</div>

								<div class="col-sm-1 form-group">
									<button type="submit" class="btn btn-sm btn-block btn-default" id="{{$model}}-btn-search" 
										title="buscar"> <i class="fa fa-search"></i></button>
									<a href="#" class="btn btn-sm btn-block btn-default" id="{{$model}}-btn-clear" 
										title="limpiar"> <i class="fa fa-refresh"></i></a>
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

@section('scripts')
    <script src="{{ url('/js/fact-config/catalogo-servicios.js') }}"></script>
@endsection
