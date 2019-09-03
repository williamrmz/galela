<?php

namespace App\VB\SIGHDatos;

use Illuminate\Database\Eloquent\Model;

use DB;

class FacturacionExoneraciones extends Model
{
	public function Insertar($oTabla)
	{
		$query = "
			DECLARE @idExoneracion AS Int = :idExoneracion
			SET NOCOUNT ON 
			EXEC FacturacionExoneracionesAgregar :idAtencion, @idExoneracion OUTPUT, :fechaExoneracion, :idEmpleadoExonera, :totalExonerado, :idUsuarioAuditoria
			SELECT @idExoneracion AS idExoneracion";

		$params = [
			'idAtencion' => ($oTabla->idAtencion == 0)? Null: $oTabla->idAtencion, 
			'idExoneracion' => ($oTabla->idExoneracion == 0)? Null: $oTabla->idExoneracion, 
			'fechaExoneracion' => ($oTabla->fechaExoneracion == 0)? Null: $oTabla->fechaExoneracion, 
			'idEmpleadoExonera' => ($oTabla->idEmpleadoExonera == 0)? Null: $oTabla->idEmpleadoExonera, 
			'totalExonerado' => ($oTabla->totalExonerado == 0)? Null: $oTabla->totalExonerado, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::select($query, $params);

		$data = reset($data);

		return $data;
	}

	public function Modificar($oTabla)
	{
		$query = "
			EXEC FacturacionExoneracionesModificar :idAtencion, :idEmpleadoExonera, :fechaExoneracion, :idExoneracion, :totalExonerado, :idUsuarioAuditoria";

		$params = [
			'idAtencion' => ($oTabla->idAtencion == 0)? Null: $oTabla->idAtencion, 
			'idEmpleadoExonera' => ($oTabla->idEmpleadoExonera == 0)? Null: $oTabla->idEmpleadoExonera, 
			'fechaExoneracion' => ($oTabla->fechaExoneracion == 0)? Null: $oTabla->fechaExoneracion, 
			'idExoneracion' => ($oTabla->idExoneracion == 0)? Null: $oTabla->idExoneracion, 
			'totalExonerado' => ($oTabla->totalExonerado == 0)? Null: $oTabla->totalExonerado, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

	public function Eliminar($oTabla)
	{
		$query = "
			EXEC FacturacionExoneracionesEliminar :idExoneracion, :idUsuarioAuditoria";

		$params = [
			'idExoneracion' => ($oTabla->idExoneracion == 0)? Null: $oTabla->idExoneracion, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

	public function SeleccionarPorId($oTabla)
	{
		$query = "
			EXEC FacturacionExoneracionesSeleccionarPorId :idExoneracion";

		$params = [
			'idExoneracion' => $oTabla->idExoneracion, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function SeleccionarPorCuentaAtencion($idCuentaAtencion)
	{
		$query = "
			EXEC Uknown ";

		$params = [
		];

		$data = \DB::select($query, $params);

		return $data;
	}

}