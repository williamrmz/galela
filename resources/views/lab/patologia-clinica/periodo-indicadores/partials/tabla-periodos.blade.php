<div class="table-responsive">
    <table class="table table-condensed" style="margin-bottom:0">
        <thead>
            <tr style="font-weight: bold" class="bg-gray">
                <td>#</td>
                <td>Area</td>
                <td>Anio</td>
                <td>Mes</td>
                <td>Dias</td>
                <td>Descripcion</td>
                <td></td>
            </tr>
        </thead>
        <tbody>
            @foreach ($periodos as $periodo)
                <tr>
                    <td>{{ $periodo->IdPeriodo }}</td>
                    <td>{{ $periodo->area->NombreGrupo }}</td>
                    <td>{{ $periodo->Anio }}</td>
                    <td>{{ $periodo->NombreMes }}</td>
                    <td>{{ $periodo->NumDias }}</td>
                    <td>{{ $periodo->Descrip }}</td>
                    <td>
                        <input type="hidden" value="{{ $periodo->IdPeriodo }}">
                        <a href="#" class="btn btn-xs btn-default periodos-btn-show" title="indicadores"> <i class="fa fa-fw fa-table"></i></a>
                        <a href="#" class="btn btn-xs btn-default periodos-btn-sumary" title="resumen"> <i class="fa fa-fw fa-file-text-o"></i></a>
                        <a href="#" class="btn btn-xs btn-default periodos-btn-edit" title="editar"> <i class="fa fa-fw fa-edit"></i></a>
                        <a href="#" class="btn btn-xs btn-default periodos-btn-delete" title="eliminar"> <i class="fa fa-fw fa-trash"></i></a>
                    </td>
                </tr>  
            @endforeach
            
        </tbody>
    </table>
</div>

<div class="periodos-paginator">
    {{ $periodos->render() }}
</div>


