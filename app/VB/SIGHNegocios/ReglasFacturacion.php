<?php

namespace App\VB\SIGHNegocios;

use App\VB\SIGHDatos\Servicios;
use App\VB\SIGHEntidades\Enumerados;
use Illuminate\Database\Eloquent\Model;

use DB;

use App\VB\SIGHDatos\FacturacionServicioDespacho;
use App\VB\SIGHDatos\TiposFinanciamiento;
use App\VB\SIGHDatos\Pacientes;

class ReglasFacturacion extends Model
{
    // Created by Romel Diaz at 2019-09-27
    public function PacienteSePuedeEliminar( $lidPaciente )
    {
        $oTabla = new Pacientes;
        return $oTabla->SePuedeEliminar($lidPaciente);
    }
    
    // LA 12.02.2020
    public static function FacturacionPaquetesCEporIdPuntoCargaNrocuentaIdEspecialidad($lnIdCuentaAtencion, $lnIdEspecialidad, $lnIdPuntoCarga )
    {
        $sql = "EXEC FacturacionPaquetesCEporIdPuntoCargaNrocuentaIdEspecialidad :idPuntoCarga, :IdCuentaAtencion, :IdEspecialidad";
        $params = [
            'idPuntoCarga' => $lnIdPuntoCarga,
            'IdCuentaAtencion' => $lnIdCuentaAtencion,
            'IdEspecialidad' => $lnIdEspecialidad,
        ];
        return DB::select($sql, $params);
    }

    // LA 12.02.2020
    public static function DevuelveSiPagoConsultaMedicaEnCaja($idAtencion, $motivoSalida)
    {
        $sql = "EXEC DevuelveSiPagoConsultaMedicaEnCaja :IdAtencion, :MotivoSalidaHistoria";
        $params =
            [
                'IdAtencion' => $idAtencion,
                'MotivoSalidaHistoria' => $motivoSalida,
            ];
        return DB::select($sql, $params);
    }

    // Created by Romel Diaz at 2019-09-01
    public function AreaTramitaSegurosDevuelveTodosSegunFiltro( $filtro )
    {
        $sql = "EXEC AreaTramitaSegurosDevuelveTodosSegunFiltro :filtro";
        $params = ['filtro' => $filtro];
        return DB::select($sql, $params);
    }

    // Created by Romel Diaz at 2019-09-01
    public function FacturacionServicioPagosSeleccionarXidProducto( $lnIdProducto )
    {
        $sql = "EXEC FacturacionServicioPagosSeleccionarXidProducto :idProducto";
        $params = ['idProducto' => $lnIdProducto];
        return DB::select($sql, $params);
    }

    // Created by Romel Diaz at 2019-09-01
    public function FacturacionServicioDespachoSeleccionarPorIdProducto( $lnIdProducto )
    {
        $oFacturacionServicioDespacho = new FacturacionServicioDespacho;
        return $oFacturacionServicioDespacho->SeleccionarPorIdProducto($lnIdProducto);
    }

    // Created by Romel Diaz at 2019-09-01
    public function CatalogoServiciosHospSeleccionarXidProductoIdTipoFinanciamiento( $lnIdProducto, $lnIdtipoFinanciamiento)
    {
        $sql = "EXEC CatalogoServiciosHospSeleccionarXidProductoIdTipoFinanciamiento :lnIdProducto, :lnIdtipoFinanciamiento";
        $params = [
            'lnIdProducto' => $lnIdProducto,
            'lnIdtipoFinanciamiento' => $lnIdtipoFinanciamiento,
        ];
        return DB::select($sql, $params);
    }

    // Created by Romel Diaz at 2019-09-01
    public function TiposFinanciamientoSeleccionarTodos()
    {
        $oTabla = new  TiposFinanciamiento;
        return $oTabla->SeleccionarTodos();
    }

    // Created by Romel Diaz at 2019-09-01
    public function CatalogoServiciosHospSeleccionarXidProducto( $lnIdProducto)
    {
        $sql = "EXEC CatalogoServiciosHospSeleccionarXidProducto :idProducto";
        $params = [
            'idProducto' => $lnIdProducto,
        ];
        return DB::select($sql, $params);
    }

    // Created by Romel Diaz at 2019-09-01
    public function CatalogoServiciosHospEliminarXidProducto( $lnIdProducto )
    {
        $sql = "EXEC CatalogoServiciosHospEliminarXidProducto :idProducto";
        $params = [
            'idProducto' => $lnIdProducto,
        ];
        return DB::update($sql, $params);
    }

    public static function BuscaServicioActualDelPaciente($IdServicio)
    {
        $nombreServicio = Servicios::SeleccionarPorId($IdServicio) ? Servicios::SeleccionarPorId($IdServicio)[0]->Nombre : "";
        return $nombreServicio;
    }

    public static function TiposFinanciamientoGeneraReciboPago($idTipoFinanciamiento)
    {
        $datos = TiposFinanciamiento::SeleccionarPorIdentificador($idTipoFinanciamiento);

        if(count($datos)>0)
        {
            $datos = collect($datos[0]);
            if($datos["GeneraPago"] == "1" || $idTipoFinanciamiento == Enumerados::data()['sghTipoFinanciamiento']['SisIndependiente'])
            {
                $generaPago = true;
            }
            else
            {
                $generaPago = false;
            }
        }
        return $generaPago;
    }


}