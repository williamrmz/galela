{{  Form::model($item, ['route' => ['lab.items.destroy', $item->idItem], 'method'=>'DELETE', 'id'=>'item-form','class'=>'row' ]) }}

    <div class="col-sm-12 text-center form-group">
        <p>¿ Eliminar el item <b>{{ $item->Item }}</b> ?</p>
    </div>

    <div class="col-sm-12">
        <div class="pull-right">
            <a href="" class="btn btn-sm btn-default items-btn-cancelar" data-dismiss="modal"> CANCELAR</a>
            <button type="submit" class="btn btn-sm btn-danger items-btn-destroy">DELETE</button>
        </div>
    </div>
    
{{ Form::close() }}