<?php

namespace App\Visual\SIGHDatos;

use App\BaseModel;

use DB;

class RolesItems extends BaseModel
{
    public static function insertar($model)
    {
        $request = [];

        try{
            $sql = "DECLARE @IdRolItem AS INT
                SET NOCOUNT ON
                EXEC RolesItemsAgregar :Consultar, :Eliminar, :Modificar, :Agregar, :IdRol, :IdListItem, :IdRolItem, :IdUsuarioAuditoria
                SELECT @IdRolItem as IdRolItem";
            $params = [
                'Consultar' => $model->Consultar,
                'Eliminar' => $model->Eliminar,
                'Modificar' => $model->Modificar,
                'Agregar' => $model->Agregar,
                'IdRol' => $model->IdRol,
                'IdListItem' => $model->IdListItem,
                'IdRolItem' => $model->IdRolItem,
                'IdUsuarioAuditoria' => $model->IdUsuarioAuditoria,
            ];
            $data = DB::select($sql, $params);
            $request['data'] = arrFirst($data);
            $request['status'] = true;

        }catch(\Exception $e){
            $request['status'] = true;
            $request['message'] = $e->getMessage();
        }

        return arrJson($request);
    }

    public static function modificar($model)
    {
        $request = [];

        try{
            $sql = "EXEC RolesItemsModificar :Consultar, :Eliminar, :Modificar, :Agregar, :IdRol, :IdListItem, :IdRolItem";
            $params = [
                'Consultar' => $model->Consultar,
                'Eliminar' => $model->Eliminar,
                'Modificar' => $model->Modificar,
                'Agregar' => $model->Agregar,
                'IdRol' => $model->IdRol,
                'IdListItem' => $model->IdListItem,
                'IdRolItem' => $model->IdRolItem,
                'IdUsuarioAuditoria' => $model->IdUsuarioAuditoria,
            ];
            $request['data'] = DB::update($sql, $params);
            $request['status'] = true;
        }catch(\Exception $e){
            $request['status'] = false;
            $request['message'] = $e->getMessage();
        }

        return arrJson($request);
    }

    public static function eliminar($model)
    {
        try{
            $sql = "EXEC RolesItemsEliminar, :IdRolItem, :IdUsuarioAuditoria";
            $params = [
                'IdRolItem' => $model->IdRolItem,
                'IdUsuarioAuditoria' => $model->IdUsuarioAuditoria,
            ];

            $request['data'] = DB::update($sql, $params);
            $request['status'] = true;
        }catch(\Exception $e){
            $request['status'] = false;
            $request['message']= $e->getMessage();
        }

        return arrJson($request);
    }

    public static function seleccionarPorId($model)
    {
        $request = [];

        try{
            $sql = "EXEC RolesItemsSeleccionarPorId :IdRolItem";
            $params = [
                'IdRolItem' => $model->IdRolItem,
            ];

            $data = DB::select($sql, $params);
            $request['data'] = arrFirst($data);
            $request['status'] = true;
        }catch(\Exception $e){
            $request['status'] = false;
            $request['message'] = $e->getMessage();
        }

        return arrJson($request);
    }

    public static function seleccionarTodos()
    {
        $request = [];
        try{
            $request['data'] = DB::select("RolesSeleccionarTodos");
            $request['status'] = true;
        }catch(\Exception $e){
            $request['status'] = false;
            $request['message'] = $e->getMessage();
        }

        return arrJson($request);
    }

    public static function seleccionarGruposPorUsuario($idUsuario)
    {
        $request = [];
        try{
            $request['data'] = DB::select("RolesItemsSeleccionarGruposPorUsuario $idUsuario");
            $request['status'] = true;
        }catch(\Exception $e){
            $request['status'] = false;
            $request['message'] = $e->getMessage();
        }

        return arrJson($request);
    }

    public static function seleccionarItemsPorUsuarioYGrupo($idUsuario, $idGrupo)
    {
        $request = [];
        try{
            $request['data'] = DB::select("RolesItemsSeleccionarItemsPorUsuarioYGrupo $grupo, $idUsuario");
            $request['status'] = true;
        }catch(\Exception $e){
            $request['status'] = false;
            $request['message'] = $e->getMessage();
        }

        return arrJson($request);
    }

    public static function actualizarRolesItems($oRolesItems, $idRol)
    {
        $request = [];
        try{
            DB::update("EXEC RolesItemsEliminarXidRol $idRol");

            if($oRolesItems){
                foreach($oRolesItems as $oRolItem){
                    $oRolItem->IdRol = $idRol;
                    selft::insertar($oRolItem);
                }
            }
            $request['status'] = true;
        }catch(\Exception $e){
            $request['status'] = false;
            $request['message'] = $e->getMessage();
        }

        return arrJson($request);
    }

    public static function eliminarRolesItems($idRol)
    {
        $request = [];
        try{
            $request['data'] = DB::update("EXEC RolesItemsEliminarXidRol $idRol");
            $request['status'] = true;
        }catch(\Exception $e){
            $request['status'] = false;
            $request['message'] = $e->getMessage();
        }

        return arrJson($request);
    }

    public static function seleccionarPorRol($idRol)
    {
        $request = [];
        try{
            $request['data'] = DB::select("EXEC RolesItemsSeleccionarPorRol $idRol");
            $request['status'] = true;
        }catch(\Exception $e){
            $request['status'] = false;
            $request['message'] = $e->getMessage();
        }

        return arrJson($request);
    }

    public static function seleccionarPermisosPorIdEmpleadoYIdListItem( $idEmpleado, $idListItem)
    {
        $request = [];
        try{
            $sql = "EXEC RolesItemSeleccionarPermisosPorIdEmpleadoYIdListItem :idEmpleado, :idListItem";
            $params = [
                'idEmpleado' => $idEmpleado,
                'idListItem' => $idListItem,
            ];
            $request['data'] = DB::select($sql, $params );
            $request['status'] = true;
        }catch(\Exception $e){
            $request['status'] = false;
            $request['message'] = $e->getMessage();
        }

        return arrJson($request);
    }
    
}