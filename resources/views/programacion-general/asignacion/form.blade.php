<div class="col-md-6">
    <div class="col-sm-12 form-group">
        <div class="input-group" style="width:100%">
            <span class="input-group-addon" style="width:120px">Rol</span>
            {{ Form::select('cmbIdRol', [], null, ['class'=>'form-control input-ss', 'style'=>'width:100%']) }}
        </div>
    </div>

    <div class="col-sm-12 form-group">
        <div class="input-group" style="width:100%">
            <span class="input-group-addon" style="width:120px" title="">Empleado</span>
            {{ Form::select('cmbIdEmpleado', [], null, ['class'=>'form-control input-ss', 'style'=>'width:100%']) }}
        </div>
    </div>

    <div class="col-sm-6 form-group">
        <div class="input-group" style="width:100%">
            <span class="input-group-addon" style="width:120px" title="Apellido paterno">Departamento</span>
            {{ Form::select('cmbIdDepartamento', [], null, ['class'=>'form-control input-ss', 'style'=>'width:100%']) }}

        </div>
    </div>

    <div class="col-sm-6 form-group">
        <div class="input-group" style="width:100%">
            <span class="input-group-addon" style="width:120px" title="Apellido materno">Servicio</span>
            {{ Form::select('cmbIdServicio', [], null, ['class'=>'form-control input-ss', 'style'=>'width:100%']) }}
        </div>
    </div>

</div>


<div class="col-md-6">

    <div class="col-sm-12" style="margin-top: 10px">
        <fieldset class="scheduler-border">
            <legend class="scheduler-border">Empleados por departamento </legend>

            {{--Tabla de especialidades por medico --}}
            <table class="table table-condensed table-bordered table-hover"
                   style="margin-bottom:0">
                <thead>
                <tr class="bg-purple disabled">
                    <td>Empleado</td>
                    <td>Rol</td>
                </tr>
                </thead>
                <tbody class="">
                    <td colspan="2">Sin resultado</td>
                </tbody>
            </table>
        </fieldset>
    </div>

</div>

<div class="col-sm-12 text-right">
    <a href="{{ route('programacion-general.asignacion.index') }}" class="btn btn-default btn-sm btn-cancel">CANCELAR</a>
    <button type="submit" class="btn btn-primary btn-sm btn-save">GUARDAR</button>
</div>
