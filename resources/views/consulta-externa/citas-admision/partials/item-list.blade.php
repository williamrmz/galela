@php
	$model = 'citasAdmision';


	$meses = [
		1 => 'Enero', 
		2 => 'Febrero', 
		3 => 'Marzo', 
		4 => 'Abril', 
		5 => 'Mayo', 
		6 => 'Junio', 
		7 => 'Julio', 
		8 => 'Agosto', 
		9 => 'Septiembre', 
		10 => 'Octubre', 
		11 => 'Noviembre', 
		12 => 'Diciembre'
		];
@endphp

<div class="row" >
	<div class="col-sm-3">
		<div class="row">
			<div class="col-sm-12">
				<fieldset class="scheduler-border">
					<legend class="scheduler-border">Filtros</legend>

					<div class="form-group">
						<div class="input-group">
							<span class="input-group-addon" title="Medico">M</span>
							<select id="select-medico" class="form-control input-sm">
								<option value="">Seleccione...</option>
							</select>
						</div>
					</div>
					<div class="form-group">
						<div class="input-group">
							<span class="input-group-addon" title="Consultorio">C</span>
							<select id="select-medico" class="form-control input-sm">
								<option value="">Seleccione...</option>
							</select>
						</div>
					</div>
				</fieldset>
			</div>
			<div class="col-sm-12">
				<fieldset class="scheduler-border">
					<legend class="scheduler-border">Medicos programados</legend>
					<table class="table table-condensed  table-hover table-bordered">
						<thead class="bg-purple disabled">
							<tr> <td colspan="2">Medico</td> <td>Consultorio</td> </tr>
						</thead>
						<tbody>
							<tr> 
								<td><input type="radio" name="medico-seleccionado"></td>
								<td>Medico ABC</td> 
								<td>Consultorio ABC</td> 
							</tr>
							<tr> 
								<td><input type="radio" name="medico-seleccionado"></td>
								<td>Medico XYZ</td> 
								<td>Consultorio XYZ</td> 
							</tr>
						</tbody>
					</table>
				</fieldset>
				
			</div>
			<div class="col-sm-12">
				<fieldset class="scheduler-border">
					<legend class="scheduler-border">Especialidades del médico</legend>
					<div class="form-group">
						<select id="select-especialidades-medico" class="form-control input-sm">
							<option value="">Seleccione...</option>
						</select>
					</div>
					<div class="row " style="margin-bottom:10px;">
						<div class="col-sm-6">
							<a href="#" class="btn btn-sm btn-flat btn-block btn-default">Cita Adicional</a>
						</div>
						<div class="col-sm-6">
							<a href="#" class="btn btn-sm btn-flat btn-block btn-default">Refrescar</a>
						</div>
					</div>
				</fieldset>
			</div>
		</div>
	</div>
	<div class="col-sm-9">
		<div class="row">
			<div class="col-sm-5">
				<div style="width: 100%; height: 470px; overflow-y: scroll;">
					<table class="table table-condensed table-bordered">
						<tbody>
							@for ($i = 0; $i < 10; $i++)
								<tr>
									<td width="50">8:00</td>
									<td rowspan="3"> detalle</td>
								</tr>
								<tr>
									<td width="50">8:05</td>
								</tr>
								<tr>
									<td width="50">8:10</td>
								</tr>
							@endfor
						</tbody>
					</table>
				</div>
				
			</div>
			<div class="col-sm-7">
				<div class="row">
					<div class="col-sm-12">
						<table class="table table-condensed table-bordered">
							<thead class="bg-blue disabled">
								<tr >
									<td colspan="4">
										<select name="calendar-months" class="form-control input-sm">
											<option value="1">Enero</option>
											<option value="1">Febrero</option>
											<option value="1">Marzo</option>
											<option value="1">Abril</option>
											<option value="1">Mayo</option>
											<option value="1">Junio</option>
											<option value="1">Julio</option>
											<option value="1">Agosto</option>
											<option value="1">Septiembre</option>
											<option value="1">Octubre</option>
											<option value="1">Noviembre</option>
											<option value="1">Diciembre</option>
										</select>
									</td>
									<td colspan="3">
										<select name="calendar-years" class="form-control input-sm">
											<option value="2015">2015</option>
											<option value="2016">2016</option>
											<option value="2017">2017</option>
											<option value="2018">2018</option>
											<option value="2019" selected>2019</option>
											<option value="2020">2020</option>
											<option value="2021">2021</option>
											<option value="2022">2022</option>
											<option value="2023">2023</option>
											<option value="2023">2023</option>
											<option value="2024">2024</option>
											<option value="2025">2025</option>
										</select>	
									</td>
								</tr>
								<tr>
									<td>Lun</td>
									<td>Mar</td>
									<td>Mie</td>
									<td>Jue</td>
									<td>Vie</td>
									<td>Sab</td>
									<td>Dom</td>
								</tr>
							</thead>
							<tbody>
								@for ($i = 0; $i < 6; $i++)
									<tr>
										<td>1</td>
										<td>2</td>
										<td>3</td>
										<td>4</td>
										<td>5</td>
										<td>6</td>
										<td>6</td>
									</tr>	
								@endfor
							</tbody>
						</table>
					</div>
					<div class="col-sm-12">
						<fieldset class="scheduler-border">
							<legend class="scheduler-border">*</legend>
							<div class="row">
								<div class="col-sm-6">Dias programados al medico</div>
								<div class="col-sm-6">Fecha selec</div>
								<div class="col-sm-6">Cupos Asignados</div>
								<div class="col-sm-6">Cupos Libres</div>
								<div class="col-sm-6">CUPOS LIBRES DE : DIAZ FUENTES GONZALO (0)</div>
							</div>
						</fieldset>
					</div>
					<div class="col-sm-12">
						<div style="width: 100%; height: 100px; overflow-y: scroll;">
							<table class="table table-condensed">
								<thead class="bg-purple disabled">
									<tr>
										<td>HI</td> <td>HF</td> <td>A.Paterno</td> <td>A.Materno</td> <td>Nombre</td> <td>F.Solicitud</td> <td>Hr.Solicitada</td>
									</tr>
								</thead>
								<tbody>
									<tr>

									</tr>
								</tbody>
							</table>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

