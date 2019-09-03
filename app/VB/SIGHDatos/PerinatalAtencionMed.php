<?php

namespace App\VB\SIGHDatos;

use Illuminate\Database\Eloquent\Model;

use DB;

class PerinatalAtencionMed extends Model
{
	public function Insertar($oTabla)
	{
		$query = "
			EXEC PerinatalAtencionMedicamentosAgregar :idPerinatalAtencion, :idModulo, :idProducto, :idAtencion, :idUsuarioAuditoria";

		$params = [
			'idPerinatalAtencion' => ($oTabla->idPerinatalAtencion == 0)? Null: $oTabla->idPerinatalAtencion, 
			'idModulo' => ($oTabla->idModulo == 0)? Null: $oTabla->idModulo, 
			'idProducto' => ($oTabla->idProducto == 0)? Null: $oTabla->idProducto, 
			'idAtencion' => ($oTabla->idAtencion == 0)? Null: $oTabla->idAtencion, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

	public function Modificar($oTabla)
	{
		$query = "
			EXEC PerinatalAtencionMedicamentosModificar :idPerinatalAtencion, :idModulo, :idProducto, :idAtencion, :idUsuarioAuditoria";

		$params = [
			'idPerinatalAtencion' => ($oTabla->idPerinatalAtencion == 0)? Null: $oTabla->idPerinatalAtencion, 
			'idModulo' => ($oTabla->idModulo == 0)? Null: $oTabla->idModulo, 
			'idProducto' => ($oTabla->idProducto == 0)? Null: $oTabla->idProducto, 
			'idAtencion' => ($oTabla->idAtencion == 0)? Null: $oTabla->idAtencion, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

	public function Eliminar($oTabla)
	{
		$query = "
			EXEC PerinatalAtencionMedicamentosEliminar :idPerinatalAtencion, :idUsuarioAuditoria";

		$params = [
			'idPerinatalAtencion' => $oTabla->idPerinatalAtencion, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

	public function SeleccionarPorId($oTabla)
	{
		$query = "
			EXEC PerinatalAtencionMedicamentosSeleccionarPorId :idPerinatalAtencion";

		$params = [
			'idPerinatalAtencion' => $oTabla->idPerinatalAtencion, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function PerinatalAtencionMedicamentoSeleccionarPorIdPerinatalAtencion($mo_idPerinatalAtencion)
	{
		$query = "
			EXEC PerinatalAtencionMedicamentoSeleccionarPorIdPerinatalAtencion :mo_idPerinatalAtencion";

		$params = [
			'mo_idPerinatalAtencion' => $mo_idPerinatalAtencion, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function EliminarXatencion($oTabla)
	{
		$query = "
			EXEC PerinatalAtencionMedicamentosEliminarXidAtencion :idAtencion, :idUsuarioAuditoria";

		$params = [
			'idAtencion' => $oTabla->idAtencion, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

}