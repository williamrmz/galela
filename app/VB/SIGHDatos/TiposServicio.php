<?php

namespace App\VB\SIGHDatos;

use Illuminate\Database\Eloquent\Model;

use DB;

class TiposServicio extends Model
{
	public function Insertar($oTabla)
	{
		$query = "
			EXEC TiposServicioAgregar :descripcion, :idTipoServicio, :idUsuarioAuditoria";

		$params = [
			'descripcion' => $oTabla->descripcion, 
			'idTipoServicio' => $oTabla->idTipoServicio, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

	public function Modificar($oTabla)
	{
		$query = "
			EXEC TiposServicioModificar :descripcion, :idTipoServicio, :idUsuarioAuditoria";

		$params = [
			'descripcion' => $oTabla->descripcion, 
			'idTipoServicio' => $oTabla->idTipoServicio, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

	public function Eliminar($oTabla)
	{
		$query = "
			EXEC TiposServicioEliminar :idTipoServicio, :idUsuarioAuditoria";

		$params = [
			'idTipoServicio' => $oTabla->idTipoServicio, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

	public function SeleccionarPorId($oTabla)
	{
		$query = "
			EXEC TiposServicioSeleccionarPorId :idTipoServicio";

		$params = [
			'idTipoServicio' => $oTabla->idTipoServicio, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function SeleccionarTodos()
	{
		$query = "
			EXEC TiposServicioSeleccionarTodos ";

		$params = [
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function SeleccionarAsistenciales()
	{
		$query = "
			EXEC TiposServicioSeleccionarAsistenciales ";

		$params = [
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function SeleccionarDeEmergencia()
	{
		$query = "
			EXEC TiposServicioSeleccionarDeEmergencia ";

		$params = [
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function SeleccionarCQ()
	{
		$query = "
			EXEC TiposServicioSeleccionarCQ ";

		$params = [
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function SeleccionarInterconsultaHosp()
	{
		$query = "
			EXEC SubclasificacionDiagnosticosSeleccionarDxInterconsultasH ";

		$params = [
		];

		$data = \DB::select($query, $params);

		return $data;
	}

	public function SeleccionarInterconsultaEmerg()
	{
		$query = "
			EXEC SubclasificacionDiagnosticosSeleccionarDxInterconsultasE ";

		$params = [
		];

		$data = \DB::select($query, $params);

		return $data;
	}

}