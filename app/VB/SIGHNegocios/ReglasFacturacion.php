<?php

namespace App\VB\SIGHNegocios;

use Illuminate\Database\Eloquent\Model;

use DB;

use App\VB\SIGHDatos\FacturacionServicioDespacho;
use App\VB\SIGHDatos\TiposFinanciamiento;

class ReglasFacturacion extends Model
{
    public function AreaTramitaSegurosDevuelveTodosSegunFiltro( $filtro )
    {
        $sql = "EXEC AreaTramitaSegurosDevuelveTodosSegunFiltro :filtro";
        $params = ['filtro' => $filtro];
        return DB::select($sql, $params);
    }

    public function FacturacionServicioPagosSeleccionarXidProducto( $lnIdProducto )
    {
        $sql = "EXEC FacturacionServicioPagosSeleccionarXidProducto :idProducto";
        $params = ['idProducto' => $lnIdProducto];
        return DB::select($sql, $params);
    }

    public function FacturacionServicioDespachoSeleccionarPorIdProducto( $lnIdProducto )
    {
        $oFacturacionServicioDespacho = new FacturacionServicioDespacho;
        return $oFacturacionServicioDespacho->SeleccionarPorIdProducto($lnIdProducto);
    }

    public function CatalogoServiciosHospSeleccionarXidProductoIdTipoFinanciamiento( $lnIdProducto, $lnIdtipoFinanciamiento)
    {
        $sql = "EXEC CatalogoServiciosHospSeleccionarXidProductoIdTipoFinanciamiento :lnIdProducto, :lnIdtipoFinanciamiento";
        $params = [
            'lnIdProducto' => $lnIdProducto,
            'lnIdtipoFinanciamiento' => $lnIdtipoFinanciamiento,
        ];
        return DB::select($sql, $params);
    }

    public function TiposFinanciamientoSeleccionarTodos()
    {
        $oTabla = new  TiposFinanciamiento;
        return $oTabla->SeleccionarTodos();
    }

    public function CatalogoServiciosHospSeleccionarXidProducto( $lnIdProducto)
    {
        $sql = "EXEC CatalogoServiciosHospSeleccionarXidProducto :idProducto";
        $params = [
            'idProducto' => $lnIdProducto,
        ];
        return DB::select($sql, $params);
    }

    public function CatalogoServiciosHospEliminarXidProducto( $lnIdProducto )
    {
        $sql = "EXEC CatalogoServiciosHospEliminarXidProducto :idProducto";
        $params = [
            'idProducto' => $lnIdProducto,
        ];
        return DB::update($sql, $params);
    }
}