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
	$model = 'citas-admision';
@endphp

@section('content')
	@include('consulta-externa.citas-admision.partials.item-form')

	<div class='row' id="citas-listado">
		<div class='col-sm-12'>

			<div class="box box-primary">
				<div class="box-header with-border">
					<h3 class="box-title"><i class="fa fa-folder-open text-orange"></i> Citas y Admisión</h3>
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
											{{ Form::selectRange('cmbAnio', date('Y'), 2005, date('Y'), ['class'=>'form-control']) }}
										</div>
									</div>
								</div>

								{{-- Selector de mes --}}
								<div class="col-sm-6">
									<div class="form-group">
										<div class="input-group">
											<span class="input-group-addon">Mes</span>
											{!! Form::selectMes("cmbMes", date('m'))  !!}
										</div>
									</div>
								</div>

								{{-- Selector de servicios --}}
								<div class="col-sm-12">
									<div class="form-group">
										<div class="input-group">
											<span class="input-group-addon">Servicios</span>
											<select name="cmbIdServicio" class="form-control input-sm" style="width:100%">
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
												<td></td>
											</tr>
										</thead>
										<tbody id="tbody-medicos">
											<tr><td colspan="2" align="center"> Sin resultados</td> </tr>
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
								<div class="atenciones-cronograma-dia">
                                    @include('consulta-externa.citas-admision.partials.item-list-atenciones')
                                </div>
							</div>

						</div>

						<div class="col-md-5">
							<label for="" class="text-red">Pacientes</label>
							<div style="height: 500px; overflow-y: scroll;">
                                <div class="atenciones-listado-dia">
                                    @include('consulta-externa.citas-admision.partials.item-list-pacientes-dia')
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

	<script>
		var model = '{{ $model }}';
		var url = '{{ route("consulta-externa.citas-admision.index") }}';
		var urlPaciente = '{{ route("consulta-externa.paciente.index") }}';
		var urlControles = '{{ route("controles") }}';
		var opcionBlanco  = { id: '', text: '...' };
	</script>

    <script src="{{ url('/js/consulta-externa/citas-form.js') }}"></script>
@endpush
