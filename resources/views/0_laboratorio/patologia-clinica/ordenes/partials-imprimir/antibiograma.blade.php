<?php
$muestra = '';
$germenes = [];
if(!is_null($item->antibiograma)){
    $antibiograma = json_decode($item->antibiograma);
    $muestra = $antibiograma->muestra;
    $germenes = $antibiograma->germenes;
}

?>

    <table class="table-row">
        <?php foreach( $germenes as $germen): ?>

            <tr><td style="padding-left:10px"> 
                <b>Muestra: </b> <?=$muestra?> 
            </td></tr>
            <tr><td style="padding-left:10px"> 
                <b>Microorganismo: </b> <?=$germen->nombre?> 
            </td></tr>
            <tr><td style="padding-left:10px"> 
                <b>Cantidad: </b><?=$germen->cantidad?> 
            </td></tr>

            <tr>
                <td colspan="2"> 
                    <table class="table-row">
                        <tr style="border-bottom: 1px solid #ddd;" align="center">
                            <td style="padding-left:20px" align="left"><b>ANTIBIOTICO</b></td>
                            <td width="100"><b>SENSIBILIDAD</b></td>
                            <td width="100"><b>MIC</b></td>
                        </tr>
                        @foreach( $germen->antibioticos as $antibiotico)
          
                            @if(isset($antibiotico->estado))

                                <tr style="border-bottom: 1px solid #ddd;">
                                    <td style="padding-left:20px"> {{ $antibiotico->nombre}} </td>
                                    <td align="center" width="100"> {{ $antibiotico->estado}} </td>
                                    <td align="center" width="100"> {{ $antibiotico->mic}} </td>
                                </tr>
                            @endif
                            
                            
                        @endforeach
                        <tr><td colspan="3"><br></td></tr>
                    </table>
                </td>
            </tr>
        <?php endforeach ?>
    </table>
