<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\FactCatalogoServicioSubGrupo as SubGrupo;
use App\Model\FactCatalogoServicios as Servicio;
use App\Model\LabEmpleadoInsumos as EmpleadoInsumo;
use DB;

class AsignacionInsumoController extends Controller
{
    public function index(Request $request)
    {
        $asignaciones = [];
        return view('laboratorio.asignacion-insumos.index', compact('asignaciones'));
    }

    public function create()
    {
        $idEmpleado = 738;
        $misInsumos = EmpleadoInsumo::where('IdEmpleado', $idEmpleado)->get();
        return view('laboratorio.asignacion-insumos.create', compact('misInsumos'));
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
        $asignacion = [];
        
        return view('laboratorio.asignacion-insumos.create', compact('asignacion'));
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
