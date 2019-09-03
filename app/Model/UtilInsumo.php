<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use DB;

class UtilInsumo extends Model
{


    //OBTIENE EL LOS INSUMOS ASIGNADOS A REPOSNABLES DE LABORATORIO MEDIANTE NOTAS DE SALIDA DE GALENHOS
    public static function getStockInsumosLab($desdeFecha, $hastaFecha, $insumo, $almacen, $empleado)
    {
        // dd($empleado);
        $query = DB::table('vw_farmMovimientoDetalle')->orderBy('fechaCreacion', 'desc');

        // dd($almacen);
        if($insumo > 0) $query->where('idProductoInsumo', $insumo);
        if($almacen > 0) $query->where('idEmpleado', $almacen);

        if($desdeFecha && $hastaFecha) {
            $query->where('fechaCreacion', '>=', $desdeFecha);
            $query->where('fechaCreacion', '<=', $hastaFecha);
        }

        $data = $query->get();
        
        
        $once = true;
        foreach( $data as $key => $row ){

            if($once){
                if( !$row->fechaDevolucion ){
                    $row->fechaDevolucion = date('Y-m-d H:i:s.000');
                }
                $once = false;
            }else{
                if( !$row->fechaDevolucion ) {
                    $row->fechaDevolucion = $data[$key-1]->fechaCreacion;
                }
            }
        }


        // dd($data);


        foreach($data as $key => $row){
            
            $queryData = DB::table('vw_labConsumoInsumos')
                ->where('idProductoInsumo', $row->idProductoInsumo)
                ->where('fechaConsumo', '>=', dateFormat($row->fechaCreacion, 'd-m-Y H:i:s'))
                ->where('fechaConsumo', '<=', dateFormat($row->fechaDevolucion, 'd-m-Y H:i:s'));

            if($empleado>0) $queryData->where('idEmpleado', $empleado);

            $consumosData = $queryData->get();
            // dd($consumosData);

            $consumos = [];
            $consumoDetalles = [];
            $consumoReal = 0;
            $consumoEsperado = 0;
            foreach($consumosData as $index => $consumoData){
                $consumoDetalles[$index]['fecha'] = $consumoData->fechaConsumo; 
                $consumoDetalles[$index]['nombreEmpleado'] = $consumoData->nombreEmpleado; 
                $consumoDetalles[$index]['nombreProductoServicio'] = $consumoData->nombreProductoServicio; 
                $consumoDetalles[$index]['cantidadUsada'] = $consumoData->cantidadUsada; 
                $consumoDetalles[$index]['cantidadReferencia'] = $consumoData->cantidadReferencia;

                $consumoReal += $consumoData->cantidadUsada; 
                $consumoEsperado += $consumoData->cantidadReferencia; 
            }

            $row->consumoEsperado = $consumoEsperado;
            $row->consumoReal = $consumoReal;

            if(count($consumoDetalles)==0){
                $consumoDetalles[0]['fecha'] = null;
                $consumoDetalles[0]['nombreEmpleado'] = null;
                $consumoDetalles[0]['nombreProductoServicio'] = null;
                $consumoDetalles[0]['cantidadUsada'] = null;
                $consumoDetalles[0]['cantidadReferencia'] = null;
            }

            $row->consumoDetalles = $consumoDetalles;
        }


        $stock = [];
        foreach($data as $row){

            $idProductoInsumo = $row->idProductoInsumo;
            $stock[$idProductoInsumo]['row'] = $row;
            $stock[$idProductoInsumo]['idProductoInsumo'] = $idProductoInsumo;
            $stock[$idProductoInsumo]['codigoProductoInsumo'] = $row->codigoProductoInsumo;
            $stock[$idProductoInsumo]['nombreProductoInsumo'] = $row->nombreProductoInsumo;
            $stock[$idProductoInsumo]['entradas'][] = [
                'fechaCreacion' => $row->fechaCreacion,
                'fechaDevolucion' => $row->fechaDevolucion,
                'movNumero' => $row->movNumero,
                'movTipo' => $row->movTipo,
                'cantidad' =>$row->cantidad,
                'empleado' => $row->nombreEmpleado,
                'idEmpleado' => $row->idEmpleado,
                'consumoEsperado' =>  $row->consumoEsperado,
                'consumoReal' =>  $row->consumoReal,
                'consumoDetalle' =>  $row->consumoDetalles,
            ];  
            
            if( isset($stock[$idProductoInsumo]['almacen'])){
                $stock[$idProductoInsumo]['almacen'] += $row->cantidad;
            }else{
                $stock[$idProductoInsumo]['almacen'] = $row->cantidad;
            }

            $stock[$idProductoInsumo]['consumo'] = 0;
            $stock[$idProductoInsumo]['consumoEsperado'] = 0;
        }

        // $stock = json_decode(json_encode($stock));
        // dd($stock);
        return $stock;
    }
}
