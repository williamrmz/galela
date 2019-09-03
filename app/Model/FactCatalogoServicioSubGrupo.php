<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class FactCatalogoServicioSubGrupo  extends Model
{
    protected $table = "FactCatalogoServiciosSubGrupo";

    

    public function servicios()
    {
        return $this->hasMany('App\Model\FactCatalogoServicios', 'IdServicioSubGrupo', 'IdServicioSubGrupo');
    }



}
