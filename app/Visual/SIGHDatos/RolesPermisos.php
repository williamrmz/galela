<?php

namespace App\Visual\SIGHDatos;

use App\BaseModel;

use DB;

class RolesPermisos extends BaseModel
{
    public static function insertar($model)
    {
        $request = [];
        try{
            $sql = "DECLARE @IdRolItem AS INT
                SET NOCOUNT ON
                EXEC RolesPermisosAgregar :IdRol, :IdPermiso, :IdRolPermiso, :IdUsuarioAuditoria
                SELECT @IdRolItem as IdRolItem";
            $params = [
                'IdRol' => $model->IdRol,
                'IdPermiso' => $model->IdPermiso,
                'IdRolPermiso' => $model->IdRolPermiso,
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
            $sql = "EXEC RolesPermisosModificar :IdRol, :IdPermiso, :IdRolPermiso, :IdUsuarioAuditoria";
            $params = [
                'IdRol' => $model->IdRol,
                'IdPermiso' => $model->IdPermiso,
                'IdRolPermiso' => $model->IdRolPermiso,
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
            $sql = "EXEC RolesPermisosEliminar, :IdRolPermiso, :IdUsuarioAuditoria";
            $params = [
                'IdRolPermiso' => $model->IdRolPermiso,
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

    //CHECKED!
    public static function seleccionarPorId($model)
    {
        $request = [];

        try{
            $sql = "EXEC RolesPermisosSeleccionarPorId :IdRolPermiso";
            $params = [
                'IdRolPermiso' => $model->IdRolPermiso,
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

    //CHECKED!
    public static function seleccionarPorRol($idRol)
    {
        $request = [];
        try{
            $request['data'] = DB::select("RolesPermisosSeleccionarPorRol $idRol");
            $request['status'] = true;
        }catch(\Exception $e){
            $request['status'] = false;
            $request['message'] = $e->getMessage();
        }

        return arrJson($request);
    }

    public static function ActualizarRolesPermisos($oRolesPermisos, $idRol)
    {
        $request = [];
        try{
            $request['data'] = DB::update("RolesPermisosEliminarPorIdRol $idRol");
            foreach($oRolesPermisos as $oRolPermiso){
                $oRolPermiso->idRol;
                self::insertar($oRolPermiso);
            }
            $request['status'] = true;
        }catch(\Exception $e){
            $request['status'] = false;
            $request['message'] = $e->getMessage();
        }

        return arrJson($request);
    }

    //CHECKED!
    public static function seleccionarPermisosFacturacionPorUsuario($idEmpleado)
    {
        $request = [];
        try{
            $request['data'] = DB::select("RolesPermisosXidEmpleado $idEmpleado");
            $request['status'] = true;
        }catch(\Exception $e){
            $request['status'] = false;
            $request['message'] = $e->getMessage();
        }

        return arrJson($request);
    }
    
}