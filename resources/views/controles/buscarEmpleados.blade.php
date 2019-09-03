@php
    // dd($data);
@endphp
<div class="box box-solid" style="margin-bottom:0px;">
    <!-- /.box-header -->
    <div class="box-body">
        <div class="row">
            <div class="col-sm-12">
            {{-- <div style="width: 100%; height: 500px; overflow-y: scroll;"> --}}
                <table class="table table-condensed table-bordered table-hover" id="control-table-items" style="margin-bottom:0px;">
                    <thead>
                        <tr class="bg-primary disabled">
                            <th>Cod. Planilla</th>
                            <th>Apellido Paterno</th>
                            <th>Apellido Materno</th>
                            <th>Nombres</th>
                            <th>DNI</th>
                            <th>Tipo Empleado</th>
                            <th>Condicion Trabajo</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data as $item)
                            <tr>
                                <td>{{ $item->CodigoPlanilla }}</td>
                                <td>{{ $item->ApellidoPaterno }}</td>
                                <td>{{ $item->ApellidoMaterno }}</td>
                                <td>{{ $item->Nombres }}</td>
                                <td>{{ $item->DNI }}</td>
                                <td>{{ $item->TipoEmpleado }}</td>
                                <td>{{ $item->CondicionTrabajo }}</td>
                                <td>
                                    <input type="hidden" value="{{ json_encode($item) }}">
                                    <a href="#" class="btn btn-xs btn-default control-btn-select-item"> <i class="fa fa-plus"></i></a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                
            {{-- </div> --}}
            </div>
        </div>
    </div>
    <!-- /.box-body -->
</div>

