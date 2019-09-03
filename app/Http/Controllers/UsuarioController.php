<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Model\Empleados;
use DB;
use Com;

class UsuarioController extends Controller
{
    public function profile()
    {
        $user = \Auth::user()->empleado;

        return view('usuarios.profile', compact('user'));
    }

}
