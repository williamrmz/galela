<?php

namespace App\VB\SIGHNegocios;

use Illuminate\Database\Eloquent\Model;

use DB;

use App\VB\SIGHDatos\ArchiveroServicio;

class ReglasArchivoClinico extends Model
{
    public function ArchiveroServicioAgregar( $oArchiverosServicio, $mo_lnIdTablaLISTBARITEMS, $mo_lcNombrePc)
    {
        $oArchiveroServicio = new ArchiveroServicio;
        $agregarArchivos = $oArchiveroServicio->AgregarVarios($oArchiverosServicio);
        // dd($agregarArchivos);
        return true;
    }

    public function ArchiveroServicioModificar( $oArchiverosServicio, $mo_lnIdTablaLISTBARITEMS, $mo_lcNombrePc, $idEmpleado)
    {
        $oArchiveroServicioClinica = new ArchiveroServicio;
        $modificarArchiveros = $oArchiveroServicioClinica->ModificarVarios($oArchiverosServicio, $idEmpleado);
        // dd($modificarArchivero);
        return $modificarArchiveros;
    }

    public function ArchiveroServicioEliminar($oArchiverosServicio, $mo_lnIdTablaLISTBARITEMS, $mo_lcNombrePc, $lnIdUsuarioAuditoria, $idEmpleado )
    {
        $oArchiveroServicioClinica = new ArchiveroServicio;
        $eliminarArchiveros = $oArchiveroServicioClinica->EliminarVarios($oArchiverosServicio, $idEmpleado);
        // dd($eliminarArchiveros);
        return $eliminarArchiveros;
    }

    public function ArchiveroServicioFiltrar( $oEmpleado )
    {
        $oTabla = new ArchiveroServicio;
        return $oTabla->Filtrar($oEmpleado);
    }

    public function ArchiveroServicioFiltrarPorEmpleado( $lIdEmpleado )
    {
        $oTabla = new ArchiveroServicio;
        return $oTabla->FiltrarPorEmpleado( $lIdEmpleado );
    }

}