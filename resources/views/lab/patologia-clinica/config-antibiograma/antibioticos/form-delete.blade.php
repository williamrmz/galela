{{  Form::model($antibiotico, ['route' => ['lab.antibioticos.destroy', $antibiotico->id], 'method'=>'DELETE', 'id'=>'antibiotico-form','class'=>'row' ]) }}

    <div class="col-sm-12">
        <div class="form-group">
            {{ Form::label('nombre', 'Nombre (*)') }}
            {{ Form::text('nombre',  null, ['class'=>'form-control input-sm', 'disabled']) }}
        </div>
    </div>

    <div class="col-sm-12">
        <div class="pull-right">
            <a href="" class="btn btn-sm btn-default antibioticos-btn-cancelar" data-dismiss="modal"> CANCELAR</a>
            <button type="submit" class="btn btn-sm btn-danger antibioticos-btn-destroy">ELIMINAR</button>
        </div>
    </div>
    
{{ Form::close() }}