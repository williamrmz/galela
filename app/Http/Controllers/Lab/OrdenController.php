<?php

namespace App\Http\Controllers\Lab;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\LabMovimiento;
use App\Model\LabMovimientoLaboratorio as MovLaboratorio;
use App\Model\LabMovimientoCPT as MovimientoCPT;
use App\Model\LabItemsCpt as ItemCPT;
use App\Model\LabResultadoPorItems as Resultado;
use App\Model\WLabConsumoInsumos as ConsumoInsumos;
use DB;

class OrdenController extends Controller
{
    public function index(Request $request)
    {
        $query = \DB::table('v_ordenes')->where('idPuntoCarga', 2);// patologia clinica
        if( trim($request->filtro) != null) $query->where('filtro', 'LIKE', "%$request->filtro%");
        $labOrdenes = $query->orderBy('idMovimiento', 'desc')->paginate(10);
        return view('lab.patologia-clinica.ordenes.index', compact('labOrdenes'));
    }

    public function detalle($idMovimiento)
    {
        $movLab = MovLaboratorio::where('IdMovimiento', $idMovimiento)->get()->first();
        return view('lab.patologia-clinica.ordenes.detalle', compact('movLab'));
    }

    public function resultados($idMovimiento, $idProductoCPT)
    {
        
        $movLab = MovLaboratorio::where('IdMovimiento', $idMovimiento)->get()->first();

        $movCPT = MovimientoCPT::where('idMovimiento', $idMovimiento)
            ->where('idProductoCPT', $idProductoCPT)->get()->first();
        
        $user = \Auth::user();

        

        //verificar si el usuario esta asignado al area de la prueba;
        try {
            $grupoExamen = $movCPT->servicio->grupoExamen;
            if($grupoExamen !=null){
                if ( isset($grupoExamen->NombreGrupo) && $grupoExamen !=null ){
                    $nombreGrupo = $grupoExamen->NombreGrupo;
                    $cargo = $user->empleado->cargos->where('idTipoCargo', $grupoExamen->idCargo);
                    if( $cargo->count() != 1 ){
                        return back()->with('error', "El usuario no esta asignado al area de <b>$nombreGrupo</b>");
                    }
                }
            }else{
                return back()->with('error', "La prueba seleccionada no tiene diseño web");
            }
            
            // dd($grupoExamen);
        } catch (\Exception $e) {
            return back()->with('error', $e->getMessage());
        }


        $itemsData = ItemCPT::formItems($idMovimiento, $idProductoCPT);

        $responsable = MovimientoCPT::responsable($movLab->IdOrden, $idProductoCPT);

        if(!$responsable) $responsable = $user->empleado;

        return view('lab.patologia-clinica.ordenes.resultados', 
            compact('movLab', 'movCPT', 'itemsData', 'responsable', 'user'));
    }

    public function actualizaResultados(Request $request)
    {
        $idOrden = $request->idOrden; 
        $idProductoCpt = $request->idProductoCpt; 
        $fechaRegistro = dateFormat($request->fechaRegistro, 'd-m-Y');
        $insumos = $request->IdInsumos;
        $guardarInsumos = $request->guardarInsumos;
        unset(
            $request['idOrden'], $request['idProductoCpt'], 
            $request['fechaRegistro'], $request['_token'],
            $request['IdInsumos'], $request['guardarInsumos']
        );

        //verifica si la prueba ya tiene un responable
        $user = \Auth::user();
        $idUsuario = $user->id;
        $idResponsable = $user->id;
        $responsable = MovimientoCPT::responsable($idOrden, $idProductoCpt);
        if($responsable){
            $idResponsable = $responsable->IdEmpleado;
        }

        $resultados = [];
        $items = $request->all();
        foreach($items as $key => $item)
        {
            $antibiograma = '';

            if( isset($item['idItem']))
            {
                if($item['idItem'] == 98 && isset($item['check']) ){
                    // dd($item);
                    if($item['check']==1){
                        $antibiograma = isset($item['antibiograma'])? $item['antibiograma']: '[]';
                    }
                }
            }

            $oxr = explode('-',$key);
            $resultados[] = [
                'ordenXresultado' => isset($oxr[1])?$oxr[1]:0,
                'ValorTexto' => isset($item['texto'])? $item['texto'] :null,
                'ValorNumero' => isset($item['numero'])? $item['numero'] :null,
                'ValorCheck' => isset($item['check'])? $item['check'] :null,
                'ValorCombo' => isset($item['combo'])? $item['combo'] :null,
                'realizaAnalisis' => $idResponsable,
                'idUsuario' => $idUsuario,
                'Fecha' => "$fechaRegistro",
                'idProductoCpt' => $idProductoCpt,
                'idOrden' => $idOrden,
                'antibiograma' => $antibiograma,
                'pendiente' => isset($item['pendiente'])? $item['pendiente']: null,
            ];

        }
        

        foreach($resultados as $key => $resultado)
        {
           if($resultado['pendiente']==1){
               $resultados[$key]['ValorTexto'] = null;
               $resultados[$key]['ValorNumero'] = null;
               $resultados[$key]['ValorCheck'] = null;
               $resultados[$key]['ValorCombo'] = null;
               $resultados[$key]['antibiograma'] = null;
           }
        }

        

        DB::beginTransaction();
        try {

            Resultado::where('idOrden', $idOrden)->where('idProductoCpt', $idProductoCpt)->delete();
            Resultado::insert($resultados);

            if($guardarInsumos){
                // dd($insumos);
                $this->actualizaInsumos($idOrden, $idProductoCpt, $user,  $insumos);
            }
            
            DB::commit();
            return back()->with('success', 'Informacion actualizada');
        } catch (\Exception $e) {
            DB::rollback();
            return back()->with('error', $e->getMessage());
        }
    }

    private function actualizaInsumos($idOrden, $idProductoCpt, $user,  $data=[])
    {
        $insumos = [];
        $fecha = date('d-m-Y H:i:s');
        if($data) {
            foreach($data as $idInsumo => $cantidad){
                if($cantidad) {
                    $insumos[] = [
                        'IdOrden' => $idOrden,
                        'IdProductoCpt' => $idProductoCpt,
                        'IdInsumo' => $idInsumo,
                        'Cantidad' =>  $cantidad,
                        'IdEmpleado' => $user->id,
                        'Fecha' => $fecha,
                    ];
                }
            }
        }

        DB::table('WLabConsumoInsumos')->where('IdOrden', $idOrden)
            ->where('IdProductoCpt', $idProductoCpt)
            ->where('IdEmpleado', $user->id)
            ->delete();
        DB::table('WLabConsumoInsumos')->insert($insumos);
    }

    public function create()
    {
        return view('lab.patologia-clinica.ordenes.create');
    }
    public function store(Request $request)
    {
        // 1. ValidarDatosObligatorios()
        // 2. CargarDatosAlObjetoDeDatos
        // 3. ValidarReglas()
        // 4. AgregarDatos()


    //     If ValidarDatosObligatorios() Then
    //     CargaDatosAlObjetosDeDatos
    //     If ValidarReglas() Then
    //       If AgregarDatos() Then
    //         Me.txtNmovimiento = oDOLabMovimiento.IdMovimiento
    //         'ImprimeExamenesLab True  'JR 2106
    //         MsgBox "Se agregó correctamente el Movimiento N° " & oDOLabMovimiento.IdMovimiento, vbInformation, Me.Caption
    //         LimpiarFormulario
    //         Me.Visible = False  'JR 2106
    //       Else
    //         MsgBox "No se pudo agregar la Órden de Laboratorio" & Chr(13) & ms_MensajeError, vbExclamation, Me.Caption
    //       End If
    //     End If
    //   End If
    }

    public function imprimir(Request $request)
    {
        $idOrden = $request->idOrden;
        return view('lab.patologia-clinica.ordenes.imprimir', compact('idOrden'));
    }

    public function previa(Request $request)
    {
        $idOrden = $request->idOrden;
        return view('lab.patologia-clinica.ordenes.previa', compact('idOrden'));
    }


    //METODOS PARA EL REGISTRO DE ORDENES
    public function ValidarDatosObligatorios($request)
    {
        $request->validator([
            'pacienteTipo' => 'required',
            'cuenta' => 'required_if:pacienteTipo,1',
            'cuenta' => 'required_if:pacienteTipo,1',

            'paciente.apellidoPaterno' => "required_if:datosDeCuenta,''",
            'paciente.apellidoMaterno' => "required_if:datosDeCuenta,''",
            'paciente.primerNombre' => "required_if:datosDeCuenta,''",

            'responsable' => 'required',
            'medico' => 'required',
        ]);
    }
}
