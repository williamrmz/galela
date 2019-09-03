<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class LabMovimiento extends Model
{
    protected $table = "LabMovimiento";

    protected $primaryKey = 'IdMovimiento';

    public function movimientoLaboratorio()
    {
        return $this->hasOne('App\Model\LabMovimientoLaboratorio', 'IdMovimiento');
    }

    public function estado()
    {
        return $this->hasOne('App\Model\LabEstados', 'IdLabEstado', 'IdLabEstado');
    }

    
}
