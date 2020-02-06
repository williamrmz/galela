<?php

namespace App\Http\Controllers\Lab;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Empleados as Empleado;
use App\Model\FactCatalogoBienesInsumos as BienInsumo;
use App\Model\UtilInsumo;
use DB;

class InsumoConsumoController extends Controller
{
    const PATH_VIEW = 'lab.insumos.consumos.';

    public function index(Request $request)
    {
        if($request->ajax()) {
            
            $fechas = explode('-', $request->rangoFecha);
            $desdeFecha = null;
            $hastaFecha = null;
            $insumo = (int) $request->insumo;
            $almacen = (int) $request->almacen;
            $empleado = (int) $request->empleado;

            if(count($fechas)==2){
                $desdeFecha = trim($fechas[0]);
                $hastaFecha = trim($fechas[1]);
                $desdeFecha = \DateTime::createFromFormat('d/m/Y H:i', $desdeFecha)->format('d/m/Y H:i:00');
                $hastaFecha = \DateTime::createFromFormat('d/m/Y H:i', $hastaFecha)->format('d/m/Y H:i:00');
            }

            $insumosStock = UtilInsumo::getStockInsumosLab($desdeFecha, $hastaFecha, $insumo, $almacen, $empleado);
            $data = $insumosStock;
            // $data = json_decode(json_encode($insumosStock));
            // dd($data);
            return view(self::PATH_VIEW.'partials.list', compact('data'));
        }
        return view(self::PATH_VIEW.'index');
    }

    public function create()
    {
        if($request->ajax()) {
            return view(self::PATH_VIEW.'partials.form-create', compact('list'));
        }
    }

    public function store(Request $request)
    {
        //
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {

    }

    public function update(Request $request, $id)
    {

    }

    public function delete($id)
    {

    }

    public function destroy($id)
    {

    }
}
