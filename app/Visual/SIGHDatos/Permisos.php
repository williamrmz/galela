<?php

namespace App\Visual\SIGHDatos;

use App\BaseModel;

use DB;

class Permisos extends BaseModel
{
    public static function insertar($model)
    {
        $request = [];
        try{
            $sql = "DECLARE @IdPermiso AS INT
                SET NOCOUNT ON
                EXEC PermisosAgregar :Modulo, :Descripcion,  @IdPermiso OUTPUT, :IdUsuarioAuditoria
                SELECT @IdPermiso as IdPermiso";
            $params = [
                'Nombre' => $model->Modulo,
                'Descripcion' => $model->Descripcion,
                'IdUsuarioAuditoria' => $model->IdUsuarioAuditoria,
            ];
            $data = DB::select($sql, $params);
            $request['data']= isset($data[0])? $data[0]: null;
            $request['status']= true;
        }catch(\Exception $e){
            $request['status'] = false;
            $request['message'] = $e->getMessage();
        }

        arrJson($request);
    }

    // public static function modificar($model)
    // {
    //     $request = [];
    //     try{
    //         $sql = "EXEC RolesModificar :Nombre, :IdRol, :IdUsuarioAuditoria";
    //         $params = [
    //             'Nombre' => $model->Nombre,
    //             'IdRol' => $model->IdRol,
    //             'IdUsuarioAuditoria' => $model->IdUsuarioAuditoria,
    //         ];

    //         $request['data'] = DB::update($sql, $params);
    //         $request['status'] = true;
    //     }catch(\Exception $e){
    //         $request['status'] = false;
    //         $request['message'] = $e->getMessage();
    //     }

    //     return arrJson($request);
    // }

    // public static function eliminar($model)
    // {
    //     $request = [];
    //     try{
    //         $sql = "EXEC RolesEliminar :IdRol, :IdUsuarioAuditoria";
    //         $params = [
    //             'IdRol' => $model->IdRol,
    //             'IdUsuarioAuditoria' => $model->IdUsuario,
    //         ];

    //         $request['data'] = DB::update($sql, $params);
    //         $request['status'] = true;
    //     }catch(\Exception $e){
    //         $request['status'] = false;
    //         $request['message'] = $e->getMessage();
    //     }

    //     return arrJson($request);
    // }

    // public static function seleccionarPorId($model)
    // {
    //     $request = [];
    //     try{
    //         $sql = "EXEC RolesSeleccionarPorId :IdRol";
    //         $params = [
    //             'IdRol' => $model->IdRol,
    //         ];
    //         $data = DB::select($sql, $params);
    //         $request['data'] = arrFirst($data);
    //         $request['status'] = true;
    //     }catch(\Exception $e){
    //         $request['status'] = false;
    //         $request['message'] = $e->getMessage();;
    //     }

    //     return arrJson($request);
    // }

    //CHECKED!
    public static function seleccionarTodos()
    {
        try{
            $sql = "EXEC PermisosSeleccionarTodos";
            $request['data'] = DB::select($sql);
            $request['status'] = true;
        }catch(\Exception $e){
            $request['status'] = false;
            $request['message'] = $e->getMessage();;
        }

        return arrJson($request);
    }
}