<?php

namespace App\VB\SIGHDatos;

use Illuminate\Database\Eloquent\Model;

use DB;

class SExBasiloscopia extends Model
{
	public function Insertar($oTabla)
	{
		$query = "
			DECLARE @idSolicitudBaciloscopia AS Int = :idSolicitudBaciloscopia
			SET NOCOUNT ON 
			EXEC SolicitudExamenBaciloscopiaAgregar @idSolicitudBaciloscopia OUTPUT, :idCuentaAtencion, :idTipoMuestra, :especificar, :idAntecedenteTratamiento, :srDiagnostico, :segDiagnostico, :rxAnormalDiagnostico, :otroDiagnostico, :idControlTratamiento, :idExSolicitado, :descripcionSolicitados, :pruebaSensibilidadRapida, :especificarPruebaRapida, :pruebaSensibilidadConvencional, :especificarPruebaConvencional, :otroExamen, :factorRiesgo, :fechaObtencionMuestra, :idCAlidadMuestraBaciloscopia, :observaciones, :usuarioRegistro
			SELECT @idSolicitudBaciloscopia AS idSolicitudBaciloscopia";

		$params = [
			'idSolicitudBaciloscopia' => 0, 
			'idCuentaAtencion' => ($oTabla->idCuentaAtencion == 0)? Null: $oTabla->idCuentaAtencion, 
			'idTipoMuestra' => ($oTabla->idTipoMuestra == 0)? Null: $oTabla->idTipoMuestra, 
			'especificar' => ($oTabla->especificar == "")? Null: $oTabla->especificar, 
			'idAntecedenteTratamiento' => ($oTabla->idAntecedenteTratamiento == 0)? Null: $oTabla->idAntecedenteTratamiento, 
			'srDiagnostico' => ($oTabla->srDiagnostico == 0)? Null: $oTabla->srDiagnostico, 
			'segDiagnostico' => ($oTabla->segDiagnostico == 0)? Null: $oTabla->segDiagnostico, 
			'rxAnormalDiagnostico' => ($oTabla->rxAnormalDiagnostico == 0)? Null: $oTabla->rxAnormalDiagnostico, 
			'otroDiagnostico' => ($oTabla->otroDiagnostico == "")? Null: $oTabla->otroDiagnostico, 
			'idControlTratamiento' => ($oTabla->idControlTratamiento == 0)? Null: $oTabla->idControlTratamiento, 
			'idExSolicitado' => ($oTabla->idExSolicitado == 0)? Null: $oTabla->idExSolicitado, 
			'descripcionSolicitados' => ($oTabla->descripcionSolicitados == 0)? Null: $oTabla->descripcionSolicitados, 
			'pruebaSensibilidadRapida' => ($oTabla->pruebaSensibilidadRapida == 0)? Null: $oTabla->pruebaSensibilidadRapida, 
			'especificarPruebaRapida' => ($oTabla->especificarPruebaRapida == "")? Null: $oTabla->especificarPruebaRapida, 
			'pruebaSensibilidadConvencional' => ($oTabla->pruebaSensibilidadConvencional == 0)? Null: $oTabla->pruebaSensibilidadConvencional, 
			'especificarPruebaConvencional' => ($oTabla->especificarPruebaConvencional == "")? Null: $oTabla->especificarPruebaConvencional, 
			'otroExamen' => ($oTabla->otroExamen == "")? Null: $oTabla->otroExamen, 
			'factorRiesgo' => ($oTabla->factorRiesgo == "")? Null: $oTabla->factorRiesgo, 
			'fechaObtencionMuestra' => $oTabla->fechaObtencionMuestra, 
			'idCAlidadMuestraBaciloscopia' => ($oTabla->idCAlidadMuestraBaciloscopia == 0)? Null: $oTabla->idCAlidadMuestraBaciloscopia, 
			'observaciones' => ($oTabla->observaciones == "")? Null: $oTabla->observaciones, 
			'usuarioRegistro' => ($oTabla->usuarioRegistro == 0)? Null: $oTabla->usuarioRegistro, 
		];

		$data = \DB::select($query, $params);

		$data = reset($data);

		return $data;
	}

	public function ListarBasiloscopiaporCuenta($idCuentaAtencion)
	{
		$query = "
			EXEC SolicitudExamenBaciloscopiaListarporCuenta :idcuentaAtencion";

		$params = [
			'idcuentaAtencion' => IdCuentaAtencion, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function Modificar($oTabla)
	{
		$query = "
			EXEC SolicitudExamenBaciloscopiaModificar :idSolicitudBaciloscopia, :idCuentaAtencion, :idTipoMuestra, :especificar, :idAntecedenteTratamiento, :srDiagnostico, :segDiagnostico, :rxAnormalDiagnostico, :otroDiagnostico, :idControlTratamiento, :idExSolicitado, :descripcionSolicitados, :pruebaSensibilidadRapida, :especificarPruebaRapida, :pruebaSensibilidadConvencional, :especificarPruebaConvencional, :otroExamen, :factorRiesgo, :fechaObtencionMuestra, :idCAlidadMuestraBaciloscopia, :observaciones, :idUsuarioAuditoria";

		$params = [
			'idSolicitudBaciloscopia' => ($oTabla->idSolicitudBaciloscopia == 0)? Null: $oTabla->idSolicitudBaciloscopia, 
			'idCuentaAtencion' => ($oTabla->idCuentaAtencion == 0)? Null: $oTabla->idCuentaAtencion, 
			'idTipoMuestra' => ($oTabla->idTipoMuestra == 0)? Null: $oTabla->idTipoMuestra, 
			'especificar' => ($oTabla->especificar == "")? Null: $oTabla->especificar, 
			'idAntecedenteTratamiento' => ($oTabla->idAntecedenteTratamiento == 0)? Null: $oTabla->idAntecedenteTratamiento, 
			'srDiagnostico' => ($oTabla->srDiagnostico == 0)? Null: $oTabla->srDiagnostico, 
			'segDiagnostico' => ($oTabla->segDiagnostico == 0)? Null: $oTabla->segDiagnostico, 
			'rxAnormalDiagnostico' => ($oTabla->rxAnormalDiagnostico == 0)? Null: $oTabla->rxAnormalDiagnostico, 
			'otroDiagnostico' => ($oTabla->otroDiagnostico == "")? Null: $oTabla->otroDiagnostico, 
			'idControlTratamiento' => ($oTabla->idControlTratamiento == 0)? Null: $oTabla->idControlTratamiento, 
			'idExSolicitado' => ($oTabla->idExSolicitado == 0)? Null: $oTabla->idExSolicitado, 
			'descripcionSolicitados' => ($oTabla->descripcionSolicitados == 0)? Null: $oTabla->descripcionSolicitados, 
			'pruebaSensibilidadRapida' => ($oTabla->pruebaSensibilidadRapida == 0)? Null: $oTabla->pruebaSensibilidadRapida, 
			'especificarPruebaRapida' => ($oTabla->especificarPruebaRapida == "")? Null: $oTabla->especificarPruebaRapida, 
			'pruebaSensibilidadConvencional' => ($oTabla->pruebaSensibilidadConvencional == 0)? Null: $oTabla->pruebaSensibilidadConvencional, 
			'especificarPruebaConvencional' => ($oTabla->especificarPruebaConvencional == "")? Null: $oTabla->especificarPruebaConvencional, 
			'otroExamen' => ($oTabla->otroExamen == "")? Null: $oTabla->otroExamen, 
			'factorRiesgo' => ($oTabla->factorRiesgo == "")? Null: $oTabla->factorRiesgo, 
			'fechaObtencionMuestra' => $oTabla->fechaObtencionMuestra, 
			'idCAlidadMuestraBaciloscopia' => $oTabla->idCAlidadMuestraBaciloscopia, 
			'observaciones' => ($oTabla->observaciones == "")? Null: $oTabla->observaciones, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

	public function Eliminar($oTabla)
	{
		$query = "
			EXEC SolicitudExamenBaciloscopiaEliminar :idSolicitudBaciloscopia, :idUsuarioAuditoria";

		$params = [
			'idSolicitudBaciloscopia' => $oTabla->idSolicitudBaciloscopia, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

	public function SeleccionarPorId($oTabla)
	{
		$query = "
			EXEC SolicitudExamenBaciloscopiaSeleccionarPorId :idSolicitudBaciloscopia";

		$params = [
			'idSolicitudBaciloscopia' => $oTabla->idCuentaAtencion, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function ListarReporteBaciloscopia($lIdAtencion)
	{
		$query = "
			EXEC ReporteBaciloscopia :idCuentaAtencion";

		$params = [
			'idCuentaAtencion' => $lIdAtencion, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function FiltrarBaciloscopia($hc, $lIdCuentaAtencion, $nombres, $nroMovimiento)
	{
		$query = "
			EXEC FiltrarBaciloscopia :hc, :idcuentaAtencion, :nombres, :nroMovimiento";

		$params = [
			'hc' => $hc, 
			'idcuentaAtencion' => $lIdCuentaAtencion, 
			'nombres' => Nombres, 
			'nroMovimiento' => NroMovimiento, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

}