<?php

namespace App\VB\SIGHDatos;

use Illuminate\Database\Eloquent\Model;

use DB;

class TiposCondicionPaciente extends Model
{
	public function Insertar($oTabla)
	{
		$query = "
			DECLARE @idTipoCondicionPaciente AS Int = :idTipoCondicionPaciente
			SET NOCOUNT ON 
			EXEC TiposCondicionPacienteAgregar :descripcion, @idTipoCondicionPaciente OUTPUT, :idUsuarioAuditoria
			SELECT @idTipoCondicionPaciente AS idTipoCondicionPaciente";

		$params = [
			'descripcion' => ($oTabla->descripcion == "")? Null: $oTabla->descripcion, 
			'idTipoCondicionPaciente' => 0, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::select($query, $params);

		$data = reset($data);

		return $data;
	}

	public function Modificar($oTabla)
	{
		$query = "
			EXEC TiposCondicionPacienteModificar :descripcion, :idTipoCondicionPaciente, :idUsuarioAuditoria";

		$params = [
			'descripcion' => ($oTabla->descripcion == "")? Null: $oTabla->descripcion, 
			'idTipoCondicionPaciente' => ($oTabla->idTipoCondicionPaciente == 0)? Null: $oTabla->idTipoCondicionPaciente, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

	public function Eliminar($oTabla)
	{
		$query = "
			EXEC TiposCondicionPacienteEliminar :idTipoCondicionPaciente, :idUsuarioAuditoria";

		$params = [
			'idTipoCondicionPaciente' => ($oTabla->idTipoCondicionPaciente == 0)? Null: $oTabla->idTipoCondicionPaciente, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

	public function SeleccionarPorId($oTabla)
	{
		$query = "
			EXEC TiposCondicionPacienteSeleccionarPorId :idTipoCondicionPaciente";

		$params = [
			'idTipoCondicionPaciente' => $oTabla->idTipoCondicionPaciente, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function SeleccionarTodos()
	{
		$query = "
			EXEC TiposCondicionPacienteSeleccionarTodos ";

		$params = [
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function CondicionAlEstablecimiento($idPaciente, $fechaIngreso, $idAtencion)
	{
		$query = "
			DECLARE @idTipoCondicionPaciente AS Int = :idTipoCondicionPaciente
			SET NOCOUNT ON 
			EXEC CondicionPacienteAlEstablecimiento :idPaciente, :fechaIngreso, :idAtencion, @idTipoCondicionPaciente OUTPUT
			SELECT @idTipoCondicionPaciente AS idTipoCondicionPaciente";

		$params = [
			'idPaciente' => IdPaciente, 
			'fechaIngreso' => FechaIngreso, 
			'idAtencion' => $idAtencion, 
			'idTipoCondicionPaciente' => 0, 
		];

		$data = \DB::select($query, $params);

		$data = reset($data);

		return $data;
	}

	public function CondicionAlServicio($idPaciente, $fechaIngreso, $idServicio, $idAtencion)
	{
		$query = "
			DECLARE @idTipoCondicionPaciente AS Int = :idTipoCondicionPaciente
			SET NOCOUNT ON 
			EXEC CondicionPacienteAlServicio :idPaciente, :fechaIngreso, :idServicio, :idAtencion, @idTipoCondicionPaciente OUTPUT
			SELECT @idTipoCondicionPaciente AS idTipoCondicionPaciente";

		$params = [
			'idPaciente' => IdPaciente, 
			'fechaIngreso' => FechaIngreso, 
			'idServicio' => IdServicio, 
			'idAtencion' => $idAtencion, 
			'idTipoCondicionPaciente' => 0, 
		];

		$data = \DB::select($query, $params);

		$data = reset($data);

		return $data;
	}

}