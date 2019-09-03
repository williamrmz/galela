<?php

namespace App\VB\SIGHDatos;

use Illuminate\Database\Eloquent\Model;

use DB;

class TiposImpuesto extends Model
{
	public function Insertar($oTabla)
	{
		$query = "
			EXEC TiposImpuestoAgregar :valor, :codImpuesto, :idUsuarioAuditoria";

		$params = [
			'valor' => ($oTabla->valor == "")? Null: $oTabla->valor, 
			'codImpuesto' => ($oTabla->codImpuesto == "")? Null: $oTabla->codImpuesto, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

	public function Modificar($oTabla)
	{
		$query = "
			EXEC TiposImpuestoModificar :valor, :codImpuesto, :idUsuarioAuditoria";

		$params = [
			'valor' => ($oTabla->valor == "")? Null: $oTabla->valor, 
			'codImpuesto' => ($oTabla->codImpuesto == "")? Null: $oTabla->codImpuesto, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

	public function Eliminar($oTabla)
	{
		$query = "
			EXEC TiposImpuestoEliminar :idUsuarioAuditoria";

		$params = [
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

	public function SeleccionarPorId($oTabla)
	{
		$query = "
			EXEC TiposImpuestoSeleccionarPorId ";

		$params = [
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function ObtenerIGV()
	{
		$query = "
			EXEC Uknown ";

		$params = [
		];

		$data = \DB::select($query, $params);

		return $data;
	}

}