<?php
    $idProducto = $prueba->idProducto;
    $idItemGrupo = $itemGrupo->idItemGrupo;
    $items = \DB::select("WebVerOrdenPruebaItems $idOrden, $idProducto, $idItemGrupo");
    // $items = $ordenRepository->verOrdenPruebaItems($idOrden, $idProducto, $idItemGrupo);
?>

<tr><td>
    <table class="table-row">
        <tbody>
            <?php foreach($items as $key => $item): ?>
                
                <?php

                    // print_r($item); die;
                    if($item->idItem == 98) //es antibiograma
                    {
                        if( $item->valorCheck==1 ){
                            echo "<tr><td colspan='2' style='padding-left:20px'>";
                                echo $item->nombreItem.': ';
                            echo "</td></tr>";
                            echo "<tr><td colspan='2' style='padding-left:20px'>";
                                ?> @include(PATH_PARTIALS.'antibiograma') <?php
                            echo "</td></tr>";
                        }
                        
                    }else{
                        $icon = '';
                        if ($item->estado == 'A') $icon = 'bg-danger fa fa-arrow-circle-up';
                        if ($item->estado == 'B') $icon = 'bg-warning fa fa-arrow-circle-down';
                        $rango = $item->rango;
                        
                        $nombre = $item->nombreItem;
                        $alertaNumero = $item->alertaNumero;
                        $alertaCombo = $item->alertaCombo;


                        // $resultado = $item['valorNumero'];
                        $valores = [];
                        if($item->soloNumero) {
                            if($item->valorNumero!='' || !is_null($item->valorNumero)){
                                array_push($valores, $item->valorNumero);
                            }
                        }
                        
                        if($item->soloCombo) {
                            if($item->valorCombo!='' || !is_null($item->valorCombo)){
                                array_push($valores, $item->valorCombo);
                            }
                        }

                        if($item->soloCheck)  {
                            if($item->valorCheck!='' || !is_null($item->valorCheck)){
                                $val = ($item->valorCheck)? 'SI': 'NO';
                                array_push($valores, $item->valorCheck);
                            }
                        }

                        if($item->soloTexto){
                            if($item->valorTexto!='' || !is_null($item->valorTexto)){
                                array_push($valores, $item->valorTexto);
                            }
                        } 

                        if(count($valores)>0 || $item->pendiente ){
                            $resultado = ($item->pendiente=='1')? 'Pendiente': implode('<br>', $valores); 
                        
                            echo    "<tr>
                                        <td style='padding-left:20px; vertical-align:baseline;'>$nombre</td>
                                        <td align='center' width='190'>$resultado</td>
                                        <td align='center' width='10'> <i class='$icon'></i> </td>
                                        <td align='center' width='150'>$rango</td>
                                    </tr>";
                            if($icon!=='' && ($alertaNumero!='' || !is_null($alertaNumero)) ){
                                echo "<tr>
                                        <td style='padding-left:30px'><em>$alertaNumero</em></td>
                                    </tr>";
                            }
                            if($alertaCombo!='' || !is_null($alertaCombo)){
                                echo "<tr>
                                        <td style='padding-left:30px'><em>$alertaCombo</em></td>
                                    </tr>";
                            }
                        }// ELSE ROW NOT PRINT

                    }

                ?>

            <?php endforeach ?>
        </tbody>
    </table>
</td></tr>