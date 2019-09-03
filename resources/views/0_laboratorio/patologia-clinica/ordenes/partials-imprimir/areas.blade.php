<?php
    $grupos = \DB::select("WebVerOrdenGrupos $idOrden");
?>

<tr><td>
    <table class="table-row">
        <tbody>
            <?php foreach( $grupos as $key => $grupo): ?>
                <tr><td align="center"><h5>{{ strtoupper($grupo->nombreGrupo) }}</h5></td></tr>
                @include(PATH_PARTIALS.'productos')
                
            <?php endforeach ?>
        </tbody>
    </table>
</td></tr>