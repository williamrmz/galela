<?php

namespace App\VB\SIGHDatos;

use Illuminate\Database\Eloquent\Model;

use DB;

class ProControles extends Model
{
	public function Insertar($oTabla)
	{
		$query = "
			EXEC ProControlesAgregar :idPrograma, :idProCabecera, :idControl, :idAtencion, :fechaControl, :controlOtroEESS, :idEstablecimiento, :idUsuarioAuditoria";

		$params = [
			'idPrograma' => ($oTabla->idPrograma == 0)? Null: $oTabla->idPrograma, 
			'idProCabecera' => ($oTabla->idProCabecera == 0)? Null: $oTabla->idProCabecera, 
			'idControl' => ($oTabla->idControl == 0)? Null: $oTabla->idControl, 
			'idAtencion' => ($oTabla->idAtencion == 0)? Null: $oTabla->idAtencion, 
			'fechaControl' => ($oTabla->fechaControl == "")? Null: $oTabla->fechaControl, 
			'controlOtroEESS' => ($oTabla->controlOtroEESS == False)? False: $oTabla->controlOtroEESS, 
			'idEstablecimiento' => ($oTabla->idEstablecimiento == 0)? Null: $oTabla->idEstablecimiento, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

	public function Modificar($oTabla)
	{
		$query = "
			EXEC ProControlesModificar :idPrograma, :idProCabecera, :idControl, :idAtencion, :fechaControl, :controlOtroEESS, :idEstablecimiento, :idUsuarioAuditoria";

		$params = [
			'idPrograma' => ($oTabla->idPrograma == 0)? Null: $oTabla->idPrograma, 
			'idProCabecera' => ($oTabla->idProCabecera == 0)? Null: $oTabla->idProCabecera, 
			'idControl' => ($oTabla->idControl == 0)? Null: $oTabla->idControl, 
			'idAtencion' => ($oTabla->idAtencion == 0)? Null: $oTabla->idAtencion, 
			'fechaControl' => ($oTabla->fechaControl == "")? Null: $oTabla->fechaControl, 
			'controlOtroEESS' => ($oTabla->controlOtroEESS == False)? False: $oTabla->controlOtroEESS, 
			'idEstablecimiento' => ($oTabla->idEstablecimiento == 0)? Null: $oTabla->idEstablecimiento, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

	public function Eliminar($oTabla)
	{
		$query = "
			EXEC ProControlesEliminar :idPrograma, :idProCabecera, :idControl, :idUsuarioAuditoria";

		$params = [
			'idPrograma' => $oTabla->idPrograma, 
			'idProCabecera' => $oTabla->idProCabecera, 
			'idControl' => $oTabla->idControl, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

	public function EliminarDatosControl($oTabla)
	{
		$query = "
			EXEC ProControlDatoEliminarTodo :idPrograma, :idProCabecera, :idControl, :idUsuarioAuditoria";

		$params = [
			'idPrograma' => $oTabla->idPrograma, 
			'idProCabecera' => $oTabla->idProCabecera, 
			'idControl' => $oTabla->idControl, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

	public function SeleccionarPorId($oTabla)
	{
		$query = "
			EXEC ProControlesSeleccionarPorId :idPrograma, :idProCabecera, :idControl";

		$params = [
			'idPrograma' => $oTabla->idPrograma, 
			'idProCabecera' => $oTabla->idProCabecera, 
			'idControl' => $oTabla->idControl, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

}