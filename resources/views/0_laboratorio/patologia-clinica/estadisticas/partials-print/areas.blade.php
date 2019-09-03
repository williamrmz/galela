<?php
    $areas = DB::table('labGrupos')->whereIn('idGrupo', $areasId)->get();
?>

<table class="table-row">
    <?php foreach( $areas as $key => $area ): ?>
        <tr><td style="padding-left:20px"><u>{{ strtoupper($area->NombreGrupo) }}</u></td></tr>
        <tr><td> @include(PATH_PARTIALS.'pruebas') </td></tr>
        <tr><td> </td></tr>
    <?php endforeach ?>
</table>