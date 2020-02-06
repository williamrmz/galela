<?php

namespace App\Http\Controllers;

use App\VB\SIGHDatos\Parametros;
use Illuminate\Http\Request;

class ParametroController extends Controller
{
    public function getParametroById($id)
    {
        return Parametros::find($id);
    }

    public function getParametroByCodigo($codigo)
    {
        return Parametros::where("Codigo", $codigo)->first();
    }
}
