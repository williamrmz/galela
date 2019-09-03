<?php
    $areasIdString = implode(",", $areasId);

    $tarifaId = $tarifa->IdTipoFinanciamiento;
    $sql = "EXEC WebEstadisticaTotalPruebasPorTarifasPorAreas
            '$tarifaId', '$areasIdString', '$desde', '$hasta'";
    $results = DB::select($sql);
    $totalTarifa = isset($results[0])? $results[0]: null;

    $title = "SubTotal ".$tarifa->Descripcion;
?>

<table class="table-row">
    <tr class="bg-green disabled" align="center">
        <td align="left">{{ $title }}</td>
        <td width="80">{{ $totalTarifa->cantidad }}</td>
        <td width="80">{{ $totalTarifa->patologia }}</td>
        <td width="80">{{ $totalTarifa->antibiograma }}</td>
        <td width="80">{{ $totalTarifa->hombre }}</td>
        <td width="80">{{ $totalTarifa->mujer }}</td>
        <td width="80">{{ $totalTarifa->historia }}</td>
    </tr>
</table>
