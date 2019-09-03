<?php

namespace App\VB\SIGHDatos;

use Illuminate\Database\Eloquent\Model;

use DB;

class ProCabecera extends Model
{
	public function Insertar($oTabla)
	{
		$query = "
			DECLARE @idProcabecera AS Int = :idProcabecera
			SET NOCOUNT ON 
			EXEC ProCabeceraAgregar :idPrograma, @idProcabecera OUTPUT, :idPaciente, :idUsuarioAuditoria
			SELECT @idProcabecera AS idProcabecera";

		$params = [
			'idPrograma' => $oTabla->idPrograma, 
			'idProcabecera' => 0, 
			'idPaciente' => ($oTabla->idPaciente == 0)? Null: $oTabla->idPaciente, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::select($query, $params);

		$data = reset($data);

		return $data;
	}

	public function Modificar($oTabla)
	{
		$query = "
			EXEC ProCabeceraModificar :idPrograma, :idProcabecera, :idPaciente, :idUsuarioAuditoria";

		$params = [
			'idPrograma' => ($oTabla->idPrograma == 0)? Null: $oTabla->idPrograma, 
			'idProcabecera' => ($oTabla->idProCabecera == 0)? Null: $oTabla->idProCabecera, 
			'idPaciente' => ($oTabla->idPaciente == 0)? Null: $oTabla->idPaciente, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

	public function ProCabeceraEliminar($oTabla)
	{
		$query = "
			EXEC ProCabeceraEliminar :idPrograma, :idProCabecera, :idUsuarioAuditoria";

		$params = [
			'idPrograma' => $oTabla->idPrograma, 
			'idProCabecera' => $oTabla->idProCabecera, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

	public function SeleccionarPorId($oTabla)
	{
		$query = "
			EXEC ProCabeceraSeleccionarPorId :idPrograma, :idProCabecera";

		$params = [
			'idPrograma' => $oTabla->idPrograma, 
			'idProCabecera' => $oTabla->idProCabecera, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

}