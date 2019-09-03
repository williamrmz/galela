<?php

namespace App\VB\SIGHDatos;

use Illuminate\Database\Eloquent\Model;

use DB;

class His_FactCatalogoServicios extends Model
{
	public function Insertar($oTabla)
	{
		$query = "
			EXEC HIS_FACTCATALOGOSERVICIOSAgregar :idDiagCpt, :codigoDiagCpt, :descripcionDiagCpt, :esCpt, :idUsuarioAuditoria";

		$params = [
			'idDiagCpt' => ($oTabla->idDiagCpt == 0)? Null: $oTabla->idDiagCpt, 
			'codigoDiagCpt' => ($oTabla->codigodiagcpt == "")? Null: $oTabla->codigodiagcpt, 
			'descripcionDiagCpt' => ($oTabla->descripciondiagcpt == "")? Null: $oTabla->descripciondiagcpt, 
			'esCpt' => ($oTabla->esCpt == "")? Null: $oTabla->esCpt, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

	public function Modificar($oTabla)
	{
		$query = "
			EXEC HIS_FACTCATALOGOSERVICIOSModificar :idDiagCpt, :codigoDiagCpt, :descripcionDiagCpt, :esCpt, :idUsuarioAuditoria";

		$params = [
			'idDiagCpt' => ($oTabla->idDiagCpt == 0)? Null: $oTabla->idDiagCpt, 
			'codigoDiagCpt' => ($oTabla->codigodiagcpt == "")? Null: $oTabla->codigodiagcpt, 
			'descripcionDiagCpt' => ($oTabla->descripciondiagcpt == "")? Null: $oTabla->descripciondiagcpt, 
			'esCpt' => ($oTabla->esCpt == "")? Null: $oTabla->esCpt, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

	public function Eliminar($oTabla)
	{
		$query = "
			EXEC HIS_FACTCATALOGOSERVICIOSEliminar :idDiagCpt, :idUsuarioAuditoria";

		$params = [
			'idDiagCpt' => $oTabla->idDiagCpt, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

	public function SeleccionarPorId($oTabla)
	{
		$query = "
			EXEC HIS_FACTCATALOGOSERVICIOSSeleccionarPorId :idDiagCpt";

		$params = [
			'idDiagCpt' => $oTabla->idDiagCpt, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

}