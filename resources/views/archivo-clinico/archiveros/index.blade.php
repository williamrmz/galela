@extends('layouts.master')

@section('KA', 'active menu-open')
@section('KA.Archivero', 'active')

@section('breadcrumb')
<li><a href='#'>Inicio</a></li>
<li><a href='#'>Archivo Clinico</a></li>
<li class='active'>Archiveros</li>
@endsection

@php
	$model = 'archiveros';
@endphp

@section('content')

	{{ Form::hidden($model.'-path-ctrl', route('archivo-clinico.archiveros.index')) }}

	@include('partials.my-modal')

	@include('partials.my-modal', ['id'=>'mySubModal'])

	<div class='row'>
		<div class='col-sm-12'>

			<div class="box box-primary">
				<div class="box-header with-border">
					<h3 class="box-title"><i class="fa fa-archive text-green"></i> Archiveros</h3>
					<div class="box-tools pull-right">
						<a href="#" class="btn btn-primary btn-xs" id="{{$model}}-btn-create"> <i class="fa fa-plus"></i> Crear</a>
					</div>
				</div>
				<!-- /.box-header -->
				<div class="box-body">
					<div class="row">

						<div class="col-sm-12">
							{{ Form::open(['route' => ['archivo-clinico.archiveros.index'], 
								'id'=>"$model-form-search", 'method'=>'GET', 'class'=> 'row']) }}

								<div class="col-sm-2 form-group">
									{{ Form::label('fCodigoPlanilla', 'Codigo Planilla') }}
									{{ Form::text('fCodigoPlanilla', null, ['class'=>'form-control'])}}
								</div>

								<div class="col-sm-3 form-group">
									{{ Form::label('fApellidoPaterno', 'Apellido Paterno') }}
									{{ Form::text('fApellidoPaterno', null, ['class'=>'form-control'])}}
								</div>	

								<div class="col-sm-3 form-group">
									{{ Form::label('fApellidoMaterno', 'Apellido Materno') }}
									{{ Form::text('fApellidoMaterno', null, ['class'=>'form-control'])}}
								</div>

								<div class="col-sm-3 form-group">
									{{ Form::label('fNombres', 'Nombre') }}
									{{ Form::text('fNombres', null, ['class'=>'form-control'])}}
								</div>

								<div class="col-sm-1 from-group">
									<button type="submit" class="btn btn-xs btn-block btn-default" id="{{$model}}-btn-search" 
										title="buscar"> <i class="fa fa-search"></i></button>
									<a href="#" class="btn btn-xs btn-block btn-default" id="{{$model}}-btn-clear" 
										title="limpiar"> <i class="fa fa-refresh"></i></a>
								</div>

								
							{{ Form::close() }}
						</div>

						<div class="col-sm-12 periodos-tabla" style="margin-top:10px;">
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
    <script src="{{ url('/js/archivo-clinico/archiveros.js') }}"></script>
@endsection
