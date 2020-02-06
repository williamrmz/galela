<?php

namespace App\Http\Controllers\ConsultaExterna;

use App\Http\Controllers\ConsultaReniecController;
use App\Model\Pacientes;
use App\VB\SIGHDatos\HistoriasClinicas;
use App\VB\SIGHDatos\SunasaPacientesHistoricos;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use App\VB\SIGHNegocios\ReglasArchivoClinico;
use App\VB\SIGHNegocios\ReglasComunes;
use App\VB\SIGHNegocios\ReglasServGeograf;
use App\VB\SIGHNegocios\ReglasAdmision;
use App\VB\SIGHNegocios\ReglasFacturacion;
use App\VB\SIGHEntidades\Enumerados;
use App\VB\SIGHEntidades\Teclado;
use App\VB\SIGHEntidades\Cadena;
use App\VB\SIGHDatos\Parametros;
use App\VB\SIGHComun\DOCuentaAtencion;
use App\VB\SIGHComun\DOAtencion;
use App\VB\SIGHComun\DOCita;
use App\VB\SIGHComun\DoAtencionDatosAdicionales;
use App\VB\SIGHComun\DOPaciente;
use App\VB\SIGHComun\DOHistoriaClinica;
use App\VB\SIGHComun\DoSunasaPacientesHistoricos;
use App\VB\SIGHSis\ReglasSISgalenhos;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use mysql_xdevapi\Exception;


class PacienteController extends Controller
{
    const PATH_VIEW = 'consulta-externa.paciente.';

    private $mo_AdminArchivoClinico;
    private $mo_AdminServiciosGeograficos;
    private $mo_ReglasSISgalenhos;
    private $mo_AdminAdmision;
    private $lcBuscaParametro;
    private $mo_CuentasAtencion;
    private $mo_Atenciones;
    private $mo_Cita;
    private $mo_DoAtencionDatosAdicionales;
    private $mo_Pacientes;
    private $oDOPaciente;                               // Objeto: Paciente
    private $oDOHistoria; //alias: $mo_Historia;
    private $oDOSunasaPacientesHistoricos;
    private $user;                                      // Variable que almacena información de usuario
    private $mi_Opcion;                                 // Opción a realizar: sghAgregar, etc...
    private $idListBar;
    private $idPaciente;                                // Variable para ID-PACIENTE
    private $errors;                                    // Arreglo de error

    public function __construct()
    {
        $this->mo_AdminArchivoClinico = new ReglasArchivoClinico;
        $this->mo_AdminServiciosComunes = new ReglasComunes;
        $this->mo_AdminServiciosGeograficos = new ReglasServGeograf;
        $this->mo_AdminAdmision = new ReglasAdmision;
        $this->mo_AdminFacturacion = new ReglasFacturacion;
        $this->mo_ReglasSISgalenhos = new ReglasSISgalenhos;
        $this->lcBuscaParametro = new Parametros;
        $this->mo_CuentasAtencion = new DOCuentaAtencion;
        $this->mo_Atenciones = new DOAtencion;
        $this->mo_Cita = new DOCita;
        $this->mo_Pacientes = new DOPaciente;
        $this->mo_DoAtencionDatosAdicionales = new DoAtencionDatosAdicionales;
        $this->oDOPaciente = new doPaciente;
        $this->oDOHistoria = new DOHistoriaClinica;
        $this->oDOSunasaPacientesHistoricos = new DoSunasaPacientesHistoricos;
        $this->user = null;
        $this->idListBar = 101; // Menu: 'Paciente'
        $this->mi_Opcion = 'sghAgregar';
        $this->errors = collect([]);
    }

    // :: Listado de pacientes en base a criterios de busqueda ::
    public function index(Request $request)
    {

        if ($request->ajax()) {
            $this->oDOPaciente->nroHistoriaClinica = (int)trim($request->ftxtNroHistoria);
            $this->oDOPaciente->apellidoPaterno = trim($request->ftxtApellidoPaterno);
            $this->oDOPaciente->apellidoMaterno = trim($request->ftxtApellidoMaterno);
            $this->oDOPaciente->primerNombre = '';
            $this->oDOPaciente->segundoNombre = '';
            $this->oDOPaciente->idDocIdentidad = 1;
            $this->oDOPaciente->nroDocumento = trim($request->ftxtDni);
            $this->oDOPaciente->fichaFamiliar = '';
            $items = $this->oDOPaciente->filtrar();
            return view(self::PATH_VIEW . 'partials.item-list', compact('items'));
        }

        return view(self::PATH_VIEW . 'index');
    }

    public function create()
    {
        abort(404);
    }

    // Registrar nuevo paciente (POST)
    public function store(Request $request)
    {

        if (request()->ajax()) {
            $this->user = Auth::user();
            $this->mi_Opcion = 'sghAgregar';
            $validarDatos = $this->ValidarDatosObligatorios($request);
            if ($validarDatos->status == true) {
                $this->CargaDatosAlObjetosDeDatos('sghAgregar', $request);
                $validarReglas = $this->ValidarReglas();

                if ($validarReglas->status == true) {
                    DB::beginTransaction();
                    try {
                        $agregarDatos = $this->AgregarDatos();
                        if ($agregarDatos->status == true) {
                            DB::commit();
                            return ['success' => true, 'message' => arrayHTML(['Los datos se guardaron correctamente'])];
                        } else {
                            return ['success' => false, 'message' => arrayHTML(['No se pudo agregar los datos'])];
                        }

                        // DB::commit();
                    } catch (\Exception $e) {
                        DB::rollback();
                        return ['success' => false, 'message' => arrayHTML([$e->getMessage()])];
                    }
                } else {
                    return ['success' => $validarReglas->status, 'message' => arrayHTML($validarReglas->errors)];
                }
            } else {
                return ['success' => $validarDatos->status, 'message' => arrayHTML($validarDatos->errors)];
            }
            return $request->all();
        }
    }

    public function show($id)
    {
        abort(404);
    }

    public function edit($id)
    {
        if (request()->ajax()) {
            $this->idPaciente = $id;
            $item = $this->traerTodosDatosPaciente();
            return $item;
        }
    }

    // :: Solo actualiza datos del paciente y sunasa.
    // :: No actualiza datos relacionados a historias clínicas.
    public function update(Request $request, $id)
    {
        if (request()->ajax()) {
            $this->user = \Auth::user();
            $this->mi_Opcion = 'sghModificar';

            // :: Buscar paciente ::
            $validarDatos = $this->ValidarDatosObligatorios($request);

            if ($validarDatos->status == true) {
                $this->CargaDatosAlObjetosDeDatos('sghModificar', $request);

                $validarReglas = $this->ValidarReglas();
                if ($validarReglas->status == true) {
                    DB::beginTransaction();
                    try {
                        $modificarDatos = $this->ModificarDatos();

                        if ($modificarDatos->status == true)
                        {
                            DB::commit();
                            return ['success' => true, 'message' => arrayHTML(['Los datos se modificaron correctamente'])];
                        } else {
                            return ['success' => false, 'message' => arrayHTML($modificarDatos->errors)];
                        }
                    } catch (\Exception $e) {
                        DB::rollback();
                        return ['success' => false, 'message' => arrayHTML([$e->getMessage()])];
                    }
                } else {
                    return ['success' => $validarReglas->status, 'message' => arrayHTML($validarReglas->errors)];
                }
            } else {
                return ['success' => $validarDatos->status, 'message' => arrayHTML($validarDatos->errors)];
            }
        }
    }

    public function delete($id)
    {
        if (request()->ajax()) {
            //DataFake
            $item = DB::table('empleados')->where('idEmpleado', $id)
                ->select('idEmpleado as id', 'Nombres as name')->first();

            return view(self::PATH_VIEW . 'partials.item-delete', compact('item'));
        }
    }

    public function destroy(Request $request, $id)
    {
        if (request()->ajax()) {
            $errors = collect([]);
            $this->user = \Auth::user();
            $this->mi_Opcion = 'sghEliminar';

            $this->oDOPaciente = Pacientes::find($id);
            $this->oDOPaciente->idPaciente = $this->oDOPaciente->IdPaciente;
            $this->oDOPaciente->idUsuarioAuditoria = $this->user->id;

            DB::beginTransaction();
            try
            {
                $puedeEliminarse = $this->mo_AdminFacturacion->PacienteSePuedeEliminar($this->oDOPaciente->idPaciente);
                if ($puedeEliminarse->respuesta == 1)
                {
                    // 1. Eliminar registros SUNASA
                    $regSunasaHistorico = SunasaPacientesHistoricos::where('idPaciente', $this->oDOPaciente->idPaciente)->delete();

                    // 2. Eliminar historia clínica
                    $oDoHistoria = new DOHistoriaClinica;
                    $oDoHistoria->nroHistoriaClinica = $this->oDOPaciente->NroHistoriaClinica;
                    $oDoHistoria->idUsuarioAuditoria = $this->oDOPaciente->idUsuarioAuditoria;
                    $oHistoria = new HistoriasClinicas();


                    if ($this->oDOPaciente->IdTipoNumeracion == param('sghHistoriaDefinitivaManual')
                        || $this->oDOPaciente->IdTipoNumeracion == param('sghHistoriaDefinitivaAutomatica')
                        || $this->oDOPaciente->IdTipoNumeracion == param('sghHistoriaDefinitivaReciclada'))
                    {
                        $eliminarHistoria = $oHistoria->Eliminar($oDoHistoria);
                        if ($eliminarHistoria > 1)
                        {
                            throw new Exception("Se ha producido un error al intentar eliminar los datos de la historia clinica");
                        }
                    }

                    // 3. Eliminar paciente
                    $oPaciente = new \App\VB\SIGHDatos\Pacientes();
                    $oPaciente->Eliminar($this->oDOPaciente);

                    // 4. Agregar AuditoriaV
                    AuditoriaAgregarV($this->oDOPaciente->idUsRealizarBusquedauarioAuditoria,
                        "E",
                        $this->oDOPaciente->IdPaciente,
                        "Pacientes",
                        $this->idListBar, nombrePC(),
                        trim($this->oDOPaciente->apellidoPaterno) . " " . trim($this->oDOPaciente->apellidoMaterno) . " " . trim($this->oDOPaciente->primerNombre) . " " . trim($this->oDOPaciente->segundoNombre));

                    if ($this->oDOPaciente->fichaFamiliar == "")
                    {
                        $message = "Los datos se eliminaron correctamente  \nN° Historia Clínica: " . trim($this->oDOPaciente->NroHistoriaClinica); //'JHIMI 09032018
                    } else {
                        $message = "Los datos se eliminaron correctamente \nFicha Familiar:" . $this->oDOPaciente->FichaFamiliar;

                    }
                    DB::commit();
                    return ['success' => true, 'message' => arrayHTML([$message])];
                } else
                {
                    return ['success' => false, 'message' => arrayHTML(['El paciente no se puede eliminar porque tiene atenciones registradas'])];
                }

            } catch (\Exception $e)
            {
                DB::rollback();
                return ['success' => false, 'message' => arrayHTML([$e->getMessage()])];
            }


        }
    }

    public function EliminarDatos()
    {
        $errors = collect([]);

        // Buscar y eliminar SunasaPacienteHistorico
        $objSunasa = SunasaPacientesHistoricos::where('idPaciente', $this->oDOPaciente->idPaciente)->get();
        if (count($objSunasa) > 0) {
            $objSunasa->delete();
        }


        $eliminar = $this->mo_AdminAdmision->PacientesEliminar(
            $this->oDOPaciente,
            $this->idListBar,
            nombrePc(),
            trim($this->oDOPaciente->apellidoPaterno) . " " . trim($this->oDOPaciente->apellidoMaterno) . " " . trim($this->oDOPaciente->primerNombre) . " " . trim($this->oDOPaciente->segundoNombre),
            $this->oDOSunasaPacientesHistoricos
        );  //'JHIMI 10042018
        // Kill lcArchivoImagenFinal

        if ($eliminar->status == false) {
            foreach ($eliminar->errors as $error) $errors->push($error);
        }

        return jsonClass([
            'status' => count($errors) == 0 ? true : false,
            'errors' => $errors
        ]);
    }

    public function AgregarDatos()
    {
        $errors = collect([]);
        $mo_DoPacientesDatosAdd = null;
        $agregar = $this->mo_AdminAdmision->PacientesAgregarPacienteEHistoriaClinica(
            $this->oDOPaciente,
            $this->oDOHistoria,
            $this->idListBar,
            nombrePc(),
            trim($this->oDOPaciente->apellidoPaterno) . " " . trim($this->oDOPaciente->apellidoMaterno) . " " . trim($this->oDOPaciente->primerNombre) . " " . trim($this->oDOPaciente->segundoNombre),
            $this->oDOSunasaPacientesHistoricos,
            $mo_DoPacientesDatosAdd);

        $this->GrabaImagenesEnRutaDelServidor();

        // TODO: NO IMPLEMENTADO EN V3 'mgaray201411f
        if ($agregar->status == true) {
            // $oReglasIntegracion = new  ReglasIntegracion;
            // $oReglasIntegracion->EnviarDatosPacienteRisPacs($this->oDOPaciente);
        } else {
            foreach ($agregar->errors as $error) $errors->push($error);
        }

        return jsonClass([
            'status' => count($errors) == 0 ? true : false,
            'errors' => $errors
        ]);
    }

    public function ModificarDatos()
    {
        $errors = collect([]);
        $mo_DoPacientesDatosAdd = null;

        $modificar = $this->mo_AdminAdmision->PacientesModificarYActualizarHistoriaClinicaDefinitiva(
            $this->oDOPaciente,
            $this->oDOHistoria,
            request()->tipoNumeracionAnterior,
            $this->idListBar,
            nombrePc(),
            Trim($this->oDOPaciente->apellidoPaterno) . " " . Trim($this->oDOPaciente->apellidoMaterno) . " " . Trim($this->oDOPaciente->primerNombre) . " " . $this->oDOPaciente->segundoNombre,
            $this->oDOSunasaPacientesHistoricos,
            $mo_DoPacientesDatosAdd);  //'JHIMI 10042018

        $this->GrabaImagenesEnRutaDelServidor();

        if ($modificar->status == true) {
            //'mgaray201411f
            //Dim o_ReglasIntegracion As New ReglasIntegracion
            //Call o_ReglasIntegracion.EnviarDatosPacienteRisPacs(mo_Pacientes, False)
        } else {
            foreach ($modificar->errors as $error) $errors->push($error);
        }

        return jsonClass([
            'status' => count($errors) == 0 ? true : false,
            'errors' => $errors
        ]);
    }

    private function ValidarDatosObligatorios($request)
    {
        $wxParametro282 = $this->lcBuscaParametro->SeleccionaFilaParametro(282);
        $wxParametro333 = $this->lcBuscaParametro->SeleccionaFilaParametro(333);
        $wxParametro282 = isset($wxParametro282[0]) ? strtoupper($wxParametro282[0]->ValorTexto) : '';
        $wxParametro333 = isset($wxParametro333[0]) ? strtoupper($wxParametro333[0]->ValorTexto) : '';

        // Recolector de errores
        $errors = collect([]);

        // 2. VALIDA DATOS DE PACIENTES
        if ($request->cmbIdTipoGenHistoriaClinica == '') {
            $errors->push("Ingrese el tipo de generacion de historia");
        } else {
            switch ((int)$request->cmbIdTipoGenHistoriaClinica) {
                case Enumerados::param('sghHistoriaTemporalCOnsultaExterna'):
                    break;
                case Enumerados::param('sghHistoriaTemporalEmergencia'):
                    break;
                case Enumerados::param('sghSinHistoria'):
                    break;
                case Enumerados::param('sghHistoriaDefinitivaManual'):
                    if (trim($request->txtIdNroHistoria == "")) $errors->push('Ingrese el número de historia clínica');
                    break;
                default:
                    break;
            }
        }

        $mb_PacienteNoIdentificado = false;

        $wxSinApellido = '***';

        if (!$mb_PacienteNoIdentificado) {

            if (trim($request->txtApellidoPaterno) == "") {
                $errors->push('Ingrese el Apellido Paterno');
            } else if (Teclado::TextoAlmenosExisteAlgunaLetra($request->txtApellidoPaterno) == false && $this->wxSinApellido <> $request->txtApellidoPaterno) {
                $errors->push('El Apellido Paterno NO TIENE LETRA');
            }

            if (trim($request->txtApellidoMaterno) == "") {
                $errors->push('Ingrese el apellido materno');
            } else if (Teclado::TextoAlmenosExisteAlgunaLetra($request->txtApellidoMaterno) == false && $this->wxSinApellido <> $request->txtApellidoMaterno) {
                $errors->push('El Apellido Materno NO TIENE LETRA');
            }

            if (trim($request->txtPrimerNombre) == "") {
                $errors->push('Ingrese el primer nombre');
            } else if (Teclado::TextoAlmenosExisteAlgunaLetra($request->txtPrimerNombre) == false) {
                $errors->push('El Primer Nombre NO TIENE LETRA');
            }

            if ($request->txtFechaNacimiento == "") {
                $errors->push('Debe registrar la fecha de nacimiento');
            }

            // lnOpcionQueUsaEsteControl: 1->Pacientes, 2->Admision de Emergencia, 3->Admision de Hospitalizacion
            $lnOpcionQueUsaEsteControl = 0;

            if ($lnOpcionQueUsaEsteControl <> 1) {
                if ($request->cmbEtnia == "") {
                    $errors->push('Elija la ETNIA');
                }
            }

            if ($lnOpcionQueUsaEsteControl <> 1) {
                if ($request->cmbIdIdioma == "") {
                    $errors->push('Elija la IDIOMA');
                }
            }

            if ($request->txtEmail <> "") {
                if (Cadena::DevuelveARROBAS($request->txtEmail) == false) {
                    $errors->push('Debe haber un @ en el EMAIL');
                } else if (strlen($request->txtEmail) < 3) {
                    $errors->push('La longitud del Email no es adecuado');
                }
            }

            if ($wxParametro282 == "S" and $wxParametro333 == "S") {  //'solo para CS y que se exija el ingreso
                if (trim($request->txtSector) == "") {
                    $errors->push('Debe registrar el SECTOR (por ser un CS/PS)');
                }
                if (trim($request->lblSectorista) == "") {
                    $errors->push('Elija el SECTORISTA (por ser un CS/PS)');
                }
            }

            //NEW
            if ($request->cmbIdTipoSexo == 0) {
                $errors->push('Ingrese el sexo');
            }

        } else {
            if ($request->cmbIdTipoSexo == 0) {
                $errors->push('Ingrese el sexo');
            }
            if ((trim($request->txtEdad) == "" or $request->cboTipoEdadPaciente == "") and $request->chkNN == 1) {
                $errors->push('Ingrese una edad referencial del Paciente');
            }
        }

        // $request->txtFechaCreacion = '';
        // if ( $request->txtFechaCreacion == 'sighEntidades.FECHA_VACIA_DMY' ) {
        if ($request->txtFechaCreacion == '') {
            $errors->push('Por favor ingrese la fecha de creación');
        }

        $data = jsonClass([
            'status' => count($errors) == 0 ? true : false,
            'errors' => $errors,
        ]);
        return $data;
    }

    // mb_YaNoTieneSeguroUltimoRegistroGrabado As Boolean
    private function CargaDatosAlObjetosDeDatos($operacion, $request)
    {
        // 1.  PACIENTES DETALLE
        $this->CargaDatosAlObjetosDeDatosPaciente($operacion, $request);

        if ($request->chkSinSeguroSunasa == 1 && $operacion == 'sghAgregar')
        {
            // 2.  SUNASA
            $this->oDOSunasaPacientesHistoricos->yaNoTieneSeguro = true;
        }
        else
        {
            $this->CargaDatosAlObjetosDeDatosSunasa($operacion, $request);
        }

    }

    private function CargaDatosAlObjetosDeDatosPaciente($mi_Opcion, $request)
    {
        // :: Evita que al modificar se reemplacen estos valores
        if ($mi_Opcion == 'sghAgregar')
        {
            $this->oDOPaciente->idTipoNumeracion = $request->cmbIdTipoGenHistoriaClinica;
            $this->oDOPaciente->nroHistoriaClinica = $request->txtIdNroHistoria;
        }

        $this->oDOPaciente->idPaciente = $request->idPaciente;
        $this->oDOPaciente->apellidoPaterno = $request->txtApellidoPaterno;
        $this->oDOPaciente->apellidoMaterno = $request->txtApellidoMaterno;
        $this->oDOPaciente->primerNombre = $request->txtPrimerNombre;
        $this->oDOPaciente->segundoNombre = $request->txtSegundoNombre;
        $this->oDOPaciente->tercerNombre = $request->txtTercerNombre;
        if ($request->txtFechaNacimiento == "") {
            $request->fechaNacimiento = 0;
        } else {
            $txtHoraNacimiento = $request->txtHoraNacimiento;
            if ($request->txtHoraNacimiento == "") {
                $request->txtHoraNacimiento = "00:00";
            }
            $this->oDOPaciente->fechaNacimiento = $request->txtFechaNacimiento . " " . $request->txtHoraNacimiento;
        }

        $this->oDOPaciente->nroDocumento = $request->txtNroDocumento;
        $this->oDOPaciente->telefono = $request->txtTelefono;
        $this->oDOPaciente->telefono2 = $request->txtTelefono2;
        $this->oDOPaciente->telefono3 = $request->txtTelefono3;
        $this->oDOPaciente->telefono4 = $request->txtTelefono4;
        $this->oDOPaciente->direccionDomicilio = $request->txtDireccionDomicilio;
        $this->oDOPaciente->direccionDomiciliotutor = $request->txtDireccionDomicilioTutor;
        $this->oDOPaciente->idTipoSexo = $request->cmbIdTipoSexo;

        $this->oDOPaciente->idProcedencia = $request->cmbIdProcedencia;
        $this->oDOPaciente->idGradoInstruccion = $request->cmbIdGradoInstruccion;
        $this->oDOPaciente->idEstadoCivil = $request->cmbIdEstadoCivil;
        $this->oDOPaciente->idDocIdentidad = $request->cmbIdDocIndentidad;
        $this->oDOPaciente->idTipoOcupacion = $request->cmbIdTipoOcupacion;

        $this->oDOPaciente->idPaisNacimiento = $request->cmbIdPaisNacimiento;
        $this->oDOPaciente->idDistritoNacimiento = $request->cmbIdDistritoNacimiento;
        $this->oDOPaciente->idCentroPobladoNacimiento = $request->cmbIdCentroPobladoNacimiento;

        $this->oDOPaciente->idPaisDomicilio = $request->cmbIdPaisDomicilio;
        $this->oDOPaciente->idDistritoDomicilio = $request->cmbIdDistritoDomicilio;
        $this->oDOPaciente->idCentroPobladoDomicilio = $request->cmbIdCentroPobladoDomicilio;

        $this->oDOPaciente->idPaisDomicilioTutor = $request->mo_cmbIdPaisDomicilioTutor;
        $this->oDOPaciente->idDistritoDomicilioTutor = $request->mo_cmbIdDistritoDomicilioTutor;
        $this->oDOPaciente->idCentroPobladoDomicilioTutor = $request->mo_cmbIdCentroPobladoDomicilioTutor;
        $this->oDOPaciente->direccionDomiciliotutor = $request->txtDireccionDomicilioTutor;

        $this->oDOPaciente->idPaisProcedencia = $request->cmbIdPaisProcedencia;
        $this->oDOPaciente->idDistritoProcedencia = $request->cmbIdDistritoProcedencia;
        $this->oDOPaciente->idCentroPobladoProcedencia = $request->cmbIdCentroPobladoProcedencia;

        $this->oDOPaciente->nombrePadre = $request->txtNombrePadre; // pasar a estado de desuso
        $this->oDOPaciente->nombreMadre = trim($request->txtMadreNombre . ' ' . $request->txtMadreSnombre);

        $this->oDOPaciente->autogenerado = $this->mo_AdminAdmision->PacienteCrearNroAutogenerado($this->oDOPaciente);
        $autogenerado = $this->oDOPaciente->autogenerado;

        $this->oDOPaciente->idUsuarioAuditoria = $this->user->id;
        $this->oDOPaciente->observacion = $request->txtObservacion;

        // TODO: implementar HTML de ficha familiar
        if (strlen(trim($request->txtFichaFamiliar1)) > 0 and strlen(trim($request->txtFichaFamiliar2)) > 0 and strlen(trim($request->txtFichaFamiliar3)) > 0) {
            $this->oDOPaciente->fichaFamiliar = $request->txtFichaFamiliar1 . "-" . $request->txtFichaFamiliar2 . "-" . $request->txtFichaFamiliar3;
        } else {
            $this->oDOPaciente->fichaFamiliar = "";
        }

        $this->oDOPaciente->idEtnia = $request->cmbEtnia;
        $this->oDOPaciente->idIdioma = $request->cmbIdIdioma;
        $this->oDOPaciente->usoWebReniec = 0; //'mb_UsoWebReniec';
        $this->oDOPaciente->email = $request->txtEmail;

        $this->oDOPaciente->nroOrdenHijo = $request->txtNroHijo;
        $this->oDOPaciente->madreTipoDocumento = $request->cmbMadreTipoDocumento;
        $this->oDOPaciente->madreDocumento = $request->txtMadreDocumento;
        $this->oDOPaciente->madreApellidoPaterno = $request->txtMadreApellidoP;
        $this->oDOPaciente->madreApellidoMaterno = $request->txtMadreApellidoM;
        $this->oDOPaciente->madrePrimerNombre = $request->txtMadreNombre;
        $this->oDOPaciente->madreSegundoNombre = $request->txtMadreSnombre;

        if ($request->fraSector == true) { // fraSector enable ?
            $this->oDoPaciente->sector = $request->txtSector;
            $this->oDoPaciente->sectorista = $request->txtSectorista;
        }

        // 'ActualizaTipoYnroDocumentoDelPaciente oDOPaciente
        // 1.2. CARGA DATOS DE LA HISTORIA CLINICA
        $this->oDOHistoria->nroHistoriaClinica = $request->txtIdNroHistoria; //'JHIMI 09032018 Val(txtIdNroHistoria)
        $this->oDOHistoria->fechaCreacion = ($request->txtFechaCreacion == "" or $request->txtFechaCreacion == "") ? 0 : dateFormat($request->txtFechaCreacion, 'd-m-Y');
        $this->oDOHistoria->idTipoNumeracion = $request->cmbIdTipoGenHistoriaClinica;
        $this->oDOHistoria->fechaPasoAPasivo = 0;
        $this->oDOHistoria->idEstadoHistoria = 1;
        $this->oDOHistoria->idPaciente = $request->idPaciente;
        $this->oDOHistoria->idTipoHistoria = 1;
        $this->oDOHistoria->idUsuarioAuditoria = $this->user->id;

    }

    private function CargaDatosAlObjetosDeDatosSunasa($mi_Opcion, $request)
    {
        $this->oDOSunasaPacientesHistoricos->anteriorIdTipoDocumentoAsegurado = $request->cmbDocumentoAnterior;
        $this->oDOSunasaPacientesHistoricos->anteriorNroDocumentoAsegurado = $request->txtNroDocumentoAnterior;
        $this->oDOSunasaPacientesHistoricos->apellidoCasada = $request->txtApellidoCasada;
        $this->oDOSunasaPacientesHistoricos->codigoEstablecimientoIAFA = $request->txtCodEstablecIAFA;
        $this->oDOSunasaPacientesHistoricos->codigoEstablecimientoRENAES = $request->txtCodEstablecRENAES;
        $this->oDOSunasaPacientesHistoricos->codigoIAFA = $request->txtCodigoIAFA;
        $this->oDOSunasaPacientesHistoricos->dNIusarioOperacion = $request->txtDNIUsuario;
        $this->oDOSunasaPacientesHistoricos->estadoDelSeguro = (int)$request->cmbEstadoSeguro;

        if ($request->txtFechaEnvio <> '' and $request->txtHoraEnvio <> '') {
            $this->oDOSunasaPacientesHistoricos->fechaEnvio = dateFormat(($request->txtFechaEnvio . " " . $request->txtHoraEnvio), 'd-m-Y H:i:s');
        } else {
            $this->oDOSunasaPacientesHistoricos->fechaEnvio = 0;
        }

        if ($request->txtFechaFinalAfiliacion <> '') {
            $this->oDOSunasaPacientesHistoricos->fechaFinalAfiliacion = dateFormat($request->txtFechaFinalAfiliacion, 'd-m-Y');
        } else {
            $this->oDOSunasaPacientesHistoricos->fechaFinalAfiliacion = 0;
        }
        if ($request->txtFechaInicioAfiliacion <> "") {
            $this->oDOSunasaPacientesHistoricos->fechaInicioAfiliacion = dateFormat($request->txtFechaInicioAfiliacion, 'd-m-Y');
        } else {
            $this->oDOSunasaPacientesHistoricos->fechaInicioAfiliacion = 0;
        }

        $this->oDOSunasaPacientesHistoricos->idAfiliacion = $request->cmbTipoAfiliacion;
        $this->oDOSunasaPacientesHistoricos->idOperacion = $request->cmbTipoOperacion;
        $this->oDOSunasaPacientesHistoricos->idPaciente = $request->idPaciente;
        $this->oDOSunasaPacientesHistoricos->idPaisTitular = $request->cmbPaisTitular;
        $this->oDOSunasaPacientesHistoricos->idParentesco = $request->cmbParentescoTitular;
        $this->oDOSunasaPacientesHistoricos->idRegimen = $request->cmbRegimen;
        $this->oDOSunasaPacientesHistoricos->idSunasaPacienteHistorico = $request->idSunasaPacienteHistorico;
        $this->oDOSunasaPacientesHistoricos->idTipoDocumentoTitular = $request->cmbDocumentoTitular;
        $this->oDOSunasaPacientesHistoricos->idUsuarioAuditoria = $this->user->id;
        $this->oDOSunasaPacientesHistoricos->nroCarnetIdentidad = $request->txtCarnetIdentidad;
        $this->oDOSunasaPacientesHistoricos->nroDocumentoTitular = $request->txtNdocumentoTitular;

        if ($request->txtProductoPlan1 <> "" and $request->txtProductoPlan2 <> "") {
            $this->oDOSunasaPacientesHistoricos->productoYplan = Right("     " . $request->txtProductoPlan1, 3) . $request->txtProductoPlan2;
        } else {
            $this->oDOSunasaPacientesHistoricos->productoYplan = "";
        }

        $this->oDOSunasaPacientesHistoricos->rUCempleador = $request->txtRUCempleador;

        if ($request->txtNroAfiliacion1 <> "" and $request->txtNroAfiliacion2 <> "" and $request->txtNroAfiliacion3 <> "") {
            $this->oDOSunasaPacientesHistoricos->sisNroAfiliacion = $request->txtNroAfiliacion1 . "-" . $request->txtNroAfiliacion2 . "-" . $request->txtNroAfiliacion3;
        } else {
            $this->oDOSunasaPacientesHistoricos->sisNroAfiliacion = "";
        }

        $this->oDOSunasaPacientesHistoricos->sisSepelioDni = $request->txtSpelioDNI;
        if ($request->txtSepelioFnacimiento <> "") {
            $this->oDOSunasaPacientesHistoricos->sisSepelioFnacimiento = dateFormat($request->txtSepelioFnacimiento, 'd-m-Y');
        } else {
            $this->oDOSunasaPacientesHistoricos->sisSepelioFnacimiento = 0;
        }
        $this->oDOSunasaPacientesHistoricos->sisSepelioParienteEncargado = $request->txtSepelioApellidosYnombre;
        if ($request->cmbSepelioSexo <> "") {
            $this->oDOSunasaPacientesHistoricos->sisSepelioSexo = $request->cmbSepelioSexo;
        } else {
            $this->oDOSunasaPacientesHistoricos->sisSepelioSexo = 0;
        }

        if ($request->cmbValidacionRegIden == "") {
            $this->oDOSunasaPacientesHistoricos->validacionRegIdentidad = 0;
        } else {
            $this->oDOSunasaPacientesHistoricos->validacionRegIdentidad = $request->cmbValidacionRegIden;
        }

        $this->oDOSunasaPacientesHistoricos->yaNoTieneSeguro = (int)$request->chkNoTieneSeguro;
        $this->oDOSunasaPacientesHistoricos->nuevoSeguro = (int)$request->chkNuevoSeguroSunasa;      //'No se graba en la BD


        if ($mi_Opcion == 'sghModificar') {
            // TODO: se modifica: en la carga de datos a la vista se marca 'nuevo seguro' si existe datos anteriores
            // if ( $request->yaNoTieneSeguroUltimoRegistroGrabado == false and $request->chkNoTieneSeguro = 1 ){
            // if ( $request->yaNoTieneSeguroUltimoRegistroGrabado == false and $request->chkNoTieneSeguro == 1 ){
            // 	$this->oDOSunasaPacientesHistoricos->nuevoSeguro = true;
            // }
        }

    }

    private function ValidarReglas()
    {
        $errors = collect([]);

        $ucPacientesDetalleValidarReglas = $this->ucPacientesDetalleValidarReglas($this->oDOPaciente);

        if (!$ucPacientesDetalleValidarReglas->status) {
            foreach ($ucPacientesDetalleValidarReglas->errors as $error) $errors->push($error);
        }

        if ($this->oDOPaciente->fechaNacimiento == 0) {
            $errors->push('Tiene que registrar Fecha de Nacimiento');
        }

        return jsonClass([
            'status' => count($errors) == 0 ? true : false,
            'errors' => $errors
        ]);
    }

    private $mb_PacienteNoIdentificado = false;

    private $wxSinApellido = '*****';

    // ucPacientesDetalles
    private function ucPacientesDetalleValidarReglas($oDOPaciente)
    {
        $request = request();
        $rsPacientes = null;
        $errors = collect([]);
        //'Si el paciente aun no existe (IdPaciente = 0) se verifica que no haya duplicados

        if ($oDOPaciente->idPaciente == 0) {

            $rsPacientes = $this->mo_AdminAdmision->PacientesObtenerConElAutogenerado($oDOPaciente);
            if (count($rsPacientes) > 0) {
                if ($request->chkNN == 0) {
                    $errors->push("Existe un paciente con el mismo número autogenerado (HC: " . trim($rsPacientes[0]->NroHistoriaClinica) . ")");
                } else {
                    $errors->push("Existe un paciente con el mismo número autogenerado: " . $rsPacientes[0]->ApellidoPaterno . " " . $rsPacientes[0]->ApellidoMaterno . " " . $rsPacientes[0]->PrimerNombre . "  HC: " . trim($rsPacientes[0]->NroHistoriaClinica) . ". Desea continuar?");
                }
            }

            if ($oDOPaciente->idTipoNumeracion == Enumerados::param('sghHistoriaDefinitivaManual') ||
                $oDOPaciente->idTipoNumeracion == Enumerados::param('sghHistoriaDefinitivaAutomatica') ||
                $oDOPaciente->idTipoNumeracion == Enumerados::param('sghHistoriaDefinitivaReciclada')
            ) {
                $rsPacientes = $this->mo_AdminAdmision->PacientesObtenerConElMismoNroHistoriaDefinitiva($oDOPaciente);

                if (count($rsPacientes) > 0) {
                    $errors->push("Existe un paciente con el mismo número de historia clínica: " . $rsPacientes[0]->ApellidoPaterno . " " . $rsPacientes[0]->ApellidoMaterno . " " . $rsPacientes[0]->PrimerNombre);
                }
            }
            //'
            if ($request->cmbIdDocIndentidad <> "" and $request->txtNroDocumento <> "") {
                $rsPacientes = $this->mo_AdminAdmision->PacientesFiltraPorNroDocumentoYtipo($request->txtNroDocumento, $request->cmbIdDocIndentidad);
                if (count($rsPacientes) > 0) {
                    // 'Actualizado 20092014
                    $errors->push("El nro de documento: " . $request->txtNroDocumento . ", ya existe para el Paciente: " . trim($rsPacientes[0]->NroHistoriaClinica) . " " . $rsPacientes[0]->ApellidoPaterno . " " . $rsPacientes[0]->ApellidoMaterno . " " . $rsPacientes[0]->PrimerNombre); //'JHIMI 12032018
                }
            }

            // TODO: NO IMPLEMENTADO LA FICHA FAMILIAR
            if ($this->mi_Opcion == 'sghAgregar' and $request->txtFichaFamiliar3Visible == true and $request->txtFichaFamiliar1 <> "" and $request->txtFichaFamiliar2 <> "" and $txtFichaFamiliar3 <> "") {
                $existeFichaFamiliar = $this->mo_AdminAdmision->ExisteFichaFamiliar($this->DevuelveFichaFamiliarUnida($request->idPaciente));
                if ($existeFichaFamiliar->status <> "") {
                    $errors->push("Existe un paciente con la misma FICHA FAMILIAR: " . $existeFichaFamiliar->error);
                }
            }


        } else {
            if ($request->cmbIdDocIndentidad <> "" and $request->txtNroDocumento <> "") {
                $rsPacientes = $this->mo_AdminAdmision->PacientesFiltraPorNroDocumentoYtipo($request->txtNroDocumento, $request->cmbIdDocIndentidad);

                if (count($rsPacientes) > 0) {
                    foreach ($rsPacientes as $row) {
                        if ($rsPacientes[0]->IdPaciente <> $oDOPaciente->idPaciente) {
                            if (!is_null($rsPacientes[0]->NroHistoriaClinica)) {
                                $errors->push("Es N° DOCUMENTO ya existe para el Paciente: " . Trim($rsPacientes[0]->NroHistoriaClinica) . " " . $rsPacientes[0]->ApellidoPaterno . " " . $rsPacientes[0]->ApellidoMaterno . " " . $rsPacientes[0]->PrimerNombre);  //'JHIMI 12032018
                            } else {
                                $errors->push("Es N° DOCUMENTO ya existe para el Paciente: " . $rsPacientes[0]->ApellidoPaterno . " " . $rsPacientes[0]->ApellidoMaterno . " " . $rsPacientes[0]->PrimerNombre);
                            }
                        }
                    }
                }
            }
        }

        //'
        //'mgaray20141008
        if ($request->txtFechaNacimiento <> '' and $this->mi_Opcion <> 'sghEliminar') {
            if ($request->txtFechaNacimiento > $request->txtFechaCreacion) {
                $errors->push("La fecha de nacimiento no puede ser mayor que la fecha de creación de la historia");
            }
        }
        // TODO: HTML NO IMPLEMENTADO
        if ($request->lbExigeIngresoDelDNI == true and $this->mi_Opcion <> 'sghEliminar') {
            if ($request->cmbIdDocIdentidad == "" or $request->txtNroDocumento == "") {
                $errors->push("Es obligatorio ingresar el DNI");
            }
        }

        //'
        if ($request->cmbIdDocIndentidad == "1" and len(trim($request->txtNroDocumento)) <> 8 and $this->mi_Opcion <> 'sghEliminar') {
            $errors->push("DNI debe tener 8 dígitos");
        }

        // TODO: HTML NO IMPLEMENTADO
        if ($request->lbExigeIngresoDeCentroPoblado == true and $this->mi_Opcion <> 'sghEliminar') {
            if ($request->cmbIdCentroPobladoDomicilio == "") {
                $errors->push("Es obligatorio elegir el CENTRO POBLADO para CS");
            }
        }

        //'
        if ($request->txtEdadActual < 18 and $request->cmbIdDocIndentidad <> "10" and ($request->txtNroDocumento == "" or $request->cmbIdDocIndentidad == "8" or $request->cmbIdDocIndentidad == "9") and $this->mi_Opcion <> 'sghEliminar' and $this->mb_PacienteNoIdentificado == false) {

            if ($request->txtMadreDocumento == "") {
                if ($request->txtNroHijo == 0) {
                    $errors->push("El Paciente es MENOR DE EDAD, por favor debe registrar el N°HIJO y el DNI DE LA MADRE Si no tiene MADRE o TUTOR elegir en TIPO DOCUMENTO del PACIENTE= 10(Sin registro madre/tutor)");
                }
                if ($request->txtMadreApellidoP == "" or $request->txtMadreApellidoM == "" or $request->txtMadreNombre == "") {
                    $errors->push("El Paciente es MENOR DE EDAD, por favor debe registrar El N° DNI de la MADRE o los APELLIDOS Y NOMBRES DE LA MADRE Si no tiene MADRE o TUTOR elegir en TIPO DOCUMENTO del PACIENTE= 10(Sin registro madre/tutor)");
                }
            } else if (len($request->txtMadreDocumento) <> 8 and $request->cmbMadreTipoDocumento = "1") {
                $errors->push("El N° DNI de la MADRE tiene longitud diferente a OCHO");
            } else if ($request->txtNroHijo == 0) {
                $errors->push("El Paciente es MENOR DE EDAD, por favor debe registrar el N° HIJO Si no tiene MADRE o TUTOR elegir en TIPO DOCUMENTO del PACIENTE= 10(Sin registro madre/tutor)");
            }
        }

        //'
        if ($request->txtApellidoMaterno == $this->wxSinApellido or $request->txtApellidoPaterno == $this->wxSinApellido) {

            if (!(len($request->txtNroDocumento) == 8 and $request->cmbIdDocIndentidad == "1")) {
                $errors->push("Debe registrar el DNI para que el Paciente tenga un solo apellido");
            }
        }

        $validarHistoria = $this->ValidarNumeroDeHistoriaClinica();

        if ($validarHistoria->status == false) {

            foreach ($validarHistoria->errors as $error) $errors->push($error);
        }

        //'
        return jsonClass([
            'status' => count($errors) == 0 ? true : false,
            'errors' => $errors,
        ]);

    }

    // ucPacientesDetalle
    private function ValidarNumeroDeHistoriaClinica()
    {
        $errors = collect([]);
        if (request()->cmbIdTipoGenHistoriaClinica == Enumerados::param('sghHistoriaDefinitivaManual')) {
            if (trim(request()->txtIdNroHistoria) <> "") {
                $lUltimoNumeroHistoria = $this->mo_AdminAdmision->UltimoNroHistoriaGenerado();
                $lUltimoNumeroHistoria = isset($lUltimoNumeroHistoria[0]) ? $lUltimoNumeroHistoria[0]->nroHistoriaClinica : 0;

                if (request()->txtIdNroHistoria > $lUltimoNumeroHistoria + 1) {
                    $errors->push("Número de Historia Ingresado no puede ser mayor que " . ($lUltimoNumeroHistoria + 1));
                }
            }
        }
        return jsonClass([
            'status' => count($errors) == 0 ? true : false,
            'errors' => $errors,
        ]);
    }

    private function DevuelveFichaFamiliarUnida($request)
    {
        return Trim($request->txtFichaFamiliar1) . "-" . Trim($request->txtFichaFamiliar2) . "-" . Trim($request->txtFichaFamiliar3);
    }

    private function GrabaImagenesEnRutaDelServidor()
    {
        $imagen = request()->imagenPaciente;
        $base64 = request()->foto_base64;
        $targetPath = public_path() . "\\storage\\images\\pacientes\\" . $this->oDOPaciente->idPaciente . ".jpeg";

        if ($imagen) {
            $filename = 'usuario.png';
            $sourcePath = $imagen->getRealPath();

            try {
                if (move_uploaded_file($sourcePath, $targetPath)) {
                    $uploadedFile = $filename;
                } else {
                    throw new \Exception("No se pudo cargar la imagen al servidor");
                }
            } catch (\Exception $e) {
                throw new \Exception($e->getMessage());
            }
        } else if (strlen($base64) > 0) {
            // Mover de storage/app/pacientes al directorio path
            $recursoPath = Storage::disk('public')->path("images/pacientes/") . $this->oDOPaciente->nroDocumento . ".jpeg";
            $targetPath = Storage::disk('public')->path("images/pacientes/") . $this->oDOPaciente->idPaciente . ".jpeg";
            rename($recursoPath, $targetPath);
        }
    }

    // PacienteDetalle > CargarDatosAlosControles()
    private function traerTodosDatosPaciente()
    {
        $data['paciente'] = $this->cargarDatosPaciente();
        $data['sunasa'] = $this->cargarDatosSUNASA();
        return $data;
    }

    // ucPacientesDetalle1 > CargarDatosDePacienteALosControles
    private function cargarDatosPaciente()
    {
        $pacienteData = $this->mo_AdminAdmision->PacientesSeleccionarPorId($this->idPaciente);
        $pacienteData = isset($pacienteData[0]) ? $pacienteData[0] : null;

        if ($pacienteData != null) {
            $pacienteData->chkNN = 0;
            if (UCase($pacienteData->ApellidoPaterno) == "NN" and UCase($pacienteData->ApellidoMaterno) == "NN" and UCase($pacienteData->PrimerNombre) == "NN" and UCase($pacienteData->SegundoNombre) == "NN") {
                $pacienteData->chkNN = 1;
            }

            $pacienteData->FechaNacimiento = dateFormat($pacienteData->FechaNacimiento, 'Y-m-d');
            $pacienteData->horaNacimiento = dateFormat($pacienteData->FechaNacimiento, 'H:i');
            $pacienteData->Edad = calcularEdad($pacienteData->FechaNacimiento);

            // :: Ubigeo nacimiento ::
            $oRsBuscaUbigeo = $this->mo_AdminAdmision->CentrosPobladosDevuelveDptoProvDistritoSegunIdCentroPoblado($pacienteData->IdCentroPobladoNacimiento);

            if (count($oRsBuscaUbigeo) > 0) {
                $pacienteData->IdDepartamentoNacimiento = $oRsBuscaUbigeo[0]->IdDepartamento;
                $pacienteData->IdProvinciaNacimiento = $oRsBuscaUbigeo[0]->IdProvincia;
                $pacienteData->IdDistritoNacimiento = $oRsBuscaUbigeo[0]->IdDistrito;
            } else {
                if ($pacienteData->IdDistritoNacimiento > 0) {
                    if (strlen($pacienteData->IdDistritoNacimiento) == 5) {
                        $pacienteData->IdProvinciaNacimiento = substr($pacienteData->IdDistritoDomicilio, 0, 3);
                        $pacienteData->IdDepartamentoNacimiento = substr($pacienteData->IdDistritoDomicilio, 0, 1);
                    } else {
                        $pacienteData->IdProvinciaNacimiento = substr($pacienteData->IdDistritoDomicilio, 0, 4);
                        $pacienteData->IdDepartamentoNacimiento = substr($pacienteData->IdDistritoDomicilio, 0, 2);
                    }
                }
            }

            // :: Ubigeo domicilio ::
            $oRsBuscaUbigeo = $this->mo_AdminAdmision->CentrosPobladosDevuelveDptoProvDistritoSegunIdCentroPoblado($pacienteData->IdCentroPobladoDomicilio);
            if (count($oRsBuscaUbigeo) > 0) {
                $pacienteData->IdDepartamentoDomicilio = $oRsBuscaUbigeo[0]->IdDepartamento;      //'.IdDepartamentoDomicilio
                $pacienteData->IdProvinciaDomicilio = $oRsBuscaUbigeo[0]->IdProvincia;      //'.IdProvinciaDomicilio
                $pacienteData->IdDistritoDomicilio = $oRsBuscaUbigeo[0]->IdDistrito;      //'.IdDistritoDomicilio
            } else {
                if ($pacienteData->IdDistritoDomicilio > 0) {
                    if (strlen($pacienteData->IdDistritoDomicilio) == 5) {
                        $pacienteData->IdProvinciaDomicilio = substr($pacienteData->IdDistritoDomicilio, 0, 3);
                        $pacienteData->IdDepartamentoDomicilio = substr($pacienteData->IdDistritoDomicilio, 0, 1);
                    } else {
                        $pacienteData->IdProvinciaDomicilio = substr($pacienteData->IdDistritoDomicilio, 0, 4);
                        $pacienteData->IdDepartamentoDomicilio = substr($pacienteData->IdDistritoDomicilio, 0, 2);
                    }
                }
            }

            // En caso el paciente no disponga de Ubigeo para domicilio, por default se retorna el valor de parámetro
            // relacionado al ubigeo del establecimiento. Y se recoge el ID de departamento
            if (!isset($pacienteData->IdDepartamentoDomicilio) or $pacienteData->IdDepartamentoDomicilio == '') {
                $pacienteData->IdDepartamentoDomicilio = left(dbParam(242), 2);
            }

            // :: Ubigeo procedencia ::
            $oRsBuscaUbigeo = $this->mo_AdminAdmision->CentrosPobladosDevuelveDptoProvDistritoSegunIdCentroPoblado($pacienteData->IdCentroPobladoProcedencia);
            if (count($oRsBuscaUbigeo) > 0) {
                $pacienteData->IdDepartamentoProcedencia = $oRsBuscaUbigeo[0]->IdDepartamento;      //'.IdDepartamentoProcedencia
                $pacienteData->IdProvinciaProcedencia = $oRsBuscaUbigeo[0]->IdProvincia;      //'.IdProvinciaProcedencia
                $pacienteData->IdDistritoProcedencia = $oRsBuscaUbigeo[0]->IdDistrito;      //'.IdDistritoProcedencia
            } else {
                if ($pacienteData->IdDistritoProcedencia > 0) {
                    if (strlen($pacienteData->IdDistritoProcedencia) == 5) {
                        $pacienteData->IdProvinciaProcedencia = substr($pacienteData->IdDistritoDomicilio, 0, 3);
                        $pacienteData->IdDepartamentoProcedencia = substr($pacienteData->IdDistritoDomicilio, 0, 1);
                    } else {
                        $pacienteData->IdProvinciaProcedencia = substr($pacienteData->IdDistritoDomicilio, 0, 4);
                        $pacienteData->IdDepartamentoProcedencia = substr($pacienteData->IdDistritoDomicilio, 0, 2);
                    }
                }
            }

            // :: Devuelve tipo de historia clínica, y valor respectivo
            $pacienteData->cmbIdTipoGenHistoriaClinicaDisabled = true;
            $pacienteData->txtIdNroHistoria = true;
            if ($pacienteData->IdTipoNumeracion == param('sghHistoriaDefinitivaManual')
                || $pacienteData->IdTipoNumeracion == param('sghHistoriaDefinitivaAutomatica')
                || $pacienteData->IdTipoNumeracion == param('sghHistoriaDefinitivaReciclada')) {
                $pacienteData->cmbIdTipoGenHistoriaClinicaDisabled = false;
                $pacienteData->txtIdNroHistoria = false;
            } else if ($pacienteData->IdTipoNumeracion == param('sghHistoriaTemporalCOnsultaExterna')
                || $pacienteData->IdTipoNumeracion == param('sghHistoriaTemporalEmergencia')
                || $pacienteData->IdTipoNumeracion == param('sghSinHistoria')) { // 4, 5, 6
                $pacienteData->mo_cmbIdTipoGenHistoriaClinica = $this->mo_AdminArchivoClinico->TiposGeneracionHistoriaSeleccionarDefinitivos($pacienteData->IdTipoNumeracion);
            }


            $pacienteData->IdTipoGenHistoriaClinica_tag = $pacienteData->IdTipoNumeracion;         //'lo guarda para luego comparar
            $pacienteData->IdNroHistoria = $pacienteData->NroHistoriaClinica;          //'esto tiene que ir luego del tipo de generacion, por que sino se borra con el change del combo box
            $pacienteData->IdNroHistoria_tag = $pacienteData->NroHistoriaClinica;

            if ($pacienteData->IdNroHistoria != "") {
                if ($pacienteData->IdTipoNumeracion == param('sghHistoriaDefinitivaManual')
                    || $pacienteData->IdTipoNumeracion == param('sghHistoriaDefinitivaAutomatica')
                    || $pacienteData->IdTipoNumeracion == param('sghHistoriaDefinitivaReciclada')) { // 1, 2, 3

                    $oDOHistoria = $this->mo_AdminArchivoClinico->HistoriaClinicaSeleccionarPorId($pacienteData->IdNroHistoria);

                    if (isset($oDOHistoria[0])) {
                        $pacienteData->FechaCreacion = dateFormat($oDOHistoria[0]->FechaCreacion, 'Y-m-d');
                    } else {
                        $this->errors->push("Por algún motivo el paciente no tiene el registro asociado en la tabla de historias clinicas, consulte al administrador de sistemas");
                    }
                }
            } else {
                $this->errors->push("El paciente no tiene historia clinica");
            }

            if (is_null($pacienteData->FichaFamiliar)) {
                $pacienteData->FichaFamiliar1 = "";
                $pacienteData->FichaFamiliar2 = "";
                $pacienteData->FichaFamiliar3 = "";
            }

            if (realpath(public_path() . "\\storage\\images\\pacientes\\$pacienteData->NroDocumento.jpeg") !== false) {
                $pacienteData->imagenPaciente = url("/storage/images/pacientes/$pacienteData->NroDocumento.jpeg");
            } else {
                $pacienteData->imagenPaciente = url("/storage/images/pacientes/NOT_IMAGE.PNG");
            }
        }
        return $pacienteData;
    }

    // ucPacientesDetalle1 > CargaDatosPersonales
    private function CargaDatosPersonales($data, $wxParametro242, $wxParametro287)
    {
    }

    // UcPacientesSunasa1 > CargarDatosDelUltimoSeguroDelPacienteALosControles
    public function cargarDatosSUNASA()
    {
        // $oDoSunasaPacientesHistoricos = new DoSunasaPacientesHistoricos;
        // 'CARGAR DATOS DE SUNASA
        $data = $this->mo_AdminAdmision->SunasaPacientesHistoricosSeleccionarPorIdPaciente($this->idPaciente);
        $oDoSunasaPacientesHistoricos = isset($data[0]) ? $data[0] : null;
        // CargarDatos oDoSunasaPacientesHistoricos

        if ($oDoSunasaPacientesHistoricos) { // UcPacientesSunasa1 > CargarDatos
            if ($oDoSunasaPacientesHistoricos->idPaciente == 0) {
                $oDoSunasaPacientesHistoricos->chkNoTieneSeguro = 1;
                // chkNoTieneSeguro_Click
            } else {
                // Dim lnPos1 As Integer, lnPos2 As Integer

                if ($oDoSunasaPacientesHistoricos->FechaEnvio) {
                    $oDoSunasaPacientesHistoricos->HoraEnvio = dateFormat($oDoSunasaPacientesHistoricos->FechaEnvio, 'H:i');
                    $oDoSunasaPacientesHistoricos->FechaEnvio = dateFormat($oDoSunasaPacientesHistoricos->FechaEnvio, 'Y-m-d');
                }

                if ($oDoSunasaPacientesHistoricos->FechaFinalAfiliacion) {
                    $oDoSunasaPacientesHistoricos->FechaFinalAfiliacion = dateFormat($oDoSunasaPacientesHistoricos->FechaFinalAfiliacion, 'Y-m-d');
                }

                if ($oDoSunasaPacientesHistoricos->FechaInicioAfiliacion) {
                    $oDoSunasaPacientesHistoricos->FechaInicioAfiliacion = dateFormat($oDoSunasaPacientesHistoricos->FechaInicioAfiliacion, 'Y-m-d');
                }

                if ($oDoSunasaPacientesHistoricos->ProductoYplan <> "") {
                    $oDoSunasaPacientesHistoricos->ProductoPlan1 = trim(left($oDoSunasaPacientesHistoricos->ProductoYplan, 3));
                    $oDoSunasaPacientesHistoricos->ProductoPlan2 = mid($oDoSunasaPacientesHistoricos->ProductoYplan, 4, 4);
                }

                if ($oDoSunasaPacientesHistoricos->SisNroAfiliacion <> "") {

                    $lnPos1 = strpos($oDoSunasaPacientesHistoricos->SisNroAfiliacion, "-") + 1;
                    $lnPos2 = strrpos($oDoSunasaPacientesHistoricos->SisNroAfiliacion, "-") + 1;
                    $oDoSunasaPacientesHistoricos->NroAfiliacion1 = left($oDoSunasaPacientesHistoricos->SisNroAfiliacion, $lnPos1 - 1);
                    $oDoSunasaPacientesHistoricos->NroAfiliacion2 = mid($oDoSunasaPacientesHistoricos->SisNroAfiliacion, $lnPos1 + 1, $lnPos2 - $lnPos1 - 1);
                    $oDoSunasaPacientesHistoricos->NroAfiliacion3 = mid($oDoSunasaPacientesHistoricos->SisNroAfiliacion, $lnPos2 + 1, 100);
                }

                if ($oDoSunasaPacientesHistoricos->SisSepelioFnacimiento) {
                    $oDoSunasaPacientesHistoricos->SisSepelioFnacimiento = dateFormat($oDoSunasaPacientesHistoricos->SisSepelioFnacimiento, 'Y-m-d');
                }

                $oDoSunasaPacientesHistoricos->YaNoTieneSeguroUltimoRegistroGrabado = (int)$oDoSunasaPacientesHistoricos->YaNoTieneSeguro;
                $oDoSunasaPacientesHistoricos->NoTieneSeguro = (int)$oDoSunasaPacientesHistoricos->YaNoTieneSeguro;
            }
        }

        return $oDoSunasaPacientesHistoricos;
    }

    // Métodos API del servicio
    public function apiService(Request $request)
    {
        switch ($request->name) {
            case 'getData':
                return $this->getData($request);
                break;
            case 'getEdad':
                return $this->getEdad($request);
                break;
            case 'get_by_nro_documento':
                return $this->apiConsultarDatosPaciente($request);
                break;
            default:
                return null;
        }
    }

    private function getData($request)
    {
        $data['forms'] = $this->getDataForms($request);
        return $data;

    }

    // Informacion para poblar Comboboxes
    private function getDataForms($request)
    {
        $cmbIdTipoGenHistoriaClinica = $this->mo_AdminArchivoClinico->TiposGeneracionHistoriasSeleccionarTodos();

        foreach ($cmbIdTipoGenHistoriaClinica as $row) {
            $row->id = $row->IdTipoNumeracion;
            $row->text = $row->DescripcionLarga;
        }

        $cmbIdTipoSexo = $this->mo_AdminServiciosComunes->TiposSexoSeleccionarTodos();
        foreach ($cmbIdTipoSexo as $row) {
            $row->id = $row->IdTipoSexo;
            $row->text = $row->DescripcionLarga;
        }

        $cmbIdProcedencia = $this->mo_AdminServiciosComunes->TiposProcedenciaTodos();
        foreach ($cmbIdProcedencia as $row) {
            $row->id = $row->IdProcedencia;
            $row->text = $row->dCorto;
        }

        $cmbIdGradoInstruccion = $this->mo_AdminServiciosComunes->TiposGradosInstruccionTodos();
        foreach ($cmbIdGradoInstruccion as $row) {
            $row->id = $row->IdGradoInstruccion;
            $row->text = $row->dCorto;
        }

        $cmbIdEstadoCivil = $this->mo_AdminServiciosComunes->TiposEstadoCivilTodos();
        foreach ($cmbIdEstadoCivil as $row) {
            $row->id = $row->IdEstadoCivil;
            $row->text = $row->dCorto;
        }

        //PROC NO EXISTE
        // $cmbIdDocIdentidad = $this->mo_AdminServiciosComunes->TiposDocIdentidadSeleccionarTodosIncSinTipoDoc();
        $cmbIdDocIdentidad = $this->mo_AdminServiciosComunes->TiposDocIdentidadSeleccionarTodos();
        foreach ($cmbIdDocIdentidad as $row) {
            $row->id = $row->IdDocIdentidad;
            $row->text = $row->DescripcionLarga;
        }

        $cmbIdTipoOcupacion = $this->mo_AdminServiciosComunes->TiposOcupacionTodos();
        foreach ($cmbIdTipoOcupacion as $row) {
            $row->id = $row->IdTipoOcupacion;
            $row->text = $row->dCorto;
        }

        $cmbIdPais = $this->mo_AdminServiciosGeograficos->PaisesSeleccionarTodos();
        foreach ($cmbIdPais as $row) {
            $row->id = $row->IdPais;
            $row->text = $row->Nombre;
        }

        $cmbIdDepartamento = $this->mo_AdminServiciosGeograficos->DepartamentosSeleccionarTodos();
        foreach ($cmbIdDepartamento as $row) {
            $row->id = $row->IdDepartamento;
            $row->text = $row->Nombre;
        }

        $cmbIdEtnia = $this->mo_AdminServiciosComunes->EtniaHISseleccionarTodos();
        foreach ($cmbIdEtnia as $row) {
            $row->id = $row->codetni;
            $row->text = $row->dCorto;
        }

        $cmbIdIdioma = $this->mo_AdminServiciosComunes->TiposIdiomasSeleccionarTodos();
        foreach ($cmbIdIdioma as $row) {
            $row->id = $row->IdIdioma;
            $row->text = $row->dCorto;
        }

        $cmbIdIdTipoEdad = $this->mo_AdminServiciosComunes->TiposEdadSeleccionarTodos();
        foreach ($cmbIdIdTipoEdad as $row) {
            $row->id = $row->IdTipoEdad;
            $row->text = $row->DescripcionLarga;
        }

        //PROC NO EXISTE
        // $cmbReligion = $this->mo_AdminServiciosComunes->ReligionListarTodos();
        // foreach($cmbReligion as $row){
        // 	$row->id = $row->IdReligion;
        // 	$row->text = $row->Descripcion;
        // }

        //PROC NO EXISTE
        // $cmbGrupoSAnguineo = $this->mo_AdminServiciosComunes->ListarGrupoSanguineo();
        // foreach($cmbGrupoSAnguineo as $row){
        // 	$row->id = $row->IdGrupoSanguineo;
        // 	$row->text = $row->Descripcion;
        // }

        //PROC NO EXISTE
        // $cmbFactorRH = $this->mo_AdminServiciosComunes->ListarFactorRH();
        // foreach($cmbFactorRH as $row){
        // 	$row->id = $row->IdTipoEdad;
        // 	$row->text = $row->DescripcionLarga;
        // }

        $data['cmbTipoGenHistoriaClinica'] = $cmbIdTipoGenHistoriaClinica;
        $data['cmbTipoSexo'] = $cmbIdTipoSexo;
        $data['cmbProcedencia'] = $cmbIdProcedencia;
        $data['cmbGradoInstruccion'] = $cmbIdGradoInstruccion;
        $data['cmbEstadoCivil'] = $cmbIdEstadoCivil;
        $data['cmbDocIdentidad'] = $cmbIdDocIdentidad;
        $data['cmbTipoOcupacion'] = $cmbIdTipoOcupacion;
        $data['cmbPais'] = $cmbIdPais;
        $data['cmbDepartamento'] = $cmbIdDepartamento;
        $data['cmbEtnia'] = $cmbIdEtnia;
        $data['cmbIdioma'] = $cmbIdIdioma;
        $data['cmbIdTipoEdad'] = $cmbIdIdTipoEdad;

        // --------------------- SUNASA -----------------------
        $cmbParentescoTitular = $this->mo_AdminServiciosComunes->SunasaTiposParentescoSeleccionarTodos();
        foreach ($cmbParentescoTitular as $row) {
            $row->id = $row->idParentesco;
            $row->text = $row->Parentesco;
        }

        $cmbTipoOperacion = $this->mo_AdminServiciosComunes->SunasaTiposOperacionSeleccionarTodos();
        foreach ($cmbTipoOperacion as $row) {
            $row->id = $row->idOperacion;
            $row->text = $row->Operacion;
        }

        $cmbTipoAfiliacion = $this->mo_AdminServiciosComunes->SunasaTiposAfiliacionSeleccionarTodos();
        foreach ($cmbTipoAfiliacion as $row) {
            $row->id = $row->idAfiliacion;
            $row->text = $row->Afiliacion;
        }

        $cmbRegimen = $this->mo_AdminServiciosComunes->SunasaTiposRegimenSeleccionarTodos();
        foreach ($cmbRegimen as $row) {
            $row->id = $row->idRegimen;
            $row->text = $row->Regimen;
        }

        $cmbEstadoSeguro = [
            ['id' => 1, 'text' => 'Activo'],
            ['id' => 2, 'text' => 'Inactivo'],
        ];

        $cmbValidacionRegIden = [
            ['id' => 1, 'text' => 'SI'],
            ['id' => 2, 'text' => 'NO'],
        ];

        $data['cmbTipoOperacion'] = $cmbTipoOperacion;
        $data['cmbEstadoSeguro'] = $cmbEstadoSeguro;
        $data['cmbValidacionRegIden'] = $cmbValidacionRegIden;
        $data['cmbTipoAfiliacion'] = $cmbTipoAfiliacion;
        $data['cmbRegimen'] = $cmbRegimen;
        $data['cmbParentescoTitular'] = $cmbParentescoTitular;
        $data['dateHTML'] = date('Y-m-d');

        return $data;
    }

    private function getEdad($request)
    {
        $edad = calcularEdad($request->fechaNacimiento, null);
        return ['edad' => $edad];
    }

    // Consultar informacion en BD de datos o traer informacion de RENIEC

    private function apiConsultarDatosPaciente(Request $request)
    {
        $nroDocumento = $request->nro_documento;
        $objPaciente = Pacientes::where("NroDocumento", $nroDocumento)->first();
        // Hacer consulta en RENIEC si no existe datos del paciente
        if (!$objPaciente) {
            $datosReniec = new ConsultaReniecController();
            $datosReniec = $datosReniec->consultarPorNroDocumento($nroDocumento);
            $objPaciente = new Pacientes();
            $objPaciente->fill($datosReniec);
            $objPaciente->foto_base64 = $datosReniec["foto_base64"];
        }
        return $objPaciente;
    }


}