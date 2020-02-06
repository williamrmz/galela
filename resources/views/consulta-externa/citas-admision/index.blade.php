@extends('layouts.master')

@section('sidebar', 'sidebar-collapse')

@section('KX', 'active menu-open')
@section('KX.AdmisionCE', 'active')

@section('breadcrumb')
<li><a href='#'>Inicio</a></li>
<li><a href='#'>Consulta externa</a></li>
<li class='active'>Citas y Admisión</li>
@endsection

@php
	$model = 'citasAdmision';
@endphp

@section('content')

	{{ Form::hidden($model.'-path-ctrl', route('consulta-externa.citas-admision.index')) }}

	@include('partials.my-modal')

	<div class='row'>
		<div class='col-sm-12'>

			<div class="box box-primary">
				<div class="box-header with-border">
					<h3 class="box-title"><i class="fa fa-folder-open text-orange"></i> Citas y Admisión</h3>
					<div class="box-tools pull-right">
						<a href="#" class="btn btn-primary btn-xs" id="{{$model}}-btn-create"> <i class="fa fa-plus"></i> Crear</a>
					</div>
				</div>
				<!-- /.box-header -->
				<div class="box-body">

					<div class="row">

						<div class="col-md-4">
							<div class="row">

								{{-- selector de año --}}
								<div class="col-sm-6">
									<div class="form-group">
										<div class="input-group">
											<span class="input-group-addon">Año</span>
											<select id="cmbAnio" class="form-control input-sm" style="width:100%"> </select>
										</div>
									</div>
								</div>
		
								{{-- Selector de mes --}}
								<div class="col-sm-6">
									<div class="form-group">
										<div class="input-group">
											<span class="input-group-addon">Mes</span>
											<select id="cmbMes" class="form-control input-sm" style="width:100%"> </select>
										</div>
									</div>
								</div>
		
								{{-- Selector de servicios --}}
								<div class="col-sm-12">
									<div class="form-group">
										<div class="input-group">
											<span class="input-group-addon">Servicios</span>
											<select id="cmbServicios" class="form-control input-sm" style="width:100%">
												<option value="">Seleccione...</option>
											</select>
										</div>
									</div>
								</div>
		
								{{-- Selector de medico --}}
								<div class="col-sm-12">
									<table class="table table-condensed table-hover">
										<thead class="bg-purple disabled">
											<tr>
												<td>Medico</td>
												<td>Turno</td>
												<td></td>
											</tr>
										</thead>
										<tbody id="tbody-medicos">
											<tr><td colspan="3" align="center"> Sin resultados</td> </tr>
										</tbody>
									</table>
								</div>
		
								{{-- Selector de dia (Calendario) --}}
								<div class="col-sm-12">
									<div id="div-calendario">
										<table class="table table-condensed table-bordered">
											<thead class="bg-purple disabled">
												<tr align="center">
													<td>Lu</td>
													<td>Ma</td>
													<td>Mi</td>
													<td>Ju</td>
													<td>Vi</td>
													<td>Sa</td>
													<td>Do</td>
												</tr>
											</thead>
											<tbody id="tbody-calendario">
												{{-- js --}}
											</tbody>
										</table>
									</div>
								</div>
		
							</div>
						</div>

						<div class="col-md-3">
							<label for="" class="text-primary">Registro de atenciones</label>
							<div style="height: 500px; overflow-y: scroll;">
								<table class="table table-condensed table-bordered">
									<thead class="bg-gray">
										<tr align="center">
											<td width="40">Hora</td>
											<td>Cita</td>
										</tr>
									</thead>
									<tbody class="tbody-citas">
										<tr><td colspan="2" align="center">Sin programacion</td></tr>
									</tbody>
									
								</table>
							</div>
							
						</div>

						<div class="col-md-5">
							<label for="" class="text-red">Pacientes para</label>
							<div style="height: 500px; overflow-y: scroll;">
								<div class="table-responsive">
									<table class="table table-condensed table-hover table-bordered">
										<thead class="bg-purple disabled">
											<tr>
												<td>HI</td>
												<td>HI</td>
												<td>A.Paterno</td>
												<td>A.Materno</td>
												<td>Nombre</td>
												<td>Fecha</td>
												<td>Hora</td>
											</tr>
										</thead>
										<tbody class="tbody-pacientes">
											<tr> <td colspan="7" align="center">Sin resultados</td></tr>
										</tbody>
									</table>
								</div>
							</div>
						</div>

					</div>
					
				</div>
			</div>
			
		</div>
	</div>

@endsection

@push('scripts')
    <script src="{{ url('/js/consulta-externa/citas-admision.js') }}"></script>
@endpush
