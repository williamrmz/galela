<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class TiposEmpleado extends Model
{
    protected $table = "TiposEmpleado";

    protected $primaryKey = 'IdTipoEmpleado';

    public function empleados()
    {
        return $this->hasMany('App\Model\Empleados', 'IdTipoEmpleado');
    }
}
