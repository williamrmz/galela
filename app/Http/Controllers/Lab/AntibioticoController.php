<?php

namespace App\Http\Controllers\Lab;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\WebAntibioticos as Antibiotico;

class AntibioticoController extends Controller
{
    const PATH_VIEW = 'laboratorio.patologia-clinica.config-antibiograma.';

    public function index(Request $request)
    {
        if(request()->ajax()) {
            $antibioticos = Antibiotico::whereNull('date_deleted')
                ->filtro($request->filtro)                
                ->orderBy('id', 'desc')->paginate(10);
            return view(self::PATH_VIEW.'antibioticos.tabla-antibioticos', compact('antibioticos'));
        }
    }

    public function create()
    {
        if(request()->ajax()) {
            return view(self::PATH_VIEW.'antibioticos.form-create');
        }
    }

    public function store(Request $request)
    {
        if(request()->ajax()) {
            $this->validate($request, [
                'nombre' => 'required',
            ]);

            $antibiotico = new Antibiotico;
            $antibiotico->nombre = $request->nombre;
            $antibiotico->date_created = date('d-m-Y');
            $saved = $antibiotico->save();
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
            $antibiotico = Antibiotico::findOrFail($id);
            return view(self::PATH_VIEW.'antibioticos.form-edit', compact('antibiotico'));
        }
    }

    public function update(Request $request, $id)
    {
        if(request()->ajax()) {
            $this->validate($request, [
                'nombre' => 'required',
            ]);

            $antibiotico = Antibiotico::find($id);
            $antibiotico->nombre = $request->nombre;
            $saved = $antibiotico->save();
            return ['success' => $saved];
        }
    }

    public function delete($id)
    {
        if(request()->ajax()) {
            $antibiotico = Antibiotico::findOrFail($id);
            return view(self::PATH_VIEW.'antibioticos.form-delete', compact('antibiotico'));
        }
    }

    public function destroy($id)
    {
        if(request()->ajax()) {
            $antibiotico = Antibiotico::findOrFail($id);
            $antibiotico->date_deleted = date('d-m-Y');
            $saved = $antibiotico->save();
            return ['success' => $saved];
        }
    }
}
