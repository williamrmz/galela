<?php

namespace App\Visual\SIGHDatos;

use App\BaseModel;

use App\Visual\Procedure;

use DB;

class Roles extends BaseModel
{
    public static function insertar(&$model)
    {
        $id = Procedure::RolesAgregar($model->nombre, $model->idUsuarioAuditoria);
        $model->idRol = $id;
        return $id;
    }

    public static function modificar($model)
    {
        $data = Procedure::RolesModificar($model->idRol, $model->nombre, $model->idUsuarioAuditoria);
        return $data;
    }

    public static function eliminar($model)
    {
        $data = Procedure::rolesEliminar($model->idRol, $model->idUsuarioAuditoria);
        return $data;
    }

    public static function seleccionarPorId($model)
    {
        $data = Procedure::rolesSeleccionarPorId($model->idRol);
        return $data;
    }

    public static function seleccionarTodos()
    {
        $data = Procedure::rolesSeleccionarTodos();
        return $data;
    }
}