<?php

namespace App\VB\SIGHDatos;

use Illuminate\Database\Eloquent\Model;

use DB;

class LabMovimiento extends Model
{
	public function Insertar($oTabla)
	{
		$query = "
			DECLARE @idMovimiento AS Int = :idMovimiento
			SET NOCOUNT ON 
			EXEC LabMovimientoAgregar @idMovimiento OUTPUT, :movTipo, :idTipoConcepto, :idPuntoCarga, :fecha, :idUsuario, :idLabEstado, :idUsuarioAuditoria
			SELECT @idMovimiento AS idMovimiento";

		$params = [
			'idMovimiento' => 0, 
			'movTipo' => ($oTabla->movTipo == "")? Null: $oTabla->movTipo, 
			'idTipoConcepto' => ($oTabla->idTipoConcepto == 0)? Null: $oTabla->idTipoConcepto, 
			'idPuntoCarga' => ($oTabla->idPuntoCarga == 0)? Null: $oTabla->idPuntoCarga, 
			'fecha' => ($oTabla->fecha == 0)? Null: $oTabla->fecha, 
			'idUsuario' => ($oTabla->idUsuario == 0)? Null: $oTabla->idUsuario, 
			'idLabEstado' => ($oTabla->idLabEstado == 0)? Null: $oTabla->idLabEstado, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::select($query, $params);

		$data = reset($data);

		return $data;
	}

	public function Modificar($oTabla)
	{
		$query = "
			EXEC LabMovimientoModificar :idMovimiento, :movTipo, :idTipoConcepto, :idPuntoCarga, :fecha, :idUsuario, :idLabEstado, :idUsuarioAuditoria";

		$params = [
			'idMovimiento' => ($oTabla->idMovimiento == 0)? Null: $oTabla->idMovimiento, 
			'movTipo' => ($oTabla->movTipo == "")? Null: $oTabla->movTipo, 
			'idTipoConcepto' => ($oTabla->idTipoConcepto == 0)? Null: $oTabla->idTipoConcepto, 
			'idPuntoCarga' => ($oTabla->idPuntoCarga == 0)? Null: $oTabla->idPuntoCarga, 
			'fecha' => ($oTabla->fecha == 0)? Null: $oTabla->fecha, 
			'idUsuario' => ($oTabla->idUsuario == 0)? Null: $oTabla->idUsuario, 
			'idLabEstado' => $oTabla->idLabEstado, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

	public function Eliminar($oTabla)
	{
		$query = "
			EXEC LabMovimientoEliminar :idMovimiento, :idUsuarioAuditoria";

		$params = [
			'idMovimiento' => $oTabla->idMovimiento, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

	public function SeleccionarPorId($oTabla)
	{
		$query = "
			EXEC LabMovimientoSeleccionarPorId :idMovimiento";

		$params = [
			'idMovimiento' => $oTabla->idMovimiento, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

}