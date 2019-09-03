<?php
    $areasIdString = implode(",", $areasId);
    $tarifaId = $tarifa->IdTipoFinanciamiento;

    $sql = "WebEstadisticaAvgPruebasPorOrdenesYTarifas '$tarifaId', '$areasIdString', '$desde', '$hasta'";
    $result = DB::select($sql);

    $avgPXO = (isset($result[0]->avg))? $result[0]->avg: 0;
    $avgPXO = number_format($avgPXO, 1, '.', '');

    $title = "<b>Promedio Pruebas/Orden </b>";
?>

<table class="table-row">
    <tr class="bg-gray">
        <td style="">{!! $title !!}</td>
        <td width="80" align="center">{{ $avgPXO }}</td>
        <td width="400"></td>
    </tr>
</table>
