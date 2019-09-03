<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\FactCatalogoBienesInsumos as BienInsumo;
use App\Model\LabInsumosCpt as InsumoCpt;
use DB;

class PartialController extends Controller
{
    public function index(Request $request)
    {
        switch ($request->service)
        {
            case 'getTablaEmpleados': return $this->getTablaEmpleados($request);
            default; return null;
        }
    }

    public function getTablaEmpleados($request)
    {
        $query = DB::table('Empleados')
            ->select('IdEmpleado', 
                DB::Raw("RTRIM(DNI) DNI"), 
                DB::Raw("ApellidoPaterno +' '+ApellidoMaterno+' '+Nombres Fullname"));

        if(trim($request->empleadoFiltro) != null){
            $filtro = str_replace(" ", "", $request->empleadoFiltro);
            $query->whereRaw("REPLACE(ApellidoPaterno+ApellidoMaterno+Nombres, ' ', '') LIKE '%$filtro%'");
            $query->orWhereRaw("RTRIM(DNI) LIKE '%$filtro%'");
        }
            

        $empleados = $query->paginate(10);
        return view('partials.tabla-empleados', compact('empleados'));
    }

}
