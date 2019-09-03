<?php

namespace App\VB\SIGHNegocios;

use Illuminate\Database\Eloquent\Model;

use DB;

use App\VB\SIGHDatos\FarmAlmacen;

class ReglasFarmacia extends Model
{
    public function TiposCargoSeleccionarTodos()
    {
        return DB::select('EXEC TiposCargoSeleccionarTodos');
    }

    public function FarmAlmacenSeleccionarSegunFiltro( $filtro )
    {
        $oTabla = new FarmAlmacen;
        return $oTabla->SeleccionarSegunFiltro( $filtro );
    }
}