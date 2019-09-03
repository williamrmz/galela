<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class FactOrdenServicio extends Model
{
    protected $table = "FactOrdenServicio";

    protected $primaryKey = 'IdOrden';

    public function paciente()
    {
        return $this->hasOne('App\Model\Pacientes', 'IdPaciente', 'IdPaciente');
    }
}
