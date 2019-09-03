<?php

namespace App\VB\SIGHDatos;

use Illuminate\Database\Eloquent\Model;

use DB;

class ASEspecialidades extends Model
{
	public function ListarSolicitudEspecialidades($oTabla)
	{
		$query = "
			EXEC ListarEspecialidadesSolicitud :idCuenta";

		$params = [
			'idCuenta' => $oTabla->idatencion, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function ListarInterconsultasxIdCuentaAtencion($ml_IdCuentaAtencion)
	{
		$query = "
			EXEC ListarInterconsultasxIdCuentaAtencion :idCuentaAtencion";

		$params = [
			'idCuentaAtencion' => $ml_IdCuentaAtencion, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function Insertar($oTabla)
	{
		$query = "
			DECLARE @idSolicitudEspecialidad AS Int = :idSolicitudEspecialidad
			SET NOCOUNT ON 
			EXEC ASolicitudEspecialidadesInsertar @idSolicitudEspecialidad OUTPUT, :idAtencion, :idEspecialidad, :idDiagnostico, :motivo, :idUsuario
			SELECT @idSolicitudEspecialidad AS idSolicitudEspecialidad";

		$params = [
			'idSolicitudEspecialidad' => 0, 
			'idAtencion' => ($oTabla->idatencion == 0)? Null: $oTabla->idatencion, 
			'idEspecialidad' => ($oTabla->idEspecialidad == 0)? Null: $oTabla->idEspecialidad, 
			'idDiagnostico' => ($oTabla->idDiagnostico == 0)? Null: $oTabla->idDiagnostico, 
			'motivo' => ($oTabla->motivo == "")? Null: $oTabla->motivo, 
			'idUsuario' => ($oTabla->idUsuario == 0)? Null: $oTabla->idUsuario, 
		];

		$data = \DB::select($query, $params);

		$data = reset($data);

		return $data;
	}

	public function Eliminar($oTabla)
	{
		$query = "
			EXEC EspecialidadesSolicitudEliminar :idSolicitudEspecialidad";

		$params = [
			'idSolicitudEspecialidad' => $oTabla->idSolicitudEspecialidad, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

}