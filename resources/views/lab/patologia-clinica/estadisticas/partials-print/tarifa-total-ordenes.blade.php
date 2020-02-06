<?php
    $areasIdString = implode(",", $areasId);
    $tarifaId = $tarifa->IdTipoFinanciamiento;
    $sql = "EXEC WebEstadisticaTotalOrdenesPorTarifas '$tarifaId', '$areasIdString', '$desde', '$hasta'";
    $result = DB::select($sql);

    $totalOXT = (isset($result[0]->total))? $result[0]->total: 0;

    $title = "<b>Total de ordenes por: </b>".strtoupper($tarifa->Descripcion);
?>

<table class="table-row">
    <tr class="bg-gray">
        <td style="">{!! $title !!}</td>
        <td width="80" align="center">{{ $totalOXT }}</td>
        <td width="400"></td>
    </tr>
</table>
