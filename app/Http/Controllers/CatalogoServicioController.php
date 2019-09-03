<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\FactCatalogoServicioSubGrupo as SubGrupo;
use App\Model\FactCatalogoServicios as Servicio;
use DB;

class CatalogoServicioController extends Controller
{
    public function index(Request $request)
    {
        $servicios = Servicio::tipoCatalogo(1)
            ->codigo($request->codigo)
            ->nombre($request->nombre)
            ->orderBy('IdServicioSubGrupo', 'ASC')->get();

    
        dd($servicio);
        $subGrupos = Servicio::buildCatalogo($servicios);

        // foreach($subGrupos as $subGrupo){
        //     echo "$subGrupo->Codigo - $subGrupo->Descripcion <br>";

        //     foreach($subGrupo->services as $servicio){
        //         echo "$servicio->Codigo - $servicio->Nombre <br>";
        //     }
        // }

        // die;

        return view('fact-config.catalogo-servicios.index', compact('subGrupos'));
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
        //
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }
}
