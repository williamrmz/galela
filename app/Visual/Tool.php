<?php

namespace App\Visual;

use App\BaseModel;

use DB;
use App\Visual\SIGHEntidades\SighEstadoTabla;
use App\Visual\FarmMovimiento;
use App\Visual\FarmMovimientoDetalle;
use App\Visual\FarmTipoDocumento;
use App\Visual\Auditoria;
use App\Visual\FarmSaldoDetallado;
use Exception;

class Tool extends BaseModel
{

    const consMovEntrada = "E";
    const consMovSalida = "S";

    public static function AgregaDatosDeNotaSalida($movimiento, $productos, $idItemNS)
    {
        //1. graba tabla correlativos farmTipoDocumento
        $correlativo = self::DevuelveYactualizaCorrelativosDeDocumentosES(2);
        //2. graba tabla Movimientos
        $movimiento->MovNumero = $correlativo;
        $movimiento->save();
        // dd($movimiento);

        //2.1 Auditoria
        self::AuditoriaAgregarV('A', 0, "FarmMovimiento/".$movimiento->MovTipo."/".$movimiento->MovNumero, $idItemNS, '');    
        
        // dd($movimiento);

        //3. graba tabla farmMovimientosDetalle,farmSaldo,farmSaldoDetalle
        $productos = json_decode(json_encode($productos));
        $iItem  = 1;
        foreach($productos as $producto)
        {
            $movimientoDetalle = new FarmMovimientoDetalle;
            // $movimientoDetalle->IdUsuarioAuditoria = $movimiento->IdUsuarioAuditoria; //TODO
            $movimientoDetalle->MovNumero = $movimiento->MovNumero;
            $movimientoDetalle->MovTipo = $movimiento->MovTipo;

            $model = json_decode($producto->model);
            // dd($model);
            $movimientoDetalle->Cantidad = $producto->cantidad;
            $movimientoDetalle->FechaVencimiento = $model->FechaVencimiento;
            $movimientoDetalle->idproducto = $model->idProducto;
            $movimientoDetalle->Item = $iItem;
            $movimientoDetalle->Lote = $model->Lote;
            $movimientoDetalle->Precio = $model->Precio;
            $movimientoDetalle->RegistroSanitario = '';
            $movimientoDetalle->total = $producto->cantidad * $model->Precio;
            $movimientoDetalle->IdTipoSalidaBienInsumo = $model->idTipoSalidaBienInsumoSaldo;


            if(!self::ChequeaQueSaldosConLotesSeaPositivo(
                $movimiento->idAlmacenOrigen, 
                $movimientoDetalle->idproducto, 
                $movimientoDetalle->Lote, 
                $movimientoDetalle->FechaVencimiento, 
                $movimientoDetalle->IdTipoSalidaBienInsumo, 
                $movimientoDetalle->Cantidad
            )){
                $codigo = trim($model->Codigo);
                throw new Exception("No hay Saldos para el Producto <b>[$codigo]</b> $model->Nombre");
            }
            $movimientoDetalle->save();
            
            $movimientoDetalle->actualizaSaldosPorProducto(FarmMovimiento::MOV_SALIDA, $movimiento->idAlmacenOrigen, $movimiento->fechaCreacion);
            
            $iItem ++;

        }

        return true;
    }

    public static function AgregaDatosDeNotaIngreso(
        $movimiento, 
        $movimientoNotaIngreso, 
        $proveedores, 
        $productos, 
        $idtipoFinanciamiento, 
        $lnIdTablaLISTBARITEMS)
    {
        

        //1. graba tabla correlativos farmTipoDocumentos
        $correlativo = self::DevuelveYactualizaCorrelativosDeDocumentosES(1);
        //2. graba tabla Movimientos
        $movimiento->MovNumero = $correlativo;

        $movimiento->save();
        //2.1 Auditoria
        self::AuditoriaAgregarV('A', 0, "FarmMovimiento/".$movimiento->MovTipo."/".$movimiento->MovNumero, FarmMovimiento::ID_LIST_ITEM_NI, '');
        
        //3. Graba nuevo proveedor (not work)

        //4. graba tabla MovimientosNotaIngreso
        $movimientoNotaIngreso->MovNumero = $correlativo;
        $movimientoNotaIngreso->save();
        // dd($movimientoNotaIngreso);

        $productos = json_decode(json_encode($productos));
        $iItem  = 1;
        foreach($productos as $producto)
        {
            $movimientoDetalle = new FarmMovimientoDetalle;
            $movimientoDetalle->MovNumero = $movimiento->MovNumero;
            $movimientoDetalle->MovTipo = $movimiento->MovTipo;

            $model = json_decode($producto->model);
            $movimientoDetalle->Cantidad = $producto->cantidad;
            $movimientoDetalle->FechaVencimiento = $model->FechaVencimiento;
            $movimientoDetalle->idproducto = $model->idProducto;
            $movimientoDetalle->Item = $iItem;
            $movimientoDetalle->Lote = $model->Lote;
            $movimientoDetalle->Precio = $model->Precio;
            $movimientoDetalle->RegistroSanitario = '';
            $movimientoDetalle->total = $producto->cantidad * $model->Precio;
            $movimientoDetalle->IdTipoSalidaBienInsumo = $model->idTipoSalidaBienInsumoSaldo;

            $movimientoDetalle->save();
            
            $movimientoDetalle->actualizaSaldosPorProducto(self::consMovEntrada, $movimiento->idAlmacenDestino, $movimiento->fechaCreacion);
            
            $iItem ++;

            // dd($movimientoDetalle);
        }

        // dd($movimiento);

        return true;
    }

    public static function DevuelveYactualizaCorrelativosDeDocumentosES($idTipoDocumento)
    {
        $sql = "
        DECLARE @next AS INT
        SET NOCOUNT ON
        EXEC FarmDevuelveYactualizaCorrelativosDeDocumentosES $idTipoDocumento, @next
        OUTPUT
        SELECT @next AS 'next'";
        $result = DB::select($sql);
        $correlativo = 0;
        if(count($result) == 1){
            $correlativo = $result[0]->next;
        }else{
            throw new \Exception("Not data in correlativo procedure");
        }

        if($idTipoDocumento = 1 || $idTipoDocumento == 2){
            $correlativo = substr(fechaSQLServer(), -2) . substr('0000000'.$correlativo, -7);
        }

        return $correlativo;
    }

    private static function AuditoriaAgregarV($Accion, $IdRegistro, $Tabla, $idListItem, $observaciones)
    {
        $auditoria = new Auditoria;
        $auditoria->IdEmpleado = \Auth::user()->id;
        $auditoria->Accion = $Accion;
        $auditoria->IdRegistro = $IdRegistro;
        $auditoria->Tabla = $Tabla;
        $auditoria->FechaHora = fechaSistema();
        $auditoria->idListItem = $idListItem;
        $auditoria->nombrePC = nombrePC();
        $auditoria->observaciones = $observaciones;
        return $auditoria->save();
    }

    public static function ChequeaQueSaldosConLotesSeaPositivo($idAlmacen, $idProducto, $lote, $fechaVencimiento, $idTipoSalidaBienInsumo, $cantidad)
    {
        // PROCEDURE: farmDevuelveSaldosSegunAlmacenProductoLote
        $where = [
            'idAlmacen' => $idAlmacen,
            'idProducto' => $idProducto,
            'Lote' => $lote,
            'FechaVencimiento' => $fechaVencimiento,
            'IdTipoSalidaBienInsumo' => $idTipoSalidaBienInsumo,
        ];
        // dd($cantidad);
        // dd($where);
        $status = false;
        $data = FarmSaldoDetallado::where($where)->get();
        // dd($data);
        foreach($data as $row){
            
            if($row->Cantidad >= $cantidad){
                $status = true; break;
            }
        }
        // dd($status);
        return $status;
    }
}
