{{  Form::model($item, ['route' => ['lab.firmas.update', $item->IdEmpleado], 
    'method'=>'PUT', 'id'=>'firma-form', 'enctype'=>'multipart/form-data', 'class'=>'row' ]) }}

    <div class="col-sm-12 form-group">
        {{ Form::text('fullname', $item->fullname(), ['class'=>'form-control input-sm', 'readonly']) }}
    </div>

    <div class="col-sm-12 form-group">
        {{ Form::file('firma', null, ['class'=>'form-control input-sm', 'id'=>'firma']) }}
    </div>

    <div class="col-sm-12 form-group text-center">
        @php
            $firma = ($item->Firma)? $item->Firma: 'NOT_SIGN.jpg';
        @endphp
        <img src="{{ url('/storage/images/firmas/'.$firma.'?'.rand(1,1000) ) }}" id="photo-preview" alt="firma" width="200"  height="80">
    </div>

    <div class="col-sm-12">
        <div class="pull-right">
            <a href="" class="btn btn-sm btn-default firmas-btn-cancelar" data-dismiss="modal"> CANCELAR</a>
            <button type="submit" class="btn btn-sm btn-primary firmas-btn-actualizar">ACTUALIZAR</button>
        </div>
    </div>
    
{{ Form::close() }}