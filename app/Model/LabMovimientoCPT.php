<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class LabMovimientoCPT extends Model
{
    protected $table = "LabMovimientoCPT";

    protected $primaryKey = 'IdMovimiento';

    public function LabMovimiento()
    {
        return $this->belongsTo('App\Model\LabMovimientoCPT', 'IdMovimiento');
    }

    public function servicio()
    {
        return $this->hasOne('App\Model\FactCatalogoServicios', 'IdProducto', 'idProductoCPT');
    }

    public function itemsCpt()
    {
        return $this->hasMany('App\Model\LabItemsCpt', 'idProductoCPT', 'idProductoCPT');
    }

    public static function responsable($idOrden, $idProducto)
    {
        $empleado = Empleados::from('Empleados as e')
            ->leftJoin('LabResultadoPorItems as ri', 'ri.realizaAnalisis', 'e.IdEmpleado')
            ->where('ri.idOrden', $idOrden)
            ->where('ri.idProductoCpt', $idProducto)
            ->select('e.*')->get()->first();
        return $empleado;
    }

    

    public function resultado()
    {
        return 'NO';
    }

}
