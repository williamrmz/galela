<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\FactCatalogoBienesInsumos as BienInsumo;
use App\Model\LabInsumosCpt as InsumoCpt;
use App\Model\LabItems as Item;
use App\Model\WebGermenes as Germen;
use App\Model\WebAntibioticos as Antibiotico;
use DB;

use App\VB\SIGHNegocios\ReglasComunes;
use App\VB\SIGHNegocios\ReglasServiciosHosp;
Use App\VB\SIGHComun\DOEmpleado;
use App\VB\SIGHEntidades\Enumerados;
Use App\VB\SIGHComun\DOServicio;


class ControlesController extends Controller
{
    private $mo_AdminServiciosComunes;

    public function __construct()
    {
        $this->mo_AdminServiciosComunes = new ReglasComunes;
        $this->mo_AdminServiciosHosp = new ReglasServiciosHosp;
    }

    public function index(Request $request)
    {
        
        switch ($request->service)
        {
            case 'buscarEmpleados': return $this->buscarEmpleados($request);

            case 'buscarServicios': return $this->buscarServicios($request);

            default; return null;
        }
    }

    private function buscarEmpleados( $request )
    {
        // $data = DB::table('Empleados')->get();
        $oDOEmpleado = new DOEmpleado;
        $oDOEmpleado->apellidoPaterno = '';
        $oDOEmpleado->apellidoMaterno = '';
        $oDOEmpleado->nombres = '';
        $oDOEmpleado->codigoPlanilla = '';
        $data = $this->mo_AdminServiciosComunes->EmpleadosFiltrar($oDOEmpleado);
        // dd($data);
        return view('controles.buscarEmpleados', compact('data') );
    }

    private function buscarServicios( $request )
    {
        $oServicio = new DOServicio;
        $oServicio->codigo = 0;
        $oServicio->nombre = '';
        $oServicio->idTipoServicio = 0;
        $data = $this->mo_AdminServiciosHosp->ServiciosFiltrar($oServicio, 0, Enumerados::param('sghFiltraSoloActivos'));
        return view('controles.buscarServicios', compact('data') );
    }


}
