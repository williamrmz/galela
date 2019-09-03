<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\FactCatalogoBienesInsumos as BienInsumo;
use App\Model\LabInsumosCpt as InsumoCpt;
use App\Model\LabItems as Item;
use App\Model\WebGermenes as Germen;
use App\Model\WebAntibioticos as Antibiotico;
use DB;

class ApiController extends Controller
{
    public function index(Request $request)
    {
        switch ($request->service)
        {
            
            case 'getLabEmpleados': return $this->getLabEmpleados($request);

            case 'getLabInsumoResponsables'; return $this->getLabInsumoResponsables($request);

            case 'getLabConsumoInsumos': return $this->getLabConsumoInsumos($request);
            

            case 'getLabConsumoEmpleados': return $this->getLabConsumoEmpleados($request);

            case 'getTablaGermenes': return $this->getTablaGermenes($request);

            case 'getDataAntibioticos': return $this->getDataAntibioticos($request);

            case 'getInsumos': return $this->getInsumos($request);

            case 'getServicioInsumos': return $this->getServicioInsumos($request);

            case 'getTablaItemReferencias': return $this->getTablaItemReferencias($request);
          
            default; return null;
        }
    }

    //OK
    private function getLabEmpleados($request)
    {
        $filtro = str_replace(' ', '', $request->search);
        $query = DB::table('Empleados as e');
            if($filtro != null){
                $query = $query->whereRaw("DNI LIKE '%$filtro%'")
                    ->orWhereRaw("REPLACE(Nombres+ApellidoPaterno+ApellidoMaterno, ' ', '') LIKE '%$filtro%'");
            }
        $query->select('e.idEmpleado', 'e.dni', 'e.nombres', 'e.apellidoPaterno', 'e.apellidoMaterno');
        $data = $query->paginate(10);
        return $data;
    }

    //OK
    private function getLabInsumoResponsables($request)
    {
        $query = DB::table('farmMovimiento as m')
            ->leftJoin('Empleados as e', DB::Raw('try_parse(e.DNI as int)'), DB::Raw('try_parse(m.Observaciones as int)'))
            ->where('m.MovTipo', 'E')->where('m.idAlmacenDestino', 13);

        $search = str_replace(' ', '', $request->search);
        if($search)
            $query->whereRaw("REPLACE(e.Nombres+e.ApellidoPaterno+e.ApellidoMaterno, ' ', '') LIKE '%$search%'")
                ->orWhereRaw("REPLACE(e.DNI, ' ', '') LIKE '%$search%'");

        $data = $query->select('e.idEmpleado', 'e.dni', 'e.nombres', 'e.apellidoPaterno', 'e.apellidoMaterno')
            ->distinct()->paginate(10);
        return $data;
    }

    //OK
    private function getLabConsumoInsumos($request)
    {
        $query = DB::table('LabInsumosCpt as ic')
            ->leftJoin('FactCatalogoBienesInsumos as bi', 'bi.IdProducto', 'ic.IdProductoInsumo')
            ->select('bi.idProducto', 'bi.codigo', 'bi.nombre', 'bi.denominacion')
            ->paginate(10);

        return $query;
    }

    //OK
    private function getTablaGermenes($request)
    {
        $query = DB::table('WebGermenes')->whereNull('date_deleted');
        $filtro = str_replace(' ', '', $request->filtro);
        if($filtro) $query->where('nombre', 'like', "%$filtro%");
        $data = $query->paginate(10);
        return view('api.tablas.germenes', compact('data'));
    }

    private function getDataAntibioticos($request)
    {
        $data = DB::table('WebAntibioticos')->whereNull('date_deleted')
        ->select('id','nombre', DB::Raw("'' as mic"))->get();
        return $data;
    }

    private function getLabConsumoEmpleados($request)
    {
        $query = DB::table('WLabConsumoInsumos as i')
            ->leftJoin('Empleados as e', 'e.IdEmpleado', 'i.IdEmpleado');

        $search = str_replace(' ', '', $request->search);
        if($search)
            $query->whereRaw("REPLACE(e.Nombres+e.ApellidoPaterno+e.ApellidoMaterno, ' ', '') LIKE '%$search%'")
                ->orWhereRaw("REPLACE(DNI, ' ', '') LIKE '%$search%'");

        $data = $query->select('e.idEmpleado', 'e.nombres', 'e.apellidoPaterno', 'e.apellidoMaterno', 'e.dni')
            ->orderBy('Nombres', 'asc')->distinct()->paginate(10);

        return $data;
    }  

    private function getTablaItemReferencias($request)
    {
        $item = Item::findOrFail($request->idItem);
        return view('api.tablas.item-referencias', compact('item'));
    }

    private function getServicioInsumos($request)
    {
        if($request->IdProducto != '' || $request->IdProducto > 0){

            $data = DB::table('LabInsumosCpt as i')
                ->whereNull('i.DeletedAt')->where('IdProductoServicio', $request->IdProducto)
                ->leftJoin('FactCatalogoBienesInsumos as bi', 'bi.IdProducto', 'i.IdProductoInsumo')
                ->select('i.IdInsumo', 'bi.IdProducto', 'i.Cantidad', 'i.Unidad', 'bi.Codigo', 'bi.Nombre')
                ->get();
            return $data;
        }
        return null;
    }

    private function getInsumos($request)
    {
        $insumos = BienInsumo::codigo($request->codigo)
        ->nombre($request->nombre)
        ->select('IdProducto', 'Codigo', 'Nombre')
        ->orderBy('Nombre', 'ASC')->paginate(8);

        return view('fact-config.config-resultados-laboratorio.partials.tabla-insumos', compact('insumos'));
    }
}
