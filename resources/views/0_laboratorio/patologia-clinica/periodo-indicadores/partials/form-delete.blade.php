{{  Form::model($periodo, ['route' => ['lab.periodos.destroy', $periodo->IdPeriodo], 'method'=>'DELETE', 'id'=>'periodo-form','class'=>'row' ]) }}

    <div class="col-sm-12 form-group">
        {{ Form::label('IdArea', 'Area (*)') }}
        {{ Form::select('IdArea',  $areas, null, ['class'=>'form-control input-sm', 'disabled']) }}
    </div>

    <div class="col-sm-12 form-group">
        {{ Form::label('Mes', 'Periodo (*)') }}
        <div class="input-group">
            {{ Form::select('Mes',  $meses, null, ['class'=>'form-control input-sm', 'disabled']) }}
            <span class="input-group-addon"></span>
            {{ Form::select('Anio',  $anios, null, ['class'=>'form-control input-sm', 'disabled']) }}
        </div>
    </div>

    <div class="col-sm-12 form-group">
        {{ Form::label('Descrip', 'Descripcion') }}
        {{ Form::textarea('Descrip', null, ['class'=>'form-control input-sm', 'rows'=>'3', 'disabled']) }}
    </div>

    <div class="col-sm-12">
        <div class="pull-right">
            <a href="" class="btn btn-sm btn-default periodos-btn-cancelar" data-dismiss="modal"> CANCELAR</a>
            <button type="submit" class="btn btn-sm btn-danger periodos-btn-destroy">ELIMINAR</button>
        </div>
    </div>
    
{{ Form::close() }}