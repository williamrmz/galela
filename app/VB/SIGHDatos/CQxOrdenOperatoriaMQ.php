<?php

namespace App\VB\SIGHDatos;

use Illuminate\Database\Eloquent\Model;

use DB;

class CQxOrdenOperatoriaMQ extends Model
{
	public function Insertar($oTabla)
	{
		$query = "
			DECLARE @idOrdenOperatoriaMQ AS Int = :idOrdenOperatoriaMQ
			SET NOCOUNT ON 
			EXEC CQxOrdenOperatoriaMQAgregar @idOrdenOperatoriaMQ OUTPUT, :idOrdenOperatoria, :idPaciente, :idMedico, :idGravedad, :idServicio, :fecha, :hora, :idCama, :programado, :fechaEstimadaQx, :observacion, :nroOrdenOperatoriaMQ, :estadoReg, :idUsuario, :estacion, :fechaReg, :idUsuarioAuditoria
			SELECT @idOrdenOperatoriaMQ AS idOrdenOperatoriaMQ";

		$params = [
			'idOrdenOperatoriaMQ' => 0, 
			'idOrdenOperatoria' => ($oTabla->idOrdenOperatoria == 0)? Null: $oTabla->idOrdenOperatoria, 
			'idPaciente' => ($oTabla->idPaciente == 0)? Null: $oTabla->idPaciente, 
			'idMedico' => ($oTabla->idMedico == 0)? Null: $oTabla->idMedico, 
			'idGravedad' => ($oTabla->idGravedad == 0)? Null: $oTabla->idGravedad, 
			'idServicio' => ($oTabla->idServicio == 0)? Null: $oTabla->idServicio, 
			'fecha' => ($oTabla->fecha == 0)? Null: $oTabla->fecha, 
			'hora' => ($oTabla->hora == "")? Null: $oTabla->hora, 
			'idCama' => ($oTabla->idCama == 0)? Null: $oTabla->idCama, 
			'programado' => ($oTabla->programado == 0)? Null: $oTabla->programado, 
			'fechaEstimadaQx' => ($oTabla->fechaEstimadaQx == 0)? Null: $oTabla->fechaEstimadaQx, 
			'observacion' => ($oTabla->observacion == "")? Null: $oTabla->observacion, 
			'nroOrdenOperatoriaMQ' => $oTabla->nroOrdenOperatoriaMQ, 
			'estadoReg' => ($oTabla->estadoReg == 0)? Null: $oTabla->estadoReg, 
			'idUsuario' => ($oTabla->idUsuario == 0)? Null: $oTabla->idUsuario, 
			'estacion' => $oTabla->estacion, 
			'fechaReg' => ($oTabla->fechaReg == 0)? Null: $oTabla->fechaReg, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::select($query, $params);

		$data = reset($data);

		return $data;
	}

	public function Modificar($oTabla)
	{
		$query = "
			EXEC CQxOrdenOperatoriaMQModificar :idOrdenOperatoriaMQ, :idOrdenOperatoria, :idPaciente, :idMedico, :idGravedad, :idServicio, :fecha, :hora, :idCama, :programado, :fechaEstimadaQx, :observacion, :nroOrdenOperatoriaMQ, :estadoReg, :idUsuario, :estacion, :fechaReg, :idUsuarioAuditoria";

		$params = [
			'idOrdenOperatoriaMQ' => ($oTabla->idOrdenOperatoriaMQ == 0)? Null: $oTabla->idOrdenOperatoriaMQ, 
			'idOrdenOperatoria' => ($oTabla->idOrdenOperatoria == 0)? Null: $oTabla->idOrdenOperatoria, 
			'idPaciente' => ($oTabla->idPaciente == 0)? Null: $oTabla->idPaciente, 
			'idMedico' => ($oTabla->idMedico == 0)? Null: $oTabla->idMedico, 
			'idGravedad' => ($oTabla->idGravedad == 0)? Null: $oTabla->idGravedad, 
			'idServicio' => ($oTabla->idServicio == 0)? Null: $oTabla->idServicio, 
			'fecha' => ($oTabla->fecha == 0)? Null: $oTabla->fecha, 
			'hora' => ($oTabla->hora == "")? Null: $oTabla->hora, 
			'idCama' => ($oTabla->idCama == 0)? Null: $oTabla->idCama, 
			'programado' => ($oTabla->programado == 0)? Null: $oTabla->programado, 
			'fechaEstimadaQx' => ($oTabla->fechaEstimadaQx == 0)? Null: $oTabla->fechaEstimadaQx, 
			'observacion' => ($oTabla->observacion == "")? Null: $oTabla->observacion, 
			'nroOrdenOperatoriaMQ' => $oTabla->nroOrdenOperatoriaMQ, 
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
			EXEC CQxOrdenOperatoriaMQEliminar :idOrdenOperatoriaMQ, :idUsuarioAuditoria";

		$params = [
			'idOrdenOperatoriaMQ' => $oTabla->idOrdenOperatoriaMQ, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

	public function SeleccionarPorId($oTabla)
	{
		$query = "
			EXEC CQxOrdenOperatoriaMQSeleccionarPorId :idOrdenOperatoriaMQ";

		$params = [
			'idOrdenOperatoriaMQ' => $oTabla->idOrdenOperatoriaMQ, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function SeleccionarPorIdMedicos($oTabla)
	{
		$query = "
			EXEC CQxObtMEdicosOperacionSuspendida :idordenoperatoriamq";

		$params = [
			'idordenoperatoriamq' => $oTabla->idOrdenOperatoriaMQ, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function FiltrarMQ($oDOCQxOrdenOperatoriaMQ)
	{
		$query = "
			EXEC CQxOrdenOperatoriaMQFiltrar :lcFiltro";

		$params = [
			'lcFiltro' => sSql, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function FiltrarMQProgramados($oDOCQxOrdenOperatoriaMQ)
	{
		$query = "
			EXEC CQxOrdenOperatoriaMQFiltrar :lcFiltro";

		$params = [
			'lcFiltro' => sSql, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function SeleccionarTodos()
	{
		$query = "
			EXEC CQxOrdenOperatoriaMQListar ";

		$params = [
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function ListarFormatoOperacionesSuspendidas($adoOp)
	{
		$query = "
			EXEC OperacionesSuspendidasListar :idordenoperatoriamq, :idProgramacionSala";

		$params = [
			'idordenoperatoriamq' => $adoOp->idOrdenOperatoriaMQ, 
			'idProgramacionSala' => $adoOp->idProgramacion, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function ListarMedico($lnIdPaciente)
	{
		$query = "
			EXEC CQxObtMEdicosOperacionSuspendida :idordenoperatoriamq";

		$params = [
			'idordenoperatoriamq' => $lnIdPaciente, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function SeleccionarAtencionesParaOrdenOpe()
	{
		$query = "
			EXEC AtencionesParaOrdenOperatoria ";

		$params = [
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function CopiarDiagnosticosaMQ($oTabla)
	{
		$query = "
			EXEC AgregarDiagnosticosMQ :idAtencion, :idOrdenOperatoria, :idUsuario, :estacion";

		$params = [
			'idAtencion' => ($oTabla->nrocuenta == 0)? Null: $oTabla->nrocuenta, 
			'idOrdenOperatoria' => ($oTabla->idOrdenOperatoria == 0)? Null: $oTabla->idOrdenOperatoria, 
			'idUsuario' => ($oTabla->idUsuario == 0)? Null: $oTabla->idUsuario, 
			'estacion' => $oTabla->estacion, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

}