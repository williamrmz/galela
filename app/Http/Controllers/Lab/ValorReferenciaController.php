<?php

namespace App\Http\Controllers\Lab;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\LabItems as Item;
use App\Model\ValoresReferencia as ValorRef;

class ValorReferenciaController extends Controller
{
    const PATH_VIEW = 'lab.patologia-clinica.items.';

    public function index(Request $request)
    {
        if(request()->ajax()) {
            $refs = ValorRef::where('id_item', $request->id_item)->whereNull('date_deleted')->get();
            return view(self::PATH_VIEW.'partials.refs.tabla-refs', compact('refs'));
        }
    }

    public function create()
    {
        if(request()->ajax()) {
            return view(self::PATH_VIEW.'partials.refs.form-create');
        }
    }

    public function store(Request $request)
    {
        if(request()->ajax()) {
            $this->validate($request, [
                'id_item' => 'required',
                'valor_tipo' => 'required',
                'sexo_id' => 'required',
                'edad_min' => 'required|integer',
                'edad_max' => 'required|integer',
                'edad_unidad' => 'required',
                'valor_min' =>'required_if:valor_tipo,N',
                'valor_max' =>'required_if:valor_tipo,N',
                'valor_txt' =>'required_if:valor_tipo,T',
                'alerta_txt' =>'required_if:valor_tipo,T',
            ]);

            $ref = new ValorRef;
            $ref->id_valor = nextId('ValoresReferencia', 'id_valor');
            $ref->id_item = $request->id_item;
            $ref->valor_tipo = $request->valor_tipo;
            $ref->sexo_id = $request->sexo_id;
            $ref->edad_min = $request->edad_min;
            $ref->edad_max = $request->edad_max;
            $ref->edad_unidad = $request->edad_unidad;
            $ref->valor_min = ($request->valor_tipo=='N')? $request->valor_min: null;
            $ref->valor_max = ($request->valor_tipo=='N')? $request->valor_max: null;
            $ref->valor_unidad = ($request->valor_tipo=='N')? $request->valor_unidad: null;
            $ref->alerta_inf = ($request->valor_tipo=='N')? $request->alerta_inf: null;
            $ref->alerta_sup = ($request->valor_tipo=='N')? $request->alerta_sup: null;
            $ref->valor_txt = ($request->valor_tipo=='T')? $request->valor_txt: null;
            $ref->alerta_txt = ($request->valor_tipo=='T')? $request->alerta_txt: null;
            $ref->date_created = date('d-m-Y');
            $saved = $ref->save();
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
            $ref = ValorRef::findOrFail($id);
            return view(self::PATH_VIEW.'partials.refs.form-edit', compact('ref'));
        }
    }

    public function update(Request $request, $id)
    {
        if(request()->ajax()) {
            $this->validate($request, [
                'id_item' => 'required',
                'valor_tipo' => 'required',
                'sexo_id' => 'required',
                'edad_min' => 'required|integer',
                'edad_max' => 'required|integer',
                'edad_unidad' => 'required',
                'valor_min' =>'required_if:valor_tipo,N',
                'valor_max' =>'required_if:valor_tipo,N',
                'valor_txt' =>'required_if:valor_tipo,T',
                'alerta_txt' =>'required_if:valor_tipo,T',
            ]);

            $ref = ValorRef::find($id);
            // $ref->id_valor = nextId('ValoresReferencia', 'id_valor');
            // $ref->id_item = $request->id_item;
            $ref->valor_tipo = $request->valor_tipo;
            $ref->sexo_id = $request->sexo_id;
            $ref->edad_min = $request->edad_min;
            $ref->edad_max = $request->edad_max;
            $ref->edad_unidad = $request->edad_unidad;
            $ref->valor_min = ($request->valor_tipo=='N')? $request->valor_min: null;
            $ref->valor_max = ($request->valor_tipo=='N')? $request->valor_max: null;
            $ref->valor_unidad = ($request->valor_tipo=='N')? $request->valor_unidad: null;
            $ref->alerta_inf = ($request->valor_tipo=='N')? $request->alerta_inf: null;
            $ref->alerta_sup = ($request->valor_tipo=='N')? $request->alerta_sup: null;
            $ref->valor_txt = ($request->valor_tipo=='T')? $request->valor_txt: null;
            $ref->alerta_txt = ($request->valor_tipo=='T')? $request->alerta_txt: null;
            // $ref->date_created = date('d-m-Y');
            $saved = $ref->save();
            return ['success' => $saved];
        }
    }

    public function delete($id)
    {
        if(request()->ajax()) {
            $ref = ValorRef::findOrFail($id);
            return view(self::PATH_VIEW.'partials.refs.form-delete', compact('ref'));
        }
    }

    public function destroy($id)
    {
        if(request()->ajax()) {
            $ref = ValorRef::findOrFail($id);
            $ref->date_deleted = date('d-m-Y');
            $saved = $ref->save();

            return ['success' => $saved];
        }
    }
}
