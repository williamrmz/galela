<?php

namespace App\Http\Controllers\Lab;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\WebGermenes as Germen;

class GermenController extends Controller
{
    const PATH_VIEW = 'laboratorio.patologia-clinica.config-antibiograma.';

    public function index(Request $request)
    {
        if(request()->ajax()) {
            $germenes = Germen::whereNull('date_deleted')
                ->filtro($request->filtro)                
                ->orderBy('id', 'desc')->paginate(3);
            return view(self::PATH_VIEW.'germenes.tabla-germenes', compact('germenes'));
        }
    }

    public function create()
    {
        if(request()->ajax()) {
            return view(self::PATH_VIEW.'germenes.form-create');
        }
    }

    public function store(Request $request)
    {
        if(request()->ajax()) {
            $this->validate($request, [
                'nombre' => 'required',
            ]);

            $germen = new Germen;
            $germen->nombre = $request->nombre;
            $germen->date_created = date('d-m-Y');
            $saved = $germen->save();
            return ['success' => $saved];
        }
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        if(request()->ajax()) {
            $germen = Germen::findOrFail($id);
            return view(self::PATH_VIEW.'germenes.form-edit', compact('germen'));
        }
    }

    public function update(Request $request, $id)
    {
        if(request()->ajax()) {
            $this->validate($request, [
                'nombre' => 'required',
            ]);

            $germen = Germen::find($id);
            $germen->nombre = $request->nombre;
            $saved = $germen->save();
            return ['success' => $saved];
        }
    }

    public function delete($id)
    {
        if(request()->ajax()) {
            $germen = Germen::findOrFail($id);
            return view(self::PATH_VIEW.'germenes.form-delete', compact('germen'));
        }
    }

    public function destroy($id)
    {
        if(request()->ajax()) {
            $germen = Germen::findOrFail($id);
            $germen->date_deleted = date('d-m-Y');
            $saved = $germen->save();
            return ['success' => $saved];
        }
    }
}
