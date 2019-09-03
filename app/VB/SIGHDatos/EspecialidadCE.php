<?php

namespace App\VB\SIGHDatos;

use Illuminate\Database\Eloquent\Model;

use DB;

class EspecialidadCE extends Model
{
	public function Insertar($oTabla)
	{
		$query = "
			DECLARE @idEspecialidadCE AS Int = :idEspecialidadCE
			SET NOCOUNT ON 
			EXEC EspecialidadCEAgregar :idProductoInterconsulta, :idProductoConsulta, :tiempoPromedioAtencion, :idEspecialidad, @idEspecialidadCE OUTPUT, :idUsuarioAuditoria
			SELECT @idEspecialidadCE AS idEspecialidadCE";

		$params = [
			'idProductoInterconsulta' => ($oTabla->idProductoInterconsulta == 0)? Null: $oTabla->idProductoInterconsulta, 
			'idProductoConsulta' => ($oTabla->idProductoConsulta == 0)? Null: $oTabla->idProductoConsulta, 
			'tiempoPromedioAtencion' => ($oTabla->tiempoPromedioAtencion == 0)? Null: $oTabla->tiempoPromedioAtencion, 
			'idEspecialidad' => ($oTabla->idEspecialidad == 0)? Null: $oTabla->idEspecialidad, 
			'idEspecialidadCE' => 0, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::select($query, $params);

		$data = reset($data);

		return $data;
	}

	public function Modificar($oTabla)
	{
		$query = "
			EXEC EspecialidadCEModificar :idProductoInterconsulta, :idProductoConsulta, :tiempoPromedioAtencion, :idEspecialidad, :idEspecialidadCE, :idUsuarioAuditoria";

		$params = [
			'idProductoInterconsulta' => ($oTabla->idProductoInterconsulta == 0)? Null: $oTabla->idProductoInterconsulta, 
			'idProductoConsulta' => ($oTabla->idProductoConsulta == 0)? Null: $oTabla->idProductoConsulta, 
			'tiempoPromedioAtencion' => ($oTabla->tiempoPromedioAtencion == 0)? Null: $oTabla->tiempoPromedioAtencion, 
			'idEspecialidad' => ($oTabla->idEspecialidad == 0)? Null: $oTabla->idEspecialidad, 
			'idEspecialidadCE' => ($oTabla->idEspecialidadCE == 0)? Null: $oTabla->idEspecialidadCE, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

	public function Eliminar($oTabla)
	{
		$query = "
			EXEC EspecialidadCEEliminar :idEspecialidadCE, :idUsuarioAuditoria";

		$params = [
			'idEspecialidadCE' => ($oTabla->idEspecialidadCE == 0)? Null: $oTabla->idEspecialidadCE, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

	public function SeleccionarPorId($oTabla)
	{
		$query = "
			EXEC EspecialidadCESeleccionarPorId :idEspecialidadCE";

		$params = [
			'idEspecialidadCE' => $oTabla->idEspecialidadCE, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function SeleccionarPorIdEspecialidad($oTabla)
	{
		$query = "
			EXEC EspecialidadCESeleccionarPorIdEspecialidad :idEspecialidad";

		$params = [
			'idEspecialidad' => $oTabla->idEspecialidad, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

}