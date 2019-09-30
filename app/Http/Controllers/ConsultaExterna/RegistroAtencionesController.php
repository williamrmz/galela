<?php
namespace App\Http\Controllers\ConsultaExterna;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;


use App\VB\SIGHNegocios\ReglasComunes;
use App\VB\SIGHNegocios\ReglasAdmision;
use App\VB\SIGHNegocios\ReglasDeProgMedica;
use App\VB\SIGHNegocios\ReglasFacturacion;
use App\VB\SIGHEntidades\Enumerados;
use App\VB\SIGHComun\doPaciente;


class RegistroAtencionesController extends Controller
{
	const PATH_VIEW = 'consulta-externa.registro-atenciones.';

	private $mo_AdminServiciosComunes;
	private $mo_AdminAdmision;
	private $mo_AdminProgramacionMedica;

	private $ml_idCuentaAtencion;


	private $oRsFiltrados;

	public function __construct()
	{
		$this->mo_AdminServiciosComunes = new ReglasComunes;
		$this->mo_AdminAdmision = new ReglasAdmision;
		$this->mo_AdminProgramacionMedica = new ReglasDeProgMedica;
		$this->mo_AdminFacturacion = new ReglasFacturacion;
		$this->ml_idCuentaAtencion = 0;

		$oRsFiltrados = [];
	}

	public function index(Request $request)
	{
		$lcEspecialidadesDelUsuario = "";
		// mo_cmbIdResponsable.RowSource
		$cmbIdResponsable = $this->mo_AdminAdmision->DevuelveServiciosDelHospital("(1)", $lcEspecialidadesDelUsuario, Enumerados::param('sghFiltraAnuladosYactivos'), Enumerados::param('sghPorDescTipoServicio'));
		// btnTodosLosServicios.Visible = False
		if($request->ajax()) {
			//ucAdmisionLista
			$request->fDni = trim($request->fDni);
			$request->fHistoria = trim($request->fHistoria);
			$request->fCuenta = trim($request->fCuenta);
			$request->fApellidoPatern = trim($request->fApellidoPaterno);
			$request->fFechaIngreso = trim($request->fFechaIngreso);
			$request->fIdServicio = trim($request->fIdServicio);

			$validatorMessage = $this->validarFiltro($request);
			if( $validatorMessage != "" ) return response(['alert_type'=>'WARNING', 'alert_message'=> $validatorMessage], 400);
			
			$fecha = $request->fFechaIngreso=='' ? 'TODAS': $request->fFechaIngreso;
			// dd($idResponsable);
			$this->oRsFiltrados = $this->mo_AdminAdmision->AtencionesSeleccionarCEPorCuentaPorHistoriaPorApellidosPorServicio(
				$request->fHistoria,
				$request->fCuenta,
				$request->fApellidoPatern,
				$fecha,
				$request->fIdServicio,
				$request->fDni);

			$this->mo_cmbIdResponsable = $request->fIdServicio;

			$this->FiltraCeMarcandoLosQueNoPagaron();
			// dd($this->oRsFiltrados);

			return view(self::PATH_VIEW.'partials.item-list', ['items'=>$this->oRsFiltrados]);
		}
		return view(self::PATH_VIEW.'index', compact('cmbIdResponsable'));
	}


	private $wxSinApellido = 0;
	private $mo_cmbIdResponsable = 1;
	private $ml_TipoFiltro = 10; //filtro de consulta externa


	public function validarFiltro( $request )
	{
		$message = "";

		// if ($request->soloPacientesSinAltaMedica == true) {
        //     if( $request->fIdServicio == "") {
        //         $message = "Por favor elija el SERVICIO ";
		// 	}
		// }else{
		// 	if ($request->fCuenta == "" and $request->fHistoria == "" 
		// 		and $request->fApellidoPaterno == "" and $request->fDni == ""){
		// 			$message = "Por favor elija N°Cuenta, Historia, Ap.Paterno, DNI. ";
		// 	}
		// }

		if ($request->fIdServicio == ""){
			$message .= "Seleecione un servicio";
		}

		return $message;
	}

	private function FiltraCeMarcandoLosQueNoPagaron()
	{
		$listaTmp = collect([]);
		// dd($this->oRsFiltrados ); // 3948

		$oRsFiltradosTmp = [];
		if( $this->wxSinApellido ){
			// $this->oRsFiltrados =  $this->oRsFiltrados = array_filter( $this->oRsFiltrados, function( $element ) {
			// 	return $element->idEstadoAtencion <> 0 and $element->ApellidoPaterno=="";
			// });
		}else{
			$this->oRsFiltrados = array_filter( $this->oRsFiltrados, function( $element ) {
				return $element->idEstadoAtencion <> 0;
			});
			// $this->oRsFiltrados = $this->oRsFiltrados->filter( function ($element, $key){
			// 	return $element->idEstadoAtencion <> 0;
			// });
		}

		$this->oRsFiltrados = buildDataPagination($this->oRsFiltrados, 10, request());
		// dd($this->oRsFiltrados );


		if( count($this->oRsFiltrados) > 0 ){
			$oRsTmp=[]; $oRsTmp1=[]; $oRsTmp2=[];  $oRsTmp3=[];
			$lcPago = ""; $lcPasoTriaje="";
			$lbContinuar =false;
			$lbElServicioEsCostoCero = false;
			$lnNroRegistrosTriaje =0; $lnNroRegistrosPagantes = 0;
			$lbElServicioEsCostoCero = $this->mo_AdminAdmision->EsServicioCostoCero( $this->mo_cmbIdResponsable );

			$lIdServicioAtencion = 0;
			$dFechaIngresoAtencion = 0;
			foreach( $this->oRsFiltrados as $key => $oRsFiltradosFields)
			{
				
				// dd($oRsFiltradosFields->FechaIngreso);// "14/04/2015"
				//'actualizado 20140919
				if ($lIdServicioAtencion <> $oRsFiltradosFields->IdServicioIngreso || $dFechaIngresoAtencion <> 0) {

					$oRsTmp1 = $this->mo_AdminAdmision->atencionesCExServicio($oRsFiltradosFields->IdServicioIngreso, $oRsFiltradosFields->FechaIngreso, 'sighExterna');
					$lnNroRegistrosTriaje = count($oRsTmp1);

					$oRsTmp2 = $this->mo_AdminAdmision->AtencionesParaAtencionPagantesDelMedico($oRsFiltradosFields->IdServicioIngreso, $oRsFiltradosFields->FechaIngreso);
					$lnNroRegistrosPagantes = count($oRsTmp2);

					$lIdServicioAtencion = $oRsFiltradosFields->IdServicioIngreso;
					$dFechaIngresoAtencion = $oRsFiltradosFields->FechaIngreso;
				}

				//'El usuario es un MEDICO, por lo tanto solo mostrar� sus pacientes
				
				$lbContinuar = true;
				$lnIdUsuarioMedico = 0; //TODO
				$ldFechaActualServidor = '2019-09-02'; //TODO
				if ($lnIdUsuarioMedico > 0) {
					if ( $lnIdUsuarioMedico <> $oRsFiltradosFields->IdMedicoIngreso){
						$lbContinuar = false;
					}
				}
				//'solo se atienden las cuentas con fechas menores o iguales a HOY
				if ($ldFechaActualServidor < $oRsFiltradosFields->FechaIngreso){
					$lbContinuar = false;
				}

				// dd( $lbContinuar );
				if( $lbContinuar ){
					$lcPago = "";
					//TODO: eliminar linea siguiente
					// $oRsFiltradosFields->GeneraPago = 1;
					// dd($oRsFiltradosFields->GeneraPago);
					if ($oRsFiltradosFields->GeneraPago == 1) {
						
						if ($lbElServicioEsCostoCero == false) {
							// dd($oRsTmp2);
							if ($lnNroRegistrosPagantes > 0) {
								
								// If lnNroRegistrosPagantes > 0 Then
								// 	oRsTmp2.MoveFirst
								// 	oRsTmp2.Find "idCuentaAtencion=" & oRsFiltrados.Fields!nrocuenta
								// 	If oRsTmp2.EOF Then
								// 		lcPago = "No Pag�"
								// 	ElseIf oRsTmp2.Fields!idestadofacturacion <> 4 Then
								// 		lcPago = "No Pag�"
								// 	End If
								// Else
								// 	lcPago = "No Pag�"
								// End If

								$key = array_search($oRsFiltradosFields->NroCuenta, array_column($oRsTmp2, 'idCuentaAtencion'));
								// dd( $key );
								if( $key == false){
									$lcPago = "No Pago";
								}else if( $oRsTmp2[$key]->IdEstadoFacturacion <> 4){
									$lcPago = "No Pago";
								}
							}else{
								$lcPago = "No Pago";
							}
						}
					}
					// dd($lcPago);

					if ($lcPago <> "") {
						$oRsTmp3 = $this->mo_AdminFacturacion->FacturacionPaquetesCEporIdPuntoCargaNrocuentaIdEspecialidad($oRsFiltradosFields->NroCuenta, $oRsFiltradosFields->idEspecialidad, 6);
						if ( count($oRsTmp3) > 0 ){
							$lcPago = "";
						}
					}
					// dd($lcPago);
					
					// 'paso por Triaje
					$lcPasoTriaje = "No";
					if ($lnNroRegistrosTriaje == 0) {
						// oRsTmp1.Find "idAtencion=" & oRsFiltrados.Fields!IdAtencion
						// If (Not oRsTmp1.EOF) And (Not IsNull(oRsTmp1.Fields!TriajeFecha)) Then
						// 	lcPasoTriaje = ""
						// End If
						$keyFind = array_search($oRsFiltradosFields->IdAtencion, $oRsTmp1, false);

						if( $keyFind !== false  and !is_null($oRsTmp1[$keyFind]->TriajeFecha) ){
							$lcPasoTriaje = "";
						}
					}
					// dd($lcPasoTriaje);

				
				}

				$oRsFiltradosFields->idTipoServicio = 1;
				$oRsFiltradosFields->idCuentaAtencion = $oRsFiltradosFields->NroCuenta;
				$oRsFiltradosFields->NroHistoriaClinica = is_null( $oRsFiltradosFields->NroHistoriaClinica)? "": $oRsFiltradosFields->NroHistoriaClinica;
				$oRsFiltradosFields->idTipoServicio = is_null($oRsFiltradosFields->FecNacim)? "01/01/1900": $oRsFiltradosFields->FecNacim;
				$oRsFiltradosFields->ServicioActual = $lcPasoTriaje;
				$oRsFiltradosFields->IdEstadoAtencion = $oRsFiltradosFields->idEstadoAtencion;
				$oRsFiltradosFields->PagoConsulta = $lcPago;
				$oRsFiltradosFields->IdCita = is_null($oRsFiltradosFields->IdCita)? 0: $oRsFiltradosFields->IdCita;
				if ($this->ml_TipoFiltro == Enumerados::param('sghFiltrarConsultaExterna') ) {
					$oRsFiltradosFields->FichaFamiliar = is_null($oRsFiltradosFields->FichaFamiliar)? "": $oRsFiltradosFields->FichaFamiliar;
				}

				// $listaTmp->push( $oRsFiltradosFields );

				
				// dd($this->oRsFiltrados[$key]);

				// $oRsFiltradosConPagoConsultaFields = new \stdClass;
				// $oRsFiltradosConPagoConsultaFields->idTipoServicio = 1;//
                // $oRsFiltradosConPagoConsultaFields->IdPaciente = $oRsFiltradosFields->IdPaciente;
                // $oRsFiltradosConPagoConsultaFields->idCuentaAtencion = $oRsFiltradosFields->NroCuenta;
                // $oRsFiltradosConPagoConsultaFields->IdAtencion = $oRsFiltradosFields->IdAtencion;
                // $oRsFiltradosConPagoConsultaFields->ApellidoPaterno = $oRsFiltradosFields->ApellidoPaterno;
                // $oRsFiltradosConPagoConsultaFields->ApellidoMaterno = $oRsFiltradosFields->ApellidoMaterno;
                // $oRsFiltradosConPagoConsultaFields->PrimerNombre = $oRsFiltradosFields->PrimerNombre;
				// $oRsFiltradosConPagoConsultaFields->SegundoNombre = $oRsFiltradosFields->SegundoNombre;
                // $oRsFiltradosConPagoConsultaFields->NroHistoriaClinica = is_null( $oRsFiltradosFields->NroHistoriaClinica)? "": $oRsFiltradosFields->NroHistoriaClinica; //'JHIMI 13032018 cambia el valor por defecto
                // $oRsFiltradosConPagoConsultaFields->FecNacim = is_null($oRsFiltradosFields->FecNacim)? "01/01/1900": $oRsFiltradosFields->FecNacim; //'Actualizado 22092014
                // $oRsFiltradosConPagoConsultaFields->FechaIngreso = $oRsFiltradosFields->FechaIngreso;
                // $oRsFiltradosConPagoConsultaFields->HoraIngreso = $oRsFiltradosFields->HoraIngreso;
                // //'oRsFiltradosConPagoConsulta.Fields!FechaEgreso = oRsFiltrados.Fields!FechaEgreso
                // $oRsFiltradosConPagoConsultaFields->HoraEgreso = $oRsFiltradosFields->HoraEgreso;
                // $oRsFiltradosConPagoConsultaFields->ServicioActual = $lcPasoTriaje;
				// $oRsFiltradosConPagoConsultaFields->Edad = $oRsFiltradosFields->Edad;
                // //'oRsFiltradosConPagoConsulta.Fields!IdTipoNumeracion = oRsFiltrados.Fields!IdTipoNumeracion
                // $oRsFiltradosConPagoConsultaFields->IdServicioIngreso = $oRsFiltradosFields->IdServicioIngreso;
				// $oRsFiltradosConPagoConsultaFields->TipoNumeracion = $oRsFiltradosFields->TipoNumeracion;
                // //'oRsFiltradosConPagoConsulta.Fields!FechaEgresoAdministrativo = oRsFiltrados.Fields!FechaEgresoAdministrativo
                // //'oRsFiltradosConPagoConsulta.Fields!HoraEgresoAdministrativo = oRsFiltrados.Fields!HoraEgresoAdministrativo
				// //'oRsFiltradosConPagoConsulta.Fields!Plan = oRsFiltrados.Fields!Plan
                // $oRsFiltradosConPagoConsultaFields->IdEstadoAtencion = $oRsFiltradosFields->idEstadoAtencion;
                // $oRsFiltradosConPagoConsultaFields->PagoConsulta = $lcPago;
				// $oRsFiltradosConPagoConsultaFields->IdCita = is_null($oRsFiltradosFields->IdCita)? 0: $oRsFiltradosFields->IdCita;
				// // dd($oRsFiltradosFields);
				// // dd($oRsFiltradosConPagoConsultaFields);
				// // TODO
                // if ($this->ml_TipoFiltro == Enumerados::param('sghFiltrarConsultaExterna') ) {
                //    $oRsFiltradosConPagoConsultaFields->FichaFamiliar = is_null($oRsFiltradosFields->FichaFamiliar)? "": $oRsFiltradosFields->FichaFamiliar;
				// }
				// $listaTmp->push( $oRsFiltradosConPagoConsultaFields );
				
			}
		}
		return true;
	}

	public function create()
	{
		if(request()->ajax()) {
			return view(self::PATH_VIEW.'partials.item-create');
		}
	}

	public function store(Request $request)
	{
		dd('Implementar logica para el metodo store');

		if(request()->ajax()) {
			$this->validate($request, [
				'field' => 'required',
			]);

			$success = false;

			//write your code...

			return ['success' => $success];
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

	public function apiService(Request $request)
	{
		switch($request->name)
		{
			case 'getItemData':
				return $this->getItemData( $request );
			case 'getBuscarDiagnosticoControl':
				return $this->getBuscarDiagnosticoData( $request );
			default:
				return null;
		}
	}

	private function getBuscarDiagnosticoData( $request )
	{
		return 'getBuscarDiagnosticoData';
	}

	private function getItemData( $request )
	{


		$empleado = [
			'id_empleado' => 738,
			'nombres' => 'Juan Carlos Corcuera Mondragon',
		];

		$triaje = [
			'presion' => 90,
			'temperatura' => 37,
			'peso' => 70,
			'talla' => 170,
			'pulso' => 150,
			'frecuencia_respiratoria' => 60
		];

		$examenes = [
			'antecedentes_quirurgicos' => 'antecedentes_quirurgicos_data',
			'antecedentes_alergias' => 'antecedentes_alergias_data',
			'antecedentes_patologicos' => 'antecedentes_patologicos_data',
			'antecedentes_familiares' => 'antecedentes_familiares_data',
			'antecedentes_obstetricos' => 'antecedentes_obstetricos_data',
			'antecedentes_otros' => 'antecedentes_otros_data',
			'motivo_consulta' => 'motivo_consulta_data',
			'examen_fisico' => 'examen_fisico_data',
			'antecedentes_consulta' => 'antecedentes_consulta_data',
		];

		$diagnosticos = [
			'lista' => [],
			'informacion_complementaria' => 'informacion_complementaria_data',
			'cpts' => [],
		];

		$ordenesMock = [
			[ 'id' => 1, 'nombre' => 'Orden MockData 01', 'cant' => 12, 'dosis'=>'0', 'hay' => 1 ],
			[ 'id' => 1, 'nombre' => 'Orden MockData 02', 'cant' => 15, 'dosis'=>'3', 'hay' => 0 ],
			[ 'id' => 1, 'nombre' => 'Orden MockData 03', 'cant' => 20, 'dosis'=>'5', 'hay' => 1 ],
		];

		$ordenes = [
			'farmacia' => $ordenesMock,
			'rayos' => $ordenesMock,
			'ecografia_obstetrica' => $ordenesMock,
			'ecografia_general' => $ordenesMock,
			'tomografia' => $ordenesMock,
			'patologia_clinica' => $ordenesMock,
			'anatomia_patologica' => $ordenesMock,
			'banco_sangre' => $ordenesMock,
		];

		$tratamiento = [
			'tratamiento_indicaciones' => 'tratamiento_indicaciones_data',
			'tratamiento_observaciones' => 'tratamiento_observaciones_data',
		];

		$destino = [
			'cita_alta_definitiva' => 1,
			'cita_destino' => 'cbx_destino',
			'cita_proxima' => 25, //dias,
			'cita_fecha' => '2019-11-25',
			'referencia_tipo' => 'id_tipo_referencia',
			'referencia_estado' => 0,
			'episodio_clinico' => 'id_episodio_clinico',
			'episodio_nuevo' => 1,
			'episodio_cierre' => 1,
		];

		$diagnostico = [
			'lista' => [],
			'cpt' => [],
			'condicion_paciente' => 'condicion_paciente_data',
			'numero_hijos' => 5,
		];

		$item['empleado'] = $empleado;
		$item['triaje'] = $triaje;
		$item['examenes'] = $examenes;
		$item['diagnosticos'] = $diagnosticos;
		$item['ordenes'] = $ordenes;
		$item['tratamiento'] = $tratamiento;
		$item['destino'] = $destino;
		$item['diagnostico'] = $diagnostico;


		$data['item'] = $item;
		$data['cbx_data'] = $this->getDataCbx();

		return $data;
	}

	public function getDataCbx()
	{
		// cbx_id_destino_atencion -> mo_cmbIdDestinoAtencion
		// $mo_cmbIdDestinoAtencion = $this->mo_AdminAdmision->TiposDestinoAtencionSeleccionarDestinosDeConsultoriosExternosXidCuentaAtencion($this->ml_idCuentaAtencion);
		$data = $this->mo_AdminAdmision->TiposDestinoAtencionSeleccionarDestinosDeConsultoriosExternos();
		if( count($data) > 0 ){
			foreach($data as $key => $row){
				$data[$key]->id = $row->IdDestinoAtencion;
				$data[$key]->text = $row->DescripcionLarga;
			}
		}else{
			$data = [];
		}
		$combos['cbx_id_destino_atencion'] = $data;


		// cbx_id_condicion_servicio -> mo_cmbIdCondicionEnElServicio
		$data = $this->mo_AdminServiciosComunes->TiposCondicionPacienteSeleccionarTodos();
		if( count($data) > 0 ){
			foreach($data as $key => $row){
				$data[$key]->id = $row->IdTipoCondicionPaciente;
				$data[$key]->text = $row->DescripcionLarga;
			}
		}else{
			$data = [];
		}
		$combos['cbx_id_condicion_servicio'] = $data;

		// cbx_id_condicion_establecimiento -> mo_cmbIdCondicionEnElEstablecimiento
		// $data = $this->mo_AdminServiciosComunes->TiposCondicionPacienteSeleccionarTodos();
		$combos['cbx_id_condicion_establecimiento'] = $data;

		// cbx_lab_his -> cmbLabHis
		$data = $this->mo_AdminServiciosComunes->DevuelveHIS_SITUACIOporDescripcion();
		if( count($data) > 0 ){
			foreach($data as $key => $row){
				$data[$key]->id = $row->IdHisSituacio;
				$data[$key]->text = $row->descripcio;
			}
		}else{
			$data = [];
		}
		$combos['cbx_lab_his'] = $data;

		// cbx_id_tipo_diagnostico -> mo_cmbIdTipoDiagnosticoE
		$data =  $this->mo_AdminServiciosComunes->SubclasificacionDiagnosticosSeleccionarDxConsultaExterna();
		if( count($data) > 0 ){
			foreach($data as $key => $row){
				$data[$key]->id = $row->IdSubclasificacionDx;
				$data[$key]->text = $row->DescripcionLarga;
			}
		}else{
			$data = [];
		}
		$combos['cbx_id_tipo_diagnostico'] = $data;

		$combos['cbx_episodios_historicos'] = $this->getEpisodiosHistoricos();

		//mo_cmbIdTipoReferenciaDestino
		$data = $this->mo_AdminServiciosComunes->TiposReferenciaSeleccionarTodos();
		if( count($data) > 0 ){
			foreach($data as $key => $row){
				$data[$key]->id = $row->IdTipoReferencia;
				$data[$key]->text = $row->DescripcionLarga;
			}
		}else{
			$data = [];
		}
		$combos['cbx_id_tipo_referencia_destino'] = $data;

		return $combos;
	}

	private function CargarDatosAlosControles()
	{
		//'1ro:   CARGAR DATOS DE LA CITA
        $this->CargarDatosDeCitasALosControles();
       
        //'2do:   CARGAR DATOS DE LA ATENCION
		$this->CargarDatosDelaAtencion();
		
		//'5to:   CARGAR DATOS DE LOS DIAGNOSTICOS POR ATENCION
        //Me.UcDiagnosticoDetalle1.IdAtencion = Me.IdAtencion
        //Me.UcDiagnosticoDetalle1.TipoDiagnostico = sghAtencionConsultaExterna
		//Me.UcDiagnosticoDetalle1.CargarDatosDeDiagnosticos oConexion
		$this->CargarDatosDeDiagnosticos();
               
        //'Carga datos de Triaje y Atencion CE (debb-jamo)
        $mo_DOAtencionesCE->CitaDiagMed = "";
        $this->CargaAtencionCEJamo();
	}

	private function CargarDatosDeCitasALosControles()
	{
		$citaData = new \stdClass;

		$mo_Cita = New doCita;
		$this->IdAtencion = 0;
		if( $lbCargaAlaVezCitaPacienteAtencionDA==false) {
			$mb_ExistenDatos = $this->mo_AdminAdmision->CitasSeleccionarPorId($ml_IdCita, $mo_Cita, $mo_Paciente);
		}
		$mo_Cita->idCita = $ml_IdCita;
		$mb_ExistenDatos = $this->mo_AdminAdmision->AtencionesPacientesCitasDatosadicionalesSeleccionarPorId(
							$mo_Paciente, 
							$mo_Atenciones, $mo_DoAtencionDatosAdicionales,
							$oConexion, $mo_CuentasAtencion, true, $mo_Cita);

		
	}

	private function CargarDatosDelaAtencion()
	{

	}

	private function RealizarBusqueda( $lbPasaAlGrid=null )
	{
		$txtCodigo = "";
		$txtDescripcion = "";
		$chkAccess = 1;
		$oDODiagnostico = new \App\VB\SIGHComun\doDiagnostico;

		$lbUSAcodigoCIEsinPto = true;
		$lbSoloMuestraDxGalenHos = true;

		if ($lbUSAcodigoCIEsinPto == true) {
			$oDODiagnostico->codigoCIEsinPto = $txtCodigo;
		}else{
			$oDODiagnostico->CodigoCIE2004 = $txtDescripcion;
		}

		if ($chkAccess == 1) {
				$oDODiagnostico->Descripcion = "%" . trim('UserControl.txtDescripcion') . "%";
				$grdDiagnosticos = DiagnosticosFiltrarMDB($oDODiagnostico, $lbSoloMuestraDxGalenHos, $lbUSAcodigoCIEsinPto);
		}else{
			//'Actualizado 2209
			if ($txtDescripcion <> "") {
				$oDODiagnostico->Descripcion = "%" . trim($txtDescripcion) . "%";
			}
			//'mgaray09
// '           If mb_mostrarSoloActivos = False Then
// '                Set grdDiagnosticos.DataSource = mo_AdminServiciosComunes.DiagnosticosFiltrar(oDODiagnostico, lbSoloMuestraDxGalenHos, lbUSAcodigoCIEsinPto)
// '           Else
// '                Set grdDiagnosticos.DataSource = mo_AdminServiciosComunes.DiagnosticosFiltrarSoloActivos(oDODiagnostico, lbSoloMuestraDxGalenHos, lbUSAcodigoCIEsinPto)
// '           End If
			$oRsTmp = [];
			$lcSql = "";
			if ($mb_mostrarSoloActivos == false) {
				$oRsTmp = $this->mo_AdminServiciosComunes->DiagnosticosFiltrar($oDODiagnostico, $lbSoloMuestraDxGalenHos, $lbUSAcodigoCIEsinPto);
			}else{
				$oRsTmp = $this->mo_AdminServiciosComunes->DiagnosticosFiltrarSoloActivos($oDODiagnostico, $lbSoloMuestraDxGalenHos, $lbUSAcodigoCIEsinPto);
			}

			$grdDiagnosticos = $oRsTmp;
		}

	}

	// Fuente Origen: ucDiagnosticoDetalle
	private function DiagnosticosFiltrarMDB($oDODiagnostico, $lbSoloMuestraDxGalenHos, $lbUSAcodigoCIEsinPto,  $MostrarSoloActivos=true)
	{
		$sWhere = ""; $lcSql = "";

		if ($lbUSAcodigoCIEsinPto){
			$lcSql = "select Iddiagnostico, codigoCIEsinPto, Descripcion,CodigoCIE10, CodigoCIE9, EsActivo, FechaInicioVigencia from Diagnosticos ";
			if ($oDODiagnostico->codigoCIEsinPto <> "") {
				$sWhere .= " codigoCIEsinPto like '" . $oDODiagnostico->codigoCIEsinPto . "*' and ";
			}
		}else{
			$lcSql = "select Iddiagnostico, CodigoCIE2004, Descripcion,CodigoCIE10, CodigoCIE9, EsActivo, FechaInicioVigencia from Diagnosticos ";
			if ($oDODiagnostico->CodigoCIE2004 <> "") {
				$sWhere .= " CodigoCIE2004 like '" . $oDODiagnostico->CodigoCIE2004 . "*' and ";
			}
		}

		if ($oDODiagnostico->Descripcion <> "" and $oDODiagnostico->Descripcion <> "%%") {
			if (substr($oDODiagnostico->Descripcion, 0, 1) <> "%") {
				$oDODiagnostico->Descripcion = trim($oDODiagnostico->Descripcion) . "*";
			}
			$sWhere .= " Descripcion like '" . $oDODiagnostico->Descripcion + "' and ";
		}
		if( $lbSoloMuestraDxGalenHos ==true) {
			$sWhere .= " not (descripcionMINSA is null) and ";
		}
		if( $mb_mostrarSoloActivos == true) {
			$sWhere .= " EsActivo = 1 and ";
		}
		if( $sWhere <> "") {
			$sWhere = " Where " . substr($sWhere, 0, strlen($sWhere) - 4);
		}

		$sWhere .= " order by  Descripcion,CodigoCIE2004 ";
		$lcSql = $lcSql . $sWhere;

		dd($lcSql);
		// oRsDxMDB.Open lcSql, oConexionMDB, adOpenKeyset, adLockOptimistic
		// Set DiagnosticosFiltrarMDB = oRsDxMDB
	}


// Function DiagnosticosFiltrarMDB(oDODiagnostico As doDiagnostico, lbSoloMuestraDxGalenHos As Boolean, _
//                                 lbUSAcodigoCIEsinPto As Boolean, Optional MostrarSoloActivos As Boolean = True) As Recordset
//        Dim oRsDxMDB As New Recordset
//        Dim sWhere As String, lcSql As String
//        If lbUSAcodigoCIEsinPto = True Then
//             'mgaray09
//            lcSql = "select Iddiagnostico, codigoCIEsinPto, Descripcion,CodigoCIE10, CodigoCIE9, EsActivo, FechaInicioVigencia from Diagnosticos "
//            If oDODiagnostico.codigoCIEsinPto <> "" Then
//                sWhere = sWhere + " codigoCIEsinPto like '" + oDODiagnostico.codigoCIEsinPto + "*' and "
//            End If
//        Else
//            'mgaray09
//            lcSql = "select Iddiagnostico, CodigoCIE2004, Descripcion,CodigoCIE10, CodigoCIE9, EsActivo, FechaInicioVigencia from Diagnosticos "
//            If oDODiagnostico.CodigoCIE2004 <> "" Then
//               sWhere = sWhere + " CodigoCIE2004 like '" + oDODiagnostico.CodigoCIE2004 + "*' and "
//            End If
//        End If
//        If oDODiagnostico.Descripcion <> "" And oDODiagnostico.Descripcion <> "%%" Then

//             If Left(oDODiagnostico.Descripcion, 1) <> "%" Then
//                oDODiagnostico.Descripcion = Trim(oDODiagnostico.Descripcion) & "*"
//             End If
//             sWhere = sWhere + " Descripcion like '" + oDODiagnostico.Descripcion + "' and "
//        End If
//        If lbSoloMuestraDxGalenHos = True Then
//            sWhere = sWhere + " not (descripcionMINSA is null) and "
//        End If
//        'mgaray09
//        If mb_mostrarSoloActivos = True Then
//            sWhere = sWhere + " EsActivo = 1 and "
//        End If
//        If sWhere <> "" Then
//             sWhere = " Where " & Left(sWhere, Len(sWhere) - 4)
//        End If
//        sWhere = sWhere + " order by  Descripcion,CodigoCIE2004 "
//        lcSql = lcSql & sWhere
//        oRsDxMDB.Open lcSql, oConexionMDB, adOpenKeyset, adLockOptimistic
//        Set DiagnosticosFiltrarMDB = oRsDxMDB
// End Function



// 	Sub BusquedaDx(lcCodigoDx As String)
//     Dim oBusqueda As New SIGHNegocios.BuscaDiagnosticos
//     Dim oDODiagnostico As DODiagnostico
//     If ml_IdListBarItem = sghOpcionGalenHos.sghRegistroAtencionCE Then
//        oBusqueda.SoloMuestraDxGalenHos = False
//     Else
//        oBusqueda.SoloMuestraDxGalenHos = True
//     End If
//     oBusqueda.CodigoDx = lcCodigoDx
//     oBusqueda.MostrarFormulario

//     If oBusqueda.BotonPresionado = sghAceptar Then
//         Set oDODiagnostico = mo_AdminServiciosComunes.DiagnosticosSeleccionarPorId(oBusqueda.IdRegistroSeleccionado)
//         If Not oDODiagnostico Is Nothing Then
//             UserControl.txtIdDiagnostico.Text = oDODiagnostico.CodigoCIE2004
//             UserControl.txtIdDiagnostico.Tag = oDODiagnostico.IdDiagnostico
//             UserControl.lblDescripcionDx = oDODiagnostico.Descripcion
//         Else
//             UserControl.txtIdDiagnostico.Text = ""
//             UserControl.txtIdDiagnostico.Tag = ""
//             UserControl.lblDescripcionDx = ""
//         End If
//     Else
//         UserControl.txtIdDiagnostico.Text = ""
//         UserControl.txtIdDiagnostico.Tag = ""
//         UserControl.lblDescripcionDx = ""
//     End If
//     Set oBusqueda = Nothing
// End Sub

	private function getEpisodiosHistoricos() //->CargaEpisodiosHistoricos
	{
		return [];
		$ml_IdPaciente = 0;
		$oDODiagnostico = new DODiagnostico;

		$oRsTmp1 = $this->mo_ReglasAdmision->AtencionesEpisodiosDetalleSeleccionarXpaciente($ml_IdPaciente);

		foreach( $oRsTmp1 as $row ){
			$oDODiagnostico = $this->mo_AdminFacturacion->DevuelveDxAltaMedica($row->IdAtencion, $row->idTipoServicio);


			$oRsHistorico['NroEpisodio'] = $row->idEpisodio;
			$oRsHistorico['FechaApertura'] = $row->FechaApertura;
			$oRsHistorico['fechaCierre'] = $row->fechaCierre;
			$oRsHistorico['dx'] = trim($oDODiagnostico[0]->CodigoCIE2004) . " " . $oDODiagnostico[0]->Descripcion;
			$oRsHistorico['TipoServicio'] = $row->TipoServicio;
			if ($row->idTipoServicio == 'sghConsultaExterna') {
				$oRsHistorico[0]->Servicio = $row->ServIng;
			}else{
				$oRsHistorico[0]->Servicio = $row->Servicio;
			}
			$oRsHistorico['CuentaFecha'] = $row->FechaIngreso;
			$oRsHistorico['CuentaNro'] = $row->idCuentaAtencion;
			// $oRsHistorico.Update
			if ( is_null($row->fechaCierre) ) {
				$lbTieneTodosEpisodiosCerrados = False;
			}
		}
	}

// 	CargaEpisodiosHistoricos()
//     'llena temporal con Historicos de atenciones
//     Dim oRsTmp1 As New Recordset
//     Dim oDODiagnostico As New DODiagnostico
//     Dim oConexion As New Connection
//     lbTieneTodosEpisodiosCerrados = True
//     If ml_IdPaciente > 0 Then
//         oConexion.CommandTimeout = 300
//         oConexion.CursorLocation = adUseClient
//         oConexion.Open sighEntidades.CadenaConexion
//         If oRsHistoricos.State = 1 Then Set oRsHistoricos = Nothing
//         With oRsHistoricos
//             .Fields.Append "NroEpisodio", adInteger
//             .Fields.Append "FechaApertura", adDate, , adFldIsNullable
//             .Fields.Append "FechaCierre", adDate, , adFldIsNullable
//             .Fields.Append "Dx", adVarChar, 300, adFldIsNullable
//             .Fields.Append "TipoServicio", adVarChar, 100, adFldIsNullable
//             .Fields.Append "Servicio", adVarChar, 200, adFldIsNullable
//             .Fields.Append "CuentaFecha", adDate, , adFldIsNullable
//             .Fields.Append "CuentaNro", adInteger
//             .LockType = adLockOptimistic
//             .Open
//         End With
//         Set oRsTmp1 = mo_ReglasAdmision.AtencionesEpisodiosDetalleSeleccionarXpaciente(ml_IdPaciente, oConexion)
//         If oRsTmp1.RecordCount > 0 Then
//            oRsTmp1.MoveFirst
//            Do While Not oRsTmp1.EOF
//                 Set oDODiagnostico = mo_AdminFacturacion.DevuelveDxAltaMedica(oRsTmp1!IdAtencion, oRsTmp1!idTipoServicio, oConexion)
//                 oRsHistoricos.AddNew
//                 oRsHistoricos.Fields!NroEpisodio = oRsTmp1!idEpisodio
//                 oRsHistoricos.Fields!FechaApertura = oRsTmp1!FechaApertura
//                 oRsHistoricos.Fields!fechaCierre = oRsTmp1!fechaCierre
//                 oRsHistoricos.Fields!dx = Trim(oDODiagnostico.CodigoCIE2004) & " " & oDODiagnostico.Descripcion
//                 oRsHistoricos.Fields!TipoServicio = oRsTmp1!TipoServicio
//                 If oRsTmp1.Fields!idTipoServicio = sghConsultaExterna Then
//                    oRsHistoricos.Fields!Servicio = oRsTmp1!ServIng
//                 Else
//                    oRsHistoricos.Fields!Servicio = oRsTmp1!Servicio
//                 End If
//                 oRsHistoricos.Fields!CuentaFecha = oRsTmp1!FechaIngreso
//                 oRsHistoricos.Fields!CuentaNro = oRsTmp1!idCuentaAtencion
//                 oRsHistoricos.Update
//                 If IsNull(oRsTmp1!fechaCierre) Then
//                    lbTieneTodosEpisodiosCerrados = False
//                 End If
//                 oRsTmp1.MoveNext
//            Loop
//         End If
//         oConexion.Close
//         Set cmdEpisodiosHistoricos.ListSource = oRsHistoricos
//     Else
//         lbTieneTodosEpisodiosCerrados = True
//     End If
//     Set oRsTmp1 = Nothing
//     Set oDODiagnostico = Nothing
//     Set oConexion = Nothing
//     'If lbTieneTodosEpisodiosCerrados = True Then
//     '   chkEpisodioNew.Value = 1
//     '   chkEpisodioCerrar.Value = 0

//     'End If
// End Sub




	public function guardar()
	{
		$this->ValidarDatosObligatorios(); // T/F
		$this->CargaDatosAlObjetosDeDatos();
		$this->ValidarReglas(); // T/F
		$this->ValidarReglas2(); // T/F

		$ml_idOrdenServicioInmunizaciones = $this->getIdOrdenServicioInmunizaciones('mo_Atenciones.IdAtencion');

		if( $this->ModificarDatos() ){
			$this->ActualizaVacunasDesdeModuloPerinatal();
			// If Me.ucPerinatal1.Visible = True Then
			// 	Call cargaCptDesdeProgramasPerinatalMaterno(True, Me.ucPerinatal1.DevuelveCptFrecuentes, ml_idOrdenServicioInmunizaciones)
			// End If
			// If Me.ucProgramaMaterno.Visible = True Then
			// 	Call cargaCptDesdeProgramasPerinatalMaterno(False, Me.ucProgramaMaterno.DevuelveProProcedimientos, 0)
			// End If

			$ms_NombrePaciente = $this->mo_Paciente->ApellidoPaterno . " " . $mo_Paciente->ApellidoMaterno . " " . $this->mo_Paciente->PrimerNombre;
			//MsgBox " Los datos se modificaron correctamente, para la Cuenta N°: " & Trim(Str(ml_idCuentaAtencion)) & DevuelveNroRecetasGeneradas, vbInformation, Me.Caption


			// ImpresionProcedimiento
			$this->ValidarImpresionCpt();
			$this->ValidarImpresionInterconsulta();
		}else{
			// MsgBox "No se pudo modificar los datos" + Chr(13) + ms_MensajeError, vbExclamation, Me.Caption
		}

	}




// 	Private Sub btnAceptar_Click()
//     If btnAceptar.Enabled = False Then
//       Exit Sub
//    End If
//    Select Case mi_Opcion
//    Case sghAgregar
//    Case sghModificar
//        If ValidarDatosObligatorios() Then
//             CargaDatosAlObjetosDeDatos
//             If ValidarReglas() Then
//                 If ValidarReglas2() Then
//              'mgaray20141024
//                     ml_idOrdenServicioInmunizaciones = getIdOrdenServicioInmunizaciones(mo_Atenciones.IdAtencion)
//                     If ModificarDatos() Then

//                          ActualizaVacunasDesdeModuloPerinatal


//                         If Me.ucPerinatal1.Visible = True Then
//                             Call cargaCptDesdeProgramasPerinatalMaterno(True, Me.ucPerinatal1.DevuelveCptFrecuentes, ml_idOrdenServicioInmunizaciones)
//                         End If
//                         If Me.ucProgramaMaterno.Visible = True Then
//                             Call cargaCptDesdeProgramasPerinatalMaterno(False, Me.ucProgramaMaterno.DevuelveProProcedimientos, 0)
//                         End If

//                             ms_NombrePaciente = mo_Paciente.ApellidoPaterno + " " + mo_Paciente.ApellidoMaterno + " " + mo_Paciente.PrimerNombre
//                             MsgBox " Los datos se modificaron correctamente, para la Cuenta N°: " & Trim(Str(ml_idCuentaAtencion)) & DevuelveNroRecetasGeneradas, vbInformation, Me.Caption
//                            ' ImpresionProcedimiento
//                             ValidarImpresionCpt
//                             ValidarImpresionInterconsulta

// '                            If Mid(cmbIdDestinoAtencion.Text, 1, 1) = "C" Then
// '                                AgregarContraDestino
// '                            End If
//                            ' ValidarImpresionBaciloscopia ' GR 02/02/2018


//                              'GR 26032018

//                             If mb_ValidarExtension = True Then
//                                 ValidarFechaVigencia
//                             End If
//                             mb_ValidarExtension = False
//                             'fin


//                             btnImprimeAtencion.Enabled = True
//                             btnImprimeAtencion.Visible = True

//                         'If wxParametro302 = "S" And
//                         If mo_Atenciones.IdFuenteFinanciamiento = sghFuenteFinanciamiento.sghFFSIS And _
//                             lbElMedicoNOregistraDatosCE <> "S" Then
//                             btnImprimeFichaSIS_Click
//                         End If
//                    '        El formulario atenciones no debe cerrarse para los pacientes SIS, requerimiento Hosp. Socorro de Ica
//                         'If Not (wxParametro302 = "S" And mo_Atenciones.IdFuenteFinanciamiento = sghFuenteFinanciamiento.sghFFSIS And
//                         If Not (mo_Atenciones.IdFuenteFinanciamiento = sghFuenteFinanciamiento.sghFFSIS And _
//                                                                     lbElMedicoNOregistraDatosCE <> "S") Then
//                             Me.Visible = False
//                             LimpiarVariablesDeMemoria
//                         End If


//                     Else
//                         ms_NombrePaciente = ""
//                         MsgBox "No se pudo modificar los datos" + Chr(13) + ms_MensajeError, vbExclamation, Me.Caption
//                         btnImprimeAtencion.Enabled = False
//                    End If
//                 End If

//             End If
//        End If
//    Case sghEliminar
//        MsgBox "No se puede ELIMINAR desde este módulo", vbInformation, Me.Caption
//    End Select
// End Sub

	private function test( $request )
	{

		//'$mo_cboTipoalta = $this->mo_AdminServiciosComunes->TiposCondicionAltaSeleccionarTodos();

		$mo_cmbIdCondicionEnElServicio = $this->mo_AdminServiciosComunes->TiposCondicionPacienteSeleccionarTodos(); //ok
		// dd($mo_cmbIdCondicionEnElServicio);

		$mo_cmbIdCondicionEnElEstablecimiento =  $this->mo_AdminServiciosComunes->TiposCondicionPacienteSeleccionarTodos();
		// dd( $mo_cmbIdCondicionEnElEstablecimiento );

		//'$mo_cmbIdDestinoAtencion = $this->mo_AdminAdmision->TiposDestinoAtencionSeleccionarDestinosDeConsultoriosExternosXidCuentaAtencion($ml_idCuentaAtencion);

		$mo_cmbIdTipoReferenciaDestino = $this->mo_AdminServiciosComunes->TiposReferenciaSeleccionarTodos();
		// dd( $mo_cmbIdTipoReferenciaDestino);

		$mo_cmbIdEspecialidades = $this->mo_AdminProgramacionMedica->FiltrarEspecialidad();
		dd( $mo_cmbIdEspecialidades);

        $mo_cboDiasExtension = $this->mo_AdminAdmision->ListarDiasExtension();

	 	//'mo_cboDiagnosticos.RowSource = rstDiagnosticos

	}


// |Sub CargarComboBoxes()

// '        mo_cboTipoalta.BoundColumn = "IdCondicionAlta"
// '        mo_cboTipoalta.ListField = "DescripcionLarga"
// '        Set mo_cboTipoalta.RowSource = mo_AdminServiciosComunes.TiposCondicionAltaSeleccionarTodos //OK


//         mo_cmbIdCondicionEnElServicio.BoundColumn = "IdTipoCondicionPaciente"
//         mo_cmbIdCondicionEnElServicio.ListField = "DescripcionLarga"
//         Set mo_cmbIdCondicionEnElServicio.RowSource = mo_AdminServiciosComunes.TiposCondicionPacienteSeleccionarTodos //ok

//         mo_cmbIdCondicionEnElEstablecimiento.BoundColumn = "IdTipoCondicionPaciente"
//         mo_cmbIdCondicionEnElEstablecimiento.ListField = "DescripcionLarga"
//         Set mo_cmbIdCondicionEnElEstablecimiento.RowSource = mo_AdminServiciosComunes.TiposCondicionPacienteSeleccionarTodos//OK

// '        mo_cmbIdDestinoAtencion.BoundColumn = "IdDestinoAtencion"
// '        mo_cmbIdDestinoAtencion.ListField = "DescripcionLarga"
// '        Set mo_cmbIdDestinoAtencion.RowSource = mo_AdminAdmision.TiposDestinoAtencionSeleccionarDestinosDeConsultoriosExternosXidCuentaAtencion(ml_idCuentaAtencion)

//         mo_cmbIdTipoReferenciaDestino.BoundColumn = "IdTipoReferencia"
//         mo_cmbIdTipoReferenciaDestino.ListField = "DescripcionLarga"
//         Set mo_cmbIdTipoReferenciaDestino.RowSource = mo_AdminServiciosComunes.TiposReferenciaSeleccionarTodos

//         mo_cmbIdEspecialidades.BoundColumn = "IdEspecialidad"
//         mo_cmbIdEspecialidades.ListField = "Nombre"
//         Set mo_cmbIdEspecialidades.RowSource = mo_AdminProgramacionMedica.FiltrarEspecialidad

//         Me.UcDiagnosticoDetalle1.TipoDiagnostico = sghAtencionConsultaExterna
//         Me.UcDiagnosticoDetalle1.ConfigurarComboBoxes
//         Me.UcDiagnosticoDetalle1.EditaLabConfHIS


//         mo_cboDiasExtension.BoundColumn = "Dias"
//         mo_cboDiasExtension.ListField = "Nombre"
//         Set mo_cboDiasExtension.RowSource = mo_AdminAdmision.ListarDiasExtension


// '        Set rstDiagnosticos = Me.UcDiagnosticoDetalle1.CargarDatosDeDiagnosticos(oConexion2)
// '        mo_cboDiagnosticos.BoundColumn = "CodigoCIE2004"
// '        mo_cboDiagnosticos.ListField = "CodigoCIE10"
// '        Set mo_cboDiagnosticos.RowSource = rstDiagnosticos
// '


// End Sub

}