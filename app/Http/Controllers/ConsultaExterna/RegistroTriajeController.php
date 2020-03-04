<?php
namespace App\Http\Controllers\ConsultaExterna;

use App\Http\Requests\RegistroTriajeRequest;
use App\VB\SIGHComun\DOAtencionesCE;
use App\VB\SIGHDatos\AtencionesCE;
use App\VB\SIGHDatos\Servicios;
use App\VB\SIGHEntidades\Enumerados;
use App\VB\SIGHNegocios\ReglasAdmision;
use App\VB\SIGHNegocios\ReglasFacturacion;
use App\VB\SIGHNegocios\ReglasFarmacia;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use function PHPSTORM_META\type;

class RegistroTriajeController extends Controller
{
	const PATH_VIEW = 'consulta-externa.registro-triaje.';
	private $idListItem;

	public function __construct()
    {
        $this->idListItem = 1303;
    }

    public function index(Request $request)
	{
		if($request->ajax())
		{
		    $nroCuenta      = $request->ftxtNroCuenta ?? '';
		    $dni            = $request->ftxtDni ?? '';
		    $nroHistoria    = $request->ftxtNroHistoria ?? '';
		    $apePaterno     = $request->ftxtApellidoPaterno ?? '';
		    $apeMaterno     = $request->ftxtApellidoMaterno ?? '';
		    $fecTriaje      = $request->cmbFechaTriaje ?? '';
		    $fechaInicio    = ($fecTriaje!="")?$fecTriaje:"01-01-2000";
		    $fechaFin       = ($fecTriaje!="")?Carbon::now()->addDay()->format('d-m-Y'):date('d-m-Y');
            $items = ReglasAdmision::AtencionesCEFiltrarPorPaciente($nroHistoria, $apePaterno, $apeMaterno, $dni, $nroCuenta, $fecTriaje, $fechaInicio, $fechaFin);
			return view(self::PATH_VIEW.'partials.item-list', compact('items'));
		}
		return view(self::PATH_VIEW.'index');
	}

	public function show($id)
    {
        try
        {
            $oAtencion = AtencionesCE::find($id);
            $rpta = Array();
            $rpta["DatosCuenta"] = "";
            $rpta["DatosPlan"] = "";
            $rpta["DatosProcedencia"] = "";

            $oAtenciones = ReglasFarmacia::AtencionesSelecionarPorCuenta($oAtencion->idAtencion);
            if(count($oAtenciones)>0)
            {
                $oBusqueda = collect($oAtenciones)->first();
                // Construir Strings de información
                $rpta["DatosCuenta"]        = trim($oBusqueda->NroHistoriaClinica)." - ".trim($oBusqueda->ApellidoPaterno)." - ".trim($oBusqueda->ApellidoMaterno)." - ".trim($oBusqueda->PrimerNombre)." (Edad: ".trim($oBusqueda->Edad)." ".$oBusqueda->tedad.")";
                $rpta["DatosPlan"]          = "IAFA Act.: " . $oBusqueda->dFuenteFinanciamiento;
                $ultimoServicio             = ReglasFacturacion::BuscaServicioActualDelPaciente($oBusqueda->IdServicioIngreso);
                $fechaingreso = str_replace(" 00:00:00.000", "", $oBusqueda->FechaIngreso);
                $rpta["DatosProcedencia"]   = "F.Ing: ".Carbon::createFromFormat('Y-m-d', $fechaingreso)->format('d-m-Y')." - ".$oBusqueda->dTipoServicio. " - (Est: " . $oBusqueda->estadoCta . ") " . $ultimoServicio;
            }
            $rpta["atencion"] = $oAtencion;
            return imprimeJSON(true, "", $rpta);
        }
        catch (\Exception $e)
        {
            return imprimeJSON(false, $e->getMessage());
        }
    }

	public function store(RegistroTriajeRequest $request)
    {
        try
        {
            DB::beginTransaction();
            $this->validarReglas($request);
            $oAtencion = $this->fillFromRequest($request);
            $oAtencion->save();

            // Agregar auditoria
            AuditoriaAgregarVGood("A", $oAtencion->idAtencion, $oAtencion->getTable(), $this->idListItem, "IdAtencion: ".$oAtencion->idAtencion);

            DB::commit();
            return imprimeJSON(true, "Registrado correctamente");
        }
        catch (\Exception $e)
        {
            DB::rollBack();
            return imprimeJSON(false, $e->getMessage());
        }
    }

    public function update(RegistroTriajeRequest $request, $id)
    {
        try
        {
            DB::beginTransaction();
            $oAtencion = AtencionesCE::find($id);

            $this->getNroCuenta($oAtencion->idAtencion, "CONSULTAEXTERNA", "ACTUALIZAR");
            $this->validarReglas($request);
            $oAtencion = $this->fillFromRequest($request, $oAtencion);
            $oAtencion->save();

            // Agregar auditoria
            AuditoriaAgregarVGood("M", $oAtencion->idAtencion, $oAtencion->getTable(), $this->idListItem, "IdAtencion: ".$oAtencion->idAtencion);

            DB::commit();
            return imprimeJSON(true, "Registrado correctamente");
        }
        catch (\Exception $e)
        {
            DB::rollBack();
            return imprimeJSON(false, $e->getMessage());
        }
    }

    public function destroy($id)
    {
        try
        {
            DB::beginTransaction();
            $oAtencion = AtencionesCE::find($id);

            $this->getNroCuenta($oAtencion->idAtencion, "CONSULTAEXTERNA", "ELIMINAR");
            $oAtencion->delete();
            AuditoriaAgregarVGood("E", $oAtencion->idAtencion, $oAtencion->getTable(), $this->idListItem, "IdAtencion: ".$oAtencion->idAtencion);

            DB::commit();
            return imprimeJSON(true, "Los datos se eliminaron correctamente");
        }
        catch (\Exception $e)
        {
            DB::rollBack();
            return imprimeJSON(false, $e->getMessage());
        }
    }

    private function fillFromRequest($request, $tempTriaje = null)
    {
        $oAtencion = ($tempTriaje)?$tempTriaje:new AtencionesCE();
        $oAtencion->idAtencion = $request->txtNroCuenta;

        $consultarDatos = ReglasFarmacia::AtencionesSelecionarPorCuenta($oAtencion->idAtencion);
        if(count($consultarDatos)>0)
        {
            $oTemp = collect($consultarDatos)->first();
            $oAtencion->TriajeEdad = $oTemp->Edad;
            $oAtencion->NroHistoriaClinica = $oTemp->NroHistoriaClinica;
        }

        $oAtencion->TriajePresion = $request->txtPresionArterial;
        $oAtencion->TriajeTalla = $request->txtTalla;
        $oAtencion->TriajeTemperatura = $request->txtTemperatura;
        $oAtencion->TriajePeso = $request->txtPeso;
        $oAtencion->TriajePulso = $request->txtPulso;
        $oAtencion->TriajeFrecRespiratoria = $request->txtFreRespiratoria;
        if(!$tempTriaje)
        {
            $oAtencion->TriajeFecha = Carbon::now()->format("Y-m-d\TH:i:s");
            $oAtencion->TriajeIdUsuario = Auth::user()->id;
        }
        return $oAtencion;
    }


    private function validarReglas(Request $request)
    {
        $partesPresion = explode("/", $request->txtPresionArterial);
        if(count($partesPresion) != 2)
        {
            throw new \Exception("Si registra la PRESIÓN, debe ser en el siguiente formato SISTÓLICA/DIASTÓLICA. Recuerde que el valor de SISTÓLICA debe ser mayor a la de DIASTÓLICA");
        }

        $sistolica = $partesPresion[0];
        $diasstolica = $partesPresion[1];

        if($diasstolica>=$sistolica)
        {
            throw new \Exception("Si registra la PRESION: SISTOLICA/DIASTOLICA, el valor SISTOLICA debe ser mayor a la DIASTOLICA");
        }
    }

    public function getNroCuenta($numCuenta, $origen, $opcion = "AGREGAR")
    {
        $rpta = Array();
        $rpta["TriajeTalla"] = "";
        try
        {
            $oAtenciones = ReglasFarmacia::AtencionesSelecionarPorCuenta($numCuenta);
            if(count($oAtenciones)>0)
            {
                $oAtencion = collect($oAtenciones)->first();

                // :: Traer talla
                $nroHistoria = $oAtencion->NroHistoriaClinica;
                $tempReg = DOAtencionesCE::SeleccionarPorNroHistoria($nroHistoria);
                if(count($tempReg) > 0)
                {
                    $rpta["TriajeTalla"] = $tempReg[0]->TriajeTalla ?? "";
                }

                // Construir Strings de información
                $rpta["DatosCuenta"]        = trim($oAtencion->NroHistoriaClinica)." - ".trim($oAtencion->ApellidoPaterno)." - ".trim($oAtencion->ApellidoMaterno)." - ".trim($oAtencion->PrimerNombre)." (Edad: ".trim($oAtencion->Edad)." ".$oAtencion->tedad.")";
                $rpta["DatosPlan"]          = "IAFA Act.: " . $oAtencion->dFuenteFinanciamiento;
                $ultimoServicio             = ReglasFacturacion::BuscaServicioActualDelPaciente($oAtencion->IdServicioIngreso);
                $fechaingreso = str_replace(" 00:00:00.000", "", $oAtencion->FechaIngreso);
                $rpta["DatosProcedencia"]   = "F.Ing: ".Carbon::createFromFormat('Y-m-d', $fechaingreso)->format('d-m-Y')." - ".$oAtencion->dTipoServicio. " - (Est: " . $oAtencion->estadoCta . ") " . $ultimoServicio;

                // Verificar que fecha inicio sea fecha actual
                $fechaInicio = Carbon::createFromFormat("Y-m-d", $fechaingreso);
                $fechaActual = Carbon::now();
                $dias = $fechaActual->diffInDays($fechaInicio, false);

                if($dias<0 && $origen == "CONSULTAEXTERNA")
                {
                    throw new \Exception("La CITA tiene fecha diferente a la de HOY");
                }

                // Si el estado != 1 significa que no esta abierto
                if($oAtencion->IdEstado != "1")
                {
                    throw new \Exception("Ese estado de Cuenta no se encuentra ABIERTO");
                }

                if($oAtencion->idFuenteFinanciamiento == 3 && $oAtencion->idEstadoAtencion == 2 && is_null($oAtencion->FechaEgreso))
                {
                    throw new \Exception("Ese estado de Cuenta se encuentra CERRADA. Comunicarse con la oficina de seguros");
                }

                if($this->seRegistroTriaje($oAtencion->IdAtencion) && $opcion == "AGREGAR")
                {
                    throw new \Exception("Ya se registró el triaje para esa cuenta");
                }

                if(!empty($oAtencion->FechaEgreso))
                {
                    if($opcion == "ELIMINAR")
                    {
                        throw new \Exception("Ya se atendió al Paciente, no se podrá eliminar TRIAJE");
                    }
                    else
                    {
                        throw new \Exception("Ya se atendió al Paciente, no se podrá registrar desde el Area de TRIAJE");
                    }
                }

                // Verificar financiamiento
                if (ReglasFacturacion::TiposFinanciamientoGeneraReciboPago($oAtencion->IdFormaPago) && $oAtencion->IdFormaPago!=3)
                {
                    $oReglaAdmision = new ReglasAdmision();
                    if ($oReglaAdmision->EsServicioCostoCero($oAtencion->IdServicioIngreso) == false)
                    {
                        $datos = ReglasFacturacion::FacturacionPaquetesCEporIdPuntoCargaNrocuentaIdEspecialidad($numCuenta, $oAtencion->IdEspecialidad, 6);
                        if(count($datos) == 0)
                        {
                            $datos = ReglasFacturacion::DevuelveSiPagoConsultaMedicaEnCaja($oAtencion->IdAtencion, "1");
                            if(count($datos)>0)
                            {
                                $datos = collect($datos[0]);
                                if ($datos["IdEstadoFacturacion"] != 4)
                                {
                                    throw new \Exception("No pagó CITA el paciente: {$rpta["DatosCuenta"]}");
                                }
                            }
                        }
                    }
                }

                if($opcion == "AGREGAR" )
                {
                    return imprimeJSON(true, "Consulta correcta", $rpta);
                }
            }
            else
            {
                throw new \Exception("Número de cuenta no encontrado");
            }
        }
        catch (\Exception $e)
        {
            if($opcion != "AGREGAR") { throw new \Exception($e->getMessage()); }
            return imprimeJSON(false, $e->getMessage());
        }
    }

    private function seRegistroTriaje($idAtencion)
    {
        $seRegistroTriaje = false;
        $datos = AtencionesCE::SeleccionarPorId($idAtencion);
        if (count($datos) > 0 )
        {
            $seRegistroTriaje = true;
        }
        return $seRegistroTriaje;
    }

    public function apiService(Request $request)
    {
        switch ($request->name)
        {
            case 'getNroCuenta':
                {
                    $numCuenta = $request->nro_cuenta;
                    $origen = "CONSULTAEXTERNA";
                    return $this->getNroCuenta($numCuenta, $origen);
                } break;
            default:
                {
                    return null;
                }

        }
    }

}