<?php

namespace App\VB\SIGHDatos;

use Illuminate\Database\Eloquent\Model;

use DB;

class MedicosEspecialidad extends Model
{
	public function Insertar($oTabla)
	{
		$query = "
			DECLARE @idMedicoEspecialidad AS Int = :idMedicoEspecialidad
			SET NOCOUNT ON 
			EXEC MedicosEspecialidadAgregar @idMedicoEspecialidad OUTPUT, :idMedico, :idEspecialidad, :idUsuarioAuditoria
			SELECT @idMedicoEspecialidad AS idMedicoEspecialidad";

		$params = [
			'idMedicoEspecialidad' => 0, 
			'idMedico' => ($oTabla->idMedico == 0)? Null: $oTabla->idMedico, 
			'idEspecialidad' => ($oTabla->idEspecialidad == 0)? Null: $oTabla->idEspecialidad, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::select($query, $params);

		$data = reset($data);

		return $data;
	}

	public function Modificar($oTabla)
	{
		$query = "
			EXEC MedicosEspecialidadModificar :idMedicoEspecialidad, :idMedico, :idEspecialidad, :idUsuarioAuditoria";

		$params = [
			'idMedicoEspecialidad' => ($oTabla->idMedicoEspecialidad == "")? Null: $oTabla->idMedicoEspecialidad, 
			'idMedico' => ($oTabla->idMedico == "")? Null: $oTabla->idMedico, 
			'idEspecialidad' => ($oTabla->idEspecialidad == "")? Null: $oTabla->idEspecialidad, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

	public function Eliminar($oTabla)
	{
		$query = "
			EXEC MedicosEspecialidadEliminar :idMedicoEspecialidad, :idUsuarioAuditoria";

		$params = [
			'idMedicoEspecialidad' => ($oTabla->idMedicoEspecialidad == "")? Null: $oTabla->idMedicoEspecialidad, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

	public function SeleccionarPorId($oTabla)
	{
		$query = "
			EXEC MedicosEspecialidadSeleccionarPorId :idMedicoEspecialidad";

		$params = [
			'idMedicoEspecialidad' => $oTabla->idMedicoEspecialidad, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function EliminarPorMedico($oTabla)
	{
		$query = "
			EXEC MedicosEspecialidadEliminarPorMedico :idMedico, :idUsuarioAuditoria";

		$params = [
			'idMedico' => $oTabla->idMedico, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

	public function SeleccionarPorMedico($idMedico)
	{
		$query = "
			EXEC MedicosEspecialidadSeleccionarPorMedico :idMedico";

		$params = [
			'idMedico' => IdMedico, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function EspecialidadMedicoValidaEliminar($oDOMedicoEspecialidad)
	{
		$query = "
			EXEC EspecialidadMedicoValidaEliminar :idMedico, :idEspecialidad";

		$params = [
			'idMedico' => $oDOMedicoEspecialidad->idMedico, 
			'idEspecialidad' => $oDOMedicoEspecialidad->idEspecialidad, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

}