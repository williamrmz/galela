<?php

namespace App\VB\SIGHDatos;

use Illuminate\Database\Eloquent\Model;

use DB;

class CQxOrdenOperatoriaCIE extends Model
{
	public function Insertar($oTabla)
	{
		$query = "
			DECLARE @idOrdenOperatoriaCIE AS Int = :idOrdenOperatoriaCIE
			SET NOCOUNT ON 
			EXEC CQxOrdenOperatoriaCIEAgregar @idOrdenOperatoriaCIE OUTPUT, :idOrdenOperatoria, :idDiagnostico, :idUsuario, :estacion, :idUsuarioAuditoria
			SELECT @idOrdenOperatoriaCIE AS idOrdenOperatoriaCIE";

		$params = [
			'idOrdenOperatoriaCIE' => 0, 
			'idOrdenOperatoria' => ($oTabla->idOrdenOperatoria == 0)? Null: $oTabla->idOrdenOperatoria, 
			'idDiagnostico' => ($oTabla->idDiagnostico == 0)? Null: $oTabla->idDiagnostico, 
			'idUsuario' => ($oTabla->idUsuario == 0)? Null: $oTabla->idUsuario, 
			'estacion' => $oTabla->estacion, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::select($query, $params);

		$data = reset($data);

		return $data;
	}

	public function InsertarMod($oTabla)
	{
		$query = "
			DECLARE @idOrdenOperatoriaCIE AS Int = :idOrdenOperatoriaCIE
			SET NOCOUNT ON 
			EXEC CQxOrdenOperatoriaCIEMod @idOrdenOperatoriaCIE OUTPUT, :idOrdenOperatoria, :idDiagnostico, :idUsuario, :estacion, :idUsuarioAuditoria
			SELECT @idOrdenOperatoriaCIE AS idOrdenOperatoriaCIE";

		$params = [
			'idOrdenOperatoriaCIE' => 0, 
			'idOrdenOperatoria' => ($oTabla->idOrdenOperatoria == 0)? Null: $oTabla->idOrdenOperatoria, 
			'idDiagnostico' => ($oTabla->idDiagnostico == 0)? Null: $oTabla->idDiagnostico, 
			'idUsuario' => ($oTabla->idUsuario == 0)? Null: $oTabla->idUsuario, 
			'estacion' => $oTabla->estacion, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::select($query, $params);

		$data = reset($data);

		return $data;
	}

	public function EliminarDiagnostico($oTabla)
	{
		$query = "
			EXEC CQxOrdenOperatoriaCIEEliminar :idOrdenOperatoria";

		$params = [
			'idOrdenOperatoria' => $oTabla->idOrdenOperatoria, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

	public function Modificar($oTabla)
	{
		$query = "
			EXEC CQxOrdenOperatoriaCIEModificar :idOrdenOperatoriaCIE";

		$params = [
			'idOrdenOperatoriaCIE' => ($oTabla->idOrdenOperatoriaCIE == 0)? Null: $oTabla->idOrdenOperatoriaCIE, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

	public function EliminarDiagnosticos($oTabla)
	{
		$query = "
			EXEC CQxOrdenOperatoriaCIEEliminar :idOrdenOperatoria";

		$params = [
			'idOrdenOperatoria' => ($oTabla->idOrdenOperatoria == 0)? Null: $oTabla->idOrdenOperatoria, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

	public function Eliminar($oTabla)
	{
		$query = "
			EXEC CQxOrdenOperatoriaCIEEliminar :idOrdenOperatoriaCIE, :idUsuarioAuditoria";

		$params = [
			'idOrdenOperatoriaCIE' => $oTabla->idOrdenOperatoriaCIE, 
			'idUsuarioAuditoria' => $oTabla->idUsuarioAuditoria, 
		];

		$data = \DB::update($query, $params);

		return $data;
	}

	public function SeleccionarPorId($oTabla)
	{
		$query = "
			EXEC CQxOrdenOperatoriaCIESeleccionarPorId :idOrdenOperatoriaCIE";

		$params = [
			'idOrdenOperatoriaCIE' => $oTabla->idOrdenOperatoriaCIE, 
		];

		$data = \DB::select($query, $params);

		return $data;
	}

}