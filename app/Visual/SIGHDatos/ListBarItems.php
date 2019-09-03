<?php

namespace App\Visual\SIGHDatos;

use App\BaseModel;

use App\Visual\Procedure;

class ListBarItems extends BaseModel
{
    public static function insertar(&$model)
    {
        $id = Procedure::ListbarItemsAgregar($model->keyIcon, $model->indice, $model->clave, $model->texto, $model->idListGrupo, $model->idListItem, $model->idUsuarioAuditoria);
        $model->idListItem = $id;
        return $model;
    }

    public static function modificar($model)
    {
        $data = Procedure::ListbarItemsModificar($model->keyIcon, $model->indice, $model->clave, $model->texto, $model->idListGrupo, $model->idListItem, $model->idUsuarioAuditoria);
        return $data;
    }

    public static function eliminar($model)
    {
        $data = Procedure::ListbarItemsEliminar($model->idListItem, $model->idUsuarioAuditoria);
        return $data;
    }

    //OK
    public static function seleccionarPorId($idListItem)
    {
        $data = Procedure::ListbarItemsSeleccionarPorId($idListItem);
        return $data;
    }

    //OK
    public static function seleccionarTodos()
    {
        $data = Procedure::ListbarItemsSeleccionarTodos();
        return $data;
    }
}