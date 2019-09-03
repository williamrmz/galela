<?php

namespace App\VB\SIGHDatos;

use Illuminate\Database\Eloquent\Model;

use DB;

class CajaSupervisor extends Model
{
	public function Insertar($oTabla)
	{
		$query = "
			DECLARE @idSupervisor AS Int = :idSupervisor
			SET NOCOUNT ON 
			EXEC CajaSupervisorAgregar :idEmpleado, :estadoSupervisor, @idSupervisor OUTPUT, :idUsuarioAuditoria
			SELECT @idSupervisor AS idSupervisor";

		$params = [
			'idEmpleado' => ($oTabla->idEmpleado == 0)? Null: $oTabla->idEmpleado, 
			'estadoSupervisor' => ($oTabla->estadoSupervisor == "")? Null: $oTabla->estadoSupervisor, 
			'idSupervisor' => 0, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::select($query, $params);

		$data = reset($data);

		return $data;
	}

	public function Modificar($oTabla)
	{
		$query = "
			EXEC CajaSupervisorModificar :idEmpleado, :estadoSupervisor, :idSupervisor, :idUsuarioAuditoria";

		$params = [
			'idEmpleado' => ($oTabla->idEmpleado == 0)? Null: $oTabla->idEmpleado, 
			'estadoSupervisor' => ($oTabla->estadoSupervisor == "")? "0": $oTabla->estadoSupervisor, 
			'idSupervisor' => ($oTabla->idSupervisor == 0)? Null: $oTabla->idSupervisor, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

	public function Eliminar($oTabla)
	{
		$query = "
			EXEC CajaSupervisorEliminar :idSupervisor, :idUsuarioAuditoria";

		$params = [
			'idSupervisor' => ($oTabla->idSupervisor == 0)? Null: $oTabla->idSupervisor, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

	public function SeleccionarPorId($oTabla)
	{
		$query = "
			EXEC Select * from CajaSupervisor where IdSupervisor =  ";

		$params = [
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function RealizarFiltro($oEmpleado)
	{
		$query = "
			EXEC CommandText = SQ ";

		$params = [
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function SeleccionarTodos()
	{
		$query = "
			EXEC CommandText = SQ ";

		$params = [
		];

		$data = \DB::select($query, $params);

		return $data;
	}

}