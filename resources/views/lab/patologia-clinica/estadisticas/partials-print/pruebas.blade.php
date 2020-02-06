<?php
    $tarifaId = $tarifa->IdTipoFinanciamiento;
    $areaId = $area->idGrupo;

    $sql = "EXEC WebEstadisticaPruebas $tarifaId, $areaId, '$desde', '$hasta'";
    $pruebas = DB::select($sql);
?>

<table class="table-row">
    @foreach( $pruebas as $key => $prueba )
        <tr>
            <td style="padding-left:40px">{{ $prueba->nombre }}</td>
            <td width="80" align="center">{{ $prueba->cantidad }}</td>
            <td width="80" align="center">{{ $prueba->patologia }}</td>
            <td width="80" align="center">{{ $prueba->antibiograma }}</td>
            <td width="80" align="center">{{ $prueba->hombre }}</td>
            <td width="80" align="center">{{ $prueba->mujer }}</td>
            <td width="80" align="center">{{ $prueba->historia }}</td>
        </tr>
    @endforeach
</table>
