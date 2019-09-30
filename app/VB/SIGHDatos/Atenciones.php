<?php

namespace App\VB\SIGHDatos;

use Illuminate\Database\Eloquent\Model;

use DB;

class Atenciones extends Model
{
	public function Insertar($oTabla)
	{
		$query = "
			DECLARE @idAtencion AS Int = :idAtencion
			SET NOCOUNT ON 
			EXEC AtencionesAgregar :horaIngreso, :fechaIngreso, :idTipoServicio, :idPaciente, @idAtencion OUTPUT, :idTipoCondicionALEstab, :fechaEgresoAdministrativo, :idCamaEgreso, :idCamaIngreso, :idServicioEgreso, :idTipoAlta, :idCondicionAlta, :idTipoEdad, :idOrigenAtencion, :idDestinoAtencion, :horaEgresoAdministrativo, :idTipoCondicionAlServicio, :horaEgreso, :fechaEgreso, :idMedicoEgreso, :edad, :idEspecialidadMedico, :idMedicoIngreso, :idServicioIngreso, :idTipoGravedad, :idCuentaAtencion, :idFormaPago, :idUsuarioAuditoria, :idFuenteFinanciamiento, :idEstadoAtencion, :esPacienteExterno, :idSunasaPacienteHistorico, :idCondicionMaterna
			SELECT @idAtencion AS idAtencion";

		$params = [
			'horaIngreso' => ($oTabla->horaIngreso == "")? Null: $oTabla->horaIngreso, 
			'fechaIngreso' => ($oTabla->fechaIngreso == 0)? Null: $oTabla->fechaIngreso, 
			'idTipoServicio' => ($oTabla->idTipoServicio == 0)? Null: $oTabla->idTipoServicio, 
			'idPaciente' => ($oTabla->idPaciente == 0)? Null: $oTabla->idPaciente, 
			'idAtencion' => 0, 
			'idTipoCondicionALEstab' => ($oTabla->idTipoCondicionALEstab == 0)? Null: $oTabla->idTipoCondicionALEstab, 
			'fechaEgresoAdministrativo' => ($oTabla->fechaEgresoAdministrativo == 0)? Null: $oTabla->fechaEgresoAdministrativo, 
			'idCamaEgreso' => ($oTabla->idCamaEgreso == 0)? Null: $oTabla->idCamaEgreso, 
			'idCamaIngreso' => ($oTabla->idCamaIngreso == 0)? Null: $oTabla->idCamaIngreso, 
			'idServicioEgreso' => ($oTabla->idServicioEgreso == 0)? Null: $oTabla->idServicioEgreso, 
			'idTipoAlta' => ($oTabla->idTipoAlta == 0)? Null: $oTabla->idTipoAlta, 
			'idCondicionAlta' => ($oTabla->idCondicionAlta == 0)? Null: $oTabla->idCondicionAlta, 
			'idTipoEdad' => ($oTabla->idTipoEdad == 0)? Null: $oTabla->idTipoEdad, 
			'idOrigenAtencion' => ($oTabla->idOrigenAtencion == 0)? Null: $oTabla->idOrigenAtencion, 
			'idDestinoAtencion' => ($oTabla->idDestinoAtencion == 0)? Null: $oTabla->idDestinoAtencion, 
			'horaEgresoAdministrativo' => ($oTabla->horaEgresoAdministrativo == "")? Null: $oTabla->horaEgresoAdministrativo, 
			'idTipoCondicionAlServicio' => ($oTabla->idTipoCondicionAlServicio == 0)? Null: $oTabla->idTipoCondicionAlServicio, 
			'horaEgreso' => ($oTabla->horaEgreso == "")? Null: $oTabla->horaEgreso, 
			'fechaEgreso' => ($oTabla->fechaEgreso == 0)? Null: $oTabla->fechaEgreso, 
			'idMedicoEgreso' => ($oTabla->idMedicoEgreso == 0)? Null: $oTabla->idMedicoEgreso, 
			'edad' => ($oTabla->edad == 0)? 0: $oTabla->edad, 
			'idEspecialidadMedico' => ($oTabla->idEspecialidadMedico == 0)? Null: $oTabla->idEspecialidadMedico, 
			'idMedicoIngreso' => ($oTabla->idMedicoIngreso == 0)? Null: $oTabla->idMedicoIngreso, 
			'idServicioIngreso' => ($oTabla->idServicioIngreso == 0)? Null: $oTabla->idServicioIngreso, 
			'idTipoGravedad' => ($oTabla->idTipoGravedad == 0)? Null: $oTabla->idTipoGravedad, 
			'idCuentaAtencion' => ($oTabla->idCuentaAtencion == 0)? Null: $oTabla->idCuentaAtencion, 
			'idFormaPago' => ($oTabla->idFormaPago == 0)? Null: $oTabla->idFormaPago, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
			'idFuenteFinanciamiento' => ($oTabla->idFuenteFinanciamiento == 0)? Null: $oTabla->idFuenteFinanciamiento, 
			'idEstadoAtencion' => $oTabla->idEstadoAtencion, 
			'esPacienteExterno' => ($oTabla->esPacienteExterno == True)? 1: 0, 
			'idSunasaPacienteHistorico' => ($oTabla->idSunasaPacienteHistorico == 0)? Null: $oTabla->idSunasaPacienteHistorico, 
			'idCondicionMaterna' => ($oTabla->idCondicionMaterna == 0)? Null: $oTabla->idCondicionMaterna, 
		];

		$data = \DB::select($query, $params);

		$data = reset($data);

		return $data;
	}

	public function Modificar($oTabla)
	{
		$query = "
			EXEC AtencionesModificar :horaIngreso, :fechaIngreso, :idTipoServicio, :idPaciente, :idAtencion, :idTipoCondicionALEstab, :fechaEgresoAdministrativo, :idCamaEgreso, :idCamaIngreso, :idServicioEgreso, :idTipoAlta, :idCondicionAlta, :idTipoEdad, :idOrigenAtencion, :idDestinoAtencion, :horaEgresoAdministrativo, :idTipoCondicionAlServicio, :horaEgreso, :fechaEgreso, :idMedicoEgreso, :edad, :idEspecialidadMedico, :idMedicoIngreso, :idServicioIngreso, :idTipoGravedad, :idCuentaAtencion, :idFormaPago, :idUsuarioAuditoria, :idFuenteFinanciamiento, :idEstadoAtencion, :esPacienteExterno, :idSunasaPacienteHistorico, :idCondicionMaterna";

		$params = [
			'horaIngreso' => ($oTabla->horaIngreso == "")? Null: $oTabla->horaIngreso, 
			'fechaIngreso' => ($oTabla->fechaIngreso == 0)? Null: $oTabla->fechaIngreso, 
			'idTipoServicio' => ($oTabla->idTipoServicio == 0)? Null: $oTabla->idTipoServicio, 
			'idPaciente' => ($oTabla->idPaciente == 0)? Null: $oTabla->idPaciente, 
			'idAtencion' => ($oTabla->idAtencion == 0)? Null: $oTabla->idAtencion, 
			'idTipoCondicionALEstab' => ($oTabla->idTipoCondicionALEstab == 0)? Null: $oTabla->idTipoCondicionALEstab, 
			'fechaEgresoAdministrativo' => ($oTabla->fechaEgresoAdministrativo == 0)? Null: $oTabla->fechaEgresoAdministrativo, 
			'idCamaEgreso' => ($oTabla->idCamaEgreso == 0)? Null: $oTabla->idCamaEgreso, 
			'idCamaIngreso' => ($oTabla->idCamaIngreso == 0)? Null: $oTabla->idCamaIngreso, 
			'idServicioEgreso' => ($oTabla->idServicioEgreso == 0)? Null: $oTabla->idServicioEgreso, 
			'idTipoAlta' => ($oTabla->idTipoAlta == 0)? Null: $oTabla->idTipoAlta, 
			'idCondicionAlta' => ($oTabla->idCondicionAlta == 0)? Null: $oTabla->idCondicionAlta, 
			'idTipoEdad' => ($oTabla->idTipoEdad == 0)? Null: $oTabla->idTipoEdad, 
			'idOrigenAtencion' => ($oTabla->idOrigenAtencion == 0)? Null: $oTabla->idOrigenAtencion, 
			'idDestinoAtencion' => ($oTabla->idDestinoAtencion == 0)? Null: $oTabla->idDestinoAtencion, 
			'horaEgresoAdministrativo' => ($oTabla->horaEgresoAdministrativo == "")? Null: $oTabla->horaEgresoAdministrativo, 
			'idTipoCondicionAlServicio' => ($oTabla->idTipoCondicionAlServicio == 0)? Null: $oTabla->idTipoCondicionAlServicio, 
			'horaEgreso' => ($oTabla->horaEgreso == "")? Null: $oTabla->horaEgreso, 
			'fechaEgreso' => ($oTabla->fechaEgreso == 0)? Null: $oTabla->fechaEgreso, 
			'idMedicoEgreso' => ($oTabla->idMedicoEgreso == 0)? Null: $oTabla->idMedicoEgreso, 
			'edad' => ($oTabla->edad == 0)? 0: $oTabla->edad, 
			'idEspecialidadMedico' => ($oTabla->idEspecialidadMedico == 0)? Null: $oTabla->idEspecialidadMedico, 
			'idMedicoIngreso' => ($oTabla->idMedicoIngreso == 0)? Null: $oTabla->idMedicoIngreso, 
			'idServicioIngreso' => ($oTabla->idServicioIngreso == 0)? Null: $oTabla->idServicioIngreso, 
			'idTipoGravedad' => ($oTabla->idTipoGravedad == 0)? Null: $oTabla->idTipoGravedad, 
			'idCuentaAtencion' => ($oTabla->idCuentaAtencion == 0)? Null: $oTabla->idCuentaAtencion, 
			'idFormaPago' => ($oTabla->idFormaPago == 0)? Null: $oTabla->idFormaPago, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
			'idFuenteFinanciamiento' => ($oTabla->idFuenteFinanciamiento == 0)? Null: $oTabla->idFuenteFinanciamiento, 
			'idEstadoAtencion' => $oTabla->idEstadoAtencion, 
			'esPacienteExterno' => ($oTabla->esPacienteExterno == True)? 1: 0, 
			'idSunasaPacienteHistorico' => ($oTabla->idSunasaPacienteHistorico == 0)? Null: $oTabla->idSunasaPacienteHistorico, 
			'idCondicionMaterna' => ($oTabla->idCondicionMaterna == 0)? Null: $oTabla->idCondicionMaterna, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

	public function Eliminar($oTabla)
	{
		$query = "
			EXEC AtencionesEliminar :idAtencion, :idUsuarioAuditoria";

		$params = [
			'idAtencion' => ($oTabla->idAtencion == 0)? Null: $oTabla->idAtencion, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

	public function SeleccionarPorId($oTabla)
	{
		$query = "
			EXEC AtencionesSeleccionarPorId :idAtencion";

		$params = [
			'idAtencion' => $oTabla->idAtencion, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function AtencionesPacientesCitasDatosadicionalesSeleccionarPorId()
	{
		$query = "
			EXEC AtencionesSeleccionarPorIdAtencionEnAtencionesAtencionesdatosadicionalesPacientes :idCita, :idAtencion";

		// $params = [
		// 	'idCita' => DoCita->idCita, 
		// 	'idAtencion' => oTabla->idAtencion, 
		// ];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function ActualizarCitasConIdAtencion($idCita, $idAtencion)
	{
		$query = "
			EXEC CitasActualizarConIdAtencion :idAtencion, :idCita";

		$params = [
			'idAtencion' => $idAtencion, 
			'idCita' => IdCita, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

	public function ReporteDatosAlta($lIdAtencion)
	{
		$query = "
			EXEC ListarDatosAltaMedica :idAtencion";

		$params = [
			'idAtencion' => $lIdAtencion, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function ReporteParaHistoriaClinica($lIdAtencion)
	{
		$query = "
			EXEC AtencionesReporteParaHistoriaClinica :idAtencion";

		$params = [
			'idAtencion' => $lIdAtencion, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function ReporteParaHistoriaClinicaEmergyHosp($lIdAtencion)
	{
		$query = "
			EXEC AtencionesReporteParaEmergencia :idAtencion";

		$params = [
			'idAtencion' => $lIdAtencion, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function ReporteParaHistoriaClinicaAnamnesis($lIdAtencion)
	{
		$query = "
			EXEC AtencionesHistoriaClinicaAnamnesis :idAtencion";

		$params = [
			'idAtencion' => $lIdAtencion, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function AtencionesEsObservacion($lIdAtencion)
	{
		$query = "
			EXEC AtencionesEsObservacion :idAtencion";

		$params = [
			'idAtencion' => $lIdAtencion, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function ReporteParaHistoriaClinicaTratamiento($lIdAtencion)
	{
		$query = "
			EXEC AtencionesHistoriaClinicaTratamiento :idAtencion";

		$params = [
			'idAtencion' => $lIdAtencion, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function ReporteParaHistoriaClinicaPlan($lIdAtencion)
	{
		$query = "
			EXEC AtencionesHistoriaClinicaPlan :idAtencion";

		$params = [
			'idAtencion' => $lIdAtencion, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function ReporteParaHistoriaClinicaDiagnostico($lIdAtencion)
	{
		$query = "
			EXEC AtencionesHistoriaClinicaDiagnosticos :idAtencion";

		$params = [
			'idAtencion' => $lIdAtencion, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function ReporteParaHistoriaClinicaEvolucion($lIdAtencion)
	{
		$query = "
			EXEC AtencionesHistoriaClinicaEvolucion :idAtencion";

		$params = [
			'idAtencion' => $lIdAtencion, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function ReporteParaHistoriaClinicaAlta($lIdAtencion)
	{
		$query = "
			EXEC AtencionesHistoriaClinicaAlta :idAtencion";

		$params = [
			'idAtencion' => $lIdAtencion, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function ReporteParaHistoriaClinicaAltaTopico($lIdAtencion)
	{
		$query = "
			EXEC AtencionesHistoriaClinicaAltaTopico :idAtencion";

		$params = [
			'idAtencion' => $lIdAtencion, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function ReporteAtencionAnamnesisCE($lIdAtencion)
	{
		$query = "
			EXEC ImprimirAtencionAnamnesisCE :idAtencion";

		$params = [
			'idAtencion' => $lIdAtencion, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function ReporteAtencionAntecedentes($lIdPaciente)
	{
		$query = "
			EXEC ImprimirAtencionAntecedentes :idAtencion";

		$params = [
			'idAtencion' => $lIdPaciente, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function ReporteAtencionAdiconales($lIdAtencion)
	{
		$query = "
			EXEC ImprimirAtencionDatosAdicionales :idAtencion";

		$params = [
			'idAtencion' => $lIdAtencion, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function ListarDiagnosticoIngreso($lIdAtencion)
	{
		$query = "
			EXEC ListarDiagnosticoIngreso :idCuenta";

		$params = [
			'idCuenta' => $lIdAtencion, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function ListarDiagnosticoTransferencia($lIdAtencion)
	{
		$query = "
			EXEC ListarDiagnosticoTransferencia :idCuenta";

		$params = [
			'idCuenta' => $lIdAtencion, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function ListarDiagnosticoEgreso($lIdAtencion)
	{
		$query = "
			EXEC ListarDiagnosticoEgreso :idCuenta";

		$params = [
			'idCuenta' => $lIdAtencion, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function ListarFacturacionServicioDespacho($lIdAtencion)
	{
		$query = "
			EXEC ListarFacturacionServicioDespacho :idCuenta ";

		$params = [
			'idCuenta ' => $lIdAtencion, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function ListarDiagnosticoCIE($lIdAtencion)
	{
		$query = "
			EXEC ListarDiagnosticoCIE10 :idCuenta";

		$params = [
			'idCuenta' => $lIdAtencion, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function ReporteParaHistoriaClinica1($lIdAtencion)
	{
		$query = "
			EXEC AtencionesReporteProcedencia :idAtencion";

		$params = [
			'idAtencion' => $lIdAtencion, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function SeleccionarUltimaAtencionHospitalizacion($lIdPaciente, $lTipoServicio)
	{
		$query = "
			EXEC atencionesMaxAtencionesXPacienteYTipoServicio :lIdPaciente, :lTipoServicio";

		$params = [
			'lIdPaciente' => $lIdPaciente, 
			'lTipoServicio' => $lTipoServicio, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function SeleccionarUltimaAtencion($lIdPaciente, $idCuentaAtencion)
	{
		$query = "
			EXEC AtencionesMaxAtencionesXPacienteYCuenta :lIdPaciente, :idCuentaAtencion";

		$params = [
			'lIdPaciente' => $lIdPaciente, 
			'idCuentaAtencion' => IdCuentaAtencion, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function FiltrarConsultaExterna($oDOPaciente, $oDOAtencion, $lcFechaIngreso, $idMedicoIngreso)
	{
		$query = "
			EXEC FiltrarConsultaExterna :lcFiltro";

		$params = [
			'lcFiltro' => sSql, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function FiltrarConsultorioEmergencia($oDOPaciente, $oDOAtencion)
	{
		$query = "
			EXEC AtencionesEmergenciaSegunFiltro :lcFiltro";

		$params = [
			'lcFiltro' => sSql, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function FiltrarObservacionEmergencia($oDOPaciente, $oDOAtencion)
	{
		$query = "
			EXEC AtencionesFiltrarObservacionEmergencia :lcFiltro";

		$params = [
			'lcFiltro' => sSql, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function FiltrarEmergencia($oDOPaciente, $oDOAtencion, $lcFechaIngreso)
	{
		$query = "
			EXEC AtencionesFiltrarEmergencia :lcFiltro";

		$params = [
			'lcFiltro' => sSql, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function FiltrarHospitalizacion($oDOPaciente, $oDOAtencion, $lcFechaIngreso)
	{
		$query = "
			EXEC AtencionesFiltrarHospitalizacion :lcFiltro";

		$params = [
			'lcFiltro' => sSql, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function FiltrarPacientesParaIngresarProcedimientos($oDOPaciente, $oDOCuentaAtencion)
	{
		$query = "
			EXEC AtencionesFiltrarPacientesParaIngresarProcedimientos :lcFiltro";

		$params = [
			'lcFiltro' => sSql, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function AtencionesSeleccionarCEPorCuentaPorHistoriaPorApellidosPorServicio($lnHistoriaClinica, $lnIdCuentaAtencion, $lcApellidoPaterno, $lcFechaIngreso, $lnIdServicio, $lcDNI)
	{
		$sWhere = "";
     	$sSql = "";
     	if ($lnHistoriaClinica <> "") { //'JHIMI 13032018 de > 0  a <> ""
			$sSql .=  " WHERE dbo.Pacientes.NroHistoriaClinica='" . $lnHistoriaClinica . "'" .
                      "      and dbo.Atenciones.IdServicioIngreso=" . $lnIdServicio . 
                      "      and dbo.Atenciones.idTipoServicio=1  and dbo.Atenciones.esPacienteExterno<>1" .
                      " order by Atenciones.FechaIngreso asc, Atenciones.HoraIngreso asc, Pacientes.ApellidoPaterno, Pacientes.ApellidoMaterno, Pacientes.PrimerNombre";
		}else if( $lnIdCuentaAtencion > 0 and $lnIdCuentaAtencion <> '') {
			$sSql .= " WHERE dbo.Atenciones.IdCuentaAtencion=" . $lnIdCuentaAtencion .
						"      and dbo.Atenciones.IdServicioIngreso=" . $lnIdServicio .
						"      and dbo.Atenciones.idTipoServicio=1  and dbo.Atenciones.esPacienteExterno<>1" .
						" order by Atenciones.FechaIngreso asc, Atenciones.HoraIngreso asc, Pacientes.ApellidoPaterno, Pacientes.ApellidoMaterno, Pacientes.PrimerNombre";
		}else if( $lcApellidoPaterno <> "") {
			$sSql .=  " WHERE dbo.Pacientes.ApellidoPaterno like '" . $lcApellidoPaterno . "%'" .
						"      and dbo.Atenciones.IdServicioIngreso=" . $lnIdServicio .
						"      and dbo.Atenciones.idTipoServicio=1  and dbo.Atenciones.esPacienteExterno<>1" .
						" order by Atenciones.FechaIngreso asc, Atenciones.HoraIngreso asc, Pacientes.ApellidoPaterno, Pacientes.ApellidoMaterno, Pacientes.PrimerNombre";

		}else if( $lcDNI <> "") {
			$sSql .= " WHERE dbo.Pacientes.idDocIdentidad=1 and dbo.Pacientes.nroDocumento='" . $lcDNI . "'" .
						"      and dbo.Atenciones.IdServicioIngreso=" . $lnIdServicio .
						"      and dbo.Atenciones.idTipoServicio=1  and dbo.Atenciones.esPacienteExterno<>1" .
						" order by Atenciones.FechaIngreso asc, Atenciones.HoraIngreso asc, Pacientes.ApellidoPaterno, Pacientes.ApellidoMaterno, Pacientes.PrimerNombre";
						;
		}else if( strtoupper($lcFechaIngreso) == "TODAS"){
			$sSql .=  " WHERE dbo.Atenciones.IdServicioIngreso=" . $lnIdServicio .
						"      and dbo.Atenciones.idTipoServicio=1  and dbo.Atenciones.esPacienteExterno<>1" .
						" order by Atenciones.FechaIngreso asc, Atenciones.HoraIngreso asc, Pacientes.ApellidoPaterno, Pacientes.ApellidoMaterno, Pacientes.PrimerNombre";
		}else{
			$sSql .= " WHERE dbo.Atenciones.FechaIngreso=CONVERT(DATETIME,'" . $lcFechaIngreso . "',103)" .
						"      and dbo.Atenciones.IdServicioIngreso=" . $lnIdServicio .
						"      and dbo.Atenciones.idTipoServicio=1  and dbo.Atenciones.esPacienteExterno<>1" .
						" order by Atenciones.FechaIngreso asc, Atenciones.HoraIngreso asc, Pacientes.ApellidoPaterno, Pacientes.ApellidoMaterno, Pacientes.PrimerNombre";
		}
		// dd($sSql);

		// dd([
		// 	'proc' => 'AtencionesSeleccionarCEPorCuentaPorHistoriaPorApellidosPorServicio',
		// 	'filtro' => $sSql
		// ]);

		$query = "
			EXEC AtencionesSeleccionarCEPorCuentaPorHistoriaPorApellidosPorServicio :lcFiltro";

		$params = [
			'lcFiltro' => $sSql, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function AtencionesSeleccionarEmergPorCuentaPorHistoriaPorApellidosPorServicio($lnHistoriaClinica, $lnIdCuentaAtencion, $lcApellidoPaterno, $lcFechaIngreso, $lnIdServicio, $lcDNI)
	{
		$query = "
			EXEC AtencionesSeleccionarEmergPorCuentaPorHistoriaPorApellidosPorServicio :lcFiltro";

		$params = [
			'lcFiltro' => sSql, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function AtencionesSeleccionarHospPorCuentaPorHistoriaPorApellidosPorServicio($lnHistoriaClinica, $lnIdCuentaAtencion, $lcApellidoPaterno, $lcFechaIngreso, $lnIdServicio, $lcDNI)
	{
		$query = "
			EXEC AtencionesSeleccionarHospPorCuentaPorHistoriaPorApellidosPorServicio :lcFiltro, :lcParametro289";

		$params = [
			'lcFiltro' => sSql, 
			'lcParametro289' => lcParametro289, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function AtencionesSeleccionarPacExtPorFechas1($ldFechaIni, $ldFechaFin)
	{
		$query = "
			EXEC AtencionesSeleccionarPacExtPorFechas :ldFechaIni, :ldFechaFin";

		$params = [
			'ldFechaIni' => $ldFechaIni, 
			'ldFechaFin' => $ldFechaFin, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function AtencionesSeleccionarPacExtPorCuentaHistoriaApellidosServPARTIC($lnHistoriaClinica, $lnIdCuentaAtencion, $lcApellidoPaterno)
	{
		$query = "
			EXEC AtencionesSeleccionarPacExtPorCuentaHistoriaApellidosServPARTIC :lcFiltro";

		$params = [
			'lcFiltro' => sSql, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function AtencionesSeleccionarPacExtPorCuentaHistoriaApellidosServSEGUROS()
	{
		$query = "
			EXEC AtencionesSeleccionarPacExtPorCuentaHistoriaApellidosServSEGUROS :lcFiltro";

		$params = [
			'lcFiltro' => sSql, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function SeleccionarXidCuentaAtencion($lnIdCuentaAtencion)
	{
		$query = "
			EXEC atencionesXIdCuentaAtencion :idCuentaAtencion";

		$params = [
			'idCuentaAtencion' => $lnIdCuentaAtencion, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function InsertarDatosAdicionalesAltaMedica($oTabla)
	{
		$query = "
			EXEC AtencionesDatosAdicionalesAltaInsertar :idCuenta, :pronostico, :recomendacionesyTratamiento, :enfermedadActual, :nroActaDef";

		$params = [
			'idCuenta' => $oTabla->idAtencion, 
			'pronostico' => ($oTabla->pronostico == "")? Null: $oTabla->pronostico, 
			'recomendacionesyTratamiento' => ($oTabla->recomendacionesyTratamiento == "")? Null: $oTabla->recomendacionesyTratamiento, 
			'enfermedadActual' => ($oTabla->enfermedadActual == "")? Null: $oTabla->enfermedadActual, 
			'nroActaDef' => ($oTabla->nroActaDef == "")? Null: $oTabla->nroActaDef, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function ListarDatosAltaMedica($lnIdAtencion)
	{
		$query = "
			EXEC ListarDatosAdicionalesAltaMedica :idAtencion";

		$params = [
			'idAtencion' => $lnIdAtencion, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function ListarMedicoEgreso($lnIdAtencion)
	{
		$query = "
			EXEC ListarMedicoEgresoAltaMedica :idAtencion";

		$params = [
			'idAtencion' => $lnIdAtencion, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function ReporteImpresionProcedimientos($lIdAtencion)
	{
		$query = "
			EXEC AtencionesReporteParaProcedimientos :idAtencion";

		$params = [
			'idAtencion' => $lIdAtencion, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function ImpresionCpt($lIdAtencion)
	{
		$query = "
			EXEC ImprimirProcedimientos :idAtencion";

		$params = [
			'idAtencion' => $lIdAtencion, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function ListarExamenCpt($lIdAtencion)
	{
		$query = "
			EXEC ListarExamenesConcepto :idCuenta";

		$params = [
			'idCuenta' => $lIdAtencion, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function ListarCantidadCpt($lIdAtencion)
	{
		$query = "
			EXEC ListarExamenesCantidad :idCuenta";

		$params = [
			'idCuenta' => $lIdAtencion, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function ObtenerDiagnosticoIngreso($lIdAtencion)
	{
		$query = "
			EXEC ListarDiagnosticoIngreso2 :idCuenta";

		$params = [
			'idCuenta' => $lIdAtencion, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function ObtenerDiagnosticoIngresoEyH($lIdAtencion)
	{
		$query = "
			EXEC ListarDiagnosticoIngreso :idCuenta";

		$params = [
			'idCuenta' => $lIdAtencion, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function ListarObservacionCPt($lIdAtencion)
	{
		$query = "
			EXEC ListarObservacionCpt :idCuenta";

		$params = [
			'idCuenta' => $lIdAtencion, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function ObtenerDatosAltaMedica($lnIdAtencion)
	{
		$query = "
			EXEC AtencionesDatosAltaMedica :idAtencion";

		$params = [
			'idAtencion' => $lnIdAtencion, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function InsertarUsuarioVH($oTabla)
	{
		$query = "
			EXEC Evolucion_configInsert :idUsuario";

		$params = [
			'idUsuario' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function InsertarUsuarioConcurrencia($oTabla)
	{
		$query = "
			EXEC Concurrencia_configInsert :idUsuario";

		$params = [
			'idUsuario' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function ModificarIndicadores($oTabla)
	{
		$query = "
			EXEC AtencionesModificarIndicadores :idAtencion, :fIngresoIndicador";

		$params = [
			'idAtencion' => ($oTabla->idAtencion == 0)? Null: $oTabla->idAtencion, 
			'fIngresoIndicador' => ($oTabla->fechaIngresoIndicador == 0)? Null: $oTabla->fechaIngresoIndicador, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

	public function ListarPacienteSIS($oTabla)
	{
		$query = "
			EXEC ListarPacienteSIS :idusuario";

		$params = [
			'idusuario' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function CambiarEstadoPacienteSIS($oTabla)
	{
		$query = "
			EXEC CambiarEstadoPaciente :nroDocumento, :idusuario";

		$params = [
			'nroDocumento' => $oTabla->nroDocumento, 
			'idusuario' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function TipoDiagnosticoMortalidad()
	{
		$query = "
			EXEC SubclasificacionDiagnosticosSeleccionarMortalidad ";

		$params = [
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function InsertarDiagMortalidad($oTabla)
	{
		$query = "
			DECLARE @idAtencionDiagnostico AS Int = :idAtencionDiagnostico
			SET NOCOUNT ON 
			EXEC AtencionesDiagnosticosAgregarMortalidad @idAtencionDiagnostico OUTPUT, :idSubclasificacionDx, :idClasificacionDx, :idDiagnostico, :idAtencion
			SELECT @idAtencionDiagnostico AS idAtencionDiagnostico";

		$params = [
			'idAtencionDiagnostico' => 0, 
			'idSubclasificacionDx' => ($oTabla->idSubClasificacionDX == 0)? Null: $oTabla->idSubClasificacionDX, 
			'idClasificacionDx' => ($oTabla->idClasificacionDx == 0)? Null: $oTabla->idClasificacionDx, 
			'idDiagnostico' => ($oTabla->idDiagnostico == 0)? Null: $oTabla->idDiagnostico, 
			'idAtencion' => ($oTabla->idAtencion == 0)? Null: $oTabla->idAtencion, 
		];

		$data = \DB::select($query, $params);

		$data = reset($data);

		return $data;
	}

	public function CargarDiagnosticosMortalidad($oTabla)
	{
		$query = "
			EXEC FiltrarDiagxAtencionMortalidad :idCuenta";

		$params = [
			'idCuenta' => $oTabla->idAtencion, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function EliminarDiagnosticoMortalidad($oTabla)
	{
		$query = "
			EXEC EliminarDiagnosticoMortalidad :idAtencionDiagnostico, :idAtencion";

		$params = [
			'idAtencionDiagnostico' => $oTabla->idAtencionDiagnostico, 
			'idAtencion' => $oTabla->idAtencion, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

	public function ReporteImpresionSEspecialidades($lIdAtencion)
	{
		$query = "
			EXEC AtencionesReporteParaEspecialidad :idAtencion";

		$params = [
			'idAtencion' => $lIdAtencion, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function ObtenerDiagnosticoIngresoEspecialidad($lIdAtencion)
	{
		$query = "
			EXEC ListarDiagnosticoIngresoParaEspecialidad :idAtencion";

		$params = [
			'idAtencion' => $lIdAtencion, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function ListarEspecialidadInterconsulta($lIdAtencion)
	{
		$query = "
			EXEC ListarDiagnosticosxIdAtencion :idAtencion";

		$params = [
			'idAtencion' => $lIdAtencion, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function ImpresionEspecialidades($lIdAtencion)
	{
		$query = "
			EXEC ImprimirEspecialidades :idAtencion";

		$params = [
			'idAtencion' => $lIdAtencion, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function ListarEspecialidadesyDiag($lIdAtencion)
	{
		$query = "
			EXEC ListarEspecialidadesyDiagporIdcuenta :idCuentaAtencion";

		$params = [
			'idCuentaAtencion' => $lIdAtencion, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function AtencionesHospXFechaIngreso($ms_FechaIngreso, $ml_TipoServicio)
	{
		$query = "
			EXEC AtencionesSeleccionarHospPorFechaIngreso :fechaIngreso, :tipoServicio";

		$params = [
			'fechaIngreso' => $ms_FechaIngreso, 
			'tipoServicio' => $ml_TipoServicio, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function AgregarContraRefenciaDestino($oTabla)
	{
		$query = "
			EXEC AgregarContraRefenciaDestino :idcuentaAtencion, :idTipoDestino, :tratamiento, :recomendaciones";

		$params = [
			'idcuentaAtencion' => ($oTabla->idCuentaAtencion == 0)? Null: $oTabla->idCuentaAtencion, 
			'idTipoDestino' => ($oTabla->idDestino == 0)? Null: $oTabla->idDestino, 
			'tratamiento' => ($oTabla->tratamiento == "")? Null: $oTabla->tratamiento, 
			'recomendaciones' => ($oTabla->recomendaciones == "")? Null: $oTabla->recomendaciones, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

}