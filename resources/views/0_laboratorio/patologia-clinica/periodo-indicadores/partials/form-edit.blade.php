{{  Form::model($periodo, ['route' => ['lab.periodos.update', $periodo->IdPeriodo], 'method'=>'PUT', 'id'=>'periodo-form','class'=>'row' ]) }}

    <div class="col-sm-12 form-group">
        {{ Form::label('IdArea', 'Area (*)') }}
        {{ Form::select('IdArea',  $areas, null, ['class'=>'form-control input-sm']) }}
    </div>

    <div class="col-sm-12 form-group">
        {{ Form::label('Mes', 'Periodo (*)') }}
        <div class="input-group">
            {{ Form::select('Mes',  $meses, null, ['class'=>'form-control input-sm']) }}
            <span class="input-group-addon"></span>
            {{ Form::select('Anio',  $anios, null, ['class'=>'form-control input-sm']) }}
        </div>
    </div>

    <div class="col-sm-12 form-group">
        {{ Form::label('Descrip', 'Descripcion') }}
        {{ Form::textarea('Descrip', null, ['class'=>'form-control input-sm', 'rows'=>'3']) }}
    </div>

    <div class="col-sm-12">
        <div class="pull-right">
            <a href="" class="btn btn-sm btn-default periodos-btn-cancelar" data-dismiss="modal"> CANCELAR</a>
            <button type="submit" class="btn btn-sm btn-primary periodos-btn-update">ACTUALIZAR</button>
        </div>
    </div>
    
{{ Form::close() }}