<?php

namespace App\VB\SIGHNegocios;

use Illuminate\Database\Eloquent\Model;

use DB;

use App\VB\SIGHDatos\Departamentos;
use App\VB\SIGHDatos\Provincias;
use App\VB\SIGHDatos\Distritos;
use App\VB\SIGHDatos\Paises;
use App\VB\SIGHDatos\CentroPoblados;

class ReglasServGeograf extends Model
{

    // Created by Romel Diaz at 2019-09-11
    public function CentroPobladoSeleccionarPorDistrito( $IdDistrito)
    {
        $oTabla = new CentroPoblados;
        return $oTabla->SeleccionarPorDistrito($IdDistrito);
    }
    

    // Created by Romel Diaz at 2019-09-10
    public function PaisesSeleccionarTodos()
    {
        $oTabla = new Paises;
        return $oTabla->SeleccionarTodos();
    }

    // Created by Romel Diaz at 2019-09-01
    public function DepartamentosSeleccionarTodos()
    {
        $oTabla = new Departamentos;
        return $oTabla->SeleccionarTodos();
    }

    // Created by Romel Diaz at 2019-09-01
    public function ProvinciasSeleccionarPorDepartamento( $IdDepartamento )
    {
        $oTabla = new Provincias;
        return $oTabla->SeleccionarPorDepartamento( $IdDepartamento );
    }

    // Created by Romel Diaz at 2019-09-01
    public function DistritoSeleccionarPorProvincia( $IdProvincia )
    {
        $oTabla = new Distritos;
        return $oTabla->SeleccionarPorProvincia( $IdProvincia );
    }

}