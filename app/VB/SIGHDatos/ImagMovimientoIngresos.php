<?php

namespace App\VB\SIGHDatos;

use Illuminate\Database\Eloquent\Model;

use DB;

class ImagMovimientoIngresos extends Model
{
	public function Insertar($oTabla)
	{
		$query = "
			EXEC ImagMovimientoIngresosAgregar :idMovimiento, :nroDocumento, :idPersonaRecepciona, :idUsuarioAuditoria";

		$params = [
			'idMovimiento' => ($oTabla->idMovimiento == 0)? Null: $oTabla->idMovimiento, 
			'nroDocumento' => ($oTabla->nroDocumento == "")? Null: $oTabla->nroDocumento, 
			'idPersonaRecepciona' => ($oTabla->idPersonaRecepciona == 0)? Null: $oTabla->idPersonaRecepciona, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

	public function Modificar($oTabla)
	{
		$query = "
			EXEC ImagMovimientoIngresosModificar :idMovimiento, :nroDocumento, :idPersonaRecepciona, :idUsuarioAuditoria";

		$params = [
			'idMovimiento' => ($oTabla->idMovimiento == 0)? Null: $oTabla->idMovimiento, 
			'nroDocumento' => ($oTabla->nroDocumento == "")? Null: $oTabla->nroDocumento, 
			'idPersonaRecepciona' => ($oTabla->idPersonaRecepciona == 0)? Null: $oTabla->idPersonaRecepciona, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

	public function Eliminar($oTabla)
	{
		$query = "
			EXEC ImagMovimientoIngresosEliminar :idMovimiento, :idUsuarioAuditoria";

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
			EXEC ImagMovimientoIngresosSeleccionarPorId :idMovimiento";

		$params = [
			'idMovimiento' => $oTabla->idMovimiento, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

}