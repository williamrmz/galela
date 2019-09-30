@php
    $idControl = 'ctrlProcedimientos';
@endphp


<div class="box box-solid">
    <div class="box-body">
        <div class="row">
            <div class="col-sm-12">
                <div class="row">
                    <div class="col-sm-10">
                        <div class="row">
                            <div class="col-sm-4">
                                <label for="">Codigo</label>
                                <input type="text" class="{{$idControl}}Codigo form-control">
                            </div>
                            <div class="col-sm-8">
                                <label for="">Nombre</label>
                                <input type="text" class="{{$idControl}}Nombre form-control">
                            </div>
                            <div class="col-sm-12">
                                <label for="">Solo muestra medicamentos e insumos con saldos mayores a cero</label>
                                <input type="checkbox" class="{{$idControl}}ConSaldos">
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-2">
                        <a href="#" class="btn btn-default btn-block" title="Buscar procedimientos"> <i class="fa fa-search"></i></a>
                        <a href="#" class="btn btn-default btn-block" title="Limpiar busqueda"> <i class="fa fa-refresh"></i></a>
                    </div>
                </div>
            </div>
            <div class="col-sm-12">
                <table class="table table-condensed table-hover table-bordered" style="margin-top:10px; margin-bottom:0px;">
                    <thead>
                        <tr class="bg-purple disabled">
                            <td>CIE-10</td>
                            <td>Descripcion</td>
                            <td width="30"></td>
                        </tr>
                    </thead>
                    <tbody class="{{$idControl}}Tbody">
                        <tr>
                            <td>CIE-10</td>
                            <td>Descripcion</td>
                            <td>
                                <input type="hidden" name="{{$idControl}}_item" value="item_json">
                                <a href="#" class="btn btn-xs btn-default {{$idControl}}_btn_select"> <i class="fa fa-plus"></i></a>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
