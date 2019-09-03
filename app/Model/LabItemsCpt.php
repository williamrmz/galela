<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use App\Model\LabMovimientoLaboratorio as MovLab;

class LabItemsCpt extends Model
{
    protected $table = "LabItemsCpt";

    //deprecated!
    public function LabItem()
    {
        return $this->hasOne('App\Model\LabItems', 'idItem', 'idItem');
    }

    public function item()
    {
        return $this->hasOne('App\Model\LabItems', 'idItem', 'idItem');
    }

    //deprecated!
    public function LabItemGrupo()
    {
        return $this->hasOne('App\Model\LabItemsGrupos', 'idItemGrupo', 'idItemGrupo');
    }

    public function itemGrupo()
    {
        return $this->hasOne('App\Model\LabItemsGrupos', 'idItemGrupo', 'idItemGrupo');
    }

    // HTML FORMS

    public static function formItem($item)
    {
        $name = 'oxr-'.$item->ordenXresultado.'[idItem]';
        $value = $item->idItem;
        $form  = "<input type='hidden' name='$name'  value='$value'>";
        $form .= $value;
        return $form;
    }

    public static function formValidar($item)
    {
        $value = 0;
        // $item = $form['info']['validar'];
        if(isset($item->ValorCheck)){
            $value = $item->ValorCheck;
        }
        $name = 'oxr-'.$item->ordenXresultado.'[check]';
        $iconClass = ($value)? 'fa fa-fw fa-check text-green': 'fa fa-fw fa-close text-red';

        $form =  "<a href='#' class='btn btn-xs btn-default btn-validar'> <i class='$iconClass'></i> </a>";
        $form .= "<input type='hidden' class='input-validar' name='$name' value='$value'>";
        return $form;
    }

    public static function formObservacion($item)
    {
        // $item = $form['info']['observacion'];
        if($item->SoloTexto){
            $value = $item->ValorTexto;
            $name = 'oxr-'.$item->ordenXresultado.'[texto]';
            $form = "<textarea class='form-control input-sm input-observaciones hidden' name='$name' rows='3'>$value</textarea>";
        }

        $form .= "<a href='#' class='btn btn-xs btn-default btn-observaciones'> <i class='fa fa-eye fa-fw'></i> </a>";
        return $form;
    }

    public static function formPendiente($item)
    {
        $name = 'oxr-'.$item->ordenXresultado.'[pendiente]';
        $value = $item->Pendiente;
        
        $iconClass = is_null($value)? 'fa fa-clock-o fa-false': 'fa fa-clock-o fa-true';
        $btnClass = is_null($value)? 'btn-default': 'btn-danger';
        $form  = "<a href='#' class='btn btn-xs $btnClass  btn-pending'> <i class='$iconClass'></i> </a>";
        $form .= "<input type='hidden' name='$name' class='input-pending'  value='$value'>";
        return $form;
    }

    public static function formNumero($item)
    {
        $status = $item->SoloNumero? '':'readOnly';
        $value = $item->ValorNumero;
        $name = 'oxr-'.$item->ordenXresultado.'[numero]';
        $form = "<input $status type='number' class='form-control input-sm' name='$name' value='$value' step='any' min='0' >";
        return $form;
    }

    public static function formTexto($item)
    {
        $status = $item->SoloTexto? '': 'readOnly';
        $value = $item->ValorTexto;
        $name = 'oxr-'.$item->ordenXresultado.'[texto]';
        $form = "<input $status type='text' class='form-control input-sm' name='$name' value='$value'>";
        return $form;
    }

    public static function formCheck($item)
    {
        $oxrId = $item->ordenXresultado;
        $value = $item->ValorCheck;
        $name = 'oxr-'.$item->ordenXresultado.'[check]';
        $status = $item->SoloCheck?: 'disabled';
        $checked = $value? 'Checked':'';
        
        if($value==1) $iconClass="fa fa-check";
        if($value==0) $iconClass="fa fa-close";
        if(is_null($value)) $iconClass="fa";
        $form = "<a href='#' class='btn btn-xs btn-default btn-check $status'> <i class='$iconClass' style='width:15px'></i> </a>";
        $form .= "<input  type='hidden' class='input-check' name='$name' value='$value'>";
        $form .= "<input  type='hidden' class='oxr-id'  value='$oxrId'>";

        $valorCheck = $value;
        return $form;
    }

    public static function formCombo($item)
    {
        $status1 = $item->SoloCombo? '': 'readOnly';
        $status2 = $item->SoloCombo?  '': 'disabled';
        $value = $item->ValorCombo;
        $options = '<option></option>';
        $name = 'oxr-'.$item->ordenXresultado.'[combo]';
        if(isset($item->opciones)){
            foreach($item->opciones as $opcion){
                $selected = ($opcion == $value)? 'selected': '';
                $options .= "<option $selected>".$opcion."</options>";
            }
        }

        $form = "<div class='input-group'>
                    <select $status2 style='width:20px;' class='myselect form-control input-sm'>
                        $options
                    </select>
                    <div class='input-group-addon' style='padding:0; width:0; border:0'></div>
                    <input $status1  type='text' name='$name' value='$value' class='form-control input-sm'>
                </div>";

        return $form;
    }

    public static function formOpciones($item)
    {
        $btns = '';
        if( $item->idItem == 98) { // Formulario de Antibiograma
            $name = 'oxr-'.$item->ordenXresultado.'[antibiograma]';
            $id = 'antibiograma-'.$item->ordenXresultado;
            $value = $item->Antibiograma;
                $oxr = $item->ordenXresultado;
                $itemNombre = $item->Item;
                
                $status = ($item->ValorCheck)? '': 'display: none;';
                $btns .= "<div id='btn-$id' style='$status'>";
                    $btns .= "<textarea name='$name' class='form-control ' id='$id' >$value</textarea>";
                    $btns .= "<input type='hidden' class='item-id' value='$oxr'>";
                    $btns .= "<input type='hidden' class='item-nombre' value='$itemNombre'>";
                    $btns .= "<a href='#' title='Antibiograma' style='width:30px'
                                class='btn btn-xs btn-warning btn-antibiograma'>
                                <i class='fa fa-w fa-bug'></i></a>";
                $btns .= "</div>";
        }else{ 
            $btns .= "<a href=\"javascript: getReferencias($item->idItem, '$item->Item')\"
                class='btn btn-xs btn-info' style='width:30px' title='Referencias'> <i class='fa fa-sliders'></i> </a>";
        }
        return $btns;
    }

    public static function formItems($idMovimiento, $idProductoCPT)
    {
        $sql = 
        "SELECT
        ic.ordenXresultado, g.Grupo, ic.idItem, i.Item, 
        ic.SoloNumero, ic.SoloTexto, ic.SoloCheck, ic.SoloCombo, ic.ValorSiEsCombo,
        ri.ValorNumero, ri.ValorTexto, ri.ValorCheck, ri.ValorCombo, ri.Antibiograma, ri.Pendiente, ri.Fecha
        FROM LabMovimientoCPT mc
        LEFT JOIN LabMovimientoLaboratorio ml ON (ml.IdMovimiento = mc.idMovimiento)
        LEFT JOIN LabItemsCpt ic ON (ic.idProductoCpt = mc.idProductoCpt)
        LEFT JOIN LabResultadoPorItems ri ON 
            (ic.idProductoCpt = ri.idProductoCpt AND ic.ordenXresultado=ri.ordenXresultado AND ml.IdOrden=ri.idOrden)
        LEFT JOIN LabItems i ON (i.idItem = ic.idItem)
        LEFT JOIN LabItemsGrupos g ON (g.idItemGrupo = ic.idItemGrupo)
        WHERE mc.idMovimiento=$idMovimiento AND mc.idProductoCpt=$idProductoCPT
        ORDER BY ic.ordenXresultado ASC";

        $data = \DB::select($sql);

        $itemValidar = [];
        $itemObservacion = [];
        $items = [];
        foreach($data as $row){
            $add = true;
            foreach($items as $item){
                if($item->idItem == $row->idItem){
                    $add = false; break;
                }
            }
            if($add){

                if($row->idItem == 100){
                    $row->formValidar = LabItemsCpt::formValidar($row);
                    $itemValidar = $row;
                }else if($row->idItem == 99){
                    $row->formObservacion = LabItemsCpt::formObservacion($row);
                    $itemObservacion = $row;
                }else{
                    if($row->SoloCombo){
                        $row->opciones = LabItemsCpt::getOpcionesCombo($row->idItem, $data);
                    }
                    $row->formItem = LabItemsCpt::formItem($row);
                    $row->formPendiente = LabItemsCpt::formPendiente($row);
                    $row->formNumero = LabItemsCpt::formNumero($row);
                    $row->formTexto = LabItemsCpt::formTexto($row);
                    $row->formCombo = LabItemsCpt::formCombo($row);
                    $row->formCheck = LabItemsCpt::formCheck($row);
                    $row->formOpciones = LabItemsCpt::formOpciones($row);
                    $items[] = $row;
                }
            }
        }

        $fechaResultados = date('Y-m-d');

        if(isset($itemValidar->Fecha)){
            $fechaResultados  = dateFormat($itemValidar->Fecha, 'Y-m-d');
        }

        $response = [
            'itemValidar' => $itemValidar,
            'itemObservacion' => $itemObservacion,
            'items' => $items,
            'fechaResultados' => $fechaResultados,
        ];

        return json_decode(json_encode($response));
    }

    public static function getOpcionesCombo($idItem, $data)
    {
        $opciones = [];
        foreach($data as $row){
            if($row->idItem ==  $idItem){
                $opciones[] = $row->ValorSiEsCombo;
            }
        }
        return $opciones;
    }

}
