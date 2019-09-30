@php
    $idControl = 'ctrlEstablecimientos';
@endphp


<div class="box box-solid">
    <div class="box-body">
        <div class="row">
            <div class="col-sm-12">
                <div class="row">

                    {{-- minsa no_minsa --}}
                    <input type="hidden" class="{{$idControl}}Tipo"> 

                    <div class="col-sm-4 form-group">
                        <label for="">COD.Renaes</label>
                        <input type="text" class="{{$idControl}}CodReanes form-control">
                    </div>
                    <div class="col-sm-8 form-group">
                        <label for="">Nombre</label>
                        <input type="text" class="{{$idControl}}Nombre form-control">
                    </div>

                    <div class="col-sm-3 form-group">
                        <label for="">Departamento</label>
                        <select class="form-control {{$idControl}}Departamento form-control"></select>
                    </div>
                    <div class="col-sm-3 form-group">
                        <label for="">Provincia</label>
                        <select class="form-control {{$idControl}}Provincia form-control"></select>
                    </div>
                    <div class="col-sm-3 form-group">
                        <label for="">Distrito</label>
                        <select class="form-control {{$idControl}}Distrito form-control"></select>
                    </div>
                    <div class="col-sm-3 text-right">
                        <div style="padding:10px;" class="hidden-xs"></div>
                        <a href="#" class="btn btn-default btn-sm {{$idControl}}BtnSearch" title="Buscar establecimiento"> <i class="fa fa-search"></i> Buscar</a>
                        <a href="#" class="btn btn-default btn-sm {{$idControl}}BtnClear" title="Limpiar busqueda"> <i class="fa fa-refresh"></i> Limpiar</a>
                    </div>
                </div>

            </div>
            <div class="col-sm-12">
                <div style="width: 100%; height: 300px; overflow-y: scroll;">
                    <table class="table table-condensed table-hover table-bordered" style="margin-top:10px; margin-bottom:0px;">
                        <thead>
                            <tr class="bg-purple disabled">
                                <td>Nombre</td>
                                <td>SubSector</td>
                                <td>Distrito</td>
                                <td>Provincia</td>
                                <td>Departamento</td>
                                <td width="30"></td>
                            </tr>
                        </thead>
                        <tbody class="{{$idControl}}Tbody">
                            <tr>
                                <td>Nombre</td>
                                <td>SubSector</td>
                                <td>Distrito</td>
                                <td>Provincia</td>
                                <td>Departamento</td>
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
</div>
