<?php
    $tarifaId = $tarifa->IdTipoFinanciamiento;
    $areaId = $area->idGrupo;

    $sql = "EXEC WebEstadisticaTotalPruebasPorArea $tarifaId, $areaId, '$desde', '$hasta'";
    $totales = DB::select($sql);
    $title = "SubTotal ".$area->NombreGrupo;
?>

<table class="table-row">
    @foreach( $totales as $key => $total )
        <?php $style="style='border-top: 1px solid #000;'" ?>
        <tr>
            <td style="padding-left:20px">{{$title}}</td>
            <td width="80" align="center" {{$style}} >{{ $total->cantidad }}</td>
            <td width="80" align="center" {{$style}} >{{ $total->patologia }}</td>
            <td width="80" align="center" {{$style}} >{{ $total->antibiograma }}</td>
            <td width="80" align="center" {{$style}} >{{ $total->hombre }}</td>
            <td width="80" align="center" {{$style}} >{{ $total->mujer }}</td>
            <td width="80" align="center" {{$style}} >{{ $total->historia }}</td>
        </tr>
    @endforeach
</table>