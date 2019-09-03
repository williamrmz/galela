<?php

namespace App\Visual;

use App\BaseModel;
use DB;

class FarmMovimientoDetalle extends BaseModel
{
    protected $table = 'farmMovimientoDetalle';

    protected $primaryKey = 'MovNumero';

    protected $fillable = [
        'MovNumero',
        'MovTipo',
        'idproducto',
        'Lote',
        'FechaVencimiento',
        'IdTipoSalidaBienInsumo',
        'Item',
        'Cantidad',
        'Precio',
        'Total',
        'RegistroSanitario'
    ];

    public function actualizaSaldosPorProducto($entradaOsalida, $idAlmacen, $fechaMovimiento)
    {
        /**
         * PROCEDURE: FarmActualizaSaldosPorProducto
         */
        $data = [
            'lcEntradaSalida' =>  $entradaOsalida,
            'IdAlmacen' =>  $idAlmacen,
            'IdProducto' =>  $this->idproducto,
            'Lote' =>  $this->Lote,
            'FechaVencimiento' =>  $this->FechaVencimiento,
            'Cantidad' =>  $this->Cantidad,
            'precio' =>  $this->Precio,
            'idTipoSalidaBienInsumo' => $this->IdTipoSalidaBienInsumo,
        ];

        // dd($data);

        $procedure = DB::update('EXEC FarmActualizaSaldosPorProducto 
        :lcEntradaSalida, 
        :IdAlmacen, 
        :IdProducto, 
        :Lote, 
        :FechaVencimiento, 
        :Cantidad, 
        :precio, 
        :idTipoSalidaBienInsumo', $data);

        $this->actualizaSaldosMensuales($entradaOsalida, $idAlmacen, $fechaMovimiento);

    }

    public function actualizaSaldosMensuales($entradaOsalida, $idAlmacen, $fechaMovimiento)
    {
        /**
         * PROCEDURE: FarmActualizaSaldosMensual
         */
        $dateFormat = 'dmy H:i:s';
        $data = [
            'lcEntradaSalida' => $entradaOsalida,
            'IdAlmacen' => $idAlmacen,
            'IdProducto' => $this->idproducto,
            'Cantidad' => $this->Cantidad,
            'FechaMov' => dateFormat($fechaMovimiento, 'd-m-Y H:i:s'),
            // 'FechaMov' => $this->$fechaMovimiento,
            'Lote' => $this->Lote,
            'FechaVencimiento' => dateFormat($this->FechaVencimiento, 'd-m-Y H:i:s'),
            // 'FechaVencimiento' => $this->FechaVencimiento,
            'Precio' => $this->Precio,
            'idTipoSalidaBienInsumo' => $this->IdTipoSalidaBienInsumo,
        ];

        // dd($data);

        $procedure = DB::update('EXEC FarmActualizaSaldosMensual 
        :lcEntradaSalida, 
        :IdAlmacen,
        :IdProducto,
        :Cantidad,
        :FechaMov,
        :Lote,
        :FechaVencimiento,
        :Precio,
        :idTipoSalidaBienInsumo', $data);

    }
}
