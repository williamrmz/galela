<?php

namespace App\VB\SIGHDatos;

use Illuminate\Database\Eloquent\Model;

use DB;

class ProProcedimientos extends Model
{
	public function Insertar($oTabla)
	{
		$query = "
			EXEC ProProcedimientosAgregar :idPrograma, :idProCabecera, :idControl, :idDiagnostico, :idProducto, :idResultado, :labConfHIS, :idUsuarioAuditoria";

		$params = [
			'idPrograma' => ($oTabla->idPrograma == 0)? Null: $oTabla->idPrograma, 
			'idProCabecera' => ($oTabla->idProCabecera == 0)? Null: $oTabla->idProCabecera, 
			'idControl' => ($oTabla->idControl == 0)? Null: $oTabla->idControl, 
			'idDiagnostico' => ($oTabla->idDiagnostico == 0)? 0: $oTabla->idDiagnostico, 
			'idProducto' => ($oTabla->idProducto == 0)? Null: $oTabla->idProducto, 
			'idResultado' => ($oTabla->idResultado == 0)? Null: $oTabla->idResultado, 
			'labConfHIS' => ($oTabla->labConfHIS == "")? Null: $oTabla->labConfHIS, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

	public function Modificar($oTabla)
	{
		$query = "
			EXEC ProProcedimientosModificar :idPrograma, :idProCabecera, :idControl, :idDiagnostico, :idProducto, :idResultado, :labConfHIS, :idUsuarioAuditoria";

		$params = [
			'idPrograma' => ($oTabla->idPrograma == 0)? Null: $oTabla->idPrograma, 
			'idProCabecera' => ($oTabla->idProCabecera == 0)? Null: $oTabla->idProCabecera, 
			'idControl' => ($oTabla->idControl == 0)? Null: $oTabla->idControl, 
			'idDiagnostico' => ($oTabla->idDiagnostico == 0)? Null: $oTabla->idDiagnostico, 
			'idProducto' => ($oTabla->idProducto == 0)? Null: $oTabla->idProducto, 
			'idResultado' => ($oTabla->idResultado == 0)? Null: $oTabla->idResultado, 
			'labConfHIS' => ($oTabla->labConfHIS == "")? Null: $oTabla->labConfHIS, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

	public function Eliminar($oTabla)
	{
		$query = "
			EXEC ProProcedimientosEliminar :idPrograma, :idProCabecera, :idControl, :idDiagnostico, :idProducto, :idUsuarioAuditoria";

		$params = [
			'idPrograma' => ($oTabla->idPrograma == 0)? Null: $oTabla->idPrograma, 
			'idProCabecera' => ($oTabla->idProCabecera == 0)? Null: $oTabla->idProCabecera, 
			'idControl' => ($oTabla->idControl == 0)? Null: $oTabla->idControl, 
			'idDiagnostico' => ($oTabla->idDiagnostico == 0)? Null: $oTabla->idDiagnostico, 
			'idProducto' => ($oTabla->idProducto == 0)? Null: $oTabla->idProducto, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

}