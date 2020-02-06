{{  Form::open(['route' => ['lab.germenes.store'], 'method'=>'POST', 'id'=>'germen-form','class'=>'row' ]) }}

    <div class="col-sm-12">
        <div class="form-group">
            {{ Form::label('nombre', 'Nombre (*)') }}
            {{ Form::text('nombre',  null, ['class'=>'form-control input-sm']) }}
        </div>
    </div>

    <div class="col-sm-12">
        <div class="pull-right">
            <a href="" class="btn btn-sm btn-default germenes-btn-cancelar" data-dismiss="modal"> CANCELAR</a>
            <button type="submit" class="btn btn-sm btn-primary germenes-btn-store">CREAR</button>
        </div>
    </div>
    
{{ Form::close() }}