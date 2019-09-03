<?php
    $tarifas = DB::table('TiposFinanciamiento')->whereIn('idTipoFinanciamiento', $tarifasId)->get();
?>

<table class="table-row">
    <tbody>
        <?php foreach( $tarifas as $key => $tarifa ): ?>
            <tr><td><b><u> {{ strtoupper($tarifa->Descripcion) }}</u><b></td></tr>
            <tr><td> @include(PATH_PARTIALS.'areas') </td></tr>
            <tr><td> @include(PATH_PARTIALS.'total-tarifa') </td></tr>
            <tr><td> @include(PATH_PARTIALS.'tarifa-total-ordenes') </td></tr>
            <tr><td> @include(PATH_PARTIALS.'tarifa-avg-pruebasXorden') </td></tr>
        <?php endforeach ?>
    </tbody>
</table>
