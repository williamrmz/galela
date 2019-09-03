<?php

    $tarifasIdString = implode(",", $tarifasId);
    $areasIdString = implode(",", $areasId);

    $sql = "EXEC WebEstadisticaTotalPruebasPorTarifasPorAreas '$tarifasIdString', '$areasIdString', '$desde', '$hasta'";
    $results = DB::select($sql);
    $result = isset($results[0])? $results[0]: null;
    $totalPruebas = json_decode(json_encode($result));

    $sql = "EXEC WebEstadisticaTotalOrdenesPorTarifas '$tarifasIdString', '$areasIdString', '$desde', '$hasta'";
    $results = DB::select($sql);
    $result = isset($results[0])? $results[0]: null;
    $totalOrdenes = json_decode(json_encode($result));


    $sql = "EXEC WebEstadisticaAvgPruebasPorOrdenesYTarifas '$tarifasIdString', '$areasIdString', '$desde', '$hasta'";
    $results = DB::select($sql);
    $result = isset($results[0])? $results[0]: null;
    $promedioPuebasPorOrden = json_decode(json_encode($result));

?>
<br>
<table class="table-row">
    <tr align="center" class="bg-green">
        <td ><b>Total Pruebas</b></td>
        <td width="80">{{ $totalPruebas->cantidad }}</td>
        <td width="80">{{ $totalPruebas->patologia }}</td>
        <td width="80">{{ $totalPruebas->antibiograma }}</td>
        <td width="80">{{ $totalPruebas->hombre }}</td>
        <td width="80">{{ $totalPruebas->mujer }}</td>
        <td width="80">{{ $totalPruebas->historia }}</td>
    </tr>
    <tr align="center" class="bg-gray">
        <td><b>Total de Ordenes</b></td>
        <td width="80">{{ $totalOrdenes->total }}</td>
        <td colspan="5"></td>
    </tr>
    <tr align="center" class="bg-gray">
        <td><b>Promedio Pruebas/Orden</b></td>
        <td width="80">{{ number_format($promedioPuebasPorOrden->avg, 1, '.', '') }}</td>
        <td colspan="5"></td>
    </tr>
</table>
