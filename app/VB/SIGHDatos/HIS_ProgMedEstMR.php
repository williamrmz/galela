<?php

namespace App\VB\SIGHDatos;

use Illuminate\Database\Eloquent\Model;

use DB;

class HIS_ProgMedEstMR extends Model
{
	public function Insertar($oTabla)
	{
		$query = "
			DECLARE @idHisProgMedEstMR AS Int = :idHisProgMedEstMR
			SET NOCOUNT ON 
			EXEC HIS_ProgMedEstMRAgregar @idHisProgMedEstMR OUTPUT, :idMedico, :idServicio, :idEstablecimiento, :fechaProgramada, :idTurno, :idUsuarioAuditoria
			SELECT @idHisProgMedEstMR AS idHisProgMedEstMR";

		$params = [
			'idHisProgMedEstMR' => 0, 
			'idMedico' => ($oTabla->idMedico == 0)? Null: $oTabla->idMedico, 
			'idServicio' => ($oTabla->idServicio == 0)? Null: $oTabla->idServicio, 
			'idEstablecimiento' => ($oTabla->idEstablecimiento == 0)? Null: $oTabla->idEstablecimiento, 
			'fechaProgramada' => ($oTabla->fechaProgramada == 0)? Null: $oTabla->fechaProgramada, 
			'idTurno' => ($oTabla->idTurno == 0)? Null: $oTabla->idTurno, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::select($query, $params);

		$data = reset($data);

		return $data;
	}

	public function Modificar($oTabla)
	{
		$query = "
			EXEC HIS_ProgMedEstMRModificar :idHisProgMedEstMR, :idMedico, :idServicio, :idEstablecimiento, :fechaProgramada, :idTurno, :idUsuarioAuditoria";

		$params = [
			'idHisProgMedEstMR' => ($oTabla->idHisProgMedEstMR == 0)? Null: $oTabla->idHisProgMedEstMR, 
			'idMedico' => ($oTabla->idMedico == 0)? Null: $oTabla->idMedico, 
			'idServicio' => ($oTabla->idServicio == 0)? Null: $oTabla->idServicio, 
			'idEstablecimiento' => ($oTabla->idEstablecimiento == 0)? Null: $oTabla->idEstablecimiento, 
			'fechaProgramada' => ($oTabla->fechaProgramada == 0)? Null: $oTabla->fechaProgramada, 
			'idTurno' => ($oTabla->idTurno == 0)? Null: $oTabla->idTurno, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

	public function Eliminar($oTabla)
	{
		$query = "
			EXEC HIS_ProgMedEstMREliminar :idHisProgMedEstMR, :idUsuarioAuditoria";

		$params = [
			'idHisProgMedEstMR' => $oTabla->idHisProgMedEstMR, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

	public function SeleccionarPorId($oTabla)
	{
		$query = "
			EXEC HIS_ProgMedEstMRSeleccionarPorId :idHisProgMedEstMR";

		$params = [
			'idHisProgMedEstMR' => $oTabla->idHisProgMedEstMR, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function ObtenerDatosProgramacionMedica($idEstablecimiento, $idServicio, $idMedico, $anio, $idMes, $idTurno)
	{
		$query = "
			EXEC HIS_ProgMedEstMRxMedicoMesYanio :idEstablecimiento, :idServicio, :idMedico, :idMes, :anio, :idTurno";

		$params = [
			'idEstablecimiento' => IdEstablecimiento, 
			'idServicio' => IdServicio, 
			'idMedico' => IdMedico, 
			'idMes' => IdMes, 
			'anio' => Anio, 
			'idTurno' => IdTurno, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function ListaServiciosPorEstablecimientoYEspecialidad($idEspecialidad, $idEstablecimiento)
	{
		$query = "
			EXEC HIS_ServEstablecimientoXespecialidadEstablecimiento :idEspecialidad, :idEstablecimiento";

		$params = [
			'idEspecialidad' => IdEspecialidad, 
			'idEstablecimiento' => IdEstablecimiento, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function ListarProgramacionMedica_FechasMesActual($idMedico, $ms_Fecha)
	{
		$query = "
			EXEC HIS_ProgMedEstMRporMedicoAnioMes :idMedico, :ms_Fecha";

		$params = [
			'idMedico' => IdMedico, 
			'ms_Fecha' => CDate($ms_Fecha), 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function ListarProgramacionMedicaPorMedicoYEstablecimiento($idEstablecimiento, $idMedico, $mes, $anio)
	{
		$query = "
			EXEC HIS_ProgMedEstMRporMedicoEstablecFecha :idMedico, :idEstablecimiento, :anio, :mes";

		$params = [
			'idMedico' => IdMedico, 
			'idEstablecimiento' => IdEstablecimiento, 
			'anio' => Anio, 
			'mes' => Mes, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function ValidarMedicoEstablecimiento($ml_IdMedico, $idEstabelecimiento)
	{
		$query = "
			EXEC EMPLEADOSporIdMedicoIdEstablecimiento :ml_IdMedico, :idEstablecimiento";

		$params = [
			'ml_IdMedico' => $ml_IdMedico, 
			'idEstablecimiento' => IdEstabelecimiento, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function HIS_BuscaResponsableFiltro($lnIdEstablecimiento, $lnIdServicio, $lcAnio, $lcmes, $lcNombre)
	{
		$query = "
			EXEC HIS_BuscaResponsableFiltro :idEstablecimiento, :idservicio, :anio, :mes, :nombre";

		$params = [
			'idEstablecimiento' => $lnIdEstablecimiento, 
			'idservicio' => $lnIdServicio, 
			'anio' => LcAnio, 
			'mes' => Lcmes, 
			'nombre' => $lcNombre, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

}