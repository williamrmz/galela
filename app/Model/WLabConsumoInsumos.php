<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class WLabConsumoInsumos extends Model
{
    protected $table = "WLabConsumoInsumos";

    public $timestamps = false;

    public static function insumosDePrueba($idProducto)
    {
        $data = \DB::table('LabInsumosCpt as i')->whereNull('i.DeletedAt')
            ->leftJoin('FactCatalogoBienesInsumos as bi', 'bi.IdProducto', 'i.IdProductoInsumo')
            ->where('IdProductoServicio', $idProducto)
            ->select('i.IdInsumo', 'bi.Codigo', 'bi.Nombre', 'i.Cantidad', 'i.Unidad')
            ->get();
        return $data;
    }

    public static function consumosDePrueba($idOrden, $idProducto, $insumos, $pruebaTieneConsumos)
    {
        $user = \Auth::user();
        $query = \DB::table('WLabConsumoInsumos as ci')
            ->leftJoin('Empleados as e', 'e.IdEmpleado',  'ci.IdEmpleado')
            ->select(
                'e.IdEmpleado', 'e.ApellidoPaterno', 'e.ApellidoMaterno', 'Nombres', 'DNI', 'Usuario'
                , 'ci.Cantidad', 'ci.IdInsumo'
            )
            ->OrderBy('ci.IdInsumo')
            ->where('IdOrden', $idOrden)
            ->where('IdProductoCpt', $idProducto)->get();
        // dd($query);

        $addUser  = true;
        foreach ($query as $row) {
            if($row->IdEmpleado == $user->id_empleado) { $addUser = false ; break; }
        }

        if($addUser) {
            $empleado  = $user->empleado;
            foreach ($insumos as  $insumo) {

                $collect = json_decode(json_encode([
                    'IdEmpleado'=> $empleado->IdEmpleado,
                    'ApellidoPaterno'=> $empleado->ApellidoPaterno,
                    'ApellidoMaterno'=> $empleado->ApellidoMaterno,
                    'Nombres'=> $empleado->Nombres,
                    'DNI'=> $empleado->DNI,
                    'Usuario'=> $empleado->Usuario,
                    'Cantidad'=> !$pruebaTieneConsumos? $insumo->Cantidad: null,
                    'IdInsumo'=> $insumo->IdInsumo,
                ]));
                $query->push($collect);
            }
        }
        // dd($query);

        $data = [];
        foreach ($query as $row) {
            $dni = trim($row->DNI);
            $userInfo = "<div class='text-left'>
                <b>Nombres: </b> $row->Nombres </br>
                <b>Apellidos: </b> $row->ApellidoPaterno $row->ApellidoMaterno </br>
                <b>DNI: </b> $dni </br>
            </div>";

            $data[$row->IdEmpleado]['Empleado'] = ['IdEmpleado' => $row->IdEmpleado, 'Usuario' => $row->Usuario, 'info'=>$userInfo ];
            $data[$row->IdEmpleado]['MisInsumos'][$row->IdInsumo] = [ 'IdInsumo' => $row->IdInsumo, 'Cantidad' => $row->Cantidad];
        }   
        return $data;
    }

    public static function consumoEmpleados($idOrden, $idProducto)
    {

    }

    public static function pruebaConsumoCerrado($idOrden, $idProducto)
    {
        $status = false;
        $data = \DB::table('WLabConsumoInsumos')
            ->where('IdOrden', $idOrden)
            ->where('IdProductoCpt', $idProducto)
            ->get();

        if($data->count() > 0 ){
            foreach($data as $row){
                if($row->FechaCierreStock != null){
                    $status = true;
                    break;
                }
            }
        }else{
            $status = false;
        }
        return $status;
    }

    public static function pruebaTieneInsumos($idProducto)
    {
        $count = \DB::table('LabInsumosCpt')->whereNull('DeletedAt')
            ->where('IdProductoServicio', $idProducto)->count();
        $status = $count? 1: 0;
        return $status;
    }

    public static function pruebaTieneConsumos($idOrden, $idProducto)
    {
        $count = \DB::table('WLabConsumoInsumos')
            ->where('IdOrden', $idOrden)
            ->where('IdProductoCpt', $idProducto)
            ->count();
        $status = $count? 1: 0;
        return $status;
    }
}
