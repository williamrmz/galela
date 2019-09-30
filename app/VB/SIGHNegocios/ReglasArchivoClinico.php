<?php

namespace App\VB\SIGHNegocios;

use Illuminate\Database\Eloquent\Model;

use DB;

use App\VB\SIGHDatos\ArchiveroServicio;
use App\VB\SIGHDatos\TiposNumeracionHistoria;
use App\VB\SIGHDatos\HistoriasClinicas;
use App\VB\SIGHComun\DOHistoriaClinica;

class ReglasArchivoClinico extends Model
{
    // Created by Romel Diaz at 2019-09-23
    public function HistoriaClinicaSeleccionarPorId( $NroHistoriaClinica )
    {
        $oHistoriaClinica = new HistoriasClinicas;
        $oDoHistoriaClinica = new DOHistoriaClinica;
        $oDoHistoriaClinica->nroHistoriaClinica = $NroHistoriaClinica;
        return $oHistoriaClinica->SeleccionarPorId($oDoHistoriaClinica);
    }

    // Created by Romel Diaz at 2019-09-10
    public function TiposGeneracionHistoriasSeleccionarTodos()
    {
        $oTabla = new TiposNumeracionHistoria;
        return $oTabla->SeleccionarTodos();
    }

    // Created by Romel Diaz at 2019-09-01
    public function ArchiveroServicioAgregar( $oArchiverosServicio, $mo_lnIdTablaLISTBARITEMS, $mo_lcNombrePc)
    {
        $oArchiveroServicio = new ArchiveroServicio;
        $agregarArchivos = $oArchiveroServicio->AgregarVarios($oArchiverosServicio);
        // dd($agregarArchivos);
        return true;
    }

    // Created by Romel Diaz at 2019-09-01
    public function ArchiveroServicioModificar( $oArchiverosServicio, $mo_lnIdTablaLISTBARITEMS, $mo_lcNombrePc, $idEmpleado)
    {
        $oArchiveroServicioClinica = new ArchiveroServicio;
        $modificarArchiveros = $oArchiveroServicioClinica->ModificarVarios($oArchiverosServicio, $idEmpleado);
        // dd($modificarArchivero);
        return $modificarArchiveros;
    }

    // Created by Romel Diaz at 2019-09-01
    public function ArchiveroServicioEliminar($oArchiverosServicio, $mo_lnIdTablaLISTBARITEMS, $mo_lcNombrePc, $lnIdUsuarioAuditoria, $idEmpleado )
    {
        $oArchiveroServicioClinica = new ArchiveroServicio;
        $eliminarArchiveros = $oArchiveroServicioClinica->EliminarVarios($oArchiverosServicio, $idEmpleado);
        // dd($eliminarArchiveros);
        return $eliminarArchiveros;
    }

    // Created by Romel Diaz at 2019-09-01
    public function ArchiveroServicioFiltrar( $oEmpleado )
    {
        $oTabla = new ArchiveroServicio;
        return $oTabla->Filtrar($oEmpleado);
    }

    // Created by Romel Diaz at 2019-09-01
    public function ArchiveroServicioFiltrarPorEmpleado( $lIdEmpleado )
    {
        $oTabla = new ArchiveroServicio;
        return $oTabla->FiltrarPorEmpleado( $lIdEmpleado );
    }

}