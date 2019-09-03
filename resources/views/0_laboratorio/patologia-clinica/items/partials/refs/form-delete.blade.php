{{  Form::model($ref, ['route' => ['lab.refs.destroy', $ref->id_valor], 'method'=>'DELETE', 'id'=>'ref-form','class'=>'row' ]) }}

    <div class="col-sm-6">
        <div class="form-group">
            {{ Form::label('valor_tipo', 'Tipo') }}
            {{ Form::select('valor_tipo', ['N'=>'Numerica', 'T'=>'Textual'], null, ['class'=>'form-control input-sm', 'disabled']) }}
        </div>

        <div class="form-group">
            {{ Form::label('sexo_id', 'Sexo') }}
            {{ Form::select('sexo_id', ['3'=>'Ambos', '1'=>'Masculino', '2'=>'Femenino'], null, ['class'=>'form-control input-sm', 'disabled']) }}
        </div>

        <div class="form-group">
            {{ Form::label('edad_min', 'Rango Edad') }}
            <div class="input-group">
                {{ Form::number('edad_min', null, ['class'=>'form-control input-sm', 'placeholder'=>'min', 'disabled']) }}
                <span class="input-group-addon"></span>
                {{ Form::number('edad_max', null, ['class'=>'form-control input-sm', 'placeholder'=>'max', 'disabled']) }}
                <span class="input-group-addon"></span>
                {{ Form::select('edad_unidad', ['A'=>'años', 'D'=>'dias'], null, ['class'=>'form-control input-sm', 'disabled']) }}
            </div>
        </div>

    </div>

    <div class="col-sm-6">
        <div class="form-group">
            {{ Form::label('', 'Rango Valore (s)') }}
            <div class="input-group rango-valor-numero">
                {{ Form::number('valor_min', null, ['class'=>'form-control input-sm', 'placeholder'=>'min', 'disabled']) }}
                <span class="input-group-addon"></span>
                {{ Form::number('valor_max', null, ['class'=>'form-control input-sm', 'placeholder'=>'max', 'disabled']) }}
                <span class="input-group-addon"></span>
                {{ Form::text('valor_unidad', null, ['class'=>'form-control input-sm', 'placeholder'=>'unidad', 'disabled']) }}
            </div>
            <div class="rango-valor-texto">
                {{ Form::text('valor_txt', null, ['class'=>'form-control input-sm', 'placeholder'=>'txt', 'disabled']) }}
            </div>
        </div>
        <div class="form-group">
            {{ Form::label('', 'Alerta (s)') }}
            <div class="input-group rango-alerta-numero">
                {{ Form::textarea('alerta_inf', null, ['class'=>'form-control input-sm', 'rows'=>5, 'placeholder'=>'inf', 'disabled']) }}
                <span class="input-group-addon"></span>
                {{ Form::textarea('alerta_sup', null, ['class'=>'form-control input-sm', 'rows'=>5, 'placeholder'=>'sup', 'disabled']) }}
            </div>
            <div class="rango-alerta-texto">
                {{ Form::textarea('alerta_txt', null, ['class'=>'form-control input-sm', 'rows'=>5, 'placeholder'=>'txt', 'disabled']) }}
            </div>
        </div>
    </div>

    <div class="col-sm-12">
        <div class="pull-right">
            <a href="" class="btn btn-sm btn-default refs-btn-cancelar" data-dismiss="modal"> CANCELAR</a>
            <button type="submit" class="btn btn-sm btn-danger refs-btn-destroy">ELIMINAR</button>
        </div>
    </div>
    
{{ Form::close() }}