<?php

namespace App\VB\SIGHDatos;

use Illuminate\Database\Eloquent\Model;

use DB;

class Consentimientos extends Model
{
	public function BuscarConcentimientos($aDOConsent)
	{
		$query = "
			EXEC pa_CQxObtenerConsentimientos :sparam";

		$params = [
			'sparam' => sSql, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function BuscarConcentimientosAgregados($aDOConsent)
	{
		$query = "
			EXEC pa_CQxObtenerConsentimientosAgregados :idOOperat, :idOOperatMQ";

		$params = [
			'idOOperat' => $aDOConsent->idOrdenOperatoria, 
			'idOOperatMQ' => $aDOConsent->idOrdenOperatoriaMQ, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function BuscarOrdenOperat($aDOConsent)
	{
		$query = "
			EXEC pa_CQxObtenerDtsOOpe :idOOperat";

		$params = [
			'idOOperat' => $aDOConsent->idOrdenOperatoria, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function BuscarOrdenOperatMQ($aDOConsent)
	{
		$query = "
			EXEC pa_CQxObtenerDtsOOMQ :idOOperatMQ";

		$params = [
			'idOOperatMQ' => $aDOConsent->idOrdenOperatoriaMQ, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function Insertar($oTabla)
	{
		$query = "
			DECLARE @idConsentimientoInformadoCab AS Int = :idConsentimientoInformadoCab
			SET NOCOUNT ON 
			EXEC CQxConsentimientoInformadoCabAgregar @idConsentimientoInformadoCab OUTPUT, :idPaciente, :idUsuario, :estacion
			SELECT @idConsentimientoInformadoCab AS idConsentimientoInformadoCab";

		$params = [
			'idConsentimientoInformadoCab' => 0, 
			'idPaciente' => ($oTabla->idPaciente == 0)? Null: $oTabla->idPaciente, 
			'idUsuario' => ($oTabla->idUsuario == 0)? Null: $oTabla->idUsuario, 
			'estacion' => $oTabla->estacion, 
		];

		$data = \DB::select($query, $params);

		$data = reset($data);

		return $data;
	}

	public function Modificar($oTabla)
	{
		$query = "
			EXEC CQxConsentimientoInformadoCabModificar :idConsentimientoInformadoCab, :idPaciente, :fecha, :estadoReg, :idUsuario, :estacion, :fechaReg, :idUsuarioAuditoria";

		$params = [
			'idConsentimientoInformadoCab' => ($oTabla->idConsentimientoInformadoCab == 0)? Null: $oTabla->idConsentimientoInformadoCab, 
			'idPaciente' => ($oTabla->idPaciente == 0)? Null: $oTabla->idPaciente, 
			'fecha' => ($oTabla->fecha == 0)? Null: $oTabla->fecha, 
			'estadoReg' => ($oTabla->estadoReg == 0)? Null: $oTabla->estadoReg, 
			'idUsuario' => ($oTabla->idUsuario == 0)? Null: $oTabla->idUsuario, 
			'estacion' => $oTabla->estacion, 
			'fechaReg' => ($oTabla->fechaReg == 0)? Null: $oTabla->fechaReg, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

	public function Eliminar($oTabla)
	{
		$query = "
			EXEC CQxConsentimientoInformadoCabEliminar :idConsentimientoInformadoCab, :idUsuarioAuditoria";

		$params = [
			'idConsentimientoInformadoCab' => $oTabla->idConsentimientoInformadoCab, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

	public function SeleccionarPorId($oTabla)
	{
		$query = "
			EXEC CQxConsentimientoInformadoCabSeleccionarPorId :idConsentimientoInformadoCab";

		$params = [
			'idConsentimientoInformadoCab' => $oTabla->idConsentimientoInformadoCab, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function InsertarCID($oTabla)
	{
		$query = "
			DECLARE @idConsentimientoInformadoDet AS Int = :idConsentimientoInformadoDet
			SET NOCOUNT ON 
			EXEC CQxConsentimientoInformadoDetAgregar @idConsentimientoInformadoDet OUTPUT, :idConsentimientoInformadoCab, :observacion, :idOrdenOperatoria, :idOrdenOperatoriaMQ, :idMedico, :hora, :nroConsentimientoInformadoDet, :idUsuario, :estacion, :idS
			SELECT @idConsentimientoInformadoDet AS idConsentimientoInformadoDet";

		$params = [
			'idConsentimientoInformadoDet' => 0, 
			'idConsentimientoInformadoCab' => ($oTabla->idConsentimientoInformadoCab == 0)? Null: $oTabla->idConsentimientoInformadoCab, 
			'observacion' => ($oTabla->observacion == "")? Null: $oTabla->observacion, 
			'idOrdenOperatoria' => ($oTabla->idOrdenOperatoria == 0)? Null: $oTabla->idOrdenOperatoria, 
			'idOrdenOperatoriaMQ' => ($oTabla->idOrdenOperatoriaMQ == 0)? Null: $oTabla->idOrdenOperatoriaMQ, 
			'idMedico' => ($oTabla->idMedico == 0)? Null: $oTabla->idMedico, 
			'hora' => $oTabla->hora, 
			'nroConsentimientoInformadoDet' => $oTabla->nroConsentimientoInformadoDet, 
			'idUsuario' => ($oTabla->idUsuario == 0)? Null: $oTabla->idUsuario, 
			'estacion' => $oTabla->estacion, 
			'idS' => ($oTabla->idS == 0)? Null: $oTabla->idS, 
		];

		$data = \DB::select($query, $params);

		$data = reset($data);

		return $data;
	}

	public function EliminarCID($oTabla)
	{
		$query = "
			EXEC CQxConsentimientoInformadoDetEliminar :idConsentimientoInformadoDet";

		$params = [
			'idConsentimientoInformadoDet' => $oTabla->idConsentimientoInformadoDet, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

	public function InsertarC($oTabla)
	{
		$query = "
			DECLARE @idCorrelativo AS Int = :idCorrelativo
			SET NOCOUNT ON 
			EXEC CQxCorrelativoAgregar @idCorrelativo OUTPUT, :descripcion, :idS, :idUsuario, :estacion
			SELECT @idCorrelativo AS idCorrelativo";

		$params = [
			'idCorrelativo' => 0, 
			'descripcion' => ($oTabla->descripcion == "")? Null: $oTabla->descripcion, 
			'idS' => ($oTabla->idS == 0)? Null: $oTabla->idS, 
			'idUsuario' => ($oTabla->idUsuario == 0)? Null: $oTabla->idUsuario, 
			'estacion' => $oTabla->estacion, 
		];

		$data = \DB::select($query, $params);

		$data = reset($data);

		return $data;
	}

	public function ListarDiagnosticoOO($oTabla)
	{
		$query = "
			EXEC pa_CQxListarDiagnosticoxOO :idPs";

		$params = [
			'idPs' => $oTabla->idProgramacionSala, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function CQx_CQxListarDiagnosticoxOO($idOrdenOperatoria)
	{
		$query = "
			EXEC Uknown ";

		$params = [
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function ListarProductoPs($oTabla)
	{
		$query = "
			EXEC pa_CQxListarProductoPs :idPs";

		$params = [
			'idPs' => $oTabla->idProgramacionSala, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function BuscarMedicoPs($aDOConsent)
	{
		$query = "
			EXEC pa_CQxObtenerMedicoPs :idPs";

		$params = [
			'idPs' => $aDOConsent->idProgramacionSala, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

}