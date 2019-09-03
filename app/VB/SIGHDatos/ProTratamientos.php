<?php

namespace App\VB\SIGHDatos;

use Illuminate\Database\Eloquent\Model;

use DB;

class ProTratamientos extends Model
{
	public function Insertar($oTabla)
	{
		$query = "
			EXEC ProTratamientosAgregar :idPrograma, :idProCabecera, :idControl, :idProducto, :idUsuarioAuditoria";

		$params = [
			'idPrograma' => ($oTabla->idPrograma == 0)? Null: $oTabla->idPrograma, 
			'idProCabecera' => ($oTabla->idProCabecera == 0)? Null: $oTabla->idProCabecera, 
			'idControl' => ($oTabla->idControl == 0)? Null: $oTabla->idControl, 
			'idProducto' => ($oTabla->idProducto == 0)? Null: $oTabla->idProducto, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

	public function Eliminar($oTabla)
	{
		$query = "
			EXEC ProTratamientosEliminar :idPrograma, :idProCabecera, :idControl, :idProducto, :idUsuarioAuditoria";

		$params = [
			'idPrograma' => $oTabla->idPrograma, 
			'idProCabecera' => ($oTabla->idProCabecera == 0)? Null: $oTabla->idProCabecera, 
			'idControl' => ($oTabla->idControl == 0)? Null: $oTabla->idControl, 
			'idProducto' => ($oTabla->idProducto == 0)? Null: $oTabla->idProducto, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

	public function SeleccionarPorId($oTabla)
	{
		$query = "
			EXEC ProTratamientosSeleccionarPorId :idPrograma";

		$params = [
			'idPrograma' => $oTabla->idPrograma, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

}