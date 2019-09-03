<?php

namespace App\Visual;

use App\BaseModel;

class FarmMovimientoNotaIngreso extends BaseModel
{
    protected $table = 'farmMovimientoNotaIngreso';

    protected $primaryKey = 'MovNumero';

    protected $fillable = [
        'MovNumero',
        'MovTipo',
        'DocumentoFechaRecepcion',
        'OrigenIdTipo',
        'OrigenNumero',
        'OrigenFecha',
        'idProveedor',
        'idTipoCompra',
        'idTipoProceso',
        'NumeroProceso',
        'idPaciente',
        'idCuentaAtencion',
        'idFuenteFinanciamiento',
        'idComprobantePago',
        'FechaModificacion',
        'idUsuarioModifica',
    ];

    




}
