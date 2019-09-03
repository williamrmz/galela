<?php

namespace App\VB\SIGHNegocios;

use Illuminate\Database\Eloquent\Model;

use DB;

// use App\VB\SIGHDatos\FarmAlmacen;
use App\VB\SIGHDatos\Servicios;

class ReglasServiciosHosp extends Model
{
    public function ServiciosFiltrar($oServicio, $lDepartamentoHospital, $lnTipoEstado)
    {
        $oTabla = new Servicios;
        return $oTabla->Filtrar($oServicio, $lDepartamentoHospital, $lnTipoEstado);
    }

}