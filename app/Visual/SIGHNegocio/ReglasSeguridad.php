<?php

namespace App\Visual\SIGHNegocio;

use App\BaseModel;
use App\Visual\SIGHDatos\Roles;
use App\Visual\SIGHDatos\Permisos;
use App\Visual\SIGHDatos\ListBarItems;
use App\Visual\Procedure;

class ReglasSeguridad extends BaseModel
{
    public function rolesSeleccionarTodos()
    {
        $data = Roles::seleccionarTodos();
        return $data;
    }

    public function listItemsSeleccionarTodos()
    {
        $data = ListBarItems::seleccionarTodos();
        return $data;
    }

    public function permisosSeleccionarTodos()
    {
        $tabla = new Permisos;
        $results = $tabla->seleccionarTodos();
        $data = $results->status? $results->data: [];
        return $data;
    }

    public function listBarReportesSeleccionarTodos()
    {
        $data = Procedure::ListBarReporteSeleccionarTodos();
        return $data;
    }

}
