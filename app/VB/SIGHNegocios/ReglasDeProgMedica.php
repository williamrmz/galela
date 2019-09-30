<?php

namespace App\VB\SIGHNegocios;

use Illuminate\Database\Eloquent\Model;

use DB;

use App\VB\SIGHDatos\Medicos;

class ReglasDeProgMedica extends Model
{
    public function FiltrarEspecialidad()
    {
        $oMedico = new Medicos;
        return $oMedico->FiltrarEspecialidadCE();
    }

}