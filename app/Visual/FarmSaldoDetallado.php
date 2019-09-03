<?php

namespace App\Visual;

use App\BaseModel;

class FarmSaldoDetallado extends BaseModel
{
    protected $table = 'farmSaldoDetallado';

    protected $fillable = [
        'idAlmacen',
        'idProducto',
        'Lote',
        'FechaVencimiento',
        'IdTipoSalidaBienInsumo',
        'Cantidad',
        'Precio',
    ];
}
