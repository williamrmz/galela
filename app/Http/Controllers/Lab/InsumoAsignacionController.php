<?php

namespace App\Http\Controllers\Lab;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;
use App\Model\Empleados as Empleado;
use App\Model\FactCatalogoBienesInsumos as BienInsumo;
use App\Visual\Tool;
use App\Visual\FarmMovimiento;
use App\Visual\FarmMovimientoNotaIngreso;
use App\Visual\SIGHEntidades\SighEstadoTabla;
use DB;

class InsumoAsignacionController extends Controller
{
    const PATH_VIEW = 'lab.insumos.asignaciones.';

    public function index(Request $request)
    {
        $fechas = explode('-', $request->rangoFecha);
        $desdeFecha = null;
        $hastaFecha = null;
        $movNumero = str_replace(' ', '', $request->movNum);
        $empleado = str_replace(' ', '', $request->empleado);
        $dni = str_replace(' ', '', $request->dni);

        if(count($fechas)==2){
            $desdeFecha = trim($fechas[0]);
            $hastaFecha = trim($fechas[1]);
            $desdeFecha = \DateTime::createFromFormat('d/m/Y H:i', $desdeFecha)->format('d/m/Y H:i:00');
            $hastaFecha = \DateTime::createFromFormat('d/m/Y H:i', $hastaFecha)->format('d/m/Y H:i:59');
        }

        $filtro = [
            'rangoFechas' => $fechas,
            'desdeFecha' => $desdeFecha,
            'hastaFecha' => $hastaFecha,
        ];
        // dd($filtro);

        $query = DB::table('farmMovimientoDetalle as md')
            ->leftJoin('farmMovimiento as m', 'm.MovNumero', 'md.MovNumero')
            ->leftJoin('FactCatalogoBienesInsumos as bi', 'bi.IdProducto', 'md.idProducto')
            ->leftJoin('Empleados as e', DB::raw('try_parse(e.DNI AS INT)'), DB::raw('try_parse(m.Observaciones AS INT)') )
            ->where('m.idAlmacenDestino', 13)->where('m.MovTipo', 'E')
            ->select(
                'e.IdEmpleado', 'e.Nombres', 'e.ApellidoPaterno', 'e.ApellidoMaterno', 'e.DNI'
                ,'m.fechaCreacion', 'm.Observaciones'
                ,'md.idProducto as IdProductoInsumo', 'bi.Nombre as NombreProductoInsumo', 'bi.Codigo as CodigoProductoInsumo'
                ,'md.MovNumero', 'md.MovTipo', 'md.Cantidad'
            );

        if($desdeFecha && $hastaFecha) {
            $query->where('m.fechaCreacion', '>=', $desdeFecha);
            $query->where('m.fechaCreacion', '<=', $hastaFecha);
        }

        if($movNumero != null){
            $query->where('md.MovNumero', $movNumero);
        }

        if($empleado != null){
            $numeric = 1;
            try{
                $numeric = (int) $empleado;
            }catch(\Exception $e) { };

            if($numeric){
               $query->whereRaw("REPLACE(e.DNI, ' ', '') LIKE '%$empleado%'");
            }else{
                $query->whereRaw("REPLACE(e.Nombres+e.ApellidoPaterno+e.ApellidoMaterno, ' ', '') LIKE '%$empleado%'");
            }
        }

        $data = $query->orderBy('m.fechaCreacion', 'desc')->get();

        // dd($data);

        $entradas = [];
        foreach($data as $row){
            $movNumero = $row->MovNumero;
            $entradas[$movNumero]['MovNumero'] = $movNumero;
            $entradas[$movNumero]['MovTipo'] = $row->MovTipo;
            $entradas[$movNumero]['Fecha'] = dateFormat($row->fechaCreacion, 'd/m/Y H:i');
            $entradas[$movNumero]['DNI'] = $row->DNI;
            $entradas[$movNumero]['IdEmpleado'] = $row->IdEmpleado;
            $entradas[$movNumero]['FullnameEmpleado'] = $row->Nombres.' '.$row->ApellidoPaterno.' '.$row->ApellidoMaterno;
            $entradas[$movNumero]['Insumos'][] = [
                'Id' => $row->IdProductoInsumo,
                'Codigo' => $row->CodigoProductoInsumo,
                'Nombre' => $row->NombreProductoInsumo,
                'Cantidad' => $row->Cantidad
            ];
        }
        $entradas = json_decode(json_encode($entradas));
        // dd($entradas);

        return view(self::PATH_VIEW.'index', compact('entradas'));
    }

    public function create()
    {
        $responsable = FarmMovimiento::labResponsableActual();

        $productos = FarmMovimiento::getStockLabResponsable();

        $numDocumento = FarmMovimiento::nextNumDocNsParaAlmacen();

        return view(self::PATH_VIEW.'create', compact('responsable','productos', 'numDocumento'));
    }

    private function mover($numDocumento, $idAlmacenOrigen, $idAlmacenDestino, $fecha,  $dni, $userId, $productos, $referencia)
    {
        $farmMovimiento = new FarmMovimiento;
        $farmMovimiento->DocumentoIdtipo = 3; //GUIA REMISION
        $farmMovimiento->DocumentoNumero = $numDocumento;
        $farmMovimiento->fechaCreacion = $fecha;
        $farmMovimiento->idAlmacenDestino = $idAlmacenDestino;
        $farmMovimiento->idAlmacenOrigen = $idAlmacenOrigen;
        $farmMovimiento->idEstadoMovimiento = SighEstadoTabla::PARAMS['sghEstadoTabla']['sghRegistrado'];
        $farmMovimiento->idTipoConcepto = FarmMovimiento::CONCEPTO_DISTRIBUCION;
        $farmMovimiento->idUsuario = $userId;
        $farmMovimiento->MovTipo = FarmMovimiento::MOV_SALIDA;
        $farmMovimiento->Observaciones = $dni;
        $farmMovimiento->Total = FarmMovimiento::calcula_total($productos);
        // dd($productos);
        Tool::AgregaDatosDeNotaSalida($farmMovimiento, $productos, FarmMovimiento::ID_LIST_ITEM_NS);
        // dd($farmMovimiento); //LISTO PARA INSERTAR EN BASE DE DATOS

        //Genera Nota de ingreso automatico
        // dd($farmMovimiento);
        $proveedores = null;

        $farmMovimientoI = new FarmMovimiento;
        $farmMovimientoI->DocumentoIdtipo = $farmMovimiento->DocumentoIdtipo;
        $farmMovimientoI->DocumentoNumero = $farmMovimiento->DocumentoNumero;
        $farmMovimientoI->fechaCreacion = dateFormat($farmMovimiento->fechaCreacion, 'd-m-Y H:i:s');
        $farmMovimientoI->idAlmacenDestino = $farmMovimiento->idAlmacenDestino;
        $farmMovimientoI->idAlmacenOrigen = $farmMovimiento->idAlmacenOrigen;
        $farmMovimientoI->idEstadoMovimiento = $farmMovimiento->idEstadoMovimiento;
        $farmMovimientoI->idTipoConcepto = FarmMovimiento::CONCEPTO_DISTRIBUCION;
        $farmMovimientoI->idUsuario = $farmMovimiento->idUsuario;
        $farmMovimientoI->MovTipo = FarmMovimiento::MOV_ENTRADA;
        $farmMovimientoI->Observaciones = $farmMovimiento->Observaciones;
        $farmMovimientoI->Total = $farmMovimiento->Total;

        // dd($farmMovimientoI);
        $farmMovimientoNotaIngreso = new FarmMovimientoNotaIngreso;
        $farmMovimientoNotaIngreso->MovTipo = 'E';
        $farmMovimientoNotaIngreso->DocumentoFechaRecepcion = $farmMovimientoI->fechaCreacion;

        if($referencia){
            //consultar ultima nota de ingreso en LAB RESPONSABLE
            $origenNumero = null;
            $lasMovR = FarmMovimiento::lastNiEnResponsable();
            if($lasMovR){
                $origenNumero = $lasMovR->MovNumero;
            }

            $farmMovimientoNotaIngreso->OrigenNumero = $origenNumero;
        }
        // dd($farmMovimientoNotaIngreso);
        // Agrega nota de salida automatica en el almacen de destino
        Tool::AgregaDatosDeNotaIngreso($farmMovimientoI, $farmMovimientoNotaIngreso, $proveedores, $productos, 0, FarmMovimiento::ID_LIST_ITEM_NI);


        // Descontar stock de LAB-RESPONSABLE por uso de insumos en pruebas de laboratorio
        $farmMovimientoU = new FarmMovimiento;
        $farmMovimientoU->DocumentoIdtipo = 10;
        $farmMovimientoU->DocumentoNumero = $farmMovimiento->DocumentoNumero;
        $farmMovimientoU->fechaCreacion = dateFormat($farmMovimiento->fechaCreacion, 'd-m-Y H:i:s');
        $farmMovimientoU->idAlmacenDestino = 0;
        $farmMovimientoU->idAlmacenOrigen = $farmMovimiento->idAlmacenOrigen;
        $farmMovimientoU->idEstadoMovimiento = $farmMovimiento->idEstadoMovimiento;
        $farmMovimientoU->idTipoConcepto = FarmMovimiento::CONCEPTO_AJUSTE_INVENTARIO; //AJUSTE AL INVENTARIO
        $farmMovimientoU->idUsuario = $farmMovimiento->idUsuario;
        $farmMovimientoU->MovTipo = FarmMovimiento::MOV_SALIDA;
        $farmMovimientoU->Observaciones = $farmMovimiento->Observaciones;
        $farmMovimientoU->Total = $farmMovimiento->Total;

        // $productos = $productos = FarmMovimiento::getStockLabResponsable();

        // dd($productos);
        // dd('aki');
        $productos = FarmMovimiento::setProductosUsados( $productos );
        Tool::AgregaDatosDeNotaSalida($farmMovimientoU, $productos, FarmMovimiento::ID_LIST_ITEM_NS);
        // dd($farmMovimientoU);
    }


    private function bloquearConosumosLab($fecha){
        $data = DB::table('WLabConsumoInsumos')->whereNull('FechaCierreStock')
            ->update(['FechaCierreStock' => $fecha]);
        return $data;
    }

    private function validarForm($request)
    {
        $status = true;

        $validator = Validator::make($request->all(), [
            'numDoc' => 'required',
            'almacenId' => 'required',
            'IdResponsable' => 'required_if:almacenId,13',
            'productos' => 'required',
        ], [
            'numDoc.required' => 'Ingrese el numero de documento',
            'almacenId.required' => 'Seleccione almacen de destino',
            'IdResponsable.required_if' => 'Seleccione un responsable',
            'productos.required' => 'Seleccione al menos un producto',
        ]);

        $message = "<ul>";
            
        if ($validator->fails()) {
            $status = false;
            $errors = $validator->errors();
            foreach ( $errors->all() as $error ) {
                $message .= "<li>$error</li>";
            }
        }
        $message .= "</ul>";
        $response['status'] = $status;
        $response['message'] = $message;
        return $response;
    }   

    private function validarCantidades($productos)
    {
        $status = true;
        $message = '<ul>';
        foreach($productos as $producto){
            if($producto['cantEnviar'] < 0){
                $status = false;
                $message .= '<li>Las cantidades a enviar deben ser mayor o igual a cero</li>';
            }
            if($producto['cantConsumida'] < 0){
                $status = false;
                $message .= '<li>Las cantidades consumidas deben ser mayor o igual a cero.</li>';
            }
            if( !$status ) break;
        }
        $message .= '</ul>';

        $response = [];
        $response['status'] = $status;
        $response['message'] = $message;
        return $response;
    }

    private function validarResponsable($usuario)
    {
        $responsable = FarmMovimiento::labResponsableActual();

        $status = false;
        
        if( $responsable ){
            if( $responsable->IdEmpleado == $usuario->id_empleado){
                $status = true;
            }
        }
        
        $message = "<ul>";
        if(!$status){
            $message .= "<li>Solamente el responsable puede realizar esta operacion</li>";
        }
        $message .= "</ul>";

        $response['status'] = $status;
        $response['message'] = $message;
        return $response;
    }

    public function store(Request $request)
    {
        $user = \Auth::user();
        $response = $this->validarForm($request);
        if (!$response['status']) return $response;

        $response = $this->validarCantidades($request->productos);
        if (!$response['status']) return $response;

        $response = $this->validarResponsable($user);
        if (!$response['status']) return $response;
        

        

        $idAlmacenOrigen = FarmMovimiento::LAB_RESPONSABLE;
        $idAlmacenDestino = FarmMovimiento::LAB_ALMACEN;

        $dni = trim($user->empleado->DNI);
        $userId = $user->id;
        $numDocumento = $request->numDoc;

        $productos = [];
        $productos = $this->getProductos($request->productos, 'cantEnviar');

        // dd($productos);
        $response = [];
        DB::beginTransaction();

        try {
            $fecha = date('d-m-Y H:i:s');
            $this->mover($numDocumento, $idAlmacenOrigen, $idAlmacenDestino, $fecha, $dni, $userId, $productos, true);

            if($request->almacenId == 13)
            {
                $fecha = date('d-m-Y H:i:s');
                $empleado = Empleado::find($request->IdResponsable);
                $dni = trim($empleado->DNI);
                $this->mover($numDocumento, $idAlmacenDestino, $idAlmacenOrigen, $fecha, $dni, $userId, $productos, false);
            }

            $this->bloquearConosumosLab($fecha);

            DB::commit();

            $response['status'] = true;
            $response['message'] = 'Transaccion OK!';
        } catch (\Exception $e) {
            DB::rollback();
            // dd($e->errors());
            $response['status'] = false;
            $response['message'] = $e->getMessage();
            // $message = var_dump($e.getMessage());
            // dd($response);
            // return back()->with('error', $e->getMessage());
        }


        return $response;

    }


    public function getProductos($data, $context)
    {
        $productos = [];
        foreach($data as $row){
            $productos[] = [
                'model' => $row['model'],
                'codigo' => $row['codigo'],
                'saldo' => $row['saldo'],
                'cantidad' => $row[$context],
                'precio' => $row['precio'],
                'total' => $row['precio'] * $row[$context]
            ];
        }
        return $productos;
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


    //PARTIALS
    public function partialResponsables(Request $request)
    {
        if(request()->ajax()){

            $filtro = str_replace(' ', '', $request->buscar);

            $query = Empleado::select('IdEmpleado', 'DNI', 'Nombres', 'ApellidoPaterno', 'ApellidoMaterno');

            if($filtro != null){
                $query = Empleado::whereRaw("DNI LIKE '%$filtro%'")
                    ->orWhereRaw("REPLACE(Nombres+ApellidoPaterno+ApellidoMaterno, ' ', '') LIKE '%$filtro%'");
            }
            $responsables = $query->paginate(10);


            return view(self::PATH_VIEW.'partials.list-responsables', compact('responsables'));
        }
    }

    public function partialModalConsumos()
    {
        if(request()->ajax()) {
            return view(self::PATH_VIEW.'partials.modal-consumos');
        }
    }

    public function partialTbodyConsumos(Request $request)
    {
        if(request()->ajax()) {
            $codigos = $request->codigos;
            $desde = '22-07-2019';
            $hasta = '24-07-2019';


            $fechas = explode('-', $request->rangoFecha);
            $desde = null;
            $hasta = null;
            if(count($fechas)==2){
                $desde = trim($fechas[0]);
                $hasta = trim($fechas[1]);
                $desde = \DateTime::createFromFormat('d/m/Y H:i', $desde)->format('d/m/Y H:i:00');
                $hasta = \DateTime::createFromFormat('d/m/Y H:i', $hasta)->format('d/m/Y H:i:00');
            }

            $data = [];
            if(isset($codigos[0]) && $desde && $hasta){
                $data = DB::table('FactCatalogoBienesInsumos as bi')
                ->leftJoin('LabInsumosCpt as i', 'i.IdProductoInsumo', 'bi.IdProducto')
                ->leftJoin('WLabConsumoInsumos as c', 'i.IdInsumo', 'c.IdInsumo')
                ->whereNull('i.DeletedAt')
                ->whereNull('c.FechaCierreStock')
                ->whereIn('bi.Codigo', $codigos)
                ->where('c.Fecha', '>=', $desde)
                ->where('c.Fecha', '<=', $hasta)
                ->select('bi.codigo', 'bi.nombre', DB::raw('SUM( ISNULL(c.cantidad, 0)) AS cantidad'))
                ->groupBy('bi.Codigo', 'bi.Nombre')
                ->get();
            }   
            // return $data;
            return view(self::PATH_VIEW.'partials.tbody-consumos', compact('data'));
        }
    }
}
