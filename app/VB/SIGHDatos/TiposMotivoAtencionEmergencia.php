<?php

namespace App\VB\SIGHDatos;

use Illuminate\Database\Eloquent\Model;

use DB;

class TiposMotivoAtencionEmergencia extends Model
{
	public function Insertar($oTabla)
	{
		$query = "
			DECLARE @idMotivoAtencionEmergencia AS Int = :idMotivoAtencionEmergencia
			SET NOCOUNT ON 
			EXEC TiposMotivoAtencionEmergenciaAgregar @idMotivoAtencionEmergencia OUTPUT, :descripcion, :idPrioridadEmergencia, :estadoReg, :idUsuario, :estacion, :fechaReg, :idUsuarioAuditoria
			SELECT @idMotivoAtencionEmergencia AS idMotivoAtencionEmergencia";

		$params = [
			'idMotivoAtencionEmergencia' => 0, 
			'descripcion' => ($oTabla->descripcion == "")? Null: $oTabla->descripcion, 
			'idPrioridadEmergencia' => ($oTabla->idPrioridadEmergencia == 0)? Null: $oTabla->idPrioridadEmergencia, 
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
			EXEC TiposMotivoAtencionEmergenciaModificar :idMotivoAtencionEmergencia, :descripcion, :idPrioridadEmergencia, :estadoReg, :idUsuario, :estacion, :fechaReg, :idUsuarioAuditoria";

		$params = [
			'idMotivoAtencionEmergencia' => ($oTabla->idMotivoAtencionEmergencia == 0)? Null: $oTabla->idMotivoAtencionEmergencia, 
			'descripcion' => ($oTabla->descripcion == "")? Null: $oTabla->descripcion, 
			'idPrioridadEmergencia' => ($oTabla->idPrioridadEmergencia == 0)? Null: $oTabla->idPrioridadEmergencia, 
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
			EXEC TiposMotivoAtencionEmergenciaEliminar :idMotivoAtencionEmergencia, :idUsuarioAuditoria";

		$params = [
			'idMotivoAtencionEmergencia' => $oTabla->idMotivoAtencionEmergencia, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

	public function SeleccionarPorId($oTabla)
	{
		$query = "
			EXEC TiposMotivoAtencionEmergenciaSeleccionarPorId :idMotivoAtencionEmergencia";

		$params = [
			'idMotivoAtencionEmergencia' => $oTabla->idMotivoAtencionEmergencia, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function Filtrar($oDOCQxOrdenOperatoriaMQ)
	{
		$query = "
			EXEC TiposMotivoAtencionFiltrar :lcFiltro";

		$params = [
			'lcFiltro' => sSql, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function SeleccionarPorIdx($oTabla)
	{
		$query = "
			EXEC TiposMotivoAtencionEmergenciaSeleccionarPorId :idMotivoAtencionEmergencia";

		$params = [
			'idMotivoAtencionEmergencia' => $oTabla->idMotivoAtencionEmergencia, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function SeleccionarPorIdTriaje($oTabla)
	{
		$query = "
			EXEC TiposMotivoAtencionEmergenciaSeleccionarPorIdTriaje :idMotivoAtencionEmergencia";

		$params = [
			'idMotivoAtencionEmergencia' => $oTabla->idTriajeEmergencia, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

}