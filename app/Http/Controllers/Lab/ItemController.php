<?php

namespace App\Http\Controllers\Lab;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\LabItems as Item;

class ItemController extends Controller
{
    const PATH_VIEW = 'lab.patologia-clinica.items.';

    public function index(Request $request)
    {
        if($request->ajax()) {
            $list = Item::filtro($request->buscar)->orderBy('idItem', 'desc')->paginate(10);
            return view(self::PATH_VIEW.'partials.tabla-items', compact('list'));
        }

        return view(self::PATH_VIEW.'index');
    }

    public function create()
    {
        if(request()->ajax()) {
            return view(self::PATH_VIEW.'partials.form-create');
        }
    }

    public function store(Request $request)
    {
        if(request()->ajax()) {
            $this->validate($request, [
                'Item' => 'required',
            ]);

            $item = new Item;
            $item->idItem = nextId('LabItems', 'idItem');
            $item->Item = $request->Item;
            $saved = $item->save();
            return ['success' => $saved];
        }
    }

    public function show($id)
    {
        $item = Item::findOrFail($id);
        return view(self::PATH_VIEW.'show', compact('item'));
    }

    public function edit($id)
    {
        if(request()->ajax()) {
            $item = Item::findOrFail($id);
            return view(self::PATH_VIEW.'partials.form-edit', compact('item'));
        }
    }

    public function update(Request $request, $id)
    {
        if(request()->ajax()) {
            $this->validate($request, [
                'Item' => 'required',
            ]);

            $item = Item::find($id);
            $item->Item = $request->Item;
            $saved = $item->save();
            return ['success' => $saved];
        }
    }

    public function delete($id)
    {
        if(request()->ajax()) {
            $item = Item::find($id);
            return view(self::PATH_VIEW.'partials.form-delete', compact('item'));
        }
    }

    public function destroy($id)
    {
        if(request()->ajax()) {
            $item = Item::find($id);

            $servicios = $item->servicios;

            if( $servicios->count()  > 0 ){
                $message = 'No es posible eliminar esta item ya que se usa en los siguientes servicios: <ul>';
                foreach( $servicios as $servicio)
                { $message .= "<li title='$servicio->Nombre'>[$servicio->Codigo]</li>"; }
                $data['success'] = false;
                $data['message'] = $message;
            }else{
                $saved = $item->delete();
                $data['success'] = $saved;
            }

            return $data;
        }
    }
}
