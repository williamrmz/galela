<?php

namespace App\VB\SIGHDatos;

use Illuminate\Database\Eloquent\Model;

use DB;

class ProControlDato extends Model
{
	public function Insertar($oTabla)
	{
		$query = "
			EXEC ProControlDatoAgregar :idPrograma, :idProCabecera, :idControl, :idControlDato, :controlDato, :idUsuarioAuditoria";

		$params = [
			'idPrograma' => ($oTabla->idPrograma == 0)? Null: $oTabla->idPrograma, 
			'idProCabecera' => ($oTabla->idProCabecera == 0)? Null: $oTabla->idProCabecera, 
			'idControl' => ($oTabla->idControl == 0)? Null: $oTabla->idControl, 
			'idControlDato' => ($oTabla->idControlDato == 0)? Null: $oTabla->idControlDato, 
			'controlDato' => ($oTabla->controlDato == "")? Null: $oTabla->controlDato, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

	public function Modificar($oTabla)
	{
		$query = "
			EXEC ProControlDatoModificar :idPrograma, :idProCabecera, :idControl, :idControlDato, :controlDato, :idUsuarioAuditoria";

		$params = [
			'idPrograma' => ($oTabla->idPrograma == 0)? Null: $oTabla->idPrograma, 
			'idProCabecera' => ($oTabla->idProCabecera == 0)? Null: $oTabla->idProCabecera, 
			'idControl' => ($oTabla->idControl == 0)? Null: $oTabla->idControl, 
			'idControlDato' => ($oTabla->idControlDato == 0)? Null: $oTabla->idControlDato, 
			'controlDato' => ($oTabla->controlDato == "")? Null: $oTabla->controlDato, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

	public function Eliminar($oTabla)
	{
		$query = "
			EXEC ProControlDatoEliminar :idPrograma, :idProCabecera, :idControl, :idControlDato, :idUsuarioAuditoria";

		$params = [
			'idPrograma' => $oTabla->idPrograma, 
			'idProCabecera' => $oTabla->idProCabecera, 
			'idControl' => $oTabla->idControl, 
			'idControlDato' => $oTabla->idControlDato, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

	public function SeleccionarPorId($oTabla)
	{
		$query = "
			EXEC ProControlDatoSeleccionarPorId :idPrograma, :idProCabecera, :idControl, :idControlDato";

		$params = [
			'idPrograma' => $oTabla->idPrograma, 
			'idProCabecera' => $oTabla->idProCabecera, 
			'idControl' => $oTabla->idControl, 
			'idControlDato' => $oTabla->idControlDato, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

}