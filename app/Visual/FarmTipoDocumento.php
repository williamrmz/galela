<?php

namespace App\Visual;

use App\BaseModel;

class FarmTipoDocumento extends BaseModel
{
    protected $table = 'farmTipoDocumentos';

    protected $primaryKey = 'idTipoDocumento';

    protected $fillable = [
        'idTipoDocumento',
        'CodigoMINSA',
        'Nombre',
        'Abreviatura',
        'Correlativo',
    ];
}
