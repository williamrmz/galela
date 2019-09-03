<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\FactCatalogoBienesInsumos as BienInsumo;
use DB;

class CatalogoBienInsumoController extends Controller
{
    public function index(Request $request)
    {
        $bienesInsumos = BienInsumo::codigo($request->codigo)
            ->nombre($request->nombre)
            ->orderBy('Nombre', 'ASC')->paginate();
        
        return view('fact-config.catalogo-bienes-insumos.index', compact('bienesInsumos'));
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
