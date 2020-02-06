{{  Form::model($item, ['route' => ['lab.items.update', $item->idItem], 'method'=>'PUT', 'id'=>'item-form','class'=>'row' ]) }}

    <div class="col-sm-12 form-group">
        {{ Form::text('Item', null, ['class'=>'form-control input-sm']) }}
    </div>

    <div class="col-sm-12">
        <div class="pull-right">
            <a href="" class="btn btn-sm btn-default items-btn-cancelar" data-dismiss="modal"> CANCELAR</a>
            <button type="submit" class="btn btn-sm btn-primary items-btn-update">ACTUALIZAR</button>
        </div>
    </div>
    
{{ Form::close() }}