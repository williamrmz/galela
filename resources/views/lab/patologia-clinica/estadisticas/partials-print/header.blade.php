<?php
    $rango = date("d/m/Y", strtotime($desde)) .' - '. date("d/m/Y", strtotime($hasta));

    $estadisticaPor = 'TARIFAS, AREAS, PRUEBAS';
?>

<tr><td>
    <table class="table-row">
        <tbody>
            <tr><td>
                <table class="table-row line-bottom">
                    <tr>
                        <td width="100">
                            <img src="{{ url('/storage/images/reportes/logo_hos.png') }}" width="100" height="100">
                        </td>
                        <td align="center">
                            <h5><b> HOSPITAL REGIONAL DONCENTE "LAS MERCEDES" - CHICLAYO </b></h5>
                            <em> Departamento de Patología Clínica y Anatomía Patológica <em>
                        </td>
                        <td width="100">
                            <img src="{{ url('/storage/images/reportes/logo_lam.png') }}" width="100" height="100">
                        </td>
                    </tr>
                    <tr><td colspan="3" style="padding-bottom:5px;"></td></tr>
                </table>
            </td></tr>
            
            <tr><td>
                <table class="table-row line-bottom">
                    <tr><td colspan="2" style="padding-top:5px;"></td></tr>
                    <tr>
                        <td>
                            <table class="table-row">
                                <tr><td width="120"><b>Estadisdica por: </b></td><td><?=$estadisticaPor?></td></tr>
                                <tr><td width="120"><b>Fecha: </b></td><td><?=$rango?></td></tr>
                            </table>
                        </td>
                    </tr>
                    <tr><td colspan="2" style="padding-bottom:5px;"></td></tr>
                </table>
            </td></tr>

            <tr><td>
                <table class=" table-row">
                    <tr align="center"  >
                        <td></td>
                        <td width="80" class="line-bottom2"><b>Prueba</b></td>
                        <td width="80" class="line-bottom2"><b>Patologia</b></td>
                        <td width="80" class="line-bottom2"><b>Antibiogr</b></td>
                        <td width="80" class="line-bottom2"><b>Hombre</b></td>
                        <td width="80" class="line-bottom2"><b>Mujer</b></td>
                        <td width="80" class="line-bottom2"><b>Historia</b></td>
                    </tr>
                </table>
            </td></tr>
           
        </tbody>
    </table>
</td></tr>