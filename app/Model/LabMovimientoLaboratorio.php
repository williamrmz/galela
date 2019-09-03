<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class LabMovimientoLaboratorio extends Model
{
    protected $table = "LabMovimientoLaboratorio";

    protected $primaryKey = 'IdMovimiento';

    public function mov()
    {
        return $this->belongsTo('App\Model\LabMovimiento', 'IdMovimiento');
    }

    public function movsCPT()
    {
        return $this->hasMany('App\Model\LabMovimientoCPT', 'idMovimiento', 'IdMovimiento');
    }

    public function sexo()
    {
        return $this->hasOne('App\Model\TiposSexo', 'IdTipoSexo', 'idTipoSexo');
    }

    public function edad()
    {
        $fechaNacimiento = dateFormat($this->FechaNacimiento, 'Y-d-m');
        list($Y,$m,$d) = explode("-",$fechaNacimiento);
        return( date("md") < $m.$d ? date("Y")-$Y-1 : date("Y")-$Y );
    }

    public function classPrint(){
        return 'btn-default';
    }

    public function historia()
    {
        if(isset($this->orden->paciente->NroHistoriaClinica)){
            return $this->orden->paciente->NroHistoriaClinica;
        }
        return null;
    }

    public function orden()
    {
        return $this->hasOne('App\Model\FactOrdenServicio', 'IdOrden', 'IdOrden');
    }

    public function movEstado()
    {
        if(isset($this->mov->estado->Estado))
        {
            return $this->mov->estado->Estado;
        }
        return null;
    }
}
