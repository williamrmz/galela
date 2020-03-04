<?php

namespace App\VB\SIGHNegocios;

use Illuminate\Database\Eloquent\Model;

use DB;

use App\VB\SIGHDatos\CajaCaja;
use App\VB\SIGHDatos\CajaTurno;
use App\VB\SIGHDatos\CajaCajero;
use App\VB\SIGHDatos\CajaGestion;
use App\VB\SIGHDatos\TiposNumeracionHistoria;
use App\VB\SIGHDatos\CajaTiposComprobante;
use App\VB\SIGHDatos\CajaNroDocumento;
use App\VB\SIGHComun\DOCajaNroDocumento;


class ReglasCaja extends Model
{
    public function ListarCajas(){
        $oTabla = new CajaCaja;
        return $oTabla->SeleccionarTodosParaLista();
    }

    public function ListarTurnos(){
        $oTabla = new CajaTurno;
        return $oTabla->SeleccionarTodosParaLista();
    }

    public function ListarCajeros(){
        $oTabla = new CajaCajero;
        return $oTabla->SeleccionarTodos();
    }

    public function ListarTiposHistoria(){
        $oTabla = new TiposNumeracionHistoria;
        return $oTabla->SeleccionarTodos();
    }

    public function NrosComprobante($cNroCaja)
    {
        $oTabla = new CajaNroDocumento;
        return $oTabla->SeleccionarPorIdCaja($cNroCaja);
    }

    public function TiposDeComprobantes()
    {
        $oTabla = new CajaTiposComprobante;
        return $oTabla->SeleccionarTodos();
    }

    public Function CajaAgregar($oDOCaja, $cNroDocumentos, $mo_lnIdTablaLISTBARITEMS ,$mo_lcNombrePc, $lcNcaja)
    {
        
        $oCaja = new CajaCaja;
        $oNroDocumento = new CajaNroDocumento;
        $ItemDocumento = new DOCajaNroDocumento;
        
        $CajaAgregar = False;
        
        $cajaInsertada = $oCaja->Insertar($oDOCaja);
        
    
        /*
        if isset($cajaInsertada->IdCaja) {
            $oDOCaja->IdCaja = $cajaInsertada->IdCaja;

            foreach ($ItemDocumento as $key => $value) {
            $value->IdCaja = $oDOCaja->IdCaja;
                if (! $oNroDocumento.Insertar($ItemDocumento)){
                    dd($oNroDocumento.MensajeError());
                    exit();
                }
            }
        }
        */
        

        /*
        For Each ItemDocumento In cNroDocumentos
            ItemDocumento.IdCaja = oDOCaja.IdCaja
            If Not oNroDocumento.Insertar(ItemDocumento) Then
                ms_MensajeError = oNroDocumento.MensajeError
                Exit Function
            End If
        Next
            '
            AuditoriaAgregarV(oDOCaja.IdUsuarioAuditoria, "A", oDOCaja.IdCaja, "CajaCaja", oConexion, mo_lnIdTablaLISTBARITEMS, mo_lcNombrePc, lcNcaja)        'ListBarItems.idListItem
            CajaAgregar = True
            oConexion.CommitTrans
        Else
            ms_MensajeError = oCaja.MensajeError
            oConexion.RollbackTrans
        End If
    */
    
    }

    public function CajaComprobantePagoSeleccionarPorFechaOdocumento($lnNroSerie, $lnNroDcto, $ldFechaInicio, $ldFechaFin){
        $oTabla = new CajaGestion;
        return $oTabla->CajaComprobantePagoSeleccionarPorFechaOdocumento($lnNroSerie, $lnNroDcto, $ldFechaInicio, $ldFechaFin);
    }

    public function NotaCreditoDevueltosPorNumYFecha($lnNroSerie, $lnNroDcto, $ldFechaInicio, $ldFechaFin){
        $oTabla = new CajaGestion;
        return $oTabla->NotaCreditoDevueltosPorNumYFecha($lnNroSerie, $lnNroDcto, $ldFechaInicio, $ldFechaFin);
    }


    
}