<?php

namespace App\VB\SIGHDatos;

use Illuminate\Database\Eloquent\Model;

use DB;

class LabTipoConceptos extends Model
{
	public function Insertar($oTabla)
	{
		$query = "
			EXEC LabTipoConceptosAgregar :idTipoConcepto, :concepto, :idUsuarioAuditoria";

		$params = [
			'idTipoConcepto' => ($oTabla->idTipoConcepto == 0)? Null: $oTabla->idTipoConcepto, 
			'concepto' => ($oTabla->concepto == "")? Null: $oTabla->concepto, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

	public function Modificar($oTabla)
	{
		$query = "
			EXEC LabTipoConceptosModificar :idTipoConcepto, :concepto, :idUsuarioAuditoria";

		$params = [
			'idTipoConcepto' => ($oTabla->idTipoConcepto == 0)? Null: $oTabla->idTipoConcepto, 
			'concepto' => ($oTabla->concepto == "")? Null: $oTabla->concepto, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

	public function Eliminar($oTabla)
	{
		$query = "
			EXEC LabTipoConceptosEliminar :idTipoConcepto, :idUsuarioAuditoria";

		$params = [
			'idTipoConcepto' => $oTabla->idTipoConcepto, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

	public function SeleccionarPorId($oTabla)
	{
		$query = "
			EXEC LabTipoConceptosSeleccionarPorId :idTipoConcepto";

		$params = [
			'idTipoConcepto' => $oTabla->idTipoConcepto, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

}