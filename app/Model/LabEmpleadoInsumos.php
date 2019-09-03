<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class LabEmpleadoInsumos extends Model
{
    protected $table = "LabEmpleadoInsumos";

    protected $fillable= ['IdEmpleado', 'IdAsignacion', 'IdProductoInsumo', 'Cantidad'];

    public function bienInsumo()
    {
        return $this->hasOne('App\Model\FactCatalogoBienesInsumos', 'IdProducto', 'IdProductoInsumo');
    }

}
