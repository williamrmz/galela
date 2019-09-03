<?php
    $idProducto = $prueba->idProducto;
    $itemGrupos = \DB::select("WebVerOrdenPruebaGruposItems $idOrden, $idProducto");
?>

<table class="table-row">
    <tbody>
        <?php foreach($itemGrupos as $key => $itemGrupo): ?>
        <tr><td style="padding-left:10px"><b>{{ $itemGrupo->nombreItemGrupo }}</b></td></tr>
            @include(PATH_PARTIALS.'items')
        <?php endforeach ?>
    </tbody>
</table>
