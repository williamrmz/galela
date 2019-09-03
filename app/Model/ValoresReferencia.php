<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class ValoresReferencia extends Model
{
    protected $table = "ValoresReferencia";

    protected $primaryKey = 'id_valor';

    public $timestamps = false;

    public function sexo()
    {
        $opciones = [
            1 => 'Masculino',
            2 => 'Femenino',
            3 => 'Ambos',
        ];

        return $opciones[$this->sexo_id];
    }

    public function rangoEdades()
    {
        $edadUnidad = ['D'=>'dias', 'A'=>'Años'][$this->edad_unidad];
        $rango = "[$this->edad_min - $this->edad_max] $edadUnidad";
        return $rango;
    }

    public function rangoValores()
    {
        $rango = '';
        if( $this->valor_tipo == 'N'){
            $rango = "[$this->valor_min - $this->valor_max] $this->valor_unidad";
        }else {
            $rango = "[$this->valor_txt]";
        }
        
        return $rango;
    }

    public function alertas()
    {
        $texto = '';
        if($this->valor_tipo=='N'){
            $texto = "<i class='fa fa-arrow-circle-down text-orange'></i> $this->alerta_inf ";
            $texto .= "<i class='fa fa-arrow-circle-up text-red'></i> $this->alerta_sup";
        }else{
            $texto = $this->alerta_txt;
        }
        return $texto;
    }
}
