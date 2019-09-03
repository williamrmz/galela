<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Model\FactCatalogoBienesInsumos as BienInsumo;
use App\Model\FactCatalogoServicios as Servicio;
use App\Model\LabItemsCpt as ItemCpt;
use App\Model\LabInsumosCpt as InsumoCpt;
use Illuminate\Support\Arr;


class ConfigResultadoLaboratorioController extends Controller
{
    public function index(Request $request)
    {
        // dd(Servicio::all()->first());
        if(request()->ajax()){
            $data = Servicio::from('FactCatalogoServicios as s')
                ->leftJoin('FactCatalogoServiciosSubGrupo as g', 'g.IdServicioSubGrupo', 's.IdServicioSubGrupo')
                ->buscar($request->buscar)
                ->select('s.*', 'g.Descripcion as NombreServicioSubGrupo')
                ->orderBy('s.IdServicioSubGrupo', 'asc')
                ->get();

            $grupos = [];
            foreach($data as $row){
                $grupos[$row->IdServicioSubGrupo]['Descripcion'] = $row->NombreServicioSubGrupo;
                $grupos[$row->IdServicioSubGrupo]['servicios'][] = $row;
            }

            // dd($grupos);
            
            $grupos = json_decode(json_encode($grupos));
            return view('fact-config.config-resultados-laboratorio.partials.list', compact('grupos'));
        }
        
        return view('fact-config.config-resultados-laboratorio.index');
    }

    public function create()
    {
        
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
        $servicio = Servicio::where('idProducto', $id)->first();

        $itemsCPT = ItemCpt::where('idProductoCpt', $id)->get();

        return view('fact-config.config-resultados-laboratorio.edit', compact('servicio', 'itemsCPT'));
    }

    public function update(Request $request, $id)
    {
        $request->validate( [
            'insumos.*.IdProducto' => 'required',
            'insumos.*.Cantidad' => 'required|numeric'
        ]);

        $insumos = [];

        if($request->insumos){
            foreach($request->insumos as $insumo){
                $insumos[] = [
                    'IdProductoInsumo' => $insumo['IdProducto'],
                    'IdProductoServicio' => $id,
                    'Cantidad' => $insumo['Cantidad'],
                    'Unidad' => $insumo['Unidad'],
                ];
            }
        }
        

        // dd($insumos);

        $idInsumos = collect($insumos)->pluck('IdProductoInsumo');

        DB::beginTransaction();
        try {
            //1. ELIMINAR REGISTROS
            $insumosEliminar = InsumoCpt::where('IdProductoServicio', $id)
                ->whereNotIn('IdProductoInsumo', $idInsumos)->update(['deletedAt' => date('d-m-Y H:i:s')]);;

            //2. AGREGAR NUEVO O EDITAR SI EXISTE
            foreach($insumos as $insumoForm){
                $insumoTmp =  InsumoCpt::whereNull('deletedAt')
                    ->where('IdProductoServicio', $insumoForm['IdProductoServicio'])
                    ->where('IdProductoInsumo', $insumoForm['IdProductoInsumo'])
                    ->get()->first();
                if($insumoTmp){
                    $insumoTmp->Cantidad = $insumoForm['Cantidad'];
                    $insumoTmp->Unidad = $insumoForm['Unidad'];
                    $insumoTmp->save();
                }else{
                    InsumoCpt::insert($insumoForm);
                }
            }
            DB::commit();
            return back()->with('success', 'La configuracion se actualizo correctamente');
        } catch (\Exception $e) {
            DB::rollback();
            return back()->with('error', 'La Transaccion fallo');
        }
    }

    public function destroy($id)
    {
        //
    }
}
