@php
	$origen_form = "PACIENTE";
	$model = 'paciente';
	$action = 'CREATE';
	$idPaciente = 0;
@endphp

{{ Form::hidden($model.'-path-ctrl', route('consulta-externa.paciente.index')) }}
{{ Form::hidden('current_action', $action, ['class'=>'current_action']) }}
{{ Form::hidden('id_paciente', $idPaciente, ['class'=>'id_paciente']) }}

{{  Form::open(['route' => ['consulta-externa.paciente.store'], 'method'=>'POST', 'id'=>$model.'-form', 'enctype' => 'multipart/form-data']) }}

{{ Form::hidden('idPaciente', '0', ['id'=>'idPaciente' ]) }}
{{ Form::hidden('accion', 'CREATE', ['id'=>'accion' ]) }}
{{ Form::hidden('tipoNumeracionAnterior', null, ['id'=>'tipoNumeracionAnterior' ]) }}



<div class="row" id="partial-crud" style="display: none">
	<div class="col-sm-12">
		<div class="nav-tabs-custom">
			<div class="tab-content" style="padding-bottom:40px;">
				<div id="paciente-form-div">
				@include('consulta-externa.paciente.partials.html-form')
				</div>
				<div class="col-sm-12 text-right">
					<a href="#" class="btn btn-default btn-sm btn-cancel">CANCELAR</a>
					<a href="#" class="btn btn-primary btn-sm btn-save">GUARDAR</a>
				</div>
			</div>
		  </div>
	</div>

	
</div>
{{ Form::close() }}
