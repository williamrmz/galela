<?php

namespace App\Http\Controllers\Lab;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Empleados as Empleado;
use Image;

class InsumoController extends Controller
{
    const PATH_VIEW = 'laboratorio.insumos.';

    public function index(Request $request)
    {
        return view(self::PATH_VIEW.'index');
    }

    public function create()
    {
        if($request->ajax()) {
            return view(self::PATH_VIEW.'partials.form-create', compact('list'));
        }
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
        if(request()->ajax()) {
            $item = Empleado::findOrFail($id);
            return view(self::PATH_VIEW.'partials.form-edit', compact('item'));
        }
    }

    public function update(Request $request, $id)
    {
        if(request()->ajax()) {

            $this->validate($request, [
                'firma' => 'required|image|mimes:jpeg,png,jpg,gif,svg',
            ]);

            $empleado = Empleado::findOrFail($id);

            $file = $request->file('firma');
            $extension = $file->getClientOriginalExtension();
            $filename = 'SIGN_' . $empleado->IdEmpleado . '.' . $extension;
            $path = public_path('storage/images/firmas/'.$filename);

            Image::make($file)->save($path);
            $empleado->firma = $filename;
            $saved = $empleado->save();
            
            $data['success'] = $saved;
            $data['path'] = $empleado->getPathFirma();
            return $data;
        }
    }

    public function delete($id)
    {
        if(request()->ajax()) {
            $item = Empleado::findOrFail($id);
            return view(self::PATH_VIEW.'partials.form-delete', compact('item'));
        }
    }

    public function destroy($id)
    {
        if(request()->ajax()) {
            $item = Empleado::find($id);
            $item->Firma = null;
            $saved = $item->save();
            return [ 'success' => $saved];
        }
    }
}
