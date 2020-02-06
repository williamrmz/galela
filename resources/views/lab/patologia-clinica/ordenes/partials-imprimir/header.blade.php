<?php
    $dataOrden = \DB::select("WebVerOrden $idOrden");

    if( !isset($dataOrden[0]) ){
        die('WebVerOrden NOT_DATA');
    }

    $orden = $dataOrden[0];
    $paciente = $orden->paciente;
    $historia = $orden->historia;
    $edad = $orden->edad;
    $sexo = $orden->sexo;
    $idOrden = $orden->idOrden;
    $fRegistro = $orden->fechaRegistro;
    $fNacimiento = $orden->fechaNacimiento;
    $ordena = $orden->ordena;
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
                                <tr><td width="120"><b>PACIENTE: </b></td><td><?=$paciente?></td></tr>
                                <tr><td width="120"><b>HISTORIA: </b></td><td><?=$historia?></td></tr>
                                <tr><td width="120"><b>EDAD: </b></td><td><?=$edad?></td></tr>
                                <tr><td width="120"><b>SEXO: </b></td><td><?=$sexo?></td></tr>
                            </table>
                        </td>
                        <td>
                            <table class="table-row" >
                                <tr><td width="120"><b>ORDEN: </b></td><td><?=$idOrden?></td></tr>
                                <tr><td width="120"><b>F.REGISTRO: </b></td><td><?=$fRegistro?></td></tr>
                                <tr><td width="120"><b>F.NACIMIENTO: </b></td><td><?=$fNacimiento?></td></tr>
                                <tr><td width="120"><b>ORDENA: </b></td><td><?=$ordena?></td></tr>
                            </table>
                        </td>
                    </tr>
                    <tr><td colspan="2" style="padding-bottom:5px;"></td></tr>
                </table>
            </td></tr>

            <tr><td>
                <table class=" table-row line-bottom">
                    <tr align="center" class="bg-gray">
                        <td>PROCEDIMIENTO</td>
                        <td width="190">Resultado</td>
                        <td width="10">I</td>
                        <td width="150">Referencia/Unidad</td>
                        <td width="10"></td>
                    </tr>
                </table>
            </td></tr>
           
        </tbody>
    </table>
</td></tr>