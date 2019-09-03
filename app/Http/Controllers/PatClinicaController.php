<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\LabMovimiento;
use App\Model\LabMovimientoLaboratorio as MovLaboratorio;
use App\Model\LabMovimientoCPT as MovimientoCPT;
use App\Model\LabItemsCpt as ItemCPT;
use App\Model\LabResultadoPorItems as Resultado;

class PatClinicaController extends Controller
{
    public function index(Request $request)
    {
        return view('laboratorio.patologia-clinica.index');
    }
}
