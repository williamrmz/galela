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
use App\VB\SIGHNegocios\ReglasServGeograf;


class ControlesController extends Controller
{
    private $mo_AdminServiciosComunes;
    
    private $mo_AdminServiciosGeograficos;

    public function __construct()
    {
        $this->mo_AdminServiciosComunes = new ReglasComunes;
        $this->mo_AdminServiciosHosp = new ReglasServiciosHosp;
        $this->mo_AdminServiciosGeograficos = new ReglasServGeograf;
    }

    public function index(Request $request)
    {
        
        switch ($request->service)
        {
            case 'getDiagnosticosData': return $this->getDiagnosticosData( $request );

            case 'getEstablecimientosData': return $this->getEstablecimientosData( $request );

            case 'getDepartamentosData': return $this->getDepartamentosData( $request );

            case 'getProvinciasData': return $this->getProvinciasData( $request );

            case 'getDistritosData': return $this->getDistritosData( $request );

            case 'getCentrosPobladosData': return $this->getCentrosPobladosData( $request );

            case 'buscarEmpleados': return $this->buscarEmpleados($request);

            case 'buscarServicios': return $this->buscarServicios($request);

            default; return null;
        }
    }

    // Created by Romel Diaz  2019-09-04
    private function getDiagnosticosData( $request )
    {
        $lbSoloMuestraDxGalenHos = false;
        $lbUSAcodigoCIEsinPto = false;
        $mb_mostrarSoloActivos = true; // no tiene efecto en db v3.

        $query = DB::table('Diagnosticos');

        if( $lbUSAcodigoCIEsinPto == true){
            $query->where('codigoCIEsinPto', 'like', "$request->codigo%");
        }else{
            $query->where('CodigoCIE2004', 'like', "$request->codigo%");
        }

        if( $request->descripcion <> "" ) $query->where('Descripcion', 'like', "%$request->descripcion%");
        
        if( $lbSoloMuestraDxGalenHos = true)  $query->whereNotNull('DescripcionMINSA');

        $items = $query->select('IdDiagnostico', 'codigoCIEsinPto', 'Descripcion' ,'CodigoCIE10', 'CodigoCIE9', 'CodigoCIE2004')
            ->orderBy('Descripcion', 'asc')->orderBy('CodigoCIE2004', 'asc')
            ->paginate(10);

        return view('controles.tablas.buscar-diagnostico-tabla', compact('items'));

    }

    // Created by Romel Diaz  2019-09-04
    private function getEstablecimientosData( $request )
    {
        $oEstablecimiento  = new  \App\VB\SIGHComun\DOEstablecimiento;
        $oEstablecimiento->codigo = $request->codRenaes;
        $oEstablecimiento->nombre = $request->nombre;
        $oEstablecimiento->idDistrito = $request->idDistrito;
        $data = $this->mo_AdminServiciosComunes->EstablecimientosFiltrar($oEstablecimiento, $request->idDepartamento, $request->idProvincia);
        return $data;
    }


    // Created by Romel Diaz  2019-09-04
    private function getDepartamentosData( $request ) 
    {
        $data =  $this->mo_AdminServiciosGeograficos->DepartamentosSeleccionarTodos();
        foreach($data as $row){
            $row->text = $row->Nombre;
            $row->id = $row->IdDepartamento;
        }
        return $data;
    }

    // Created by Romel Diaz  2019-09-04
    private function getProvinciasData( $request ) 
    {
        $data =  $this->mo_AdminServiciosGeograficos->ProvinciasSeleccionarPorDepartamento( $request->idDepartamento );
        foreach($data as $row){
            $row->text = $row->Nombre;
            $row->id = $row->IdProvincia;
        }
        return $data;
    }

    // Created by Romel Diaz  2019-09-04
    private function getDistritosData( $request ) 
    {
        $data =  $this->mo_AdminServiciosGeograficos->DistritoSeleccionarPorProvincia( $request->idProvincia );
        foreach($data as $row){
            $row->text = $row->Nombre;
            $row->id = $row->IdDistrito;
        }
        return $data;
    }

    // Created by Romel Diaz  2019-09-11
    private function getCentrosPobladosData( $request ) 
    {
        $data =  $this->mo_AdminServiciosGeograficos->CentroPobladoSeleccionarPorDistrito( $request->idDistrito );
        foreach($data as $row){
            $row->text = $row->Nombre;
            $row->id = $row->IdCentroPoblado;
        }
        return $data;
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
