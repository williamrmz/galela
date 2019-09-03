<?php

namespace App\Visual;

use App\BaseModel;

class Auditoria extends BaseModel
{
    protected $table = 'Auditoria';

    protected $primaryKey = 'idTipoDocumento';

    protected $fillable = [
        'IdUditoria',
        'FechaHora',
        'Tabla',
        'IdRegistro',
        'Accion',
        'IdEmpleado',
        'idListItem',
        'nombrePc',
        'observaciones',
    ];
}
