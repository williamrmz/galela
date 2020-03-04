<?php

namespace App\Http\Controllers\ConsultaExterna;

use App\Http\Controllers\ConsultaReniecController;
use App\Http\Requests\PacienteRequest;
use App\VB\SIGHDatos\HistoriasClinicas;
use App\VB\SIGHDatos\Pacientes;
use App\VB\SIGHDatos\SunasaPacientesHistoricos;
use Carbon\Carbon;
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


class PacienteController extends Controller
{
    const PATH_VIEW = 'consulta-externa.paciente.';
    private $mo_AdminArchivoClinico;
    private $mo_AdminServiciosGeograficos;
    private $mo_ReglasSISgalenhos;
    private $mo_AdminAdmision;
    private $lcBuscaParametro;
    private $oPaciente;                               // Objeto: Paciente
    private $oHistoria;
    private $oDOSunasaPacientesHistoricos;
    private $user;                                      // Variable que almacena información de usuario
    private $mi_Opcion;                                 // Opción a realizar: sghAgregar, etc...
    private $idListItem;
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
        $this->oDOSunasaPacientesHistoricos = new DoSunasaPacientesHistoricos;
        $this->user = null;
        $this->idListItem = 101; // Menu: 'Paciente'
        $this->mi_Opcion = 'sghAgregar';
        $this->errors = collect([]);

        $this->oPaciente = new Pacientes();
        $this->oHistoria = new HistoriasClinicas();
    }

    // :: Listado de pacientes en base a criterios de busqueda ::
    public function index(Request $request)
    {
        $origen = $request->origen;
        $origen = empty($origen)?"paciente":$origen;

        if ($request->ajax())
        {
            $NroHistoriaClinica = (int)trim($request->ftxtNroHistoria);
            $ApellidoPaterno = trim($request->ftxtApellidoPaterno);
            $ApellidoMaterno = trim($request->ftxtApellidoMaterno);
            $IdDocIdentidad = 1;
            $NroDocumento = trim($request->ftxtDni);

            if($origen=="paciente")
            {
                $items = Pacientes::Filtrar($NroHistoriaClinica, $ApellidoPaterno, $ApellidoMaterno, '', '',$IdDocIdentidad, $NroDocumento, '');
                return view(self::PATH_VIEW . 'partials.item-list', compact('items'));
            }
            else if($origen == "citas")
            {
                $items = Pacientes::Filtrar($NroHistoriaClinica, $ApellidoPaterno, $ApellidoMaterno, '', '',$IdDocIdentidad, $NroDocumento, '', 5);
                return view(self::PATH_VIEW . 'partials.item-list-citas', compact('items'));
            }
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
        try
        {
            DB::beginTransaction();
            $this->user = Auth::user();
            $this->mi_Opcion = 'sghAgregar';

            $this->ValidarDatosObligatorios($request);
            $this->fillFromRequest($request);
            $this->ucPacientesDetalleValidarReglas();

            // Generar número de historia
            if($this->oHistoria->IdTipoNumeracion == param('sghHistoriaDefinitivaAutomatica'))
            {
                $this->oHistoria->NroHistoriaClinica = HistoriasClinicas::GenerarNroHistoria($this->oHistoria->IdTipoNumeracion);
                $this->oPaciente->NroHistoriaClinica = $this->oHistoria->NroHistoriaClinica;
            }

            $this->GrabaImagenesEnRutaDelServidor($request->imagenPaciente, $request->foto_base64);
            $this->oPaciente->save();
            $this->oHistoria->IdPaciente = $this->oPaciente->IdPaciente;
            $this->oHistoria->save();

            // Guardar datos
            $nombrePaciente = "{$this->oPaciente->ApellidoPaterno} {$this->oPaciente->ApellidoMaterno} {$this->oPaciente->PrimerNombre}";
            AuditoriaAgregarVGood('A', $this->oPaciente->IdPaciente, $this->oPaciente->getTable(), $this->idListItem, $nombrePaciente);

            DB::commit();
            return imprimeJSON(true, "Registrado correctamente");
        } catch (\Exception $e) {
            DB::rollback();
            return imprimeJSON(false, $e->getMessage());
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

    // :: No actualiza datos relacionados a historias clínicas.
    public function update(Request $request, $id)
    {
        if (request()->ajax()) {
            $this->user = \Auth::user();
            $this->mi_Opcion = 'sghModificar';

            // :: Buscar paciente ::
            $validarDatos = $this->ValidarDatosObligatorios($request);

            if ($validarDatos->status == true)
            {
                $this->fillFromRequest($request);

                $validarReglas = $this->ValidarReglas();
                if ($validarReglas->status == true) {
                    DB::beginTransaction();
                    try {
                        $modificarDatos = $this->ModificarDatos();

                        if ($modificarDatos->status == true) {
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
        if (request()->ajax())
        {
            $errors = collect([]);
            $this->user = \Auth::user();
            $this->mi_Opcion = 'sghEliminar';

            $this->oPaciente = Pacientes::find($id);
            $this->oPaciente->idPaciente = $this->oPaciente->IdPaciente;
            $this->oPaciente->idUsuarioAuditoria = $this->user->id;

            DB::beginTransaction();
            try
            {
                $puedeEliminarse = $this->mo_AdminFacturacion->PacienteSePuedeEliminar($this->oPaciente->IdPaciente);
                if ($puedeEliminarse->respuesta == 1)
                {
                    // 1. Eliminar registros SUNASA
                    $regSunasaHistorico = SunasaPacientesHistoricos::where('idPaciente', $this->oPaciente->IdPaciente)->delete();

                    // 2. Eliminar historia clínica
                    $this->oHistoria = HistoriasClinicas::find($this->oPaciente->NroHistoriaClinica);


                    if ($this->oPaciente->IdTipoNumeracion == param('sghHistoriaDefinitivaManual')
                        || $this->oPaciente->IdTipoNumeracion == param('sghHistoriaDefinitivaAutomatica')
                        || $this->oPaciente->IdTipoNumeracion == param('sghHistoriaDefinitivaReciclada'))
                    {
                        $this->oHistoria->delete();
                    }

                    // 3. Eliminar paciente
                   $this->oPaciente->Eliminar($this->oPaciente->IdPaciente);

                    $nombrePaciente = "{$this->oPaciente->ApellidoPaterno} {$this->oPaciente->ApellidoMaterno} {$this->oPaciente->PrimerNombre}";
                    AuditoriaAgregarVGood('E', $this->oPaciente->IdPaciente, $this->oPaciente->getTable(), $this->idListItem, $nombrePaciente);

                    // 4. Agregar AuditoriaV

                    if ($this->oPaciente->fichaFamiliar == "")
                    {
                        $mensaje = "Los datos se eliminaron correctamente  \nN° Historia Clínica: " . trim($this->oPaciente->NroHistoriaClinica); //'JHIMI 09032018
                    } else
                    {
                        $mensaje = "Los datos se eliminaron correctamente \nFicha Familiar:" . $this->oPaciente->FichaFamiliar;

                    }
                    DB::commit();
                    return imprimeJSON(true, $mensaje);
                } else
                {
                    throw new \Exception("El paciente no se puede eliminar porque tiene atenciones registradas");
                }

            } catch (\Exception $e)
            {
                DB::rollback();
                return imprimeJSON(false, $e->getMessage());
            }


        }
    }

    public function EliminarDatos()
    {
        $errors = collect([]);

        $eliminar = $this->mo_AdminAdmision->PacientesEliminar(
            $this->oPaciente,
            $this->idListItem,
            nombrePc(),
            trim($this->oPaciente->apellidoPaterno) . " " . trim($this->oPaciente->apellidoMaterno) . " " . trim($this->oPaciente->primerNombre) . " " . trim($this->oPaciente->segundoNombre),
            $this->oDOSunasaPacientesHistoricos
        );

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
            $this->oPaciente,
            $this->oHistoria,
            $this->idListItem,
            nombrePc(),
            trim($this->oPaciente->apellidoPaterno) . " " . trim($this->oPaciente->apellidoMaterno) . " " . trim($this->oPaciente->primerNombre) . " " . trim($this->oPaciente->segundoNombre),
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
            $this->oPaciente,
            $this->oHistoria,
            request()->tipoNumeracionAnterior,
            $this->idListItem,
            nombrePc(),
            Trim($this->oPaciente->apellidoPaterno) . " " . Trim($this->oPaciente->apellidoMaterno) . " " . Trim($this->oPaciente->primerNombre) . " " . $this->oPaciente->segundoNombre,
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
        // 2. VALIDA DATOS DE PACIENTES
        if ($request->cmbIdTipoGenHistoriaClinica == '') {
            throw new \Exception("Ingrese el tipo de generacion de historia");
        } else {
            if ($request->cmbIdTipoGenHistoriaClinica == Enumerados::param('sghHistoriaDefinitivaManual') && trim($request->txtIdNroHistoria == "")) {
                throw  new \Exception("Ingrese el número de historia clínica");
            }
        }

        $pacienteNoIdentificado = false;

        if (!$pacienteNoIdentificado) {
            if (trim($request->txtApellidoPaterno) == "") {
                throw new \Exception("Ingrese el Apellido Paterno");
            } else if (Teclado::TextoAlmenosExisteAlgunaLetra($request->txtApellidoPaterno) == false && $this->wxSinApellido <> $request->txtApellidoPaterno) {
                throw new \Exception("El Apellido Paterno NO TIENE LETRA");
            }

            if (trim($request->txtApellidoMaterno) == "") {
                throw new \Exception("Ingrese el apellido materno");
            } else if (Teclado::TextoAlmenosExisteAlgunaLetra($request->txtApellidoMaterno) == false && $this->wxSinApellido <> $request->txtApellidoMaterno) {
                throw new \Exception("El Apellido Materno NO TIENE LETRA");
            }

            if (trim($request->txtPrimerNombre) == "") {
                throw new \Exception("Ingrese el primer nombre");
            } else if (Teclado::TextoAlmenosExisteAlgunaLetra($request->txtPrimerNombre) == false) {
                throw new \Exception("El Primer Nombre NO TIENE LETRA");
            }

            if ($request->txtFechaNacimiento == "") {
                throw new \Exception("Debe registrar la fecha de nacimiento");
            }

            // lnOpcionQueUsaEsteControl: 1->Pacientes, 2->Admision de Emergencia, 3->Admision de Hospitalizacion
            $lnOpcionQueUsaEsteControl = 0;

            if ($lnOpcionQueUsaEsteControl <> 1) {
                if ($request->cmbEtnia == "") {
                    throw new \Exception("Elija la ETNIA");
                }

                if ($request->cmbIdIdioma == "") {
                    throw new \Exception("Elija la IDIOMA");
                }
            }

            if ($request->txtEmail <> "") {
                if (Cadena::DevuelveARROBAS($request->txtEmail) == false) {
                    throw new \Exception("Debe haber un @ en el EMAIL");
                } else if (strlen($request->txtEmail) < 3) {
                    throw new \Exception("La longitud del Email no es adecuado");
                }
            }

            if ($wxParametro282 == "S" and $wxParametro333 == "S") {  //'solo para CS y que se exija el ingreso
                if (trim($request->txtSector) == "") {
                    throw new \Exception("Debe registrar el SECTOR (por ser un CS/PS)");
                }
                if (trim($request->lblSectorista) == "") {
                    throw new \Exception("Elija el SECTORISTA (por ser un CS/PS)");
                }
            }

            if ($request->cmbIdTipoSexo == 0) {
                throw new \Exception("Ingrese el sexo");
            }

        } else {
            if ($request->cmbIdTipoSexo == 0) {
                throw new \Exception("Ingrese el sexo");
            }
            if ((trim($request->txtEdad) == "" or $request->cboTipoEdadPaciente == "") and $request->chkNN == 1) {
                throw new \Exception("Ingrese una edad referencial del Paciente");
            }
        }

        if ($request->txtFechaCreacion == '') {
            throw new \Exception("Por favor ingrese la fecha de creación");
        }
    }

    private function fillFromRequest($request, $tempPaciente = null, $tempHistoria = null)
    {
        // :: Evita que al modificar se reemplacen estos valores
        $this->oPaciente = ($tempPaciente)?$tempPaciente:new Pacientes();
        if ($tempPaciente == null)
        {
            $this->oPaciente->IdTipoNumeracion = $request->cmbIdTipoGenHistoriaClinica;
            $this->oPaciente->NroHistoriaClinica = $request->txtIdNroHistoria;
        }
        $this->oPaciente->ApellidoPaterno = $request->txtApellidoPaterno;
        $this->oPaciente->ApellidoMaterno = $request->txtApellidoMaterno;
        $this->oPaciente->PrimerNombre = $request->txtPrimerNombre;
        $this->oPaciente->SegundoNombre = $request->txtSegundoNombre ?? '';
        $this->oPaciente->TercerNombre = $request->txtTercerNombre ?? '';
        $this->oPaciente->FechaNacimiento = Carbon::parse($request->txtFechaNacimiento)->format("Y-m-d\TH:i:s");
        $this->oPaciente->NroDocumento = $request->txtNroDocumento;
        $this->oPaciente->Telefono = $request->txtTelefono;
        $this->oPaciente->DireccionDomicilio = $request->txtDireccionDomicilio;
        $this->oPaciente->IdTipoSexo = $request->cmbIdTipoSexo;
        $this->oPaciente->IdProcedencia = $request->cmbIdProcedencia;
        $this->oPaciente->IdGradoInstruccion = $request->cmbIdGradoInstruccion;
        $this->oPaciente->IdEstadoCivil = $request->cmbIdEstadoCivil;
        $this->oPaciente->IdDocIdentidad = $request->cmbIdDocIdentidad;
        $this->oPaciente->IdTipoOcupacion = $request->cmbIdTipoOcupacion;
        $this->oPaciente->IdPaisNacimiento = $request->cmbIdPaisNacimiento;
        $this->oPaciente->IdDistritoNacimiento = $request->cmbIdDistritoNacimiento;
        $this->oPaciente->IdCentroPobladoNacimiento = $request->cmbIdCentroPobladoNacimiento;
        $this->oPaciente->IdPaisDomicilio = $request->cmbIdPaisDomicilio;
        $this->oPaciente->IdDistritoDomicilio = $request->cmbIdDistritoDomicilio;
        $this->oPaciente->IdCentroPobladoDomicilio = $request->cmbIdCentroPobladoDomicilio;
        $this->oPaciente->IdPaisProcedencia = $request->cmbIdPaisProcedencia;
        $this->oPaciente->IdDistritoProcedencia = $request->cmbIdDistritoProcedencia;
        $this->oPaciente->IdCentroPobladoProcedencia = $request->cmbIdCentroPobladoProcedencia;
        $this->oPaciente->Autogenerado = $this->mo_AdminAdmision->PacienteCrearNroAutogenerado($this->oPaciente->FechaNacimiento, $this->oPaciente->PrimerNombre, $this->oPaciente->SegundoNombre, $this->oPaciente->ApellidoPaterno, $this->oPaciente->ApellidoMaterno, $this->oPaciente->IdTipoSexo);
        $this->oPaciente->NombrePadre = $request->txtNombrePadre; // pasar a estado de desuso
        $this->oPaciente->NombreMadre = trim($request->txtMadreNombre . ' ' . $request->txtMadreSnombre);
        $this->oPaciente->IdEtnia = $request->cmbEtnia;
        $this->oPaciente->IdIdioma = $request->cmbIdIdioma;
        $this->oPaciente->UsoWebReniec = 0; //'mb_UsoWebReniec';
        $this->oPaciente->Email = $request->txtEmail;
        $this->oPaciente->NroOrdenHijo = $request->txtNroHijo;
        $this->oPaciente->madreTipoDocumento = $request->cmbMadreTipoDocumento;
        $this->oPaciente->madreDocumento = $request->txtMadreDocumento;
        $this->oPaciente->madreApellidoPaterno = $request->txtMadreApellidoP;
        $this->oPaciente->madreApellidoMaterno = $request->txtMadreApellidoM;
        $this->oPaciente->madrePrimerNombre = $request->txtMadreNombre;
        $this->oPaciente->madreSegundoNombre = $request->txtMadreSnombre;
        $this->oPaciente->Observacion = $request->txtObservacion;

        // 1.2. CARGA DATOS DE LA HISTORIA CLINICA
        $this->oHistoria = ($tempHistoria)?$tempHistoria:new HistoriasClinicas();
        $this->oHistoria->FechaCreacion = date('d-m-Y');
        $this->oHistoria->IdTipoNumeracion = $request->cmbIdTipoGenHistoriaClinica;
        $this->oHistoria->IdEstadoHistoria = 1;
        $this->oHistoria->IdTipoHistoria = 1;
    }

    private $mb_PacienteNoIdentificado = false;

    private $wxSinApellido = '*****';

    // ucPacientesDetalles
    private function ucPacientesDetalleValidarReglas()
    {
        if ($this->oPaciente->IdPaciente == null)
        {

            $rsPacientes = Pacientes::ObtenerConElMismoAutogenerado($this->oPaciente->Autogenerado, $this->oPaciente->IdPaciente);
            if (count($rsPacientes) > 0)
            {
                throw new \Exception("Existe un paciente con el mismo número autogenerado (HC: " . trim($rsPacientes[0]->NroHistoriaClinica) . ")");
            }

            if ($this->oPaciente->IdTipoNumeracion == Enumerados::param('sghHistoriaDefinitivaManual') ||
                $this->oPaciente->IdTipoNumeracion == Enumerados::param('sghHistoriaDefinitivaAutomatica') ||
                $this->oPaciente->IdTipoNumeracion == Enumerados::param('sghHistoriaDefinitivaReciclada')
            )
            {
                $rsPacientes = Pacientes::ObtenerConLaMismaHistoriaDefinitiva($this->oPaciente->NroHistoriaClinica, $this->oPaciente->IdPaciente);

                if (count($rsPacientes) > 0)
                {
                    throw new \Exception("Existe un paciente con el mismo número de historia clínica: " . $rsPacientes[0]->ApellidoPaterno . " " . $rsPacientes[0]->ApellidoMaterno . " " . $rsPacientes[0]->PrimerNombre);
                }
            }


            if ($this->oPaciente->IdDocIdentidad != "" and $this->oPaciente->NroDocumento <> "")
            {
                $rsPacientes = Pacientes::PacientesFiltraPorNroDocumentoYtipo($this->oPaciente->NroDocumento, $this->oPaciente->IdDocIdentidad);
                if (count($rsPacientes) > 0)
                {
                    throw new \Exception("El nro de documento: " . $this->oPaciente->IdDocIdentidad . ", ya existe para el Paciente: " . trim($rsPacientes[0]->NroHistoriaClinica) . " " . $rsPacientes[0]->ApellidoPaterno . " " . $rsPacientes[0]->ApellidoMaterno . " " . $rsPacientes[0]->PrimerNombre);
                }
            }

        } else
        {
            if ($this->oPaciente->IdDocIdentidad != "" and $this->oPaciente->NroDocumento <> "")
            {
                $rsPacientes = Pacientes::PacientesFiltraPorNroDocumentoYtipo($this->oPaciente->NroDocumento, $this->oPaciente->IdDocIdentidad);

                if (count($rsPacientes) > 0)
                {
                    foreach ($rsPacientes as $row)
                    {
                        if ($rsPacientes[0]->IdPaciente != $this->oPaciente->NroDocumento)
                        {
                            if (!is_null($rsPacientes[0]->NroHistoriaClinica))
                            {
                                throw new \Exception("Es N° DOCUMENTO ya existe para el Paciente: " . Trim($rsPacientes[0]->NroHistoriaClinica) . " " . $rsPacientes[0]->ApellidoPaterno . " " . $rsPacientes[0]->ApellidoMaterno . " " . $rsPacientes[0]->PrimerNombre);
                            } else
                            {
                                throw new \Exception("Es N° DOCUMENTO ya existe para el Paciente: " . $rsPacientes[0]->ApellidoPaterno . " " . $rsPacientes[0]->ApellidoMaterno . " " . $rsPacientes[0]->PrimerNombre);
                            }
                        }
                    }
                }
            }
        }

        $edad = Carbon::parse($this->oPaciente->FechaNacimiento)->age;
        if ($edad < 18 and $this->oPaciente->IdDocIdentidad <> "10" and ($this->oPaciente->NroDocumento == "" or $this->oPaciente->IdDocIdentidad == "8" or $this->oPaciente->IdDocIdentidad == "9") and $this->mi_Opcion <> 'sghEliminar' and $this->mb_PacienteNoIdentificado == false)
        {

            if ($this->oPaciente->madreDocumento == "")
            {
                if ($this->oPaciente->NroOrdenHijo == 0)
                {
                    throw new \Exception("El Paciente es MENOR DE EDAD, por favor debe registrar el N°HIJO y el DNI DE LA MADRE Si no tiene MADRE o TUTOR elegir en TIPO DOCUMENTO del PACIENTE= 10(Sin registro madre/tutor)");
                }
                if ($this->oPaciente->madreApellidoPaterno == "" or $this->oPaciente->madreApellidoMaterno == "" or $this->oPaciente->madrePrimerNombre == "")
                {
                    throw new \Exception("El Paciente es MENOR DE EDAD, por favor debe registrar El N° DNI de la MADRE o los APELLIDOS Y NOMBRES DE LA MADRE Si no tiene MADRE o TUTOR elegir en TIPO DOCUMENTO del PACIENTE= 10(Sin registro madre/tutor)");
                }
            } else if (len($this->oPaciente->madreDocumento) <> 8 and $this->oPaciente->madreTipoDocumento == "1")
            {
                throw new \Exception("El N° DNI de la MADRE tiene longitud diferente a OCHO");
            } else if ($this->oPaciente->NroOrdenHijo == 0)
            {
                throw new \Exception("El Paciente es MENOR DE EDAD, por favor debe registrar el N° HIJO Si no tiene MADRE o TUTOR elegir en TIPO DOCUMENTO del PACIENTE= 10(Sin registro madre/tutor)");
            }
        }

        //'
        if ($this->oPaciente->ApellidoMaterno == $this->wxSinApellido or $this->oPaciente->ApellidoPaterno == $this->wxSinApellido)
        {
            if (!(len($this->oPaciente->NroDocumento) == 8 and $this->oPaciente->IdDocIdentidad == "1"))
            {
                throw new \Exception("Debe registrar el DNI para que el Paciente tenga un solo apellido");
            }
        }
    }

    private function DevuelveFichaFamiliarUnida($request)
    {
        return Trim($request->txtFichaFamiliar1) . "-" . Trim($request->txtFichaFamiliar2) . "-" . Trim($request->txtFichaFamiliar3);
    }

    private function GrabaImagenesEnRutaDelServidor($imagenPaciente, $foto_base64)
    {
        $targetPath = public_path() . "\\storage\\images\\pacientes\\" . $this->oPaciente->idPaciente . ".jpeg";

        if ($imagenPaciente)
        {
            $filename = 'usuario.png';
            $sourcePath = $imagenPaciente->getRealPath();

            try {
                if (move_uploaded_file($sourcePath, $targetPath)) {
                    $uploadedFile = $filename;
                } else {
                    throw new \Exception("No se pudo cargar la imagen al servidor");
                }
            } catch (\Exception $e) {
                throw new \Exception($e->getMessage());
            }
        } else if (!empty($foto_base64) > 0)
        {
            // Mover de storage/app/pacientes al directorio path
            $recursoPath = Storage::disk('public')->path("images/pacientes/") . $this->oPaciente->nroDocumento . ".jpeg";
            $targetPath = Storage::disk('public')->path("images/pacientes/") . $this->oPaciente->idPaciente . ".jpeg";
            rename($recursoPath, $targetPath);
        }
    }

    // PacienteDetalle > CargarDatosAlosControles()
    private function traerTodosDatosPaciente()
    {
        $data['paciente'] = $this->cargarDatosPaciente();
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

    // Métodos API del servicio
    public function apiService(Request $request)
    {
        switch ($request->name) {
            case 'getData':
                return $this->getData($request);
                break;
            case 'getEdad':
                $fechaNacimiento = $request->fechaNacimiento;
                return $this->getEdadPaciente($fechaNacimiento);
                break;
            case 'get_by_nro_documento':
                return $this->apiConsultarDatosPaciente($request);
                break;
            default:
                return null;
        }
    }

    public function getData()
    {
        $data['forms'] = $this->getDataForms();
        return $data;

    }

    // Informacion para poblar Comboboxes
    private function getDataForms()
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

    public function getEdadPaciente($fechaNacimiento)
    {
        $edad = calcularEdad($fechaNacimiento, null);
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