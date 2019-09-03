<?php

namespace App\VB\SIGHDatos;

use Illuminate\Database\Eloquent\Model;

use DB;

class LabEstados extends Model
{
	public function Insertar($oTabla)
	{
		$query = "
			EXEC LabEstadosAgregar :idLabEstado, :estado, :idUsuarioAuditoria";

		$params = [
			'idLabEstado' => ($oTabla->idLabEstado == 0)? Null: $oTabla->idLabEstado, 
			'estado' => ($oTabla->estado == "")? Null: $oTabla->estado, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

	public function Modificar($oTabla)
	{
		$query = "
			EXEC LabEstadosModificar :idLabEstado, :estado, :idUsuarioAuditoria";

		$params = [
			'idLabEstado' => ($oTabla->idLabEstado == 0)? Null: $oTabla->idLabEstado, 
			'estado' => ($oTabla->estado == "")? Null: $oTabla->estado, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

	public function Eliminar($oTabla)
	{
		$query = "
			EXEC LabEstadosEliminar :idLabEstado, :idUsuarioAuditoria";

		$params = [
			'idLabEstado' => $oTabla->idLabEstado, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

	public function SeleccionarPorId($oTabla)
	{
		$query = "
			EXEC LabEstadosSeleccionarPorId :idLabEstado";

		$params = [
			'idLabEstado' => $oTabla->idLabEstado, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

}