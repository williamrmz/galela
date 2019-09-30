@php
    $idControl = 'ctrlDiagnosticos';
@endphp


<div class="box box-solid" style="margin-bottom:0;">
    <div class="box-body">
        <div class="row">
            <div class="col-sm-12">
                <div class="row">
                    <div class="col-sm-2">
                        <label for="">Codigo</label>
                        <input type="text" class="{{$idControl}}Codigo form-control">
                    </div>
                    <div class="col-sm-6">
                        <label for="">Descripcion</label>
                        <input type="text" class="{{$idControl}}Descipcion form-control">
                    </div>
                    <div class="col-sm-3">
                        <br class="hidden-xs">
                        <div class="checkbox">
                            <label><input type="checkbox" class="{{$idControl}}_filtro_letra">Fitrar x letra</label>
                        </div>
                    </div>
                    <div class="col-sm-1">
                        <a href="#" class="btn btn-xs btn-default btn-block {{$idControl}}BtnSearch" title="Buscar diagnostico"> <i class="fa fa-search"></i></a>
                        <a href="#" class="btn btn-xs btn-default btn-block {{$idControl}}BtnClear" title="Buscar diagnostico"> <i class="fa fa-refresh"></i></a>
                    </div>
                </div>
            </div>
            <div class="col-sm-12 {{$idControl}}Table" style="margin-bottom:0;">
                <br><div class="text-center">Sin resultados</div>
            </div>
        </div>
    </div>
</div>

        
