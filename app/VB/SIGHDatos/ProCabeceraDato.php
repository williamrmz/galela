<?php

namespace App\VB\SIGHDatos;

use Illuminate\Database\Eloquent\Model;

use DB;

class ProCabeceraDato extends Model
{
	public function Insertar($oTabla)
	{
		$query = "
			EXEC ProCabeceraDatoAgregar :idPrograma, :idProCabecera, :idCabDato, :cabDato, :idUsuarioAuditoria";

		$params = [
			'idPrograma' => ($oTabla->idPrograma == 0)? Null: $oTabla->idPrograma, 
			'idProCabecera' => ($oTabla->idProCabecera == 0)? Null: $oTabla->idProCabecera, 
			'idCabDato' => ($oTabla->idCabDato == 0)? Null: $oTabla->idCabDato, 
			'cabDato' => ($oTabla->cabDato == "")? Null: $oTabla->cabDato, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

	public function Modificar($oTabla)
	{
		$query = "
			EXEC ProCabeceraDatoModificar :idPrograma, :idProCabecera, :idCabDato, :cabDato, :idUsuarioAuditoria";

		$params = [
			'idPrograma' => ($oTabla->idPrograma == 0)? Null: $oTabla->idPrograma, 
			'idProCabecera' => ($oTabla->idProCabecera == 0)? Null: $oTabla->idProCabecera, 
			'idCabDato' => ($oTabla->idCabDato == 0)? Null: $oTabla->idCabDato, 
			'cabDato' => ($oTabla->cabDato == "")? Null: $oTabla->cabDato, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

	public function Eliminar($oTabla)
	{
		$query = "
			EXEC ProCabeceraDatoEliminar :idPrograma, :idProCabecera, :idCabDato, :idUsuarioAuditoria";

		$params = [
			'idPrograma' => $oTabla->idPrograma, 
			'idProCabecera' => $oTabla->idProCabecera, 
			'idCabDato' => $oTabla->idCabDato, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

	public function SeleccionarPorId($oTabla)
	{
		$query = "
			EXEC ProCabeceraDatoSeleccionarPorId :idPrograma, :idProCabecera, :idCabDato";

		$params = [
			'idPrograma' => $oTabla->idPrograma, 
			'idProCabecera' => $oTabla->idProCabecera, 
			'idCabDato' => $oTabla->idCabDato, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

}