@extends('layouts.master')

@section('FC', 'active menu-open')
@section('FC.CatalogoBienes', 'active')

@section('breadcrumb')
<li><a href='#'>Inicio</a></li>
<li><a href='#'>Fact - Config</a></li>
<li class='active'>Catalogo de bienes e insumos</li>
@endsection

@php
	$model = 'catalogoBienesInsumos';
	
@endphp

@section('content')

	{{ Form::hidden($model.'-path-ctrl', route('fact-config.catalogo-bienes-insumos.index')) }}

	@include('partials.my-modal')

	<div class='row'>
		<div class='col-sm-12'>

			<div class="box box-primary">
				<div class="box-header with-border">
					<h3 class="box-title"><i class="fa fa-list text-maroon"></i> Catalogo de biened e insumos</h3>
					<div class="box-tools pull-right">
						<a href="#" class="btn btn-primary btn-xs" id="{{$model}}-btn-create"> <i class="fa fa-plus"></i> Crear</a>
					</div>
				</div>
				<!-- /.box-header -->
				<div class="box-body">
					<div class="row">

						<div class="col-sm-12">
							<div class="panel panel-default">
							    <div class="panel-heading">Búsqueda</div>
							    <div class="panel-body">
							    	
									<div class="form-group col-sm-4">
										@php
											$options = [];
											foreach ($tiposCatalogoData as $key => $row) {
												$options[$row->IdTipoFinanciamiento] = $row->Descripcion;
											}
										@endphp
										{{ Form::label('fIdTipoCatalogo', 'Tipo Catalogo')}}
										{{ Form::select('fIdTipoCatalogo', $options, null, ['class'=>"form-control input-sm $model-input-fIdTipoCatalogo"]) }}
									</div>
							    	<div class="form-group col-sm-1">
							    		{{ Form::label ('fCodigo', 'Codigo')}}
							    		{{ Form::text ('fCodigo', null,  ['class'=> "form-control input-sm $model-input-fCodigo"] ) }}
							    	</div>	
							    	<div class="form-group col-sm-4">
							    		{{ Form:: label ('fNombre', 'Nombre')}}
							    		{{ Form:: text ( 'fNombre', null,['class'=>"form-control input-sm $model-input-fNombre"])}}

							    	</div>

							    		<div class="col-sm-2">
							    			<input type="button" " class="btn btn-default" name="btnLimpiar" id="btnLimpiar" value="Limpiar (F7)">
							    		</div>
							    	<div class="form-group col-sm-1">
							    		<input type="button" " class="btn btn-info" name="btnImprimir" id="btnImprimir" value="Imprimir">
							    	</div>
							    	<div class="form-group col-sm-11">
							    		<div class="col-sm-2">
							    			<input type="button" class="btn btn-success" name="btnBuscar" id="btnBuscar" value="Buscar (F6)">
							    		</div>
							    	</div>	
							    </div>
							</div>
						<div class="col-sm-12">
							{{ Form::open(['route' => ['fact-config.catalogo-bienes-insumos.index'], 
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
    <script src="{{ url('/js/fact-config/catalogo-bienes-insumos.js') }}"></script>
@endsection
