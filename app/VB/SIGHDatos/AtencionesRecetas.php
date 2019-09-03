<?php

namespace App\VB\SIGHDatos;

use Illuminate\Database\Eloquent\Model;

use DB;

class AtencionesRecetas extends Model
{
	public function Insertar($oTabla)
	{
		$query = "
			DECLARE @idAtencionReceta AS Char = :idAtencionReceta
			SET NOCOUNT ON 
			EXEC AtencionesRecetasAgregar :idMedico, :idServicio, :fechaReceta, :nroReceta, :idCuentaAtencion, @idAtencionReceta OUTPUT, :idUsuarioAuditoria
			SELECT @idAtencionReceta AS idAtencionReceta";

		$params = [
			'idMedico' => ($oTabla->idMedico == 0)? Null: $oTabla->idMedico, 
			'idServicio' => ($oTabla->idServicio == 0)? Null: $oTabla->idServicio, 
			'fechaReceta' => ($oTabla->fechaReceta == 0)? Null: $oTabla->fechaReceta, 
			'nroReceta' => ($oTabla->nroReceta == "")? Null: $oTabla->nroReceta, 
			'idCuentaAtencion' => ($oTabla->idCuentaAtencion == 0)? Null: $oTabla->idCuentaAtencion, 
			'idAtencionReceta' => 0, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::select($query, $params);

		$data = reset($data);

		return $data;
	}

	public function Modificar($oTabla)
	{
		$query = "
			EXEC AtencionesRecetasModificar :idMedico, :idServicio, :fechaReceta, :nroReceta, :idCuentaAtencion, :idAtencionReceta, :idUsuarioAuditoria";

		$params = [
			'idMedico' => ($oTabla->idMedico == 0)? Null: $oTabla->idMedico, 
			'idServicio' => ($oTabla->idServicio == 0)? Null: $oTabla->idServicio, 
			'fechaReceta' => ($oTabla->fechaReceta == 0)? Null: $oTabla->fechaReceta, 
			'nroReceta' => ($oTabla->nroReceta == "")? Null: $oTabla->nroReceta, 
			'idCuentaAtencion' => ($oTabla->idCuentaAtencion == 0)? Null: $oTabla->idCuentaAtencion, 
			'idAtencionReceta' => ($oTabla->idAtencionReceta == 0)? Null: $oTabla->idAtencionReceta, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

	public function Eliminar($oTabla)
	{
		$query = "
			EXEC AtencionesRecetasEliminar :idAtencionReceta, :idUsuarioAuditoria";

		$params = [
			'idAtencionReceta' => ($oTabla->idAtencionReceta == 0)? Null: $oTabla->idAtencionReceta, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

	public function SeleccionarPorId($oTabla)
	{
		$query = "
			EXEC AtencionesRecetasSeleccionarPorId :idAtencionReceta";

		$params = [
			'idAtencionReceta' => $oTabla->idAtencionReceta, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

}