<?php
namespace App\Http\Controllers\ConsultaExterna;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use App\VB\SIGHNegocios\ReglasArchivoClinico;
use App\VB\SIGHNegocios\ReglasComunes;
use App\VB\SIGHNegocios\ReglasServGeograf;
use App\VB\SIGHEntidades\Enumerados;
use App\VB\SIGHEntidades\Teclado;
use App\VB\SIGHEntidades\Cadena;
use App\VB\SIGHDatos\Parametros;
use App\VB\SIGHComun\DOCuentaAtencion;
use App\VB\SIGHComun\DOAtencion;
use App\VB\SIGHComun\DOCita;
use App\VB\SIGHComun\DoAtencionDatosAdicionales;
use App\VB\SIGHComun\DOPaciente;
use App\VB\SIGHSis\ReglasSISgalenhos;

class PacienteControllerCopy extends Controller
{
	const PATH_VIEW = 'consulta-externa.paciente.';

	private $mo_AdminArchivoClinico;
	
	private $mo_AdminServiciosGeograficos;
	
	private $mo_ReglasSISgalenhos;

	private $lcBuscaParametro;

	private $mo_CuentasAtencion;

	private $mo_Atenciones;

	private $mo_Cita;

	private $mo_DoAtencionDatosAdicionales;
	
	private $mo_Pacientes;

	public function __construct()
	{
		$this->mo_AdminArchivoClinico = new ReglasArchivoClinico;
		$this->mo_AdminServiciosComunes = new ReglasComunes;
		$this->mo_AdminServiciosGeograficos = new ReglasServGeograf;
		$this->mo_ReglasSISgalenhos = new ReglasSISgalenhos;
		$this->lcBuscaParametro = new Parametros;
		$this->mo_CuentasAtencion = new DOCuentaAtencion;
		$this->mo_Atenciones = new DOAtencion;
		$this->mo_Cita = new DOCita;
		$this->mo_Pacientes = new DOPaciente;
		$this->mo_DoAtencionDatosAdicionales = new DoAtencionDatosAdicionales;
	}

	public function index(Request $request)
	{
		if($request->ajax()) {
			$items = DB::table('empleados')->select('idEmpleado as id', 'Nombres as name')->paginate(10); //test data
			return view(self::PATH_VIEW.'partials.item-list', compact('items'));
		}
		return view(self::PATH_VIEW.'index');
	}

	public function create()
	{
		if(request()->ajax()) {
			return view(self::PATH_VIEW.'partials.item-create');
		}



		return view(self::PATH_VIEW.'create');
	}

	public function store(Request $request)
	{
		if(request()->ajax()) {

			$validar = $this->ValidarDatosObligatorios( $request );
			if ( $validar->status == true ){

				$this->CargaDatosAlObjetosDeDatos( 'sghAgregar', $request );

				if( ValidarReglas() ){

				}
			}else{
				// dd( $validar->errors );
				return ['success'=> $validar->status, 'message'=> arrayHTML($validar->errors) ];
			}
			return $request->all();
		}
	}

	public function show($id)
	{
		if(request()->ajax()) {
			//DataFake
			$item = DB::table('empleados')->where('idEmpleado', $id)
				->select('idEmpleado as id', 'Nombres as name')->first();

			return view(self::PATH_VIEW.'partials.item-show', compact('item'));
		}
	}

	public function edit($id)
	{
		if(request()->ajax()) {
			//DataFake
			$item = DB::table('empleados')->where('idEmpleado', $id)
				->select('idEmpleado as id', 'Nombres as name')->first();

			return view(self::PATH_VIEW.'partials.item-edit', compact('item'));
		}
	}

	public function update(Request $request, $id)
	{
		dd('Implementar logica para el metodo update');

		if(request()->ajax()) {
			$this->validate($request, [
				'field' => 'required',
			]);

			$success = false;

			//write your code...

			return ['success' => $success];
		}
	}

	public function delete($id)
	{
		if(request()->ajax()) {
			//DataFake
			$item = DB::table('empleados')->where('idEmpleado', $id)
				->select('idEmpleado as id', 'Nombres as name')->first();

			return view(self::PATH_VIEW.'partials.item-delete', compact('item'));
		}
	}

	public function destroy($id)
	{
		dd('Implementar logica para el metodo destroy');

		if(request()->ajax()) {
			
			// $this->validate($request, [
			// 	'field' => 'required',
			// ]);
			
			$success = false;

			//write your code...

			return ['success' => $success];
		}
	}

	private function ValidarDatosObligatorios($request)
	{

		$wxParametro282 = $this->lcBuscaParametro->SeleccionaFilaParametro(282);
		$wxParametro333 = $this->lcBuscaParametro->SeleccionaFilaParametro(333);

		$wxParametro282 = isset($wxParametro282[0])? strtoupper($wxParametro282[0]->ValorTexto): '';
		$wxParametro333 = isset($wxParametro333[0])? strtoupper($wxParametro333[0]->ValorTexto): '';

		$errors = collect([]);

		// 1. VALIDA DATOS DE LA ATENCION (no implementado)

		// 2. VALIDA DATOS DE PACIENTES

		// dd($request->all());
		if ($request->cmbIdTipoGenHistoriaClinica == '') {
			$errors->push("Ingrese el tipo de generacion de historia");
		}else {
			switch ( (int) $request->cmbIdTipoGenHistoriaClinica ) {
				case Enumerados::param('sghHistoriaTemporalCOnsultaExterna'): break;
				case Enumerados::param('sghHistoriaTemporalEmergencia'): break;
				case Enumerados::param('sghSinHistoria'): break;
				case Enumerados::param('sghHistoriaDefinitivaManual'): 
					if( trim($request->txtIdNroHistoria == "") ) $errors->push('Ingrese el número de historia clínica');
					break;
				default: break;
			}
		}

		$mb_PacienteNoIdentificado = false;
		$wxSinApellido = '***';

		if ( !$mb_PacienteNoIdentificado ) {
			
			if ( trim($request->txtApellidoPaterno) == "") {
				$errors->push('Ingrese el Apellido Paterno');
			}else if( Teclado::TextoAlmenosExisteAlgunaLetra($request->txtApellidoPaterno) == false && $wxSinApellido <> $request->txtApellidoPaterno){
				$errors->push('El Apellido Paterno NO TIENE LETRA');
			}
			
			if ( trim($request->txtApellidoMaterno) == "") {
				$errors->push('Ingrese el apellido materno');
			}else if( Teclado::TextoAlmenosExisteAlgunaLetra($request->txtApellidoMaterno) == false && $wxSinApellido <> $request->txtApellidoMaterno) {
				$errors->push('El Apellido Materno NO TIENE LETRA');
			}
			
			if ( trim($request->txtPrimerNombre) == "") {
				$errors->push('Ingrese el primer nombre');
			}else if( Teclado::TextoAlmenosExisteAlgunaLetra($request->txtPrimerNombre) == false) {
				$errors->push('El Primer Nombre NO TIENE LETRA');
			}

			// SOLO EN V7
			// if ( $request->chkSinFechaNacimiento == 1 ) {
			// 	if ($request->txtEdad == "" or $mo_cmbIdTipoEdad == "" ) {
			// 		$errors->push('Debe Ingresar una edad y un Tipo de Edad(Edad Actual)');
			// 	}else{
			// 		if( $request->txtEdad = 0 ) {
			// 			$errors->push('Edad ingresada debe ser mayor a cero');
			// 		}
			// 	}
			// }
			
			if ( $request->txtFechaNacimiento == "" ) {
				$errors->push('Debe registrar la FECHA DE NACIMIENTO');
			}
			
			// TODO: falta implementar html
			// if ( $request->txtHoraNacimiento == sighEntidades.HORA_VACIA_HM ) {
			// 	$request->txtHoraNacimiento = "00:00";
			// }

			// SOLO EN V7
			// if ( $mo_CmbIdTipoSexo == 0 ) {
			// 	$errors->push('Ingrese el sexo');
			// }

			// lnOpcionQueUsaEsteControl: 1->Pacientes, 2->Admision de Emergencia, 3->Admision de Hospitalizacion
			$lnOpcionQueUsaEsteControl = 0 ;

			if ( $lnOpcionQueUsaEsteControl <> 1 ) {
				if ( $request->cmbEtnia == "" ) {
					$errors->push('Elija la ETNIA');
				}
			}

			if ( $lnOpcionQueUsaEsteControl <> 1 ) {
				if ($request->cmbIdIdioma == "" ) {
					$errors->push('Elija la IDIOMA');
				}
			}

			if ($request->txtEmail <> "" ) {
				if( Cadena::DevuelveARROBAS($request->txtEmail) == false ) {
					$errors->push('Debe haber un @ en el EMAIL');
				}else if( strlen( $request->txtEmail ) < 3 ) {
					$errors->push('La longitud del Email no es adecuado');
				}
			}

			if ($wxParametro282 == "S" and $wxParametro333 == "S" ) {  //'solo para CS y que se exija el ingreso
				if ( trim($request->txtSector) == "" ) {
					$errors->push('Debe registrar el SECTOR (por ser un CS/PS)');
				}
				if ( trim($request->lblSectorista) == "" ) {
					$errors->push('Elija el SECTORISTA (por ser un CS/PS)');
				}
			}

			//NEW
			if ( $request->cmbIdTipoSexo == 0 ) {
				$errors->push('Ingrese el sexo');
			}

		} else {
			if ( $request->cmbIdTipoSexo == 0 ) {
				$errors->push('Ingrese el sexo');
			}
			if ( ( trim($request->txtEdad) == "" or $request->cboTipoEdadPaciente == "") and $chkNN == 1 ) {
				$errors->push('Ingrese una edad referencial del Paciente');
			}
		}

		// $request->txtFechaCreacion = '';
		// if ( $request->txtFechaCreacion == 'sighEntidades.FECHA_VACIA_DMY' ) {
		if ( $request->txtFechaCreacion == '' ) {
			$errors->push('Por favor ingrese la fecha de creación');
		}

		$data = jsonClass([
			'status' => count($errors)==0? true: false,
			'errors' => $errors,
		]);
		return $data;
	}

	private function CargaDatosAlObjetosDeDatos($mi_Opcion, $request)
	{

		// 1.CARGA DATOS DE LA CUENTA ATENCION
		switch( $mi_Opcion ){
			case 'sghAgregar'|| 'sghModificar'|| 'sghEliminar':
				$this->mo_CuentasAtencion->idCuentaAtencion = $request->idCuentaAtencion;
				$this->mo_CuentasAtencion->idPaciente = $request->idPaciente;
				$this->mo_CuentasAtencion->totalAsegurado = 0;
				$this->mo_CuentasAtencion->totalExonerado = 0;
				$this->mo_CuentasAtencion->totalPagado = 0;
				$this->mo_CuentasAtencion->totalPorPagar = 0;
				$this->mo_CuentasAtencion->WCG = '10/06';
				$this->mo_CuentasAtencion->fechaApertura = $request->txtFechaIngreso;
				$this->mo_CuentasAtencion->horaApertura = $request->txtHoraInicio;
				$this->mo_CuentasAtencion->fechaCierre = 0;
				$this->mo_CuentasAtencion->horaCierre = "";
				$this->mo_CuentasAtencion->idUsuarioAuditoria = \Auth::user()->id;
				$this->mo_CuentasAtencion->idEstado = Enumerados::param('sghEstadoCuenta.sghAbierto');
				break;
			default: break;
		}

		// 2. CARGA DATOS DE LA ATENCION
		$this->mo_Atenciones->idAtencion = $request->idAtencion;
		$this->mo_Atenciones->idEspecialidadMedico = $request->mo_cmbIdEspecialidadMedico;
		$this->mo_Atenciones->idMedicoIngreso = $request->idMedico;
		$this->mo_Atenciones->idServicioIngreso = (int) $request->mo_cmbIdServicio;
		$this->mo_Atenciones->idOrigenAtencion = (int) $request->mo_cmbIdViasAdmision;
		$this->mo_Atenciones->horaIngreso = $request->txtHoraInicio;
		$this->mo_Atenciones->fechaIngreso = $request->txtFechaIngreso;
		$this->mo_Atenciones->idTipoServicio = $request->mo_cmbIdTipoServicio;
		$this->mo_Atenciones->edad = $request->txtEdadEnDias;
		$this->mo_Atenciones->idTipoEdad = $request->mo_cmbIdTipoEdad;
		$this->mo_Atenciones->idPaciente = $request->idPaciente;
		$this->mo_Atenciones->idMedicoEgreso = 0;
		$this->mo_Atenciones->horaEgreso = "";
		$this->mo_Atenciones->hechaEgreso = 0;
		if ( $request->chkPacienteNuevo == 1) {
			$this->mo_Atenciones->idTipoCondicionALEstab = 1;
			$this->mo_Atenciones->idTipoCondicionAlServicio = 1;
		}else{
			if ( $mi_Opcion == 'sghAgregar') {
				$lnIdCondicionAlServicio; $lnIdCondicionAlEstablecimiento;
				$this->mo_AdminServiciosComunes->TiposCondicionPacienteCondicionAlEstablecimientoYservicio(
					$lnIdCondicionAlEstablecimiento, 
					$lnIdCondicionAlServicio, 
					$request->idPaciente, 
					dateFormat($request->txtFechaIngreso, 'd-m-Y'), 
					$request->idAtencion, 
					$request->mo_cmbIdServicio);

				$this->mo_Atenciones->idTipoCondicionALEstab = $lnIdCondicionAlEstablecimiento;
				$this->mo_Atenciones->idTipoCondicionAlServicio = $lnIdCondicionAlServicio;
			}
		}
		$this->mo_Atenciones->IdTipoGravedad = 0;
		$this->mo_Atenciones->IdUsuarioAuditoria = 'ml_IdUsuario';
		$this->mo_Atenciones->IdFormaPago = (int) $request->mo_cmbIdFormaPago;
		$this->mo_Atenciones->IdFuenteFinanciamiento = (int) $request->mo_cmbIdFuentesFinanciamiento;
		$this->idFormaPagoProvisional = (int) $request->mo_cmbIdFormaPag;
		$this->mo_Atenciones->IdEstadoAtencion = Enumerados::param('sghEstadoTabla.sghRegistrado');

		// 3. CARGA DATOS DE LA CITA
		$this->mo_Cita->idCita = $request->idCita;
		$this->mo_Cita->fecha = $request->txtFechaIngreso;
		$this->mo_Cita->horaInicio = $request->txtHoraInicio;
		$this->mo_Cita->horaFin = $request->txtHoraFin;
		$this->mo_Cita->idMedico = $request->idMedico;
		$this->mo_Cita->idEspecialidad = $request->mo_cmbIdEspecialidadMedico;
		$this->mo_Cita->idPaciente = $request->idPaciente;
		//'$this->mo_Cita.IdServicio = 154
		$this->mo_Cita->idServicio = $request->mo_cmbIdServicio;
		$this->mo_Cita->idEstadoCita = 1;    //'CITA SEPARADA
		$this->mo_Cita->idAtencion = $request->idAtencion;
		$this->mo_Cita->idProgramacion = $request->idProgramacion;
		$this->mo_Cita->idProducto = $request->mo_cmbIdTipoConsulta;
		$this->mo_Cita->idUsuarioAuditoria = 'ml_IdUsuario';
		if ($mi_Opcion == 'sghAgregar') {
			$this->mo_Cita->fechaSolicitud = date('d-m-Y');
			$this->mo_Cita->horaSolicitud = date('H:i');
		}
		$this->mo_Cita->horaSolicitud = $this->mo_Cita->horaSolicitud;
		$this->mo_Cita->fechaSolicitud = $this->mo_Cita->fechaSolicitud;
		$this->mo_Cita->esCitaAdicional = 'mo_lbEsCitaAdicional';

		

		// 4. CARGA DATOS DEL PACIENTE
		// Me.ucPacientesDetalle1.IdUsuario = ml_IdUsuario
		// Me.ucPacientesDetalle1.CargarDatosAlObjetoDatos mo_Pacientes, mo_Historia, mo_DoPacientesDatosAdd
		
		// 5. COMPLETA LOS DATOS DE LA ATENCION
        $this->mo_DoAtencionDatosAdicionales->idTipoReferenciaOrigen = $request->mo_cmbIdTipoReferenciaOrigen;
        if ( $this->mo_DoAtencionDatosAdicionales->idTipoReferenciaOrigen == 1) {
            $this->mo_DoAtencionDatosAdicionales->idEstablecimientoOrigen = $request->txtIdEstablecimientoOrigen;
            $this->mo_DoAtencionDatosAdicionales->idEstablecimientoNoMinsaOrigen = 0;
		} else {
            $this->mo_DoAtencionDatosAdicionales->idEstablecimientoOrigen = 0;
            $this->mo_DoAtencionDatosAdicionales->idEstablecimientoNoMinsaOrigen = $request->txtIdEstablecimientoOrigen;
		}
		$this->mo_DoAtencionDatosAdicionales->nroReferenciaOrigen = $request->txtReferenciaO;
        $this->mo_DoAtencionDatosAdicionales->direccionDomicilio = $this->mo_Pacientes->direccionDomicilio;
        if ($mi_Opcion == 'sghAgregar' or $mi_Opcion == 'sghModificar' ) {

			$request->mo_cmbIdFuentesFinanciamiento = 3;
			$lnAfiliacionSIS4 = 0;

           	if ($request->mo_cmbIdFuentesFinanciamiento == Enumerados::param('sghFuenteFinanciamiento.sghFFSIS') ) {
                if ($lnAfiliacionSIS4 == 0 ) {
                   	$this->mo_ReglasSISgalenhos->SisFiliacionesDevuelveKEY ($lnAfiliacionSIS4, $lcSIScodigo,
                                        $this->mo_Pacientes->apellidoPaterno, $this->mo_Pacientes->apellidoMaterno,
                                        $this->mo_Pacientes->primerNombre, $this->mo_Pacientes->fechaNacimiento,
                                        $lcCodigoEstablecimientoAdscripcionSIS);
				}
                $this->mo_DoAtencionDatosAdicionales->idSiasis = $lnAfiliacionSIS4;
                $this->mo_DoAtencionDatosAdicionales->sisCodigo = $lcSIScodigo;
				//'If wxParametro302 = "S" And Me.ucSISfuaCodPrestacion1.CodigoPrestacion <> "" Then
				//	'.fuacodigoprestacion = Me.ucSISfuaCodPrestacion1.CodigoPrestacion
				//'End If

				dd( 'Good Day!');
				dd( $this->mo_DoAtencionDatosAdicionales );

				if ($wxParametro302 == "S") {
					$oRscodPrestacion = $this->mo_AdminAdmision->ObtenerCodPrestacionCE($this->mo_Atenciones->idServicioIngreso);
					if (count($oRscodPrestacion) > 0) {
						//'.FuaCodigoPrestacion = Me.ucSISfuaCodPrestacion1.CodigoPrestacion
						$this->mo_DoAtencionDatosAdicionales->fuaCodigoPrestacion = is_null($oRscodPrestacion[0]->FuaCodigoPrestacion)? "": $oRscodPrestacion[0]->FuaCodigoPrestacion;
					}else{
						$this->mo_DoAtencionDatosAdicionales->fuaCodigoPrestacion = "";
					}
				} else {
					$this->mo_DoAtencionDatosAdicionales->idSiasis = 0;
					$this->mo_DoAtencionDatosAdicionales->fuaCodigoPrestacion = "";
					$this->mo_DoAtencionDatosAdicionales->sisCodigo = "";
				}
			}
		}


		dd($this->mo_Cita);
		
	}


	private function ValidarReglas()
	{
		
		return true;
	}




	public function apiService(Request $request)
	{
		switch($request->name)
		{
			case 'getDataCombos':
				return $this->getDataCombos( $request );
			default:
				return null;
		}
	}

	private function getDataCombos( $request )
	{
		// ConfigurarComboBoxes()
		$cmbIdTipoGenHistoriaClinica = $this->mo_AdminArchivoClinico->TiposGeneracionHistoriasSeleccionarTodos();
		foreach($cmbIdTipoGenHistoriaClinica as $row){
			$row->id = $row->IdTipoNumeracion;
			$row->text = $row->DescripcionLarga;
		}

		$cmbIdTipoSexo = $this->mo_AdminServiciosComunes->TiposSexoSeleccionarTodos();
		foreach($cmbIdTipoSexo as $row){
			$row->id = $row->IdTipoSexo;
			$row->text = $row->DescripcionLarga;
		}

		$cmbIdProcedencia = $this->mo_AdminServiciosComunes->TiposProcedenciaTodos();
		foreach($cmbIdProcedencia as $row){
			$row->id = $row->IdProcedencia;
			$row->text = $row->dCorto;
		}

		$cmbIdGradoInstruccion = $this->mo_AdminServiciosComunes->TiposGradosInstruccionTodos();
		foreach($cmbIdGradoInstruccion as $row){
			$row->id = $row->IdGradoInstruccion;
			$row->text = $row->dCorto;
		}

		$cmbIdEstadoCivil = $this->mo_AdminServiciosComunes->TiposEstadoCivilTodos();
		foreach($cmbIdEstadoCivil as $row){
			$row->id = $row->IdEstadoCivil;
			$row->text = $row->dCorto;
		}

		//PROC NO EXISTE
		// $cmbIdDocIdentidad = $this->mo_AdminServiciosComunes->TiposDocIdentidadSeleccionarTodosIncSinTipoDoc();
		$cmbIdDocIdentidad = $this->mo_AdminServiciosComunes->TiposDocIdentidadSeleccionarTodos();
		foreach($cmbIdDocIdentidad as $row){
			$row->id = $row->IdDocIdentidad;
			$row->text = $row->DescripcionLarga;
		}

		$cmbIdTipoOcupacion = $this->mo_AdminServiciosComunes->TiposOcupacionTodos();
		foreach($cmbIdTipoOcupacion as $row){
			$row->id = $row->IdTipoOcupacion;
			$row->text = $row->dCorto;
		}

		$cmbIdPais = $this->mo_AdminServiciosGeograficos->PaisesSeleccionarTodos();
		foreach($cmbIdPais as $row){
			$row->id = $row->IdPais;
			$row->text = $row->Nombre;
		}

		$cmbIdDepartamento = $this->mo_AdminServiciosGeograficos->DepartamentosSeleccionarTodos();
		foreach($cmbIdDepartamento as $row){
			$row->id = $row->IdDepartamento;
			$row->text = $row->Nombre;
		}

		$cmbIdEtnia = $this->mo_AdminServiciosComunes->EtniaHISseleccionarTodos();
		foreach($cmbIdEtnia as $row){
			$row->id = $row->codetni;
			$row->text = $row->dCorto;
		}

		$cmbIdIdioma = $this->mo_AdminServiciosComunes->TiposIdiomasSeleccionarTodos();
		foreach($cmbIdIdioma as $row){
			$row->id = $row->IdIdioma;
			$row->text = $row->dCorto;
		}

		$cmbIdIdTipoEdad = $this->mo_AdminServiciosComunes->TiposEdadSeleccionarTodos();
		foreach($cmbIdIdTipoEdad as $row){
			$row->id = $row->IdTipoEdad;
			$row->text = $row->DescripcionLarga;
		}

		//PROC NO EXISTE
		// $cmbReligion = $this->mo_AdminServiciosComunes->ReligionListarTodos();
		// dd($cmbReligion);
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
		foreach($cmbParentescoTitular as $row){
			$row->id = $row->idParentesco;
			$row->text = $row->Parentesco;
		}

		$cmbTipoOperacion = $this->mo_AdminServiciosComunes->SunasaTiposOperacionSeleccionarTodos();
		foreach($cmbTipoOperacion as $row){
			$row->id = $row->idOperacion;
			$row->text = $row->Operacion;
		}

		$cmbTipoAfiliacion = $this->mo_AdminServiciosComunes->SunasaTiposAfiliacionSeleccionarTodos();
		foreach($cmbTipoAfiliacion as $row){
			$row->id = $row->idAfiliacion;
			$row->text = $row->Afiliacion;
		}

		$cmbRegimen = $this->mo_AdminServiciosComunes->SunasaTiposRegimenSeleccionarTodos();
		foreach($cmbRegimen as $row){
			$row->id = $row->idRegimen;
			$row->text = $row->Regimen;
		}

		$cmbEstadoSeguro = [
			['id'=>1, 'text'=>'Activo'],
			['id'=>2, 'text'=>'Inactivo'],
		];

		$cmbValidacionRegIden = [
			['id'=>1, 'text'=>'SI'],
			['id'=>2, 'text'=>'NO'],
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

}