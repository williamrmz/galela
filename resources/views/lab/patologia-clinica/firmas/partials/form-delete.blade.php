{{  Form::model($item, ['route' => ['lab.firmas.destroy', $item->IdEmpleado], 
    'method'=>'DELETE', 'id'=>'firma-form', 'class'=>'row' ]) }}

    <div class="col-sm-12 form-group text-center">
        <p> ¿Elimnar firma del empleado <b>{{ $item->fullname() }}</b> ?</p>
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
            <button type="submit" class="btn btn-sm btn-danger firmas-btn-destroy">ELIMINAR</button>
        </div>
    </div>
    
{{ Form::close() }}