<?php
    $idProducto = $prueba->idProducto;
    $responsable = \DB::select("WebVerOrdenPruebaResponsable $idOrden, $idProducto");
    if(isset($responsable[0])){
        $nombre = $responsable[0]->nombreEmpleado;
        $firma = ($responsable[0]->firmaEmpleado)? $responsable[0]->firmaEmpleado: 'NOT_SIGN.jpg';
    }else{
        $nombre = 'Sin especificar';
        $firma = 'NOT_SIGN.jpg';
    }

    $time = strtotime(date('d-m-Y H:i:s'));
?>

<table class="table-row">
    <tbody>
        <tr>
            <td width="120" style="vertical-align:baseline;"><b>Realiza prueba: <b></td>
            <td>
                <?= $nombre ?><br>
                <img src="{{ url('/storage/images/firmas/'.$firma.'?'.$time) }}" width="200" height="80">
            </td>    
        </tr>
    </tbody>
</table>