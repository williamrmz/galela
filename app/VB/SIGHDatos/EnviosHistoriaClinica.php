<?php

namespace App\VB\SIGHDatos;

use Illuminate\Database\Eloquent\Model;

use DB;

class EnviosHistoriaClinica extends Model
{
	public function Insertar($oTabla)
	{
		$query = "
			DECLARE @idEnvio AS Int = :idEnvio
			SET NOCOUNT ON 
			EXEC EnviosHistoriaClinicaAgregar :horaPrestamoReal, :fechaPrestamoReal, :idResponsableRecepcion, :idResponsableEnvio, @idEnvio OUTPUT, :idUsuarioAuditoria
			SELECT @idEnvio AS idEnvio";

		$params = [
			'horaPrestamoReal' => ($oTabla->horaPrestamoReal == "")? Null: $oTabla->horaPrestamoReal, 
			'fechaPrestamoReal' => ($oTabla->fechaPrestamoReal == 0)? Null: $oTabla->fechaPrestamoReal, 
			'idResponsableRecepcion' => ($oTabla->idResponsableRecepcion == 0)? Null: $oTabla->idResponsableRecepcion, 
			'idResponsableEnvio' => ($oTabla->idResponsableEnvio == 0)? Null: $oTabla->idResponsableEnvio, 
			'idEnvio' => 0, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::select($query, $params);

		$data = reset($data);

		return $data;
	}

	public function Modificar($oTabla)
	{
		$query = "
			EXEC EnviosHistoriaClinicaModificar :horaPrestamoReal, :fechaPrestamoReal, :idResponsableRecepcion, :idResponsableEnvio, :idEnvio, :idUsuarioAuditoria";

		$params = [
			'horaPrestamoReal' => ($oTabla->horaPrestamoReal == "")? Null: $oTabla->horaPrestamoReal, 
			'fechaPrestamoReal' => ($oTabla->fechaPrestamoReal == 0)? Null: $oTabla->fechaPrestamoReal, 
			'idResponsableRecepcion' => ($oTabla->idResponsableRecepcion == 0)? Null: $oTabla->idResponsableRecepcion, 
			'idResponsableEnvio' => ($oTabla->idResponsableEnvio == 0)? Null: $oTabla->idResponsableEnvio, 
			'idEnvio' => ($oTabla->idEnvio == 0)? Null: $oTabla->idEnvio, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

	public function Eliminar($oTabla)
	{
		$query = "
			EXEC EnviosHistoriaClinicaEliminar :idEnvio, :idUsuarioAuditoria";

		$params = [
			'idEnvio' => ($oTabla->idEnvio == 0)? Null: $oTabla->idEnvio, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

	public function SeleccionarPorId($oTabla)
	{
		$query = "
			EXEC EnviosHistoriaClinicaSeleccionarPorId :idEnvio";

		$params = [
			'idEnvio' => $oTabla->idEnvio, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

}