<?php
    $idProducto = $prueba->idProducto;
    $observacion = \DB::select("WebVerOrdenPruebaObservacion $idOrden, $idProducto");
    if(isset($observacion[0])){
        $texto = $observacion[0]->valorTexto;
    }else{
        $texto = 'NOT_DATA';
    }
?>

<table class="table-row">
    <tbody>
        <tr>
            <td width="120" style="vertical-align:baseline;"><b>Observaciones: </b></td>
            <td align="justify" ><p style="word-wrap: break-word;">{!! $texto !!}</p></td>    
        </tr>
        <tr><td colspan="2" style="padding-bottom:20px;"></td></tr>
    </tbody>
</table>
