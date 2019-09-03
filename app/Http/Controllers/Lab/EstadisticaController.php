<?php

namespace App\Http\Controllers\Lab;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class EstadisticaController extends Controller
{
    const PATH_VIEW = 'laboratorio.patologia-clinica.estadisticas.';

    public function index(Request $request)
    {
        $desde = date('Y-m-01');

        $hasta = date('Y-m-d');

        $tarifas = \DB::select("SELECT * FROM TiposFinanciamiento 
        WHERE SeIngresPrecios = 1 AND IdTipoFinanciamiento >0
        ORDER BY Descripcion DESC");

        $areas = \DB::select("SELECT * FROM labGrupos ORDER BY NombreGrupo");

        return view(self::PATH_VIEW.'index', compact('tarifas', 'areas', 'desde', 'hasta') );
    }

    public function print(Request $request)
    {
        $request->validate([
            'desde' => 'required|date',
            'hasta' => 'required|date',
            'tarifas_id' => 'required',
            'areas_id' => 'required',
        ], [
            'desde.required' => 'Ingrese fecha inicial',
            'hasta.required' => 'Indique fecha final',
            'tarifas_id.required' => 'Seleccione al menos una tarifa',
            'areas_id.required' => 'Seleccione al menos una area',
        ]);

        return view(self::PATH_VIEW.'print')->with([
            'desde' => $request->desde,
            'hasta' => $request->hasta,
            'tarifasId' => $request->tarifas_id,
            'areasId' => $request->areas_id,
        ]);
    }

    public function create()
    {

    }

    public function store(Request $request)
    {

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
