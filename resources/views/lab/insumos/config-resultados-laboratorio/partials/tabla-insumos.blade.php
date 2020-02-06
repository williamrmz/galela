
        <div class="form-inline pull-right" style="margin-bottom:10px">
            <div class="form-group">
                <input type="text" value="{{ Request::get('codigo') }}" class="form-control input-sm" id="codigo" placeholder="Codigo">
            </div>
            <div class="form-group">
                <input type="text" value="{{ Request::get('nombre') }}" class="form-control input-sm" id="nombre" placeholder="Nombre">
            </div>
            <a href="#" class="btn btn-sm btn-success btn-buscar-insumo"><i class="fa fa-search"></i></a>
        </div>


        <table class="table table-condensed table-bordered" style="margin-bottom: 0px;">
            <thead>
                <tr>
                    <th>Codigo</th>
                    <th>Nombre</th>
                    <th width="40"></th>
                </tr>
            </thead>
            <tbody id="tbody-insumos">
                @foreach ($insumos as $insumo)
                <tr>
                    <td>{{ $insumo->Codigo }}</td>
                    <td>{{ $insumo->Nombre }}</td>
                    <td>
                        <a href="#" class="btn btn-xs btn-default btn-add-insumo"> <i class="fa fa-plus"></i></a>
                        <input type="hidden" value="{{ json_encode($insumo) }}">
                    </td>
                </tr>  
                @endforeach
                
            </tbody>
        </table>
        {!! $insumos !!}
</div>
