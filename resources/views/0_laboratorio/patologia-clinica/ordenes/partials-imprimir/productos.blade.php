<?php
    $idGrupo = $grupo->idGrupo;
    $pruebas = \DB::select("WebVerOrdenPruebas $idOrden, $idGrupo");
?>

<tr><td>
    <table class="table-row">
        <tbody>
            <?php foreach($pruebas as $key => $prueba): ?>
            <tr><td><b>{{ $prueba->nombreProducto }}</b></td></tr>
            <tr><td> @include(PATH_PARTIALS.'grupos-items') </td></tr>
            <tr><td ><p></p></td></tr>
            <tr><td> @include(PATH_PARTIALS.'responsable') </td></tr>
            <tr><td><p></p></td></tr>
            <tr><td> @include(PATH_PARTIALS.'observacion') </td></tr>
            
            <?php endforeach ?>
        </tbody>
    </table>
</td></tr>