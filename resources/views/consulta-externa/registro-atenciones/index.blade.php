@extends('layouts.master')

@section('KX', 'active menu-open')
@section('KX.AtencionesCE', 'active')

@section('breadcrumb')
<li><a href='#'>Inicio</a></li>
<li><a href='#'>Consulta externa</a></li>
<li class='active'>Registro de atenciones</li>
@endsection

@php
	$model = 'registroAtenciones';
@endphp

@section('content')

	{{ Form::hidden($model.'-path-ctrl', route('consulta-externa.registro-atenciones.index')) }}


	@include('partials.my-modal')

	@include('partials.modal', [
		'id'=>'modalRegistroAtencion', 
		'title' => 'Registro de Atencion',
		'size' => 'modal-lg',
		'animation' => false,
		'content'=>view('consulta-externa.registro-atenciones.partials.item-create') 
	])
	
	@include('partials.modal', [
		'id'=>'modalBuscarDiagnostico', 
		'title' => 'Buscar Diagnostico',
		'size' => 'modal-lg',
		'content'=>view('controles.buscar-diagnostico') 
	])

	@include('partials.modal', [
		'id'=>'modalBuscarProcedimiento', 
		'title' => 'Buscar Procedimiento',
		'size' => 'modal-lg',
		'content'=>view('controles.buscar-procedimiento') 
	])

	@include('partials.modal', [
		'id'=>'modalBuscarEstablecimiento', 
		'title' => 'Buscar Establecimiento',
		'size' => 'modal-lg',
		'content'=>view('controles.buscar-establecimiento') 
	])

	
	
	<div class="row">
		<div class="col-sm-12 form-gruop">
			<a href="#" class="btn btn-primary btn-open-modal"> open modal</a>
		</div>
	</div>

	<div class='row'>
		<div class='col-sm-12'>

			<div class="box box-primary">
				<div class="box-header with-border">
					<h3 class="box-title"><i class="fa fa-desktop text-light-blue"></i> Registro de atenciones</h3>
					<div class="box-tools pull-right">
						<a href="#" class="btn btn-primary btn-xs" id="{{$model}}-btn-create"> <i class="fa fa-plus"></i> Crear</a>
					</div>
				</div>
				<!-- /.box-header -->
				<div class="box-body">
					<div class="row">

						<div class="col-sm-12">
							{{ Form::open(['route' => ['consulta-externa.registro-atenciones.index'], 
								'id'=>"$model-form-search", 'method'=>'GET', 'class'=> 'row']) }}

								<div class="col-sm-11">
									<div class="row">
										<div class="form-group col-sm-3">
											<div class="input-group">
												{{ Form::label('', 'Cuenta', ['class'=>'input-group-addon']) }}
												{{ Form::text('fCuenta', null, ['class'=>"form-control input-sm"]) }}
											</div>
											
										</div>
										<div class="form-group col-sm-3">
											<div class="input-group">
												{{ Form::label('', 'DNI', ['class'=>'input-group-addon']) }}
												{{ Form::text('fDni', null, ['class'=>"form-control input-sm"]) }}
											</div>
										</div>
										<div class="form-group col-sm-3">
											<div class="input-group">
												{{ Form::label('', 'historia', ['class'=>'input-group-addon']) }}
												{{ Form::text('fHistoria', null, ['class'=>"form-control input-sm"]) }}
											</div>
										</div>
										<div class="form-group col-sm-3">
											<div class="input-group">
												{{ Form::label('', 'A.Paterno', ['class'=>'input-group-addon']) }}
												{{ Form::text('fApellidoPaterno', null, ['class'=>"form-control input-sm"]) }}
											</div>
										</div>

										<div class="form-group col-sm-4">
											<div class="input-group">
												{{ Form::label('', 'F.Ingreso', ['class'=>'input-group-addon']) }}
												{{ Form::date('fFechaIngreso', null, ['class'=>"form-control"]) }}
											</div>
										</div>
										<div class="form-group col-sm-8">
											@php
												$options = [];
												$options[''] = 'Seleccione...';
												foreach ($cmbIdResponsable as $key => $row) {
													$options[$row->IdServicio] = $row->DservicioHosp;
												}
												// dd( );
											@endphp
											<div class="input-group">
												{{ Form::label('', 'Servicio', ['class'=>'input-group-addon']) }}
												{{ Form::select('fIdServicio', $options, null, ['class'=>"form-control select2"]) }}
											</div>
										</div>
									</div>
								</div>
								<div class="col-sm-1">
									<div class="form-group">
										<button type="submit" class="btn btn-sm btn-block btn-default" id="{{$model}}-btn-search" 
											title="buscar"> <i class="fa fa-search"></i></button>
										<div style="padding: 7px;"></div>
										<a href="#" class="btn btn-sm btn-block btn-default" id="{{$model}}-btn-clear" 
											title="limpiar"> <i class="fa fa-refresh"></i></a>
									</div>
								</div>
								
							{{ Form::close() }}
						</div>

						<div class="col-sm-12 periodos-tabla">
							<div style="width: 100%; height: 500px; overflow-y: scroll;">
								<div class="table-responsive {{$model}}-table">

								</div>
							</div>
						</div>
					</div>
		
				</div>
			</div>
			
		</div>
	</div>

@endsection

@section('scripts')
    <script src="{{ url('/js/consulta-externa/registro-atenciones.js') }}"></script>
@endsection
